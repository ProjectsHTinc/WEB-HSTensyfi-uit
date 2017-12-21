<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Center extends CI_Controller {


	function __construct() {
		 parent::__construct();


		    $this->load->helper('url');
		    $this->load->library('session');
				$this->load->model('centermodel');




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
			 $datas['res_img']=$this->centermodel->get_scheme_gallery_img();
			 $datas['res_scheme']=$this->centermodel->get_center_details();
			 $datas['res_videos']=$this->centermodel->get_all_videos();
			 // print_r($datas['res_scheme']);exit;
			 $this->load->view('header');
	 		 $this->load->view('center/create',$datas);
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
			 	$center_name=$this->input->post('center_name');
				$center_info= $this->db->escape_str($this->input->post('center_info'));
				$center_banner=$this->input->post('center_banner');
				$datas=$this->centermodel->update_center($center_name,$center_info,$center_logo,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('center/home');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('center/home');
				}
       }
       else{
          redirect('/');
       }
    }

		public function videos(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
				$video_link= $this->db->escape_str($this->input->post('video_link'));
				$video_title= $this->db->escape_str($this->input->post('video_title'));
				$datas=$this->centermodel->add_video_link($video_title,$video_link,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('video', 'Added Successfully');
					redirect('center/home#video');
				}else{
					$this->session->set_flashdata('video', 'Failed to Add');
					redirect('center/home#video');
				}
			 }
			 else{
					redirect('/');
			 }
		}

		public function logo(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				$profilepic = $_FILES['center_banner']['name'];
				$temp = pathinfo($profilepic, PATHINFO_EXTENSION);
				$center_logo = round(microtime(true)) . '.' . $temp;
				$uploaddir = 'assets/center/logo/';
				$profilepic = $uploaddir.$center_logo;
				move_uploaded_file($_FILES['center_banner']['tmp_name'], $profilepic);
				$datas=$this->centermodel->update_center_logo($center_logo,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('center/home');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('center/home');
				}
			}else{

			}
		}

		public function gallery(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1){
					$name_array = $_FILES['center_photos']['name'];
					$tmp_name_array = $_FILES['center_photos']['tmp_name'];
					$count_tmp_name_array = count($tmp_name_array);
					$static_final_name = time();
					for($i = 0; $i < $count_tmp_name_array; $i++){
				   $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
					 $file_name[]=$static_final_name.$i.".".$extension;
					move_uploaded_file($tmp_name_array[$i], "assets/center/".$static_final_name.$i.".".$extension);
					}
				$datas=$this->centermodel->create_gallery($file_name,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('gallery', 'Gallery Updated Successfully');
					redirect('center/home');
				}else{
					$this->session->set_flashdata('gallery', 'Failed to Add');
					redirect('center/home');
				}
			 }
			 else{
					redirect('/');
			 }
		}


		public function change_status(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$status=$this->input->post('stat');
						$id=$this->input->post('id');
					$datas=$this->centermodel->change_status($status,$id,$user_id);
			}else{
				redirect('/');
			}
		}

		public function delete_videos(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
					$id=$this->input->post('id');
					$datas=$this->centermodel->delete_videos($id);
			}else{
				redirect('/');
			}
		}

		public function delete_gal(){
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');
			if($user_type==1){
				 	$center_photo_id=$this->input->post('gal_id');
					$datas['res']=$this->centermodel->delete_gal($center_photo_id);
			}else{
				redirect('/');
			}
		}








}
