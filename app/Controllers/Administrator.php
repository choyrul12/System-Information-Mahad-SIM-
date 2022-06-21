<?php

namespace App\Controllers;

use App\Controllers\Aunt;
use App\Models\GradeModel;
use App\Models\PesdikModel;
use App\Models\RekamMedisModel;
use App\Models\StokObatModel;
use App\Models\KelasModel;
use App\Models\ThnAkademikModel;
use App\Models\EskulModel;
use App\Models\MapelModel;
use App\Models\GuruModel;
use App\Models\RombelModel;

class Administrator extends BaseController
{
    protected $aunt;
    protected $log;
    protected $accesskey;
    protected $username;
    protected $section;
    protected $level;
    protected $pesdikModel;
    protected $rekamMedisModel;
    protected $stokObatModel;
    protected $gradeModel;
    protected $kelasModel;
    protected $thnAkademik;
    protected $eskulModel;
    protected $mapelModel;
    protected $guruModel;
    protected $rombelModel;
    public function __construct()
    {
        $this->aunt = new Aunt();
        $this->log  = session()->get('log');
        $this->accesskey  = session()->get('accesskey');
        $this->username = session()->get('username');
        $this->section = session()->get('section');
        $this->level = session()->get('level');
        $this->pesdikModel = new PesdikModel;
        $this->rekamMedisModel = new RekamMedisMOdel;
        $this->stokObatModel = new StokObatModel;
        $this->gradeModel = new GradeModel;
        $this->kelasModel = new KelasModel;
        $this->thnAkademik = new ThnAkademikModel;
        $this->eskulModel = new EskulModel;
        $this->mapelModel = new MapelModel;
        $this->guruModel = new GuruModel;
        $this->rombelModel = new RombelModel;
    }

