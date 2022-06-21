<?php
namespace App\Controllers;
use App\Models\StdPengetahuanModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class StdPengetahuan extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->StdPengetahuanModel = new StdPengetahuanModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataStdPengetahuan()
    {
        $kd_kelas = $this->request->getVar('kd_kelas');
        $kd_mapel = $this->request->getVar('kd_mapel');
        $result = $this->StdPengetahuanModel->getDataStdPengetahuan($kd_kelas,$kd_mapel);
        return json_encode($result);
    }

    public function getDataStdPengetahuanById()
    {
        $id = $this->request->getVar("id");
        $result = $this->StdPengetahuanModel->getDataStdPengetahuanById($id);
        return json_encode($result);
    }

    public function insertDataStdPengetahuan()
    {
        if (!$this->validate([
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
            ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $kelas = $this->request->getVar('kelas');
            $mapel = $this->request->getVar('mapel');
            $gradeA = $this->request->getVar('grade_a');
            $gradeB = $this->request->getVar('grade_b');
            $gradeC = $this->request->getVar('grade_c');
            $gradeD = $this->request->getVar('grade_d');
            $data = array(
                "kd_kelas" => $kelas,
                "kd_mapel" => $mapel,
                "grade_a" => $gradeA,
                "grade_b" => $gradeB,
                "grade_c" => $gradeC,
                "grade_d" => $gradeD,
            );

            if (empty($id)) {
                $result = $this->StdPengetahuanModel->insertDataStdPengetahuan($data);
                return json_encode(array($result));
            }else{
                $result = $this->StdPengetahuanModel->updateDataStdPengetahuan($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusStdPengetahuan()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdPengetahuanModel->changeStatusStdPengetahuan($id);
        return json_encode(array($result));
    }

    public function deleteDataStdPengetahuan()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdPengetahuanModel->deleteById($id);
        return json_encode(array($result));
    }
}