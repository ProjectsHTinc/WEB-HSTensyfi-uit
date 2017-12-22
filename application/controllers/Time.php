<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time extends CI_Controller 
{
  function __construct() 
  {
		parent::__construct();
		$this->load->model('timemodel');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
}

// Class section
public function home()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result'] = $this->timemodel->getall_details();
		if($user_type==1)
		{
		$this->load->view('header');
		$this->load->view('time/add_time',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
}



public function create_session()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
			$ses_name=$this->input->post('session_name');
			$stime=$this->input->post('from_time');
			$etime=$this->input->post('to_time');
			$status=$this->input->post('status');

			$datas=$this->timemodel->add_session_details($ses_name,$stime,$etime,$status,$user_id);

			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Added Successfully');
				redirect('time/home');
			}else{
				$this->session->set_flashdata('msg','Failed to Add');
				redirect('time/home');
			}
		}else{
			redirect('/');
		}

}

public function edit_session($time_id)
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['res']=$this->timemodel->edit_session_details($time_id);
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('time/edit_time',$datas);
			$this->load->view('footer');
		}
		else{
			redirect('/');
		}
}

public function update_session()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{  
			$tid=$this->input->post('tid');
			$ses_name=$this->input->post('session_name');
			$stime=$this->input->post('from_time');
			$etime=$this->input->post('to_time');
			$status=$this->input->post('status');

			$datas=$this->timemodel->update_session_details($tid,$ses_name,$stime,$etime,$status,$user_id);

			if($datas['status']=="success"){
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('time/home');
			}else{
		    $this->session->set_flashdata('msg','Failed To Updated');
		    redirect('time/home');
		  }
		}else{
       redirect('/');
		}
}


}
?>