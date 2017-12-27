<?php
Class Taskmodel extends CI_Model
{
    public function __construct()
    {
      parent::__construct();
    }

    function getYear()
    {
      $sqlYear ="SELECT * FROM edu_academic_year WHERE NOW() >= from_month AND NOW() <= to_month AND status = 'Active'";
      $year_result = $this->db->query($sqlYear);
      $ress_year   = $year_result->result();
      if ($year_result->num_rows() == 1) {
       foreach ($year_result->result() as $rows) {
         $year_id = $rows->year_id;
         }
          return $year_id;
        }
    }

    function get_current_years()
  {
    $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
    $result1=$this->db->query($get_year);
    if($result1->num_rows()==0)
    {
      $data= array("status" => "no data Found");
      return $data;
    }else{
      $all_year= $result1->result();
      $data= array("status" => "success","all_years"=>$all_year);
      return $data;
    }

  }

  function get_mobilizer_name()
  {
    $query="SELECT u.user_id,u.name,u.user_type,u.user_master_id,u.status,mb.id,mb.role_type,mb.name FROM edu_users AS u, edu_staff_details AS mb WHERE  u.user_master_id=mb.id AND u.user_type='4' AND u.user_type=mb.role_type AND u.status='Active' ";
    $resultset=$this->db->query($query);
    return $resultset->result();
  }


  function getall_roles()
  {
    $sql1="SELECT * FROM edu_role";
    $resultset3=$this->db->query($sql1);
    $res2=$resultset3->result();
    return $res2;
  }

  function cmaster_type()
  {
    $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
    $result1=$this->db->query($get_year);
    $all_year= $result1->result();
    foreach($all_year as $cyear){}
    $current_year=$cyear->year_id;

    $query2="SELECT * FROM edu_circular_master WHERE academic_year_id='$current_year' AND status='Active' ";
    $res=$this->db->query($query2);
    $result3=$res->result();
    return $result3;
  }

  function get_circular_title_lists($ctype)
  {
    $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
    $result1=$this->db->query($get_year);
    $all_year= $result1->result();
    foreach($all_year as $cyear){}
    $current_year=$cyear->year_id;

    $query2="SELECT id,academic_year_id,circular_title,circular_type,circular_description,status FROM edu_circular_master WHERE circular_type='$ctype' AND academic_year_id='$current_year' AND status='Active'";
    $resultset1=$this->db->query($query2);
    if($resultset1->num_rows()==0)
    {
      $data= array("status" =>"nodata");
      return $data;
    }else{
      $res=$resultset1->result();
      $data=array("status"=>"success","res1"=>$res);
      return $data;
    }
  } 

  function get_circular_description_lists($ctitle)
  {
    $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
    $result1=$this->db->query($get_year);
    $all_year= $result1->result();
    foreach($all_year as $cyear){}
    $current_year=$cyear->year_id;

    $query5="SELECT id,academic_year_id,circular_title,circular_description,status FROM edu_circular_master WHERE circular_title='$ctitle' AND academic_year_id='$current_year'  AND status='Active'";
    $resultset3=$this->db->query($query5);
    if($resultset3->num_rows()==0)
    {
      $data= array("status" =>"nodata");
      return $data;
    }else{
      $res3=$resultset3->result();
      $data=array("status1"=>"success","res2"=>$res3);
      return $data;
    }
  }

  function circular_create($title,$notes,$circulardate,$musers_id,$status,$user_id)
  {   
    $master="SELECT id,circular_title,circular_description,status FROM edu_circular_master WHERE circular_title='$title' AND circular_description='$notes' AND status='Active'"; 
    $resultset=$this->db->query($master);
    $res=$resultset->result();
    foreach($res as $rows){}
    $cm=$rows->id;
    //-----------------------------MOBILE USER----------------------
    if($musers_id!='')
    {
      $countid=count($musers_id);
      //echo $countid; exit;
      for ($i=0;$i<$countid;$i++)
      {
      $mobileuserid=$musers_id[$i];
      $cirmat=$cm;
      $status1=$status;
      $circulardate1=$circulardate;
      $user_id1=$user_id;

      $query3="INSERT INTO edu_circular(user_type,user_id,circular_master_id,circular_type,circular_date,status,created_by,created_at) VALUES ('4','$mobileuserid','$cirmat','Mail,Notification','$circulardate1','$status1','$user_id1',NOW())";
      $muser=$this->db->query($query3); 
      }
      if($muser)
      {
        $data=array("status" =>"success");
        return $data;
      }else{
        $data = array("status" => "Failed");
        return $data;
        }
    }
  }

  function get_all_circular()
  {
    $query123="SELECT c.id,c.user_type,c.user_id,c.circular_master_id,c.circular_date,c.circular_type,cm.*,u.user_id,u.name FROM edu_circular AS c,edu_users AS u,edu_circular_master AS cm WHERE c.user_type=4 AND  cm.id=c.circular_master_id AND c.user_id=u.user_id  ORDER BY c.id DESC ";
    $res112=$this->db->query($query123);
    $result123=$res112->result();
    return $result123;
  }

  function get_all_result()
  {
    $get_year="SELECT * FROM edu_academic_year WHERE NOW()>=from_month AND NOW()<=to_month";
    $result1=$this->db->query($get_year);
    $all_year= $result1->result();
    foreach($all_year as $cyear){}
    $current_year=$cyear->year_id;

    $query2="SELECT * FROM edu_circular_master WHERE academic_year_id='$current_year' ORDER BY id DESC";
    $res=$this->db->query($query2);
    $result3=$res->result();
    return $result3;
  }

  function edit_all_result($id)
  {
    $query2="SELECT * FROM edu_circular_master WHERE id='$id'";
    $res=$this->db->query($query2);
    $result3=$res->result();
    return $result3;
  }

  function create_circular_masters($year_id,$ctile,$cdescription,$status,$user_id)
  {
    $sql1="INSERT INTO edu_circular_master(academic_year_id,circular_title,circular_description,status, created_by,created_at) VALUES ('$year_id','$ctile','$cdescription','$status','$user_id',NOW())";
    $resultset=$this->db->query($sql1);
    if($resultset)
    {
      $data = array("status" => "success");
      return $data;
    }else{
      $data = array("status" => "Failed");
      return $data;
    }
  }

  function update_circular_masters($cid,$year_id,$ctile,$cdescription,$status,$user_id)
  {
    $sql2="UPDATE edu_circular_master SET circular_title='$ctile',circular_description='$cdescription',status='$status',updated_by='$user_id',updated_at=NOW() WHERE id='$cid'";
    $resultset1=$this->db->query($sql2);
    if($resultset1){
    $data = array("status" => "success");
    return $data;}else{$data = array("status" => "Failed");
    return $data;}
  }

  function get_all_mobilizer_task()
  {
   $query2="SELECT t.*,u.user_id,u.name,u.user_type,u.user_master_id FROM edu_task AS t,edu_users AS u WHERE t.user_id=u.user_id GROUP BY t.user_id";
    $res=$this->db->query($query2);
    $result3=$res->result();
    return $result3;
  }

  function get_all_mobilizer_detailstask($mobilizer_id)
  {
     $query1="SELECT t.*,u.user_id,u.name,u.user_type FROM edu_task AS t  LEFT JOIN edu_users AS u ON u.user_id IN(t.user_id)   WHERE t.user_id IN('$mobilizer_id') ";
    $res1=$this->db->query($query1);
    $result1=$res1->result();
    return $result1;
  }
  function view_all_photos($mobilizer_id,$taskid)
  {
   $query1="SELECT tp.task_id,tp.user_id,tp.task_image,u.user_id,u.name,u.user_type FROM edu_task_photos AS tp LEFT JOIN edu_users AS u ON u.user_id=tp.user_id WHERE tp.user_id IN('$mobilizer_id') AND tp.task_id IN('$taskid')";
    $res1=$this->db->query($query1);
    $result1=$res1->result();
    return $result1;
  }
}
?>
