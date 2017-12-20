<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-8">
               <div class="card">
                  <div class="header">
                     <h4 class="title">Update Batch</h4>
                     <?php if($this->session->flashdata('msg')): ?>
                     <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        ×</button> <?php echo $this->session->flashdata('msg'); ?>
                     </div>
                     <?php endif; ?>
                  </div>
                  <?php
                     foreach($datas as $rows){}?>
                  <div class="content">
                     <form action="<?php echo base_url(); ?>batch/update_batch" method="post" enctype="multipart/form-data" id="batchform" name="batchform">
                        <div class="row">
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input type="text" class="form-control"  name="batchname" id="batchname" value="<?php  echo $rows->batch_name; ?>">
                                 <input type="hidden" class="form-control"  name="batch_id" value="<?php  echo $rows->id; ?>">
                              </div>
                           </div>
                           <div class="col-md-5">
                              <div class="form-group">
                                 <label>Status</label>
                                 <select name="status" class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">DeActive</option>
                                 </select>
                                 <script language="JavaScript">document.batchform.status.value="<?php echo $rows->status; ?>";</script>
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-left">Update</button>
                        <div class="clearfix"></div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function () 
   {
     $('#mastersmenu').addClass('collapse in');
     $('#master').addClass('active');
     $('#masters3').addClass('active');
   
     $('#batchform').validate({ // initialize the plugin
       rules: {
           batchname:{required:true },
         },
       messages: {
           batchname: "Please Enter Section Name"
         }
     });
    });
</script>

