<?php
namespace App\Models;
use CodeIgniter\Model;
use App\Models\UserModel;
use Irsyadulibad\DataTables\DataTables;

class StokObatModel extends Model{
    protected $table = 'tb_obat';
    protected $primaryKey = 'id_obat';
    protected $allowedFields = ['id_obat', 'nm_obat', 'jenis', 'stok', 'satuan', 'unit'];
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function getDataStokObat()
    {
        $unit = session()->get('unit');
        return DataTables::use($this->table)
        ->where(['unit'=>$unit])
        ->make(true);
    }

    public function insertDataStokObat($data)
    {
        $this->transBegin();
        $this->insert($data);
        if ($this->transStatus()=== FALSE) {
            $this->transRollback();
            return 'Failed Input';
        }else{
            $this->transCommit();
            return 'Success Input';
        }
    }

    public function updateDataStokObat($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_obat', $id);
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
        $this->where('id_obat', $id);
        $this->delete();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataStokObatById($id)
    {
        $result = $this->getWhere(['id_obat' => $id]);
        return $result;
    }

    public function getCountStokObat()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit])->getNumRows();
        return $result;
    }

}