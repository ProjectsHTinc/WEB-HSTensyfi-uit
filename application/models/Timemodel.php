<?php
Class Timemodel extends CI_Model
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
      $query1="SELECT * FROM edu_timing ORDER BY id DESC ";
      $res=$this->db->query($query1);
      return $res->result();
    }

   function add_session_details($ses_name,$stime,$etime,$status,$user_id)
   {
      $check="SELECT * FROM  edu_timing WHERE session_name='$ses_name' AND from_time='$stime' AND to_time='$etime' ";   
      $result = $this->db->query($check);
      if($result->num_rows() == 0) 
      {
      $query = "INSERT INTO edu_timing(session_name,from_time,to_time,status,created_by,created_at)VALUES('$ses_name','$stime','$etime','$status','$user_id',NOW())";
      $resultset = $this->db->query($query);
      $data = array("status" => "success");
      return $data;
    }
 }

   
    function edit_session_details($time_id)
    {
      $query1 = "SELECT * FROM  edu_timing WHERE id='$time_id'";
      $res    = $this->db->query($query1);
      return $res->result();
    }

    function update_session_details($tid,$ses_name,$stime,$etime,$status,$user_id)
    {
     
      $query = "UPDATE edu_timing SET session_name='$ses_name',from_time='$stime',to_time='$etime',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$tid,'";
      $res   = $this->db->query($query);
      $data  = array("status" => "success");
      return $data;
    }


}
?>
