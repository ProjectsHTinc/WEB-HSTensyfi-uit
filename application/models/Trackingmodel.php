<?php

Class Trackingmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//GET ALL Years

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

        function get_lat_and_long_id($user_id,$selected_date){
          $select="SELECT (@cnt := @cnt + 1) AS DisplayText,user_location AS ADDRESS, CONCAT(user_lat,',',user_long) AS LatitudeLongitude,created_at FROM edu_tracking_details CROSS JOIN (SELECT @cnt := 0) AS dummy
          WHERE user_id='$user_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$selected_date'  ORDER BY created_at ASC";
          $get_result=$this->db->query($select);
          return $get_result->result();

        }

        function testing_track($user_id,$selected_date){
          $select="SELECT etd.user_location AS address,etd.user_lat AS lat ,etd.user_long AS lng FROM edu_users AS eu LEFT JOIN edu_tracking_details AS etd ON eu.user_id=etd.user_id  WHERE eu.user_id='$user_id'  AND DATE_FORMAT(created_at, '%Y-%m-%d')='$selected_date' ORDER BY created_at ASC";
          // $select="SELECT etd.user_location AS address, LEFT(etd.user_lat , 6) AS lat ,LEFT(etd.user_long , 6) AS lng FROM edu_users AS eu LEFT JOIN edu_tracking_details AS etd ON eu.user_id=etd.user_id  WHERE eu.user_id='$user_id'  AND DATE_FORMAT(created_at, '%Y-%m-%d')='$selected_date' ORDER BY created_at ASC";
          $get_result=$this->db->query($select);
          $get_res=$get_result->result();
          // $data= array("address" =>$get_res);
        if($get_result->num_rows()==0){
          $address[]= array ("address"  => array("address" => "nofound", "lat" => "nofound", "lng" => "nofound"), "title" => "nofound","status" =>"nofound");
        }else{
          foreach($get_res as $rows){
          $lat=$rows->lat;
          $lng=$rows->lng;
          $loca=$rows->address;
            $address[] = array ("address"  => array("address" => $loca, "lat" => $lat, "lng" => $lng), "title" => "title","status" =>"found");
             }
        }
          return $address;
        }

        function get_lat_and_long_id_table_view($user_id,$selected_date){
           $select="SELECT etd.user_location,eu.name,etd.user_lat,etd.user_long, (@cnt := @cnt + 1) AS rowNumber,etd.created_at,
          etd.id FROM edu_users AS eu  CROSS JOIN (SELECT @cnt := 0) AS dummy LEFT JOIN edu_tracking_details AS etd ON eu.user_id=etd.user_id  WHERE eu.user_id='$user_id'  AND DATE_FORMAT(created_at, '%Y-%m-%d')='$selected_date' ORDER BY created_at ASC";

          $get_result=$this->db->query($select);
          return $get_result->result();

        }


        function map_inter($user_id,$selected_date){
            $select="SELECT (@cnt := @cnt + 1) AS DisplayText,user_location AS ADDRESS, CONCAT(user_lat,',',user_long) AS LatitudeLongitude,created_at FROM edu_tracking_details
  CROSS JOIN (SELECT @cnt := 0) AS dummy
  WHERE user_id='$user_id' AND DATE_FORMAT(created_at, '%Y-%m-%d')='$selected_date'  ORDER BY created_at ASC";

  $get_result=$this->db->query($select);
  return $get_result->result();
        }

        function testing_map(){
             $select="SELECT etd.user_lat as lat,etd.user_long as lng FROM edu_tracking_details as etd WHERE etd.user_id='5' AND DATE_FORMAT(etd.created_at, '%Y-%m-%d')='2018-01-09'  ORDER BY etd.created_at ASC";
            $get_result=$this->db->query($select);
            return $get_result->result();
        }

        function get_mobilizer_id(){
          $select="SELECT * FROM edu_users AS eu WHERE user_type='4' and status='Active'";
          $get_result=$this->db->query($select);
          return $get_result->result();
        }
















}
?>
