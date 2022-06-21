<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class AbsensiModel extends Model
{
    protected $table = 'tb_absensi';
    protected $primaryKey = 'id_absensi';
    protected $allowedFields = ['id_absensi', 'nisn', 'id_kelas', 'id_rombel', 'kd_ta', 'sakit', 'izin', 'alpha', 'nik_guru',  'last_update'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataAbsensi($data)
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

    public function getDataAbsensi($data)
    {   
        $result = array();
        $unit  = session()->get('unit'); 
        $eskul = $this->query("SELECT * FROM tb_eskul WHERE unit = '$unit'");
       
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT * FROM  tb_absensi WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]'");
            if($nilai->getNumRows() > 0){
                $sakit = $nilai->getRow('sakit');
                $izin = $nilai->getRow('izin');
                $alpha = $nilai->getRow('alpha');
            }else{
                $sakit = "<input type='number' value='1' class='form-control' name='sakit[]' size='2'>";
                $izin = "<input type='number' value='1' class='form-control' name='izin[]' size='2'>";
                $alpha = "<input type='number' value='1' class='form-control' name='alpha[]' size='2'>";
                $input = "<input type='hidden' value='".$s['nisn']."' name='nisn[]'>";
            }
           
            array_push($result,array(
                'id_nilai_eskul' => $nilai->getRow('id_nilai_eskul'),
                'nisn' => $s['nisn'],
                'nm_pesdik' => $s['nm_pesdik'],       
                'sakit' => $sakit,
                'izin' => $izin, 
                'alpha' => $alpha,     
                'input' => $input
            ));
        }

        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->whereIn('id_nilai_eskul',$id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataAbsensiById($id)
    {
        $result = $this->select('tb_nilai_eskul.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_eskul.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_eskul'=>$id])->getRow();
        return $result;
    }

    public function getAbsensiByNisn($nisn,$ta)
    {
       $result = $this->getWhere(["nisn" => $nisn, "kd_ta" => $ta])->getRow();
       return $result;
    }

    public function getSelectAbsensi($param)
    {
        $result = $this->select('id_nilai_eskul, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataAbsensi($data)
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

    public function updateDataAbsensi($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_nilai_eskul', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsAbsensi($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_nilai_eskul');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        }else{
            $this->transCommit();
            return "Success Update";
        }
    }

    public function changeStatusAbsensi($id)
    {
        $check = $this->getWhere(['id_nilai_eskul' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_nilai_eskul', $id);
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
            $this->where('id_nilai_eskul', $id);
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