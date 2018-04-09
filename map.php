<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CropSafe 1 | Главная</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/main.min.css">
    <!-- main Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAU3XOPaAGyJzmNRAggy0mA167K06Cs4k&libraries=drawing,geometry&callback=main"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Map</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      #field_table{
        /*height: 90%;*/
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
    <div id="field_table" class="col-md-3">
      <h1>Создай поле</h1>
      <input type="text" class="form-control" id="name_field" placeholder="Название поля">
      <div class="form-group">
        <label for="exampleFormControlSelect1">Цвет</label>
        <select class="form-control" id="exampleFormControlSelect1">
          <option>Красный</option>
          <option>Желтый</option>
          <option>Синий</option>
          <option>Черный</option>
          <option>Зеленый</option>
        </select>
      </div>
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">Площадь</div>
          <input type="text" disabled="true" class="form-control" id="square" value="0 га">
        </div>
      </div>
      <center>
        <button onclick="draw_type = 'draw_new'" class="btn btn-default btn-lg">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"> Draw</span>
        </button>
        <button onclick="draw_type = 'draw_hole'" class="btn btn-default btn-lg">
          <span class="glyphicon glyphicon-scissors" aria-hidden="true"> Cut</span>
        </button>
        <br>
        <br>
        <button class="btn btn-lg btn-primary">Продолжить</button>
      </center><br>
      <div style="border: 1px solid red;">
        <div style="padding: 3px;">
          <h3>Как отрисовать контур</h3><p>Нажмите на границу поля, чтобы начать его обрисовку</p>
          <img src="https://app.exactfarming.com/assets/img/add_polygon-6ad2f2d1cd3dfa802e8e53a73a74f8d9.gif" width="100%">
        </div>
      </div>
    </div>
    <div id="map" class="col-md-9"></div>
    <script>
   	var count = 0
    var all_fields = [];
   	var draw_type = 'draw_new'
    var square = 0
      function addScript(src){
        var script = document.createElement('script');
        script.src = src;
        script.async = false; // чтобы гарантировать порядок
        document.head.appendChild(script);
      }
      function main(){
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 56.4404073, lng: 84.896531},
        });
        /*var outerCoords = [
          {lat: 25.774, lng: -80.190},
          {lat: 18.466, lng: -66.118},
          {lat: 32.321, lng: -64.757}
        ];

        var innerCoords1 = [
          {lat: 25.745, lng: -68.300},
          {lat: 29.570, lng: -67.514},
          {lat: 27.339, lng: -66.668}
        ];

        var innerCoords = [
          {lat: 23.973, lng: -73.036},
          {lat: 22.803, lng: -68.334},
          {lat: 26.202, lng: -67.763}
        ];
        var bermudaTriangle = new google.maps.Polygon({
	         paths: [outerCoords],
	         strokeColor: '#FFC107',
	         strokeOpacity: 0.8,
	         strokeWeight: 2,
	         fillColor: '#FFC107',
	         fillOpacity: 0.35
	       });*/
        // Construct the polygon, including both paths.



        // Создани множества полей из таблиц
		    //bermudaTriangle.setMap(map);
        // Define the LatLng coordinates for the polygon's  outer path.
        draw(map);
      }
      function main1(){
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 56.4404073, lng: 84.896531},
        });
        if(draw_type == 'draw_new'){
          for (var i = 0; i < all_fields.length; i++) {
            if(all_fields[i][1] !== undefined){
              map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0], all_fields[i][1]])})
              console.log('This fucking shit');
            }else{
              var as = map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0]])})
              var fucking_shit_motherfucker = new google.maps.Polygon({
      	         paths: [all_fields[i][0]],
      	         strokeColor: '#FFC107',
      	         strokeOpacity: 0.8,
      	         strokeWeight: 2,
      	         fillColor: '#FFC107',
      	         fillOpacity: 0.35
      	       });
              square = (google.maps.geometry.spherical.computeArea(fucking_shit_motherfucker.getPath())/10000).toFixed(2)
              document.getElementById('square').value = square + ' га'
            }
            //map.data.add({geometry: new google.maps.Data.Polygon([all_fields[0][0], all_fields[1][1]])})
          }
          //count += 1
        }else{
          for (var i = 0; i < all_fields.length; i++) {
            if(all_fields[i][1] !== undefined){
              var fucking_shit_motherfucker = new google.maps.Polygon({
      	         paths: [all_fields[i][1]],
      	         strokeColor: '#FFC107',
      	         strokeOpacity: 0.8,
      	         strokeWeight: 2,
      	         fillColor: '#FFC107',
      	         fillOpacity: 0.35
      	       });
              tmp = google.maps.geometry.spherical.computeArea(fucking_shit_motherfucker.getPath())/10000
              tmp = tmp.toFixed(2)
              square -= tmp
              document.getElementById('square').value = square.toFixed(2) + ' га'
              map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0], all_fields[i][1]])})
              console.log('This fucking shit');
            }else{
              map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0]])})
            }
            //map.data.add({geometry: new google.maps.Data.Polygon([all_fields[0][0], all_fields[1][1]])})
          }
          //map.data.add({geometry: new google.maps.Data.Polygon([all_fields[0][0], innerCoords1])})
        }
        draw(map)
      }
      function draw(map){
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
              position: google.maps.ControlPosition.TOP_CENTER,
              drawingModes: ['polygon']
            },
            polygonOptions: {
              fillColor: 'red',
              fillOpacity: 0.8,
              strokeWeight: 2,
              strokeColor: 'red',
              clickable: true,
              editable: true,
              zIndex: 1
          }
          });
          drawingManager.setMap(map);
          var array = [];
          google.maps.event.addListener(drawingManager, 'polygoncomplete', function (polygon) {
          	if(draw_type == 'draw_new'){
              var outerCoords = []
              for (var i = 0; i < polygon.getPath().getLength(); i++) {
                array[i] = polygon.getPath().getAt(i).toUrlValue(6).split(',')
                outerCoords[i] = {lat: parseFloat(array[i][0], 10), lng: parseFloat(array[i][1], 10)}
                console.log(array[i][0])
              }
              all_fields[count] = []
              all_fields[count][0] = outerCoords
              //console.log(all_fields);
              main1()
              count += 1
              //console.log(count);
          	}else{
              var innerCoords = []
              for (var i = 0; i < polygon.getPath().getLength(); i++) {
                array[i] = polygon.getPath().getAt(i).toUrlValue(6).split(',')
                innerCoords[i] = {lat: parseFloat(array[i][0], 10), lng: parseFloat(array[i][1], 10)}
                console.log(array[i][0])
              }
              //all_fields[count-1] = []
              all_fields[count-1][1] = innerCoords
              console.log(all_fields);
              main1()
              console.log(innerCoords)
              //console.log(array);
          	}
          	//alert(draw_type)
          });
        }
    </script>
  </body>
</html>
