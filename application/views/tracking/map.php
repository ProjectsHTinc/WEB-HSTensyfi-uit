<style>
    .dt-buttons {
        display: none;
    }
</style>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCoYnRRiH0ilu-wms7i46rUOJF1WOAOnoE&sensor=true" type="text/javascript"></script>
<div class="main-panel">
    <div class="content">
        <div class="card">
            <div class="row">
                <div class="" style="">
                    <div class="col-md-8" style="padding-top:20px;padding-bottom:20px;">
                        <div id="map-canvas" style="width: 100%; height: 500px;">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="fresh-datatables">
                            <h4 class="title" style="padding-top: 20px;"><?php if(empty($result)){}else{ foreach ($result as $rows) { }
                    echo $rows->name;
                    } ?></h4>
                            <legend>List of Records <a href="<?php echo base_url(); ?>tracking/home" style="float:right;margin-top:-10px;" class="btn">Back To Track</a></legend>

                            <div class="toolbar">
                                <!-- Here you can write extra buttons/actions for the toolbar-->
                            </div>

                            <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                                <thead>
                                    <th data-field="id" class="text-left" data-sortable="true">S.No</th>
                                    <th data-field="name" class="text-left" data-sortable="true">Date and Time</th>
                                    <th data-field="Section" class="text-left" data-sortable="true">Location</th>
                                </thead>
                                <tbody>
                                    <?php
                         $i=1;
                         foreach($result as $rows){

                               ?>

                                        <tr>
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows->created_at; ?>
                                            </td>
                                            <td>
                                                <?php echo $rows->user_location; ?>
                                            </td>

                                        </tr>

                                        <?php $i++; } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var map;
    var geocoder;
    var marker;
    var people = new Array();
    var latlng;
    var infowindow;

    $(document).ready(function() {
        ViewCustInGoogleMap();
    });

    function ViewCustInGoogleMap() {

        var mapOptions = {
            center: new google.maps.LatLng(11.0168445, 76.9558321), // Coimbatore = (11.0168445, 76.9558321)
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

        // Get data from database. It should be like below format or you can alter it.

        var data = '<?php echo json_encode($res);  ?>';

        people = JSON.parse(data);

        for (var i = 0; i < people.length; i++) {
            setMarker(people[i]);
        }

    }

    function setMarker(people) {
        geocoder = new google.maps.Geocoder();
        infowindow = new google.maps.InfoWindow();
        if ((people["LatitudeLongitude"] == null) || (people["LatitudeLongitude"] == 'null') || (people["LatitudeLongitude"] == '')) {
            geocoder.geocode({
                'address': people["Address"]
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    latlng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map,
                        draggable: false,
                        html: people["DisplayText"],
                        icon: "images/marker/" + people["MarkerId"] + ".png"
                    });
                    //marker.setPosition(latlng);
                    //map.setCenter(latlng);
                    google.maps.event.addListener(marker, 'click', function(event) {
                        infowindow.setContent(this.html);
                        infowindow.setPosition(event.latLng);
                        infowindow.open(map, this);
                    });
                } else {
                    alert(people["DisplayText"] + " -- " + people["Address"] + ". This address couldn't be found");
                }
            });
        } else {
            var latlngStr = people["LatitudeLongitude"].split(",");
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            latlng = new google.maps.LatLng(lat, lng);
            marker = new google.maps.Marker({
                position: latlng,
                map: map,
                draggable: false, // cant drag it
                html: people["DisplayText"] // Content display on marker click
                    //icon: "images/marker.png"       // Give ur own image
            });
            //marker.setPosition(latlng);
            //map.setCenter(latlng);
            google.maps.event.addListener(marker, 'click', function(event) {
                infowindow.setContent(this.html);
                infowindow.setPosition(event.latLng);
                infowindow.open(map, this);
            });
        }
    }

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
    $('#groupingmenu').addClass('collapse in');
    $('#grouping').addClass('active');
    $('#group1').addClass('active');
</script>
