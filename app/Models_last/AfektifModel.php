<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class AfektifModel extends Model
{
    protected $table = 'tb_afektif';
    protected $primaryKey = 'id_afektif';
    protected $allowedFields = ['id_afektif', 'kategori', 'predikat', 'deskripsi','unit','kelas'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function getDataAfektif()
    {
        if (session()->get('level')=='1') {
            return DataTables::use($this->table)
            ->make(true);
        }else{
            $unit = session()->get('unit');
            return DataTables::use($this->table)
            ->select('*')
            // ->join('tb_kelas', 'tb_kelas.id_kelas = tb_afektif.kelas', 'INNER JOIN')
            ->where(['tb_afektif.unit'=>$unit])
            ->make(true);
        }
    }

    public function insertDataAfektif($data)
    {
        $this->transBegin();
        $this->insert($data);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }


    public function getDataAfektifById($id)
    {
        $result = $this->getWhere(['id_afektif'=>$id])->getRow();
        return $result;
    }

    public function getDeskripsiAfektif($kategori,$predikat)
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['kategori'=>$kategori, "predikat" => $predikat, "unit" => $unit])->getRow();
        return $result;
    }

    public function getDataAfektifByKelas($kelas)
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit])->getResultArray();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['id_Afektif' => $id]);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function updateDataAfektif($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_Afektif', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsGuru($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_Guru');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusAfektif($id)
    {
        $check = $this->getWhere(['kd_ta' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->set('status','Non-Aktif');
            $this->where('kd_ta', $id);
            $this->update();
            if ($this->transStatus() === FALSE) {
                $this->transRollback();
                return "Failed Update";
            }else{
                $this->transCommit();
                return "Success Update";
            }
        }else{
            $this->transBegin();
            $this->set('status','Non-Aktif');
            $this->where('status', 'Aktif');
            $this->update();

            $this->set('status','Aktif');
            $this->where('kd_ta', $id);
            $this->update();
            if ($this->transStatus() === FALSE) {
                $this->transRollback();
                return "Failed Update";
            }else{
                $this->transCommit();
                return "Success Update";
            }
        }
    }

    public function getKkm($unit)
    {
        $result = $this->query("SELECT * FROM tb_kkm WHERE unit = '$unit'")->getRow();
        return $result;
    }

    public function getKkmById($id)
    {
        $result = $this->query("SELECT * FROM tb_kkm WHERE id_kkm = '$id'")->getRow();
        return $result;
    }

    public function updateDataKkm($data)
    {
        $this->transBegin();
        $this->query("UPDATE `tb_kkm` SET `standard`='$data[standard]',`unit`='$data[unit]' WHERE `id_kkm`=$data[id_kkm]");
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }
}