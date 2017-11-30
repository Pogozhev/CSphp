<!DOCTYPE html>
<html>
  <head>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAU3XOPaAGyJzmNRAggy0mA167K06Cs4k&libraries=drawing&callback=main"></script>
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
    <div id="map"></div>
    <script>
      function addScript(src){
        var script = document.createElement('script');
        script.src = src;
        script.async = false; // чтобы гарантировать порядок
        document.head.appendChild(script);
      }
      function main(){
          // This example creates a triangular polygon with a hole in it.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 56.4404073, lng: 84.896531},
        });
        // Define the LatLng coordinates for the polygon's  outer path.
        /*var outerCoords = [
          {lat: 56.440861, lng: 84.878483},
          {lat: 56.435357, lng: 84.866467},
          {lat: 56.431845, lng: 84.87711},
          {lat: 56.428428, lng: 84.869728},
          {lat: 56.432984, lng: 84.900112},
        ];

        // Construct the polygon, including both paths.
        var bermudaTriangle = new google.maps.Polygon({
          paths: [outerCoords],
          strokeColor: '#FFC107',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FFC107',
          fillOpacity: 0.35
        });
        bermudaTriangle.setMap(map);*/


        // Создани множества полей из таблиц

        <?php
          function viewField($field_name){
            include('regFiles/bd.php');
            $coordinates = '';
              $result = $mysqli->query("SELECT * FROM test_field WHERE name = '$field_name'");
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $coordinates = $coordinates . "{lat: {$row['gisx']}, lng: {$row['gisy']}},";
                  }
              }
            echo "var outerCoords1 = [
              
              {$coordinates}

            ];

            // Construct the polygon, including both paths.
            var bermudaTriangle1 = new google.maps.Polygon({
              paths: [outerCoords1],
              strokeColor: '#FFC107',
              strokeOpacity: 0.8,
              strokeWeight: 2,
              fillColor: '#FFC107',
              fillOpacity: 0.35
            });
            bermudaTriangle1.setMap(map);"; 
          }

          // Уникальные имена
          function getNames(){
            include('regFiles/bd.php');
              $result = $mysqli->query("SELECT * FROM test_field");
              $test = [];
              $x = 0;
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $test[$x] = $row['name'];
                      $x++;
                      //$coordinates = $coordinates . "{lat: {$row['gisx']}, lng: {$row['gisy']}},";
                  }
                  return $test;
                  //var_dump($row['name']);
              }
          }
          $names = (array_unique(getNames()));
          foreach ($names as $key) {
            viewField($key);
          }
        ?> 

        // Define the LatLng coordinates for the polygon's  outer path.
        
        draw(map);
      }
      function draw(map){
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.MARKER,
            drawingControl: true,
            drawingControlOptions: {
              position: google.maps.ControlPosition.TOP_CENTER,
              drawingModes: ['polygon']
            },
            polygonOptions: {
              fillColor: 'black',
              fillOpacity: 0.8,
              strokeWeight: 2,
              strokeColor: 'black',
              clickable: true,
              editable: true,
              zIndex: 1
          }
          });
          drawingManager.setMap(map);
          var array = [];
          google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
            var table_name = prompt('Назовите поле!', 'some_field');
            alert('Название поля: ' + table_name);
            var table_crop = prompt('Что выращиваете?', 'Potato');
            alert('Название поля: ' + table_crop);
            for (var i = 0; i < polygon.getPath().getLength(); i++) {
              array[i] = polygon.getPath().getAt(i).toUrlValue(6).split(',');
              $.ajax({
              url: "addfield.php",
              type: "POST",
              headers: {
                  "Content-Type": "application/json; charset=utf-8",
              },
              contentType: "application/json",
              data: JSON.stringify({
                  "gisx": array[i][0],
                  "name": table_name,
                  "crop": table_crop,
                  "gisy": array[i][1]
              })
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
                //console.log(array[i]);
            }
          console.log(array);
      });
        }
     // function weather(lat,lon){
        // Request (GET http://api.openweathermap.org/data/2.5/weather)
    /*$.ajax({
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
    });
      }*/
      //initMap();
    </script>
  </body>
</html>