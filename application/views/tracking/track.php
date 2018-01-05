<style>
th{
  width:50px;
}
.kms-btn{
  margin-top: 200px;
}
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWXc9pFwkDuvbgJryTIHlOg-oIByT_nxY"></script>

<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="row">
      <div class="container">

<?php if($res[0]['status']=="nofound"){
  echo "No Result Found";
}?>
<div class="col-md-8" style="padding:40px;">
  <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
  <script type="text/javascript">
  var MapPoints = '<?php echo json_encode($res); ?>';

  var MY_MAPTYPE_ID = 'custom_style';
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;

  function initialize() {
      directionsDisplay = new google.maps.DirectionsRenderer({suppressMarkers:true});

      if (jQuery('#map').length > 0) {

          var locations = jQuery.parseJSON(MapPoints);

          map = new google.maps.Map(document.getElementById('map'), {
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              scrollwheel: true
          });
          directionsDisplay.setMap(map);

          var infowindow = new google.maps.InfoWindow();
          var flightPlanCoordinates = [];
          var bounds = new google.maps.LatLngBounds();

          for (i = 0; i < locations.length; i++) {

              marker = new google.maps.Marker({
                  position: new google.maps.LatLng(locations[i].address.lat, locations[i].address.lng),
                  map: map
              });
              flightPlanCoordinates.push(marker.getPosition());
              bounds.extend(marker.position);

              google.maps.event.addListener(marker, 'click', (function (marker, i) {
                  return function () {
                      infowindow.setContent(locations[i]['title']);
                      infowindow.open(map, marker);
                  }
              })(marker, i));
          }

          map.fitBounds(bounds);
          /* polyline
              var flightPath = new google.maps.Polyline({
                  map: map,
                  path: flightPlanCoordinates,
                  strokeColor: "#FF0000",
                  strokeOpacity: 1.0,
                  strokeWeight: 2
              });
  */
          // directions service
          var start = flightPlanCoordinates[0];
          var end = flightPlanCoordinates[flightPlanCoordinates.length - 1];
          var waypts = [];
          for (var i = 1; i < flightPlanCoordinates.length - 1; i++) {
              waypts.push({
                  location: flightPlanCoordinates[i],
                  stopover: true
              });
          }
          calcRoute(start, end, waypts);
      }
  }

  function calcRoute(start, end, waypts) {
      var request = {
          origin: start,
          destination: end,
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: google.maps.TravelMode.DRIVING
      };
      directionsService.route(request, function (response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(response);
              var route = response.routes[0];

              var summaryPanel = document.getElementById('example');
              summaryPanel.innerHTML = '';
              // For each route, display summary information.
              summaryPanel.innerHTML += '   <thead><th>S.no</th><th>From </th><th>To</th><th>Kms</th><th>Mts</th></thead>';
              for (var i = 0; i < route.legs.length; i++) {

                  var routeSegment = i + 1;
                  summaryPanel.innerHTML += '  <tbody>  <tr><td>'+ i +'</td><td>' + route.legs[i].start_address + '</td><td>' + route.legs[i].end_address + '</td><td>' + route.legs[i].distance.text + '</td><td id="kms"> <input type="hidden"  name="kms" value="' + route.legs[i].distance.value + '" /> ' + route.legs[i].distance.value + '</td></tr> </tbody>';


              }


          }
      });
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <div id="map" style="border: 2px solid #3872ac;height:500px;"></div>




  </div>
  <div class="col-md-4">
    <div class="kms-btn">
<button id="click" class="btn btn-primary">Show the KM</button>
</div>
  </div>
  <div class="col-md-10">
  <div id="directions_panel">
    <table id="example" class="table table-striped table-no-bordered table-hover" cellspacing="0" >

    </table>


  </div>
</div>

<div id="totals">
</div>
  </div>
  </div>
  </div>
  </div>
  </div>
  <script type="text/javascript">
  $('#example').dataTable( {
              bSort: false,
              aoColumns: [ { sWidth: "45%" }, { sWidth: "45%" }, { sWidth: "10%", bSearchable: false, bSortable: false } ],
          "scrollY":        "200px",
          "scrollCollapse": true,
          "info":           true,
          "paging":         true
      } );

    $("#click").click(function(){
      var tot=0;
      $("input[name=kms]").each (function() {
        tot=tot + parseInt($(this).val())/1000;
      })


       swal('Total '+ tot + ' in kms ');


});
  </script>
