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



   function send_circular_via_notification($title,$notes,$musers_id,$user_id)
   {

     require_once 'assets/notification/Firebase.php';
     require_once 'assets/notification/Push.php';


	   if($musers_id!='')
	   {
			$countid=count($musers_id);
       for($i=0;$i<$countid;$i++)
				 {
					 $userid=$musers_id[$i];
					$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
					
					$tgsm=$this->db->query($sql);
				    	$res=$tgsm->result();
					foreach($res as $row){ }
          				$device_token=array($row->gcm_key);

				  // $device_token = explode(",",$gsmkey);
           // $device_token="fnpVvsdnJhA:APA91bH7n5d5KKzYPjuhFiMda-Nk2-o-hdXTlGcezY-s4TZdxYCrbez88PRgTPhrj4mS4-cZElKsbJH6AKHwVaUMvFs87iq4TFtge9yToBXiPcm8w_sb6a1kTZ8zUkb9dg-3pYSqESY5";
           $push = null;

//        //first check if the push has an image with it
           $push = new Push(
                   $title,
                   $notes,
                   'http://heylaapp.com/notification/images/events.jpg'
               );

//             //if the push don't have an image give null in place of image
            // $push = new Push(
            //         'HEYLA',
            //         'Hi Testing from maran',
            //         null
            //     );

           //getting the push from push object
           $mPushNotification = $push->getPush();

           //creating firebase class object
           $firebase = new Firebase();

       foreach($device_token as $token) {
            $firebase->send(array($token),$mPushNotification);
       }

		 }

   }
  }




}

  ?>
