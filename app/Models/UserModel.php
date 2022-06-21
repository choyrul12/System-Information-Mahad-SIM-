<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $userModel;
    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['accesskey', 'username', 'password', 'level', 'section', 'unit', 'status'];

    function checkDataLogin($key,$pass){
        
        $admin  = $this->query("SELECT *, id_admin AS id FROM tb_admin WHERE accesskey = '$key' AND password = md5('$pass') AND section != '' AND level != ''");
        $guru   = $this->query("SELECT *, id_guru AS id FROM tb_guru WHERE accesskey = '$key' AND password = md5('$pass') AND section != '' AND level != ''");
        $pesdik = $this->select('tb_pesdik.id_pesdik AS id, tb_pesdik.nm_pesdik AS username, tb_pesdik.unit, tb_user.accesskey, tb_user.section, tb_user.level')->join('tb_pesdik', 'tb_pesdik.nisn = tb_user.accesskey')->getWhere(['accesskey' => $key, 'password' => md5($pass), 'tb_user.status' => 'Aktif', 'level !=' => '', 'section !=' => '']);
        if($admin->getNumRows()==1){
            return $admin->getRow();
        }elseif($guru->getNumRows()==1){
            return $guru->getRow();
        }elseif($pesdik->getNumRows()==1){
            return $pesdik->getRow();
        }
    }

    public function createUserPesdik($data)
    {
        $user = array();
        foreach($data as $d){
            array_push($user,array(
                "accesskey" => $d['nisn'],
                "password" => md5($d['nisn']),
                "level" => "3",
                "section" => "PESDIK"
            ));
        }
        $this->transBegin();
        $this->insertBatch($user);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }
    
    public function createSingleUserPesdik($data)
    {
        $user = [
                "accesskey" => $data['nisn'],
                "password" => md5($data['nisn']),
                "level" => "3",
                "section" => "PESDIK"
        ];
        $this->transBegin();
        $this->insert($user);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }

    public function createUserGuru($data)
    {
        $user = array();
        foreach($data as $d){
            array_push($user,array(
                "accesskey" => $d['nip'],
                "username" => $d['nm_guru'],
                "password" => md5($d['password']),
                "level" => "User",
                "section" => "Academic",
                "unit" => $d['unit']
            ));
        }
        $this->transBegin();
        $this->insertBatch($user);
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Input";
        }else{
            $this->transCommit();
            return "Success Input";
        }
    }

    public function nonaktifUserByKey($key)
    {
        $this->transBegin();
        $this->set('status', 'Non-Aktif');
        $this->where('accesskey', $key);
        $this->update();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }

    public function aktifUserByKey($key)
    {
        $this->transBegin();
        $this->set('status', 'Aktif');
        $this->where('accesskey', $key
    );
        $this->update();
        if ($this->transStatus() === FALSE){
            $this->transRollback();
            return "Failed Delete";
        }else{
            $this->transCommit();
            return "Success Delete";
        }
    }
}