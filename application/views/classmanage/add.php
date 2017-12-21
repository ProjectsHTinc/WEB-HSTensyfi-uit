

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="col-md-8">
            <div class="card">
               <div class="header">Trade & Batch Management</div>
               <div class="content">
                  <br>
                  <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>classmanage/assign" enctype="multipart/form-data" id="myformclassmange">
                     <div class="form-group">
                        <label class="col-md-2 control-label">Trade</label>
                        <div class="col-md-8">
                           <select name="trade_name" class="selectpicker" data-title="Select Trade Name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($trade as $trd) {  ?>
                              <option value="<?php  echo $trd->id; ?>"><?php  echo $trd->trade_name; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-2 control-label">Batch</label>
                        <div class="col-md-8">
                           <select name="batch_name" class="selectpicker" data-title="Select Batch Name" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                              <?php foreach ($batch as $bat) {  ?>
                              <option value="<?php  echo $bat->id; ?>"><?php  echo $bat->batch_name; ?></option>
                              <?php } ?>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-8">
                           <select name="status"  class="selectpicker form-control">
                              <option value="Active">Active</option>
                              <option value="Deactive">De-Active</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-md-3"></label>
                        <div class="col-md-9">
                           <button type="submit" class="btn btn-fill btn-info">Save</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
            <!-- end card -->
         </div>
         <div class="col-md-6">
         </div>
         <div class="row">
            <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  ×</button><b> <?php echo $this->session->flashdata('msg'); ?></b>
               </div>
               <?php endif; ?>
               <div class="card">
                  <div class="toolbar">
                     <div class="header">List of Trade & Batch </div>
                  </div>
                  <table id="bootstrap-table" class="table">
                     <thead>
                        <th data-field="id" class="text-left">S.No</th>
                        <th data-field="trade" class="text-left" data-sortable="true">Trade</th>
                        <th data-field="batch" class="text-left" data-sortable="true">Batch</th>
                        <th data-field="status" class="text-left" data-sortable="true">status</th>
                        <th data-field="actions" class="td-actions text-left" data-events="operateEvents">Actions</th>
                     </thead>
                     <tbody>
                        <?php $i=1; foreach ($getall as $res) { 
                           $sta=$res->status; ?>
                        <tr>
                           <td><?php echo $i;  ?></td>
                           <td><?php echo $res->trade_name;  ?></td>
                           <td><?php echo $res->batch_name;  ?></td>
                           <td>
                              <?php
                                 if($sta=='Active'){?>
                              <button class="btn btn-success btn-fill btn-wd">Active</button>
                              <?php  }else{?>
                              <button class="btn btn-danger btn-fill btn-wd">De Active</button>
                              <?php } ?>
                           </td>
                           <td>
                              <a rel="tooltip" title="Edit" class="btn btn-simple btn-warning btn-icon table-action edit" href="<?php echo base_url(); ?>classmanage/editcs/<?php  echo $res->id; ?>">
                              <i class="fa fa-edit"></i></a>
                           </td>
                        </tr>
                        <?php $i++;  }  ?>
                     </tbody>
                  </table>
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
 $(document).ready(function () 
 {
    $('#mastersmenu').addClass('collapse in');
    $('#master').addClass('active');
    $('#masters5').addClass('active');
    $('#myformclassmange').validate({ // initialize the plugin
    rules: {
        trade_name:{required:true },
        batch_name:{required:true },
      },
    messages:{
        trade_name: "Select Trade Name",
        batch_name:"Select Batch Name"
      }
    });
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
                  pageSize: 10,
                  clickToSelect: false,
                  pageList: [10,25,50,100,150],
   
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
   
          $(document).on("click", ".open-AddBookDialog", function () {
               var eventId = $(this).data('id');
               $(".modal-body #class_master_id").val( eventId );
          });
   
</script>

