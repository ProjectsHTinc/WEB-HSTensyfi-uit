<div class="main-panel">
   <div class="content">
      <div class="col-md-12">
         <div class="card">
            <div class="header">
               <legend>Add Events</legend>
            </div>
           
            <div class="content">
               <form method="post" action="<?php echo base_url(); ?>event/add" class="form-horizontal" enctype="multipart/form-data" id="eventform">
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Event Date</label>
                        <div class="col-sm-4">
                           <input type="text" name="event_date" class="form-control datepicker" placeholder="Event Date"/>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-4">
                           <input type="text" name="event_name" id="event_name" class="form-control">
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Event Details</label>
                        <div class="col-sm-4">
                           <textarea type="text" MaxLength="350" placeholder="MaxCharacters 350" name="event_details" class="form-control"></textarea>
                        </div>
                     </div>
                  </fieldset>
                   <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Trade & Batch </label>
                        <div class="col-sm-4">
                           <select name="trade_batch" class="selectpicker form-control" data-title="Select Trade & Batch" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($trade_batch as $rows) {  ?>
                              <option value="<?php echo $rows->id; ?>"><?php echo $rows->trade_name; ?>&nbsp; - &nbsp;<?php echo $rows->batch_name; ?></option>
                              <?php      } ?>
                           </select>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Event Status</label>
                        <div class="col-sm-4">
                           <select name="event_status" class="selectpicker form-control" data-title="Status" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
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
         <div class="row">
            <div class="col-md-12">
               <div class="card">
                 <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
               ×</button> <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
                  <div class="content">
                     <h4 class="title">List of Events</h4>
                     <div class="fresh-datatables">
                        <table id="bootstrap-table" class="table">
                           <thead>
                              <th data-field="id">ID</th>
                              <th data-field="year"  data-sortable="true">Event Name</th>
                              <th data-field="no"  data-sortable="true">Event Date</th>
                              <!-- <th data-field="name" class="text-center" data-sortable="true">Event -Details</th> -->
                              <th data-field="status"  data-sortable="true">Status</th>
                              <th data-field="Section" data-sortable="true">Action</th>
                           </thead>
                           <tbody>
                              <?php
                                 $i=1;
                                 foreach ($result as $rows) {
                                 ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td><?php echo $rows->event_name; ?></td>
                                 <td><?php echo $new_date = date('d-m-Y', strtotime($rows->event_date));  ?></td>
                                 <!-- <td><?php echo $rows->event_details; ?></td> -->
                                 <td><?php if($rows->status=='Active'){  ?>
                                    <button class="btn btn-success btn-fill btn-wd">Active</button>
                                    <?php  } else{  ?>
                                    <button class="btn btn-danger btn-fill btn-wd">De-Active</button>
                                    <?php    } ?>
                                 </td>
                                 <td>
                                    <a href="<?php echo base_url(); ?>event/edit/<?php echo $rows->id; ?>" rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
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
<script  type="text/javascript">
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

   $(document).ready(function () 
   {
     $('#eventmenu').addClass('collapse in');
     $('#event').addClass('active');
     $('#event2').addClass('active');
     $('#eventform').validate({ // initialize the plugin
        rules: {
            event_date:{required:true },
            event_details:{required:true },
            event_name:{required:true },
            event_status:{required:true }
        },
        messages: {
              event_details: "Enter Event Details",
              event_date: "Select Event Date",
              event_name: "Enter Event Name",
              event_status: "Select Status"
            }
    });
   });
   
</script>

