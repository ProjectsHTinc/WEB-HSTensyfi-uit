<?php

Class Successstorymodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL Years
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
        function get_cur_year(){
          $check_year="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month";
          $get_year=$this->db->query($check_year);
          foreach($get_year->result() as $current_year){}
          //
          if($get_year->num_rows()==1){
            $acd_year= $current_year->year_id;
            $data= array("status" =>"success","cur_year"=>$acd_year);
            //print_r($data);exit;
             return $data;
          }else{
            $data= array("status" =>"noYearfound");
            return $data;
          }

        }



        function get_all_user_story(){
          $query="SELECT * FROM edu_users WHERE user_type IN (3,5)";
          $result=$this->db->query($query);
          return $result->result();
        }












}
?>
