<?php
namespace App\Controllers;
use App\Models\NilaiBulananModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class NilaiBulanan extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->NilaiBulananModel = new NilaiBulananModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataNilaiBulanan()
    {
        $data['id_kelas']  = $this->request->getVar('id_kelas');
        $data['id_rombel'] = $this->request->getVar('id_rombel');
        $data['id_mapel']  = $this->request->getVar('id_mapel');
        $data['kd_ta']  = $this->request->getVar('ta');
        $data['bulan']  = $this->request->getVar('bulan');
        $result = $this->NilaiBulananModel->getDataNilaiBulanan($data);
        return json_encode($result);
    }

    public function getDataNilaiBulananById()
    {
        $id = $this->request->getVar('id');
        $result = $this->NilaiBulananModel->getDataNilaiBulananById($id);
        return json_encode($result);
    }

    public function updateDataNilaiBulanan()
    {
        $key = $this->request->getVar('key');
        $data['score'] = $this->request->getVar('score');
        $result = $this->NilaiBulananModel->updateDataNilaiBulanan($key,$data);
        return json_encode(array($result));
    }

    public function uploadDataNilaiBulanan()
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
                if ($n<2) {
                    continue;
                }
                array_push($data_nilai,array(
                    "nisn" => str_replace("'","",$row['B']),
                    "kd_mapel" => $this->request->getVar('mapel'),
                    "id_kelas" => $this->request->getVar('kelas'),
                    "id_rombel" => $this->request->getVar('rombel'),
                    "bulan" => $this->request->getVar('bulan'),
                    "kd_ta" => $this->request->getVar('ta'),
                    "score" => str_replace(",",".",$row['D']),
                    "nik_guru" => session()->get('accesskey'),
                ));
            }

            $result = $this->NilaiBulananModel->uploadDataNilaiBulanan($data_nilai);
            return json_encode(array($result));
        }
    }

    public function changeStatusNilaiBulanan()
    {
        $id = $this->request->getVar('id');
        $result = $this->NilaiBulananModel->changeStatusNilaiBulanan($id);
        return json_encode(array($result));
    }

    public function deleteDataNilaiBulanan()
    {
        $id = $this->request->getVar('id_nilai');
        $result = $this->NilaiBulananModel->deleteById($id);
        return json_encode(array($result));
    }
}