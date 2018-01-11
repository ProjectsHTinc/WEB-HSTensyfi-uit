<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Scheme extends CI_Controller {


	function __construct() {
		 parent::__construct();


		    $this->load->helper('url');
		    $this->load->library('session');
				$this->load->model('schememodel');




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
				if($user_type==1 || $user_type==2){
			 $datas['res_img']=$this->schememodel->get_scheme_gallery_img();

			 $datas['res_scheme']=$this->schememodel->get_scheme_details();
			 $this->load->view('header');
	 		 $this->load->view('scheme/create',$datas);
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
				if($user_type==1 || $user_type==2){
			 	$scheme_name=$this->input->post('scheme_name');
				$scheme_info= $this->db->escape_str($this->input->post('scheme_info'));
				$scheme_video_link=$this->input->post('scheme_video_link');
				$scheme_photos=$this->input->post('scheme_photos');
				$datas=$this->schememodel->update_scheme($scheme_name,$scheme_info,$scheme_video_link,$scheme_photos,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('msg', 'Updated Successfully');
					redirect('scheme/home');
				}else{
					$this->session->set_flashdata('msg', 'Failed to Add');
					redirect('scheme/home');
				}
       }
       else{
          redirect('/');
       }
    }


		public function gallery(){
				$datas=$this->session->userdata();
				$user_id=$this->session->userdata('user_id');
				$user_type=$this->session->userdata('user_type');
				if($user_type==1 || $user_type==2){
					$name_array = $_FILES['scheme_photos']['name'];
					$tmp_name_array = $_FILES['scheme_photos']['tmp_name'];
					$count_tmp_name_array = count($tmp_name_array);
					$static_final_name = time();
					for($i = 0; $i < $count_tmp_name_array; $i++){
				   $extension = pathinfo($name_array[$i] , PATHINFO_EXTENSION);
					 $file_name[]=$static_final_name.$i.".".$extension;
					move_uploaded_file($tmp_name_array[$i], "assets/scheme/".$static_final_name.$i.".".$extension);
					}
				$datas=$this->schememodel->create_gallery($file_name,$user_id);
				if($datas['status']=="success"){
					$this->session->set_flashdata('gallery', 'Gallery Updated Successfully');
					redirect('scheme/home');
				}else if($datas['status']=="limit"){
					$this->session->set_flashdata('gallery', 'Gallery Maximum images Exceeds');
					redirect('scheme/home');
				}else{
					$this->session->set_flashdata('gallery', 'Failed to Add');
					redirect('scheme/home');
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
				 	$scheme_photo_id=$this->input->post('gal_id');
					$datas['res']=$this->schememodel->delete_gal($scheme_photo_id);
			}else{
				redirect('/');
			}
		}








}
