<?php
namespace App\Controllers;
use App\Models\MapelModel;

class Mapel extends BaseController{
    protected $mapelModel;
    
    public function __construct()
    {
        $this->mapelModel = new MapelModel;
    }

    public function getDataMapel()
    {
        $result = $this->mapelModel->getDataMapelByUnit();
        return $result;
    }

    public function getListMapel()
    {
        $kls = $this->request->getVar('id_kelas');
        $result = $this->mapelModel->getListMapel($kls);
        return $result;
    }

    public function insertMapel()
    {
        if(empty($this->request->getVar('key'))){
            $validate = $this->validate([
                'kls_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Kelas tidak boleh kosong.']
                ],
                'kelompok_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Kelompok tidak boleh kosong.']
                ],
                'urutan_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Urutan tidak boleh kosong.']
                ],
            ]);
        }else{
            $validate = $this->validate([
                'kd_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Kode Mapel tidak boleh kosong.',]
                ],
                'kls_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Kelas tidak boleh kosong.']
                ],
                'kelompok_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Kelompok tidak boleh kosong.']
                ],
                'urutan_mapel' => [
                    'rules' => 'required',
                    'errors' => ['required' => 'Urutan tidak boleh kosong.']
                ],
            ]);
        }
        if (!$validate) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $data = [
                'kd_mapel' => $this->request->getVar('kd_mapel'),
                'nm_mapel' => $this->request->getVar('nm_mapel'),
                'nm_mapel_ing' => $this->request->getVar('nm_mapel_ing'),
                'kls_mapel' => $this->request->getVar('kls_mapel'),
                'kelompok_mapel' => $this->request->getVar('kelompok_mapel'),
                'urutan_mapel' => $this->request->getVar('urutan_mapel'),
                'unit' => session()->get('unit')
            ];
            if (empty($id)) {
                $result = $this->mapelModel->insertDataMapel($data);
            }else{
                $result = $this->mapelModel->updateDataMapel($id,$data);
            }
           
            return json_encode(array($result));
        }
    }

    public function deleteDataMapel()
    {
        $id = $this->request->getVar('id');
        $result = $this->mapelModel->deleteById($id);
        return json_encode(array($result));
    }

    public function getDataMapelById()
    {
        $id = $this->request->getVar('id');
        $result = $this->mapelModel->getDataMapelById($id)->getRow();
        return json_encode($result);
    }

    public function getDataMapelByKls()
    {
        $id = $this->request->getVar('id');
        $result = $this->mapelModel->getDataMapelByKls($id)->getResultArray();
        return json_encode($result);
    }
}