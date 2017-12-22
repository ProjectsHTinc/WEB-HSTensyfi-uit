<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller 
{
  function __construct() 
  {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('taskmodel');
}

// Class section
public function home()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result'] = $this->taskmodel->getall_details();
		$datas['users'] = $this->taskmodel->getall_users_details();
		//echo'<pre>';print_r($datas['users']);exit;
		if($user_type==1)
		{
		$this->load->view('header');
		$this->load->view('task/add_task',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
}



public function create_task()
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1)
		{
			$users_name=$this->input->post('users_id');
			$title=$this->input->post('task_title');
			$tdate=$this->input->post('task_date');

			$datechange = new DateTime($tdate);
			$task_date=date_format($datechange,'Y-m-d');

			$description=$this->input->post('description');
			$status=$this->input->post('status');

			$datas=$this->taskmodel->add_task_details($users_name,$title,$task_date,$description,$status,$user_id);

			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg','Added Successfully');
				redirect('task/home');
			}else{
				$this->session->set_flashdata('msg','Failed to Add');
				redirect('task/home');
			}
		}else{
			redirect('/');
		}

}

public function edit_session($task_id)
{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['res']=$this->taskmodel->edit_session_details($task_id);
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('task/edit_task',$datas);
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
			$stask=$this->input->post('from_task');
			$etask=$this->input->post('to_task');
			$status=$this->input->post('status');

			$datas=$this->taskmodel->update_session_details($tid,$ses_name,$stask,$etask,$status,$user_id);

			if($datas['status']=="success"){
				$this->session->set_flashdata('msg','Updated Successfully');
				redirect('task/home');
			}else{
		    $this->session->set_flashdata('msg','Failed To Updated');
		    redirect('task/home');
		  }
		}else{
       redirect('/');
		}
}


}
?>