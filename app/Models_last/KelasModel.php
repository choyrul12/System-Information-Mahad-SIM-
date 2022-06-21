<?php 
namespace App\Models;
use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $KelasModel;
    protected $table = 'tb_kelas';
    protected $primaryKey = 'id_kelas';
    protected $allowedFields = ['id_kelas', 'numeric', 'romawi', 'unit'];

    public function getKelas()
    {
        $unit = session()->get('unit');
        $result = $this->getWhere(['unit' => $unit]);
        return $result;
    }
}