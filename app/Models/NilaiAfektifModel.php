<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class NilaiAfektifModel extends Model
{
    protected $table = 'tb_nilai_afektif';
    protected $primaryKey = 'id_nilai_afektif';
    protected $allowedFields = ['id_nilai_afektif','kd_ta', 'nisn','kd_mapel', 'spiritual', 'sosial', 'nik_guru'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataNilaiAfektif($data)
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

    public function getDataNilaiAfektif($data)
    {   
        $result = array();
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT * FROM  tb_nilai_afektif WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]'");
            
            if($nilai->getNumRows() > 0){
                $spiritual = $nilai->getRow('spiritual');
                $sosial = $nilai->getRow('sosial');
                $input = '';
            }else{
                $spiritual = '
                <select class="form-control" name="spiritual[]" required>
                    <option value="">PILIH PREDIKAT</option>
                    <option value="SANGAT BAIK">SANGAT BAIK</option>
                    <option value="BAIK">BAIK</option>
                    <option value="CUKUP">CUKUP</option>
                    <option value="KURANG">KURANG</option>
                </select>';
                $sosial = '
                <select class="form-control" name="sosial[]" required>
                    <option value="">PILIH PREDIKAT</option>
                    <option value="SANGAT BAIK">SANGAT BAIK</option>
                    <option value="BAIK">BAIK</option>
                    <option value="CUKUP">CUKUP</option>
                    <option value="KURANG">KURANG</option>
                </select>';
                $input = '<input type="hidden" name="nisn[]" value="'.$s["nisn"].'">';
            }
            array_push($result,array(
                'id_nilai_afektif' => $nilai->getRow('id_nilai_afektif'),
                'nisn' => $s['nisn'],
                'nm_pesdik' => $s['nm_pesdik'],
                'spiritual' => $spiritual, 
                'sosial' => $sosial,
                'input' => $input,
            ));
        }

        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_nilai_afektif',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataNilaiAfektifById($id)
    {
        $result = $this->select('tb_nilai_afektif.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_afektif.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_afektif'=>$id])->getRow();
        return $result;
    }

    public function getDataNilaiAfektifByNisn($nisn,$ta)
    {
        $result = $this->select('tb_nilai_afektif.*')
        ->getWhere(['nisn'=>$nisn,'kd_ta' => $ta])->getRow();
        return $result;
    }

    public function getSelectNilaiAfektif($param)
    {
        $result = $this->select('id_nilai_afektif, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataNilaiAfektif($data)
    {
        $this->transBegin();
        $this->insertBatch($data);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }

    public function updateDataNilaiAfektif($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_nilai_afektif', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsNilaiAfektif($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_nilai_afektif');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusNilaiAfektif($id)
    {
        $check = $this->getWhere(['id_nilai_afektif' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_nilai_afektif', $id);
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
            $this->where('id_nilai_afektif', $id);
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