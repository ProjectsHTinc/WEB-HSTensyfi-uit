<?php
Class Admissionmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

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

//CREATE ADMISSION

     function getall_trade()
     {
       $year_id=$this->getYear();
      $query="SELECT * FROM edu_trade WHERE status='Active' AND year_id='$year_id'";
      $resultset=$this->db->query($query);
      return $resultset->result();
     }

     function getall_session_details()
      {
      $query1="SELECT * FROM edu_timing WHERE status='Active' ORDER BY id DESC ";
      $res=$this->db->query($query1);
      return $res->result();
     }

    function ad_create($had_aadhar_card,$aadhar_card_num,$admission_location,$admission_date,$name,$fname,$mname,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$course,$mobile,$sec_mobile,$email,$userFileName,$institute_name,$last_studied,$qual,$tran_cert,$address,$disability,$city,$state,$blood_group,$status,$user_id,$prefer_time)
    {
      $select="SELECT * FROM edu_admission Where email='$email' AND mobile='$mobile'";
       $result=$this->db->query($select);
       if($result->num_rows()>0){
         $data = array(
             "status" => "already"
         );
         return $data;
       }else{
         $query="INSERT INTO edu_admission(have_aadhaar_card,aadhaar_card_number,name,sex,dob,age,nationality,religion,community_class,community,father_name,mother_name,mobile,sec_mobile,email,state,city,address,mother_tongue,disability,student_pic,blood_group,admission_date,admission_location,preferred_trade, preferred_timing,last_institute,last_studied,qualified_promotion,transfer_certificate, status,created_by,created_at) VALUES ('$had_aadhar_card','$aadhar_card_num','$name','$sex','$dob_date','$age','$nationality','$religion','$community_class','$community','$fname','$mname','$mobile','$sec_mobile','$email','$state','$city','$address','$mother_tongue','$disability','$userFileName','$blood_group','$admission_date','$admission_location','$course','$prefer_time','$institute_name','$last_studied','$qual','$tran_cert','$status','$user_id',NOW())";

          $resultset1=$this->db->query($query);
          $insert_id = $this->db->insert_id();
          $data=array("status" => "success","last_id"=>$insert_id);
          return $data;
       }

      }

       //GET ALL Admission Form
       function get_all_admission()
	   {
        $query="SELECT a.*,u.user_id,u.name as cname FROM edu_admission AS a,edu_users AS u WHERE a.created_by=u.user_id";
         $res=$this->db->query($query);
         return $res->result();
       }

	   function get_sorting_gender_details($gender)
		 {
      $query="SELECT a.*,b.blood_group_name FROM edu_admission AS a,edu_blood_group AS b WHERE a.blood_group=b.id AND a.sex='$gender' ORDER BY a.id DESC";
      $res=$this->db->query($query);
          return $res->result();
		  }

       function get_edit_details($admission_id){
         $query="SELECT * FROM edu_admission WHERE id='$admission_id'";
         $res=$this->db->query($query);
         return $res->result();
       }


       function getall_blood_group()
       {
        $blood="SELECT * FROM edu_blood_group WHERE status='Active'";
        $blood1=$this->db->query($blood);
        return $blood1->result();
       }


       function check_email($email){
         echo $query="SELECT * FROM edu_admission WHERE email='$email'";
         $res=$this->db->query($query);
         if($res->num->rows()!=0){
           $data="Email Already Exist";
           return $data;
         }
       }

       function update_details($admission_id,$had_aadhar_card,$aadhar_card_num,$admission_location,$admission_date,$name,$fname,$mname,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$course,$mobile,$sec_mobile,$email,$userFileName,$institute_name,$last_studied,$qual,$tran_cert,$address,$disability,$city,$state,$blood_group,$status,$user_id,$prefer_time)
       {
           //echo $name;echo $status; echo $tran_cert; exit;
       $query="UPDATE edu_admission SET have_aadhaar_card='$had_aadhar_card',aadhaar_card_number='$aadhar_card_num',name='$name',sex='$sex',dob='$dob_date',age='$age',nationality='$nationality',religion='$religion',community_class='$community_class',community='$community',father_name='$fname',mother_name='$mname',mobile='$mobile',sec_mobile='$sec_mobile',email='$email',state='$state',city='$city',address='$address',mother_tongue='$mother_tongue',disability='$disability',student_pic='$userFileName',blood_group='$blood_group',admission_date='$admission_date',admission_location='$admission_location',preferred_trade='$course',preferred_timing='$prefer_time',last_institute='$institute_name',last_studied='$last_studied',qualified_promotion='$qual',transfer_certificate='$tran_cert',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$admission_id'";
       $res=$this->db->query($query);

		$query7="UPDATE edu_enrollment SET name='$name',status='$status' WHERE admission_id='$admission_id' ";
	   $res=$this->db->query($query7);

         if($res){
         $data= array("status" => "success");
         return $data;
       }else{
         $data= array("status" => "Failed to Update");
         return $data;
       }

       }

	  function getData($email)
		{
			$query = "SELECT * FROM edu_admission WHERE email='".$email."'";
			$resultset = $this->db->query($query);
			return count($resultset->result());
      }

		function checkcellnum($cell)
		{
			$query = "select mobile from edu_admission WHERE mobile='".$cell."'";
			$resultset = $this->db->query($query);
			return count($resultset->result());
		}


}
?>
