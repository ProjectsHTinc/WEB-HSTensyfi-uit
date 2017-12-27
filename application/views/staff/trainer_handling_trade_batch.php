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
                                            <legend>List of Handling Traniner,Trade & Batch <a  href="<?php echo base_url(); ?>staff/view" class="btn " style="float:right;margin-top:-10px;">View All Staff</a></legend>


                                            <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                                                <thead>
                                                    <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                                    <th data-field="name" class="text-left" data-sortable="true">Name</th>
                                                    <th data-field="email" class="text-left" data-sortable="true">Trade & batch</th>
                                                    <th data-field="status" class="text-left" data-sortable="true">Status</th>
                                                    <th data-field="Section" class="text-left" data-sortable="true">Action</th>
                                                </thead>
                                                <tbody>
                                                    <?php
																										$i=1;
																										foreach($res as $rows){
																											 ?>
                                                        <tr>
																													<td><?php echo $i ?></td>
																													<td><?php echo $rows->name; ?></td>
																														<td><?php echo $rows->trade_name;?>-<?php echo $rows->batch_name;?></td>
																														<td><?php echo $rows->status;?></td>
																														<td><a href="<?php echo base_url(); ?>staff/edit_handling/<?php echo base64_encode($rows->id);?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
																														</tr>
																											<?php $i++; } ?>
                                                </tbody>
                                            </table>
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

    $(document).on("click", ".open-AddBookDialog", function() {
        var eventId = $(this).data('id');
        $(".modal-body #teacher_id").val(eventId);
    });

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
