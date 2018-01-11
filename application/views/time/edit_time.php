<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Edit Session Details</h4>
                  </div>
                  <?php foreach($res as $row){}  ?>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>time/update_session" class="form-horizontal" enctype="multipart/form-data" name="timeform" id="timeform">
                        <input type="hidden" name="tid" class="form-control" value="<?php echo $row->id; ?>">
                          <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Session Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="session_name" value="<?php echo $row->session_name; ?>" class="form-control"  >
                              </div>
                              <label class="col-sm-2 control-label">From Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="from_time" value="<?php echo $row->from_time; ?>" id="str_time" class="form-control"/>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">To Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="to_time" value="<?php echo $row->to_time; ?>" id="end_time" class="form-control"  />
                              </div>

                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">DeActive</option>
                                 </select>
                              <script language="javascript">document.timeform.status.value="<?php echo $row->status; ?>";</script>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Update">
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $().ready(function(){

     $('#str_time').timepicki();
      $('#end_time').timepicki();
   $('#timeform').validate({ // initialize the plugin
       rules: {
           session_name:{required:true },
           from_time:{required:true },
           to_time:{required:true }
       },
       messages: {
             session_name:"Enter Session Name",
            from_time:" Enter Start Time",
             to_time:" Enter End Time"
           }
   });

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

   $('#mastersmenu').addClass('collapse in');
   $('#master').addClass('active');
   $('#masters2').addClass('active');
</script>
