<?php
namespace App\Controllers;
use App\Models\RekamMedisModel;
use App\Controllers\Administrator;
 
class RekamMedis extends BaseController
{
    protected $rekamMedisModel;
    protected $administrator;
    public function __construct()
    {
        $this->rekamMedisModel = new RekamMedisModel;
        $this->administrator = new Administrator;
    }

    public function getDataRekamMedis()
    {
        $m = $this->request->getVar('m');
        
        if (empty($m)) {
            $month = date("Ym");
        }else{
            $month = date('Ym',strtotime($m));
        }
        $result = $this->rekamMedisModel->getDataRekamMedisByMonth($month);
        return $result;
    }

    public function insertRekamMedis()
    {
        if (!$this->validate([
            'id_pesdik' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama pesdik tidak boleh kosong.']
            ],
            'tgl_periksa' => [
                'rules' => 'required',
                'errors' => ['required' => 'Tanggal periksa tidak boleh kosong.']
            ],
            'petugas' => [
                'rules' => 'required',
                'errors' => ['required' => 'Nama petugas tidak boleh kosong.']
            ],
            'anamnesa' => [
                'rules' => 'required',
                'errors' => ['required' => 'Anamnesa tidak boleh kosong.']
            ],
            'diagnosis' => [
                'rules' => 'required',
                'errors' => ['required' => 'Diagnosis tidak boleh kosong.']
            ],
            'penanganan' => [
                'rules' => 'required',
                'errors' => ['required' => 'Penanganan tidak boleh kosong.']
            ],
            'status' => [
                'rules' => 'required',
                'errors' => ['required' => 'Status tidak boleh kosong.']
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
                'id_pesdik' => $this->request->getVar('id_pesdik'),
                'tgl_periksa' => $this->request->getVar('tgl_periksa'),
                'anamnesa' => $this->request->getVar('anamnesa'),
                'diagnosis' => $this->request->getVar('diagnosis'),
                'penanganan' => $this->request->getVar('penanganan'),
                'obat' => $this->request->getVar('obat'),
                'note' => $this->request->getVar('note'),
                'petugas' => $this->request->getVar('petugas'),
                'status' => $this->request->getVar('status'),
                'penyakit_dahulu' => $this->request->getVar('penyakit_dahulu'),
                'pemeriksaan_fisik' => $this->request->getVar('pemeriksaan_fisik'),
                'riwayat_keluarga' => $this->request->getVar('riwayat_keluarga'),
                'alergi' => $this->request->getVar('alergi'),
            ]; 

            if (empty($id)) {
                $result = $this->rekamMedisModel->insertDataRekamMedis($data);
            }else{
                $result = $this->rekamMedisModel->updateDataRekamMedis($id,$data);
            }
            return json_encode(array($result));
        }
    }

    public function deleteDataRekamMedis()
    {
        if ($this->administrator->isLogin()) {
            $id = $this->request->getVar('id');
            $result = $this->rekamMedisModel->deleteById($id);
            return json_encode(array($result));
        }else{
            return redirect()->to('/');
        }
    }

    public function getDataRekamMedisById()
    {
        $id = $this->request->getVar('id');
        $result = $this->rekamMedisModel->getDataRekamMedisById($id)->getRow();
        return json_encode($result);
    }

    public function getGrafikRekamMedis()
    {
        $result = $this->rekamMedisModel->getGrafikRekamMedis();
        return json_encode($result);
    }
}