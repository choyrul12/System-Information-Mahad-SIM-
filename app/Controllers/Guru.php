<?php
namespace App\Controllers;
use App\Models\GuruModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Guru extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->guruModel = new GuruModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataGuru()
    {
        $result = $this->guruModel->getDataGuru();
        return $result;
    }

    public function getDataGuruById()
    {
        $id = $this->request->getVar('id');
        $result = $this->guruModel->getDataGuruById($id);
        return json_encode($result);
    }

    public function insertDataGuru()
    {
        $id = $this->request->getVar('key');
        if(empty($id)){
            $validate = $this->validate([
                'accesskey' => [
                    'rules'  => 'required',
                    'errors' => ['required' => 'NIP tidak boleh kosong.']
                ],
                'username' => [
                    'rules'  => 'required',
                    'errors' => ['required' => 'Nama guru tidak boleh kosong.']
                ],
                'password' => [
                    'rules'  => 'required',
                    'errors' => ['required' => 'Password tidak boleh kosong.']
                ],
            ]);
        }else{
            $validate = $this->validate([
                'accesskey' => [
                    'rules'  => 'required',
                    'errors' => ['required' => 'NIP tidak boleh kosong.']
                ],
                'username' => [
                    'rules'  => 'required',
                    'errors' => ['required' => 'Nama guru tidak boleh kosong.']
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
            $data = [
                'accesskey' => $this->request->getVar('accesskey'),
                'username' => $this->request->getVar('username'),
                'unit' => session()->get('unit'),
                'password' => md5($this->request->getVar('password')),
            ];
            if (empty($id)) {
                $result = $this->guruModel->insertDataGuru($data);
                return json_encode(array($result));
            }else{
                $result = $this->guruModel->updateDataGuru($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function uploadDataGuru()
    {
        if (!$this->validate([
            'import_guru' => 
                ['rules'  => 'uploaded[import_guru]|ext_in[import_guru,xls,xlsx]',
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

            $file_excel = $this->request->getFile('import_guru');
            $ext = $file_excel->getClientExtension();
            if ($ext=='xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else if($ext=='xlsx'){
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $ss = $render->load($file_excel);
            $data = $ss->getActiveSheet()->toArray(null, true, true ,true);
            $data_guru = array();
            foreach($data as $n => $row){
                if ($n<=3) {
                    continue;
                }
                array_push($data_guru,array(
                    "accesskey" => $row['B'],
                    "username" => $row['C'],
                    "password" => $row['D'],
                    "unit" => $row['E']
                ));
            }

            $result = $this->guruModel->uploadDataGuru($data_guru);
            return json_encode(array($result));
        }
    }

    public function changeStatusGuru()
    {
        $id = $this->request->getVar('id');
        $result = $this->guruModel->changeStatusGuru($id);
        return json_encode(array($result));
    }

    public function deleteDataGuru()
    {
        $id = $this->request->getVar('id');
        $result = $this->guruModel->deleteById($id);
        return json_encode(array($result));
    }
}