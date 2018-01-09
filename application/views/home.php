<link  href="<?php echo base_url(); ?>assets/css/animated.css" rel='stylesheet' type='text/css'>
<div class="main-panel">
    <div class="content">
        <div class="card">
            <div class="container-fluid">
                <p style="font-size:25px;padding-left:16px;padding-top: 15px;">Admin Dashboard</p>
								<div class="container">
										<div class="row">
											<section class="section_0">
												<div class="col-sm-3">
													<div class="circle circle1">
														<?php foreach ($tot_trainer as $key_trainer) {} ?>
														<a href="#section_1"><h2><?php echo $key_trainer->total_trainer; ?><p>Students</p></h2></a>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="circle circle2">
														<?php foreach ($tot_mobilizer as $key_mobilizer) {} ?>
														<a href="#section_2"><h2><?php echo $key_mobilizer->total_mobilizer; ?><p>Trainer</p></h2></a>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="circle circle3">
														<?php foreach ($tot_students as $key_students) {} ?>
														<a href="#section_3"><h2><?php echo $key_students->total_students; ?><p>Mobilizer</p></h2></a>
													</div>
												</div>


											</section>
										</div>
									</div>

                <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <div class="card">
                                    <form id="" action="#" method="" novalidate="" style="padding-bottom:30px;">

                                        <fieldset id="group2" style="padding-top:20px;">
                                            <div class="form-group">
                                                <div class="col-sm-12">

                                                    <input type='radio' name="user_type" value="5" checked style="margin-left:40px;" /><span style="padding-left:10px; padding-right:10px; ">Students</span>
                                                    <input type='radio' name="user_type" value="3" /><span style="padding-left:10px;">Trainers</span>
                                                    <input type='radio' name="user_type" value="4" /><span style="padding-left:10px;">Mobilizer</span>


                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="content">
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <input class="form-control searchbox" name="text" type="text" id="search_txt" onkeypress="search_load()" autocomplete="off" aria-required="true" placeholder="Search Students,Teacher">
                                                </div>
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-info btn-fill pull-right" onclick="search_load()">Search </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="card">
                                        <div id="result">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">

                            </div>


                            <!---                      -->



                            <div class="col-md-12" style="padding-left:0px; padding-top:15px;padding-bottom:15px;">
                                <div class="col-md-4">
                                    <div class="card" style="box-shadow:none;">
                                        <div class="imgdesign">
                                            <div class="img">
                                                <ul style="padding-left:70px;">
                                                    <li style="padding-top:13px;list-style-type:none;">
                                                        <a href="<?php echo base_url(); ?>circular/view_circular" class="design">Circular</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card" style="box-shadow:none;">
                                        <div class="imgdesign">
                                            <div class="img1">
                                                <ul style="padding-left:70px;">
                                                    <li style="padding-top:13px;list-style-type:none;">
                                                        <a href="<?php echo base_url(); ?>event/create" class="design">Events</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="card" style="box-shadow:none;">
                                        <div class="imgdesign">
                                            <div class="img4">
                                                <ul style="padding-left:70px;">
                                                    <li style="padding-top:13px;list-style-type:none;">
                                                        <a href="<?php echo base_url(); ?>adminattendance/monthclass" class="design">Calender</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
		window.onload = date_time('date_time');

        function search_load() {

            var ser = $("#search_txt").val();
            var user_type = $('input[name=user_type]:checked').val();
            if (!ser) {
                // alert("enter Text");
                $('#result').html('<center style="color:red;">Enter The Text in Search Box</center>');
            } else {
                $.ajax({
                    url: '<?php echo base_url(); ?>adminlogin/search',
                    method: "POST",
                    data: {
                        ser: ser,
                        user_type: user_type,

                    },
                    //  dataType: "JSON",
                    //  cache: false,
                    success: function(data) {
                        //alert(data);
                        $('#result').html(data);
                        //alert(data['status']);

                    }
                });

            }
        }



        $('input[type="radio"]').on('click change', function(e) {
            $('#result').html(' ');
        });




    </script>
