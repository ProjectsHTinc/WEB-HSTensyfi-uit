<style>
    .formdesign {
        padding-bottom: 50px;
        padding-top: 10px;
        background-color: rgba(209, 209, 211, 0.11);
        border-radius: 12px;
    }
</style>
<div class="main-panel">
    <div class="content">
        <?php if($this->session->flashdata('msg')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
                <?php echo $this->session->flashdata('msg'); ?>
            </div>
            <?php endif; ?>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="content" id="content1">
                                        <div class="fresh-datatables">
                                            <!-- <h4 class="title" style="padding-bottom: 20px;">List of Teacher</h4> -->
                                            <legend>List of Staff</legend>


                                            <div class="toolbar">
                                                <!-- Here you can write extra buttons/actions for the toolbar-->
                                            </div>

                                            <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                                                <thead>
                                                    <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                                    <th data-field="name" class="text-left" data-sortable="true">Name</th>
                                                      <th data-field="role" class="text-left" data-sortable="true">Role</th>
                                                    <th data-field="email" class="text-left" data-sortable="true">Email</th>
                                                    <th data-field="mobile" class="text-left" data-sortable="true">Mobile</th>
                                                    <th data-field="class" class="text-left" data-sortable="true">Class tutor</th>
																										  <th data-field="Added" class="text-left" data-sortable="true">Added by</th>
                                                    <th data-field="status" class="text-left" data-sortable="true">Status</th>
                                                    <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                                                </thead>
                                                <tbody>
                                                    <?php
																										$i=1;
																										foreach($result as $rows){
																											 ?>



                                                        <tr>
																													<td><?php echo $i ?></td>
																													<td><?php echo $rows->name; ?></td>
                                                          <td><?php echo $rows->user_type_name; ?></td>
																													<td><?php echo $rows->email; ?></td>
																													<td><?php echo $rows->phone; ?></td>
																														<td><?php echo $rows->trade_batch_id;?></td>
																														<td><?php echo $rows->created_by;?></td>
																														<td><?php echo $rows->status;?></td>
																														<td><a href="<?php echo base_url(); ?>staff/edit/<?php echo base64_encode($rows->id);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>

																														</tr>

																											<?php $i++; } ?>


                                                </tbody>
                                            </table>
                                            <div id="myModal" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">Add Subject To Teacher</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="" method="post" class="form-horizontal" id="subject_handling_form">
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-4 control-label">Select Subject</label>
                                                                        <div class="col-sm-6">
                                                                            <select name="subject_id" id="subject_id" data-title="Select Subject" class="selectpicker" data-style=" btn-block" data-menu-style="dropdown-blue" onchange="getListClass()">
                                                                                <?php foreach ($resubject as $rows) {  ?>
                                                                                    <option value="<?php echo $rows->subject_id; ?>">
                                                                                        <?php echo $rows->subject_name; ?>
                                                                                    </option>
                                                                                    <?php      } ?>
                                                                            </select>
                                                                            <input type="hidden" name="teacher_id" id="teacher_id" class="form-control" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-4 control-label">Select Class</label>
                                                                        <div class="col-sm-6">
                                                                            <select name="class_master_id" id="class_master_id" class="form-control">
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-4 control-label">Select Status</label>
                                                                        <div class="col-sm-6">
                                                                            <select name="status" id="status" class="form-control">
                                                                                <option value="Active">Active</option>
                                                                                <option value="Deactive">Deactive</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-sm-4 control-label">&nbsp;</label>
                                                                        <div class="col-sm-6">
                                                                            <button type="submit" id="save" class="btn btn-info btn-fill center">Save </button>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="editor"></div>
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


    $('#teachermenu').addClass('collapse in');
    $('#teacher').addClass('active');
    $('#teacher2').addClass('active');

    $('#example').DataTable({
        fixedHeader: true,
        dom: 'lBfrtip',
        buttons: [{
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            }, {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
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
            searchPlaceholder: "Search records",
        }
    });
</script>
