<?php
namespace App\Controllers;
use App\Models\GradeModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Grade extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->GradeModel = new GradeModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataGrade()
    {
        $result = $this->GradeModel->getDataGrade();
        return $result;
    }

    public function getDataGradeById()
    {
        $id = $this->request->getVar("id");
        $result = $this->GradeModel->getDataGradeById($id);
        return json_encode($result);
    }

    public function insertDataGrade()
    {
        if (!$this->validate([
            'grade' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Grade tidak boleh kosong.']
            ],
            'min' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nilai Min tidak boleh kosong.']
            ],
            'max' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nilai Max tidak boleh kosong.']
            ],
            ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $grade = $this->request->getVar('grade');
            $min = $this->request->getVar('min');
            $max = $this->request->getVar('max');
            $unit = session()->get('unit');
            $data = [
                'grade' => $grade,
                'min' => $min,
                'max' => $max,
                'unit' => $unit,
            ];
            if (empty($id)) {
                $result = $this->GradeModel->insertDataGrade($data);
                return json_encode(array($result));
            }else{
                $result = $this->GradeModel->updateDataGrade($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusGrade()
    {
        $id = $this->request->getVar('id');
        $result = $this->GradeModel->changeStatusGrade($id);
        return json_encode(array($result));
    }

    public function deleteDataGrade()
    {
        $id = $this->request->getVar('id');
        $result = $this->GradeModel->deleteById($id);
        return json_encode(array($result));
    }
    
    public function getKkmById()
    {
        $id = $this->request->getVar('id');
        $result = $this->GradeModel->getKkmById($id);
        return json_encode($result);
    }

    public function updateDataKkm()
    {
        if (!$this->validate([
            'standard' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Standard tidak boleh kosong.']
            ],
            ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('id_kkm');
            $standard = $this->request->getVar('standard');
            $unit = session()->get('unit');
            $data = [
                'id_kkm' => $id,
                'standard' => $standard,
                'unit' => $unit,
            ];
            $result = $this->GradeModel->updateDataKkm($data);
            return json_encode(array($result));
        }
    }
}