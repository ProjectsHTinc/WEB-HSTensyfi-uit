<?php

Class Examinationresultmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }
  
  
  function get_teacher_id($user_id)
		 {
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $sql="SELECT * FROM edu_examination";
			 $resultset1=$this->db->query($sql);
			 $res=$resultset1->result();
             return $res;
         // print_r($sec_n);exit
        //print_r($data);exit;
       }
	   
	   
	   function getall_cls_sec($user_id)
	   {
		  
			$query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			 foreach($row as $rows){}
			 $teacher_id=$rows->teacher_id;
			 $get_classes="SELECT class_name FROM edu_teachers WHERE teacher_id='$teacher_id'";
			 $resultset1=$this->db->query($get_classes);
			 $teacher_row=$resultset1->result();
			  foreach($teacher_row as $teacher_rows){}
			$teach_id=$teacher_rows->class_name;
			
			$sQuery = "SELECT c.class_name,s.sec_name,cm.class_sec_id,cm.class FROM edu_class AS c,edu_sections AS s ,edu_classmaster AS cm WHERE cm.class = c.class_id AND cm.section = s.sec_id ORDER BY c.class_name";
			$objRs=$this->db->query($sQuery);
			$row=$objRs->result();
			foreach ($row as $rows1)
			{
			$s= $rows1->class_sec_id;
			$sec=$rows1->class;
			$clas=$rows1->class_name;
			$sec_name=$rows1->sec_name;
			$arryPlatform = explode(",", $teach_id);
		    $sPlatform_id  = trim($s);
		    $sPlatform_name  = trim($sec);
			if(in_array($sPlatform_id, $arryPlatform ))
			   {
				 $class_id[]=$s;
				 $class_name[]=$clas;
				 $sec_n[]=$sec_name;
 			   }
 			 }
      // print_r($sec_n);exit
      if(empty($class_id)){
        $data= array("status" =>"No Record Found");
        return $data;
      }else{

        $data= array("class_id" => $class_id,"class_name"=>$class_name,"sec_name"=>$sec_n,"status"=>"Record Found");
        return $data;
      }
        //print_r($data);exit;


       }
	   
	   function getall_exam_details($exam_id)
	   {
		   $sql="SELECT * FROM edu_exam_details WHERE exam_id='$exam_id' ";
		   $resultset1=$this->db->query($sql);
		   $res=$resultset1->result();
           return $res;
	   }
	   
	   function getall_cls_sec_stu($user_id,$cls_masid,$exam_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			//echo $teacher_id;exit;
			$sql="SELECT t.*,su.*,en.* FROM edu_subject AS su,edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND t.subject=su.subject_id AND en.class_id='$cls_masid'";
		    //$sql="SELECT * FROM edu_exam_details WHERE exam_id='$exam_id' AND teacher_id='$teacher_id' AND classmaster_id='$cls_masid'";
			$res=$this->db->query($sql);
			$rows=$res->result();
			return $rows;
			//------------------------
			
	   }
	  
	   public function getall_stuname($user_id,$cls_masid,$exam_id)
	   {
		    $query="SELECT teacher_id FROM edu_users WHERE user_id='$user_id'";
			$resultset=$this->db->query($query);
			$row=$resultset->result();
			foreach($row as $rows){}
			$teacher_id=$rows->teacher_id;
			//echo $teacher_id;exit;
		    /* $sql="SELECT ed.*,en.* FROM edu_exam_details AS ed,edu_enrollment AS en WHERE ed.exam_id='$exam_id' AND ed.teacher_id='$teacher_id' AND ed.classmaster_id='$cls_masid' AND ed.classmaster_id=en.class_id";
			$res=$this->db->query($sql);
			$rows=$res->result();  */
			//return $rows;
			
			$query="SELECT cm.class_sec_id,cm.subject,su.* FROM edu_classmaster AS cm,edu_subject AS su WHERE  cm.subject=su.subject_id AND cm.class_sec_id='$cls_masid'";
            $resultset=$this->db->query($query);
			$row=$resultset->result();
			  //print_r($row);exit;
			 if(empty($row))
			 {
				 $data= array("status" => "Subject Not Found");
				 return $data;
			 }
			  foreach($row as $rows)
			  { }
				        $id=$rows->subject;
						//echo $id;
					   // $id=$rows->subject;
					$sQuery="SELECT su.*,t.teacher_id,t.class_teacher,en.enroll_id,en.name,en.class_id FROM edu_subject AS su,edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND en.class_id='$cls_masid'";
					$objRs=$this->db->query($sQuery);
					$rows=$objRs->result();
					 // echo'<pre>';  print_r($rows);exit;
					   foreach ($rows as $rows1) 
					   {
						   $s= $rows1->subject_id;
						   $sec=$rows1->subject_name;

						   //echo $stu_name;exit;
						   $arryPlatform = explode(",",$id);
						   $sPlatform_id  = trim($s);
						   $sPlatform_name  = trim($sec);
						    //$enrid=explode(",",$enr_id);
						   // $sname=trim($stu_name);
						   
						   if(in_array($sPlatform_id,$arryPlatform))
							   {
								  $sub_name[]=$sec;
								  $sub_id[]=$s;
								  //$enrid[]=$enr_id;
								  //$stu_name1[]=$stu_name;
								 //$cls_id1[]=$cls_id;
							   }
						 //return $a;
	                   }
	    
		 $sql="SELECT t.teacher_id,t.class_teacher,en.enroll_id,en.name,en.class_id FROM edu_teachers AS t,edu_enrollment AS en WHERE t.teacher_id='$teacher_id' AND en.class_id='$cls_masid'";
		 $res=$this->db->query($sql);
		 $row=$res->result();
		 foreach($row as $row1)
		 {
			 $enr_id=$rows1->enroll_id;
			 $stu_name=$rows1->name;
			 $cls_id=$rows1->class_teacher;
			 
		 }
					$datas= array("status" =>"Success","subject_id"=>$sub_id,"subject_name"=>$sub_name,"enroll_id"=>$enr_id,"stuname"=>$stu_name,"clsid"=>$cls_id);
					return $datas;

	   }
	   
	   
} 