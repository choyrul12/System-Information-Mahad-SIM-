<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class StdKeterampilanModel extends Model
{
    protected $table = 'tb_std_keterampilan';
    protected $primaryKey = 'kd_std_keterampilan';
    protected $allowedFields = ['kd_std_keterampilan', 'kd_ta', 'kd_kelas', 'kd_mapel', 'grade_a', 'grade_b', 'grade_c', 'grade_d'];
    protected $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function getDataStdKeterampilan($kd_kelas, $kd_mapel, $kd_ta)
    {
        $result = $this->getWhere(['kd_kelas' => $kd_kelas, 'kd_mapel' => $kd_mapel, 'kd_ta' => $kd_ta])->getResultArray();
        return $result;
    }

    public function insertDataStdKeterampilan($data)
    {
        $this->transBegin();
        $this->insert($data);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Input";
        } else {
            $this->transCommit();
            return "Success Input";
        }
    }


    public function getDataStdKeterampilanById($id)
    {
        $result = $this->getWhere(['kd_std_keterampilan' => $id])->getRow();
        return $result;
    }

    public function deleteById($id)
    {
        $this->transBegin();
        $this->delete(['kd_std_keterampilan' => $id]);
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Delete";
        } else {
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function updateDataStdKeterampilan($id, $data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('kd_std_keterampilan', $id);
        $this->update();
        if ($this->transStatus() === FALSE) {
            $this->transRollback();
            return "Failed Update";
        } else {
            $this->transCommit();
            return "Success Update";
        }
    }

    public function getDeskripsiByMapel($mapel)
    {
        $result = $this->getWhere(['kd_mapel' => $mapel])->getRow();
        return $result;
    }
}
