<?php
namespace App\Models;
use CodeIgniter\Model;
use Irsyadulibad\DataTables\DataTables;

class MapelModel extends Model{
    protected $table = 'tb_mapel';
    protected $primaryKey = 'kd_mapel';
    protected $allowedFields = ['kd_mapel', 'nm_mapel', 'nm_mapel_ing', 'kls_mapel', 'urutan_mapel', 'kelompok_mapel', 'unit', 'status'];


    public function getDataMapelByUnit()
    {
        $unit = session()->get('unit');
        return DataTables::use($this->table)
        ->select('tb_mapel.*, tb_kelas.romawi AS romawi')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_mapel.kls_mapel', 'INNER JOIN')
        ->where(['tb_mapel.unit'=>$unit])
        ->orderBy('kls_mapel', 'ASC')
        ->orderBy('kelompok_mapel' ,'ASC')
        ->orderBy('urutan_mapel' ,'ASC')
        ->make(true);
    }
    

    public function insertDataMapel($data)
    {
        $this->transBegin();
        $this->insert($data);
        if ($this->transStatus()=== FALSE) {
            $this->transRollback();
            return 'Failed Input';
        }else{
            $this->transCommit();
            return 'Success Input';
        }
    }

    public function updateDataMapel($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('kd_mapel', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->set('status', 'Non-Aktif');
        $this->where('kd_mapel', $id);
        $this->update();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataMapelById($id)
    {
        $result = $this->getWhere(['kd_mapel' => $id]);
        return $result;
    }

    public function getListMapel($kls)
    {
        $unit = session()->get('unit');
        $result = $this->groupBy('nm_mapel')->getWhere(['unit' => $unit, 'kls_mapel' => $kls ]);
        return $result;
    }

    public function getDataMapelByKls($id)
    {
        $result = $this->getWhere(['kls_mapel' => $id]);
        return $result;
    }

    public function getDataMapelByKelompok($id,$kelompok)
    {
        $result = $this->query("SELECT * FROM `tb_mapel` WHERE `kelompok_mapel` = '$kelompok' AND `kls_mapel` = '$id' order by `urutan_mapel` asc");
        return $result;
    }


    public function getCountMapel()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit])->getNumRows();
        return $result;
    }

    

}