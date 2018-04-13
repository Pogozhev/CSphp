<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAU3XOPaAGyJzmNRAggy0mA167K06Cs4k&libraries=geometry&callback=main"></script>
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
    <div id="field_table" class="col-md-4">
      <table class="table">
      <?php
        session_start();
        $_SESSION['login'] = 'manager_1';
        $login = $_SESSION['login'];
        function getNames(){
          include('regFiles/bd.php');
            $result = $mysqli->query("SELECT * FROM ".$login."");
            $test = [];
            $x = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $test[$x] = $row['name'];
                    $x++;
                }
                return $test;
            }
        }
        //$_SESSION['login'] = 'manager_1';
        include('regFiles/bd.php');
        $result = $mysqli->query("SELECT * FROM people WHERE name = '".$_SESSION['login']."'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $rules = $row['rules'];
              $companys = $row['companys'];
            }
        }
        if($rules !== 'manager'){
          $_SESSION['companys'] = 0;
          $result = $mysqli->query("SELECT * FROM ".$login."");
          $test = [];
          $x = 0;
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  $test[$x] = $row['name'];
                  $x++;
              }
          }
          $names = (array_unique($test));
          $fields = [];
          $i = 0;
          foreach ($names as $key) {
            $tmp_array = explode("_", $key);
            $fields[$i] = $tmp_array;
            $i++;
          }
          $view_field = [];
          $tmp = "";
          foreach ($fields as $key) {
            if($key[0] !== $tmp){
              $result = $mysqli->query("SELECT square FROM ".$login." WHERE name = '".$key[0]."'");
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $square= $row['square'];
                  }
              }
              echo '<tr><td><span style="display: inline-block;" class="glyphicon glyphicon-grain" aria-hidden="true"></span></td><td><h3 style="display: inline-block;"><b>'.$key[0].'</b></h3></td><td><h3 style="display: inline-block; padding-right: 10px;;">'.$square.'</h3>га</td></tr>';
            }
            $tmp = $key[0];
          }
        }else{
          $companys = explode(',', $companys);
          $_SESSION['companys'] = $companys;
          foreach ($companys as $var) {
            echo '<button type="button" class="btn btn-default btn-lg btn-block">'.$var.'</button>';
            $login = $var;
            $result = $mysqli->query("SELECT * FROM ".$login."");
            $test = [];
            $x = 0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $test[$x] = $row['name'];
                    $x++;
                }
            }
            $names = (array_unique($test));
            $fields = [];
            $i = 0;
            foreach ($names as $key) {
              $tmp_array = explode("_", $key);
              $fields[$i] = $tmp_array;
              $i++;
            }
            $view_field = [];
            $tmp = "";
            foreach ($fields as $key) {
              if($key[0] !== $tmp){
                $result = $mysqli->query("SELECT square FROM ".$login." WHERE name = '".$key[0]."'");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $square= $row['square'];
                    }
                }
                echo '<tr><td><span style="display: inline-block;" class="glyphicon glyphicon-grain" aria-hidden="true"></span></td><td><h3 style="display: inline-block;"><b>'.$key[0].'</b></h3></td><td><h3 style="display: inline-block; padding-right: 10px;;">'.$square.'</h3>га</td></tr>';
              }
              $tmp = $key[0];
            }
          }
          //var_dump($companys);
        }

        //var_dump($fields[6][0]);

        //echo $_SESSION['login'];
      ?>
    </table>
    </div>
    <div id="map" class="col-md-8"></div>
    <script>
      function main(){
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 56.4404073, lng: 84.896531},
          mapTypeId: 'satellite'
        });

        <?php
          $login = $_SESSION['login'];
          //var_dump($_SESSION['companys']);
          function viewField($login, $field_name, $type, $now_inner){
            //$login = $_SESSION['login'];
            include('regFiles/bd.php');
            //echo $field_name;
            $coordinates = '';
              $result = $mysqli->query("SELECT * FROM ".$login." WHERE name = '$field_name'");
              if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $coordinates = $coordinates . "{lat: {$row['gisx']}, lng: {$row['gisy']}},";
                }
              }
              if($type == 'outer'){
                $coordinates = rtrim($coordinates,", ");
                echo "var outerCoords = [{$coordinates}]; ";
              }else{
                $coordinates = rtrim($coordinates,", ");
                echo "var innerCoords_{$now_inner} = [{$coordinates}]; ";
              }
            }
            if($_SESSION['companys'] !== 0){
              foreach ($_SESSION['companys'] as $login) {
                $result = $mysqli->query("SELECT * FROM ".$login."");
                $test = [];
                $x = 0;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $test[$x] = $row['name'];
                        $x++;
                    }
                }
                  $names = (array_unique($test));
                  $fields = [];
                  $i = 0;
                  foreach ($names as $key) {
                    $tmp_array = explode("_", $key);
                    $fields[$i] = $tmp_array;
                    $i++;
                  }
                  $tmp = "";
                  $inner_coords = [];
                  $i = 0;
                  $now_inner = 0;
                  foreach ($fields as $key) {
                    if($key[0] == $tmp){
                      $name_un = (implode("_",$key));
                      $inner_coords[$now_inner] = ((viewField($login, $name_un, 'inner', $now_inner)));
                      $now_inner++;
                    }else{
                      if($i !== 0){
                        $map_add = "map.data.add({geometry: new google.maps.Data.Polygon([outerCoords,";
                        for ($j=0; $j < $now_inner; $j++) {
                          $map_add .= " innerCoords_{$j}, ";
                        }
                        $map_add = rtrim($map_add,", ");
                        $map_add .= '])}); ';
                        echo $map_add;
                        //echo "map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0]])})";
                        $name_un = (implode("_",$key));
                        echo(viewField($login, $name_un, 'outer', 228));
                        $now_inner = 0;
                      }else{
                        $name_un = (implode("_",$key));
                        echo(viewField($login, $name_un, 'outer', 228));
                      }
                    }
                    $tmp = $key[0];
                    $i++;
                  }
                  $map_add = "map.data.add({geometry: new google.maps.Data.Polygon([outerCoords,";
                  for ($j=0; $j < $now_inner; $j++) {
                    $map_add .= "innerCoords_{$j},";
                  }
                  $map_add = rtrim($map_add,", ");
                  $map_add .= '])}); ';
                  echo $map_add;
              }
            }else{
              $result = $mysqli->query("SELECT * FROM ".$login."");
              $test = [];
              $x = 0;
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $test[$x] = $row['name'];
                      $x++;
                  }
              }
                $names = (array_unique($test));
                $fields = [];
                $i = 0;
                foreach ($names as $key) {
                  $tmp_array = explode("_", $key);
                  $fields[$i] = $tmp_array;
                  $i++;
                }
                $tmp = "";
                $inner_coords = [];
                $i = 0;
                $now_inner = 0;
                foreach ($fields as $key) {
                  if($key[0] == $tmp){
                    $name_un = (implode("_",$key));
                    $inner_coords[$now_inner] = ((viewField($name_un, 'inner', $now_inner)));
                    $now_inner++;
                  }else{
                    if($i !== 0){
                      $map_add = "map.data.add({geometry: new google.maps.Data.Polygon([outerCoords,";
                      for ($j=0; $j < $now_inner; $j++) {
                        $map_add .= " innerCoords_{$j}, ";
                      }
                      $map_add = rtrim($map_add,", ");
                      $map_add .= '])}); ';
                      echo $map_add;
                      //echo "map.data.add({geometry: new google.maps.Data.Polygon([all_fields[i][0]])})";
                      $name_un = (implode("_",$key));
                      echo(viewField($name_un, 'outer', 228));
                      $now_inner = 0;
                    }else{
                      $name_un = (implode("_",$key));
                      echo(viewField($name_un, 'outer', 228));
                    }
                  }
                  $tmp = $key[0];
                  $i++;
                }
                $map_add = "map.data.add({geometry: new google.maps.Data.Polygon([outerCoords,";
                for ($j=0; $j < $now_inner; $j++) {
                  $map_add .= "innerCoords_{$j},";
                }
                $map_add = rtrim($map_add,", ");
                $map_add .= '])}); ';
                echo $map_add;
            }
          ?>

        //document.getElementById('cut').disabled = true;
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
        //draw(map);
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
        }
    </script>




    <script>

    </script>
  </body>
</html>
