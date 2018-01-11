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

     require_once './assets/notification/Firebase.php';
     require_once './assets/notification/Push.php';


	   if($musers_id!='')
	   {
			$countid=count($musers_id);
       for($i=0;$i<$countid;$i++)
				 {
					 $userid=$musers_id[$i];
					$sql="SELECT * FROM edu_notification WHERE user_id='$userid'";
					$tgsm=$this->db->query($sql);
				  $res=$tgsm->result();

          if($tgsm->num_rows()==0){

          }else{
            foreach($res as $row){ }
            $fcm=$row->gcm_key;
            if(empty($fcm)){
              $fcm="";
            }else{
              $device_token=array($fcm);
              $push = null;

    //        //first check if the push has an image with it
               $push = new Push(
                       $title,
                       $notes,
                       null);

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
  }




}

  ?>
