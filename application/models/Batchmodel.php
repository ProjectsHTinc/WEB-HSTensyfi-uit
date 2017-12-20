<?php

Class Batchmodel extends CI_Model
{

  public function __construct()
  {
   parent::__construct();
  }
  
  public function getYear()
  { 
    $sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
    $year_result = $this->db->query($sqlYear);
    $ress_year = $year_result->result();
    if($year_result->num_rows()==1)
    {
     foreach ($year_result->result() as $rows)
     {
      $year_id = $rows->year_id;
     }
     return $year_id;
    }
 }

  //GET ALL Details

  function get_batch_details()
  {
    $query="SELECT * FROM edu_batch";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


  //CREATE BATCH NAME

  function add_batch_details($batchname,$status,$user_id)
  { 
    $year_id=$this->getYear();

    $check_batch="SELECT * FROM edu_batch WHERE batch_name='$batchname'";
    $res=$this->db->query($check_batch);
    if($res->num_rows()==0){
    $query="INSERT INTO edu_batch(year_id,batch_name,status,created_at,created_by) VALUES ('$year_id','$batchname','$status',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    $data= array("status" => "success");
    return $data;
    }else{
    $data= array("status" => "Already exist");
    return $data;
    }
  }

  //GET SPECIFIC Edit Batch 
  function edit_batch($batch_id)
  {
    $query="SELECT * FROM edu_batch WHERE id='$batch_id'";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


  //UPDATE SECTION NAME
  function save_batch($batch_name,$batch_id,$status,$user_id)
  {
    // $check_class="SELECT * FROM edu_batch WHERE batch_name='$batch_name' AND status='$status'";
    // $res=$this->db->query($check_class);
    // if($res->num_rows()==0){
    $query="UPDATE edu_batch SET batch_name='$batch_name',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$batch_id'";
    $resultset=$this->db->query($query);
    $data= array("status" => "success");
    return $data;
    // }else{
    // $data= array("status" => "Already exist");
    // return $data;
    // }
  }


}
?>
