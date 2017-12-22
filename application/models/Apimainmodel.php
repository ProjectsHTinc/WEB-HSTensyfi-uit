<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apimainmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }


//#################### Email ####################//

	public function sendMail($to,$subject,$htmlContent)
	{
		// Set content-type header for sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// Additional headers
		$headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
		mail($to,$subject,$htmlContent,$headers);
	}

//#################### Email End ####################//


//#################### Email ####################//

	public function sendNotification($gcm_key,$Title,$Message)
	{

			require_once 'assets/notification/Firebase.php';
            require_once 'assets/notification/Push.php'; 
            
            $device_token = explode(",", $gcm_key);
            $push = null; 
        
//        //first check if the push has an image with it
		    $push = new Push(
					$Title,
					$Message,
					'http://heylaapp.com/notification/images/events.jpg'
				);

// 			//if the push don't have an image give null in place of image
 			// $push = new Push(
 			// 		'HEYLA',
 			// 		'Hi Testing from maran',
 			// 		null
 			// 	);

    		//getting the push from push object
    		$mPushNotification = $push->getPush(); 
    
    		//creating firebase class object 
    		$firebase = new Firebase(); 

    	foreach($device_token as $token) {
    		 $firebase->send(array($token),$mPushNotification);
    	}


/*
	        $gcm_key = array($gcm_key);
			$data = array
			(
				'message' 	=> $Message,
				'title'		=> $Title,
				'vibrate'	=> 1,
				'sound'		=> 1
		//		'largeIcon'	=> 'http://happysanz.net/testing/assets/students/profile/236832.png'
		//		'smallIcon'	=> 'small_icon'
			);

			// Insert real GCM API key from the Google APIs Console
			$apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
			// Set POST request body
			$post = array(
						'registration_ids'  => $gcm_key,
						'data'              => $data,
						 );
			// Set CURL request headers
			$headers = array(
						'Authorization: key=' . $apiKey,
						'Content-Type: application/json'
							);
			// Initialize curl handle
			$ch = curl_init();
			// Set URL to GCM push endpoint
			curl_setopt($ch, CURLOPT_URL, 'https://gcm-http.googleapis.com/gcm/send');
			// Set request method to POST
			curl_setopt($ch, CURLOPT_POST, true);
			// Set custom request headers
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			// Get the response back as string instead of printing it
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// Set JSON post data
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
			// Actually send the request
			$result = curl_exec($ch);


			// Handle errors
			if (curl_errno($ch)) {
				//echo 'GCM error: ' . curl_error($ch);
			}
			// Close curl handle
			curl_close($ch);

			// Debug GCM response
			//echo $result;
*/


	}

//#################### Notification End ####################//


//#################### SMS ####################//

	public function sendSMS($Phoneno,$Message)
	{
		$textmsg = urlencode($Message);
		$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
		$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
		$api_params = $api_element.'&numbers='.$Phoneno.'&message='.$textmsg;
		$smsgatewaydata = $smsGatewayUrl.$api_params;
		$url = $smsgatewaydata;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$output = curl_exec($ch);
		curl_close($ch);
	}

//#################### SMS End ####################//


//#################### Current Year ####################//

	public function getYear()
	{
		$sqlYear = "SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
		$year_result = $this->db->query($sqlYear);
		$ress_year = $year_result->result();

		if($year_result->num_rows()==1)
		{
			foreach ($year_result->result() as $rows)
			{
			    $year_id = $rows->year_id;
			}
			return $year_id;
		}
	}
//#################### Current Year End ####################//



