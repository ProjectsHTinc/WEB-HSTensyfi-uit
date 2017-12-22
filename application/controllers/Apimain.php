<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimain extends CI_Controller {

	
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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function index()
	{
		$this->load->view('welcome_message');
	}


	function __construct()
    {
        parent::__construct();
		$this->load->model("apimainmodel");

    }

	public function checkMethod()
	{
		if($_SERVER['REQUEST_METHOD'] != 'POST')
		{
			$res = array();
			$res["scode"] = 203;
			$res["message"] = "Request Method not supported";

			echo json_encode($res);
			return FALSE;
		}
		return TRUE;
	}

//-----------------------------------------------//

	public function login()
	{
	   $_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Login";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$username = '';
		$password = '';
		$gcmkey ='';
		$mobiletype ='';

		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$gcmkey = $this->input->post("gcm_key");
		$mobiletype = $this->input->post("mobile_type");
		
		$data['result']=$this->apimainmodel->Login($username,$password,$gcmkey,$mobiletype);
		$response = $data['result'];
		echo json_encode($response);
	}


//-----------------------------------------------//

	public function user_profilepic_upload($user_id,$user_type)
	{
	    $_POST = json_decode(file_get_contents("php://input"), TRUE);

		$user_id = $user_id;
     	$user_type = $user_type;
		$profile = $_FILES["user_pic"]["name"];
		$userFileName = time().'-'.$profile;
		
	    if($user_type==1) {
		    $uploadPicdir = 'assets/admin/profile/';
		} else if ($user_type==2) {
		     $uploadPicdir = 'assets/mobilizer/profile/';
		} else {
		   $uploadPicdir = 'assets/parents/profile/';
		}
		$profilepic = $uploadPicdir.$userFileName;
		move_uploaded_file($_FILES['user_pic']['tmp_name'], $profilepic);
		
		$data['result']=$this->apimainmodel->updateProfilepic($user_id,$user_type,$userFileName);
		$response = $data['result'];
		echo json_encode($response);
		
	}

//-----------------------------------------------//

	public function change_Password()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Reset Password";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$old_password = '';
		$password = '';
		
		$user_id = $this->input->post("user_id");
		$old_password = $this->input->post("old_password");
	 	$password = $this->input->post("password");

		$data['result']=$this->apimainmodel->changePassword($user_id,$old_password,$password);
		$response = $data['result'];
		echo json_encode($response);
	}
	
	
	
	
	
	

//-----------------------------------------------//

	public function disp_Events()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Events View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$class_id= '';
	 	$class_id = $this->input->post("class_id");


		$data['result']=$this->apimainmodel->dispEvents($class_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function disp_subEvents()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Events View";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$event_id= '';
	 	$event_id = $this->input->post("event_id");

		$data['result']=$this->apimainmodel->dispsubEvents($event_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Circular()
	{
	   	$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Circular";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

	    $user_id = '';
	    $user_id = $this->input->post("user_id");
	


		$data['result']=$this->apimainmodel->dispCircular($user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function add_Onduty()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Onduty Add";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}
		
		$user_type = '';
		$user_id = '';
		$od_for = '';
		$from_date = '';
        $to_date = '';
        $notes = '';
        $status = '';
        $created_by = '';
        $created_at = '';

        $user_type = $this->input->post("user_type");
		$user_id = $this->input->post("user_id");
        $od_for = $this->input->post("od_for"); 
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
        $notes = $this->input->post("notes");
        $status = $this->input->post("status");
        $created_by = $this->input->post("created_by");
        $created_at = $this->input->post("created_at");
        
        
		$data['result']=$this->apimainmodel->addOnduty($user_type,$user_id,$od_for,$from_date,$to_date,$notes,$status,$created_by,$created_at);
		$response = $data['result'];
		echo json_encode($response);
	}
//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Onduty()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Onduty";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_type = '';
	 	$user_type = $this->input->post("user_type");
	 	$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->dispOnduty($user_type,$user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//
 
//-----------------------------------------------//

	public function disp_Grouplist()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Grouplist";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_type = '';
	 	$user_type = $this->input->post("user_type");
	 	$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->dispGrouplist($user_type,$user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//


//-----------------------------------------------//

	public function send_Groupmessageold()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Send Group Message";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$group_title_id = '';
		$message_type = '';
		$message_details = '';
		$created_by = '';
		
	 	$group_title_id = $this->input->post("group_title_id");
	 	$message_type = $this->input->post("message_type");
		$message_details = $this->input->post("message_details");
		$created_by = $this->input->post("created_by");
		

		$data['result']=$this->apimainmodel->sendGroupmessage($group_title_id,$message_type,$message_details,$created_by);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function send_Groupmessage()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "Send Group Message";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$group_title_id = '';
		$messagetype_sms = '';
		$messagetype_mail = '';
		$messagetype_notification = '';
		$message_details = '';
		$created_by = '';
		
	 	$group_title_id = $this->input->post("group_title_id");
	 	$messagetype_sms = $this->input->post("messagetype_sms");
		$messagetype_mail = $this->input->post("messagetype_mail");
		$messagetype_notification = $this->input->post("messagetype_notification");
		$message_details = $this->input->post("message_details");
		$created_by = $this->input->post("created_by");
		

		$data['result']=$this->apimainmodel->sendGroupmessage($group_title_id,$messagetype_sms,$messagetype_mail,$messagetype_notification,$message_details,$created_by);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//

//-----------------------------------------------//

	public function disp_Groupmessage()
	{
		$_POST = json_decode(file_get_contents("php://input"), TRUE);

		if(!$this->checkMethod())
		{
			return FALSE;
		}

		if($_POST == FALSE)
		{
			$res = array();
			$res["opn"] = "View Group Message";
			$res["scode"] = 204;
			$res["message"] = "Input error";

			echo json_encode($res);
			return;
		}

		$user_id = '';
		$user_type = '';
	 	$user_type = $this->input->post("user_type");
	 	$user_id = $this->input->post("user_id");

		$data['result']=$this->apimainmodel->dispGroupmessage($user_type,$user_id);
		$response = $data['result'];
		echo json_encode($response);
	}

//-----------------------------------------------//
}
