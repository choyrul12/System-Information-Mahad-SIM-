<?php
namespace App\Models;
use CodeIgniter\Model;
use Irsyadulibad\DataTables\DataTables;

class EskulModel extends Model{
    protected $table = 'tb_eskul';
    protected $primaryKey = 'id_eskul';
    protected $allowedFields = ['id_eskul', 'nm_eskul', 'unit'];


    public function getDataEskulByUnit()
    {
        $unit = session()->get('unit');
        return DataTables::use($this->table)
        ->where(['unit'=>$unit])
        ->make(true);
    }
    
    public function insertDataEskul($data)
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

    public function updateDataEskul($id,$data)
    {
        $this->transBegin();
        $this->set($data, false);
        $this->where('id_eskul', $id);
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
        $this->set('status', 'Non-Aktif');
        $this->where('id_eskul', $id);
        $this->update();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function getDataEskulById($id)
    {
        $result = $this->getWhere(['id_eskul' => $id]);
        return $result;
    }

    public function getListEskul()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit' => $unit]);
        return $result;
    }

    public function getCountEskul()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit'=>$unit])->getNumRows();
        return $result;
    }

    

}