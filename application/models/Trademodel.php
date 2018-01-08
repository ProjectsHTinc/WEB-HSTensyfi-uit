<?php

Class Trademodel extends CI_Model
{
   public function __construct()
   {
      parent::__construct();
   }

      //GET ALL Trade Details
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

      function getall_trade()
      {
         $query="SELECT * FROM edu_trade ORDER BY id DESC";
         $resultset=$this->db->query($query);
         return $resultset->result();
      }


      function getall_center_name()
      {
        $query="SELECT id,center_name,status FROM edu_center_details WHERE status='Active'";
         $resultset=$this->db->query($query);
         return $resultset->result();
      }




      //CREATE Trade NAME

      function add_trade($center_id,$tradename,$status,$user_id)
      {
         $year_id=$this->getYear();

         $check_class="SELECT * FROM edu_trade WHERE trade_name='$tradename'";
         $res=$this->db->query($check_class);
         if($res->num_rows()==0){
         $query="INSERT INTO edu_trade(year_id,center_id,trade_name,status,created_at,created_by) VALUES('$year_id','$center_id','$tradename','$status',NOW(),'$user_id')";
         $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;
         }else{
         $data= array("status" => "Already exist");
         return $data;
         }
      }

      //GET SPECIFIC Trade Name
      function edit_trade($id)
      {
         $query="SELECT * FROM edu_trade WHERE id='$id'";
         $resultset=$this->db->query($query);
         return $resultset->result();
      }


      //UPDATE Trade NAME
      function update_trade_details($center_id,$trade_name,$trade_id,$status,$user_id)
      {
         $check_class="SELECT * FROM edu_trade WHERE trade_name='$trade_name' AND status='$status' AND id!='$trade_id'";
         $res=$this->db->query($check_class);
         if($res->num_rows()>0){
           $data= array("status" => "Already exist");
           return $data;
         }else{

        $query="UPDATE edu_trade SET center_id='$center_id',trade_name='$trade_name',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$trade_id'";
         $resultset=$this->db->query($query);
         $data= array("status" => "success");
         return $data;
         }
      }

}
?>
