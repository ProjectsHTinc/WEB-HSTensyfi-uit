<script src="<?php echo base_url(); ?>assets/js/timepicki.js"></script>
<link href="<?php echo base_url(); ?>assets/css/timepicki.css" rel="stylesheet" type="text/css">
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Add Timing </h4>
                  </div>
                  <div class="content">
                     <form method="post" action="<?php echo base_url(); ?>time/create_session" class="form-horizontal" enctype="multipart/form-data" name="timeform" id="timeform">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Session Name</label>
                              <div class="col-sm-4">
                                 <input type="text" name="session_name"  class="form-control"  >
                              </div>
                              <label class="col-sm-2 control-label">From Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="from_time" id="str_time" class="form-control"  />
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">To Time</label>
                              <div class="col-sm-4">
                                 <input type="text" name="to_time" id="end_time" class="form-control"  />
                              </div>

                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">De-Active</option>
                                 </select>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset>
                           <div class="form-group">
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
                              <th>Session Name</th>
                              <th>From Time</th>
                              <th>To Time</th>
                              <th>Status</th>
                              <th>Actions</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows)
                                 { 
                                  $sta=$rows->status; ?>
                              <tr>
                                 <td><?php  echo $i; ?></td>
                                 <td><?php  echo $rows->session_name; ?></td>
                                 <td><?php echo $rows->from_time; ?></td>
                                  <td><?php echo $rows->to_time; ?></td>
                                 <td><?php
                                    if($sta=='Active'){?>
                                    <button class="btn btn-success btn-fill btn-wd">Active</button>
                                    <?php  }else{?>
                                    <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                                    <?php } ?>
                                 </td>
                                 <td>
                                    <a href="<?php echo base_url(); ?>time/edit_session/<?php echo $rows->id; ?>" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                 </td>
                              </tr>
                              <?php $i++;  }  ?>
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
     $('#master').addClass('active');
     $('#masters1').addClass('active');
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

