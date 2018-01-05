<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrolemanage extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('usermodel');
	
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('menu');
   }

	public function mobilizer()
	{
	  $datas=$this->session->userdata();
	  $user_id=$this->session->userdata('user_id');
	  $user_type=$this->session->userdata('user_type');
	  $datas['mobilizer']=$this->usermodel->get_mobilizer_details();
	 	//echo'<pre>';print_r($datas['mobilizer']);exit;
		if($user_type==1)
 		{
			 $this->load->view('header');
			 $this->load->view('userrole/mobilizer',$datas);
			 $this->load->view('footer');
		 }else{
			redirect('/');
	      }
	 	}

		public function teachers()
		{
			 $datas=$this->session->userdata();
			 $user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['staff']=$this->usermodel->get_staff();
			if($user_type==1)
			{
				$this->load->view('header');
				$this->load->view('userrole/teachers',$datas);
				$this->load->view('footer');
			}
			else{
				 redirect('/');
			}
	 }

	 public function students()
	 {
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			 $user_type=$this->session->userdata('user_type');
			 $datas['students']=$this->usermodel->get_student();
			 //print_r($datas['students']);exit;
		 if($user_type==1)
		 {
			 $this->load->view('header');
			 $this->load->view('userrole/students',$datas);
			 $this->load->view('footer');
		 }
		 else{
				redirect('/');
		 }
	}


	public function get_userid($user_id)
	{

		  $datas=$this->session->userdata();
			$user_type=$this->session->userdata('user_type');
			$datas['result']=$this->usermodel->get_userid($user_id);
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('userrole/edit',$datas);
			$this->load->view('footer');
		}
		else{
			 redirect('/');
		}
 }

 public function get_user_student($user_id)
 {

		 $datas=$this->session->userdata();
		 $user_type=$this->session->userdata('user_type');
		 $datas['result']=$this->usermodel->get_userid($user_id);
	 if($user_type==1)
	 {
		 $this->load->view('header');
		 $this->load->view('userrole/edit_student',$datas);
		 $this->load->view('footer');
	 }
	 else{
			redirect('/');
	 }
}


public function get_user_mobilizer($user_id)
{

		$datas=$this->session->userdata();
		$user_type=$this->session->userdata('user_type');
		$datas['result']=$this->usermodel->get_userid($user_id);
	if($user_type==1)
	{
		$this->load->view('header');
		$this->load->view('userrole/edit_mobilizer',$datas);
		$this->load->view('footer');
	}
	else{
		 redirect('/');
	}
}


	 public function save_teacher()
	 {
			 $datas=$this->session->userdata();
			 $user_type=$this->session->userdata('user_type');
		  	if($user_type==1)
		  {
			  $user_profile_id=$this->input->post('user_profile_id');
			  $status=$this->input->post('status');
				$datas=$this->usermodel->save_profile_id($user_profile_id,$status);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('userrolemanage/teachers');
				}else{
					$this->session->set_flashdata('msg', 'SomeThing Went Wrong');
					redirect('userrolemanage/teachers');
				}
		 }
		 else{
				redirect('/');
		 }
	}


	public function update_mobilizer_details()
	{
			$datas=$this->session->userdata();
			$user_type=$this->session->userdata('user_type');
		 if($user_type==1)
		 {
			 $user_profile_id=$this->input->post('user_profile_id');
			 $status=$this->input->post('status');
			 $datas=$this->usermodel->save_profile_id($user_profile_id,$status);
			 if($datas['status']=="success"){
				 $this->session->set_flashdata('msg', 'Updated Successfully');
				 redirect('userrolemanage/mobilizer');
			 }else{
				 $this->session->set_flashdata('msg', 'SomeThing Went Wrong');
				 redirect('userrolemanage/mobilizer');
			 }
		}
		else{
			 redirect('/');
		}
 }



 public function save_students()
 {
		 $datas=$this->session->userdata();
		 $user_type=$this->session->userdata('user_type');
			if($user_type==1)
		{
			$user_profile_id=$this->input->post('user_profile_id');
			$status=$this->input->post('status');
			$datas=$this->usermodel->save_profile_id($user_profile_id,$status);
			if($datas['status']=="success"){
				$this->session->set_flashdata('msg', 'Updated Successfully');
				redirect('userrolemanage/students');
			}else{
				$this->session->set_flashdata('msg', 'SomeThing Went Wrong');
				redirect('userrolemanage/students');
			}
	 }
	 else{
			redirect('/');
	 }
 }


 public function users_dob_wishes()
 {
	 	$dateTime = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
		$cur_date=$dateTime->format("Y-m-d");
		$datas['res']=$this->smsmodel->student_dob_wishes($cur_date);
		$datas['res']=$this->smsmodel->teacher_dob_wishes($cur_date);

 }





















}
