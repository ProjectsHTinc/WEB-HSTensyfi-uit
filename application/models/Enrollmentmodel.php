<?php

Class Enrollmentmodel extends CI_Model
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

//CREATE ADMISSION   ad_enrollment

	function ad_enrollment($admisnid,$admit_year,$formatted_date,$trade_batch,$name,$status,$user_id)
	{
		$year_id=$this->getYear();
		$check_email="SELECT * FROM edu_enrollment WHERE admit_year='$admit_year' AND admit_year='$year_id' AND admission_id='$admisnid' AND name='$name'";
		$result=$this->db->query($check_email);
		if($result->num_rows()==0)
		{
		$digits = 6;
		$OTP = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
		$md5pwd=md5($OTP);

		$query="INSERT INTO edu_enrollment (admission_id,admit_year,admit_date,name,batch_trade_id,created_at,created_by,status) VALUES ('$admisnid','$admit_year','$formatted_date','$name','$trade_batch',NOW(),'$user_id','$status')";
		$resultset=$this->db->query($query);
		$user_id=$admisnid+500000;
		//echo $user_id;
		$getmail="select email,mobile,name from edu_admission WHERE id='".$admisnid."'";
		$resultset12 = $this->db->query($getmail);
		$reu=$resultset12->result();

		foreach($reu as $rows){}
		$email=$rows->email;
		$cell=$rows->mobile;
		$sname=$rows->name;

		if(!empty($email))
		{
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
		}

		$stude_insert="INSERT INTO edu_users (name,user_name,user_password,user_type,user_master_id,created_date,updated_date,status) VALUES ('$name','$user_id','$md5pwd','5','$admisnid',NOW(),NOW(),'$status')";
		$resultset=$this->db->query($stude_insert);
		$query2="UPDATE edu_admission SET enrollment='1' WHERE id='$admisnid'";
		$resultset=$this->db->query($query2);
		$data= array("status" => "success");
		return $data;
		}else{
			$data= array("status" => "Admission Already Exist");
			return $data;
		}

	}

	function add_enrollment($admission_id)
	{
		$query="SELECT id,admission_date,name FROM edu_admission WHERE id='$admission_id'";
		$res=$this->db->query($query);
		return $res->result();
	}

	function edit_enrollment($admission_id)
	{
		$query="SELECT e.*,y.year_id,y.from_month,y.to_month FROM edu_enrollment AS e,edu_academic_year AS y WHERE e.admission_id='$admission_id' AND e.admit_year=y.year_id";
		$res=$this->db->query($query);
		return $res->result();
	}

	function get_current_years()
	{
		$get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
		$result1=$this->db->query($get_year);
		if($result1->num_rows()==0){
			$data= array("status" => "no data Found");
			return $data;
		}else{
			$all_year= $result1->result();
			$data= array("status" => "success","all_years"=>$all_year);
			return $data;
		}
	}

	function get_all_admission()
	{
		$query="SELECT * FROM edu_admission WHERE enrollment='0' AND status='Active'";
		$res=$this->db->query($query);
		return $res->result();
	}

	function get_all_trade_batch()
	{
		$year_id=$this->getYear();
		$query="SELECT tb.*,t.trade_name,b.batch_name FROM  edu_trade_batch AS tb,edu_trade AS t,edu_batch AS b WHERE  tb.year_id='$year_id' AND tb.trade_id=t.id AND tb.batch_id=b.id AND tb.status='Active'";
		$resultset=$this->db->query($query);
		return $resultset->result();
	}

//GET ALL Admission Form get_enrollmentid

	function get_all_enrollment()
	{
		$year_id=$this->getYear();
		$query="SELECT e.*,tb.id,tb.trade_id,tb.batch_id,t.trade_name,b.batch_name,a.id,a.sex,a.name,bl.blood_group_name FROM edu_enrollment as e,edu_trade_batch as tb, edu_batch as b,edu_trade as t,edu_admission AS a,edu_blood_group as bl WHERE a.blood_group=bl.id AND 
		e.batch_trade_id=tb.id and tb.trade_id=t.id and tb.batch_id=b.id AND e.admission_id=a.id  AND  e.admit_year='$year_id' ORDER BY e.id DESC";
		$res=$this->db->query($query);
		return $res->result();
	}

	//Update enrollment
	function update_enrollment($admit_year,$reg_date,$name,$trade_batch,$status,$enroll_id,$admisnid,$user_id)
	{
		$query="UPDATE edu_enrollment SET admit_date='$reg_date',batch_trade_id='$trade_batch',status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$enroll_id' AND admission_id='$admisnid'";
		$res=$this->db->query($query);
		if($res){
			$data= array("status" => "success");
			return $data;
		}else{
			$data= array("status" => "Failed To update");
			return $data;
		}
	}
	
	function getData($stu_name)
	{
		$query = "select name,id from edu_admission WHERE name='".$stu_name."'";
		$resultset = $this->db->query($query);
		foreach ($resultset->result() as $rows)
		{
			echo $rows->id;exit;
		}
	}

	function getData1($stuid)
	{
		$year_id=$this->getYear();
		$query = "select name,admission_id from edu_enrollment WHERE admission_id='".$stuid."' AND admit_year='$year_id'";
		$resultset = $this->db->query($query);
		return  count($resultset->result());
	}


	function search(Request $request)
	{
		$keywords = $request->get('keywords');
		$suggestions = Search::where('keywords', 'LIKE', '%'.$keywords.'%')->get();
		return $suggestions;
	}


}
?>
