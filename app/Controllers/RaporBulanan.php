<?php
namespace App\Controllers;
use App\Models\RaporBulananModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class RaporBulanan extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->RaporBulananModel = new RaporBulananModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataRaporBulanan()
    {
        $data['id_kelas']  = $this->request->getVar('id_kelas');
        $data['id_rombel'] = $this->request->getVar('id_rombel');
        $data['kd_ta']  = $this->request->getVar('ta');
        $data['bulan']  = $this->request->getVar('bulan');
        $result = $this->RaporBulananModel->getDataRaporBulanan($data);
        return json_encode($result);
    }

    public function getDataRaporBulananById()
    {
        $id = $this->request->getVar('id');
        $result = $this->RaporBulananModel->getDataRaporBulananById($id);
        return json_encode($result);
    }

    public function updateDataRaporBulanan()
    {
        $key = $this->request->getVar('key');
        $data['score'] = $this->request->getVar('score');
        $result = $this->RaporBulananModel->updateDataRaporBulanan($key,$data);
        return json_encode(array($result));
    }

    public function uploadDataRaporBulanan()
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

            $result = $this->RaporBulananModel->uploadDataRaporBulanan($data_nilai);
            return json_encode(array($result));
        }
    }

    public function changeStatusRaporBulanan()
    {
        $id = $this->request->getVar('id');
        $result = $this->RaporBulananModel->changeStatusRaporBulanan($id);
        return json_encode(array($result));
    }

    public function deleteDataRaporBulanan()
    {
        $id = $this->request->getVar('id_nilai');
        $result = $this->RaporBulananModel->deleteById($id);
        return json_encode(array($result));
    }

    public function checkStatusRaporBulanan()
    {
        $data["kd_mapel"] = $this->request->getVar('mapel');
        $data["id_kelas"] = $this->request->getVar('kelas');
        $data["id_rombel"] = $this->request->getVar('id_rombel');
        $data["bulan"] = $this->request->getVar('bulan');
        $data["kd_ta"] = $this->request->getVar('ta');
        $result = $this->RaporBulananModel->checkStatusRaporBulanan($data)->getNumRows();
        if($result>0){
            return json_encode(array("status"=>"SUDAH TERBIT"));
        }else{
            return json_encode(array("status"=>"BELUM TERBIT"));
        }
       
    }

    public function getAttrRaporBulanan()
    {
        $data["kd_mapel"] = $this->request->getVar('mapel');
        $data["id_kelas"] = $this->request->getVar('kelas');
        $data["id_rombel"] = $this->request->getVar('id_rombel');
        $data["bulan"] = $this->request->getVar('bulan');
        $data["kd_ta"] = $this->request->getVar('ta');
        $result = $this->RaporBulananModel->checkStatusRaporBulanan($data)->getRow();
        return json_encode($result);
       
    }

    public function terbitkanRaporBulanan()
    {
        if (!$this->validate([
            'bulan' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Bulan tidak boleh kosong.',
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
            'jenis' => 
                ['rules'  => 'required',
                    'errors' => [
                        'required' => 'Jenis rapor tidak boleh kosong.',
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
        $data['bulan_rapor'] = $this->request->getVar('bulan');
        $data['id_rombel'] = $this->request->getVar('rombel');
        $data['tgl_terbit'] = $this->request->getVar('tgl_terbit');
        $data['kota_terbit'] = $this->request->getVar('kota_terbit');
        $data['wali_kelas'] = $this->request->getVar('nip_guru');
        $data['jenis'] = $this->request->getVar('jenis');
        $data['kd_ta'] = $this->request->getVar('ta');

        if(empty($id)){
            $result = $this->RaporBulananModel->insertDataRaporBulanan($data);
            return json_encode(array($result));
        }else{
            $result = $this->RaporBulananModel->updateDataRaporBulanan($id,$data);
            return json_encode(array($result));
        }
        
    }
}