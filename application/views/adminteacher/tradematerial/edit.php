<div class="main-panel">
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="header">
            <legend>Edit Trade Material</legend>
         </div>
         <?php if($this->session->flashdata('msg')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button>
            <?php echo $this->session->flashdata('msg'); ?>
         </div>
         <?php endif; ?>
         <?php foreach($result as $rows) ?>
         <div class="content">
            <form method="post" action="<?php echo base_url(); ?>stafftradematerial/save_trade_material" class="form-horizontal" enctype="multipart/form-data" id="materialform" name="materialform">
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Trade Name</label>
                     <div class="col-sm-4">
                        <input type="text" name="" id="" class="form-control" value="<?php echo $rows->trade_name; ?>" readonly>
                        <input type="hidden" id="trade_id" class="form-control" value="<?php echo $rows->trade_id ; ?>" readonly>
                        <input type="hidden" name="trade_material_id" id="trade_material_id" class="form-control" value="<?php echo $rows->id; ?>" readonly>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Title</label>
                     <div class="col-sm-4">
                        <input type="text" name="trade_title" id="trade_title" class="form-control" onkeyup="check_title(this.value)" value="<?php echo $rows->trade_title; ?>">
                          <div id="msg"></div>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Description</label>
                     <div class="col-sm-7">
                  <textarea cols="50" name="description" rows="10"><?php echo $rows->trade_info; ?></textarea>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">File PDF or DOC</label>
                     <div class="col-sm-4">
                        <input type="file" name="trade_file" id="trade_file" class="form-control" placeholder="Optional" accept="application/pdf,application/msword,
                           application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                        <input type="hidden" name="trade_old_file" id="trade_old_file" class="form-control" value="<?php echo $rows->trade_file; ?>">
                        <span><?php if(empty($rows->trade_file)){
                           }else{ ?>
                        <a href="<?php echo base_url(); ?>assets/tradematerial/<?php echo $rows->trade_file; ?>" target="_blank">Click here to Open file</a>
                        <?php  } ?></span>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Video Link</label>
                     <div class="col-sm-4">
                        <input type="text" name="trade_video" id="trade_video" class="form-control" value="  <?php echo $rows->trade_video; ?>" >
                        <span><?php if(empty($rows->trade_video)){
                           }else{ ?>
                        <a href="https://www.youtube.com/watch?v=<?php echo $rows->trade_video; ?>" target="_blank">Click here to Watch</a>
                        <?php  } ?></span>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Status</label>
                     <div class="col-sm-4">
                        <select name="status" id="status" class="selectpicker form-control" data-style="btn-default btn-block" data-menu-style="dropdown-blue">
                           <option value="Active">Active</option>
                           <option value="Deactive">DeActive</option>
                        </select>
                        <script language="JavaScript">document.materialform.status.value="<?php echo $rows->status; ?>";</script>
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">&nbsp;</label>
                     <div class="col-sm-10">
                        <button type="submit" id="save" class="btn btn-info btn-fill center">Update Material </button>
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


   $('#tradematerialmenu').addClass('collapse in');
   $('#tradematerial').addClass('active');
   $('#trade2').addClass('active');
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
   //   errorPlacement: function(error, element)
   // {
   //     if (element.attr("name") == "editor1")
   //    {
   //     error.insertBefore("textarea#editor1");
   //     } else {
   //     error.insertBefore(element);
   //     }
   // }
   });
   // CKEDITOR.replace('editor1');
</script>
