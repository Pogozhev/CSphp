<!DOCTYPE html>
<html>
  <head>
        <?php
      if(isset($_GET['type'])){
        if($_GET['type'] == 'cut'){
          echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAU3XOPaAGyJzmNRAggy0mA167K06Cs4k&libraries=drawing"></script>';
        }
        if($_GET['type'] == 'select'){
          echo '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAU3XOPaAGyJzmNRAggy0mA167K06Cs4k&libraries=drawing&callback=main"></script>';
        } 
      }
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 90%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <form action="#" method="GET"><input type="hidden" name="type" value="cut"><button type="submit">Cut</button></form>
    <form action="#" method="GET"><input type="hidden" name="type" value="select"><button type="submit">Select</button></form>
    <button onclick="color_change('red')">Red</button>
    <button onclick="color_change('green')">Green</button>
    <button onclick="color_change('blue')">Blue</button>
    <div id="map"></div>
    <script>
      function main(){
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 11,
              center: {lat: 56.4650333, lng: 84.9575614},
          });
          select(map);
          return map;
      }
      var color = 'black';
      function color_change(change_color){
        color = change_color;
        select(map);
      }
      function select(map, color){
           var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.MARKER,
            drawingControl: true,
            drawingControlOptions: {
              position: google.maps.ControlPosition.TOP_CENTER,
              drawingModes: ['polygon']
            },
            polygonOptions: {
              fillColor: color,
              fillOpacity: 0.8,
              strokeWeight: 2,
              strokeColor: color,
              clickable: true,
              editable: true,
              zIndex: 1
          }
          });
          drawingManager.setMap(map);
          var array = [];
          google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
            for (var i = 0; i < polygon.getPath().getLength(); i++) {
              array[i] = polygon.getPath().getAt(i).toUrlValue(6).split(',');
                //console.log(array[i]);
            }
          console.log(array);
          weather(array[0][0], array[0][1]);
              array = [];
          });
      } 
      function initMap() {
         var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
          },
          polygonOptions: {

            zIndex: 1
        }
        });
        drawingManager.setMap(map);
        var array = [];
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
          for (var i = 0; i < polygon.getPath().getLength(); i++) {
            array[i] = polygon.getPath().getAt(i).toUrlValue(6).split(',');
              //console.log(array[i]);
          }
          //console.log(parseFloat(array[0][0]));
            polygon.setMap(null);
            test(array);
        console.log(array);
            array = [];
        });
        function test(array){
          var outerCoords = [
          {lat: 25.774, lng: -80.190},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757}
        ];
          weather(array[0][0],array[0][1]);
          var innerCoords = [
            {lat: parseFloat(array[0][0]), lng: parseFloat(array[0][1])},
            {lat: parseFloat(array[1][0]), lng: parseFloat(array[1][1])},
            {lat: parseFloat(array[2][0]), lng: parseFloat(array[2][1])}
          ];
        var bermudaTriangle = new google.maps.Polygon({
          paths: [outerCoords, innerCoords],
          strokeColor: '#FFC107',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#000000',
          fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);
        }
        //console.log(array);
      }
      function weather(lat,lon){
        // Request (GET http://api.openweathermap.org/data/2.5/weather)
    $.ajax({
        url: "http://api.openweathermap.org/data/2.5/weather",
        type: "GET",
        data: {
            "lat": lat,
            "lon": lon,
            "appid": "ab61ea89ff98bda8da4d1a89fa7fa899",
        },
    })
    .done(function(data, textStatus, jqXHR) {
        console.log("HTTP Request Succeeded: " + jqXHR.status);
        console.log(data);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log("HTTP Request Failed");
    })
    .always(function() {
        /* ... */
    });
      }
      //initMap();
    </script>
  </body>
</html>