<div class="main-panel">
    <div class="content">
        <div class="col-md-12">

          <div class="card">
              <div class="header">
                  <legend>Trade Material Gallery
                      <a href="<?php echo base_url(); ?>tradematerial/view" style="float: right;margin-top:-10px;"  class="btn btn-wd btn-default">Go Back</a>
                  </legend>

              </div>
              <?php if($this->session->flashdata('gallery')): ?>
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                          ×</button>
                      <?php echo $this->session->flashdata('gallery'); ?>
                  </div>
                  <?php endif; ?>

                      <div class="content" >
                          <form method="post" action="<?php echo base_url(); ?>tradematerial/addgallery" class="form-horizontal" enctype="multipart/form-data" id="eventform">
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
                                          <button type="submit" class="btn btn-info btn-fill center">Update Gallery </button>
                                      </div>

                                  </div>
                              </fieldset>
                          </form>
                      </div>
                      <div class="content" id="gallery">
                          <div class="row">
                              <?php if(empty($result)){
                                echo "No Gallery Found";
                            }else{
                              foreach($result as $rows){ ?>
                                  <div class="col-md-2" style="padding-bottom:5px;">
                                      <div id="thumbnail">
                                          <img src="<?php echo base_url(); ?>assets/tradematerial/gallery/<?php echo $rows->trade_picture; ?>" class="img-responsive" style="width:150px;">
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
                        url: "<?php echo base_url(); ?>tradematerial/delete_gal",
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
            $('#materialform').validate({ // initialize the plugin
              ignore: [],
                rules: {
                    trade_title: {
                        required: true
                    },

                    editor1: {
                    required: function()
                    {
                    CKEDITOR.instances.editor1.updateElement();
                    }

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
                    editor1: "Enter trade info",
                    trade_id: "Select Trade",
                    status: "Select Status"
                },
                errorPlacement: function(error, element)
              {
                  if (element.attr("name") == "editor1")
                 {
                  error.insertBefore("textarea#editor1");
                  } else {
                  error.insertBefore(element);
                  }
              }
            });
                CKEDITOR.replace('editor1');
    </script>
