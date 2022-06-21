<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class GuruModel extends Model
{
    protected $table = 'tb_guru';
    protected $primaryKey = 'id_guru';
    protected $allowedFields = ['accesskey', 'username', 'password', 'level', 'section', 'unit', 'status'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataGuru($data)
    {
        $this->transBegin();
        $this->insertBatch($data);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }

    public function getDataGuru()
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

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['id_guru' => $id]);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getListGuru()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit]);
        return $result;
    }

    public function getCountGuru(){
        $unit = session()->get('unit');
        $result = $this->getWhere(['tb_guru.status' => 'Aktif', 'unit' => $unit])->getNumRows();
        return $result;
    }

    public function getDataGuruById($id)
    {
        $result = $this->select('accesskey, username')->getWhere(['id_guru' => $id])->getRow();
        return $result;
    }

    public function getSelectGuru($param)
    {
        $result = $this->select('id_guru, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataGuru($data)
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

    public function updateDataGuru($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_guru', $id);
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
        $this->updateBatch($data, 'id_guru');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusGuru($id)
    {
        $check = $this->getWhere(['id_guru' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_guru', $id);
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
            $this->userModel->aktifUserByKey($check->accesskey);
            $this->set('status','Aktif');
            $this->where('id_guru', $id);
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
}