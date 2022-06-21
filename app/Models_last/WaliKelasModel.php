<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class WaliKelasModel extends Model
{
    protected $table = 'tb_wali_kelas';
    protected $primaryKey = 'id_wali_kelas';
    protected $allowedFields = ['nip_guru', 'id_rombel', 'kd_ta'];
    
    public function getDataWaliKelas($ta)
    {        
        $result = $this->query("SELECT tb_wali_kelas.id_wali_kelas, tb_rombel.nm_rombel, tb_guru.accesskey AS nip_guru, tb_guru.username AS nm_guru FROM tb_wali_kelas INNER JOIN tb_guru ON tb_guru.accesskey =  tb_wali_kelas.nip_guru INNER JOIN  tb_rombel ON tb_rombel.id_rombel = tb_wali_kelas.id_rombel WHERE tb_wali_kelas.kd_ta = '$ta'")->getResultArray();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['id_wali_kelas' => $id]);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getListWaliKelas()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit]);
        return $result;
    }

    public function getCountWaliKelas(){
        $unit = session()->get('unit');
        $result = $this->getWhere(['tb_wali_kelas.status' => 'Aktif', 'unit' => $unit])->getNumRows();
        return $result;
    }

    public function getDataWaliKelasById($id)
    {
        $result = $this->select('*')->getWhere(['id_wali_kelas' => $id])->getRow();
        return $result;
    }

    public function getSelectWaliKelas($param)
    {
        $result = $this->select('id_wali_kelas, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataWaliKelas($data)
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

    public function updateDataWaliKelas($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_wali_kelas', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsWaliKelas($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_wali_kelas');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusWaliKelas($id)
    {
        $check = $this->getWhere(['id_wali_kelas' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_wali_kelas', $id);
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
            $this->where('id_wali_kelas', $id);
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