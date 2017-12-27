<div class="main-panel">
    <div class="content">
        <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <legend>Create Staff</legend>
                </div>
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                    <?php endif; ?>
                        <div class="content">
                            <form method="post" action="<?php echo base_url(); ?>staff/create" class="form-horizontal" enctype="multipart/form-data" id="staffform">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Role</label>
                                        <div class="col-sm-4">
                                            <select name="select_role" id="select_role" class="selectpicker form-control" data-title="Select Role" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <?php foreach($get_all_active_role as $rows){ ?>
                                                    <option value="<?php echo $rows->id; ?>">
                                                        <?php echo $rows->user_type_name; ?>
                                                    </option>
                                                    <?php  } ?>

                                            </select>
                                          </div>
                                          <div class="" id="trade_tutor">
                                            <label class="col-sm-2 control-label">Class Tutor</label>
                                            <div class="col-sm-4">
                                                <select name="class_tutor" id="class_tutor" data-title="Select Class" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue">
                                                    <?php foreach ($get_non_exist_class_for_trainer as $row) {  ?>
                                                        <option value="<?php echo $rows->id; ?>">
                                                            <?php echo $row->trade_name; ?>&nbsp; - &nbsp;
                                                                <?php echo $row->batch_name; ?>
                                                        </option>
                                                        <?php      } ?>
                                                </select>
                                            </div>
                                          </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" class="form-control" value="">
                                        </div>
                                        <label class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="email" class="form-control" placeholder="Email Address" />
                                            <p id="msg" style="color:red;"> </p>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label">Mobile</label>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="Mobile Number" name="mobile" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Secondary Mobile</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="sec_phone" class="form-control" placeholder="Mobile Number" />
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
                                        <label class="col-sm-2 control-label">Date of birth</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="Date of Birth " />
                                        </div>
                                        <label class="col-sm-2 control-label">Nationality</label>
                                        <div class="col-sm-4">
                                            <select name="nationality" class="selectpicker form-control" data-title="Select Gender" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Indian">Indian</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <!-- <label class="col-sm-2 control-label">Age</label>
                        <div class="col-sm-4">
                           <input type="text" placeholder="Age" name="age" id="age" class="form-control">
                        </div> -->
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
                                            <input type="text" placeholder="Community Class" name="community_class" class="form-control">
                                        </div>
                                        <label class="col-sm-2 control-label">Community</label>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="Community" name="community" class="form-control">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-4">
                                            <textarea name="address" MaxLength="150" class="form-control" rows="4" cols="80" placeholder="Max Characters 150"></textarea>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Qualification</label>
                                        <div class="col-sm-4">
                                            <input type="text" placeholder="Qualification" name="qualification" class="form-control">
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">

                                </fieldset>
                                <fieldset>
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label">Teacher Picture</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="staff_pic" class="form-control" onchange="loadFile(event)" accept="image/*">
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">

                                        <label class="col-sm-2 control-label">Status</label>
                                        <div class="col-sm-4">
                                            <select name="status" class="selectpicker form-control" data-title="Select Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                                <option value="Active">Active</option>
                                                <option value="Deactive">DeActive</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                        <div class="col-sm-4">
                                            <img id="output" class="img-circle" style="width:200px;">
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>

                                    <label class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-4">
                                        <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                    </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group"></div>
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

        $(document).ready(function() {

            //$("textarea").MaxLength({ MaxLength:10})

            $('#staffform').validate({ // initialize the plugin
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
                               url: "<?php echo base_url(); ?>staff/checkemail",
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
                               url: "<?php echo base_url(); ?>staff/checkmobile",
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



        $().ready(function() {
            $('#teachermenu').addClass('collapse in');

            $('#teacher').addClass('active');
            $('#teacher1').addClass('active');

            $('#select_role').on('change', function() {
              $("#trade_tutor").css('display', (this.value == '3') ? 'block' : 'none');
           });
             $("#trade_tutor").hide();
            $('.datepicker').datetimepicker({
                format: 'YYYY-MM-DD',
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
    </script>
