<style>
  .trheight{
  height: 50px;
  }
</style>
<div class="main-panel">
<div class="content">
  <?php if($this->session->flashdata('msg')): ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
    ×</button> <?php echo $this->session->flashdata('msg'); ?>
  </div>
  <?php endif; ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="content">
              <h4 class="title">View All Task Details</h4>
             
              <!-- Parents-->
             
                <div id="company" class="tab-pane active">
                  <div class="fresh-datatables">
                    <table id="bootstrap-table" class="table">
                      <thead>
                        <th class="text-left">S.No</th>
                        <!--th class="text-left" data-sortable="true">Mobile User Name</th-->
                        <th class="text-left" data-sortable="true">Task Title</th>
                        <th class="text-left" data-sortable="true">Task Description</th>
                        <th class="text-left" data-sortable="true">Task Date</th>
                        <th class="text-left" data-sortable="true">Task Image</th>
                      </thead>
                      <tbody>
                        <?php
                          $i=1;
                          foreach ($viewall_task as $rows1) {
                          $type=$rows1->user_type;
                          ?>
                        <tr class="trheight">
                          <td class="text-left"><?php echo $i; ?></td>
                          <!--td class="text-left"><?php echo $rows1->name; ?></td-->
                          <td class="text-left"><?php echo $rows1->task_title;?></td>
                          <td class="text-left"><?php echo $rows1->task_description;?></td>
                          <td class="text-left"><?php $date=date_create($rows1->task_date);
                            echo date_format($date,"d-m-Y");
                            ?></td>
                             <td class="text-left"><?php echo $rows1->task_image;?></td>
                        
                        </tr>
                        <?php $i++;  }   ?>
                      </tbody>
                    </table>
                  </div>
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
</div>
<script type="text/javascript">
  $('#communcicationmenu').addClass('collapse in');
  $('#communication').addClass('active');
  $('#communication3').addClass('active');
  
  var $table = $('#bootstrap-table');
  $(document).ready(function()
  {
  $table.bootstrapTable({
  toolbar: ".toolbar",
  clickToSelect: true,
  showRefresh: true,
  search: true,
  showToggle: true,
  showColumns: true,
  pagination: true,
  searchAlign: 'left',
  pageSize:10,
  clickToSelect: false,
  pageList: [10,25,50,100,200],
  
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

