

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
         <legend>List of Trade Materials</legend>
         <div class="fresh-datatables">
            <table id="bootstrap-table" class="table">
               <thead>
                  <th data-field="id" class="text-center">S No</th>
                  <th data-field="year" data-sortable="true">Trade & Title</th>
                  <th data-field="no"  data-sortable="true">Trade File and Video</th>
                  <th data-field="createdby"  data-sortable="true">Created By</th>
                   <th data-field="createddate"  data-sortable="true">Created Date</th>
                  <th data-field="status"  data-sortable="true">Status</th>
                  <th data-field="Section"  data-sortable="true">Action</th>
               </thead>
               <tbody>
                  <?php
                     $i=1;
                     foreach ($result as $rows) { $type=$rows->user_type;  $stu=$rows->status; ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo $rows->trade_name; ?>(<?php echo $rows->trade_title; ?>)</td>
                     <td><?php if(empty($rows->trade_file)){
                        }else{ ?>
                        <a href="<?php echo base_url(); ?>assets/tradematerial/<?php echo $rows->trade_file; ?>" target="_blank">Click here to view </a><br>
                        <?php  } ?>
                        <?php if(empty($rows->trade_video)){
                           }else{ ?>
                        <a href="<?php echo $rows->trade_video; ?>" target="_blank">Click here to Watch Video </a><br>
                        <?php  } ?>
                     </td>
                    
                     <td><?php if($type==1 || $type==2 ){ echo "ADMIN"; }else{ echo "TRAINER";}?></td>
                     <td><?php echo $new_date = date('d-m-Y',strtotime($rows->created_at));?></td>
                       <td><?php
                           if($stu=='Active'){?>
                           <button class="btn btn-success btn-fill btn-wd">Active</button>
                           <?php  }else{?>
                           <button class="btn btn-danger btn-fill btn-wd">DeActive</button><?php }
                              ?>
                        </td>
                     <td>
                        <a href="<?php echo base_url(); ?>tradematerial/edit/<?php echo base64_encode($rows->id); ?>" rel="tooltip" title="edit" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url(); ?>tradematerial/gallery/<?php echo base64_encode($rows->id); ?>" rel="tooltip" title="view gallery" class="btn btn-simple btn-warning btn-icon edit"><i class="fa fa-picture-o" aria-hidden="true"></i></a>
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
</div>
<script type="text/javascript">
$('#tradematerialmenu').addClass('collapse in');
$('#tradematerial').addClass('active');
$('#trade2').addClass('active');
$('#bootstrap-table').DataTable({
dom: 'lBfrtip',
buttons: ['colvis'],
"pagingType": "full_numbers",
"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
responsive: true,
language: {
search: "_INPUT_",
searchPlaceholder: "Search ",
}
});
$(function () {
$('[data-toggle="tooltip"]').tooltip()
})
</script>

