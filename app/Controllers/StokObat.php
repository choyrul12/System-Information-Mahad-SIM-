<?php
namespace App\Controllers;
use App\Models\StokObatModel;

class StokObat extends BaseController{
    protected $stokObatModel;
    
    public function __construct()
    {
        $this->stokObatModel = new StokObatModel;
    }

    public function getDataStokObat()
    {
        $result = $this->stokObatModel->getDataStokObat();
        return $result;
    }

    public function insertStokObat()
    {
        if (!$this->validate([
            'nm_obat' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama obat tidak boleh kosong.']
            ],
            'jenis' => [
                'rules' => 'required',
                'errors' => ['required' => 'Jenis Obat tidak boleh kosong.']
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => ['required' => 'Stok tidak boleh kosong.']
            ],
            'satuan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Satuan tidak boleh kosong.']
            ],
        ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $data = [
                'nm_obat' => $this->request->getVar('nm_obat'),
                'jenis' => $this->request->getVar('jenis'),
                'stok' => $this->request->getVar('stok'),
                'satuan' => $this->request->getVar('satuan'),
                'unit' => session()->get('unit')
            ];
            if (empty($id)) {
                $result = $this->stokObatModel->insertDataStokObat($data);
            }else{
                $result = $this->stokObatModel->updateDataStokObat($id,$data);
            }
           
            return json_encode(array($result));
        }
    }

    public function deleteDataStokObat()
    {
        $id = $this->request->getVar('id');
        $result = $this->stokObatModel->deleteById($id);
        return json_encode(array($result));
    }

    public function getDataStokObatById()
    {
        $id = $this->request->getVar('id');
        $result = $this->stokObatModel->getDataStokObatById($id)->getRow();
        return json_encode($result);
    }
}