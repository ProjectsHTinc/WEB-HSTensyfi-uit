<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="toolbar">
      <div class="header">
          <legend>Edit Trainer
            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

      </div>
    </div>
      <div class="row">
    <div class="container">
  <?php  foreach($res  as $rows1){} ?>
  <form action="" method="post" class="form-horizontal" id="edit_trade_handling_form" name="edit_trade_handling_form">
     <fieldset>
       <div class="form-group">
          <label class="col-sm-2 control-label">Select Subject</label>
          <div class="col-sm-6">
            <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $rows1->id; ?>" readonly="">
             <input type="text" name="teacher_name" id="teacher_name" class="form-control" value="<?php echo $rows1->name; ?>" readonly="">
              <input type="text" name="staff_id" id="staff_id" class="form-control" value="<?php echo $rows1->staff_id; ?>" readonly="">
          </div>
       </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">Select Trade Batch</label>
           <div class="col-sm-6">
             <select name="trade_batch_id" id="trade_batch_id"  class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" >
                 <?php foreach ($result_all_trade_batch as $rows) {  ?>
                     <option value="<?php echo $rows->id; ?>">
                         <?php echo $rows->trade_name; ?>-<?php echo $rows->batch_name; ?>
                     </option>
                     <?php      } ?>
             </select>
               <script language="JavaScript">document.edit_trade_handling_form.trade_batch_id.value="<?php echo $rows1->trade_batch_id; ?>";</script>
              <!-- <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $rows->id; ?>"> -->
           </div>
        </div>

        <div class="form-group">
           <label class="col-sm-2 control-label">Select Status</label>
           <div class="col-sm-6">
              <select   name="status" id="status" class="form-control" >
                 <option value="Active">Active</option>
                 <option value="Deactive">DeActive</option>
              </select>
              <script language="JavaScript">document.edit_trade_handling_form.status.value="<?php echo $rows1->status; ?>";</script>
           </div>

        </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">&nbsp;</label>
           <div class="col-sm-6">
              <button type="submit" id="save" class="btn btn-info btn-fill center">Update  </button>
           </div>
        </div>
     </fieldset>
  </form>
  </div>
</div></div>
</div>
</div>
<script>
$('#edit_trade_handling_form').validate({ // initialize the plugin
    rules: {
      trade_id:{required:true },
      status:{required:true },

    },
    messages: {
      trade_id: "Select Trade & batch",
      status:"Select status"
    },
    submitHandler: function(form)
    {
      //alert("hi");
      swal({
        title: "Are you sure?",
        text: "You Want Confirm this form",
        type: "success",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, I am sure!',
        cancelButtonText: "No, cancel it!",
        closeOnConfirm: false,
        closeOnCancel: false
      },

    function(isConfirm)
    {
      if (isConfirm)
      {
        $.ajax({
          url: "<?php echo base_url(); ?>staff/update_trainer_handling_trade_form",
          type:'POST',
          data: $('#edit_trade_handling_form').serialize(),
          success: function(response) {
          if(response=="success"){
          //  swal("Success!", "Thanks for Your Note!", "success");
          $('#edit_trade_handling_form')[0].reset();
          swal({
          title: "Wow!",
          text: response,
          type: "success"
          }, function() {
          window.location = "<?php echo base_url(); ?>staff/view_handling";
          });
          }else{
          sweetAlert("Oops...", "Something went wrong!", "error");
          }
          }
        });
      }else{
        swal("Cancelled", "Process Cancel :)", "error");
      }
    });
    }
    });


$('#teachermenu').addClass('collapse in');
$('#teacher').addClass('active');
$('#teacher2').addClass('active');
</script>
