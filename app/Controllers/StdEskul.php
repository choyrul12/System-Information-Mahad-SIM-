<?php
namespace App\Controllers;
use App\Models\StdEskulModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class StdEskul extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->StdEskulModel = new StdEskulModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataStdEskul()
    {
        $result = $this->StdEskulModel->getDataStdEskul();
        return $result;
    }

    public function getDataStdEskulById()
    {
        $id = $this->request->getVar("id");
        $result = $this->StdEskulModel->getDataStdEskulById($id);
        return json_encode($result);
    }

    public function insertDataStdEskul()
    {
        if (!$this->validate([
            'grade' => [
                'rules'  => 'required',
                'errors' => ['required' => 'grade tidak boleh kosong.']
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
                $result = $this->StdEskulModel->insertDataStdEskul($data);
                return json_encode(array($result));
            }else{
                $result = $this->StdEskulModel->updateDataStdEskul($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusStdEskul()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdEskulModel->changeStatusStdEskul($id);
        return json_encode(array($result));
    }

    public function deleteDataStdEskul()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdEskulModel->deleteById($id);
        return json_encode(array($result));
    }
    
    public function getKkmById()
    {
        $id = $this->request->getVar('id');
        $result = $this->StdEskulModel->getKkmById($id);
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
            $result = $this->StdEskulModel->updateDataKkm($data);
            return json_encode(array($result));
        }
    }
}