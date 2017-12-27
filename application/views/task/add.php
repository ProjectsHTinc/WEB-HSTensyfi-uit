<style>
   .myBtn{
   background-color: rgba(68, 125, 247, 0.59);
   cursor: pointer;
   width: 15%;
   border-radius: 5px;
   height: 40px;
   }
   .myBtn:focus{
   background-color:#642160;
   color: #fff;
   }
   .center img
   {
   height: 128px;
   width: 128px;
   margin:200px auto;
   float:right;
   margin-right:200px;
   }
</style>
<div class="main-panel">
   <div class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <?php if($this->session->flashdata('msg')): ?>
               <div class="alert alert-success">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                  ×</button> <?php echo $this->session->flashdata('msg'); ?>
               </div>
               <?php endif; ?>
               <div class="card">
                  <div class="header">
                     <legend> Task Details  <a href="<?php echo base_url(); ?>task/view_circular" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">View Task</a></legend>
                  </div>
                  <div class="content">
                     <form method="post" action="" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validates()" name="form" id="myformsection">
                        
                        <fieldset>
                        <div class="form-group">
                            <p id="erid" style="color:red;"> </p>
                           <label class="col-sm-2 control-label">Mobilizer</label>
                           <div class="col-sm-4">
                              <select multiple name="musers[]" class="selectpicker form-control" data-title="Select Mobilizer" id="multiple-mobileuser" data-menu-style="dropdown-blue">
                                 <?php foreach ($mobilizer as $rows) { ?>
                           <option value="<?php echo $rows->user_id;?>"><?php echo $rows->name; ?></option>
                                 <?php } ?>
                              </select>
                           </div>

                     <label class="col-sm-2 control-label">Date</label>
                     <div class="col-sm-4">
                        <input type="text" name="date" id="date" class="form-control datepicker" placeholder="Enter Date" >
                     </div>
                        </div>
                        </fieldset>
                        <!--fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Circular Type</label>
                              <div class="col-sm-4">
                                 <select multiple name="citrcular_type[]" required="" id="citrcular_type" data-title="Select Circular Type" class="selectpicker form-control">
                                    <option value="Mail">Mail</option>
                                    <option value="Notification">Notification</option>
                                 </select>
                              </div>
                              
                           </div>
                        </fieldset-->
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Title</label>
                              <div class="col-sm-4">
                                 <div id="tnone">
                                    <select name="ctitle" id="cititle" class="selectpicker form-control" data-title="Select Title" onchange="circulardescription(this)">
                                       <?php foreach($cmaster as $cmtitle) {?>
                                       <option value="<?php echo $cmtitle->circular_title; ?>"><?php echo $cmtitle->circular_title; ?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div id="cirtitle" style="display:none;">
                                    <input type="text" name="title" id="title" class="form-control"  placeholder="Enter Title" >
                                 </div>
                              </div>
                              <label class="col-sm-2 control-label">Status</label>
                              <div class="col-sm-4">
                                 <select name="status"  class="selectpicker form-control">
                                    <option value="Active">Active</option>
                                    <option value="Deactive">De-Active</option>
                                 </select>
                              </div>
                           </div>
                        </fieldset>
                        <fieldset>
                           <div class="form-group">
                              <label class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-4">
                                 <div id="msg"></div>
                                 <textarea name="notes" readonly class="form-control"  id="descriptions" rows="4" cols="80"></textarea>
                              </div>
                              <label class="col-sm-2 control-label">&nbsp;</label>
                              <div class="col-sm-4">
                                 <button type="submit" id="save" class="btn btn-info btn-fill center" >Send</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
               <div class="modal" style="display:none">
                  <div class="center">
                     <img alt="" src="<?php echo base_url(); ?>assets/loader.gif" />
                  </div>
               </div>
            
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   //$("#loading").hide();
   $(document).ready(function () 
   {
   $('#communcicationmenu').addClass('collapse in');
   $('#communication').addClass('active');
   $('#communication1').addClass('active');
   
   $('#myformsection').validate({ // initialize the plugin
    rules: {
   title:{required:true },
   ctitle:{required:true },
   date:{required:true },
   notes:{required:true },
   citrcular_type:{required:true },
   status:{required:true }
     },
     messages: {
   ctitle:"Enter Title",
   title:"Enter Title",
   date:"Enter Date",
   notes:"Enter The Details",
   citrcular_type:"Select Circular Type",
   status:"Select Status"
          },
          
   submitHandler: function(form) {
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
     function(isConfirm) {
        if (isConfirm) {
     $.ajax({
        beforeSend: function() 
          {
            $(".modal").show();
          },
       complete: function() 
          {
            $(".modal").hide();
          },
         url: "<?php echo base_url(); ?>task/create",
         type:'POST',
         data: $('#myformsection').serialize(),
         success: function(response) {
            //alert(response);
        if(response=="success")
        {      
           $('#myformsection')[0].reset();
             swal({
                     title: "Wow!",
                     text: "Message!",
                     type: "success"
                  },
      function(){
             window.location = "<?php echo base_url(); ?>task/add_circular";
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
});

   function validates()
   {
      var mobile = document.getElementById("multiple-mobileuser").value;
   
    if(mobile=="")
        {
       $("#erid").html("Please Select Mobilizer");
       //document.form.teacher.focus() ;
       return false;
        }
   } 
   
   function circulardescription(cde1) 
   {
      var cde=document.getElementById('cititle').value;
      //var ctype=document.getElementById('citrcular_type').value;   
      //alert(cde); 
   $.ajax({
    url:'<?php echo base_url(); ?>task/get_description_list',
    type:'post',
    //data:'clsmasid=' + eid + '&examid=' + cid,
    data:'ctitle=' + cde,
    dataType:"JSON",
       cache: false,
    success: function(test1) {
       var test=test1.status1;
       //alert(test);
       if(test=="success"){
           var res=test1.res2;
           var len=res.length;
                  //alert(len);
           var cdescription=test1.res2;
           var i;
           var description='';
            var description1='';
           for (i=0;i<len;i++) {
              description +=''+cdescription[i].circular_description+'';
              $("#descriptions").html(description);
          }
         } else {
            $('#msg').html('<span style="color:red;text-align:center;">Description Not Found</p>');
          $("#descriptions").html('');
         }
    }
   });
  }

   $().ready(function(){
   
     $('.datepicker').datetimepicker({
       format: 'DD-MM-YYYY',
       icons: {
           time: "fa fa-clock-o",
           date: "fa fa-calendar",
           up: "fa fa-chevron-up",
           down: "fa fa-chevron-down",
           previous: 'fa fa-chevron-left',
           next: 'fa fa-chevron-right',
           today: 'fa fa-screenshot',
           clear: 'fa fa-trash',
           close: 'fa fa-remove'
       }
    });
   });
</script>

