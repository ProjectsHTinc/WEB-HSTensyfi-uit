<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Student Registration</legend>
            </div>
            <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
            <?php foreach ($res as $rows) { } ?>
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>enrollment/create" class="form-horizontal" enctype="multipart/form-data" id="admissionform">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Academic Year</label>
                        <div class="col-sm-4">
                           <?php  $status=$years['status']; if($status=="success"){
                              foreach($years['all_years'] as $row){}
                                ?>
                           <input type="hidden" name="year_id"  value="<?php  echo $row->year_id; ?>">
                           <input type="text" name="year_name"  class="form-control" value="<?php echo date('Y', strtotime($row->from_month));  echo "-"; echo date('Y', strtotime( $row->to_month));  ?>" readonly="">
                           <?php   }else{  ?>
                           <input type="text" name="year_id"  class="form-control" value="" readonly="">
                           <?php     } ?>
                            <input type="hidden" readonly class="form-control" value="<?php echo $rows->id; ?>" name="admission_id" id="admission_id">
                        </div>
                     </div>
                  </fieldset>
                  
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Student Name</label>
                        <div class="col-sm-4">
                           <input type="text" value="<?php echo $rows->name; ?>" name="name" readonly class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Registration Date</label>
                        <div class="col-sm-4">
                           <input type="text"  name="admit_date" class="form-control datepicker" placeholder="Registration Date"/>
                        </div>
                     </div>
                  </fieldset>
                  
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Trade & Batch </label>
                        <div class="col-sm-4">
                           <select name="trade_batch" class="selectpicker form-control" data-title="Select Trade & Batch" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($getall as $rows) {  ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->trade_name; ?>&nbsp; - &nbsp;<?php echo $rows->batch_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                 
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-4">
                           <select name="status" class="selectpicker form-control"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <option value="Active">Active</option>
                              <option value="Deactive">DeActive</option>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <div class="col-sm-10">
                           <button type="submit" class="btn btn-info btn-fill center">Save</button>
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
   $(document).ready(function () {
   
    $('#admissionform').validate({ // initialize the plugin
        rules: {
          year_id:{required:true},
          year_name:{required:true},
          admit_year:{required:true, number: true },
          admit_date:{required:true },
          name:{required:true },
          trade_batch:{required:true },
          status:{required:true }
   
        },
        messages: {
         year_id:"Academic Year not enable",
         year_name:"Academic Year not enable",
         admit_year: "Enter Admission Year",
         admit_date: "Select Admission Date",
         name: "Enter Name",
         admit_date: "Select The Date",
         trade_batch:"Select Trade & Batch",
         status: "Select Status"
            }
    });
  
   
   jQuery('#enrollmentmenu').addClass('collapse in');
   $('#enroll').addClass('active');
   $('#enroll1').addClass('active');
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
</script>

