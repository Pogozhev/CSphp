  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Поля
        <small>Версия 0.1</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Дом</a></li>
        <li class="active">Поля</li>
      </ol>
    </section>

    <!-- Main content -->
   
      <div align="top" style="height: 100%; width: 30%; display: inline-block; vertical-align: top; min-height: 700px;">
        <center><hr><?php
          include('regFiles/bd.php');
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
          // Координаты для погоды
          function getCrop($name){
            include('regFiles/bd.php');
              $result = $mysqli->query("SELECT * FROM test_field WHERE name = '$name'");
              $test = [];
              $x = 0;
              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                      $test[$x] = $row['crop'];
                      $x++;
                      //$coordinates = $coordinates . "{lat: {$row['gisx']}, lng: {$row['gisy']}},";
                  }
                  return $test;
                  //var_dump($row['name']);
              }
          }
          $names = (array_unique(getNames()));
          //$crop = getCrop();
          foreach ($names as $key) {
            echo "Поле: " . $key;echo "<h1>-10˚</h1><br>";
            echo "Культура: " . getCrop($key)[0];echo "<hr><br>";
            //echo ("<script>var lat = ".getCoordinate($key)[0]."; var lon = ".getCoordinate($key)[1]." weather(lat,lon);</script>");
          }
        ?>
        <script type="text/javascript">
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

        </script>
      </center>
      </div>
      <div align="right" style="width: 69%; display: inline-block; margin-top: 19px;">
        <iframe style="min-height: 700px; max-height: 1400px;" width="100%" src="map.php" frameborder="0" style="border:0;" allowfullscreen></iframe>
      </div>
      <?php
        if(isset($_GET['mapping'])){
          include('bd');
          $result = $mysqli->query("CREATE TABLE `cropsafe`.`".$_SESSION['login']."_field` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `gisx` FLOAT NOT NULL , `gisy` FLOAT NOT NULL , `square` FLOAT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
          if($result){
            echo "<script>alert('good')</script>";
          }
        }
        /*
  CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)
        */
      ?>
     <!-- map -->
     <!-- /map -->
      
      
      
    <!-- /.content -->
  
  <!-- /.content-wrapper -->
