<?php
namespace App\Controllers;
use App\Models\LedgerModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Ledger extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->LedgerModel = new LedgerModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataLedger()
    {
        $data['id_kelas']  = $this->request->getVar('id_kelas');
        $data['id_rombel'] = $this->request->getVar('id_rombel');
        $data['kd_ta']  = $this->request->getVar('ta');
        $result = $this->LedgerModel->getDataLedger($data);
        return json_encode($result);
    }

    public function getDataLedgerById()
    {
        $id = $this->request->getVar('id');
        $result = $this->LedgerModel->getDataLedgerById($id);
        return json_encode($result);
    }

    public function insertDataLedger()
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
                    'errors' => ['required' => 'Nama Ledger tidak boleh kosong.']
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
                    'errors' => ['required' => 'Nama Ledger tidak boleh kosong.']
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
                $result = $this->LedgerModel->insertDataLedger($data);
                return json_encode(array($result));
            }else{
                $result = $this->LedgerModel->updateDataLedger($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function updateDataLedger()
    {
        $key = $this->request->getVar('key');
        $data['ph']  = $this->request->getVar('ph');
        $data['pts'] = $this->request->getVar('pts');
        $data['pat'] = $this->request->getVar('pat');
        $data['keterampilan'] = $this->request->getVar('keterampilan');
        $data['na'] = (($data['ph']*0.5)+($data['pts']*0.2)+($data['pat']*0.3));

        $result = $this->LedgerModel->updateDataLedger($key,$data);
        return json_encode(array($result));
    }

    public function uploadDataLedger()
    {
        if (!$this->validate([
            'import_nilai' => 
                ['rules'  => 'uploaded[import_nilai]|ext_in[import_nilai,xls,xlsx]',
                    'errors' => [
                        'uploaded' => 'File tidak boleh kosong.',
                        'ext_in' => 'File Harus Berformat xls atau xlsx.'
                    ]
                ],
            'ta' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Tahun akademik tidak boleh kosong.',
                    ]
                ],
            'kelas' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Kelas tidak boleh kosong.',
                    ]
                ],
            'rombel' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Rombel tidak boleh kosong.',
                    ]
                ],
            'mapel' => 
                ['mapel'  => 'required',
                    'errors' => [
                        'required' => 'Mapel tidak boleh kosong.',
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

            $file_excel = $this->request->getFile('import_nilai');
            $ext = $file_excel->getClientExtension();
            if ($ext=='xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            }else if($ext=='xlsx'){
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $ss = $render->load($file_excel);
            $data = $ss->getActiveSheet()->toArray(null, true, true ,true);
            $data_nilai = array();
            foreach($data as $n => $row){
                if ($n<3) {
                    continue;
                }
                if($row['G']==0){
                    $na = (($row['D']*0.5)+($row['E']*0.2)+($row['F']*0.3));
                }else{
                    $na = $row['G'];
                }
                array_push($data_nilai,array(
                    "nisn" => str_replace("'","",$row['B']),
                    "kd_mapel" => $this->request->getVar('mapel'),
                    "id_kelas" => $this->request->getVar('kelas'),
                    "id_rombel" => $this->request->getVar('rombel'),
                    "kd_ta" => $this->request->getVar('ta'),
                    "ph" => $row['D'],
                    "pts" => $row['E'],
                    "pat" => $row['F'],
                    "na" => $na,
                    "keterampilan" => $row['H'],
                    "nik_guru" => session()->get('accesskey'),
                ));
            }

            $result = $this->LedgerModel->uploadDataLedger($data_nilai);
            return json_encode(array($result));
        }
    }

    public function changeStatusLedger()
    {
        $id = $this->request->getVar('id');
        $result = $this->LedgerModel->changeStatusLedger($id);
        return json_encode(array($result));
    }

    public function deleteDataLedger()
    {
        $id = $this->request->getVar('id_nilai');
        $result = $this->LedgerModel->deleteById($id);
        return json_encode(array($result));
    }
}