<!-- <script src="http://cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script> -->
<div class="main-panel">
    <div class="content">
        <div class="col-md-12">

            <div class="card">
                <div class="header">
                    <legend>Scheme Details</legend>

                </div>

                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>

                    <?php endif; ?>
                        <?php   foreach($res_scheme as $res){} ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>scheme/create" class="form-horizontal" enctype="multipart/form-data" id="eventform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Scheme Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="scheme_name" id="scheme_name" class="form-control" value="<?php echo $res->scheme_name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Scheme Details</label>
                                            <div class="col-sm-8">
                                                <textarea cols="80" id="editor1" name="scheme_info" rows="10" required><?php echo $res->scheme_info;  ?></textarea>
                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Scheme Video link</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="scheme_video_link" id="scheme_video_link" class="form-control" value="  <?php echo $res->scheme_video;  ?>">
                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">&nbsp;</label>
                                            <div class="col-sm-10">
                                                <button type="submit" class="btn btn-info btn-fill center">Update </button>
                                            </div>

                                        </div>
                                    </fieldset>

                                </form>

                            </div>
            </div>

            <div class="card">
                <div class="header">
                    <legend>Scheme Gallery</legend>
                </div>
                <?php if($this->session->flashdata('gallery')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('gallery'); ?>
                    </div>
                    <?php endif; ?>

                        <div class="content" >
                            <form method="post" action="<?php echo base_url(); ?>scheme/gallery" class="form-horizontal" enctype="multipart/form-data" id="eventform">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Scheme Picture</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="scheme_photos[]" id="scheme_photos" class="form-control" multiple required>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" id="scheme_gallery" class="btn btn-info btn-fill center">Update Gallery </button>
                                        </div>

                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="content" id="gallery">
                            <div class="row">
                                <?php if(empty($res_img)){
                                  echo "No Gallery Found";
                              }else{
                                foreach($res_img as $rows){ ?>
                                    <div class="col-md-2" style="padding-bottom:5px;">
                                        <div id="thumbnail">
                                            <img src="<?php echo base_url(); ?>assets/scheme/<?php echo $rows->scheme_photo; ?>" class="img-responsive" style="width:150px;">
                                            <a id="close" onclick="delgal(<?php echo $rows->id; ?>)"></a>
                                            </a>
                                        </div>

                                    </div>
                                    <?php
                              }
                              } ?>

                            </div>
                        </div>
            </div>

            <!-- end card -->

        </div>
    </div>
</div>
<style>
.thumbnail {
        position: relative;
        width: 300px;
        height: 300px;
    }

    .thumbnail img {
        width: 100%;
        height: 100%;
    }

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
}
</style>
<script type="text/javascript">
    function delgal(gal_id) {

        swal({
                title: "Are you sure?",
                text: "You Want to Delete the this Timetable",
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
                        url: "<?php echo base_url(); ?>scheme/delete_gal",
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
    $(document).ready(function() {

      $('#mastersmenu').addClass('collapse in');
      $('#master').addClass('active');
      $('#masters6').addClass('active');
        $('#eventform').validate({ // initialize the plugin
            rules: {
                event_date: {
                    required: true
                },
                event_details: {
                    required: true
                },
                event_name: {
                    required: true
                },
                event_status: {
                    required: true
                }
            },
            messages: {
                event_details: "Enter Event Details",
                event_date: "Select Event Date",
                event_name: "Enter Event Name",
                event_status: "Select Status"
            }
        });
    });

    $("#scheme_gallery").click(function (){
               //var modelname=$("#inputmodelname").val();
               for (var i = 0; i < $("#scheme_photos").get(0).files.length; ++i) {
                   var file1=$("#scheme_photos").get(0).files[i].name;

                   if(file1){
                       var file_size=$("#scheme_photos").get(0).files[i].size;
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
</script>
