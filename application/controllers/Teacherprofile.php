<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teacherprofile extends CI_Controller {


	function __construct()
	{
	 parent::__construct();
	 $this->load->helper('url');
	 $this->load->library('session');
	 $this->load->model('teacherprofilemodel');
   }


	public function profilepic()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $user_type=$this->session->userdata('user_type');
		 $datas['result'] = $this->teacherprofilemodel->getuser($user_id,$user_type);
      // echo'<pre>';print_r($datas['result']);exit;
		 //$datas['resubject'] = $this->subjectmodel->getsubject();
		 //$datas['getall_class']=$this->class_manage->getall_class();
		 //$datas['groups']=$this->teacherprofilemodel->get_all_groups_details();
		 //$datas['activities']=$this->teacherprofilemodel->get_all_activities_details();
		if($user_type==3){
		$this->load->view('adminteacher/teacher_header',$datas);
		$this->load->view('adminteacher/profile_update',$datas);
		$this->load->view('adminteacher/teacher_footer');
		}
		else{
			 redirect('/');
		}
}

	public function profileupdate()
	{
			$datas=$this->session->userdata();
			$user_name=$this->session->userdata('user_name');
			$user_type=$this->session->userdata('user_type');
		   $users_id=$this->session->userdata('user_id');
		 	if($user_type==3)
			{
		      $user_id=$this->input->post('user_id');
	         //echo $user_id;exit;
				//$teachername=$this->input->post('name');
				$user_pic_old=$this->input->post('user_pic_old');
		      $teacher_pic = $_FILES["user_pic"]["name"];
		      $temp = pathinfo($teacher_pic, PATHINFO_EXTENSION);
		      $userFileName = round(microtime(true)) . '.' . $temp;
		      //$userFileName =time();
		      $uploaddir = 'assets/staff/profile/';
			   $profilepic = $uploaddir.$userFileName;
			   move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
			   if(empty($teacher_pic))
			   {
			    $userFileName=$user_pic_old;
		       }
			$res=$this->teacherprofilemodel->teacherprofileupdate($user_id,$userFileName,$user_type,$users_id);
				if($res['status']=="success"){
					$this->session->set_flashdata('msg', 'Update Successfully');
					 redirect('teacherprofile/profilepic');
				    }else{
					 $this->session->set_flashdata('msg', 'Failed to update');
					  redirect('teacherprofile/profilepic');
				  }
		 }
	}


	public function profile()
	{
		 $datas=$this->session->userdata();
		 $user_id=$this->session->userdata('user_id');
		 $datas['result'] = $this->teacherprofilemodel->get_teacheruser($user_id);
		 $user_type=$this->session->userdata('user_type');
			// echo $user_type;exit;
			 if($user_type==3){
				$this->load->view('adminteacher/teacher_header');
		        $this->load->view('adminteacher/resetpassword',$datas);
		        $this->load->view('adminteacher/teacher_footer');
				}
				else{
					 redirect('/');
				}
        }



  public function updateprofile()
  {
	    $datas=$this->session->userdata();
		$user_name=$this->session->userdata('user_name');
		$user_type=$this->session->userdata('user_type');
	 	if($user_type==3)
		{
		 		$user_id=$this->input->post('user_id');
				//echo $user_id;exit;

						$name=$this->input->post('name');
						$oldpassword=md5($this->input->post('oldpassword'));
						$newpassword=md5($this->input->post('newpassword'));

						 $user_password_old=$this->input->post('user_password_old');

						$res=$this->teacherprofilemodel->updateprofile($user_id,$oldpassword,$newpassword);

						if($res['status']=="success"){
						 $this->session->set_flashdata('msg', 'Update Successfully');
						  redirect('teacherprofile/profile');

					      }else{
					 	        $this->session->set_flashdata('msg', 'Failed to update');
								 redirect('teacherprofile/profile');
					          }

	 }
	 else{
			redirect('/');
	 }
  }

	public function logout(){
		$datas=$this->session->userdata();
		$this->session->unset_userdata($datas);
		$this->session->sess_destroy();
		redirect('/');
	}






}
