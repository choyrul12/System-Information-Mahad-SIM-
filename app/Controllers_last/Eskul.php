<?php
namespace App\Controllers;
use App\Models\EskulModel;

class Eskul extends BaseController{
    protected $EskulModel;
    
    public function __construct()
    {
        $this->EskulModel = new EskulModel;
    }

    public function getDataEskul()
    {
        $result = $this->EskulModel->getDataEskulByUnit();
        return $result;
    }

    public function insertDataEskul()
    {
        $validate = $this->validate([
            'nm_eskul' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama Eskul tidak boleh kosong.']
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
                'nm_eskul' => $this->request->getVar('nm_eskul'),
                'unit' => session()->get('unit')
            ];
            if (empty($id)) {
                $result = $this->EskulModel->insertDataEskul($data);
            }else{
                $result = $this->EskulModel->updateDataEskul($id,$data);
            }
            return json_encode(array($result));
        }
    }

    public function deleteDataEskul()
    {
        $id = $this->request->getVar('id');
        $result = $this->EskulModel->deleteById($id);
        return json_encode(array($result));
    }

    public function getDataEskulById()
    {
        $id = $this->request->getVar('id');
        $result = $this->EskulModel->getDataEskulById($id)->getRow();
        return json_encode($result);
    }
}