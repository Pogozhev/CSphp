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
          $names = (array_unique(getNames()));
          foreach ($names as $key) {
            echo "Поле: " . $key;echo "<hr><br>";
          }
        ?>
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
