<?php 
namespace App\Models;
use CodeIgniter\Model;

class RaporSemesterModel extends Model
{
    protected $table = 'tb_rapor_semester';
    protected $primaryKey = 'id_rapor_semester';
    protected $allowedFields = ['id_rapor_semester', 'id_rombel', 'kd_ta', 'wali_kelas', 'kota_terbit' , 'tgl_terbit'];
    protected $userModel;
   

    public function getDataRaporSemester($data)
    {   
        $result = $this->query("SELECT tb_pesdik.id_pesdik, tb_pesdik.nisn, tb_pesdik.nm_pesdik FROM tb_pesdik INNER JOIN  tb_rapor_semester ON tb_pesdik.rombel = tb_rapor_semester.id_rombel WHERE id_rombel = $data[id_rombel]")->getResultArray();
        return $result;
    }

    public function getDataRapor($ta,$rombel)
    {
        $result = $this->select('tb_rapor_semester.*, tb_guru.username, tb_sekolah.nm_kepsek, tb_sekolah.nm_sekolah, tb_sekolah.alamat')
        ->join('tb_guru', 'tb_rapor_semester.wali_kelas = tb_guru.accesskey')
        ->join('tb_sekolah', 'tb_sekolah.unit = tb_guru.unit')
        ->getWhere(['id_rombel'=>$rombel, 'kd_ta' => $ta])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_rapor_semester',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataRaporSemesterById($id)
    {
        $result = $this->select('tb_nilai_bulanan.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_bulanan.nisn = tb_pesdik.nisn')
        ->getWhere(['id_rapor_semester'=>$id])->getRow();
        return $result;
    }

    public function getSelectRaporSemester($param)
    {
        $result = $this->select('id_rapor_semester, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataRaporSemester($data)
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

    public function updateDataRaporSemester($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_rapor_semester', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsRaporSemester($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_rapor_semester');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function checkStatusRaporSemester($data)
    {
        $result = $this->getWhere(['id_rombel' => intval($data['id_rombel']) , 'kd_ta' => $data['kd_ta']]);
        return $result;
    }
}