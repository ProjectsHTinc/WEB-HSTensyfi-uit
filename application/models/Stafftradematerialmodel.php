<?php

Class Stafftradematerialmodel extends CI_Model
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

    function get_all_active_trade($user_id,$user_type)
    {
      $acd_year=$this->get_cur_year();
      $year_id= $acd_year['cur_year'];

      $staffid="SELECT user_master_id FROM edu_users WHERE user_id='$user_id' AND user_type='$user_type'";
      $res1=$this->db->query($staffid);
      $row=$res1->result();
      $staff_id=$row[0]->user_master_id; 

      $get_alltrade="SELECT st.*,tb.year_id,tb.trade_id,t.trade_name FROM edu_staff_handling_trade AS st,edu_trade_batch AS tb,edu_trade AS t WHERE st.staff_id='$staff_id' AND st.trade_batch_id=tb.id AND tb.trade_id=t.id AND st.status='Active' AND st.year_id='$year_id' AND st.year_id=tb.year_id GROUP BY tb.trade_id";
      $res=$this->db->query($get_alltrade);
      return $res->result();
    }
       //GET ALL TERMS

       function checking_title($trade_title,$trade_id)
       {
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
        $get_alltrade="SELECT * FROM edu_trade_materials  WHERE trade_title='$trade_title' AND trade_id='$trade_id' AND year_id='$year_id'";
         $res=$this->db->query($get_alltrade);
         if($res->num_rows()==0){
           $data = array(
               "status" => "success"
           );
           return $data;
         }else{
           $data = array(
               "status" => "already exist"
           );
           return $data;
         }
       }

       function getData($m_title,$trade_id){
       $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
        
        $query="SELECT * FROM edu_trade_materials  WHERE trade_title='$m_title' AND trade_id='$trade_id' AND year_id='$year_id'";
         $resultset = $this->db->query($query);
         return count($resultset->result());
       }


       function get_all_trade_material($user_id,$user_type)
       {
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];

        $get_alltrade="SELECT et.trade_name,etm.* FROM edu_trade_materials AS etm LEFT JOIN edu_trade AS et ON et.id=etm.trade_id WHERE etm.created_by='$user_id' AND etm.year_id='$year_id' ORDER BY etm.id DESC";
        $res=$this->db->query($get_alltrade);
        return $res->result();
       }

        function create_trade_material($trade_title,$trade_id,$trade_info,$trade_video_link,$trade_file,$status,$user_id){
            $acd_year=$this->get_cur_year();
            $year_id= $acd_year['cur_year'];
             $insert="INSERT INTO edu_trade_materials (year_id,trade_id,trade_title,trade_info,trade_file,trade_video,status,created_by,created_at) VALUES('$year_id','$trade_id','$trade_title','$trade_info','$trade_file','$trade_video_link','$status','$user_id',NOW())";
             $res=$this->db->query($insert);
            if ($res) {
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

        function update_trade_material($trade_material_id,$trade_title,$trade_id,$trade_info,$trade_video_link,$trade_file,$status,$user_id){
         //echo $status; exit;
          $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
           $get_alltrade="SELECT * FROM edu_trade_materials  WHERE trade_title='$trade_title' AND year_id='$year_id'";

           $res=$this->db->query($get_alltrade);
             if($res->num_rows()==0){
             $update="UPDATE edu_trade_materials SET trade_title='$trade_title',trade_info='$trade_info',trade_file='$trade_file',trade_video='$trade_video_link',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$trade_material_id'";
             $res=$this->db->query($update);
            if ($res) {
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
           }else{
             $data = array(
                 "status" => "already exist"
             );
             return $data;
           }

        }

        function create_trade_gallery($trade_material_gallery_id,$file_name,$user_id){
          $acd_year=$this->get_cur_year();
          $year_id= $acd_year['cur_year'];
           $count_picture=count($file_name);

        for($i=0;$i<$count_picture;$i++){
          $gal_l=$file_name[$i];
          $gall_img="INSERT INTO edu_trade_photos(trade_material_id,trade_picture,status,created_by,created_at,updated_at,updated_by) VALUES('$trade_material_gallery_id','$gal_l','Active','$user_id',NOW(),NOW(),'$user_id')";
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
        function get_trade_gallery_img($trade_material_gallery_id){
           $get_all_gallery_img="SELECT * FROM edu_trade_photos WHERE trade_material_id='$trade_material_gallery_id'";
          $get_all=$this->db->query($get_all_gallery_img);
          return $get_all->result();
        }


        function delete_gal($gal_id){
          $get_all_gallery_img="DELETE  FROM edu_trade_photos WHERE id='$gal_id'";
          $get_all=$this->db->query($get_all_gallery_img);
          if ($get_all) {
            echo "success";
          } else {
              echo "Something Went Wrong";
          }
        }

        function edit_trade_material($trade_material_id){
          $get_trade_id="SELECT et.trade_name,etm.* FROM edu_trade_materials AS etm LEFT JOIN edu_trade AS et ON et.id=etm.trade_id WHERE etm.id='$trade_material_id'";
          $get_all=$this->db->query($get_trade_id);
          return $get_all->result();

        }









}
?>
