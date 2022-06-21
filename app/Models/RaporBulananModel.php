<?php 
namespace App\Models;
use CodeIgniter\Model;

class RaporBulananModel extends Model
{
    protected $table = 'tb_rapor_bulanan';
    protected $primaryKey = 'id_rapor_bulanan';
    protected $allowedFields = ['id_rapor_bulanan', 'bulan_rapor', 'id_rombel', 'kd_ta', 'wali_kelas', 'jenis', 'kota_terbit' , 'tgl_terbit'];
    protected $userModel;
   

    public function getDataRaporBulanan($data)
    {   
        $result = $this->query("SELECT tb_pesdik.id_pesdik, tb_pesdik.nisn, tb_pesdik.nm_pesdik FROM tb_pesdik INNER JOIN  tb_rapor_bulanan ON tb_pesdik.rombel = tb_rapor_bulanan.id_rombel WHERE id_rombel = $data[id_rombel] AND bulan_rapor = '$data[bulan]' AND kd_ta = '$data[kd_ta]'")->getResultArray();
        return $result;
    }

    public function getDataRapor($month,$ta,$rombel)
    {
        $result = $this->select('tb_rapor_bulanan.*, tb_guru.username, tb_sekolah.nm_kepsek, tb_sekolah.nm_sekolah, tb_sekolah.alamat')
        ->join('tb_guru', 'tb_rapor_bulanan.wali_kelas = tb_guru.accesskey')
        ->join('tb_sekolah', 'tb_sekolah.unit = tb_guru.unit')
        ->getWhere(['bulan_rapor'=>$month, 'kd_ta' => $ta, 'id_rombel' => $rombel])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_rapor_bulanan',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataRaporBulananById($id)
    {
        $result = $this->select('tb_nilai_bulanan.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_bulanan.nisn = tb_pesdik.nisn')
        ->getWhere(['id_rapor_bulanan'=>$id])->getRow();
        return $result;
    }

    public function getSelectRaporBulanan($param)
    {
        $result = $this->select('id_rapor_bulanan, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataRaporBulanan($data)
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

    public function updateDataRaporBulanan($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_rapor_bulanan', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsRaporBulanan($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_rapor_bulanan');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function checkStatusRaporBulanan($data)
    {
        $result = $this->getWhere(['bulan_rapor' => $data['bulan'], 'id_rombel' => intval($data['id_rombel']) , 'kd_ta' => $data['kd_ta']]);
        return $result;
    }
}