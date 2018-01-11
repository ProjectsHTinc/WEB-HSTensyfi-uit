<?php

Class Centermodel extends CI_Model
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
       function update_center($center_name,$center_info,$user_id){
          $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
          $update="UPDATE edu_center_details SET center_name='$center_name',center_info='$center_info',status='Active',updated_by='$user_id',updated_at=NOW() WHERE id='1'";
          $result=$this->db->query($update);
          if($result){
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "failed");
            return $data;
          }
       }

       function update_center_logo($center_logo,$user_id){
         $update="UPDATE edu_center_details SET center_banner='$center_logo',updated_by='$user_id',updated_at=NOW() WHERE id='1'";
         $result=$this->db->query($update);
         if($result){
           $data= array("status" => "success");
           return $data;
         }else{
           $data= array("status" => "failed");
           return $data;
         }
       }


       function add_video_link($video_title,$video_link,$user_id){
         $check_batch="SELECT * FROM edu_center_videos WHERE video_title='$video_title'";
         $res=$this->db->query($check_batch);
         if($res->num_rows()==0){
         $insert="INSERT INTO edu_center_videos (center_id,video_title,center_videos,status,created_by,created_at) values('1','$video_title','$video_link','Active','$user_id',NOW())";
         $result=$this->db->query($insert);
         if($result){
           $data= array("status" => "success");
           return $data;
         }else{
           $data= array("status" => "failed");
           return $data;
         }
       }else{
         $data= array("status" => "Already exist");
         return $data;
       }

       }

       //GET ALL gallery

        function create_gallery($file_name,$user_id){
            $acd_year=$this->get_cur_year();
            $year_id= $acd_year['cur_year'];
            $count_picture=count($file_name);

          for($i=0;$i<$count_picture;$i++){
             $check_batch="SELECT * FROM edu_center_photos WHERE center_id='1'";
            $res=$this->db->query($check_batch);
             $res->num_rows();
              if($res->num_rows()>10){
              $data = array(
                  "status" => "limit"
              );
              return $data;
            }else{

              $gal_l=$file_name[$i];
               $gall_img="INSERT INTO edu_center_photos(center_id,center_photos,status,created_by,created_at,updated_at,updated_by) VALUES('1','$gal_l','Active','$user_id',NOW(),NOW(),'$user_id')";
               $res_gal   = $this->db->query($gall_img);
            }

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
           $get_all_gallery_img="SELECT * FROM edu_center_photos WHERE center_id='1'";
          $get_all=$this->db->query($get_all_gallery_img);
          return $get_all->result();
        }

        function get_all_videos(){
           $get_all_gallery_img="SELECT * FROM edu_center_videos WHERE center_id='1'";
          $get_all=$this->db->query($get_all_gallery_img);
          return $get_all->result();
        }

        // Getting details about scheme
        function get_center_details(){
         $get_all_details="SELECT * FROM edu_center_details WHERE id='1'";
          $get_all=$this->db->query($get_all_details);
          return $get_all->result();
        }

        function change_status($status,$id,$user_id){
          $get_all_details="UPDATE edu_center_videos SET status='$status' WHERE id='$id'";
           $res_gal=$this->db->query($get_all_details);
           if ($res_gal) {
              echo "success";
           } else {
              echo "failed";
           }
        }

        function delete_gal($center_photo_id){
          $get_all_gallery_img="DELETE  FROM edu_center_photos WHERE id='$center_photo_id'";
          $get_all=$this->db->query($get_all_gallery_img);
          if ($get_all) {
            echo "success";
          } else {
              echo "Something Went Wrong";
          }
        }

        function delete_videos($id){
          $get_all_gallery_img="DELETE  FROM edu_center_videos WHERE id='$id'";
          $get_all=$this->db->query($get_all_gallery_img);
          if ($get_all) {
            echo "success";
          } else {
              echo "Something Went Wrong";
          }
        }








}
?>
