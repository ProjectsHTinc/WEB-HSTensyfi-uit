<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">

<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Admission</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>admission/create" class="form-horizontal" enctype="multipart/form-data" id="admissionform">

                <fieldset>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Had Aadhar Card</label>
                        <div class="col-sm-4">
                           <select name="had_aadhar_card"  id="aadhar_card" class="selectpicker form-control" data-title="Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                        </div>
                        <div id="aadhar_card_num">
                        <label class="col-sm-2 control-label">Aadhar Card Number</label>
                        <div class="col-sm-4">
                            <label for="phonenum">Aadhar Card Number (format: xxxx-xxx-xxxx):</label><br/>
                           <input type="text" placeholder="Enter Aadhar Card Number" name="aadhar_card_num" pattern="^\d{4}-\d{4}-\d{4}$" class="form-control" >
                        </div>
                      </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Admission Date</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_date" class="form-control datepicker" placeholder="Admission Date "/>
                        </div>
                        <label class="col-sm-2 control-label">Admission Location</label>
                        <div class="col-sm-4">
                           <input type="text" name="admission_location" class="form-control" placeholder="Enter Admission Location"/>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" placeholder="Enter Name">
                        </div>
                         <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                           <select name="sex" class="selectpicker form-control" data-title="Select Gender" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Father Name</label>
                        <div class="col-sm-4">
                         <input type="text" name="fname" class="form-control" placeholder="Enter Father Name">
                        </div>
                        <label class="col-sm-2 control-label">Mother Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="mname" class="form-control "  placeholder="Enter  Mother Name" />
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                       <label class="col-sm-2 control-label">Disability</label>
                        <div class="col-sm-4">
                           <select name="disability" class="selectpicker form-control" data-title="Select" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email"  class="form-control"  onkeyup="checkemailfun(this.value)" id="email" placeholder="Email Address" />
                           <p id="msg" style="color:red;"></p>
                           <p id="msg1" style="color:green;"></p>
                        </div>

                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of birth</label>
                        <div class="col-sm-4">
                           <input type="text" name="dob" class="form-control datepicker" placeholder="Date of Birth "/>
                        </div>
                        <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" class="form-control">
                        </div>
                     </div>
                  </fieldset>

                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <textarea name="address" rows="5" cols="43"></textarea>
                        </div>
                        <label class="col-sm-2 control-label">preferred_timing</label>
                        <div class="col-sm-4">
                            <!--input  type="text" class="form-control" id="stime" name="prefer_time"-->
                            <select name="prefer_time" class="selectpicker" data-title="Select Preferred Time" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($time as $times){ ?>
                              <option value="<?php echo $times->id;?>"><?php echo $times->from_time;?> ( To ) <?php echo $times->to_time;?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>

                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" onblur="checkmobilefun(this.value)">
                           <p id="cellmsg1"></p>
                        </div>
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Secondary Mobile Number" name="sec_mobile" class="form-control">
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
                           <select name="blood_group" class="selectpicker" data-title="Select Blood Group" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($blood as $rows){ ?>
                              <option value="<?php echo $rows->id;?>"><?php echo $rows->blood_group_name;?></option>
                              <?php } ?>
                           </select>
                        </div>

                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">City</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Enter City Name" name="city" class="form-control" >
                           <p id="cellmsg1"></p>
                        </div>
                        <label class="col-sm-2 control-label">State</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Enter State Name" name="state" class="form-control">
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" name="nationality" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Religion" name="religion" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Community Class</label>
                        <div class="col-sm-4">
                          <select name="community_class" class="selectpicker" data-title="Community Class" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <option value="SC">Scheduled Castes-SC</option>
                            <option value="ST">Scheduled Tribes-ST</option>
                            <option value="MBC">Most Backward Classes-MBC</option>
                            <option value="BC">Backward Classes-BC</option>
                            <option value="BCM">Backward Classes Muslims-BCM</option>
                            <option value="DC">Denotified Communities-DC</option>
                            <option value="FC">Forward Class-FC</option>
                          </select>
                        </div>
                        <label class="col-sm-2 control-label">Community</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community" name="community" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Mother Tongue</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mother Tongue" name="mother_tongue" class="form-control">
                        </div>
                        <label class="col-sm-2 control-label">Preferred Course</label>
                        <div class="col-sm-4">
                           <select name="course" class="selectpicker" data-title="Preferred Course" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                            <?php foreach($lang as $res){ ?>
                              <option value="<?php echo $res->id;?>"><?php echo $res->trade_name;?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label"> Institute Details</label>
                        <div class="col-sm-10">
                           <div class="row">
                              <div class="col-md-4">
                                 <input type="text" name="institute_name" placeholder="Previous Institute Or School Name" class="form-control">
                              </div>
                              <div class="col-md-4">
                                 <input type="text" name="last_studied" placeholder="Class  Or Degree" class="form-control">
                              </div>
                              <div class="col-md-4">
                                 <select name="qual" class="selectpicker" data-title="Qualified for promotion" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                    <option value="pass">Pass</option>
                                    <option value="fail">Fail</option>
                                    <option value="drop">Drop Out</option>
                                 </select>
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
                           <input type="checkbox" data-toggle="checkbox" name="trn_cert" value="1">Transfer Certificate
                           </label>
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>

                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-2">
                           <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                        </div>
                        <div class="col-sm-4">
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

   $(document).ready(function ()
   {
   jQuery('#admissionmenu').addClass('collapse in');
   $('#admission').addClass('active');
   $('#admission1').addClass('active');

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


   $('#aadhar_card').on('change', function() {
     $("#aadhar_card_num").css('display', (this.value == '1') ? 'block' : 'none');
  });

</script>
