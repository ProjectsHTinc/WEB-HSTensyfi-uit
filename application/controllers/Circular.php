<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Circular extends CI_Controller
{
   function __construct()
   {
	   parent::__construct();
	   $this->load->helper('url');
	   $this->load->library('session');
	   $this->load->model('circularmodel');
	   $this->load->model('mailmodel');
	   $this->load->model('notificationmodel');
   }
	  //-------------------------------Create Circular Master--------------------------

	     public function create_circular_master()
          {
			  $datas=$this->session->userdata();
			  $user_id=$this->session->userdata('user_id');
			  $user_type=$this->session->userdata('user_type');
			  $datas['years']=$this->circularmodel->get_current_years();
			  $datas['result']=$this->circularmodel->get_all_result();
			  //echo'<pre>'; print_r($datas['result']);exit;
			  if($user_type==1 || $user_type==2)
			  {
			  $this->load->view('header');
			  $this->load->view('circular/create_circular_master',$datas);
			  $this->load->view('footer');
			  }
			  else{
			  redirect('/');
			  }
        }

		public function add_circular_master()
		{
			$datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');

			$year_id=$this->input->post('year_id');
			$ctile=$this->db->escape_str($this->input->post('ctitle'));
			$cdescription=$this->db->escape_str($this->input->post('cdescription'));
	      $status=$this->input->post('status');

		 $datas=$this->circularmodel->create_circular_masters($year_id,$ctile,$cdescription,$status,$user_id);
			  //print_r($datas);exit;
		  if($datas['status']=="success")
		  {
			  $this->session->set_flashdata('msg', 'Added Successfully');
			  redirect('circular/create_circular_master');
		  }else{
			  $this->session->set_flashdata('msg', 'Failed to Add');
			  redirect('circular/create_circular_master');
			  }
		}

	  public function edit_circular_master($id)
	  {
		   $datas=$this->session->userdata();
			$user_id=$this->session->userdata('user_id');
			$user_type=$this->session->userdata('user_type');

			$datas['years']=$this->circularmodel->get_current_years();
			$datas['result']=$this->circularmodel->edit_all_result($id);

			if($user_type==1 || $user_type==2)
			{
			  $this->load->view('header');
			  $this->load->view('circular/edit_circular_master',$datas);
			  $this->load->view('footer');
			}else{
			  redirect('/');
		   }
	  }

	  public function update_circular_master()
	  {
		$datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$year_id=$this->input->post('year_id');
		$cid=$this->input->post('cid');
		$ctile=$this->db->escape_str($this->input->post('ctitle'));
		$cdescription=$this->db->escape_str($this->input->post('cdescription'));
		$status=$this->input->post('status');

		$datas=$this->circularmodel->update_circular_masters($cid,$year_id,$ctile,$cdescription,$status,$user_id);
		  //print_r($datas);exit;
		if($datas['status']=="success")
		{
		  $this->session->set_flashdata('msg', 'Updated Successfully');
		  redirect('circular/create_circular_master');
		}else{
		  $this->session->set_flashdata('msg', 'Failed to Update');
		  redirect('circular/create_circular_master');
		}
	  }


	  //-------------------------------Create Circular --------------------------------
      public function add_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $datas['mobilizer']=$this->circularmodel->get_mobilizer_name();

		  $datas['role']=$this->circularmodel->getall_roles();
		  $datas['cmaster']=$this->circularmodel->cmaster_type();
		  //echo'<pre>';print_r( $datas['cmaster']);exit;
		  $user_type=$this->session->userdata('user_type');
		  if($user_type==1 || $user_type==2)
		  {
		  $this->load->view('header');
		  $this->load->view('circular/add',$datas);
		  $this->load->view('footer');
		  }
		  else{
		  redirect('/');
		  }
      }

	  public  function get_circular_title_list()
	  {
		   $ctype=$this->db->escape_str($this->input->post('ctype'));
		   //echo $ctype;exit;
		   $data=$this->circularmodel->get_circular_title_lists($ctype);
		   echo json_encode($data);
	  }

	  public function get_description_list()
	  {
		   $ctitle=$this->db->escape_str($this->input->post('ctitle'));
		   $data=$this->circularmodel->get_circular_description_lists($ctitle);
		   echo json_encode($data);
	  }


      public function create()
      {
    	  $datas=$this->session->userdata();
    	  $user_id=$this->session->userdata('user_id');
    	  $user_type=$this->session->userdata('user_type');
        if($user_type==1 || $user_type==2)
        {
	        $musers_id=$this->input->post('musers');
		     //print_r($users_id);exit;
	        $title=$this->db->escape_str($this->input->post('ctitle'));
	 	     $cdate=$this->input->post('date');
	        $dateTime = new DateTime($cdate);
	        $circulardate=date_format($dateTime,'Y-m-d' );
		     //echo $circulardate;exit;
	        $notes=$this->db->escape_str($this->input->post('notes'));
		     $status=$this->input->post('status');

      $datas=$this->circularmodel->circular_create($title,$notes,$circulardate,$musers_id,$status,$user_id);
	  //------------------------------ MAIL & NOTIFICATION--------------------------------------------
	 $datamail=$this->mailmodel->send_circular_via_mail($title,$notes,$cdate,$musers_id,$user_id);
	 $datanotify=$this->notificationmodel->send_circular_via_notification($title,$notes,$musers_id,$user_id);
	  //----------------------------------------------------------------------------------------------
	  //print_r($datas); exit;
	  if($datas['status']=="success")
	  {
	    echo "success";
	  }else{
         echo "Something went wrong!";
      }
      }else{
		  redirect('/');
		  }
     }

      public function view_circular()
      {
		  $datas=$this->session->userdata();
		  $user_id=$this->session->userdata('user_id');
		  $user_type=$this->session->userdata('user_type');

		  $datas['viewall']=$this->circularmodel->get_all_circular();
		  //echo '<pre>'; print_r($datas['viewall']); exit;

		  if($user_type==1 || $user_type==2)
		  {
		  $this->load->view('header');
		  $this->load->view('circular/view',$datas);
		  $this->load->view('footer');
		  }else{
		  redirect('/');
		  }
      }


}
?>
