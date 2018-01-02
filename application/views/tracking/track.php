<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWXc9pFwkDuvbgJryTIHlOg-oIByT_nxY"></script>

<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="row">
      <div class="container">


<div class="col-md-8" style="padding:40px;">
  <!-- <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> -->
  <script type="text/javascript">
  var MapPoints = '[{"address":{"address":"plac Grzybowski, Warszawa, Polska","lat":"11.016587","lng":"76.954261"},"title":"Warszawa"},{"address":{"address":"Jana Paw\u0142a II, Warszawa, Polska","lat":"11.019725","lng":"76.952029"},"title":"Wroc\u0142aw"},{"address":{"address":"Wawelska, Warszawa, Polska","lat":"11.016608","lng":"76.940399"},"title":"O\u015bwi\u0119cim"}]';

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
            alert(i);
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
              var summaryPanel = document.getElementById('directions_panel');
              summaryPanel.innerHTML = '';
              // For each route, display summary information.
              for (var i = 0; i < route.legs.length; i++) {

                  var routeSegment = i + 1;
                  summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                  summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                  summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                  summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
              }
          }
      });
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  </script>
  <div id="map" style="border: 2px solid #3872ac;height:500px;"></div>




  </div>
  <div class="col-md-4">
    <div id="directions_panel"></div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
