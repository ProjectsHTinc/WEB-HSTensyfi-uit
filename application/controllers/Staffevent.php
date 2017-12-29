<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staffevent extends CI_Controller {


	function __construct() 
	{
		parent::__construct();
		$this->load->model('staffeventmodel');
		$this->load->helper('url');
		$this->load->library('session');
 }

	 // Class section
	 	public function home()
	 	{
	 		$datas=$this->session->userdata();
  	 		$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==3)
			 {
				$datas['event_all']=$this->staffeventmodel->get_teacher_allevent();
				//echo'<pre>';print_r($datas['event_all']);exit;
				$this->load->view('adminteacher/teacher_header');
				$this->load->view('adminteacher/event/eventview',$datas);
		 		$this->load->view('adminteacher/teacher_footer');
	 		 }else{
	 			redirect('/');
	 		 }
	 	}

		public function calender()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==3)
			{
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/event/teachercalender',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			}else{
			   redirect('/');
			 }
		}

		public function todolist()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
		   if($user_type==3)
		   {
			 	$to_do_date=$this->input->post('to_do_date');
 				$to_do_list=$this->input->post('to_do_list');
 				$to_do_notes=$this->input->post('to_do_notes');
				$status=$this->input->post('status');
 		 		$to_user=$user_id;
				$datas=$this->staffeventmodel->save_to_do_list($to_do_date,$to_do_list,$to_do_notes,$to_user,$user_type,$status);
				if($datas['status']=="success"){
					echo "success";
				}else{
					echo "failed";
				}
		 }else{
				redirect('/');
		 }
		}

		public function view_event($event_id)
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			 if($user_type==3){
			
			 $datas['result']=$this->staffeventmodel->get_event_details($event_id);
			// echo "<pre>";  print_r( $datas['result']);exit;
			 $this->load->view('adminteacher/teacher_header');
			 $this->load->view('adminteacher/event/event_list',$datas);
			 $this->load->view('adminteacher/teacher_footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function view_all_reminder()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			$data['reg']=$this->staffeventmodel->view_all_reminder($user_id);
			//$s= unset($data);
			echo json_encode($data['reg']);
		}


























}
