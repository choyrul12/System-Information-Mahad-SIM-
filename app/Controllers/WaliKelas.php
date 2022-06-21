<?php
namespace App\Controllers;
use App\Models\WaliKelasModel;
use App\Controllers\Administrator;

class WaliKelas extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->WaliKelasModel = new WaliKelasModel();
        $this->administrator = new Administrator();
    }

    public function getDataWaliKelas()
    {
        $ta = $this->request->getVar("ta");
        $result = $this->WaliKelasModel->getDataWaliKelas($ta);
        return json_encode($result);
    }

    public function getDataWaliKelasById()
    {
        $id = $this->request->getVar('id');
        $result = $this->WaliKelasModel->getDataWaliKelasById($id);
        return json_encode($result);
    }

    public function insertDataWaliKelas()
    {
        $id = $this->request->getVar('key');
        $validate = $this->validate([
            'nip_guru' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Wali kelas tidak boleh kosong.']
            ],
            'id_rombel' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Rombel tidak boleh kosong.']
            ],
            'kd_ta' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tahun akademik tidak boleh kosong.']
            ],
        ]);
        if (!$validate) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $data = [
                'nip_guru' => $this->request->getVar('nip_guru'),
                'id_rombel' => $this->request->getVar('id_rombel'),
                'kd_ta' => $this->request->getVar('kd_ta'),
            ];
            if (empty($id)) {
                $result = $this->WaliKelasModel->insertDataWaliKelas($data);
                return json_encode(array($result));
            }else{
                $result = $this->WaliKelasModel->updateDataWaliKelas($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function uploadDataWaliKelas()
    {
        if (!$this->validate([
            'import_WaliKelas' => 
                ['rules'  => 'uploaded[import_WaliKelas]|ext_in[import_WaliKelas,xls,xlsx]',
                    'errors' => [
                        'uploaded' => 'File tidak boleh kosong.',
                        'ext_in' => 'File Harus Berformat xls atau xlsx.'
                    ]
                ]
            ]))
        {   
            $validation = \Config\Services::validation();
            // return redirect()->to('/')->withInput()->with('validation',$validation);
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{

            $file_excel = $this->request->getFile('import_WaliKelas');
            $ext = $file_excel->getClientExtension();
            if ($ext=='xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else if($ext=='xlsx'){
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $ss = $render->load($file_excel);
            $data = $ss->getActiveSheet()->toArray(null, true, true ,true);
            $data_WaliKelas = array();
            foreach($data as $n => $row){
                if ($n<=3) {
                    continue;
                }
                array_push($data_WaliKelas,array(
                    "accesskey" => $row['B'],
                    "username" => $row['C'],
                    "password" => $row['D'],
                    "unit" => $row['E']
                ));
            }

            $result = $this->WaliKelasModel->uploadDataWaliKelas($data_WaliKelas);
            return json_encode(array($result));
        }
    }

    public function changeStatusWaliKelas()
    {
        $id = $this->request->getVar('id');
        $result = $this->WaliKelasModel->changeStatusWaliKelas($id);
        return json_encode(array($result));
    }

    public function deleteDataWaliKelas()
    {
        $id = $this->request->getVar('id');
        $result = $this->WaliKelasModel->deleteById($id);
        return json_encode(array($result));
    }
}