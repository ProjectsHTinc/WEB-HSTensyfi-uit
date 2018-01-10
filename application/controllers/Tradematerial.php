<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tradematerial extends CI_Controller {


	function __construct()
	{
		parent::__construct();
	   $this->load->helper('url');
	   $this->load->library('session');
	   $this->load->model('tradematerialmodel');
 }

	public function home()
	{
	 	$datas=$this->session->userdata();
  	 	$user_id=$this->session->userdata('user_id');
  		$user_type=$this->session->userdata('user_type');
		if($user_type==1 || $user_type==2)
		{
		 $datas['get_all_active_trade']=$this->tradematerialmodel->get_all_active_trade();
		 $this->load->view('header');
 		 $this->load->view('tradematerial/add',$datas);
 		 $this->load->view('footer');
	 	}else{
	 		redirect('/');
	 		 }
	}

    public function create(){
        $datas=$this->session->userdata();
        $user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1 || $user_type==2){
			 	$trade_title=$this->input->post('trade_title');
				$check_title=$this->tradematerialmodel->checking_title($trade_title);
				if($check_title['status']=='success'){
					$trade_id=$this->input->post('trade_id');
					$trade_info= $this->db->escape_str($this->input->post('description'));
					$trade_video_link=$this->input->post('trade_video');
					$status=$this->input->post('status');
					$profilepic = $_FILES['trade_file']['name'];
					if(empty($profilepic)){
						$trade_file=' ';
					}else{
						$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
						$trade_file = round(microtime(true)) . '.' . $temp;
						$uploaddir = 'assets/tradematerial/';
						$profilepic = $uploaddir.$trade_file;
						move_uploaded_file($_FILES['trade_file']['tmp_name'], $profilepic);
					}
					$datas=$this->tradematerialmodel->create_trade_material($trade_title,$trade_id,$trade_info,$trade_video_link,$trade_file,$status,$user_id);
					if($datas['status']=="success"){
						$this->session->set_flashdata('msg', 'Material Created Successfully');
						redirect('tradematerial/home');
					}else{
						$this->session->set_flashdata('msg', 'Failed to Add');
						redirect('tradematerial/home');
					}
				}else{
					$this->session->set_flashdata('msg', 'Title Already Exists');
					redirect('tradematerial/home');
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
				if($user_type==1 || $user_type==2){
				$datas['result']=$this->tradematerialmodel->get_all_trade_material();
				//echo '<pre>';print_r($datas['result']);exit;
			 $this->load->view('header');
			 $this->load->view('tradematerial/view',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}



		public function gallery($id){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1 || $user_type==2){
			 	$datas['gallery_id']=$id;
				$trade_material_gallery_id=base64_decode($id);
				$datas['result']=$this->tradematerialmodel->get_trade_gallery_img($trade_material_gallery_id);
			 $this->load->view('header');
			 $this->load->view('tradematerial/gallery',$datas);
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
				if($user_type==1 || $user_type==2){
				$datas['gallery_id']=$id;
				$trade_material_id=base64_decode($id);
				$datas['result']=$this->tradematerialmodel->edit_trade_material($trade_material_id);
			 $this->load->view('header');
			 $this->load->view('tradematerial/edit',$datas);
			 $this->load->view('footer');
			 }
			 else{
					redirect('/');
			 }
		}

		public function save_trade_material(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1 || $user_type==2){
			$trade_title=$this->input->post('trade_title');

				$trade_material_id=$this->input->post('trade_material_id');
				$trade_id=$this->input->post('trade_id');
				$trade_info= $this->db->escape_str($this->input->post('description'));
				$trade_video_link=$this->input->post('trade_video');
				$trade_old_file=$this->input->post('trade_old_file');
				$status=$this->input->post('status');
				$profilepic = $_FILES['trade_file']['name'];
				if(empty($profilepic)){
					$trade_file=$trade_old_file;
				}else{
					$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
					$trade_file = round(microtime(true)) . '.' . $temp;
					$uploaddir = 'assets/tradematerial/';
					$profilepic = $uploaddir.$trade_file;
					move_uploaded_file($_FILES['trade_file']['tmp_name'], $profilepic);
				}

				$datas=$this->tradematerialmodel->update_trade_material($trade_material_id,$trade_title,$trade_id,$trade_info,$trade_video_link,$trade_file,$status,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Material Updated Successfully');
						redirect('tradematerial/edit/'.base64_encode($trade_material_id).'');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
						redirect('tradematerial/edit/'.base64_encode($trade_material_id).'');
				}


		 }
		 else{
				redirect('/');
		 }
		}

		public function addgallery(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1 || $user_type==2){
					$redirect_id=$this->input->post('trade_material_gallery_id');
					$trade_material_gallery_id=base64_decode($this->input->post('trade_material_gallery_id'));
					$name_array = $_FILES['trade_material_gallery']['name'];
					$tmp_name_array = $_FILES['trade_material_gallery']['tmp_name'];
					$count_tmp_name_array = count($tmp_name_array);
					$static_final_name = time();
					for($i = 0; $i < $count_tmp_name_array; $i++){
				   $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
					 $file_name[]=$static_final_name.$i.".".$extension;
					move_uploaded_file($tmp_name_array[$i], "assets/tradematerial/gallery/".$static_final_name.$i.".".$extension);
					}
				$datas=$this->tradematerialmodel->create_trade_gallery($trade_material_gallery_id,$file_name,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('gallery', 'Gallery Updated Successfully');
					redirect('tradematerial/gallery/'.$redirect_id.'');
				}else if($datas['status']=="limit"){
					$this->session->set_flashdata('gallery', 'Gallery  Maximum images Exceeds');
					redirect('tradematerial/gallery/'.$redirect_id.'');
				}else{
					$this->session->set_flashdata('gallery', 'Failed to Add');
					redirect('tradematerial/gallery/'.$redirect_id.'');
				}
			 }
			 else{
					redirect('/');
			 }
		}





		public function delete_gal(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1 || $user_type==2){
				 	$gal_id=$this->input->post('gal_id');
					$datas['res']=$this->tradematerialmodel->delete_gal($gal_id);
			}else{
				redirect('/');
			}
		}

  public function check_title_function()
   {
	    $m_title= $this->input->post('ctitle');
	    $trade_id = $this->input->post('tradeid');
	    $numrows = $this->tradematerialmodel->getData($m_title,$trade_id);
		 if ($numrows>0)
	     {
			echo "AE";
		 }else
		 {
			echo "success";
		 }
  }








} ?>
