<?php
namespace App\Models;
use CodeIgniter\Model;
use Irsyadulibad\DataTables\DataTables;

class RombelModel extends Model{
    protected $table = 'tb_rombel';
    protected $primaryKey = 'id_Rombel';
    protected $allowedFields = ['id_kelas', 'nm_rombel', 'unit'];


    public function getDataRombelByUnit()
    {
        $unit = session()->get('unit');
        return DataTables::use($this->table)
        ->select('tb_rombel.*, tb_kelas.romawi AS romawi')
        ->join('tb_kelas', 'tb_kelas.id_kelas = tb_rombel.id_kelas', 'INNER JOIN')
        ->where(['tb_rombel.unit'=>$unit])
        ->make(true);
    }

    public function getListRombel()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit]);
        return $result;
    }
    

    public function insertDataRombel($data)
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

    public function updateDataRombel($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_rombel', $id);
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
        $this->where('id_rombel', $id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataRombelById($id)
    {
        $result = $this->getWhere(['id_rombel' => $id]);
        return $result;
    }

    public function getCountRombel()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit])->getNumRows();
        return $result;
    }

    public function getDataSelectRombel($id)
    {
        $result = $this->getWhere(['id_kelas'=>$id])->getResultArray();
        return $result;
    }
}