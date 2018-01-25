<!-- <script src="http://cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script> -->
<style>
.msg{
  width:500px;
  margin-left: 150px;
}
</style>
<div class="main-panel">
    <div class="content">
        <div class="col-md-12">

            <div class="card">
                <div class="header">
                    <legend>Center Logo</legend>
                </div>
                <div class="msg">
                <?php if($this->session->flashdata('logo')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('logo'); ?>
                    </div>
                    <?php endif; ?>
                  </div>
                        <?php    foreach($res_scheme as $res){} ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>center/logo" class="form-horizontal" enctype="multipart/form-data" id="centerlogoform">
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Center Banner/logo</label>
                                            <div class="col-sm-4">
                                                <input type="file" name="center_banner" id="center_banner" class="form-control" value="" >

                                            </div>
                                            <span>
                                      <?php if(empty($res->center_banner)){

                                      }else{ ?>
                                        <img src="<?php echo base_url(); ?>assets/center/logo/<?php echo $res->center_banner; ?>" style="width:120px;">

                                    <?php  } ?>

                                    </span>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label"></label>
                                                <div class="col-sm-4">
                                                    <button type="submit" id="center_banner_btn" class="btn btn-info btn-fill center">Update Logo </button>
                                                </div>

                                            </div>

                                        </div>
                                    </fieldset>

                                </form>
                            </div>

            </div>

            <div class="card">
                <div class="header">
                    <legend>Center Details</legend>

                </div>
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>

                    <?php endif; ?>
                        <?php    foreach($res_scheme as $res){} ?>
                            <div class="content">
                                <form method="post" action="<?php echo base_url(); ?>center/create" class="form-horizontal" enctype="multipart/form-data" id="eventform">

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Center Name</label>
                                            <div class="col-sm-4">
                                                <input type="text" name="center_name" id="center_name" class="form-control" value="<?php echo $res->center_name; ?>">

                                            </div>

                                        </div>
                                    </fieldset>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Center Details</label>
                                            <div class="col-sm-8">
                                                <textarea cols="80" id="editor1" name="center_info" rows="10" required><?php echo $res->center_info;  ?></textarea>

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
                    <legend>Center Videos</legend>
                </div>
                <div class="msg">
                <?php if($this->session->flashdata('video')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('video'); ?>
                    </div>
                    <?php endif; ?>
                  </div>
                        <div class="content" id="video">
                            <form method="post" action="<?php echo base_url(); ?>center/videos" class="form-horizontal" enctype="multipart/form-data" id="eventform">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Video Title </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="video_title" id="video_title" class="form-control" multiple required>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Video Link </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="video_link" id="video_link" class="form-control" multiple required>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"></label>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-info btn-fill center">Add videos </button>
                                        </div>

                                    </div>
                                </fieldset>
                            </form>
                        </div>
                        <div class="content" id="center">
                            <div class="">
                                <table id="example" class="table">
                                    <thead>

                                        <th data-field="id" class="text-center">S.no</th>
                                        <th data-field="year" data-sortable="true">Title</th>
                                        <th data-field="no" data-sortable="true">Videos</th>

                                        <th data-field="status" data-sortable="true">Status</th>
                                        <th data-field="Section" data-sortable="true">Action</th>

                                    </thead>
                                    <tbody>
                                        <?php
                                    $i=1;
                                    foreach ($res_videos as $videos) {

                                    ?>
                                            <tr>
                                                <td>
                                                    <?php echo $i; ?>
                                                </td>
                                                <td>
                                                    <?php echo $videos->video_title; ?>
                                                </td>
                                                <td><a href="https://www.youtube.com/watch?v=<?php echo $videos->center_videos; ?>" target="_blank">Click here to watch</a></td>
                                                <td>
                                                    <?php if($videos->status=='Active'){ ?>
                                                        <button type="" class="btn btn-success" onclick="changestatus('Deactive',<?php  echo $videos->id; ?>)">Active</button>
                                                        <?php }else{ ?>
                                                            <button type="" class="btn btn-danger" onclick="changestatus('Active',<?php  echo $videos->id; ?>)">Deactive</button>
                                                            <?php  } ?>
                                                </td>
                                                <td><a onclick="delete_videos('<?php echo $videos->id; ?>')"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                            </tr>
                                            <?php $i++;  }  ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
            </div>

            <div class="card">
                <div class="header">
                    <legend>Center Gallery</legend>
                </div>
                <div class="msg">
                <?php if($this->session->flashdata('gallery')): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            ×</button>
                        <?php echo $this->session->flashdata('gallery'); ?>
                    </div>
                    <?php endif; ?>
                  </div>

                        <div class="content">
                            <form method="post" action="<?php echo base_url(); ?>center/gallery" class="form-horizontal" enctype="multipart/form-data" id="gallery_upload_form">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Center Pictures</label>
                                        <div class="col-sm-4">
                                            <input type="file" name="center_photos[]" id="center_photos" class="form-control" multiple required>
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
                        <div class="content" id="center">
                            <div class="row">
                                <?php if(empty($res_img)){
                                  echo "No Gallery Found";
                              }else{
                                foreach($res_img as $rows){ ?>
                                    <div class="col-md-2" style="padding-bottom:5px;">
                                        <div id="thumbnail">
                                            <img src="<?php echo base_url(); ?>assets/center/<?php echo $rows->center_photos; ?>" class="img-responsive" style="width:150px;">
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
$("#gallery_upload").click(function (){
           //var modelname=$("#inputmodelname").val();
           for (var i = 0; i < $("#center_photos").get(0).files.length; ++i) {
               var file1=$("#center_photos").get(0).files[i].name;

               if(file1){
                   var file_size=$("#center_photos").get(0).files[i].size;
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




    function delete_videos(id) {
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
                        url: "<?php echo base_url(); ?>center/delete_videos",
                        data: {
                            id: id
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

    function changestatus(stat, id) {
        swal({
                title: "Are you sure?",
                text: "You Want to Change  the Status",
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
                        url: "<?php echo base_url(); ?>center/change_status",
                        data: {
                            stat: stat,
                            id: id
                        },
                        success: function(data) {

                            if (data == 'success') {
                                swal({
                                        title: "Good job",
                                        text: "updated Successfully!",
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

    function delgal(gal_id) {

        swal({
                title: "Are you sure?",
                text: "You Want to Do this",
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
                        url: "<?php echo base_url(); ?>center/delete_gal",
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
        $('#masters7').addClass('active');
        $('#example').DataTable({
            dom: 'lBfrtip',
            buttons: [

                'colvis'
            ],
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search ",
            }
        });
    });



    $('#centerlogoform').validate({ // initialize the plugin
       rules: {
         center_banner: {
             required: true,
             extension: "jpg,jpeg,png",
             filesize: 5,
         }

       },
       messages: {
             center_banner: "Select Images",
             extension:"File must be jpg and png",

           }
   });
   $("#center_banner_btn").click(function (){
              //var modelname=$("#inputmodelname").val();
              for (var i = 0; i < $("#center_banner").get(0).files.length; ++i) {
                  var file1=$("#center_banner").get(0).files[i].name;

                  if(file1){
                      var file_size=$("#center_banner").get(0).files[i].size;
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
