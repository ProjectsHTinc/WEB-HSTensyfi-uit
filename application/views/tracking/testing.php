<style>
th{
  width:50px;
}
.kms-btn{
  margin-top: 200px;
}
</style>

<div class="main-panel">
<div class="content">
  <div class="card">
    <div class="row">
      <div class="container">

<div class="col-md-8" style="padding:40px;">

  <div id="map" style="width:700px; height:400px;"></div>
     <script>

       // This example creates a 2-pixel-wide red polyline showing the path of
       // the first trans-Pacific flight between Oakland, CA, and Brisbane,
       // Australia which was made by Charles Kingsford Smith.

       function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
           zoom: 13,
           center: {lat: 11.002607699999999, lng:77.01696330000004},
           mapTypeId: 'terrain'
         });

         var flightPlanCoordinates = [];
         $(document).ready(function(){
         $.ajax({
             url: "<?php echo base_url(); ?>tracking/testing_map",
             dataType: "json",
              success: function(data) {
                  for(var i in data){
                      flightPlanCoordinates.push({ lat: data[i].latitude, lng: data[i].longitude });
                  }
                      }
         });
    });

         var flightPath = new google.maps.Polyline({
           path: flightPlanCoordinates,
           geodesic: true,
           strokeColor: '#FF0000',
           strokeOpacity: 2.0,
           strokeWeight: 2
         });

         flightPath.setMap(map);
       }
     </script>
     <script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkB1uZPZiEsekG45M2Ndq4FTEceFA2nXk&callback=initMap">
     </script>

  </div>
  <div class="col-md-4">
    <div class="kms-btn">
<button id="click" class="btn btn-primary">Show the KM</button>
</div>
  </div>
  <div class="col-md-10">

</div>

<div id="totals">
</div>
  </div>
  </div>
  </div>
  </div>
  </div>
