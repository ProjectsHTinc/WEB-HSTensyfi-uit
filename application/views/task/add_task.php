
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Add Task </h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>task/create_task" class="form-horizontal" enctype="multipart/form-data" name="taskform" id="taskform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Users</label>
                              <div class="col-sm-4">
                                <select name="users_id"  class="selectpicker form-control" data-title="Select Users">
                                <?php foreach($users as $user){?>
                                   <option value="<?php echo $user->user_id; ?>"><?php echo $user->name; ?></option>
                                <?php } ?>
                              </select>
                              </div>
                              <label class="col-sm-2 control-label">Task Title</label>
                              <div class="col-sm-4">
                                 <input type="text" name="task_title" class="form-control"  />
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Task Date</label>
                              <div class="col-sm-4">
                                 <input type="text" name="task_date"  class="form-control datepicker"  />
                              </div>
                             <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">DeActive</option>
                                 </select>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                           <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                <textarea name="description" rows="7" cols="6" class="form-control" ></textarea>
                              
                              </div>  
                            
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <input type="submit" id="save" class="btn btn-info btn-fill center"  value="Save">
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                  <div class="content">
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th>S.no</th>
                              <th>Users Name</th>
                              <th>Task Title</th>
                              <th>Description</th>
                              <th>Tassk Date</th>
                              <th>Status</th>
                              <th>Actions</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 if(!empty($result)){
                                 foreach ($result as $rows)
                                 { 
                                  $sta=$rows->status; ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $rows->name; ?></td>
                                 <td><?php echo $rows->task_title; ?></td>
                                 <td><?php echo $rows->task_description; ?></td>
                                 <td><?php echo $rows->task_date; ?></td>
                                 <td><?php
                                    if($sta=='Active'){?>
                                    <button class="btn btn-success btn-fill btn-wd">Active</button>
                                    <?php  }else{?>
                                    <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                                    <?php } ?>
                                 </td>
                                 <td>
                                    <a href="<?php echo base_url(); ?>task/edit_task/<?php echo $rows->id; ?>" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                 </td>
                              </tr>
                              <?php $i++;  }  }?>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <!-- end content-->
               </div>
               <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
         </div>
         <!-- end row -->
      </div>
   </div>
</div>
<script type="text/javascript">
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
   
   
   var $table = $('#bootstrap-table');
        $().ready(function(){
            $table.bootstrapTable({
                toolbar: ".toolbar",
                clickToSelect: true,
                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                searchAlign: 'left',
                pageSize: 8,
                clickToSelect: false,
                pageList: [8,10,25,50,100],
   
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..."
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
   
            //activate the tooltips after the data table is initialized
            $('[rel="tooltip"]').tooltip();
   
            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });
   
   
        });
</script>
<script type="text/javascript">
   $().ready(function(){
     $('#mastersmenu').addClass('collapse in');
     $('#task').addClass('active');
     $('#task').addClass('active');
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           task: "fa fa-clock-o",
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

