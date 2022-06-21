<?php

namespace App\Controllers;
use App\Models\ThnAkademikModel;
use App\Models\KelasModel;
use App\Models\RaporBulananModel;
use App\Models\RaporSemesterModel;
use App\Models\RekamMedisModel;

class Home extends BaseController
{
	protected $ThnAkademik;
	protected $Kelas;
	protected $RaporBulanan;
	protected $RaporSemester;
	protected $rekamMedis;
    public function __construct()
    {
        $this->ThnAkademik = new ThnAkademikModel();
		$this->Kelas = new KelasModel();
		$this->RaporBulanan = new RaporBulananModel();
		$this->RaporSemester = new RaporSemesterModel();
		$this->RekamMedis = new RekamMedisModel();
    }

	public function index()
	{
		$data['ta']  = $this->ThnAkademik->getListThnAkademik();
		$data['kls'] = $this->Kelas->getKelas();
		if ($this->isLogin()) {
			return view('main/pages/home',$data);
		}else{
			return redirect()->to('/');
		}
		
	}

	public function isLogin()
	{
		$log  = session()->get('log');
		$key  = session()->get('accesskey');
		$name = session()->get('username');
		$level= session()->get('level');
		$section = session()->get('section');
		
		if ($log && !empty($key) && !empty($name) && $level == '3' && $section == 'PESDIK') {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function uks()
	{
		if ($this->isLogin()) {
			$id = session()->get('id');
			$data['rekam_medis'] = $this->RekamMedis->getDataRekamMedisByNisn($id);
			return view('main/pages/uks',$data);
		}else{
			return redirect()->to('/');
		}
	}

	public function monthlyRaport()
	{
		if ($this->isLogin()) {
			return view('main/pages/monthly-raport');
		}else{
			return redirect()->to('/');
		}
	}

	public function searchMonthlyReport()
	{
		$data['id'] = $this->request->getVar('id');
		$data['kd_ta'] = $this->request->getVar('ta');
		$data['bulan'] = $this->request->getVar('month');
		$data['kls'] = $this->request->getVar('kls');
		$data['id_rombel'] = $this->request->getVar('rombel');
		
		$check = $this->RaporBulanan->checkStatusRaporBulanan($data)->getnumRows();
		if($check>0){
			$data['notif'] = "Success";
			return json_encode($data);
		}else{
			$data['notif'] = "Failed";
			return json_encode($data);
		}
		
	}

	public function searchSemesterReport()
	{
		$data['id'] = $this->request->getVar('id');
		$data['kd_ta'] = $this->request->getVar('ta');
		$data['kls'] = $this->request->getVar('kls');
		$data['id_rombel'] = $this->request->getVar('rombel');
		
		$check = $this->RaporSemester->checkStatusRaporSemester($data)->getnumRows();
		if($check>0){
			$data['notif'] = "Success";
			return json_encode($data);
		}else{
			$data['notif'] = "Failed";
			return json_encode($data);
		}
		
	}
}
