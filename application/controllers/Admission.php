<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admission extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admissionmodel');
	}

	public function home()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['lang'] = $this->admissionmodel->getall_trade();
		$datas['blood'] = $this->admissionmodel->getall_blood_group();
		$datas['time'] =$this->admissionmodel->getall_session_details();
		if($user_type==1){
			$this->load->view('header');
			$this->load->view('admission/add',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}



	public function create()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
			$had_aadhar_card=$this->input->post('had_aadhar_card');
			$aadhar_card_num=$this->input->post('aadhar_card_num');
			$admission_location=$this->input->post('admission_location');
			$admit_date=$this->input->post('admission_date');

			$dateTime1 = new DateTime($admit_date);
			$admission_date=date_format($dateTime1,'Y-m-d' );

			$name=$this->input->post('name');
			$fname=$this->input->post('fname');
			$mname=$this->input->post('mname');
			$email=$this->input->post('email');
			$prefer_time=$this->input->post('prefer_time');
			$sex=$this->input->post('sex');

			$dob=$this->input->post('dob');
			$dateTime = new DateTime($dob);
			$dob_date=date_format($dateTime,'Y-m-d' );


			$age=$this->input->post('age');
			$nationality=$this->input->post('nationality');
			$religion=$this->input->post('religion');
			$community_class=$this->input->post('community_class');
			$community=$this->input->post('community');
			$mother_tongue=$this->input->post('mother_tongue');

			$course=$this->input->post('course');
			$blood_group=$this->input->post('blood_group');
			$status=$this->input->post('status');

			$mobile=$this->input->post('mobile');
			$sec_mobile=$this->input->post('sec_mobile');

			$student_pic = $_FILES["student_pic"]["name"];
			if(empty($student_pic)){
				$userFileName=' ';
			}else{
		   $temp = pathinfo($student_pic, PATHINFO_EXTENSION);
		   $userFileName = round(microtime(true)) . '.' . $temp;
			$uploaddir = 'assets/students/';
			$profilepic = $uploaddir.$userFileName;
			move_uploaded_file($_FILES['student_pic']['tmp_name'], $profilepic);
}
			$institute_name=$this->input->post('institute_name');
			$last_studied=$this->input->post('last_studied');
			$qual=$this->input->post('qual');
			$tran_cert=$this->input->post('trn_cert');
			$address=$this->input->post('address');
			$disability=$this->input->post('disability');
			$city=$this->input->post('city');
			$state=$this->input->post('state');

			$datas=$this->admissionmodel->ad_create($had_aadhar_card,$aadhar_card_num,$admission_location,$admission_date,$name,$fname,$mname,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$course,$mobile,$sec_mobile,$email,$userFileName,$institute_name,$last_studied,$qual,$tran_cert,$address,$disability,$city,$state,$blood_group,$status,
			$user_id,$prefer_time);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg', 'Added Successfully');
					redirect('admission/view');
			}else if($datas['status']=="already"){
				$this->session->set_flashdata('msg', 'Failed to Add');
				redirect('admission/view');
			}else{
				$this->session->set_flashdata('msg', 'Failed to Add');
				redirect('admission/view');
			}
		}else{
		  redirect('/');
		}
	}

	// GET ALL ADMISSION DETAILS

	public function view()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result'] = $this->admissionmodel->get_all_admission();
		//echo "<pre>";print_r($datas['result']);exit;

		if($user_type==1){
			$this->load->view('header');
			$this->load->view('admission/view',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}


	//-------------------------
	public function edit_stu_details($admission_id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['lang'] = $this->admissionmodel->getall_trade();
		$datas['blood'] = $this->admissionmodel->getall_blood_group();
		$datas['time'] =$this->admissionmodel->getall_session_details();
		$datas['res']=$this->admissionmodel->get_edit_details($admission_id);
		if($user_type==1){
			$this->load->view('header');
			$this->load->view('admission/edit',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}


	public function save_ad()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
			$had_aadhar_card=$this->input->post('had_aadhar_card');
			$aadhar_card_num=$this->input->post('aadhar_card_num');
			$admission_location=$this->input->post('admission_location');
			$admit_date=$this->input->post('admission_date');

			$dateTime1 = new DateTime($admit_date);
			$admission_date=date_format($dateTime1,'Y-m-d' );

         $admission_id=$this->input->post('admission_id');
			$name=$this->input->post('name');
			$fname=$this->input->post('fname');
			$mname=$this->input->post('mname');
			$email=$this->input->post('email');
			$prefer_time=$this->input->post('prefer_time');
			$sex=$this->input->post('sex');

			$dob=$this->input->post('dob');
			$dateTime = new DateTime($dob);
			$dob_date=date_format($dateTime,'Y-m-d' );


			$age=$this->input->post('age');
			$nationality=$this->input->post('nationality');
			$religion=$this->input->post('religion');
			$community_class=$this->input->post('community_class');
			$community=$this->input->post('community');
			$mother_tongue=$this->input->post('mother_tongue');

			$course=$this->input->post('course');
			$blood_group=$this->input->post('blood_group');
			$status=$this->input->post('status');

			$mobile=$this->input->post('mobile');
			$sec_mobile=$this->input->post('sec_mobile');


			$institute_name=$this->input->post('institute_name');
			$last_studied=$this->input->post('last_studied');
			$qual=$this->input->post('qual');
			$tran_cert=$this->input->post('trn_cert');
			$address=$this->input->post('address');
			$disability=$this->input->post('disability');
			$city=$this->input->post('city');
			$state=$this->input->post('state');

			$user_pic_old=$this->input->post('user_pic_old');

			$student_pic = $_FILES["student_pic"]["name"];
			$temp = pathinfo($student_pic, PATHINFO_EXTENSION);
		   $userFileName = round(microtime(true)) . '.' . $temp;
			$uploaddir = 'assets/students/';
			$profilepic = $uploaddir.$userFileName;
			move_uploaded_file($_FILES['student_pic']['tmp_name'], $profilepic);

			if(empty($student_pic))
			{
			 $userFileName=$user_pic_old;
			 }
			$datas=$this->admissionmodel->update_details($admission_id,$had_aadhar_card,$aadhar_card_num,$admission_location,$admission_date,$name,$fname,$mname,$sex,$dob_date,$age,$nationality,$religion,$community_class,$community,$mother_tongue,$course,$mobile,$sec_mobile,$email,$userFileName,$institute_name,$last_studied,$qual,$tran_cert,$address,$disability,$city,$state,$blood_group,
			$status,$user_id,$prefer_time);
			//	print_r($datas['status']);exit;
			if($datas['status']=="success"){
			$this->session->set_flashdata('msg', 'Updated Successfully');
			redirect('admission/view');
			}else{
				$this->session->set_flashdata('msg', 'Failed to Add');
				redirect('admission/view');
			}
		}else{
		redirect('/');
		}
	}

	public function check_email_exists($email)
	{
		echo $email=$this->input->post('email');
		$data=$this->admissionmodel->check_email($email);

	}

	public function checker()
	{
		$email = $this->input->post('email');
		$numrows = $this->admissionmodel->getData($email);
		if ($numrows>0)
		{
			echo "Email Id already Exist";
		}else{
			echo "Email Id Available";
		}
	}


	public function cellchecker()
	{
		$cell = $this->input->post('cell');
		$numrows2 = $this->admissionmodel->checkcellnum($cell);
		if($numrows2 > 0)
		{
			echo "Mobile Number Not Found";
		}else{
		 echo "Mobile Number Available";
		 }
	}

	public function check_aadhar_exist(){
		$aadhar_card_num=$this->input->post('aadhar_card_num');
	 	$datas['res']=$this->admissionmodel->check_aadhar_exist($aadhar_card_num);
	}

	public function check_aadhar_num_exist_edit(){
	  $admission_id=$this->uri->segment(3);
		$aadhar_card_num=$this->input->post('aadhar_card_num');
		$datas['res']=$this->admissionmodel->check_aadhar_num_exist($aadhar_card_num,$admission_id);
	}




}
