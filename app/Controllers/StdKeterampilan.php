<?php

namespace App\Controllers;

use App\Models\StdKeterampilanModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class StdKeterampilan extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->StdKeterampilanModel = new StdKeterampilanModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataStdKeterampilan()
    {
        $kd_ta = $this->request->getVar('kd_ta');
        $kd_kelas = $this->request->getVar('kd_kelas');
        $kd_mapel = $this->request->getVar('kd_mapel');
        $result = $this->StdKeterampilanModel->getDataStdKeterampilan($kd_kelas, $kd_mapel, $kd_ta);
        return json_encode($result);
    }

    public function getDataStdKeterampilanById()
    {
        $id = $this->request->getVar("id");
        $result = $this->StdKeterampilanModel->getDataStdKeterampilanById($id);
        return json_encode($result);
    }

    public function insertDataStdKeterampilan()
    {
        if (!$this->validate([
            'ta' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tahun akademik tidak boleh kosong.']
            ],
            'kelas' => [
                'rules'  => 'required',
                'errors' => ['required' => 'kelas tidak boleh kosong.']
            ],
            'mapel' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Mapel tidak boleh kosong.']
            ],
            'grade_a' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Grade A tidak boleh kosong.']
            ],
            'grade_b' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Grade B tidak boleh kosong.']
            ],
            'grade_c' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Grade C tidak boleh kosong.']
            ],
            'grade_d' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Grade D tidak boleh kosong.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {
            $id = $this->request->getVar('key');
            $kd_ta = $this->request->getVar('ta');
            $kelas = $this->request->getVar('kelas');
            $mapel = $this->request->getVar('mapel');
            $gradeA = $this->request->getVar('grade_a');
            $gradeB = $this->request->getVar('grade_b');
            $gradeC = $this->request->getVar('grade_c');
            $gradeD = $this->request->getVar('grade_d');
            $data = array(
                "kd_ta" => $kd_ta,
                "kd_kelas" => $kelas,
                "kd_mapel" => $mapel,
                "grade_a" => $gradeA,
                "grade_b" => $gradeB,
                "grade_c" => $gradeC,
                "grade_d" => $gradeD,
            );

            if (empty($id)) {
                $result = $this->StdKeterampilanModel->insertDataStdKeterampilan($data);
                return json_encode(array($result));
            } else {
                $result = $this->StdKeterampilanModel->updateDataStdKeterampilan($id, $data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusStdKeterampilan()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdKeterampilanModel->changeStatusStdKeterampilan($id);
        return json_encode(array($result));
    }

    public function deleteDataStdKeterampilan()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdKeterampilanModel->deleteById($id);
        return json_encode(array($result));
    }
}
