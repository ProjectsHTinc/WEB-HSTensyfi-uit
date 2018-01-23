<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Successstory extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('successstorymodel');
	}

	// Class section
	public function home()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1 || $user_type==2){
		$this->load->view('header');
		$this->load->view('trade/add',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
	}








}
?>
