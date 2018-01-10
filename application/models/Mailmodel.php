<?php

Class Mailmodel extends CI_Model
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



  function send_circular_via_mail($title,$notes,$cdate,$musers_id,$user_id)
  {
	  //-----------------------------Teacher---------------------

	 if(!empty($musers_id))
	 {
	    $countid=count($musers_id);
	     //echo $countid;
		 for($i=0;$i<$countid;$i++)
		 {
			$muserid=$musers_id[$i];
			$mbsql="SELECT u.user_id,u.user_type,u.user_master_id,mb.id,mb.name,mb.phone,mb.email,mb.role_type FROM edu_users AS u, edu_staff_details AS mb WHERE u.user_id='$muserid' AND u.user_type='4' AND u.user_type=mb.role_type AND u.user_master_id=mb.id";
			$mbmail=$this->db->query($mbsql);
			$mbres=$mbmail->result();
			foreach($mbres as $mbrow)
			{}
			 $mbemail=$mbrow->email;
          $to=$mbemail;
			 $subject=$title.$cdate;
			 $cnotes=$notes;
			 $htmlContent = '
				 <html>
				 <head><title></title>
				 </head>
				 <body>
				 <p style="margin-left:50px;">'.$cnotes.'</p>
				 </body>
				 </html>';
		 $headers = "MIME-Version: 1.0" . "\r\n";
		 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		 //Additional headers

		 $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
		 $sent= mail($to,$subject,$htmlContent,$headers);

          }
       }//teacher close

  }//function close

    // Group Mail
    function send_mail($group_id,$notes,$user_id){
       $sql1="SELECT egm.group_member_id,ep.email,ep.mobile FROM edu_grouping_members AS egm
      LEFT JOIN edu_users AS eu ON eu.user_id=egm.group_member_id LEFT JOIN edu_admission AS ea ON ea.admission_id=eu.user_master_id
      LEFT JOIN edu_parents AS ep ON FIND_IN_SET(ea.admission_id, ep.admission_id)
      WHERE  egm.group_title_id='$group_id'";
       $scell=$this->db->query($sql1);
       $res1=$scell->result();
       foreach($res1 as $row1)
       {
        $semail=$row1->email;
        $to=$semail;
        $subject="From KalaiMagal";

         $htmlContent = '
          <html>
          <head><title></title>
          </head>
          <body>
          <p style="margin-left:50px;">'.$notes.'</p>
          </body>
          </html>';
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // Additional headers
      $headers .= 'From: happysanz<info@happysanz.com>' . "\r\n";
     $send= mail($to,$subject,$htmlContent,$headers);
     }
    }

	//-----------------------Send Home Work In Mail-----------------------------------------





}//end class
  ?>
