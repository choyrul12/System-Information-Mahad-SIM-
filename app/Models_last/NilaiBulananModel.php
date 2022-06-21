<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class NilaiBulananModel extends Model
{
    protected $table = 'tb_nilai_bulanan';
    protected $primaryKey = 'id_nilai_bulanan';
    protected $allowedFields = ['id_nilai_bulanan', 'bulan', 'nisn', 'kd_mapel', 'id_kelas', 'id_rombel', 'kd_ta', 'nik_guru', 'score', 'last_update'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataNilaiBulanan($data)
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

    public function getDataNilaiBulanan($data)
    {   
        $result = array();
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT id_nilai_bulanan, COALESCE(score, 0) AS score FROM  tb_nilai_bulanan WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]' AND kd_mapel = $data[id_mapel] AND bulan = '$data[bulan]'");
            
            if($nilai->getNumRows() > 0){
                $score = $nilai->getRow('score');
            }else{
                $score = 0;
            }
            array_push($result,array(
                'id_nilai_bulanan' => $nilai->getRow('id_nilai_bulanan'),
                'nisn' => $s['nisn'],
                'nm_pesdik' => $s['nm_pesdik'],
                'score' => $score,
            ));
        }

        return $result;
    }

    public function getDataNilaiByMapel($mapel,$nisn,$month)
    {
        $result = $this->getWhere(['kd_mapel'=>$mapel,'nisn' => $nisn, 'bulan' => $month])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_nilai_bulanan',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataNilaiBulananById($id)
    {
        $result = $this->select('tb_nilai_bulanan.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_bulanan.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_bulanan'=>$id])->getRow();
        return $result;
    }

    public function getSelectNilaiBulanan($param)
    {
        $result = $this->select('id_nilai_bulanan, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataNilaiBulanan($data)
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

    public function updateDataNilaiBulanan($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_nilai_bulanan', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsNilaiBulanan($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_nilai_bulanan');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusNilaiBulanan($id)
    {
        $check = $this->getWhere(['id_nilai_bulanan' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_nilai_bulanan', $id);
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
            $this->where('id_nilai_bulanan', $id);
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