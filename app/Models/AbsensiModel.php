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
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT * FROM  tb_absensi WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]'");
            if($nilai->getNumRows() > 0){
                $sakit = $nilai->getRow('sakit');
                $izin = $nilai->getRow('izin');
                $alpha = $nilai->getRow('alpha');
                $input = "<input type='hidden' value='".$s['nisn']."' name='nisn[]'>";
            }else{
                $sakit = "";
                $izin = "";
                $alpha = "";
                $input = "<input type='hidden' value='".$s['nisn']."' name='nisn[]'>";
            }
           
            array_push($result,array(
                'id_absensi' => $nilai->getRow('id_absensi'),
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
        $this->whereIn('id_absensi',$id);
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
        $result = $this->select('tb_absensi.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_absensi.nisn = tb_pesdik.nisn')
        ->getWhere(['id_absensi'=>$id])->getRow();
        return $result;
    }

    public function getDataAbsensiByNisn($nisn,$ta)
    {
       $result = $this->getWhere(["nisn" => $nisn, "kd_ta" => $ta])->getRow();
       return $result;
    }

    public function getSelectAbsensi($param)
    {
        $result = $this->select('id_absensi, username')
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
        $this->where('id_absensi', $id);
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
        $this->updateBatch($data, 'id_absensi');
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
        $check = $this->getWhere(['id_absensi' => $id])->getRow();
        if($check->status=='Aktif'){
            $this->transBegin();
            $this->userModel->nonaktifUserByKey($check->accesskey);
            $this->set('status','Non-Aktif');
            $this->where('id_absensi', $id);
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
            $this->where('id_absensi', $id);
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