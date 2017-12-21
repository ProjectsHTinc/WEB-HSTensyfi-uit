<?php

Class Classmanagemodel extends CI_Model
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

  // Trade Details
  function get_all_trade_details()
  {
    $year_id=$this->getYear();
    $query="SELECT * FROM edu_trade WHERE status='Active' AND year_id='$year_id'";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }

  // Batch Details
  function get_all_batch_details()
  {
    $year_id=$this->getYear();
    $query="SELECT * FROM edu_batch WHERE status='Active' AND year_id='$year_id'";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }

  function get_all_details()
  {
    $year_id=$this->getYear();
    
    $query="SELECT cm.*,t.trade_name,b.batch_name FROM  edu_trade_batch AS cm,edu_trade AS t,edu_batch AS b WHERE  cm.year_id='$year_id' AND cm.trade_id=t.id AND cm.batch_id=b.id";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }

  //GET ALL SECTION
  function assign($trade_id,$batch_id,$status,$user_id)
  {
    $year_id=$this->getYear();

    $query="SELECT * FROM edu_trade_batch WHERE trade_id='$trade_id' AND batch_id='$batch_id'";
    $resultset=$this->db->query($query);
    if($resultset->num_rows()==0){
    $query="INSERT INTO edu_trade_batch (year_id,trade_id,batch_id,status,created_at,created_by) VALUES ('$year_id','$trade_id','$batch_id','$status',NOW(),'$user_id')";
    $resultset=$this->db->query($query);
    $data= array("status" => "success");
    return $data;
    }else{
    $data= array("status" => "Already Exist");
    return $data;
    }

  }

  function getclass()
  {
    $query="SELECT class_id,class_name FROM edu_class ORDER BY class_id DESC";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }

  function getall_class()
  {
    $query="SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.status FROM edu_class AS c,edu_sections AS s ,edu_trade_batch AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
    $result=$this->db->query($query);
    return $result->result();
  }

  function edit_cs($class_sec_id)
  {
    $query="SELECT t.trade_name,t.id,b.batch_name,b.id,cm.id,cm.trade_id,cm.batch_id,cm.status FROM edu_trade AS t,edu_batch AS b,edu_trade_batch AS cm WHERE cm.trade_id=t.id AND cm.batch_id =b.id AND cm.id='$class_sec_id'";
    $result=$this->db->query($query);
    return $result->result();
  }


  function save_cs($clsmanage_id,$trade_id,$batch_id,$status,$user_id)
  { 

    $check_class="SELECT * FROM edu_trade_batch WHERE trade_id='$trade_id' AND batch_id='$batch_id' AND status='$status'";
    $resultset=$this->db->query($check_class);
    if($resultset->num_rows()==0)
    {
     $query="UPDATE edu_trade_batch SET trade_id='$trade_id',batch_id='$batch_id',status='$status',updated_at=NOW(),updated_by ='$user_id' WHERE id='$clsmanage_id'";
       $resultset1=$this->db->query($query);
       if($resultset1)
       {
       $data= array("status" => "success");
       return $data;
    }
  }else{
    $data= array("status" => "AE");
    return $data;
    }
}


  function delete_cs($class_sec_id)
  {
    $query="DELETE FROM edu_trade_batch WHERE class_sec_id='$class_sec_id'";
    $resultset=$this->db->query($query);
    $data= array("status" => "success");
    return $data;
  }


}
?>
