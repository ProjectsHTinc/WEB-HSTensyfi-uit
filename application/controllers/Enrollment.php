<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enrollment extends CI_Controller 
{

	function __construct() 
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admissionmodel');
		$this->load->model('enrollmentmodel');
	}

	public function home()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
	
		$datas['admisn'] = $this->enrollmentmodel->get_all_admission();
		$datas['years']=$this->enrollmentmodel->get_current_years();
		$datas['getall']=$this->enrollmentmodel->get_all_trade_batch();

		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('enrollment/add',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}

	public function add_enrollment($admission_id)
	{
		//echo $admission_id;exit;
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$datas['years']=$this->enrollmentmodel->get_current_years();
		$datas['getall']=$this->enrollmentmodel->get_all_trade_batch();
		$datas['res']=$this->enrollmentmodel->add_enrollment($admission_id);
		//echo'<pre>';print_r($datas['res']);exit;
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('enrollment/add_enroll',$datas);
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
			$admit_year=$this->input->post('year_id');
			$admit_date=$this->input->post('admit_date');
			$dateTime = new DateTime($admit_date);
			$formatted_date=date_format($dateTime,'Y-m-d' );

			$trade_batch=$this->input->post('trade_batch');
			$admisnid=$this->input->post('admission_id');
			$name=$this->input->post('name');
			$status=$this->input->post('status');
			
			$datas=$this->enrollmentmodel->ad_enrollment($admisnid,$admit_year,$formatted_date,$trade_batch,$name,$status,$user_id);
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg', 'Added Successfully');
				redirect('enrollment/view');
			}else if($datas['status']=="Admission Already Exist"){
				$this->session->set_flashdata('msg', 'Admission Already Exist');
				redirect('enrollment/home');
			}else{
				$this->session->set_flashdata('msg', 'Failed to Add');
				redirect('enrollment/home');
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

		$datas['result'] = $this->enrollmentmodel->get_all_enrollment();
		$datas['years']=$this->enrollmentmodel->get_current_years();
		//echo "<pre>";print_r($datas['result']);exit;
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('enrollment/view',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}



	public function edit_enroll($admission_id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$datas['years']=$this->enrollmentmodel->get_current_years();
		$datas['getall']=$this->enrollmentmodel->get_all_trade_batch();
		$datas['res']=$this->enrollmentmodel->edit_enrollment($admission_id);
		//echo'<pre>';print_r($datas['res']);exit;
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('enrollment/edit',$datas);
			$this->load->view('footer');
		}else{
			redirect('/');
		}
	}


	public function update()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		if($user_type==1)
		{
			$enroll_id=$this->input->post('entroll_id');
			$admit_year=$this->input->post('year_id');

			$admit_date=$this->input->post('admit_date');
			$dateTime = new DateTime($admit_date);
			$reg_date=date_format($dateTime,'Y-m-d' );

			$trade_batch=$this->input->post('trade_batch');
			$admisnid=$this->input->post('admission_id');
			$name=$this->input->post('name');
			$status=$this->input->post('status');

			$datas=$this->enrollmentmodel->update_enrollment($admit_year,$reg_date,$name,$trade_batch,$status,$enroll_id,$admisnid,$user_id);
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg', 'Update Successfully');
				redirect('enrollment/view');
			}else{
				$this->session->set_flashdata('msg', 'Failed to Update');
				redirect('enrollment/view');
			}
		}else{
			redirect('/');
		}
	}

	public function checker()
	{
		$stu_name = $this->input->post('stuname');
		$resultset = $this->enrollmentmodel->getData($stu_name);
		if($resultset!='')
		{
			echo $resultset;
		}else{
			echo "Name Not Found";
		}
	}

	public function checker1()
	{
		$stuid = $this->input->post('sid');
		$resultset = $this->enrollmentmodel->getData1($stuid);
		if ($resultset > 0)
		{
			echo "Already Enrollment Added";
		}else{
			echo "Add Enrollment";
		}
	}

} ?>
