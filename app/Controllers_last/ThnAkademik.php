<?php
namespace App\Controllers;
use App\Models\ThnAkademikModel;
use App\Models\UserModel;
use App\Controllers\Administrator;

class ThnAkademik extends BaseController
{
    protected $userModel;
    protected $administrator;
    public function __construct()
    {
        $this->thnAkademikModel = new ThnAkademikModel();
        $this->userModel = new UserModel();
        $this->administrator = new Administrator();
    }

    public function getDataThnAkademik()
    {
        $result = $this->thnAkademikModel->getDataThnAkademik();
        return $result;
    }

    public function getDataThnAkademikById()
    {
        $id = $this->request->getVar("id");
        $result = $this->thnAkademikModel->getDataThnAkademikById($id);
        return json_encode($result);
    }

    public function insertDataThnAkademik()
    {
        if (!$this->validate([
            'thn_akademik' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Tahun Akademik tidak boleh kosong.']
            ],
            'semester' => [
                'rules'  => 'required',
                'errors' => ['required' => 'Semester tidak boleh kosong.']
            ],
            ])) 
        {
            $validation = \Config\Services::validation();
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $id = $this->request->getVar('key');
            $thn_akademik = $this->request->getVar('thn_akademik');
            $semester = $this->request->getVar('semester');
            $unit = session()->get('unit');
            $thn = explode('/', $thn_akademik);
            $data = [
                'kd_ta' => "TA".substr($thn[0], -2).substr($thn[1], -2)."-".$semester."-".str_replace(' ','-',$unit) ,
                'thn_akademik' => $thn_akademik,
                'semester' => $semester,
                'unit' => $unit,
            ];
            if (empty($id)) {
                $result = $this->thnAkademikModel->insertDataThnAkademik($data);
                return json_encode(array($result));
            }else{
                $result = $this->thnAkademikModel->updateDataThnAkademik($id,$data);
                return json_encode(array($result));
            }
        }
    }

    public function changeStatusThnAkademik()
    {
        $id = $this->request->getVar('id');
        $result = $this->thnAkademikModel->changeStatusThnAkademik($id);
        return json_encode(array($result));
    }

    public function deleteDataThnAkademik()
    {
        $id = $this->request->getVar('id');
        $result = $this->thnAkademikModel->deleteById($id);
        return json_encode(array($result));
    }
}