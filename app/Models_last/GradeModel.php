<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class GradeModel extends Model
{
    protected $table = 'tb_grade';
    protected $primaryKey = 'id_grade';
    protected $allowedFields = ['id_grade', 'grade', 'min', 'max', 'unit'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function getDataGrade()
    {
        if (session()->get('level')=='1') {
            return DataTables::use($this->table)
            ->make(true);
        }else{
            $unit = session()->get('unit');
            return DataTables::use($this->table)
            ->where(['unit'=>$unit])
            ->make(true);
        }
    }

    public function insertDataGrade($data)
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


    public function getDataGradeById($id)
    {
        $result = $this->getWhere(['id_grade'=>$id])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['id_grade' => $id]);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function updateDataGrade($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_grade', $id);
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

    public function changeStatusGrade($id)
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

    public function getGradeByScore($n)
    {
        $result = $this->query("SELECT * FROM tb_grade WHERE min <= $n AND max >= $n")->getRow();
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