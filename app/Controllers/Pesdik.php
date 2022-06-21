<?php

namespace App\Controllers;

use App\Models\PesdikModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class Pesdik extends BaseController
{
    protected $pesdikModel;
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->pesdikModel = new PesdikModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function uploadDataPesdik()
    {
        if (!$this->validate([
            'import_pesdik' =>
            [
                'rules'  => 'uploaded[import_pesdik]|ext_in[import_pesdik,xls,xlsx]',
                'errors' => [
                    'uploaded' => 'File tidak boleh kosong.',
                    'ext_in' => 'File Harus Berformat xls atau xlsx.'
                ]
            ],
            'id_kelas' => [
                'rules' => 'required',
                'errors' => ['required' => 'Kelas tidak boleh kosong.']
            ],
            'id_rombel' => [
                'rules' => 'required',
                'errors' => ['required' => 'Rombel tidak boleh kosong.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            // return redirect()->to('/')->withInput()->with('validation',$validation);
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {

            $file_excel = $this->request->getFile('import_pesdik');
            $ext = $file_excel->getClientExtension();
            if ($ext == 'xls') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            } else if ($ext == 'xlsx') {
                $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }

            $ss = $render->load($file_excel);
            $data = $ss->getActiveSheet()->toArray(null, true, true, true);
            $data_pesdik = array();
            foreach ($data as $n => $row) {
                if ($n <= 6) {
                    continue;
                }
                array_push($data_pesdik, array(
                    "nm_pesdik" => $row['B'],
                    "jk" => $row['D'],
                    "nik" => $row['H'],
                    "nipd" => $row['C'],
                    "nisn" => $row['E'],
                    "tpt_lahir" => $row['F'],
                    "tgl_lahir" => $row['G'],
                    "agama" => $row['I'],
                    "alamat" => $row['J'],
                    "rt" => $row['K'],
                    "rw" => $row['L'],
                    "dusun" => $row['M'],
                    "kelurahan" => $row['N'],
                    "kecamatan" => $row['O'],
                    "kd_pos" => $row['P'],
                    "nm_ayah" => $row['Y'],
                    "thn_lahir_ayah" => $row['Z'],
                    "pendidikan_ayah" => $row['AA'],
                    "pekerjaan_ayah" => $row['AB'],
                    "penghasilan_wali" => $row['AC'],
                    "nik_ayah" => $row['AD'],
                    "nm_ibu" => $row['AE'],
                    "thn_lahir_ibu" => $row['AF'],
                    "pendidikan_ibu" => $row['AG'],
                    "pekerjaan_ibu" => $row['AH'],
                    "penghasilan_wali" => $row['AI'],
                    "nik_ibu" => $row['AJ'],
                    "nm_wali" => $row['AK'],
                    "thn_lahir_wali" => $row['AL'],
                    "pendidikan_wali" => $row['AM'],
                    "pekerjaan_wali" => $row['AN'],
                    "penghasilan_wali" => $row['AO'],
                    "nik_wali" => $row['AP'],
                    "no_tlp" => $row['S'],
                    "no_hp" => $row['T'],
                    "email" => $row['U'],
                    "sekolah_asal" => $row['BE'],
                    "no_kk" => $row['BI'],
                    "no_akte" => $row['AX'],
                    "no_ijazah" => $row['AS'],
                    "skhun" => $row['V'],
                    "jml_saudara" => $row['BM'],
                    "anak_ke" => $row['BF'],
                    "kelas" => $this->request->getVar('id_kelas'),
                    "rombel" => $this->request->getVar('id_rombel'),
                    "jurusan" => $row['BO'],
                    "unit" => session()->get('unit'),

                ));
            }

            $result = $this->pesdikModel->uploadDataPesdik($data_pesdik);
            return json_encode(array($result));
        }
    }

    public function getDataPesdik()
    {
        $result = $this->pesdikModel->getDataPesdik();
        return $result;
    }

    public function getListPesdik($kls)
    {
        $result = $this->pesdikModel->getListPesdik($kls);
        return $result;
    }

    public function getCountPesdik()
    {
        $result = $this->pesdikModel->getCountPesdik();
        return $result;
    }

    public function getSelectPesdik()
    {
        $param = $this->request->getVar('search');
        $result = $this->pesdikModel->getSelectPesdik($param);
        foreach ($result->getResultArray() as $row) {
            $data[] = array("id" => $row['id_pesdik'], "text" => $row['nm_pesdik']);
        }
        return json_encode($data);
    }

    public function getDataPesdikById()
    {
        $id = $this->request->getVar('id');
        $result = $this->pesdikModel->getDataPesdikById($id)->getRow();
        return json_encode($result);
    }

    public function deleteDataPesdik()
    {
        if ($this->administrator->isLogin()) {
            $id = $this->request->getVar('id');
            $nisn = $this->pesdikModel->getDataPesdikById($id)->getRow('nisn');
            $this->userModel->nonaktifUserByKey($nisn);
            $result = $this->pesdikModel->deleteById($id);
            return json_encode(array($result));
        } else {
            return redirect()->to('/');
        }
    }

    public function pindahKlsPesdik()
    {
        if (!$this->validate([
            'list_pesdik' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama Pesdik tidak boleh kosong.'
                ]
            ],
            'id_pindah_kelas' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Kelas tidak boleh kosong.'
                ]
            ],
            'id_pindah_rombel' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Rombel tidak boleh kosong.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {
            $listId = $this->request->getPost('list_pesdik');
            $rombel = $this->request->getVar('kls');
            $data = array();
            foreach ($listId as $key => $val) {
                $data[] = array(
                    'id_pesdik' => $listId[$key],
                    'kelas' => $this->request->getVar('id_pindah_kelas'),
                    'rombel' => $this->request->getVar('id_pindah_kelas'),
                );
            }
            $result = $this->pesdikModel->updateKlsPesdik($data);
            return json_encode(array($result));
        }
    }

    public function insertDataPesdik()
    {
        if (!$this->validate([
            'nm_pesdik' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nama Pesdik tidak boleh kosong.']
            ],
            'nik' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nik tidak boleh kosong.']
            ],
            'nipd' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nipd tidak boleh kosong.']
            ],
            'nisn' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Nisn tidak boleh kosong.']
            ],
            'tpt_lahir' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tempat lahir tidak boleh kosong.']
            ],
            'tgl_lahir' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tanggal lahir tidak boleh kosong.']
            ],
            'agama' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Agama tidak boleh kosong.']
            ],
            'jk' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Jenis kelamin tidak boleh kosong.']
            ],
            'kelas' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Kelas tidak boleh kosong.']
            ],
            'rombel' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Rombel tidak boleh kosong.']
            ],
        ])) {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        } else {
            $id = $this->request->getVar('key');
            $data = [
                'nm_pesdik' => $this->request->getVar('nm_pesdik'),
                'jk' => $this->request->getVar('jk'),
                'nik' => $this->request->getVar('nik'),
                'nipd' => $this->request->getVar('nipd'),
                'nisn' => $this->request->getVar('nisn'),
                'tpt_lahir' => $this->request->getVar('tpt_lahir'),
                'tgl_lahir' => $this->request->getVar('tgl_lahir'),
                'agama' => $this->request->getVar('agama'),
                'alamat' => $this->request->getVar('alamat'),
                'rt' => $this->request->getVar('rt'),
                'rw' => $this->request->getVar('nm_pesdik'),
                'dusun' => $this->request->getVar('dusun'),
                'keluahan' => $this->request->getVar('nm_pesdik'),
                'kecamatan' => $this->request->getVar('kecamatan'),
                'kd_pos' => $this->request->getVar('kd_pos'),
                'nm_ayah' => $this->request->getVar('nm_ayah'),
                'nik_ayah' => $this->request->getVar('nik_ayah'),
                'thn_lahir_ayah' => $this->request->getVar('thn_lahir_ayah'),
                'pendidikan_ayah' => $this->request->getVar('pendidikan_ayah'),
                'pekerjaan_ayah' => $this->request->getVar('pekerjaan_ayah'),
                'penghasilan_ayah' => $this->request->getVar('penghasilan_ayah'),
                'nik_ibu' => $this->request->getVar('nik_ibu'),
                'thn_lahir_ibu' => $this->request->getVar('thn_lahir_ibu'),
                'pendidikan_ibu' => $this->request->getVar('pendidikan_ibu'),
                'pekerjaan_ibu' => $this->request->getVar('pekerjaan_ibu'),
                'penghasilan_ibu' => $this->request->getVar('penghasilan_ibu'),
                'nik_wali' => $this->request->getVar('nik_wali'),
                'thn_lahir_wali' => $this->request->getVar('thn_lahir_wali'),
                'pendidikan_wali' => $this->request->getVar('pendidikan_wali'),
                'pekerjaan_wali' => $this->request->getVar('pekerjaan_wali'),
                'penghasilan_wali' => $this->request->getVar('penghasilan_wali'),
                'no_hp' => $this->request->getVar('no_hp'),
                'no_tlp' => $this->request->getVar('no_tlp'),
                'email' => $this->request->getVar('email'),
                'sekolah_asal' => $this->request->getVar('no_hp'),
                'no_kk' => $this->request->getVar('no_kk'),
                'no_akte' => $this->request->getVar('no_akte'),
                'skhun' => $this->request->getVar('skhun'),
                'jml_saudara' => $this->request->getVar('jml_saudara'),
                'anak_ke' => $this->request->getVar('anak_ke'),
                'kelas' => $this->request->getVar('kelas'),
                'rombel' => $this->request->getVar('rombel'),
                'jurusan' => $this->request->getVar('jurusan'),
                'unit' => session()->get('unit')

            ];

            if (empty($id)) {
                $result = $this->pesdikModel->insertDataPesdik($data);
                return json_encode(array($result));
            } else {
                $result = $this->pesdikModel->updateDataPesdik($id, $data);
                return json_encode(array($result));
            }
        }
    }

    public function updatePesdikLulus()
    {
        $nisn = $this->request->getVar('nisn');
        $data = array();
        for ($i = 0; $i < sizeof($nisn); $i++) {
            $data[] = array(
                'nisn' => $nisn[($i)],
                'kelas' => 'Lulus',
                'rombel' => 'Lulus',
                'status' => 'Lulus'
            );
        }
        $result = $this->pesdikModel->updatePesdikLulus($data);
        return json_encode(array($result));
    }
}
