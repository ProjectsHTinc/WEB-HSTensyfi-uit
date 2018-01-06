<?php

Class Staffmodel extends CI_Model
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


    function get_all_active_role(){
      $select="SELECT * FROM edu_role Where status='Active'";
      $result=$this->db->query($select);
      return $result->result();
    }


    function checkemail($email){
     $select="SELECT * FROM edu_staff_details Where email='$email'";
      $result=$this->db->query($select);
      if($result->num_rows()>0){
        echo "false";
        }else{
          echo "true";
      }
    }
    function checkmobile($mobile){
     $select="SELECT * FROM edu_staff_details Where phone='$mobile'";
      $result=$this->db->query($select);
      if($result->num_rows()>0){
        echo "false";
        }else{
          echo "true";
      }
    }

    function checkemail_edit($email,$staff_id){
      $select="SELECT * FROM edu_staff_details Where email='$email' AND id!='$staff_id'";
      $result=$this->db->query($select);
      if($result->num_rows()>0){
            echo 'false';
        }else{
          echo 'true';
      }
    }
    function checkmobile_edit($mobile,$staff_id){
     $select="SELECT * FROM edu_staff_details Where phone='$mobile' AND id!='$staff_id'";
      $result=$this->db->query($select);
      if($result->num_rows()==0){
        echo "false";
        }else{
          echo "true";
      }
    }

    function create_staff_details($select_role,$name,$address,$email,$class_tutor,$mobile,$sec_phone,$sex,$dob,$nationality,$religion,$community_class,$community,$qualification,$status,$staff_prof_pic,$user_id){

      $select="SELECT * FROM edu_staff_details Where email='$email' AND phone='$mobile'";
       $result=$this->db->query($select);
       if($result->num_rows()>0){
         $data = array(
             "status" => "already"
         );
         return $data;
         }else{
           $insert="INSERT INTO edu_staff_details (role_type,name,sex,dob,nationality,religion,community_class,community,address,email,phone,sec_phone,profile_pic,trade_batch_id,qualification,status,created_by,created_at) VALUES('$select_role','$name','$sex','$dob','$nationality','$religion','$community_class','$community','$address','$email','$mobile','$sec_phone','$staff_prof_pic','$class_tutor','$qualification','$status','$user_id',NOW())";
            $result=$this->db->query($insert);
            $insert_id = $this->db->insert_id();
            $digits = 6;
        		$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        		$md5pwd=md5($OTP);
            if($select_role=='2'){
                $user_name='admin_'.$insert_id.'';
            }else if($select_role=='3'){
              $user_name=$insert_id+800000;
            }else if($select_role=='4'){
              $user_name=$insert_id+600000;
            }else{
              $data = array(
                  "status" => "something went wrong"
              );
            }
            $user_table="INSERT INTO edu_users (name,user_name,user_password,user_type,user_master_id,created_date,status,last_login_date) VALUES('$name','$user_name','$md5pwd','$select_role','$insert_id',NOW(),'Active',NOW())";
              $result_user=$this->db->query($user_table);
              $to =$email;
              $subject ='"Welcome Message"';
              $htmlContent = '
              <html>
              <head>  <title></title>
              </head>
              <body style="background-color:beige;">
              <table cellspacing="0" style=" width: 300px; height: 200px;">
              <tr>
              <th>Email:</th><td>'.$email.'</td>
              </tr>
              <tr>
              <th>Username :</th><td>'.$user_name.'</td>
              </tr>
              <tr>
              <th>Password:</th><td>'.$OTP.'</td>
              </tr>
              <tr>
              <th></th><td><a href="'.base_url() .'">Click here  to Login</a></td>
              </tr>
              </table>
              </body>
              </html>';
              // Set content-type header for sending HTML email
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              // Additional headers
              $headers .= 'From: ensyi<info@ensyi.com>' . "\r\n";
              mail($to,$subject,$htmlContent,$headers);
            if ($result_user) {
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




    }

    function get_all_staff_details(){
      $select="SELECT er.user_type_name,esd.*,eu.name AS created_user,c.trade_name,s.batch_name FROM edu_staff_details  AS esd LEFT JOIN edu_role AS er ON er.id=esd.role_type LEFT JOIN edu_users AS eu ON esd.created_by=eu.user_id LEFT JOIN edu_trade_batch AS cm
      ON esd.trade_batch_id=cm.id LEFT JOIN edu_trade AS c ON cm.trade_id=c.id LEFT JOIN edu_batch AS s ON cm.batch_id=s.id ORDER BY id DESC";
      $result=$this->db->query($select);
      return $result->result();
    }

    function get_all_staff_details_by_id($staff_id){
      $select="SELECT * FROM edu_staff_details WHERE id='$staff_id'";
      $result=$this->db->query($select);
      return $result->result();
    }




    function update_staff_details_to_id($select_role,$name,$address,$email,$class_tutor,$mobile,$sec_phone,$sex,$dob,$nationality,$religion,$community_class,$community,$qualification,$status,$staff_prof_pic,$user_id,$staff_id){

       $update="UPDATE edu_staff_details SET name='$name',sex='$sex',address='$address',email='$email',trade_batch_id='$class_tutor',phone='$mobile',sec_phone='$sec_phone',dob='$dob',nationality='$nationality',religion='$religion',community_class='$community',community='$community',
      qualification='$qualification',status='$status',profile_pic='$staff_prof_pic',updated_at=NOW(),updated_by='$user_id' WHERE id='$staff_id'";

      $result=$this->db->query($update);

      $update_user="UPDATE edu_users SET name='$name' WHERE user_type='$select_role' AND user_master_id='$staff_id'";
      $result_user=$this->db->query($update_user);
      if ($result_user) {
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


    function get_non_exist_class_for_trainer(){
      $acd_year=$this->get_cur_year();
      $year_id= $acd_year['cur_year'];
      $select="SELECT  e.id as trade_batch_id,c.trade_name,s.batch_name FROM  edu_trade_batch  AS e INNER JOIN edu_trade_batch  AS cm ON e.id=cm.id
      INNER JOIN edu_trade AS c ON cm.trade_id=c.id INNER JOIN edu_batch AS s ON cm.batch_id=s.id WHERE
      NOT EXISTS (SELECT  NULL FROM edu_staff_details AS  sd WHERE   sd.trade_batch_id = e.id) AND e.year_id='$year_id' AND e.status='Active'";
      $result=$this->db->query($select);
      return $result->result();

    }
    function get_all_trade_batch(){
      $acd_year=$this->get_cur_year();
      $year_id= $acd_year['cur_year'];
      $query="SELECT cm.id,c.trade_name,s.batch_name FROM edu_trade_batch AS cm LEFT JOIN edu_trade AS c ON cm.trade_id=c.id
      LEFT JOIN edu_batch AS s ON cm.batch_id=s.id WHERE cm.year_id='$year_id' AND cm.status='Active'";
      $result=$this->db->query($query);
      return $result->result();
    }


    function trainer_handling_trade_form($trade_id,$staff_id,$status,$user_id){
      $acd_year=$this->get_cur_year();
      $year_id= $acd_year['cur_year'];
     $check="SELECT * FROM edu_staff_handling_trade WHERE staff_id='$staff_id' AND trade_batch_id='$trade_id' AND year_id='$year_id'";
      $result=$this->db->query($check);
      if($result->num_rows()==0){
        $insert="INSERT INTO edu_staff_handling_trade (year_id,staff_id,trade_batch_id,status,created_by,created_at) VALUES('$year_id','$staff_id','$trade_id','$status','$user_id',NOW())";
        $result=$this->db->query($insert);
        if($result){
          echo "success";
        }else{
          echo "Something Went wrong";
        }
      }else{
        echo "Already Exist";
      }


    }


    function view_trainer_handling_trade(){
      $acd_year=$this->get_cur_year();
      $year_id= $acd_year['cur_year'];
      $select="SELECT c.trade_name,s.batch_name,esd.name,esht.* FROM edu_staff_handling_trade  AS esht LEFT JOIN edu_trade_batch AS cm ON esht.trade_batch_id=cm.id LEFT JOIN edu_trade AS c ON cm.trade_id=c.id LEFT JOIN edu_batch AS s ON cm.batch_id=s.id
      LEFT JOIN edu_staff_details AS esd ON esht.staff_id=esd.id WHERE  esht.year_id='$year_id'";
      $result=$this->db->query($select);
      return $result->result();

      }

      function get_trainer_handling_trade($id){
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
        $get_id=base64_decode($id);
         $select="SELECT c.trade_name,s.batch_name,esd.name,esht.* FROM edu_staff_handling_trade  AS esht LEFT JOIN edu_trade_batch AS cm ON esht.trade_batch_id=cm.id LEFT JOIN edu_trade AS c ON cm.trade_id=c.id LEFT JOIN edu_batch AS s ON cm.batch_id=s.id
        LEFT JOIN edu_staff_details AS esd ON esht.staff_id=esd.id WHERE  esht.year_id='$year_id' AND esht.id='$get_id'";
        $result=$this->db->query($select);
        return $result->result();
      }

      function update_trainer_handling_trade_form($trade_batch_id,$staff_id,$id,$status,$user_id){
        $acd_year=$this->get_cur_year();
        $year_id= $acd_year['cur_year'];
       $check="SELECT * FROM edu_staff_handling_trade WHERE staff_id='$staff_id' AND trade_batch_id='$trade_batch_id' AND year_id='$year_id'";
        $result=$this->db->query($check);
        if($result->num_rows()==0){
           $update="UPDATE edu_staff_handling_trade SET status='$status',trade_batch_id='$trade_batch_id',updated_by='$user_id',updated_at=NOW() WHERE id='$id' AND staff_id='$staff_id'";
        $result=$this->db->query($update);
          if($result){
            echo "success";
          }else{
            echo "Something Went wrong";
          }
        }else{
          echo "Already Exist";
        }
      }



}
?>
