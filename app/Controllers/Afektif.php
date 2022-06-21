<?php

namespace App\Controllers;

use App\Models\AfektifModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Afektif extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->AfektifModel = new AfektifModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataAfektif()
    {
        $result = $this->AfektifModel->getDataAfektif();
        return $result;
    }

    public function getDataAfektifById()
    {
        $id = $this->request->getVar("id");
        $result = $this->AfektifModel->getDataAfektifById($id);
        return json_encode($result);
    }

    public function getDataAfektifByKelas()
    {
        $kelas = $this->request->getVar("id_kelas");
        $result = $this->AfektifModel->getDataAfektifByKelas($kelas);
        return json_encode($result);
    }

    public function insertDataAfektif()
    {
        if (!$this->validate([
            'kategori' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Kategori tidak boleh kosong.']
            ],
            'predikat' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Predikat tidak boleh kosong.']
            ],
            'deskripsi' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Deskripsi tidak boleh kosong.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {
            $id = $this->request->getVar('key');
            $kelas = $this->request->getVar('kelas');
            $predikat = $this->request->getVar('predikat');
            $deskripsi = $this->request->getVar('deskripsi');
            $unit = session()->get('unit');
            $data = [
                'predikat' => $predikat,
                'deskripsi' => $deskripsi,
                'unit' => $unit,
            ];
            if (empty($id)) {
                $result = $this->AfektifModel->insertDataAfektif($data);
                return json_encode(array($result));
            } else {
                $result = $this->AfektifModel->updateDataAfektif($id, $data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusAfektif()
    {
        $id = $this->request->getVar('id');
        $result = $this->AfektifModel->changeStatusAfektif($id);
        return json_encode(array($result));
    }

    public function deleteDataAfektif()
    {
        $id = $this->request->getVar('id');
        $result = $this->AfektifModel->deleteById($id);
        return json_encode(array($result));
    }

    public function getKkmById()
    {
        $id = $this->request->getVar('id');
        $result = $this->AfektifModel->getKkmById($id);
        return json_encode($result);
    }

    public function updateDataKkm()
    {
        if (!$this->validate([
            'standard' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Standard tidak boleh kosong.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {
            $id = $this->request->getVar('id_kkm');
            $standard = $this->request->getVar('standard');
            $unit = session()->get('unit');
            $data = [
                'id_kkm' => $id,
                'standard' => $standard,
                'unit' => $unit,
            ];
            $result = $this->AfektifModel->updateDataKkm($data);
            return json_encode(array($result));
        }
    }
}
