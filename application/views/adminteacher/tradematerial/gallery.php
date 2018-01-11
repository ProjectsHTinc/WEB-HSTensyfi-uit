<style>

   #close {
   display: block;
   position: absolute;
   width: 30px;
   height: 30px;
   top: 2px;
   right: 2px;
   background: url(http://icons.iconarchive.com/icons/kyo-tux/delikate/512/Close-icon.png);
   background-size: 100% 100%;
   background-repeat: no-repeat;
   }

</style>
<div class="main-panel">
<div class="content">
   <div class="col-md-12">
      <div class="card">
         <div class="header">
            <legend>Trade Material Gallery
               <a href="<?php echo base_url(); ?>stafftradematerial/view" style="float: right;margin-top:-10px;"  class="btn btn-wd btn-default">Go Back</a>
            </legend>
         </div>
         <?php if($this->session->flashdata('gallery')): ?>
         <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            ×</button>
            <?php echo $this->session->flashdata('gallery'); ?>
         </div>
         <?php endif; ?>
         <div class="content">
            <form method="post" action="<?php echo base_url(); ?>stafftradematerial/addgallery" class="form-horizontal" id="" enctype="multipart/form-data" id="eventform">
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">Add Multiple Pictures</label>
                     <div class="col-sm-4">
                        <input type="file" name="trade_material_gallery[]" id="trade_material_gallery" class="form-control" multiple required>
                        <input type="hidden" name="trade_material_gallery_id" id="trade_material_gallery_id" class="form-control" value="<?php echo $gallery_id; ?>">
                     </div>
                  </div>
               </fieldset>
               <fieldset>
                  <div class="form-group">
                     <label class="col-sm-2 control-label"></label>
                     <div class="col-sm-4">
                        <button type="submit" id="gallery_upload" class="btn btn-info btn-fill center">Update Gallery </button>
                     </div>
                  </div>
               </fieldset>
            </form>
         </div>

         <div class="content" id="gallery">
            <div class="container">
               <?php if(empty($result)){
                  echo "No Gallery Found";
                  }else{
                  foreach($result as $rows){ ?>
               <div class="col-md-2" style="padding-bottom:5px;">
                  <div id="thumbnail">
                     <img src="<?php echo base_url(); ?>assets/tradematerial/gallery/<?php echo $rows->trade_picture; ?>" class="img-responsive" style="width:130px;"/>
               <a id="close" onclick="delgal(<?php echo $rows->id; ?>)"></a>
                  </div>
               </div>
               <?php } } ?>
            </div>
         </div>

      </div>
   </div>
</div>
</div>

<script type="text/javascript">

$("#gallery_upload").click(function (){
           //var modelname=$("#inputmodelname").val();
           for (var i = 0; i < $("#trade_material_gallery").get(0).files.length; ++i) {
               var file1=$("#trade_material_gallery").get(0).files[i].name;

               if(file1){
                   var file_size=$("#trade_material_gallery").get(0).files[i].size;
                   if(file_size<1000000){
                       var ext = file1.split('.').pop().toLowerCase();
                       if($.inArray(ext,['jpg','jpeg','png'])===-1){
                           alert("Invalid file extension");
                           return false;
                       }

                   }else{
                       alert("Images size should be less than 1 MB.");
                       return false;
                   }
               }else{
                   alert("fill all fields..");
                   return false;
               }
           }
       });
   function delgal(gal_id) {
       swal({
            title: "Are you sure?",
            text: "You Want to Delete this",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, I am sure!',
            cancelButtonText: "No, cancel it!",
            closeOnConfirm: false,
            closeOnCancel: false
           },
           function(isConfirm) {
               if (isConfirm) {
                   $.ajax({
                       type: "POST",
                       url: "<?php echo base_url(); ?>stafftradematerial/delete_gal",
                       data: {
                           gal_id: gal_id
                       },
                       success: function(data) {
                           if (data == 'success') {
                               swal({
                                       title: "Good job",
                                       text: "Deleted Successfully!",
                                       type: "success"
                                   },
                                   function() {
                                       location.reload();
                                   }
                               );
                           } else {
                               sweetAlert("Oops...", "Something went wrong!", "error");
                           }
                       }
                   });

               } else {
                   swal("Cancelled", "Process Cancel :)", "error");
               }
           });
   }
   $('#tradematerialmenu').addClass('collapse in');
   $('#tradematerial').addClass('active');
   $('#trade2').addClass('active');

</script>
