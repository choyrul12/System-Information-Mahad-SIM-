<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class ThnAkademikModel extends Model
{
    protected $table = 'tb_thn_akademik';
    protected $primaryKey = 'kd_ta';
    protected $allowedFields = ['kd_ta', 'thn_akademik', 'semester', 'status', 'unit'];
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
        $this->userModel->createUserGuru($data);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }

    public function getDataThnAkademik()
    {
        if (session()->get('level')=='1') {
            return DataTables::use($this->table)
            ->join('tb_user', 'tb_guru.nip = tb_user.accesskey', 'INNER JOIN')
            // ->where(['tb_guru.status' => 'Aktif'])
            ->make(true);
        }else{
            $unit = session()->get('unit');
            return DataTables::use($this->table)
            ->where(['unit'=>$unit])
            ->make(true);
        }
    }

    public function getListThnAkademik()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit]);
        return $result;
    }

    public function getDataThnAkademikById($id)
    {
        $result = $this->getWhere(['kd_ta'=>$id])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['kd_ta' => $id]);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    

    public function insertDataThnAkademik($data)
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

    public function updateDataThnAkademik($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
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

    public function changeStatusThnAkademik($id)
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

    public function getThnAkademik()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(["unit"=>$unit]);
        return $result;
    }
}