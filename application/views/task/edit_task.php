<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Edit Task Details</h4>
                  </div>
                  <?php foreach($res as $row){}  ?>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>task/update_task" class="form-horizontal" enctype="multipart/form-data" name="taskform" id="taskform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Users</label>
                              <div class="col-sm-4">
                                <select name="users_id"  class="selectpicker form-control" >
                                <?php foreach($users as $user){?>
                                   <option value="<?php echo $user->user_id; ?>"><?php echo $user->name; ?></option>
                                <?php } ?>
                              </select>
                              <script language="javascript">document.taskform.users_id.value="<?php echo $row->user_id; ?>";</script>
                              </div>
                              <label class="col-sm-2 control-label">Task Title</label>
                              <div class="col-sm-4">
                                 <input type="text" name="task_title" value="<?php echo $row->task_title;?>" class="form-control"  />
                                   <input type="hidden" name="task_id" value="<?php echo $row->id;?>" class="form-control"  />
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Task Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="task_date"  value="<?php $date=date_create($row->task_date);echo date_format($date,"d-m-Y");  ?>"  class="form-control datepicker"  />
                              </div>
                             <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">DeActive</option>
                                     <script language="javascript">document.taskform.status.value="<?php echo $row->status; ?>";</script>
                                 </select>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                <textarea name="description" rows="7" cols="6" class="form-control" ><?php echo $row->task_description;?></textarea>
                              
                              </div>  
                            
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
$('#taskform').validate({ // initialize the plugin
       rules: {
        users_id:{required:true },
        task_title:{required:true },
        description:{required:true },
        task_date:{required:true}
       },
       messages: {
        users_id:"select Users",
        task_title:"Enter Tsak Title ",
        description:" Enter Tsak Description ",
        task_date:"select Task Date",
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
   $('#masters1').addClass('active');
</script>

