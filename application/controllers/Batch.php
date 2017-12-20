<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('batchmodel');
	}

	public function add_batch()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result'] = $this->batchmodel->get_batch_details();
		if($user_type==1)
		{
			$this->load->view('header');
			$this->load->view('batch/add',$datas);
			$this->load->view('footer');
	   }else{
	      redirect('/');
	   } 
	}

	public function create_batch()
	{  
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$batchname=$this->input->post('batchname');
		$status=$this->input->post('status');
		$res = $this->batchmodel->add_batch_details($batchname,$status,$user_id);
		if($res['status']=="success")
		{
			$this->session->set_flashdata('msg', 'Added Successfully');
			redirect('batch/add_batch');
		}else{
			$this->session->set_flashdata('msg', 'Batch Name Already exist');
			redirect('batch/add_batch');
		}
	}

	public function edit_batch($batch_id)
	{
		$res['datas'] = $this->batchmodel->edit_batch($batch_id);
		$this->load->view('header');
		$this->load->view('batch/edit',$res);
		$this->load->view('footer');
	}

	public function update_batch()
	{  
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$batch_name=$this->input->post('batchname');
		$status=$this->input->post('status');
		$batch_id=$this->input->post('batch_id');
		$res = $this->batchmodel->save_batch($batch_name,$batch_id,$status,$user_id);
		if($res['status']=="success")
		{
			$this->session->set_flashdata('msg', 'Update Successfully');
			redirect('batch/add_batch');
		}else{
			$this->session->set_flashdata('msg', 'Failed to update');
			redirect('batch/add_batch');
		}
	}


}
?>
