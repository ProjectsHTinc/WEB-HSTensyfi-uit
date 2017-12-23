<?php

Class Notificationmodel extends CI_Model
{

 public function __construct()
  {
      parent::__construct();

  }

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


     function send_notification_for_teacher_substitution($tname,$sub_teacher,$sub_tname,$leave_date,$cls_id,$period_id)
	 {
        $sql="SELECT user_id,name,user_master_id,teacher_id FROM edu_users WHERE teacher_id='$sub_teacher' AND user_type=2 AND user_master_id='$sub_teacher'";
		$resultset=$this->db->query($sql);
		$res=$resultset->result();
		foreach($res as $rows){}
		$userid=$rows->user_id;
		//echo $userid; exit;
		$sql1="SELECT cm.class_sec_id,cm.class,cm.section,c.class_id,c.class_name,s.sec_id,s.sec_name FROM edu_classmaster AS cm,edu_class AS c,edu_sections AS s WHERE cm.class_sec_id='$cls_id' AND cm.class=c.class_id AND cm.section=s.sec_id ";
		$resultset1=$this->db->query($sql1);
		$res1=$resultset1->result();
		foreach($res1 as $cls){}
		$cname=$cls->class_name;
		$sename=$cls->sec_name;

		$textmessage='This is to inform you that as '.$tname.' is on leave,'.$sub_tname.' will be the substitute teacher to fill in for '.$cname.'-'.$sename.',period ('.$period_id.') on '.$leave_date.' ';

		$data=array(
				  'message' => $textmessage,
				  'ctitle'  => "SUBSTITUTION",
				  'vibrate'	=> 1,
				  'sound'   => 1
				  );

		$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
		$tgsm=$this->db->query($sql);
		$tres1=$tgsm->result();
		foreach($tres1 as $trow)
		{
		   $gsmkey=array($trow->gcm_key);
		   //print_r($gsmkey);exit;
		  $apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
			// Set POST request body
			$post = array(
						'registration_ids'  => $gsmkey,
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
			curl_close($ch);
		}
	 }

   function send_circular_via_notification($title,$notes,$musers_id,$user_id)
   {
	   if($musers_id!='')
	   {
			$countid=count($musers_id);
         $data=array(
				           'message' => $notes,
							  'ctitle'  => $title,
							  'vibrate'	=> 1,
			              'sound'   => 1
							);

				 for($i=0;$i<$countid;$i++)
				 {
					$userid=$musers_id[$i];
					//print_r($data);

					$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
					$tgsm=$this->db->query($sql);
				    $res=$tgsm->result();
					foreach($res as $row)
					{ } $gsmkey=array($row->gcm_key);
					//echo $gsmkey;
					//sendPushNotification($data,$gsmkey);
					$apiKey = 'AAAADRDlvEI:APA91bFi-gSDCTCnCRv1kfRd8AmWu0jUkeBQ0UfILrUq1-asMkBSMlwamN6iGtEQs72no-g6Nw0lO5h4bpN0q7JCQkuTYsdPnM1yfilwxYcKerhsThCwt10cQUMKrBrQM2B3U3QaYbWQ';
	// Set POST request body
	$post = array(
				'registration_ids'  => $gsmkey,
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
	//if (curl_errno($ch)) {
		//echo 'GCM error: ' . curl_error($ch);
	//}
	// Close curl handle
	curl_close($ch);
		 }
				 //$sMessage="Send";
   }//teacher close
  }

      function sendNotification($gcm_key,$notes)
            {
              $gcm_key = array($gcm_key);
              $data = array
                    (
                    'message' 	=> $notes,
                    'vibrate'	=> 1,
                    'sound'		=> 1

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
			//if(!$result){ echo "Success";}

            // Handle errors
            if (curl_errno($ch)) {
            //echo 'GCM error: ' . curl_error($ch);
            }
            // Close curl handle
            curl_close($ch);

            // Debug GCM response
          
            }


            //Group Notification
         function send_notification($group_id,$notes,$user_id){
           $class="SELECT egm.group_member_id,ep.email,ep.mobile,ep.id FROM edu_grouping_members AS egm
           LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id=eu.user_master_id
           LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id, ep.admission_id) LEFT JOIN edu_notification AS en ON en.user_id=eu.user_id
           WHERE  egm.group_title_id='$group_id' AND ep.primary_flag='yes'";
          $pcell=$this->db->query($class);
          $res2=$pcell->result();
          foreach($res2 as $result){
          $parent_id=$result->id;
            $sql="SELECT eu.user_id,en.gcm_key FROM edu_users as eu left join edu_notification as en on eu.user_id=en.user_id WHERE user_type='4' and user_master_id='$parent_id'";
           $sgsm=$this->db->query($sql);
           $res=$sgsm->result();
           foreach($res as $row){
           $gcm_key=$row->gcm_key;
            $this->sendNotification($gcm_key,$notes);
          }

        }
      }

// Home Work Details

    function send_notify_homework($user_id,$user_type,$createdate,$clssid)
	{
		   $year_id=$this->getYear();

		  $sms="SELECT h.title,h.hw_details,h.hw_type,h.test_date,s.subject_name FROM edu_homework AS h,edu_subject AS s WHERE h.class_id='$clssid' AND h.year_id='$year_id' AND DATE_FORMAT(h.created_at,'%Y-%m-%d')='$createdate' AND h.subject_id=s.subject_id";
		  $sms1=$this->db->query($sms);
		  $sms2= $sms1->result();

		  foreach ($sms2 as $value)
          {
            $hwtitle=$value->title;
		    $hwdetails=$value->hw_details;
			$subname=$value->subject_name;
			$ht=$value->hw_type;
			$tdat=$value->test_date;

			if($ht=='HW'){ $type="Home Work" ; }else{ $type="Class Test" ; }
			//$message="Title : " .$hwtitle. ",Type : " .$type. ", Details : " .$hwdetails .", Subject : ".$subname.", ";
			  $message="Title : " .$hwtitle. ",Type : " .$type. ", Details : " .$hwdetails .", Subject : ".$subname.", ";
			$home_work_details[]=$message;
		  }
		   $notes[]=implode('',$home_work_details);
			//print_r($notes); exit;
            $pid="SELECT p.id,u.user_id FROM edu_parents AS p,edu_enrollment AS e,edu_users AS u WHERE e.class_id='$clssid' AND FIND_IN_SET(e.admission_id,p.admission_id) AND p.primary_flag='Yes' AND p.id=u.user_master_id AND u.user_type='4' GROUP BY p.id";

		  $pid1=$this->db->query($pid);
		  $pid2=$pid1->result();
		  foreach($pid2 as $res1)
		  {
		    $paid=$res1->user_id;
		    $psql="SELECT user_id,gcm_key FROM edu_notification WHERE user_id='$paid'";
           $pagsm=$this->db->query($psql);
           $pares=$pagsm->result();
           foreach($pares as $parow)
		   {
            $gcm_key=array($parow->gcm_key);

            //$this->sendNotification($gcm_key,$notes);

              $data = array
                    (
                    'message' 	=> $notes,
                    'vibrate'	=> 1,
                    'sound'		=> 1
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
            }
		  }
		  if($result){  $data= array("status"=>"success");
		      return $data;}

	}


    function send_notification_attendance($attend_id){
     $query="SELECT eu.user_id,en.gcm_key,ee.name,ep.mobile,ep.id,ee.admission_id,eah.abs_date,eah.student_id,eah.a_status,eah.attend_period,
    CASE WHEN attend_period = 0 THEN 'MORNING'  ELSE 'AFTERNOON' END  AS a_session,CASE WHEN a_status = 'L' THEN 'Leave' WHEN a_status = 'A' THEN 'Absent' ELSE 'OnDuty' END  AS abs_atatus  FROM edu_attendance_history AS eah LEFT JOIN edu_enrollment AS ee ON ee.enroll_id=eah.student_id LEFT JOIN edu_parents AS ep ON ee.admission_id=ep.admission_id LEFT JOIN edu_users AS eu ON
     eu.user_master_id=ep.id AND eu.user_type='4' LEFT JOIN edu_notification AS en ON eu.user_id=en.user_id WHERE eah.attend_id='$attend_id' AND ep.primary_flag='Yes'";
     $result=$this->db->query($query);
     $res=$result->result();
     foreach($res as $rows){
        $st_name=$rows->name;
        $parents_gcm_key=$rows->gcm_key;
        $at_ses=$rows->a_session;
        $abs_date=$rows->abs_date;
        $abs_status=$rows->abs_atatus;
         $gcm_key=array($parents_gcm_key);
        $notes='Your child '.$st_name.' was marked '.$abs_status.' today, '.$abs_date.' ON '.$at_ses.' To Known more details login into http://bit.ly/2wLwdRQ';

          $data = array
                (
                'message' 	=> $notes,
                'vibrate'	=> 1,
                'sound'		=> 1
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
      }
    }

}

  ?>
