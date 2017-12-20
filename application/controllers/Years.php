<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Years extends CI_Controller 
{
  function __construct() {
		parent::__construct();
		$this->load->model('yearsmodel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
}

// Class section
public function home()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$datas['result'] = $this->yearsmodel->getall_years();
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
		$this->load->view('header');
		$this->load->view('years/add_years',$datas);
		$this->load->view('footer');
		}
		else{
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
		$from_month=$this->input->post('from_month');
		$end_month=$this->input->post('end_month');

		$dateTime = new DateTime($from_month);
		$formatted_date=date_format($dateTime,'Y-m-d' );

		$dateTime1 = new DateTime($end_month);
		$formatted_date1=date_format($dateTime1,'Y-m-d' );

		$status=$this->input->post('status');

		$datas=$this->yearsmodel->add_years($formatted_date,$formatted_date1,$status,$user_id);

		//print_r($datas['status']);exit;
		//print_r($data['exam_name']);exit;

		if($datas['status']=="success"){
		$this->session->set_flashdata('msg','Added Successfully');
		redirect('years/home');
		}else if($datas['status']=="Already Exist The Year And Dates Are Same")
		{
		$this->session->set_flashdata('msg','Already Exist The Year And Dates Are Same');
		redirect('years/home');
		}else if($datas['status']=="The From Year Must be Grater Than To Year"){
		$this->session->set_flashdata('msg','The From Year Must be Grater Than To Year');
		redirect('years/home');
		}else{
		$this->session->set_flashdata('msg','Failed to Add');
		redirect('years/home');
		}
		}
		else{
		redirect('/');
		}

}

public function edit_years($year_id)
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$datas['res']=$this->yearsmodel->edit_year($year_id);
		//echo "<pre>";print_r(	$datas['res']);exit;
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
		$this->load->view('header');
		$this->load->view('years/edit_year',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
		// $id=$this->input->post($year_id);
}

public function update_year()
{

		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
			$year_id=$this->input->post('year_id');
			$status=$this->input->post('status');
			$from_month=$this->input->post('from_month');
			$dateTime = new DateTime($from_month);
			$formatted_date=date_format($dateTime,'Y-m-d' );

			$end_month=$this->input->post('end_month');
			$dateTime = new DateTime($end_month);
			$formatted_date1=date_format($dateTime,'Y-m-d' );

			$datas=$this->yearsmodel->update_years($year_id,$formatted_date,$formatted_date1,$status,$user_id);
			if($datas['status']=="success"){
			$this->session->set_flashdata('msg','Updated Successfully');
			redirect('years/home');
			}else if($datas['status']=="The From Year Must be Grater Than To Year"){		
		    $this->session->set_flashdata('msg','The From Year Must be Grater Than To Year');
		   redirect('years/home');
		   }else{
		    $this->session->set_flashdata('msg','Failed To Updated');
		    redirect('years/home');
		  }
		}else{
       redirect('/');
		}

}

public function view()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['years'] = $this->yearsmodel->getall_years();
		$datas['terms'] = $this->yearsmodel->getall_terms();
		if($user_type==1){
		$this->load->view('header');
		$this->load->view('years/view',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
}

}
?>