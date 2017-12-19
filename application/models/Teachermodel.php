<?php

Class Teachermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

//CREATE ADMISSION


        function teacher_create($name,$email,$sec_email,$sex,$formatted_date,$age,$nationality,$religion,$community_class,$community,$mobile,$sec_phone,$address,$class_teacher,$class_name,$subject,$multiple_sub,$qualification,$groups_id,$activity_id,$status,$user_id,$userFileName)
		{
          $check_email="SELECT * FROM edu_teachers WHERE email='$email'";
          $result=$this->db->query($check_email);
          if($result->num_rows()==0){
         $query="INSERT INTO edu_teachers(name,email,sec_email,sex,dob,age,nationality,religion,community_class,community,phone,sec_phone,address,class_teacher,class_name,subject,subject_handling,qualification,house_id,extra_curicullar_id,profile_pic,created_by,created_at,status) VALUES ('$name','$email','$sec_email','$sex','$formatted_date','$age','$nationality','$religion','$community_class','$community','$mobile','$sec_phone','$address','$class_teacher','$class_name','$subject','$multiple_sub','$qualification','$groups_id','$activity_id','$userFileName','$user_id',NOW(),'$status')";
           $resultset=$this->db->query($query);
           $insert_id = $this->db->insert_id();
          $digits = 6;
       		$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

		   $sql="SELECT count(*) AS teacher FROM edu_teachers" ;
			 // $resultsql=$this->db->query($sql);
			   $resultsql=$this->db->query($sql);
               $result1= $resultsql->result();
               $cont=$result1[0]->teacher;
			   $user_id=$cont+800000;

         $to = $email;
         $subject = '"Welcome Message"';
         $htmlContent = '

           <html>
           <head>  <title></title>
           </head>
           <body style="background-color:beige;">

             <table cellspacing="0" style=" width: 300px; height: 200px;">
                   <tr>
                       <th>Name:</th><td>'.$name.'</td>
                   </tr>
                   <tr>
                       <th>Email:</th><td>'.$email.'</td>
                   </tr>
                   <tr>
                       <th>Username :</th><td>'.$user_id.'</td>
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
       $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
       mail($to,$subject,$htmlContent,$headers);

        $query="INSERT INTO edu_users (name,user_name,user_password,user_pic,user_type,user_master_id,teacher_id,created_date,updated_date,status) VALUES ('$name','$user_id',md5($OTP),'$userFileName','2','$insert_id','$insert_id',NOW(),NOW(),'$status')";

          $resultset=$this->db->query($query);
            $data= array("status" => "success");
            return $data;
          }else{
            $data= array("status" => "Email Already Exist");
            return $data;
          }

       }

      //  Subject Handling
      function subject_handling($user_id,$subject_id,$class_master_id,$teacher_id,$status){
          $check ="SELECT * FROM edu_teacher_handling_subject WHERE class_master_id='$class_master_id' AND subject_id='$subject_id'  AND status='$status'";
          $result=$this->db->query($check);
          if($result->num_rows()==0){
            $query="INSERT INTO  edu_teacher_handling_subject (subject_id,teacher_id,class_master_id,status,created_at,created_by,updated_at) VALUES('$subject_id','$teacher_id','$class_master_id','$status',NOW(),'$user_id',NOW())";
            $res=$this->db->query($query);
            if($res){
              $data= array("status" => "success");
              return $data;
            }else{
              $data= array("status" => "failure");
              return $data;
            }
          }else{
            $data= array("status" => "already");
            return $data;
          }

      }


      // View Subject handling teacher
      function view_subject_handling_teacher(){
        $query="SELECT eths.*,et.name,c.class_name,s.sec_name,esu.subject_name FROM edu_teacher_handling_subject AS eths LEFT JOIN edu_teachers AS et ON et.teacher_id=eths.teacher_id LEFT JOIN edu_classmaster AS cm ON eths.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON eths.subject_id=esu.subject_id";
        $res=$this->db->query($query);
        return $res->result();
      }

      // GET Subject to  teacher
      function get_subject_handling_teacher($id){
        $query="SELECT eths.*,et.name,c.class_name,s.sec_name,esu.subject_name FROM edu_teacher_handling_subject AS eths LEFT JOIN edu_teachers AS et ON et.teacher_id=eths.teacher_id LEFT JOIN edu_classmaster AS cm ON eths.class_master_id=cm.class_sec_id LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id LEFT JOIN edu_subject AS esu ON eths.subject_id=esu.subject_id WHERE eths.id='$id'";
        $res=$this->db->query($query);
        return $res->result();
      }


        // Save Subject handling teacher
        function save_subject_handling($user_id,$subject_id,$class_master_id,$id,$status){
           $check="SELECT * FROM edu_teacher_handling_subject WHERE subject_id='$subject_id' AND class_master_id='$class_master_id'  AND teacher_id='$user_id' AND status='Active'";
          $result=$this->db->query($check);
          if($result->num_rows()==0){
            $query="UPDATE edu_teacher_handling_subject  SET subject_id='$subject_id',class_master_id='$class_master_id',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
            $res=$this->db->query($query);
            if($res){
              $data= array("status" => "success");
              return $data;
            }else{
              $data= array("status" => "failure");
              return $data;
            }
          }else{
            $data= array("status" => "already");
            return $data;
          }
        }


       //GET ALL Admission Form

       function get_all_teacher(){
         $query="SELECT tt.*,cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_name FROM edu_teachers AS tt  LEFT JOIN edu_classmaster AS cm ON tt.class_teacher=cm.class_sec_id
         LEFT JOIN edu_class AS c ON cm.class=c.class_id LEFT JOIN edu_sections AS s ON cm.section=s.sec_id ORDER BY teacher_id DESC";
         $res=$this->db->query($query);
         return $res->result();
       }

       function get_teacher_id($teacher_id){
         $query="SELECT * FROM edu_teachers WHERE teacher_id='$teacher_id'";
         $res=$this->db->query($query);
         return $res->result();
       }
       function check_email($email){
         echo $query="SELECT * FROM edu_admission WHERE email='$email'";
         $res=$this->db->query($query);
         if($res->num->rows()!=0){
           $data="Email Already Exist";
           return $data;
         }
       }

       function save_teacher($name,$email,$sec_email,$sex,$dob,$age,$nationality,$religion,$community_class,$community,$mobile,$sec_phone,$address,$userFileName,$class_teacher,$class_name,$subject,$multiple_sub,$qualification,$groups_id,$activity_id,$status,$user_id,$teacher_id)
	   {
            $query="UPDATE edu_teachers SET name='$name',email='$email',sec_email='$sec_email',sex='$sex',dob='$dob',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',phone='$mobile',sec_phone='$sec_phone',address='$address',profile_pic='$userFileName',class_teacher='$class_teacher',class_name='$class_name',subject='$subject',subject_handling='$multiple_sub',qualification='$qualification',house_id='$groups_id',extra_curicullar_id='$activity_id',status='$status',update_at=NOW(),updated_by='$user_id' WHERE teacher_id='$teacher_id'";
             $res=$this->db->query($query);
			  $query1="UPDATE edu_users SET name='$name',updated_date=NOW() WHERE teacher_id='$teacher_id'";
			  $res1=$this->db->query($query1);
         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }
                 function getemail($email)
		   {
					$query = "SELECT * FROM edu_teachers WHERE email='".$email."'";
					$resultset = $this->db->query($query);
					return count($resultset->result());

           }
		   function get_all_teacher1()
		   {
			      $query = "SELECT * FROM edu_teachers ";
				  $resultset = $this->db->query($query);
				  return $resultset->result();
		   }


		     //get all groups deatis

		   function get_all_groups_details()
		   {
			   $query="SELECT * FROM edu_groups WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			   return $res;
		   }

		   //get all activities deatis

		   function get_all_activities_details()
		   {
			   $query="SELECT * FROM edu_extra_curricular WHERE status='Active'";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			     return $res;
		   }
           //---------------Sorting-------------

		   function get_sorting_result()
		   {
			   $query="SELECT sex FROM edu_teachers GROUP BY sex";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			   return $res;
		   }

		   function get_all_sorting_result($gender)
		   {
			   $query="SELECT t.*,cm.class_sec_id,cm.class,cm.section,c.*,s.* FROM edu_teachers AS t,edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE t.sex='$gender' AND t.class_teacher=cm.class_sec_id AND cm.class=c.class_id AND cm.section=s.sec_id ";
     	       $resultset=$this->db->query($query);
		       $res=$resultset->result();
			   return $res;
		   }
}
?>
