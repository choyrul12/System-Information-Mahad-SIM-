<?php 
namespace App\Models;
use CodeIgniter\Model;
use Irsyadulibad\DataTables\DataTables;

class LedgerModel extends Model
{
    public function uploadDataLedger($data)
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

    public function getDataLedger($data)
    {   
        $result = array();
        $siswa = $this->query("SELECT nisn, nm_pesdik FROM tb_pesdik WHERE rombel = $data[id_rombel]");
        $mapel = $this->query("SELECT kd_mapel FROM tb_mapel WHERE kls_mapel = $data[id_kelas]");
        foreach($siswa->getResultArray() AS $s){
            foreach($mapel->getResultArray() AS $m){
                $nilai = $this->query("SELECT id_nilai_mapel, nisn, COALESCE(ph, 0) AS ph, COALESCE(pts, 0) AS pts, COALESCE(pat,0) AS pat, COALESCE(na,0) AS na, COALESCE(keterampilan,0) AS keterampilan FROM  tb_nilai_mapel WHERE nisn = $s[nisn] AND kd_ta = '$data[kd_ta]' AND kd_mapel= $m[kd_mapel]");
                
                array_push($result,array(
                    'nisn' => $nilai->getRow('nisn'),
                    'na' => $nilai->getRow('na')
                ));
            }
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

    public function getDataLedgerById($id)
    {
        $result = $this->select('tb_ledger.*, tb_pesdik.nm_pesdik')
        ->join('tb_pesdik', 'tb_ledger.nisn = tb_pesdik.nisn')
        ->getWhere(['id_nilai_mapel'=>$id])->getRow();
        return $result;
    }

    public function getSelectLedger($param)
    {
        $result = $this->select('id_nilai_mapel, username')
        ->like('username', $param)
        ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataLedger($data)
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

    public function updateDataLedger($id,$data)
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

    public function updateKlsLedger($data)
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

    public function changeStatusLedger($id)
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