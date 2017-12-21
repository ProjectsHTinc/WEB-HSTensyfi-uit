
<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Edit Admission Detail</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php foreach ($res as $rows) { $cer=$rows->transfer_certificate; } ?>
            <div class="content">
            <form method="post" action="<?php echo base_url(); ?>admission/save_ad" class="form-horizontal" enctype="multipart/form-data" id="admissionform"  name="admissionform">
                <fieldset>
                 
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Had Aadhar Card</label>
                        <div class="col-sm-4">
                            <input type="hidden" class="form-control" name="admission_id" value="<?php echo $rows->id; ?>" readonly>
                           <select name="had_aadhar_card" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                      <script language="JavaScript">document.admissionform.had_aadhar_card.value="<?php echo $rows->have_aadhaar_card; ?>";</script>
                        </div>
                        <label class="col-sm-2 control-label">Aadhar Card Number</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Enter Aadhar Card Number" name="aadhar_card_num" class="form-control" value="<?php echo $rows->aadhaar_card_number;?>">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Admission Date</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_date" class="form-control datepicker" placeholder="Admission Date" value="<?php $date=date_create($rows->admission_date);echo date_format($date,"d-m-Y");  ?>" />
                        </div>
                        <label class="col-sm-2 control-label">Admission Location</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_location" class="form-control" placeholder="Enter Admission Location" value="<?php echo $rows->admission_location;?>"/>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" value="<?php echo $rows->name;?>" placeholder="Enter Name">
                        </div>
                         <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                           <select name="sex" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                         <script language="JavaScript">document.admissionform.sex.value="<?php echo $rows->sex; ?>";</script>  
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Father Name</label>
                        <div class="col-sm-4">
                         <input type="text" name="fname" value="<?php echo $rows->father_name;?>" class="form-control" placeholder="Enter Father Name">
                        </div>
                        <label class="col-sm-2 control-label">Mother Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="mname" value="<?php echo $rows->mother_name;?>" class="form-control"  placeholder="Enter  Mother Name" />
                        </div>
                     </div>
                  </fieldset>
                 
                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Disability</label>
                        <div class="col-sm-4">
                           <select name="disability" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                           <script language="JavaScript">document.admissionform.disability.value="<?php echo $rows->disability; ?>";</script> 
                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email"  class="form-control"  onkeyup="checkemailfun(this.value)" id="email" placeholder="Email Address" value="<?php echo $rows->email;?>" />
                           <p id="msg" style="color:red;"></p>
                           <p id="msg1" style="color:green;"></p>
                        </div>
                        
                     </div>
                  </fieldset>
                  
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of birth</label>
                        <div class="col-sm-4">
                           <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php $date=date_create($rows->dob);echo date_format($date,"d-m-Y");  ?>" />
                        </div>
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" value="<?php echo $rows->age;?>" class="form-control">
                        </div>
                     </div>
                  </fieldset>

                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <textarea name="address" rows="5" cols="43"><?php echo $rows->address;?></textarea>
                        </div>
                        <label class="col-sm-2 control-label">preferred_timing</label>
                        <div class="col-sm-4">
                            <input  type="text" class="form-control" value="<?php echo $rows->preferred_timing;?>" id="stime" name="prefer_time">
                        </div>
                     </div>
                  </fieldset>

                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" value="<?php echo $rows->mobile;?>" name="mobile" class="form-control" onblur="checkmobilefun(this.value)">
                           <p id="cellmsg1"></p>
                        </div>
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Secondary Mobile Number" value="<?php echo $rows->sec_mobile;?>" name="sec_mobile" class="form-control">
                        </div>
                     </div>
                  </fieldset>


                   
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Student Picture</label>
                        <div class="col-sm-4">
                           <input type="file" name="student_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                        <label class="col-sm-2 control-label">Blood Group</label>
                        <div class="col-sm-4">
                           <select name="blood_group" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($blood as $res){ ?>
                              <option value="<?php echo $res->id;?>"><?php echo $res->blood_group_name;?></option>
                              <?php } ?>
                           </select>
                            <script language="JavaScript">document.admissionform.blood_group.value="<?php echo $rows->blood_group; ?>";</script> 
                        </div>
                     </div>
                  </fieldset>
                  
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-4">
                           <input type="text" value="<?php echo $rows->city; ?>" name="city" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Enter State Name"  value="<?php echo $rows->state;?>" name="state" class="form-control">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" value="<?php echo $rows->nationality;?>" name="nationality" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-4">
                           <input type="text" value="<?php echo $rows->religion;?>" placeholder="Religion" name="religion" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Community Class</label>
                        <div class="col-sm-4">
                          <select name="community_class" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <option value="SC">Scheduled Castes-SC</option>
                            <option value="ST">Scheduled Tribes-ST</option>
                            <option value="MBC">Most Backward Classes-MBC</option>
                            <option value="BC">Backward Classes-BC</option>
                            <option value="BCM">Backward Classes Muslims-BCM</option>
                            <option value="DC">Denotified Communities-DC</option>
                            <option value="FC">Forward Class-FC</option>
                          </select>
                           <script language="JavaScript">document.admissionform.community_class.value="<?php echo $rows->community_class; ?>";</script> 
                        </div>
                        <label class="col-sm-2 control-label">Community</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community" value="<?php echo $rows->community;?>" name="community" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mother Tongue</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mother Tongue" value="<?php echo $rows->mother_tongue;?>" name="mother_tongue" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Preferred Course</label>
                        <div class="col-sm-4">
                           <select name="course" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($lang as $res){ ?>
                              <option value="<?php echo $res->id;?>"><?php echo $res->trade_name;?></option>
                              <?php } ?>
                           </select>
                            <script language="JavaScript">document.admissionform.course.value="<?php echo $rows->preferred_trade; ?>";</script> 
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label"> Institute Details</label>
                        <div class="col-sm-10">
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="text" name="institute_name" value="<?php echo $rows->last_institute;?>" placeholder="Previous Institute Name" class="form-control">
                              </div>
                              <div class="col-md-4">
                                 <input type="text" name="last_studied" value="<?php echo $rows->last_studied;?>" placeholder="Past Out From" class="form-control">
                              </div>
                              <div class="col-md-4">
                                 <select name="qual" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="pass">Pass</option>
                                    <option value="fail">Fail</option>
                                    <option value="drop">Drop Out</option>
                                 </select>
                                  <script language="JavaScript">document.admissionform.qual.value="<?php echo $rows->qualified_promotion; ?>";</script> 
                              </div>
                           </div>
                        </div>
                     </div>
                  </fieldset>

                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Certificates</label>
                        <div class="col-sm-4">
                           <label class="checkbox checkbox-inline">
                              <?php if($cer=='1'){ ?>
                  <input type="checkbox" data-toggle="checkbox" checked="checked" name="trn_cert" value="1">
                             <?php }else{ ?>
                        <input type="checkbox" data-toggle="checkbox" name="trn_cert" value="1">
                             <?php } ?>
                          Transfer Certificate
                           </label>
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                           <script language="JavaScript">document.admissionform.status.value="<?php echo $rows->status; ?>";</script> 
                        </div>
                     </div>
                  </fieldset>
                 
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                        <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                        </div>
                        <label class="col-sm-2 control-label">Current Pic</label>
                        <div class="col-sm-2">
                           <input type="hidden" name="user_pic_old" class="form-control" value="<?php echo $rows->student_pic; ?>">
                           <?php $spic=$rows->student_pic;
                              if(empty($spic)){?>
                           <img src="<?php echo base_url(); ?>assets/noimg.png" class="img-circle" style="width:110px;">
                           <?php }else{?>
                           <img src="<?php echo base_url(); ?>assets/students/<?php echo $rows->student_pic; ?>" class="img-circle" style="width:110px;">
                           <?php }?>
                        </div>

                        <div class="col-sm-2">
                           <img  id="output" class="img-circle" style="width:100px;">
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#stime').timepicki();
   var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
   };
   
   $(document).ready(function () {
   jQuery('#admissionmenu').addClass('collapse in');
   $('#admission').addClass('active');
   $('#admission2').addClass('active');

     $('#admissionform').validate({ // initialize the plugin
      rules: {
        had_aadhar_card:{required:true },
        aadhar_card_num:{required:true },
        admission_location:{required:true },
        admission_date:{required:true },
        name:{required:true },
        fname:{required:true},
        mname:{required:true},
        sex:{required:true },
        dob:{required:true },
        email:{required:true },
        disability:{required:true },
        age:{required:true,number:true,maxlength:2 },
        nationality:{required:true },
        religion:{required:true },
        community_class:{required:true },
        community:{required:true },
        blood_group:{required:true },
        address:{required:true },
        city:{required:true },
        state:{required:true },
        course:{required:true },
        mother_tongue:{required:true},
        prefer_time:{required:true},
        mobile:{required:true}
        },
    messages: {
        had_aadhar_card: "Select Yes Or No ",
        aadhar_card_num:"Enter The Aadhar Card Number",
        admission_location: "Enter Admission Location",
        admission_date: "Select Admission Date",
        name: "Enter Full Name",
        fname: "Enter Father Name",
        mname:"Enter Mother Name",
        sex: "Select Gender",
        address:"Enter The Address",
        dob: "Select Date of Birth",
        email:"Enter Email Id",
        disability:"Select Disability",
        age: "Enter AGE",
        nationality: "Nationality",
        religion: "Enter the Religion",
        community:"Enter the Community",
        community_class:"Enter the Community Class",
        blood_group:"Select Blood Group",
        prefer_time:"Select Preferred Time",
        city:"Enter City Name",
        state:"Enter State Name",
        course:"Select Course",
        mother_tongue:"Enter Mother Tongue",
        mobile:"Enter The Mobile Number"
    }
    }); 
   });
   
function checkmobilefun(val)
   { //alert('hi');exit;
      $.ajax({
   type:'post',
   url:'<?php echo base_url(); ?>/admission/cellchecker',
   data:'cell='+val,
   success:function(test)
   {
    //alert(test)
    if(test=="Mobile Number Available")
    {
    $("#cellmsg1").html('<span style="color:green;">Mobile Number Available</span>');
    $("#save").show();
    }
    else{
      $("#cellmsg1").html('<span style="color:red;">Mobile number already Exist</span>');
        $("#save").hide();
  }
   }
   });
   }
     
   $().ready(function(){
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
  
   });

   function checkemailfun(val)
   {
     $.ajax({
     type:'post',
     url:'<?php echo base_url(); ?>/admission/checker',
     data:'email='+val,
     success:function(test)
     {
      if(test=="Email Id already Exit")
      {
        $("#msg").html(test);
        $("#msg1").html(test).hide();
        $("#save").hide();
      }else{
        $("#msg1").html(test);
        $("#msg").html(test).hide();
        $("#save").show();
       }
     }
       });
   }
   
</script>

