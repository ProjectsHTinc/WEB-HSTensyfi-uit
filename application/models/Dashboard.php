<?php

Class Dashboard extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

  function getYear()
  {
      $sqlYear     = "SELECT * FROM euu_academic_year WHERE CURDATE() >= from_month AND CURDATE() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year   = $year_result->result();

      if ($year_result->num_rows() == 1) {
          foreach ($year_result->result() as $rows) {
              $year_id = $rows->year_id;
          }
          return $year_id;
      }
  }

  function dash_teacher($user_id)
  {
      $query="SELECT eu.*,es.*,t.trade_name,b.batch_name FROM edu_users AS eu LEFT JOIN edu_staff_details AS es ON  es.id=eu.user_master_id LEFT JOIN edu_trade_batch AS bt ON bt.id=es.trade_batch_id LEFT JOIN edu_trade AS t ON t.id=bt.trade_id LEFT JOIN edu_batch AS b ON b.id=bt.batch_id WHERE eu.user_id='$user_id' AND eu.user_type='3'";
     $result12=$this->db->query($query);
     return  $result12->result();

    }



  function total_trainer(){
    $total_query=" SELECT COUNT(*) as total_trainer FROM edu_staff_details WHERE  role_type=3 AND STATUS='Active'";
    $result=$this->db->query($total_query);
    return  $result->result();
  }

  function total_mobilizer(){
    $total_query=" SELECT COUNT(*) as total_mobilizer FROM edu_staff_details WHERE  role_type=4 AND STATUS='Active'";
    $result=$this->db->query($total_query);
    return  $result->result();
  }

  function total_students(){
    $total_query=" SELECT COUNT(*) as total_students FROM edu_staff_details WHERE  role_type=5 AND STATUS='Active'";
    $result=$this->db->query($total_query);
    return  $result->result();
  }












}
?>