//#################### Login ####################//

	public function Login($username,$password,$gcmkey,$mobiletype)
	{
		$year_id = $this->getYear();

 		$sql = "SELECT * FROM edu_users A, edu_role B  WHERE A.user_type = B.role_id AND A.user_name ='".$username."' and A.user_password = md5('".$password."') and A.status='Active'";
		$user_result = $this->db->query($sql);
		$ress = $user_result->result();

		if($user_result->num_rows()>0)
		{
			foreach ($user_result->result() as $rows)
			{
				  $user_id = $rows->user_id;
				  $login_count = $rows->login_count+1;
				  $user_type = $rows->user_type;
				  $update_sql = "UPDATE edu_users SET last_login_date=NOW(),login_count='$login_count' WHERE user_id='$user_id'";
				  $update_result = $this->db->query($update_sql);
			}

				$userData  = array(
							"user_id" => $ress[0]->user_id,
							"name" => $ress[0]->name,
							"user_name" => $ress[0]->user_name,
							"user_pic" => $ress[0]->user_pic,
							"user_type" => $ress[0]->user_type,
							"user_type_name" => $ress[0]->user_type_name,
							"password_status" => $ress[0]->password_status
						);

				$gcmQuery = "SELECT * FROM edu_notification WHERE gcm_key like '%" .$gcmkey. "%' LIMIT 1";
				$gcm_result = $this->db->query($gcmQuery);
				$gcm_ress = $gcm_result->result();

				if($gcm_result->num_rows()==0)
				{
					$sQuery = "INSERT INTO edu_notification (user_id,gcm_key,mobile_type) VALUES ('". $user_id . "','". $gcmkey . "','". $mobiletype . "')";
					$update_gcm = $this->db->query($sQuery);
				}

				  if ($user_type==1)  {

				 	 	$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData, "year_id" => $year_id);
						return $response;
				  }
				  else if ($user_type==2) {

						$mobilizer_id = $rows->user_master_id;

                       $staff_query = "SELECT t.id, t.name, t.sex, t.age, t.nationality, t.religion, t.community_class, t.community, t.address, t.email,t.sec_email, t.phone,t.sec_phone, t.profile_pic, t.trade_batch_id, t.qualification FROM edu_staff_details AS t WHERE t.id = '$mobilizer_id'";
						$staff_res = $this->db->query($staff_query);
						$staff_profile = $staff_res->result();

						$response = array("status" => "loggedIn", "msg" => "User loggedIn successfully", "userData" => $userData,"staffProfile" =>$staff_profile,"year_id" => $year_id);
						return $response;
				  }


		} else {
			 			$response = array("status" => "error", "msg" => "Invalid login");
						return $response;
			 }
	}

//#################### Main Login End ####################//

//#################### Profile Pic Update ####################//
	public function updateProfilepic($user_id,$user_type,$userFileName)
	{
            $update_sql= "UPDATE edu_users SET user_pic='$userFileName', updated_date=NOW() WHERE user_id='$user_id' and user_type='$user_type'";
			$update_result = $this->db->query($update_sql);

			$response = array("status" => "success", "msg" => "Profile Picture Updated","user_picture"=>$userFileName);
			return $response;
	}
//#################### Profile Pic Update End ####################//


//#################### Change Password ####################//
	public function changePassword($user_id,$old_password,$password)
	{
			$user_query = "SELECT * FROM edu_users WHERE user_id ='$user_id' and user_password= md5('$old_password') and status='Active'";
			$user_res = $this->db->query($user_query);
			$user_result= $user_res->result();

			if($user_res->num_rows()==1)
			{
				$update_sql = "UPDATE edu_users SET user_password = md5('$password'),updated_date=NOW() WHERE user_id='$user_id'";
				$update_result = $this->db->query($update_sql);

                $response = array("status" => "sucess", "msg" => "Password Updated");
			} else {
				$response = array("status" => "error", "msg" => "Entered Current Password is wrong.");
			}

			return $response;
	}
//#################### Change Password End ####################//


