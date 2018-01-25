<div class="main-panel">
   <div class="content">
      <?php if($this->session->flashdata('msg')): ?>
      <div class="alert alert-success">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
         ×</button> <?php echo $this->session->flashdata('msg'); ?>
      </div>
      <?php endif; ?>

         <div class="container-fluid">

                  <div class="card">
                     <div class="">
                        <legend>List of Trade Materials </legend>
                        <div class="">
                           <table id="example" class="table">
                              <thead>
                                 <th data-field="id" class="text-center">S No</th>
                                 <th data-field="year" data-sortable="true">Trade & Title</th>
                                 <th data-field="no"  data-sortable="true">Trade File and Video</th>
                                 <th data-field="status"  data-sortable="true">Status</th>
                                 <th data-field="Section"  data-sortable="true">Action</th>
                              </thead>
                              <tbody>
                                 <?php
                                    $i=1;
                                    foreach ($result as $rows) {

                                    ?>
                                 <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $rows->trade_name; ?>(<?php echo $rows->trade_title; ?>)</td>
                                    <td><?php if(empty($rows->trade_file)){
                                       }else{ ?>
                                       <a href="<?php echo base_url(); ?>assets/tradematerial/<?php echo $rows->trade_file; ?>" target="_blank">Click here to view </a><br>
                                       <?php  } ?>
                                       <?php if(empty($rows->trade_video)){
                                          }else{ ?>
                                       <a href="https://www.youtube.com/watch?v=<?php echo $rows->trade_video; ?>" target="_blank">Click here to Watch Video </a><br>
                                       <?php  } ?>
                                    </td>
                                    <td><?php echo $rows->status; ?></td>
                                    <td>
                                       <a href="<?php echo base_url(); ?>stafftradematerial/edit/<?php echo base64_encode($rows->id); ?>" rel="tooltip" title="edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                                       <a href="<?php echo base_url(); ?>stafftradematerial/gallery/<?php echo base64_encode($rows->id); ?>" rel="tooltip" title="view gallery" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
                                    </td>
                                 </tr>
                                 <?php  $i++;  }  ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                     <!-- end content-->
                  </div>
                  <!--  end card  -->

            <!-- end row -->
         </div>

   </div>
</div>
<script type="text/javascript">
   $('#tradematerialmenu').addClass('collapse in');
   $('#tradematerial').addClass('active');
   $('#trade2').addClass('active');

   var $table = $('#example');
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
   $(function () {
   $('[data-toggle="tooltip"]').tooltip()
   })
</script>
