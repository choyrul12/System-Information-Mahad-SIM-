<?php
namespace App\Controllers;
use App\Models\RaporSemesterModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class RaporSemester extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->RaporSemesterModel = new RaporSemesterModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataRaporSemester()
    {
        $data['id_kelas']  = $this->request->getVar('id_kelas');
        $data['id_rombel'] = $this->request->getVar('id_rombel');
        $data['kd_ta']  = $this->request->getVar('ta');
        $result = $this->RaporSemesterModel->getDataRaporSemester($data);
        return json_encode($result);
    }

    public function getDataRaporSemesterById()
    {
        $id = $this->request->getVar('id');
        $result = $this->RaporSemesterModel->getDataRaporSemesterById($id);
        return json_encode($result);
    }

    public function updateDataRaporSemester()
    {
        $key = $this->request->getVar('key');
        $data['score'] = $this->request->getVar('score');
        $result = $this->RaporSemesterModel->updateDataRaporSemester($key,$data);
        return json_encode(array($result));
    }

    public function uploadDataRaporSemester()
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
                    "score" => $row['D'],
                    "nik_guru" => session()->get('accesskey'),
                ));
            }

            $result = $this->RaporSemesterModel->uploadDataRaporSemester($data_nilai);
            return json_encode(array($result));
        }
    }

    public function changeStatusRaporSemester()
    {
        $id = $this->request->getVar('id');
        $result = $this->RaporSemesterModel->changeStatusRaporSemester($id);
        return json_encode(array($result));
    }

    public function deleteDataRaporSemester()
    {
        $id = $this->request->getVar('id_nilai');
        $result = $this->RaporSemesterModel->deleteById($id);
        return json_encode(array($result));
    }

    public function checkStatusRaporSemester()
    {
        $data["kd_mapel"] = $this->request->getVar('mapel');
        $data["id_kelas"] = $this->request->getVar('kelas');
        $data["id_rombel"] = $this->request->getVar('id_rombel');
        $data["bulan"] = $this->request->getVar('bulan');
        $data["kd_ta"] = $this->request->getVar('ta');
        $result = $this->RaporSemesterModel->checkStatusRaporSemester($data)->getNumRows();
        if($result>0){
            return json_encode(array("status"=>"SUDAH TERBIT"));
        }else{
            return json_encode(array("status"=>"BELUM TERBIT"));
        }
       
    }

    public function getAttrRaporSemester()
    {
        $data["kd_mapel"] = $this->request->getVar('mapel');
        $data["id_kelas"] = $this->request->getVar('kelas');
        $data["id_rombel"] = $this->request->getVar('id_rombel');
        $data["kd_ta"] = $this->request->getVar('ta');
        $result = $this->RaporSemesterModel->checkStatusRaporSemester($data)->getRow();
        return json_encode($result);
       
    }

    public function terbitkanRaporSemester()
    {
        if (!$this->validate([
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
            'nip_guru' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Wali kelas tidak boleh kosong.',
                    ]
                ],
            'kota_terbit' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Kota terbit tidak boleh kosong.',
                    ]
                ],
            'tgl_terbit' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Tanggal terbit tidak boleh kosong.',
                    ]
                ]

            ]))
        {   
            $validation = \Config\Services::validation();
            // return redirect()->to('/')->withInput()->with('validation',$validation);
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }
        $id = $this->request->getVar("key");
        $data['id_rombel'] = $this->request->getVar('rombel');
        $data['tgl_terbit'] = $this->request->getVar('tgl_terbit');
        $data['kota_terbit'] = $this->request->getVar('kota_terbit');
        $data['wali_kelas'] = $this->request->getVar('nip_guru');
        $data['kd_ta'] = $this->request->getVar('ta');

        if(empty($id)){
            $result = $this->RaporSemesterModel->insertDataRaporSemester($data);
            return json_encode(array($result));
        }else{
            $result = $this->RaporSemesterModel->updateDataRaporSemester($id,$data);
            return json_encode(array($result));
        }
        
    }
}