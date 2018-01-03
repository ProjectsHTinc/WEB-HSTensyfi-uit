<?php

Class Usermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

	 function get_mobilizer_details()
	 {
	   $query="SELECT es.email,eu.name,eu.user_name,eu.user_id,eu.created_date,eu.status FROM edu_users as eu left join edu_staff_details as es on eu.user_master_id=es.id where eu.user_type='4' ORDER BY `eu`.`user_master_id` DESC";
	   $result=$this->db->query($query);
	   return $result->result();
	 }
     function get_staff()
     {
        $query="SELECT es.email,eu.* FROM edu_users as eu left join edu_staff_details as es on eu.user_master_id=es.id where eu.user_type='3'";
        $result=$this->db->query($query);
        return $result->result();
     }
     function get_student()
     {
        $query="SELECT es.email,eu.* FROM edu_users as eu left join edu_admission as es on eu.user_master_id=es.id  where eu.user_type='5'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function get_userid($user_id_profile)
     {

         $query="SELECT * FROM edu_users WHERE user_id='$user_id_profile'";
        $result=$this->db->query($query);
        return $result->result();
     }

     function save_profile_id($user_profile_id,$status)
     {
        $query="UPDATE edu_users SET status='$status' WHERE user_id='$user_profile_id'";
       $result=$this->db->query($query);
       $data= array("status"=>"success");
       return $data;
     }




}
?>
