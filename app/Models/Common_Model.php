<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class Common_Model extends Model
{
    protected $table = 'register';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name','role'];

    public function getreq()
    {
    $this->db->where('status','pending');
    $query=$this->db->get('instanthire');
    $result=$query->result();
    $num_rows=$query->num_rows();
    $last_three_record=array_slice($result,-3,3,true);
    return array("all_data"=>$result,"num_rows"=>$num_rows,"last_three"=>$last_three_record);
    }
}