<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Models\UserModel;

use Irsyadulibad\DataTables\DataTables;



class RekamMedisModel extends Model{

    protected $table = 'tb_rekam_medis';

    protected $primaryKey = 'id_rekam_medis';

    protected $allowedFields = ['id_pesdik', 'tgl_periksa', 'anamnesa','penanganan', 'diagnosis', 'obat', 'note', 'petugas', 'status', 'penyakit_dahulu', 'pemeriksaan_fisik', 'riwayat_keluarga', 'alergi'];

    protected $userModel;



    public function __construct()

    {

        parent::__construct();

        $this->userModel = new UserModel();

    }



    public function getDataRekamMedisByMonth($month)

    {

        $unit = session()->get('unit');

        return DataTables::use($this->table)

        ->select('id_rekam_medis, tb_rekam_medis.id_pesdik as id_pesdik, tgl_periksa, anamnesa, diagnosis, penyakit_dahulu, pemeriksaan_fisik, riwayat_keluarga, alergi, penanganan, obat, note, petugas, tb_rekam_medis.status AS status, tb_pesdik.nm_pesdik as nm_pesdik, tb_pesdik.kelas as kelas, tb_rombel.nm_rombel as rombel')

        ->join('tb_pesdik ', 'tb_pesdik.id_pesdik = tb_rekam_medis.id_pesdik', 'INNER JOIN')

        ->join('tb_rombel ', 'tb_pesdik.rombel = tb_rombel.id_rombel', 'INNER JOIN')

        ->where(['EXTRACT(YEAR_MONTH FROM `tgl_periksa`)' => $month, 'tb_pesdik.unit'=> $unit])

        ->make(true);

    }



    public function insertDataRekamMedis($data)

    {

        $this->transBegin();

        $this->insert($data);

        if ($this->transStatus() === FALSE){

            $this->transRollback();

            return "Failed Input";

        }else{

            $this->transCommit();

            return "Success Input";

        }

    }



    public function updateDataRekamMedis($id,$data)

    {

        $this->transBegin();

        $this->set($data, false);

        $this->where('id_rekam_medis', $id);

        $this->update();

        if ($this->transStatus() === FALSE) {

            $this->transRollback();

            return "Failed Update";

        }else{

            $this->transCommit();

            return "Success Update";

        }

    }



    public function deleteById($id)

    {

        $this->transBegin();

        $this->where('id_rekam_medis', $id);

        $this->delete();

        if ($this->transStatus() === FALSE){

            $this->transRollback();

            return "Failed Delete";

        }else{

            $this->transCommit();

            return "Success Delete";

        }

    }



    public function getDataRekamMedisById($id)

    {

        $result = $this->getWhere(['id_rekam_medis' => $id]);

        return $result;

    }



    public function getCountDataRekamMedisPerMonth(){

        $unit = session()->get('unit');

        $month = date('Ym');

        $result = $this->join('tb_pesdik', 'tb_pesdik.id_pesdik = tb_rekam_medis.id_pesdik')

        ->join('tb_user', 'tb_user.accesskey = tb_pesdik.nisn')

        ->getWhere(['tb_pesdik.status' => 'Aktif', 'unit' => $unit,'EXTRACT(YEAR_MONTH FROM `tgl_periksa`)' => $month])->getNumRows();

        return $result;

    }



    public function getCountDataRekamMedisPerYear(){

        $unit = session()->get('unit');

        $month = date('Y');

        $result = $this->join('tb_pesdik', 'tb_pesdik.id_pesdik = tb_rekam_medis.id_pesdik')

        ->join('tb_user', 'tb_user.accesskey = tb_pesdik.nisn')

        ->getWhere(['tb_pesdik.status' => 'Aktif', 'unit' => $unit,'EXTRACT(YEAR FROM `tgl_periksa`)' => $month])->getNumRows();

        return $result;

    }



    public function getGrafikRekamMedis()

    {

        $year = date('Y');

        $result = $this->select('DISTINCT(DATE_FORMAT(`tgl_periksa`, "%M/%Y")) AS tgl, COUNT(*) AS jml')

        ->groupBy('EXTRACT(YEAR_MONTH FROM `tgl_periksa`)')

        ->where(['YEAR(`tgl_periksa`)' => $year])

        ->get()->getResultArray();

        return $result;

    }



    public function getDataRekamMedisByNisn($id)

    {

        $result = $this->orderBy('tgl_periksa DESC')->getWhere(['id_pesdik' => $id]);

        return $result;

    }

    public function getPetugasUks($unit)
    {
        $result = $this->query("SELECT * FROM tb_petugas_uks WHERE unit = '$unit'")->getResultArray();
        return $result;
    }

}