//#################### Events for Students and Parents ####################//
	public function dispEvents($class_id)
	{
			$year_id = $this->getYear();

		 	$event_query = "SELECT event_id,year_id,event_name,event_details,status,DATE_FORMAT(event_date,'%d-%m-%Y') as event_date,sub_event_status FROM `edu_events` WHERE year_id='$year_id' AND status='Active'";
			$event_res = $this->db->query($event_query);
			$event_result= $event_res->result();
			$event_count = $event_res->num_rows();
/*
			foreach($event_result as $rows){
				$event_id = $rows->event_id;

					$gallery_query = "SELECT * FROM `edu_events_galllery` WHERE event_id ='$event_id'";
					$gallery_res = $this->db->query($gallery_query);
					$gallery_result= $gallery_res->result();

					if($gallery_res->num_rows()!=0){
						//echo $gallery_result;
					}
			}
*/
			 if($event_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Events Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Events", "count" => $event_count, "eventDetails"=>$event_result);
			}

			return $response;
	}
//#################### Events Details End ####################//


//#################### Events for Students and Parents ####################//
	public function dispsubEvents ($event_id)
	{
			$year_id = $this->getYear();

			$subevent_query = "SELECT A.sub_event_name,B.name  from edu_event_coordinator A, edu_teachers B WHERE A.event_id = '$event_id' AND A.co_name_id = B.teacher_id AND A.status='Active'";

			$subevent_res = $this->db->query($subevent_query);
			$subevent_result= $subevent_res->result();

			 if($subevent_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Sub Events Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Sub Events", "subeventDetails"=>$subevent_result);
			}

			return $response;
	}
//#################### Event Details End ####################//


//#################### Circular for All ####################//
	public function dispCircular($user_id)
	{

			$year_id = $this->getYear();

			 $circular_query = "SELECT
                                A.circular_type,
                                B.circular_title,
                                B.circular_description,
                                A.circular_date
                            FROM
                                edu_circular A,
                                edu_circular_master B
                            WHERE
                                A.user_id = '$user_id' AND B.academic_year_id = '$year_id' AND A.circular_master_id = B.id AND A.status = 'Active'";

			$circular_res = $this->db->query($circular_query);
			$circular_result= $circular_res->result();

			 if($circular_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Circular Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Circular", "circularDetails"=>$circular_result);
			}
            //print_r($response);exit;
			return $response;
	}
//#################### Circular End ####################//

//#################### Add Onduty ####################//
	public function addOnduty ($user_type,$user_id,$od_for,$from_date,$to_date,$notes,$status,$created_by,$created_at)
	{
			$year_id = $this->getYear();

		    $onduty_query = "INSERT INTO `edu_on_duty`( `user_type`, `user_id`, `year_id`, `od_for`, `from_date`, `to_date`, `notes`, `status`, `created_by`, `created_at`) VALUES ('$user_type','$user_id','$year_id','$od_for','$from_date','$to_date','$notes','$status','$created_by','$created_at')";
	        $onduty_res = $this->db->query($onduty_query);

			if($onduty_res) {
			    $response = array("status" => "success", "msg" => "Onduty Added");
			} else {
			    $response = array("status" => "error");
			}
			return $response;
	}
//#################### Onduty End ####################//

