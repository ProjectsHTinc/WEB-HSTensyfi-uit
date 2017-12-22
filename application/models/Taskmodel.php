<?php
Class Taskmodel extends CI_Model
{
    public function __construct()
    {
      parent::__construct();
    }

    function getYear()
    {
      $sqlYear ="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year   = $year_result->result();
      if ($year_result->num_rows() == 1) {
       foreach ($year_result->result() as $rows) {
         $year_id = $rows->year_id;
         }
          return $year_id;
        }
    }

    function getall_details()
    {
      $query1="SELECT ta.*,us.name FROM edu_task AS ta,edu_users AS us WHERE ta.user_id=us.user_id";
      $res=$this->db->query($query1);
      return $res->result();
    }
    
    function getall_users_details()
    {
      $query1="SELECT * FROM edu_users WHERE user_type IN(3,4)";
      $res=$this->db->query($query1);
      return $res->result();
    }

   function add_task_details($users_name,$title,$task_date,$description,$status,$user_id)
   {
      $check="SELECT * FROM  edu_task WHERE task_title='$title' AND task_date='$task_date' AND user_id='$users_name' ";   
      $result = $this->db->query($check);
      if($result->num_rows() == 0) 
      {
      $query = "INSERT INTO edu_task(user_id,task_title,task_description,task_date,status,created_by,created_at)VALUES('$users_name','$title','$description','$task_date','$status','$user_id',NOW())";
      $resultset = $this->db->query($query);
      $data = array("status" => "success");
      return $data;
    }
 }

   
    function edit_task_details($task_id)
    {
      $query1 = "SELECT * FROM  edu_task WHERE id='$task_id'";
      $res    = $this->db->query($query1);
      return $res->result();
    }

    function update_task_details($task_id,$users_name,$title,$task_date,$description,$status,$user_id)
    {
     
      $query = "UPDATE edu_task SET user_id='$users_name',task_title='$title',task_description='$description',task_date='$task_date',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$task_id,'";
      $res   = $this->db->query($query);
      $data  = array("status" => "success");
      return $data;
    }


}
?>
