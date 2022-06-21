<?php

namespace App\Controllers;
use App\Models\UserModel;

class Aunt extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
	public function index()
	{
        if($this->isLogin()){
            $section = session()->get('section');
            switch($section){
                case 'IT': return redirect()->to('/administrator/dashboard-it');;break;
                case 'UKS': return redirect()->to('/administrator/dashboard-uks');break;
                case 'ACADEMIC': return redirect()->to('/administrator/dashboard-academic');break;
                case 'PESDIK': return redirect()->to('/home');break;
            }
        }else{
            $data = array(
                'validation' => \Config\Services::validation()
            );
            return view('admin/pages/login',$data);
        }
	}

    public function loginCheck()
    {
        if (!$this->validate([
            'accesskey' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Access Key tidak boleh kosong.'
                ]
            ],
            'password' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password tidak boleh kosong.'
                ]
            ]])) 
        {
            $validation = \Config\Services::validation();
            // return redirect()->to('/')->withInput()->with('validation',$validation);
            $notif = $validation->getErrors();
            array_push($notif, "Empty");
            return json_encode($notif);
        }else{
            $key = $this->request->getVar('accesskey');
            $pass = $this->request->getVar('password');
            
            $result = $this->userModel->checkDataLogin($key,$pass);
            if($result != NULL){
                $data = array(
                    'log' => TRUE,
                    'accesskey' => $result->accesskey,
                    'username' => $result->username,
                    'level' => $result->level,
                    'section' => $result->section,
                    'unit' => $result->unit,
                    'id' => $result->id
                );
                session()->set($data);
                $notif = array("Success");
                return json_encode($notif);
            }else{
                $data = array("Failed", "notif" => "Access Key / Password Anda Salah !");
                return json_encode($data);
            }
        }        
    }

    public function isLogin()
    {
        $log  = session()->get('log');
		$key  = session()->get('accesskey');
		$name = session()->get('username');
		$level= session()->get('level');
        $section= session()->get('section');
		
		if ($log && !empty($key) && !empty($level) && !empty($section)) {
			return TRUE;
		}else{
			return FALSE;
		}
    }

    public function doLogout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
