<?php 
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class NilaiEskulModel extends Model
{
    protected $table = 'tb_nilai_eskul';
    protected $primaryKey = 'id_nilai_eskul';
    protected $allowedFields = ['id_nilai_eskul', 'nisn', 'kd_mapel', 'id_kelas', 'id_rombel', 'kd_ta', 'eskul1', 'eskul2', 'eskul3', 'eskul4', 'nilai1', 'nilai2', 'nilai3', 'nilai4', 'nik_guru',  'last_update'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataNilaiEskul($data)
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

    public function getDataNilaiEskul($data)
    {   
        $result = array();
        $unit  = session()->get('unit'); 
        $eskul = $this->query("SELECT * FROM tb_eskul WHERE unit = '$unit'");
       
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        foreach($siswa->getResultArray() AS $s){
            $nilai = $this->query("SELECT *, COALESCE(nilai1, 0) AS nilai1, COALESCE(nilai2, 0) AS nilai2, COALESCE(nilai3,0) AS nilai3, COALESCE(nilai4,0) AS nilai4 FROM  tb_nilai_eskul WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]'");
            
            if($nilai->getNumRows() > 0){
                $nilai1 = $nilai->getRow('nilai1');
                $nilai2 = $nilai->getRow('nilai2');
                $nilai3 = $nilai->getRow('nilai3');
                $nilai4 = $nilai->getRow('nilai4');
                $option1 = $nilai->getRow('eskul1');
                $option2 = $nilai->getRow('eskul2');
                $option3 = $nilai->getRow('eskul3');
                $option4 = $nilai->getRow('eskul4');
                $input = "";
            }else{
                $nilai1 = "<input type='text' class='form-control' name='nilai1[]' size='2' placeholder='Nilai'>";
                $nilai2 = "<input type='text' class='form-control' name='nilai2[]' size='2' placeholder='Nilai'>";
                $nilai3 = "<input type='text' class='form-control' name='nilai3[]' size='2' placeholder='Nilai'>";
                $nilai4 = "<input type='text' class='form-control' name='nilai4[]' size='2' placeholder='Nilai'>";
                $option1 = "<select class='form-control' name='eskul1[]'><option value=''>PILIH ESKUL</option>";
                $option2 = "<select class='form-control' name='eskul2[]'><option value=''>PILIH ESKUL</option>";
                $option3 = "<select class='form-control' name='eskul3[]'><option value=''>PILIH ESKUL</option>";
                $option4 = "<select class='form-control' name='eskul4[]'><option value=''>PILIH ESKUL</option>";
                foreach($eskul->getResultArray() as $es){
                    $option1 .= "<option>".$es['nm_eskul']."</option>";
                    $option2 .= "<option>".$es['nm_eskul']."</option>";
                    $option3 .= "<option>".$es['nm_eskul']."</option>";
                    $option4 .= "<option>".$es['nm_eskul']."</option>";
                }
                $option1 .="</select>";
                $option2 .="</select>";
                $option3 .="</select>";
                $option4 .="</select>";
                $input = "<input type='hidden' value='".$s['nisn']."' name='nisn[]'>";
            }
           
            array_push($result,array(
                'id_nilai_eskul' => $nilai->getRow('id_nilai_eskul'),
                'nisn' => $s['nisn'],
                'nm_pesdik' => $s['nm_pesdik'],       
                'nilai1' => $nilai1,
                'nilai2' => $nilai2, 
                'nilai3' => $nilai3,     
                'nilai4' => $nilai4,  
                'eskul1' => $option1,
                'eskul2' => $option2,
                'eskul3' => $option3,
                'eskul4' => $option4,
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

    public function getDataNilaiEskulById($id)
    {
        $result = $this->select('tb_nilai_eskul.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_nilai_eskul.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_eskul'=>$id])->getRow();
        return $result;
    }

    public function getNilaiEskulByNisn($nisn,$ta)
    {
       $result = $this->getWhere(["nisn" => $nisn, "kd_ta" => $ta])->getRow();
       return $result;
    }

    public function getSelectNilaiEskul($param)
    {
        $result = $this->select('id_nilai_eskul, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataNilaiEskul($data)
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

    public function updateDataNilaiEskul($id,$data)
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

    public function updateKlsNilaiEskul($data)
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

    public function changeStatusNilaiEskul($id)
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