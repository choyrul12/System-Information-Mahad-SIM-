<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class NilaiMapelModel extends Model
{
    protected $table = 'tb_nilai_mapel';
    protected $primaryKey = 'id_nilai_mapel';
    protected $allowedFields = ['id_nilai_mapel', 'nisn', 'kd_mapel', 'id_kelas', 'id_rombel', 'kd_ta', 'nik_NilaiMapel', 'ph', 'pts', 'pat', 'na', 'keterampilan', 'nik_guru', 'last_update'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataNilaiMapel($data)
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

    public function getDataNilaiMapel($data)
    {   
        $result = array();
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel] order by nm_pesdik ASC");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT id_nilai_mapel, COALESCE(ph, 0) AS ph, COALESCE(pts, 0) AS pts, COALESCE(pat,0) AS pat, COALESCE(na,0) AS na, COALESCE(keterampilan,0) AS keterampilan FROM  tb_nilai_mapel WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]' AND kd_mapel = $data[id_mapel]");
            
            if($nilai->getNumRows() > 0){
                $ph = $nilai->getRow('ph');
                $pts = $nilai->getRow('pts');
                $pat = $nilai->getRow('pat');
                $na = $nilai->getRow('na');
                $keterampilan = $nilai->getRow('keterampilan');
            }else{
                $ph = 0;
                $pts = 0;
                $pat = 0;
                $na = 0;
                $keterampilan = 0;
            }
            array_push($result,array(
                'id_nilai_mapel' => $nilai->getRow('id_nilai_mapel'),
                'nisn' => $s['nisn'],
                'nm_pesdik' => $s['nm_pesdik'],
                'ph' => $ph,
                'pts' => $pts,
                'pat' => $pat,
                'na' => $na,
                'keterampilan' => $keterampilan,
            ));
        }

        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_nilai_mapel',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataNilaiMapelById($id)
    {
        $result = $this->select('tb_nilai_mapel.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_mapel.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_mapel'=>$id])->getRow();
        return $result;
    }

    public function getDataNilaiByMapel($mapel,$nisn,$ta)
    {
        $result = $this->query("SELECT ROUND(na) AS na, ROUND(keterampilan) AS keterampilan FROM tb_nilai_mapel WHERE kd_mapel = '$mapel' AND nisn = '$nisn' AND kd_ta = '$ta'")->getRow();
        return $result;
    }
    
    public function getNilaiByNisn($nisn,$mapel,$ta)
    {
        $result = array();
        $mapel = $this->query("SELECT kd_mapel FROM tb_mapel WHERE kls_mapel = $_GET[kelas]  AND rapor_semester = 'Show' GROUP BY nm_mapel");
        
        foreach($mapel->getResultArray() AS $m){   
            $nilai = $this->select('ROUND(na,0) AS p, ROUND(keterampilan,0) AS k')->getWhere(['nisn' => $nisn,'kd_mapel' => $m['kd_mapel'],'kd_ta' => $ta]);
            if($nilai->getNumRows() > 0){
                $p = $nilai->getRow('p');
                $k = $nilai->getRow('k');
            }else{
                $p = 0;
                $k = 0;
            }       
            array_push($result,array(
                'p' => $p,
                'k' => $k
            ));
        }
        return $result;
    }

    public function getSelectNilaiMapel($param)
    {
        $result = $this->select('id_nilai_mapel, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataNilaiMapel($data)
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

    public function updateDataNilaiMapel($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_nilai_mapel', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsNilaiMapel($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_nilai_mapel');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusNilaiMapel($id)
    {
        $check = $this->getWhere(['id_nilai_mapel' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_nilai_mapel', $id);
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
            $this->where('id_nilai_mapel', $id);
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