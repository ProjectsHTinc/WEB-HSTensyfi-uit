<style>
  .trheight{
  height: 50px;
  }
</style>
<div class="main-panel">
<div class="content">
  <?php if($this->session->flashdata('msg')): ?>
  <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
    ×</button> <?php echo $this->session->flashdata('msg'); ?>
  </div>
  <?php endif; ?>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="content">
              <h4 class="title">View Gallery </h4>
             <br/>
                <div class="row">
                  <?php foreach ($view_photos as $value) {
                  ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="">
                            <div class="content text-center">
                                <img src="<?php echo base_url(); ?>assets/task/<?php echo $value->task_image; ?>" class="img-responsive" style="height:200px;">
                            </div>
                        </div>
                    </div>
                   <?php } ?>

                </div>

              </div>
              <!-- end content-->
            </div>
            <!--  end card  -->
          </div>
          <!-- end col-md-12 -->
        </div>
        <!-- end row -->
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#communcicationmenu').addClass('collapse in');
  $('#communication').addClass('active');
  $('#communication3').addClass('active');
</script>
