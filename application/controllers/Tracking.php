<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tracking extends CI_Controller {


	function __construct() {
		 parent::__construct();


		    $this->load->helper('url');
		    $this->load->library('session');
				$this->load->model('trackingmodel');




 }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 // Class section




	 	public function home(){
	 		 	$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
  			$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$datas['res']=$this->trackingmodel->get_mobilizer_id();
			 $this->load->view('header');
	 		 $this->load->view('tracking/view',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


		public function map(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$user_id=$this->input->post('user_id');
				$selected_date=$this->input->post('selected_date');
			 $datas['res']=$this->trackingmodel->get_lat_and_long_id($user_id,$selected_date);
			 $datas['result']=$this->trackingmodel->get_lat_and_long_id_table_view($user_id,$selected_date);
			 $this->load->view('header');
			 $this->load->view('tracking/map',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}


		public function track(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$user_id=$this->input->post('user_id');
				$selected_date=$this->input->post('selected_date');
			 $datas['res']=$this->trackingmodel->get_lat_and_long_id($user_id,$selected_date);
			 $datas['result']=$this->trackingmodel->get_lat_and_long_id_table_view($user_id,$selected_date);
			 $this->load->view('header');
			 $this->load->view('tracking/track',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function tracking_details(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
					$datas['res']=$this->trackingmodel->testing_track();
					echo json_encode($datas['res']);
			 }
			 else{
					redirect('/');
			 }
		}













}
