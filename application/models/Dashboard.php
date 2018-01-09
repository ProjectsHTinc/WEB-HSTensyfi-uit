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



  function search_data($ser_txt,$user_type){
    if($user_type=="3"){

      $query="SELECT et.id,et.name,et.phone,et.email FROM edu_staff_details AS et WHERE et.role_type='$user_type' AND et.name LIKE '$ser_txt%'";
       $result=$this->db->query($query);
       if($result->num_rows()==0){
        echo "No Data Found";
       }else{
        $output='
<div class="table-responsive">
 <table class="table table bordered">
  <tr>
   <th>S.no </th>
   <th>Name </th>
   <th>phone No</th>

   <th>Email </th>
   <th>Edit</th>
  </tr>
';
$i=1;
   foreach($result->result() as $row){
  $output .= '
   <tr>
     <td>'.$i.'</td>
    <td>'.$row->name.'</td>
    <td>'.$row->phone.'</td>

    <td>'.$row->email.'</td>
  <td><a href="'. base_url().'staff/get_teacher_id/'.$row->id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
   </tr>
  ';
  $i++;
       }echo $output;}

    }else if($user_type=="4"){

           $query="SELECT et.id,et.name,et.phone,et.email FROM edu_staff_details AS et WHERE et.role_type='$user_type' AND et.name LIKE '$ser_txt%'";
             $result=$this->db->query($query);
             if($result->num_rows()==0){
              echo "No Data Found";
             }else{
              $output='
      <div class="table-responsive">
       <table class="table table bordered">
        <tr>
         <th>S.no </th>
         <th>Name </th>
         <th>phone No</th>

         <th>Email </th>
         <th>Edit</th>
        </tr>
      ';
      $i=1;
         foreach($result->result() as $row){
        $output .= '
         <tr>
           <td>'.$i.'</td>
          <td>'.$row->name.'</td>
          <td>'.$row->phone.'</td>

          <td>'.$row->email.'</td>
        <td><a href="'. base_url().'staff/get_teacher_id/'.$row->id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
         </tr>
        ';
        $i++;
             }echo $output;}
    }else if($user_type=="5"){
      $query="SELECT ea.id,ea.name,ea.mobile,ea.email,ea.enrollment FROM edu_admission AS ea  WHERE ea.name LIKE '$ser_txt%'";
        $result=$this->db->query($query);
        if($result->num_rows()==0){
         echo "No Data Found";
        }else{
         $output='
 <div class="table-responsive">
  <table class="table table bordered">
   <tr>
    <th>S.no </th>
    <th>Name </th>
    <th>phone No</th>

    <th>Email </th>
    <th>Edit</th>
   </tr>
 ';
 $i=1;
    foreach($result->result() as $row){
   $output .= '
    <tr>
      <td>'.$i.'</td>
     <td>'.$row->name.'</td>
     <td>'.$row->mobile.'</td>

     <td>'.$row->email.'</td>
   <td><a href="'. base_url().'staff/get_teacher_id/'.$row->id.'" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a></td>
    </tr>
   ';
   $i++;
        }echo $output;}
    }else{
        echo "<center>Enter the Text for Search</center>";
    }
  }









}
?>
