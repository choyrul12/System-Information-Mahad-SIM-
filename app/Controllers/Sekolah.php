<?php
namespace App\Controllers;
use App\Models\SekolahModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Sekolah extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->SekolahModel = new SekolahModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataSekolah()
    {
        $result = $this->SekolahModel->getDataSekolah();
        return $result;
    }

    public function getDataSekolahById()
    {
        $id = $this->request->getVar("id");
        $result = $this->SekolahModel->getDataSekolahById($id);
        return json_encode($result);
    }

    public function insertDataSekolah()
    {
        if (!$this->validate([
            'nm_sekolah' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nama Sekolah tidak boleh kosong.']
            ],
            'nm_kepsek' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nama Kepsek tidak boleh kosong.']
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Alamat tidak boleh kosong.']
            ],
            ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $nm_sekolah = $this->request->getVar('nm_sekolah');
            $nm_kepsek = $this->request->getVar('nm_kepsek');
            $alamat = $this->request->getVar('alamat');
            $unit = session()->get('unit');
            $data = [
                'nm_sekolah' => $nm_sekolah,
                'nm_kepsek' => $nm_kepsek,
                'alamat' => $alamat,
                'unit' => $unit,
            ];
            if (empty($id)) {
                $result = $this->SekolahModel->insertDataSekolah($data);
                return json_encode(array($result));
            }else{
                $result = $this->SekolahModel->updateDataSekolah($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusSekolah()
    {
        $id = $this->request->getVar('id');
        $result = $this->SekolahModel->changeStatusSekolah($id);
        return json_encode(array($result));
    }

    public function deleteDataSekolah()
    {
        $id = $this->request->getVar('id');
        $result = $this->SekolahModel->deleteById($id);
        return json_encode(array($result));
    }
    
    public function getKkmById()
    {
        $id = $this->request->getVar('id');
        $result = $this->SekolahModel->getKkmById($id);
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
            $result = $this->SekolahModel->updateDataKkm($data);
            return json_encode(array($result));
        }
    }
}