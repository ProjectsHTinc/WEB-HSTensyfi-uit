<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="toolbar">
      <div class="header">
          <legend>Track Mobilizer
            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></legend>

      </div>
    </div>
      <div class="row">
    <div class="container">

  <form action="<?php echo base_url(); ?>tracking/track" method="post" class="form-horizontal" id="tracking_form" name="edit_trade_handling_form">
     <fieldset>
       <div class="form-group">
          <label class="col-sm-2 control-label">Pick the Date</label>
          <div class="col-sm-4">
                  <input type="text" name="selected_date" class="form-control datepicker" placeholder="Pick Date"/>
            </div>
       </div>
        <div class="form-group">
           <label class="col-sm-2 control-label">Select Mobilizer</label>
           <div class="col-sm-4">
             <select name="user_id" id="user_id"  class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" > -->
                <?php  foreach ($res as $rows) {  ?>
                     <option value="<?php echo $rows->user_id; ?>">
                         <?php echo $rows->name; ?>
                     </option>
                     <?php      } ?>
             </select>
                 </div>
        </div>


        <div class="form-group">
           <label class="col-sm-2 control-label">&nbsp;</label>
           <div class="col-sm-6">
              <button type="submit" id="save" class="btn btn-info btn-fill center">Track  </button>
           </div>
        </div>
     </fieldset>
  </form>
  </div>
</div></div>
</div>
</div>
<script>
$('#tracking_form').validate({ // initialize the plugin
   rules: {
       user_id:{required:true },
       selected_date:{required:true }

   },
   messages: {
         user_id: "Select User",
         selected_date: "Pick a Date"

       }
});
$('#groupingmenu').addClass('collapse in');
$('#grouping').addClass('active');
$('#group1').addClass('active');
</script>
