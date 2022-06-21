<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class PesdikModel extends Model
{
    protected $table = 'tb_pesdik';
    protected $primaryKey = 'id_pesdik';
    protected $allowedFields = ['nm_pesdik', 'jk', 'nik', 'nipd', 'nisn', 'tpt_lahir', 'tgl_lahir', 'agama', 'alamat', 'rt', 'rw', 'dusun', 'kelurahan', 'kecamatan', 'kd_pos', 'nm_ayah', 'thn_lahir_ayah', 'pendidikan_ayah', 'pekerjaan_ayah', 'penghasilan_wali', 'nik_ayah', 'nm_ibu', 'thn_lahir_ibu', 'pendidikan_ibu', 'pekerjaan_ibu', 'penghasilan_wali', 'nik_ibu', 'nm_wali', 'thn_lahir_wali', 'pendidikan_wali', 'pekerjaan_wali', 'penghasilan_wali', 'nik_wali', 'no_tlp', 'no_hp', 'email', 'sekolah_asal', 'no_kk', 'no_akte', 'no_ijazah', 'skhun', 'jml_saudara', 'anak_ke', 'kelas', 'rombel', 'jurusan', 'unit', 'status'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function uploadDataPesdik($data)
    {
        $this->transBegin();
        $this->insertBatch($data);
        $this->userModel->createUserPesdik($data);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Input";
        } else {
            $this->transCommit();
            return "Success Input";
        }
    }

    public function getDataPesdik()
    {
        if (session()->get('level') == '1') {
            return DataTables::use($this->table)
                ->join('tb_user', 'tb_pesdik.nisn = tb_user.nisn', 'INNER JOIN')
                ->where(['tb_pesdik.status' => 'Aktif'])
                ->orderBy('tb_pesdik.kelas', 'ASC')
                ->make(true);
        } else {
            $unit = session()->get('unit');
            return DataTables::use($this->table)
                ->select('tb_pesdik.*, tb_kelas.romawi AS romawi, tb_rombel.nm_rombel AS rombel')
                ->join('tb_user', 'tb_pesdik.nisn = tb_user.accesskey', 'LEFT JOIN')
                ->join('tb_kelas', 'tb_kelas.id_kelas = tb_pesdik.kelas', 'INNER JOIN')
                ->join('tb_rombel', 'tb_rombel.id_rombel = tb_pesdik.rombel', 'INNER JOIN')
                ->where(['tb_pesdik.status' => 'Aktif', 'tb_user.status' => 'Aktif', 'tb_pesdik.unit' => $unit])
                ->orderBy('tb_pesdik.kelas', 'ASC')
                ->make(true);
        }
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->set('status', 'Non-Aktif');
        $this->where('id_pesdik', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Delete";
        } else {
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getCountPesdik()
    {
        $unit = session()->get('unit');
        $result = $this->join('tb_user', 'tb_user.accesskey = tb_pesdik.nisn')
            ->getWhere(['tb_pesdik.status' => 'Aktif', 'unit' => $unit])->getNumRows();
        return $result;
    }

    public function getDataPesdikById($id)
    {
        $result = $this->getWhere(['id_pesdik' => $id]);
        return $result;
    }

    public function getListPesdik($kls)
    {
        $result = $this->orderBy('nm_pesdik ASC')->getWhere(['rombel' => $kls]);
        return $result;
    }

    public function getSelectPesdik($param)
    {
        $result = $this->select('id_pesdik, nm_pesdik')
            ->like('nm_pesdik', $param)
            ->getWhere(['status' => 'Aktif']);
        return $result;
    }

    public function insertDataPesdik($data)
    {
        $this->transBegin();
        $this->userModel->createSingleUserPesdik($data);
        $this->insert($data);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Input";
        } else {
            $this->transCommit();
            return "Success Input";
        }
    }

    public function updateDataPesdik($id, $data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_pesdik', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        } else {
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updateKlsPesdik($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'id_pesdik');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        } else {
            $this->transCommit();
            return "Success Update";
        }
    }

    public function updatePesdikLulus($data)
    {
        $this->transBegin();
        $this->updateBatch($data, 'nisn');
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        } else {
            $this->transCommit();
            return "Success Update";
        }
    }
}
