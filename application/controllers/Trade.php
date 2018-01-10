<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trade extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('trademodel');
	}

	// Class section
	public function addtrade()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		$datas['result'] = $this->trademodel->getall_trade();
	    $datas['cenert'] = $this->trademodel->getall_center_name();
        // print_r($datas['cenert']);exit;
		if($user_type==1 || $user_type==2){
		$this->load->view('header');
		$this->load->view('trade/add',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
	}


	public function create_trade()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

      $center_id=$this->input->post('center_id');
		$tradename=$this->input->post('tradename');

		$status=$this->input->post('status');
		$res = $this->trademodel->add_trade($center_id,$tradename,$status,$user_id);
		//print_r($res);exit;
		if($res['status']=="success"){
		$this->session->set_flashdata('msg', 'Added Successfully');
		redirect('trade/addtrade');
		}else{
		$this->session->set_flashdata('msg', 'Trade Name Already exist');
		redirect('trade/addtrade');
		}
	}

	public function edit_trade($id)
	{
		$res['datas'] = $this->trademodel->edit_trade($id);
		$res['cenert'] = $this->trademodel->getall_center_name();
		$this->load->view('header');
		$this->load->view('trade/edit',$res);
		$this->load->view('footer');
	}

	public function update_trade()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

      $center_id=$this->input->post('center_id');
		$trade_name=$this->input->post('tradename');
		$trade_id=$this->input->post('trade_id');
		$status=$this->input->post('status');

		$res = $this->trademodel->update_trade_details($center_id,$trade_name,$trade_id,$status,$user_id);
		if($res['status']=="success"){
		$this->session->set_flashdata('msg', 'Update Successfully');
		redirect('trade/addtrade');
		}else{
		$this->session->set_flashdata('msg', 'Failed to update');
		redirect('trade/addtrade');
		}
	}

}
?>
