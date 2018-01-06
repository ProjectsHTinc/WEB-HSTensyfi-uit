<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff extends CI_Controller {


	function __construct() {
		 parent::__construct();


		    $this->load->helper('url');
		    $this->load->library('session');
				$this->load->model('staffmodel');




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
			 $datas['get_all_active_role']=$this->staffmodel->get_all_active_role();
			 $datas['get_non_exist_class_for_trainer']=$this->staffmodel->get_non_exist_class_for_trainer();
			 $this->load->view('header');
	 		 $this->load->view('staff/add',$datas);
	 		 $this->load->view('footer');
	 		 }
	 		 else{
	 				redirect('/');
	 		 }
	 	}


    public function create(){
        $datas=$this->session->userdata();
        $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
					$select_role=$this->input->post('select_role');
					$name=$this->input->post('name');
					$address= $this->db->escape_str($this->input->post('address'));
					$email=$this->input->post('email');
					$class_tutor=$this->input->post('class_tutor');
					$mobile=$this->input->post('mobile');
					$sec_phone=$this->input->post('sec_phone');
 					$sex=$this->input->post('sex');
					$dob=$this->input->post('dob');
					$nationality=$this->input->post('nationality');
					$religion=$this->input->post('religion');
					$community_class=$this->input->post('community_class');
					$community=$this->input->post('community');
					$qualification=$this->input->post('qualification');
					$status=$this->input->post('status');
					$profilepic = $_FILES['staff_pic']['name'];
					if(empty($profilepic)){
						$staff_prof_pic=' ';
					}else{
						$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
						$staff_prof_pic = round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/staff/';
						$profilepic = $uploaddir.$staff_prof_pic;
						move_uploaded_file($_FILES['staff_pic']['tmp_name'], $profilepic);
					}
					$datas=$this->staffmodel->create_staff_details($select_role,$name,$address,$email,$class_tutor,$mobile,$sec_phone,$sex,$dob,$nationality,$religion,$community_class,$community,$qualification,$status,$staff_prof_pic,$user_id);
					if($datas['status']=="success"){
						$this->session->set_flashdata('msg', 'Staff Created Successfully');
						redirect('staff/view');
					}else if($datas['status']=="already"){
						$this->session->set_flashdata('msg', 'User Already Exists');
						redirect('staff/view');
					}
					else{
						$this->session->set_flashdata('msg', 'Failed to Add');
						redirect('staff/view');
					}
       }
       else{
          redirect('/');
       }
    }

		public function view(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$datas['result']=$this->staffmodel->get_all_staff_details();
				$datas['result_all_trade_batch']=$this->staffmodel->get_all_trade_batch();
			 $this->load->view('header');
			 $this->load->view('staff/view',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



		public function edit($id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
			 	$datas['staff']=$id;
				$staff_id=base64_decode($id);
				 $datas['get_non_exist_class_for_trainer']=$this->staffmodel->get_non_exist_class_for_trainer();
				$datas['result']=$this->staffmodel->get_all_staff_details_by_id($staff_id);
				$datas['get_all_active_role']=$this->staffmodel->get_all_active_role();
			 $this->load->view('header');
			 $this->load->view('staff/edit',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



				public function update_staff_details(){
						$datas=$this->session->userdata();
						$user_id=$this->session->userdata('user_id');
						$user_type=$this->session->userdata('user_type');
						if($user_type==1){
							$select_role=$this->input->post('select_role');
							$staff_id=base64_decode($this->input->post('staff_id'));
							$name=$this->input->post('name');
							$address= $this->db->escape_str($this->input->post('address'));
							$email=$this->input->post('email');
							$class_tutor=$this->input->post('class_tutor');
							$mobile=$this->input->post('mobile');
							$sec_phone=$this->input->post('sec_phone');
							$sex=$this->input->post('sex');
							$dob=$this->input->post('dob');
							$nationality=$this->input->post('nationality');
							$religion=$this->input->post('religion');
							$community_class=$this->input->post('community_class');
							$community=$this->input->post('community');
							$qualification=$this->input->post('qualification');
							$status=$this->input->post('status');
							$staff_old_pic=$this->input->post('staff_old_pic');
							$profilepic = $_FILES['staff_new_pic']['name'];
							if(empty($profilepic)){
								$staff_prof_pic=$staff_old_pic;
							}else{
								$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
								$staff_prof_pic = round(microtime(true)) . '.' . $temp;
								$uploaddir = 'assets/staff/';
								$profilepic = $uploaddir.$staff_prof_pic;
								move_uploaded_file($_FILES['staff_new_pic']['tmp_name'], $profilepic);
							}
							$datas=$this->staffmodel->update_staff_details_to_id($select_role,$name,$address,$email,$class_tutor,$mobile,$sec_phone,$sex,$dob,$nationality,$religion,$community_class,$community,$qualification,$status,$staff_prof_pic,$user_id,$staff_id);
							if($datas['status']=="success"){
								$this->session->set_flashdata('msg', ''.$name.' Updated Successfully');
								redirect('staff/view');
							}else{
								$this->session->set_flashdata('msg', 'Failed to Add');
								redirect('staff/view');
							}
					 }
					 else{
							redirect('/');
					 }
				}





		public function checkemail(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 	$email=$this->input->post('email');
					$datas['res']=$this->staffmodel->checkemail($email);
			}else{
				redirect('/');
			}
		}

		public function trainer_handling_trade_form(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 	$trade_id=$this->input->post('trade_id');
				 	$staff_id=$this->input->post('trainer_id');
					$status=$this->input->post('status');
					$datas['res']=$this->staffmodel->trainer_handling_trade_form($trade_id,$staff_id,$status,$user_id);
			}else{
				redirect('/');
			}
		}


		public function view_handling(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$datas['res']=$this->staffmodel->view_trainer_handling_trade();
					$this->load->view('header');
					$this->load->view('staff/trainer_handling_trade_batch',$datas);
					$this->load->view('footer');
			}else{
				redirect('/');
			}
		}



				public function edit_handling($id){
					$datas=$this->session->userdata();
					$user_id=$this->session->userdata('user_id');
					$user_type=$this->session->userdata('user_type');
					if($user_type==1){
							$datas['trade_enc_id']=base64_decode($id);
							$datas['res']=$this->staffmodel->get_trainer_handling_trade($id);
							$datas['result_all_trade_batch']=$this->staffmodel->get_all_trade_batch();
							$this->load->view('header');
							$this->load->view('staff/edit_handling_trade',$datas);
							$this->load->view('footer');
					}else{
						redirect('/');
					}
				}

			public function update_trainer_handling_trade_form(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				 $trade_batch_id=$this->input->post('trade_batch_id');
				$staff_id=$this->input->post('staff_id');
				$id=$this->input->post('id');
				$status=$this->input->post('status');

				$datas['res']=$this->staffmodel->update_trainer_handling_trade_form($trade_batch_id,$staff_id,$id,$status,$user_id);


				}else{
					redirect('/');
				}
			}

		public function checkmobile(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$mobile=$this->input->post('mobile');
					$datas['res']=$this->staffmodel->checkmobile($mobile);
			}else{
				redirect('/');
			}
		}

		public function checkemail_edit(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$staff_id=base64_decode($this->uri->segment(3));
					$email=$this->input->post('email');
					$datas['res']=$this->staffmodel->checkemail_edit($email,$staff_id);
			}else{
				redirect('/');
			}
		}

		public function checkmobile_edit(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$staff_id=base64_decode($this->uri->segment(3));
					$mobile=$this->input->post('mobile');
					$datas['res']=$this->staffmodel->checkmobile_edit($mobile,$staff_id);
			}else{
				redirect('/');
			}
		}








}