//#################### Onduty for All ####################//
	public function dispOnduty ($user_type,$user_id)
	{
			$year_id = $this->getYear();

            if ($user_type=='2'){
			     $Onduty_query = "SELECT
                                    A.od_for,
                                    A.from_date,
                                    A.to_date,
                                    A.notes,
                                    A.status,
                                    C.teacher_id,
                                    D.name
                                FROM
                                    edu_on_duty A,
                                    edu_users C,
                                    edu_teachers D
                                WHERE
                                    A.user_id = C.user_id AND C.teacher_id = D.teacher_id AND A.user_type = '$user_type' AND A.user_id = '$user_id' AND A.year_id = '$year_id'";
            }

            if ($user_type=='3'){
			     $Onduty_query = "SELECT
                                    A.od_for,
                                    A.from_date,
                                    A.to_date,
                                    A.notes,
                                    A.status,
                                    C.student_id,
                                    D.name
                                FROM
                                    edu_on_duty A,
                                    edu_users C,
                                    edu_admission D
                                WHERE
                                    A.user_id = C.user_id AND C.student_id = D.admission_id AND A.user_type = '$user_type' AND A.user_id = '$user_id' AND A.year_id = '$year_id'";
            }

            if ($user_type=='4')
            {
                $user_sql = "SELECT *  FROM `edu_users` WHERE student_id = '$user_id'";
                $user_result = $this->db->query($user_sql);
        		$user_ress = $user_result->result();

        		if($user_result->num_rows()>0)
        		{
        			foreach ($user_result->result() as $rows)
        			{
        				  $user_id = $rows->user_id;
        			}
        		}
        		  $user_type = '3';
        		  $Onduty_query = "SELECT
                                    A.od_for,
                                    A.from_date,
                                    A.to_date,
                                    A.notes,
                                    A.status,
                                    C.student_id,
                                    D.name
                                FROM
                                    edu_on_duty A,
                                    edu_users C,
                                    edu_admission D
                                WHERE
                                    A.user_id = C.user_id AND C.student_id = D.admission_id AND A.user_type = '$user_type' AND A.user_id = '$user_id' AND A.year_id = '$year_id'";
                }


			$Onduty_res = $this->db->query($Onduty_query);
			$Onduty_result = $Onduty_res->result();

			 if($Onduty_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Onduty Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Onduty", "ondutyDetails"=>$Onduty_result);
			}

			return $response;
	}
//#################### Onduty End ####################//

//#################### View Groups ####################//
	public function dispGrouplist ($user_type,$user_id)
	{
			$year_id = $this->getYear();

            if ($user_type=='1'){
			     $Group_query = "SELECT id, group_title FROM `edu_grouping_master` WHERE year_id = '$year_id'";
            } else {
				 $Group_query = "SELECT id, group_title FROM `edu_grouping_master` WHERE year_id = '$year_id' AND group_lead_id = '$user_id'";
			}

			$Group_res = $this->db->query($Group_query);
			$Group_result = $Group_res->result();

			 if($Group_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Groups Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Groups", "groupDetails"=>$Group_result);
			}

			return $response;
	}
//#################### View Groups End ####################//

