

<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-10">
               <?php foreach ($res as $rows) { } ?>
               <div class="card">
                  <div class="header">Edit Trade & Batch Management </div>
                  <div class="content">
                     <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>classmanage/update_cs" name="class_manage" enctype="multipart/form-data" id="myformclassmange">
                        <div class="form-group">
                           <label class="col-md-2 control-label">Trade</label>
                           <div class="col-md-6">
                              <input type="hidden" name="clsmanage_id" value="<?php echo $rows->id; ?>">

                              <select name="trade_name" class="selectpicker"  data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                 <?php foreach ($trade as $trd) {  ?>
                                 <option value="<?php  echo $trd->id; ?>"><?php  echo $trd->trade_name; ?></option>
                                 <?php } ?>
                              </select>
                              <script language="JavaScript">document.class_manage.trade_name.value="<?php echo $rows->trade_id; ?>";</script>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-2 control-label">Batch</label>
                           <div class="col-md-6">
                              <select name="batch_name" class="selectpicker" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                                 <?php foreach ($batch as $bat) {  ?>
                                 <option value="<?php  echo $bat->id; ?>"><?php  echo $bat->batch_name; ?></option>
                                 <?php } ?>
                              </select>
                              <script language="JavaScript">document.class_manage.batch_name.value="<?php echo $rows->batch_id; ?>";</script>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-2 control-label">Status</label>
                           <div class="col-md-6">
                              <select name="status" class="selectpicker form-control">
                                 <option value="Active">Active</option>
                                 <option value="Deactive">DeActive</option>
                              </select>
                              <script language="JavaScript">document.class_manage.status.value="<?php echo $rows->status; ?>";</script>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-4"></label>
                           <div class="col-md-8">
                              <button type="submit" class="btn btn-fill btn-info">Update</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <!-- end card -->
               <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
         </div>
         <!-- end row -->
      </div>
   </div>
</div>
<script type="text/javascript">
   $('#mastersmenu').addClass('collapse in');
   $('#master').addClass('active');
   $('#masters5').addClass('active');
   
   $('#myformclassmange').validate({ // initialize the plugin
       rules: {
         trade_name:{required:true },
         batch_name:{required:true },
       },
       messages: {
         trade_name: "Select Trade Name",
         batch_name:"Select Batch Name"
       }
   });
</script>

