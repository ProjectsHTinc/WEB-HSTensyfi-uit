<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Update Staff Details</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php foreach ($result as $rows) { } ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>staff/update_staff_details" class="form-horizontal" enctype="multipart/form-data" id="update_staff_details" name="update_staff_details">
                 <fieldset>
                   <div class="form-group">
                     <label class="col-sm-2 control-label">Role</label>
                     <div class="col-sm-4">
                         <select name="select_role" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                             <?php foreach($get_all_active_role as $role_id){ ?>
                                 <option value="<?php echo $role_id->id; ?>">
                                     <?php echo $role_id->user_type_name; ?>
                                 </option>
                                 <?php  } ?>

                         </select>
                         <script language="JavaScript">document.update_staff_details.select_role.value="<?php echo $rows->role_type; ?>";</script>

                     </div>
                     <?php if($rows->role_type=='3'){ ?>
                       <div class="" id="trade_tutor">
                         <label class="col-sm-2 control-label">Class Tutor</label>
                         <div class="col-sm-4">
                             <select name="class_tutor" id="class_tutor"  class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue">
                                 <option value="0">None</option>
                               <?php foreach ($get_non_exist_class_for_trainer as $row) {  ?>
                                   <option value="<?php echo $rows->trade_batch_id; ?>">
                                       <?php echo $row->trade_name; ?>&nbsp; - &nbsp;
                                           <?php echo $row->batch_name; ?>
                                   </option>
                                   <?php      } ?>
                             </select>
                             <script language="JavaScript">document.update_staff_details.class_tutor.value="<?php echo $rows->trade_batch_id; ?>";</script>

                         </div>
                       </div>
                  <?php   }else{

                     } ?>

                   </div>

                 </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="name" class="form-control" value="<?php echo $rows->name; ?>">
                           <input type="hidden" placeholder="staff_id" name="staff_id" class="form-control" value="<?php echo $staff; ?>">
                        </div>
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="email" required  class="form-control" id="email" value="<?php echo $rows->email; ?>"/>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Gender</label>
                        <div class="col-sm-4">
                           <select name="sex" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Male">Male</option>
                              <option value="Female">Female</option>
                           </select>
                           <script language="JavaScript">document.update_staff_details.sex.value="<?php echo $rows->sex; ?>";</script>
                        </div>
                        <label class="col-sm-2 control-label">Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Mobile Number" name="mobile" class="form-control" value="<?php echo $rows->phone; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Secondary Email</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_email" placeholder="Email Address" class="form-control" value="<?php echo $rows->sec_email;?>">
                        </div>
                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                        <div class="col-sm-4">
                           <input type="text" name="sec_phone" value="<?php echo $rows->sec_phone;?> " class="form-control" placeholder="Mobile Number" />
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Date of birth</label>
                        <div class="col-sm-4">
                           <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth " value="<?php echo $rows->dob; ?>"/>
                        </div>
                        <label class="col-sm-2 control-label">Nationality</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Nationality" name="nationality" class="form-control"  value="<?php echo $rows->nationality; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">

                        <label class="col-sm-2 control-label">Religion</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Religion" name="religion" class="form-control"  value="<?php echo $rows->religion; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Community Class</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community Class" name="community_class" class="form-control"  value="<?php echo $rows->community_class; ?>">
                        </div>
                        <label class="col-sm-2 control-label">Community</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Community" name="community" class="form-control" value="<?php echo $rows->community; ?>">
                           <input type="hidden" placeholder=" " name="old_pic" class="form-control" value="<?php echo $rows->profile_pic; ?>">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-4">
                           <textarea name="address" MaxLength="150" class="form-control" rows="4" cols="80" placeholder="Max Characters 150"><?php echo $rows->address; ?></textarea>
                        </div>
                        <label class="col-sm-2 control-label">Qualification</label>
                        <div class="col-sm-4">
                           <input type="text" value="<?php echo $rows->qualification; ?>" name="qualification" class="form-control">
                        </div>

                     </div>
                  </fieldset>


                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Current Pic</label>
                        <div class="col-sm-4">
                           <img src="<?php echo base_url(); ?>assets/staff/<?php echo $rows->profile_pic; ?>" class="img-circle" style="width:150px;">
                              <input type="hidden" value="<?php echo $rows->profile_pic; ?>" name="staff_old_pic" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Staff  Pic</label>
                        <div class="col-sm-4">
                           <input type="file" name="staff_new_pic" class="form-control" onchange="loadFile(event)" accept="image/*" >
                        </div>
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                           <script language="JavaScript">document.update_staff_details.status.value="<?php echo $rows->status; ?>";</script>
                        </div>
                     </div>

                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">


                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <img  id="output" class="img-circle" style="width:200px;">
                        </div>
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-4">
                           <button type="submit" class="btn btn-info btn-fill center">Update Profile</button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
         </div>
         <!-- end card -->
      </div>
   </div>



<script type="text/javascript">

   var loadFile = function(event) {
   var output = document.getElementById('output');
   output.src = URL.createObjectURL(event.target.files[0]);
   };


   $(document).ready(function () {
     $('#teachermenu').addClass('collapse in');
     $('#teacher').addClass('active');
     $('#teacher2').addClass('active');
     $('#update_staff_details').validate({ // initialize the plugin
         rules: {
           select_role: {
               required: true
           },
             name: {
                 required: true
             },
             address: {
                 required: true
             },
             email: {
                 required: true,
                 email: true,
                 remote: {
                        url: "<?php echo base_url(); ?>staff/checkemail_edit/<?php echo $staff; ?>",
                        type: "post"
                     }
             },
             sex: {
                 required: true
             },
             dob: {
                 required: true
             },
             nationality:{required:true},


             mobile: {
                 required: true,
                 remote: {
                        url: "<?php echo base_url(); ?>staff/checkmobile_edit",
                        type: "post"
                     }
             },
             //subject:{required:true },
             qualification: {
                 required: true
             },

             status: {
                 required: true
             }
         },
         messages: {
             select_role: "Select role",
             address: "Enter Address",
             admission_date: "Select Admission Date",
             name: "Enter Name",
             email: {
                  required: "Please enter your email address.",
                  email: "Please enter a valid email address.",
                  remote: "Email already in use!"
              },

             sex: "Select Gender",
             dob: "Select Date of Birth",
             age: "Enter AGE",
             nationality: "Select Nationality",
             //subject:"Choose The Subject",
             religion: "Enter the Religion",
             community: "Enter the Community",
             community_class: "Enter the Community Class",
             mother_tongue: "Enter The Mother tongue",
             qualification: "Enter the Qualification ",

             mobile: {
                  required: "Please enter your mobile number.",
                  remote: "mobile number already in use!"
              },
             //groups_id:"Select Groups Name",
             //'activity_id[]':"Select Activity Name",
             status: "Select Status Name"
         }
   });
   });

</script>