//#################### Send Group Message ####################//
	public function sendGroupmessageold ($group_title_id,$message_type,$message_details,$created_by)
	{
			$year_id = $this->getYear();

			$m_type = explode(",", $message_type);
			$m_type_cnt = count($m_type);

			if($m_type_cnt==1){
				 $m_type1=$m_type[0];
			}

			if($m_type_cnt==2){
				 $m_type1=$m_type[0];
				 $m_type2=$m_type[1];
			}

			if($m_type_cnt==3){
				 $m_type1=$m_type[0];
				 $m_type2=$m_type[1];
				 $m_type3=$m_type[2];
			}


			if($m_type_cnt==3) {
                $subject = 'Group Notification';
				$email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
				$email_res = $this->db->query($email_query);
			    $email_result = $email_res->result();

    			 if($email_res->num_rows()!=0){
    				foreach ($email_result as $rows)
        			{
        				  $sEmail = $rows->email;
        				  $this->sendMail($sEmail,$subject,$message_details);
        			}
    			 }


				$mobile_query = "SELECT egm.group_member_id, ep.mobile FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
				$mobile_res = $this->db->query($mobile_query);
			    $mobile_result = $email_res->result();

    			 if($mobile_res->num_rows()!=0){
    				foreach ($mobile_result as $rows)
        			{
        				  $sMobile = $rows->mobile;
        				  $this->sendSMS($sMobile,$message_details);
        			}
    			 }

    			$gcm_query = "SELECT egm.group_member_id,ep.parent_id,en.gcm_key FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id,ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id = eu.user_id WHERE egm.group_title_id = '$group_title_id'";
				$gcm_res = $this->db->query($gcm_query);
			    $gcm_result = $gcm_res->result();

    			 if($gcm_res->num_rows()!=0){
    				foreach ($gcm_result as $rows)
        			{
        				$sParent_id = $rows->parent_id;

        				$sql = "SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$sParent_id'";
						$sgsm  = $this->db->query($sql);
						$res = $sgsm->result();

						foreach($res as $row){
						    $sGcm_key = $row->gcm_key;
						    $this->sendNotification($sGcm_key,$subject,$message_details);
						}

        			}
    		    }

			 }


			if($m_type_cnt==2) {
			     if($m_type1=='SMS' && $m_type2=='Mail')
		 		  {
					    $subject = 'Group Notification';
        				$email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
        				$email_res = $this->db->query($email_query);
        			    $email_result = $email_res->result();

            			 if($email_res->num_rows()!=0){
            				foreach ($email_result as $rows)
                			{
                				  $sEmail = $rows->email;
                				  $this->sendMail($sEmail,$subject,$message_details);
                			}
            			 }


        				$mobile_query = "SELECT egm.group_member_id, ep.mobile FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
        				$mobile_res = $this->db->query($mobile_query);
        			    $mobile_result = $email_res->result();

            			 if($mobile_res->num_rows()!=0){
            				foreach ($mobile_result as $rows)
                			{
                				  $sMobile = $rows->mobile;
                				  $this->sendSMS($sMobile,$message_details);
                			}
    			         }
		 		  }
		 		  if($m_type1=='SMS' && $m_type2=='Notification')
		 		  {
					    $subject = 'Group Notification';
        				$email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
        				$email_res = $this->db->query($email_query);
        			    $email_result = $email_res->result();

            			 if($email_res->num_rows()!=0){
            				foreach ($email_result as $rows)
                			{
                				  $sEmail = $rows->email;
                				  $this->sendMail($sEmail,$subject,$message_details);
                			}
            			 }

        			 	$gcm_query = "SELECT egm.group_member_id,ep.parent_id,en.gcm_key FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id,ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id = eu.user_id WHERE egm.group_title_id = '$group_title_id'";
        				$gcm_res = $this->db->query($gcm_query);
        			    $gcm_result = $gcm_res->result();

            			 if($gcm_res->num_rows()!=0){
            				foreach ($gcm_result as $rows)
                			{
                				$sParent_id = $rows->parent_id;

                				$sql = "SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$sParent_id'";
        						$sgsm  = $this->db->query($sql);
        						$res = $sgsm->result();

        						foreach($res as $row){
        						    $sGcm_key = $row->gcm_key;
        						    $this->sendNotification($sGcm_key,$subject,$message_details);
        						}

                			}
		 		        }
		 		  }
		 		  if($m_type1=='Mail' && $m_type2=='Notification')
		 		  {
		 		        $subject = 'Group Notification';
        				$email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
        				$email_res = $this->db->query($email_query);
        			    $email_result = $email_res->result();

            			 if($email_res->num_rows()!=0){
            				foreach ($email_result as $rows)
                			{
                				  $sEmail = $rows->email;
                				  $this->sendMail($sEmail,$subject,$message_details);
                			}
            			 }

 					    $gcm_query = "SELECT egm.group_member_id,ep.parent_id,en.gcm_key FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id,ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id = eu.user_id WHERE egm.group_title_id = '$group_title_id'";
        				$gcm_res = $this->db->query($gcm_query);
        			    $gcm_result = $gcm_res->result();

            			 if($gcm_res->num_rows()!=0){
            				foreach ($gcm_result as $rows)
                			{
                				$sParent_id = $rows->parent_id;

                				$sql = "SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$sParent_id'";
        						$sgsm  = $this->db->query($sql);
        						$res = $sgsm->result();

        						foreach($res as $row){
        						    $sGcm_key = $row->gcm_key;
        						    $this->sendNotification($sGcm_key,$subject,$message_details);
        						}

                			}
            			 }
		 		   }
			    }


			if($m_type_cnt==1) {
                if($m_type1=='Mail'){
                    $subject = 'Group Notification';
    				$email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
    				$email_res = $this->db->query($email_query);
    			    $email_result = $email_res->result();

        			 if($email_res->num_rows()!=0){
        				foreach ($email_result as $rows)
            			{
            				  $sEmail = $rows->email;
            				  $this->sendMail($sEmail,$subject,$message_details);
            			}
        			 }
				  }

                if($m_type1=='SMS') {
				    $mobile_query = "SELECT egm.group_member_id, ep.mobile FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'";
    				$mobile_res = $this->db->query($mobile_query);
    			    $mobile_result = $email_res->result();

        			 if($mobile_res->num_rows()!=0){
        				foreach ($mobile_result as $rows)
            			{
            				  $sMobile = $rows->mobile;
            				  $this->sendSMS($sMobile,$message_details);
            			}
			         }
				}

				if($m_type1=='Notification') {
                    $gcm_query = "SELECT egm.group_member_id,ep.parent_id,en.gcm_key FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id,ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id = eu.user_id WHERE egm.group_title_id = '$group_title_id'";
                    $gcm_res = $this->db->query($gcm_query);
                    $gcm_result = $gcm_res->result();

                    if($gcm_res->num_rows()!=0){
                    foreach ($gcm_result as $rows)
                        {
                        	$sParent_id = $rows->parent_id;

                        	$sql = "SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$sParent_id'";
                        	$sgsm  = $this->db->query($sql);
                        	$res = $sgsm->result();

                        	foreach($res as $row){
                        	    $sGcm_key = $row->gcm_key;
                        	    $this->sendNotification($sGcm_key,$subject,$message_details);
                        	}

                        }
                    }
				}

			 }

		    $grouphistory_query = "INSERT INTO `edu_grouping_history`(`group_title_id`, `notes`, `notification_type`, `status`, `created_by`, `created_at`) VALUES ('$group_title_id','$message_details','$message_type','Active','$created_by',NOW())";
			$grouphistory_res = $this->db->query($grouphistory_query);
			$last_historyid = $this->db->insert_id();

			if($grouphistory_res) {
				$response = array("status" => "success", "msg" => "Group Message Added", "last_group_history_id"=>$last_historyid);
			} else {
				$response = array("status" => "error");
			}

			return $response;
	}
