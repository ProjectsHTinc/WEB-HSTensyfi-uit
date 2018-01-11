<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classmanage extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('classmanagemodel');
	}

	public function home()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$datas['trade'] = $this->classmanagemodel->get_all_trade_details();
		$datas['batch'] = $this->classmanagemodel->get_all_batch_details();
		$datas['getall'] = $this->classmanagemodel->get_all_details();
		//print_r($datas['getall_class']);exit;
		if($user_type==1 || $user_type==2){
		$this->load->view('header');
		$this->load->view('classmanage/add',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
	}


	public function subject_to_class()
	{
		$user_id=$this->session->userdata('user_id');
		$subject_id=$this->input->post('subject_id');
		$class_master_id=$this->input->post('class_master_id');
		$exam_flag=$this->input->post('exam_flag');
		$status=$this->input->post('status');
		$datas=$this->classmanagemodel->subject_to_class($user_id,$subject_id,$class_master_id,$exam_flag,$status);
		if($datas['status']=="success"){
		echo "success";
		}else if($datas['status']=="already"){
		echo "Already Assigned";
		}else{
		echo "failed";
		}
	}

	public function assign()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$trade_id=$this->input->post('trade_name');
		$batch_id=$this->input->post('batch_name');
		$status=$this->input->post('status');

		$data=$this->classmanagemodel->assign($trade_id,$batch_id,$status,$user_id);

		if($data['status']=="success"){
		$this->session->set_flashdata('msg', 'Successfully Added');
		redirect('classmanage/home');
		}
		elseif($data['status']=="Already Exist"){
		$this->session->set_flashdata('msg', 'Already Added ');
		redirect('classmanage/home');
		}
		else{
		$this->session->set_flashdata('msg', 'Something Went wrong');
		redirect('classmanage/home');
		}

	}

	public function editcs($class_sec_id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

      $datas['trade'] = $this->classmanagemodel->get_all_trade_details();
		$datas['batch'] = $this->classmanagemodel->get_all_batch_details();
		$datas['res']=$this->classmanagemodel->edit_cs($class_sec_id);
		//echo "<pre>"; print_r($datas['res']);exit;
		if($user_type==1 || $user_type==2){
		$this->load->view('header');
		$this->load->view('classmanage/edit',$datas);
		$this->load->view('footer');
		}
		else{
		redirect('/');
		}
	}


	public function view_subjects($class_sec_id)
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');
		if($user_type==1 || $user_type==2){
		$datas['sec'] = $this->sectionmodel->getsection();
		$datas['class'] = $this->classmodel->getclass();
		$datas['getall_class']=$this->classmanagemodel->getall_class();
		$datas['subres'] = $this->subjectmodel->getsubject();
		$datas['resubject'] = $this->subjectmodel->getsubject();
		$datas['res']=$this->classmanagemodel->view_subjects($class_sec_id);
		$datas['class_master_id']=$class_sec_id;

		$this->load->view('header');
		$this->load->view('classmanage/view_subjects',$datas);
		$this->load->view('footer');
		}else{
		redirect('/');
		}
	}

	public function update_cs()
	{
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		if($user_type==1 || $user_type==2)
		{
			$clsmanage_id=$this->input->post('clsmanage_id');
			$trade_id=$this->input->post('trade_name');
			$batch_id=$this->input->post('batch_name');
			$status=$this->input->post('status');
			//echo $clsmanage_id;exit;

			$datas=$this->classmanagemodel->save_cs($clsmanage_id,$trade_id,$batch_id,$status,$user_id);
			//	print_r($datas);exit;
			if($datas['status']=="success")
			{
				$this->session->set_flashdata('msg', 'Successfully Updated');
				redirect('classmanage/home');
			}else if($datas['status']=="AE"){
            $this->session->set_flashdata('msg', 'Already Exist');
				redirect('classmanage/home');
			}else{
				$this->session->set_flashdata('msg', 'Faild To Updat');
				redirect('classmanage/home');
			}
		}else{
		    redirect('/');
		}
	}

}
?>
