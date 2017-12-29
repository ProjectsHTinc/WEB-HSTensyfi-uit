<div class="main-panel">
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="header">
            <legend>Add Trade Material</legend>
         </div>
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button>
            <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <div class="content">
            <form method="post" action="<?php echo base_url(); ?>stafftradematerial/create" class="form-horizontal" enctype="multipart/form-data" id="materialform">
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Select Trade</label>
                     <div class="col-sm-4">
                        <select name="trade_id" id="trade_id" class="selectpicker form-control" data-title="Select Trade" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                           <?php foreach($get_all_active_trade as $rows){ ?>
                           <option value="<?php echo $rows->trade_id; ?>"><?php echo $rows->trade_name; ?></option>
                           <?php    } ?>
                        </select>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Title</label>
                     <div class="col-sm-4">
                        <input type="text" name="trade_title" id="trade_title" class="form-control" onkeyup="check_title(this.value)">
                         <div id="msg"></div>
                     </div>

                  </div>

               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-7">
                        <textarea cols="50" name="description" rows="10"></textarea>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">File PDF or DOC</label>
                     <div class="col-sm-4">
                        <input type="file" name="trade_file" id="trade_file" class="form-control" placeholder="Optional" accept="application/pdf,application/msword,
                           application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Video Link</label>
                     <div class="col-sm-4">
                        <input type="text" name="trade_video" id="trade_video" class="form-control" placeholder="Optional">
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Status</label>
                     <div class="col-sm-4">
                        <select name="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                           <option value="Active">Active</option>
                           <option value="DeActive">De-Active</option>
                        </select>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">&nbsp;</label>
                     <div class="col-sm-10">
                        <button type="submit" id="save" class="btn btn-info btn-fill center">Update  </button>
                     </div>
                  </div>
               </fieldset>
            </form>
         </div>
      </div>
      <!-- end card -->
   </div>
</div>
<script type="text/javascript">

   function check_title(val)
   { 
      var tid=document.getElementById("trade_id").value;
      alert(tid);
      $.ajax({
      type:'post',
      url:'<?php echo base_url(); ?>/stafftradematerial/check_title_function',
      data:'ctitle=' + val + '&tradeid=' + tid,
      success:function(test)
      {   
        if(test=="AE")
        {
          $("#msg").html("<span style=color:red;>Title Already Exit For This Trade</span>");
          $("#save").hide();
        }
        else{
          $("#msg").html("<span style=color:green;>Title Available For This Trade</span>");
          $("#save").show();
        }
      }
      });
   } 

  $(document).ready(function (){
   $('#tradematerialmenu').addClass('collapse in');
   $('#tradematerial').addClass('active');
   $('#trade1').addClass('active');
  });
 




   
   $('#materialform').validate({ // initialize the plugin
   ignore: [],
   rules: {
   trade_title: {
   required: true
   },
   description: {
    required:true
   },
   trade_id: {
   required: true
   },
   status: {
   required: true
   }
   },
   messages: {
   trade_title: "Enter Title",
   description: "Enter trade info",
   trade_id: "Select Trade",
   status: "Select Status"
   },
   // errorPlacement: function(error, element)
   // {
   // if (element.attr("name") == "editor1")
   // {
   // error.insertBefore("textarea#editor1");
   // } else {
   // error.insertBefore(element);
   // }
   // }
   });
  // CKEDITOR.replace('editor1');
</script>

