<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller 
{

  function __construct() 
  {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->model('taskmodel');
		$this->load->model('mailmodel');
	   $this->load->model('notificationmodel');
   }

//-------------------------------Create Circular Master--------------------------
	  
  public function create_circular_master()
    {
	  $datas=$this->session->userdata();
	  $user_id=$this->session->userdata('user_id');
	  $user_type=$this->session->userdata('user_type');
	  $datas['years']=$this->taskmodel->get_current_years();
	  $datas['result']=$this->taskmodel->get_all_result();
	  //echo'<pre>'; print_r($datas['result']);exit;
	  if($user_type==1)
	  {
	  $this->load->view('header');
	  $this->load->view('task/create_circular_master',$datas);
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
		
	 $datas=$this->taskmodel->create_circular_masters($year_id,$ctile,$cdescription,$status,$user_id);
		  //print_r($datas);exit;
	  if($datas['status']=="success")
	  {
		  $this->session->set_flashdata('msg', 'Added Successfully');
		  redirect('task/create_circular_master');
	  }else{
		  $this->session->set_flashdata('msg', 'Failed to Add');
		  redirect('task/create_circular_master');
		  }
	}
  
  public function edit_circular_master($id)
  {
	   $datas=$this->session->userdata();
		$user_id=$this->session->userdata('user_id');
		$user_type=$this->session->userdata('user_type');

		$datas['years']=$this->taskmodel->get_current_years();
		$datas['result']=$this->taskmodel->edit_all_result($id);
	
		if($user_type==1)
		{
		  $this->load->view('header');
		  $this->load->view('task/edit_circular_master',$datas);
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
	
	$datas=$this->taskmodel->update_circular_masters($cid,$year_id,$ctile,$cdescription,$status,$user_id);
	  //print_r($datas);exit;
	if($datas['status']=="success")
	{
	  $this->session->set_flashdata('msg', 'Updated Successfully');
	  redirect('task/create_circular_master');
	}else{
	  $this->session->set_flashdata('msg', 'Failed to Update');
	  redirect('task/create_circular_master');
	}
  }
  
  
  //-------------------------------Create Circular --------------------------------
   public function add_circular()
   {
	  $datas=$this->session->userdata();
	  $user_id=$this->session->userdata('user_id');
	  $datas['mobilizer']=$this->taskmodel->get_mobilizer_name();
	
	  $datas['role']=$this->taskmodel->getall_roles();
	  $datas['cmaster']=$this->taskmodel->cmaster_type();
	  //echo'<pre>';print_r( $datas['cmaster']);exit;
	  $user_type=$this->session->userdata('user_type');
	  if($user_type==1)
	  {
	  $this->load->view('header');
	  $this->load->view('task/add',$datas);
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
	   $data=$this->taskmodel->get_circular_title_lists($ctype);
	   echo json_encode($data);
  }
  
  public function get_description_list()
  {
	   $ctitle=$this->db->escape_str($this->input->post('ctitle'));
	   $data=$this->taskmodel->get_circular_description_lists($ctitle);
	   echo json_encode($data);
  }
 
  
   public function create()
   {
 	  $datas=$this->session->userdata();
 	  $user_id=$this->session->userdata('user_id');
 	  $user_type=$this->session->userdata('user_type');
     if($user_type==1)
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
  
   $datas=$this->taskmodel->circular_create($title,$notes,$circulardate,$musers_id,$status,$user_id);
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
	  
	  $datas['viewall']=$this->taskmodel->get_all_circular();
	  //echo '<pre>'; print_r($datas['viewall']); exit;

	  if($user_type==1)
	  {
	  $this->load->view('header');
	  $this->load->view('task/view',$datas);
	  $this->load->view('footer');
	  }else{
	  redirect('/');
	  }
   }

   public function view_mobilizer_task()
   {
     $datas=$this->session->userdata();
	  $user_id=$this->session->userdata('user_id');
	  $user_type=$this->session->userdata('user_type');
	  
	  $datas['viewall']=$this->taskmodel->get_all_mobilizer_task();
	  //echo '<pre>'; print_r($datas['viewall']); exit;

	  if($user_type==1)
	  {
	  $this->load->view('header');
	  $this->load->view('task/view_mobilizer',$datas);
	  $this->load->view('footer');
	  }else{
	  redirect('/');
	  }
   }

   public function view_all_task_details($mobilizer_id)
   {
     $datas=$this->session->userdata();
	  $user_id=$this->session->userdata('user_id');
	  $user_type=$this->session->userdata('user_type');
	  
	  $datas['viewall_task']=$this->taskmodel->get_all_mobilizer_detailstask($mobilizer_id);
	  //echo '<pre>'; print_r($datas['viewall_task']); exit;

	  if($user_type==1)
	  {
	  $this->load->view('header');
	  $this->load->view('task/view_mobilizer_details',$datas);
	  $this->load->view('footer');
	  }else{
	  redirect('/');
	  }
   }


}
?>