//#################### Group Message End ####################//

//#################### Send Group Message ####################//
	public function sendGroupmessage ($group_title_id,$messagetype_sms,$messagetype_mail,$messagetype_notification,$message_details,$created_by)
	{
			$year_id = $this->getYear();
            $message_type ='';

                if($messagetype_sms=="1"){
                     $message_type = "SMS";
                }

                if ($messagetype_mail=="1"){
                        if ($message_type=='') {
                             $message_type = "Mail";
                         } else {
                             $message_type = $message_type.",Mail";
                        }
                }
                if ($messagetype_notification=="1"){
                        if ($message_type=='') {
                             $message_type = "Notification";
                        } else {
                             $message_type = $message_type.",Notification";
                        }
                }


                if($messagetype_sms != 0){
/*
					//$number1='9789108819,9865905230,9942297930';
					$number1='9840111100,9841401896,9841401877,9444008809,9841322331,9444124618,9841460166,98940159304,9840091224,9841460161,9841401855';
					$textmsg = urlencode($message_details);
					$smsGatewayUrl = 'http://173.45.76.227/send.aspx?';
					$api_element = 'username=kvmhss&pass=kvmhss123&route=trans1&senderid=KVMHSS';
					$api_params = $api_element.'&numbers='.$number1.'&message='.$textmsg;
					$smsgatewaydata = $smsGatewayUrl.$api_params;
					$url1 = $smsgatewaydata;
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_POST, false);
					curl_setopt($ch, CURLOPT_URL, $url1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$output = curl_exec($ch);
					curl_close($ch);
*/
                    $mobile_query = "SELECT egm.group_member_id, ep.mobile FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id' AND ep.primary_flag = 'Yes'";
                	$mobile_res = $this->db->query($mobile_query);
                    $mobile_result = $mobile_res->result();

                	 if($mobile_res->num_rows()!=0){
                		foreach ($mobile_result as $rows)
                		{
                			  $sMobile = $rows->mobile;
                			  $this->sendSMS($sMobile,$message_details);
                		}
                     }
                }

            if($messagetype_mail != 0){
                $subject = 'Group Notification';
                $email_query = "SELECT egm.group_member_id, ep.email FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET( ea.admission_id,ep.admission_id)WHERE egm.group_title_id = '$group_title_id'  AND ep.primary_flag = 'Yes'";
                $email_res = $this->db->query($email_query);
                $email_result = $email_res->result();

                 if($email_res->num_rows()!=0){
                	foreach ($email_result as $rows)
                	{
                		  $sEmail = $rows->email;
                		  $this->sendMail($sEmail,$subject,$message_details);
                	}
                 }

            }

            if($messagetype_notification != 0){
                $subject = 'Group Notification';

                $gcm_query = "SELECT egm.group_member_id,ep.id,en.gcm_key FROM edu_grouping_members AS egm LEFT JOIN edu_users AS eu ON eu.user_id = egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id = eu.user_master_id LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id,ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id = eu.user_id WHERE egm.group_title_id = '$group_title_id'  AND ep.primary_flag = 'yes'";
                $gcm_res = $this->db->query($gcm_query);
                $gcm_result = $gcm_res->result();

                if($gcm_res->num_rows()!=0){
                	foreach ($gcm_result as $rows)
                    {
                    	$sParent_id = $rows->id;

                    	$sql = "SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$sParent_id'";
                    	$sgsm  = $this->db->query($sql);
                    	$res = $sgsm->result();

                    	foreach($res as $row){
                    	    $sGcm_key = $row->gcm_key;
                    	    $this->sendNotification($sGcm_key,$subject,$message_details);
                    	}

                    }
                }
            }

		    $grouphistory_query = "INSERT INTO `edu_grouping_history`(`group_title_id`, `notes`, `notification_type`, `status`, `created_by`, `created_at`) VALUES ('$group_title_id','$message_details','$message_type','Active','$created_by',NOW())";
			$grouphistory_res = $this->db->query($grouphistory_query);
			$last_historyid = $this->db->insert_id();

			if($grouphistory_res) {
				$response = array("status" => "success", "msg" => "Group Message Added", "last_group_history_id"=>$last_historyid);
			} else {
				$response = array("status" => "error");
			}

			return $response;
	}
//#################### Group Message End ####################//

//#################### View Group Messages ####################//
	public function dispGroupmessage ($user_type,$user_id)
	{
			$year_id = $this->getYear();

            if ($user_type=='1'){
			     $Group_query = "SELECT B.id, A.id AS group_title_id, A.group_title, B.notes FROM `edu_grouping_master` A, `edu_grouping_history` B WHERE A.year_id = '$year_id' AND A.id = B.`group_title_id` ORDER BY B.id DESC";
            } else {
				 $Group_query = "SELECT B.id, A.id AS group_title_id, A.group_title, B.notes FROM `edu_grouping_master` A, `edu_grouping_history` B WHERE A.year_id = '$year_id' AND A.id = B.`group_title_id` AND group_lead_id = '$user_id' ORDER BY B.id DESC";
			}

			$Group_res = $this->db->query($Group_query);
			$Group_result = $Group_res->result();

			 if($Group_res->num_rows()==0){
				 $response = array("status" => "error", "msg" => "Group Message Not Found");
			}else{
				$response = array("status" => "success", "msg" => "View Group Messages", "groupmsgDetails"=>$Group_result);
			}

			return $response;
	}
//#################### View Group Messages End ####################//

}

?>
