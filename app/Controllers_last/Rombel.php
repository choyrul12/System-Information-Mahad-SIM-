<?php
namespace App\Controllers;
use App\Models\RombelModel;

class Rombel extends BaseController{
    protected $RombelModel;
    
    public function __construct()
    {
        $this->RombelModel = new RombelModel;
    }

    public function getDataRombel()
    {
        $result = $this->RombelModel->getDataRombelByUnit();
        return $result;
    }

    public function insertRombel()
    {
        $validate = $this->validate([
            'id_kelas' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kelas tidak boleh kosong.']
            ],
            'nm_rombel' => [
                'rules' => 'required',
                'errors' => ['required' => 'Rombel tidak boleh kosong.']
            ],
        ]);
        if (!$validate) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $data = [
                'id_kelas' => $this->request->getVar('id_kelas'),
                'nm_rombel' => $this->request->getVar('nm_rombel'),
                'unit' => session()->get('unit')
            ];
            if (empty($id)) {
                $result = $this->RombelModel->insertDataRombel($data);
            }else{
                $result = $this->RombelModel->updateDataRombel($id,$data);
            }
           
            return json_encode(array($result));
        }
    }

    public function deleteDataRombel()
    {
        $id = $this->request->getVar('id');
        $result = $this->RombelModel->deleteById($id);
        return json_encode(array($result));
    }

    public function getDataRombelById()
    {
        $id = $this->request->getVar('id');
        $result = $this->RombelModel->getDataRombelById($id)->getRow();
        return json_encode($result);
    }

    public function getDataSelectRombel()
    {
        $id = $this->request->getVar('id');
        $result = $this->RombelModel->getDataSelectRombel($id);
        return json_encode($result);
    }

    public function getDataRombelByKls()
    {
        $id = $this->request->getVar('id');
        $result = $this->RombelModel->getDataSelectRombel($id);
        return json_encode($result);
    }
}