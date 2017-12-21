<?php

Class Schememodel extends CI_Model
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
       function update_scheme($scheme_name,$scheme_info,$scheme_video_link,$scheme_photos,$user_id){
          $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
          $update_scheme="UPDATE edu_scheme_details SET scheme_name='$scheme_name',scheme_info='$scheme_info',scheme_video='$scheme_video_link',status='Active',updated_by='$user_id',updated_at=NOW() WHERE id='1'";
          $result=$this->db->query($update_scheme);
          if($result){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failed");
            return $data;
          }
       }

       //GET ALL TERMS

        function create_gallery($file_name,$user_id){
            $acd_year=$this->get_cur_year();
            $year_id= $acd_year['cur_year'];
            $count_picture=count($file_name);

          for($i=0;$i<$count_picture;$i++){
            $gal_l=$file_name[$i];
             $gall_img="INSERT INTO edu_scheme_photos(scheme_id,scheme_photo,status,created_by,created_at,updated_at,updated_by) VALUES('1','$gal_l','Active','$user_id',NOW(),NOW(),'$user_id')";
             $res_gal   = $this->db->query($gall_img);
              }

          if ($res_gal) {
              $data = array(
                  "status" => "success"
              );
              return $data;
          } else {
              $data = array(
                  "status" => "failed"
              );
              return $data;
          }

        }

        // Get all Scheme Pictures
        function get_scheme_gallery_img(){
           $get_all_gallery_img="SELECT * FROM edu_scheme_photos WHERE scheme_id='1'";
          $get_all=$this->db->query($get_all_gallery_img);
          return $get_all->result();
        }

        // Getting details about scheme
        function get_scheme_details(){
         $get_all_gallery_img="SELECT * FROM edu_scheme_details WHERE id='1'";
          $get_all=$this->db->query($get_all_gallery_img);
          return $get_all->result();
        }

        function delete_gal($scheme_photo_id){
          $get_all_gallery_img="DELETE  FROM edu_scheme_photos WHERE id='$scheme_photo_id'";
          $get_all=$this->db->query($get_all_gallery_img);
          if ($get_all) {
            echo "success";
          } else {
              echo "Something Went Wrong";
          }
        }








}
?>
