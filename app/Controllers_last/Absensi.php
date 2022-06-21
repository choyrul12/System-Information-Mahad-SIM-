<?php
namespace App\Controllers;
use App\Models\AbsensiModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Absensi extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->AbsensiModel = new AbsensiModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataAbsensi()
    {
        $data['id_kelas']  = $this->request->getVar('id_kelas');
        $data['id_rombel'] = $this->request->getVar('id_rombel');
        $data['kd_ta']  = $this->request->getVar('ta');
        $result = $this->AbsensiModel->getDataAbsensi($data);
        return json_encode($result);
    }

    public function getDataAbsensiById()
    {
        $id = $this->request->getVar('id');
        $result = $this->AbsensiModel->getDataAbsensiById($id);
        return json_encode($result);
    }

    public function insertDataAbsensi()
    {
        $data = array();
        $ta   = $this->request->getVar('ta');
        $nisn = $this->request->getVar('nisn');
        $izin = $this->request->getVar('izin');
        $sakit = $this->request->getVar('sakit');
        $alpha = $this->request->getVar('alpha');
        $nik_guru = session()->get('accesskey');
        
        for ($i=0; $i < count($nisn); $i++) { 
            array_push($data,array(
                'kd_ta' => $ta,
                'nisn' => $nisn[$i],
                'izin' => $izin[$i],
                'sakit' => $sakit[$i],
                'alpha' => $alpha[$i],
                'nik_guru' => $nik_guru,
            ));
        }
        $result = $this->AbsensiModel->insertDataAbsensi($data);
        return json_encode(array($result));
    }

    public function updateDataAbsensi()
    {
        $key = $this->request->getVar('key');
        $data['eskul1'] = $this->request->getVar('eskul1');
        $data['eskul2'] = $this->request->getVar('eskul2');
        $data['eskul3'] = $this->request->getVar('eskul3');
        $data['eskul4'] = $this->request->getVar('eskul4');
        $data['nilai1'] = $this->request->getVar('nilai1');
        $data['nilai2'] = $this->request->getVar('nilai2');
        $data['nilai3'] = $this->request->getVar('nilai3');
        $data['nilai4'] = $this->request->getVar('nilai4');

        $result = $this->AbsensiModel->updateDataAbsensi($key,$data);
        return json_encode(array($result));
    }

    public function uploadDataAbsensi()
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

            $result = $this->AbsensiModel->uploadDataAbsensi($data_nilai);
            return json_encode(array($result));
        }
    }

    public function changeStatusAbsensi()
    {
        $id = $this->request->getVar('id');
        $result = $this->AbsensiModel->changeStatusAbsensi($id);
        return json_encode(array($result));
    }

    public function deleteDataAbsensi()
    {
        $id = $this->request->getVar('id_nilai');
        $result = $this->AbsensiModel->deleteById($id);
        return json_encode(array($result));
    }
}