    public function isLogin()
    {
        $log  = $this->log;
        $key  = $this->accesskey;
        $name = $this->username;
        $section = $this->section;
        $level = $this->level;

        if ($log && !empty($key) && !empty($name) && !empty($level) && !empty($section)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function index()
    {
        return redirect()->to('/');
    }

    public function listMenu()
    {
        $section = $this->section;
        $level = $this->level;
        $dashboardIt  = array("title" => "Dashboard", "link" => "administrator/dashboard", "icon" => "nav-icon fas fa-tachometer-alt", "id" => "");
        $dashboardUks = array("title" => "Dashboard", "link" => "/administrator/dashboard-uks", "icon" => "nav-icon fas fa-tachometer-alt", "id" => "dashboard-uks");
        $dataSekolah = array("title" => "Data Profil Sekolah", "link" => "/administrator/data-sekolah", "icon" => "nav-icon fas fa-school", "id" => "data-sekolah");
        $dataPesdik = array("title" => "Data Peserta Didik", "link" => "/administrator/data-pesdik", "icon" => "nav-icon fas fa-graduation-cap", "id" => "data-pesdik");
        $dataRekamMedik = array("title" => "Data Rekam Medis", "link" => "/administrator/data-rekam-medis", "icon" => "nav-icon fas fa-heartbeat", "id" => "data-rekam-medis");
        $dataStokObat = array("title" => "Data Stock Obat", "link" => "/administrator/data-stok-obat", "icon" => "nav-icon fas fa-capsules", "id" => "data-stok-obat");
        $dashboardAcademic = array("title" => "Dashboard", "link" => "/administrator/dashboard-academic", "icon" => "nav-icon fas fa-tachometer-alt", "id" => "dashboard-academic");
        $dataGuru = array("title" => "Data Guru", "link" => "/administrator/data-guru-mapel", "icon" => "nav-icon fas fa-chalkboard-teacher", "id" => "data-guru");
        $dataLedger = array("title" => "Data Ledger", "link" => "#", "icon" => "nav-icon fas fa-table", "id" => "data-ledger");
        $dataRaporBulanan = array("title" => "Data Rapor Bulanan", "link" => "/administrator/data-rapor-bulanan", "icon" => "nav-icon fas fa-book-open", "id" => "data-rapor");
        $dataRaporSemester = array("title" => "Data Rapor Semester", "link" => "/administrator/data-rapor-semester", "icon" => "nav-icon fas fa-book-open", "id" => "data-rapor");
        $dataNilai = array("title" => "Data Nilai Semester", "link" => "#", "icon" => "nav-icon fas fa-clipboard-list", "id" => "data-nilai");
        $dataNilaiBulanan = array("title" => "Data Nilai Bulanan", "link" => "/administrator/data-nilai-bulanan", "icon" => "nav-icon fas fa-clipboard-list", "id" => "data-nilai-bulanan");
        $dataStandardNilai = array("title" => "Data Standar Nilai", "link" => "#", "icon" => "nav-icon fas fa-certificate", "id" => "data-standard-nilai");
        $dataMapel = array("title" => "Data Mapel", "link" => "/administrator/data-mapel", "icon" => "nav-icon fas fa-book", "id" => "data-mapel");
        $dataRombel = array("title" => "Data Rombel", "link" => "/administrator/data-rombel", "icon" => "nav-icon fa fa-user-friends", "id" => "data-rombel");
        $dataEskul = array("title" => "Data Eskul", "link" => "/administrator/data-eskul", "icon" => "nav-icon fas fa-child", "id" => "data-eskul");
        $dataThnAjar = array("title" => "Data Tahun Akademik", "link" => "/administrator/data-thn-akademik", "icon" => "nav-icon fas fa-calendar-alt", "id" => "data-thn-akademik");

        $dataNilaiMapel = array("title" => "Nilai Mapel", "link" => "/administrator/data-nilai-mapel", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-nilai");
        $dataNilaiAfektif = array("title" => "Nilai Afektif", "link" => "/administrator/data-nilai-afektif", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-nilai");
        $dataNilaiEskul = array("title" => "Nilai Eskul", "link" => "/administrator/data-nilai-eskul", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-nilai");
        $dataAbsensi = array("title" => "Absensi Pesdik", "link" => "/administrator/data-absensi", "icon" => "nav-icon fas fa-caret-right", "id" => "data-absensi", "parent" => "data-nilai");
        $standardKkm = array("title" => "Standar KKM", "link" => "/administrator/standard-kkm", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-standard-nilai");
        $standardPengetahuan = array("title" => "Standar Pengetahuan", "link" => "/administrator/standard-pengetahuan", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-standard-nilai");
        $standardKeterampilan = array("title" => "Standar Keterampilan", "link" => "/administrator/standard-keterampilan", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-standard-nilai");
        $standardAfektif = array("title" => "Standar Afektif", "link" => "/administrator/standard-afektif", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-standard-nilai");
        $standardEskul = array("title" => "Standar Eskul", "link" => "/administrator/standard-eskul", "icon" => "nav-icon fas fa-caret-right", "id" => "data-mapel", "parent" => "data-standard-nilai");
        $dataGuruMapel =  array("title" => "Data Guru Mapel", "link" => "/administrator/data-guru-mapel", "icon" => "nav-icon fas fa-caret-right", "id" => "data-guru-mapel", "parent" => "data-guru");
        $dataWaliKelas =  array("title" => "Data Wali Kelas", "link" => "/administrator/data-wali-kelas", "icon" => "nav-icon fas fa-caret-right", "id" => "data-wali-kelas", "parent" => "data-guru");
        $dataLedgerBulanan = array("title" => "Data Ledger Bulanan", "link" => "/administrator/data-ledger-bulanan", "icon" => "nav-icon fas fa-caret-right", "id" => "data-ledger-bulanan", "parent" => "data-ledger");
        $dataLedgerSemester = array("title" => "Data Ledger Semester", "link" => "/administrator/data-ledger-semester", "icon" => "nav-icon fas fa-caret-right", "id" => "data-ledger-semester", "parent" => "data-ledger");
        switch ($section) {
            case 'IT':
                $data["menu_name"] = 'Dasboard Menu IT';
                $data["menu_list"] = array($dashboardIt, $dataPesdik);
                $data["menu_tree"] = array();
                return $data;
                break;
            case 'UKS':
                $data["menu_name"] = 'DASHBOARD MENU UKS';
                $data["menu_list"] = array($dashboardUks, $dataPesdik, $dataRekamMedik, $dataStokObat);
                $data["menu_tree"] = array();
                return $data;
                break;
            case 'ACADEMIC':
                $data["menu_name"] = 'DASHBOARD MENU ACADEMIC';
                if ($level == '2') {
                    $data["menu_list"] = array($dashboardAcademic, $dataSekolah, $dataThnAjar, $dataRombel, $dataPesdik, $dataGuru, $dataMapel, $dataEskul, $dataStandardNilai, $dataNilaiBulanan, $dataNilai, $dataLedger, $dataRaporBulanan, $dataRaporSemester);
                    $data["menu_tree"] = array($dataNilaiMapel, $dataNilaiAfektif, $dataNilaiEskul, $dataAbsensi, $standardKkm, $standardPengetahuan, $standardKeterampilan, $standardAfektif, $standardEskul, $dataLedgerBulanan, $dataLedgerSemester);
                } elseif ($level == '3') {
                    $data["menu_list"] = array($dashboardAcademic, $dataPesdik, $dataNilaiBulanan, $dataNilai, $dataLedger, $dataRaporBulanan, $dataRaporSemester);
                    $data["menu_tree"] = array($dataNilaiMapel, $dataNilaiAfektif, $dataNilaiEskul, $dataAbsensi, $dataLedgerBulanan, $dataLedgerSemester);
                }
                return $data;
                break;
        }
    }

    public function showDashboardIT()
    {
        $data = $this->listMenu();
        $data['title'] = "Dashboard UKS";
        $section = $this->section;
        if ($this->isLogin() && $section == "IT") {
            return view('admin/pages/dashboard', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDashboardUKS()
    {
        $data = $this->listMenu();
        $data['title'] = "Dashboard UKS";
        $data['count_pesdik'] = $this->pesdikModel->getCountPesdik();
        $data['count_rekam_medis_m'] = $this->rekamMedisModel->getCountDataRekamMedisPerMonth();
        $data['count_rekam_medis_y'] = $this->rekamMedisModel->getCountDataRekamMedisPerYear();
        $data['count_obat'] = $this->stokObatModel->getCountStokObat();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "UKS")) {
            return view('admin/pages/dashboard_uks', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataPesdik()
    {
        $data = $this->listMenu();
        $data['title']  = "Data Peserta Didik";
        $data['kelas'] = $this->kelasModel->getKelas();
        if ($this->isLogin()) {
            return view('admin/pages/data_pesdik', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showProfilPesdik($id)
    {
        $data = $this->listMenu();
        $data['title']   = "Profile Peserta Didik";
        $data['profile'] = $this->pesdikModel->getDataPesdikById($id)->getRow();
        if ($this->isLogin()) {
            return view('admin/pages/profile_pesdik', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataRekamMedis()
    {
        $data = $this->listMenu();
        $unit = session()->get('unit');
        $data['title']   = "Data Rekam Medis";
        $data['petugas_uks'] = $this->rekamMedisModel->getPetugasUks($unit);
        if ($this->isLogin()) {
            return view('admin/pages/data_rekam_medis', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataStokObat()
    {
        $data = $this->listMenu();
        $data['title']   = "Data Rekam Medis";
        if ($this->isLogin()) {
            return view('admin/pages/data_stok_obat', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDashboardAcademic()
    {
        $data = $this->listMenu();
        $data['title'] = "Dashboard Academic";
        $data['count_guru'] = $this->guruModel->getCountGuru();
        $data['count_pesdik'] = $this->pesdikModel->getCountPesdik();
        $data['ta_aktif'] = $this->thnAkademik->getThnAkademik()->getRow();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/dashboard_academic', $data);
        } else {
            return redirect()->to('/');
        }
    }


    public function showDataRombel()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Rombel";
        $data['kelas'] = $this->kelasModel->getKelas();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_rombel', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataMapel()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Mapel";
        $data['kelas'] = $this->kelasModel->getKelas();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_mapel', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataGuru()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Guru";
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_guru', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataWaliKls()
    {
        $unit = session()->get('unit');
        $data = $this->listMenu();
        $data['title'] = "Data Wali Kelas";
        $data['guru']  = $this->guruModel->getListGuru();
        $data['rombel'] = $this->rombelModel->getListRombel();
        $data['ta'] = $this->thnAkademik->getListThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_wali_kelas', $data);
        } else {
            return redirect()->to('/');
        }
    }


    public function showDataThnAkademik()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Tahun Akademik";
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_thn_akademik', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataKkm()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Standar KKM";
        $unit = session()->get('unit');
        $data['kkm'] = $this->gradeModel->getKkm($unit);
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_std_kkm', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataAfektif()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Standar Afektif";
        $data['kelas'] = $this->kelasModel->getKelas();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_std_afektif', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataEskul()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Eskul";
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_eskul', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataStdEskul()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Standar Eskul";
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_std_eskul', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataSekolah()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Profil Sekolah";
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_sekolah', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataStdPengetahuan()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Standar Pengetahuan";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_std_pengetahuan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataStdKeterampilan()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Standar Keterampilan";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_std_keterampilan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataNilaiMapel()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Nilai Mapel";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_nilai_mapel', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataNilaiAfektif()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Nilai Afektif";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_nilai_afektif', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataNilaiEskul()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Nilai Eskul";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $data['eskul'] = $this->eskulModel->getListEskul();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_nilai_eskul', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataAbsensi()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Absensi Pesdik";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_absensi', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataNilaiBulanan()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Nilai Bulanan";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_nilai_bulanan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataLedgerBulanan()
    {
        $unit = session()->get('unit');
        $data = $this->listMenu();
        $data['title'] = "Data Ladger Nilai Bulanan";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        if (empty($_GET['kelas'])) {
            $kelas = '';
            $rombel = '';
        } else {
            $kelas = $_GET['kelas'];
            $rombel = $_GET['rombel'];
        }
        $rapor = 'rapor_bulanan';
        $data['list_mapel'] = $this->mapelModel->getListMapel($kelas, $rapor);
        $data['list_pesdik'] = $this->pesdikModel->getListPesdik($rombel);
        $data['kkm'] = $this->gradeModel->getKkm($unit);
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_ledger_bulanan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showDataLedger()
    {
        $unit = session()->get('unit');
        $data = $this->listMenu();
        $data['title'] = "Data Ladger Nilai Semester";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        if (empty($_GET['kelas'])) {
            $kelas = '';
            $rombel = '';
        } else {
            $kelas = $_GET['kelas'];
            $rombel = $_GET['rombel'];
        }
        $rapor = 'rapor_semester';
        $data['list_mapel'] = $this->mapelModel->getListMapel($kelas, $rapor);
        $data['list_pesdik'] = $this->pesdikModel->getListPesdik($rombel);
        $data['kkm'] = $this->gradeModel->getKkm($unit);
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_ledger_semester', $data);
        } else {
            return redirect()->to('/');
        }
    }


    public function showDataRaporBulanan()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Raport Bulanan";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $data['guru']  = $this->guruModel->getListGuru();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_rapor_bulanan', $data);
        } else {
            return redirect()->to('/');
        }
    }

    public function showPrintRaporBulanan()
    {
        return view('admin/pages/rapor_nilai_bulanan');
    }

    public function showPrintRaporAfektif()
    {
        return view('admin/pages/rapor_nilai_afektif');
    }

    public function showPrintRaporPengetahuan()
    {
        return view('admin/pages/rapor_nilai_pengetahuan');
    }

    public function showPrintRaporKeterampilan()
    {
        return view('admin/pages/rapor_nilai_keterampilan');
    }

    public function showPrintRaporEskul()
    {
        return view('admin/pages/rapor_nilai_eskul');
    }

    public function showPrintRaporSemester()
    {
        return view('admin/pages/rapor_semester');
    }

    public function showDataRaporSemester()
    {
        $data = $this->listMenu();
        $data['title'] = "Data Raport Semester";
        $data['kelas'] = $this->kelasModel->getKelas();
        $data['thn_akademik'] = $this->thnAkademik->getThnAkademik();
        $data['guru']  = $this->guruModel->getListGuru();
        $section = $this->section;
        if ($this->isLogin() && ($section == "IT" || $section == "ACADEMIC")) {
            return view('admin/pages/data_rapor_semester', $data);
        } else {
            return redirect()->to('/');
        }
    }
}
