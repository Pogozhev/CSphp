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
  <!-- Main content ----------------------------------------------------------------->

  <section class="content">
    <hr>
    <?php
    //session_start();
    //var_dump($_SESSION['login']);
    //$_SESSION['login'] = 'manager_1';
      include('regFiles/bd.php');
      $result = $mysqli->query("SELECT * FROM people WHERE name = '".$_SESSION['login']."'");
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $rule = $row['rules'];
          }
      }
      if($rule == 'manager'){
        echo '<div class="embed-responsive embed-responsive-16by9" style="width: 100%;">
          <iframe class="embed-responsive-item" src="all_map.php"></iframe>
        </div>';
      }else{
        $result=$mysqli->query('select * from '.$_SESSION["login"].'');
        $num=mysqli_num_rows($result);
        if ($num>0){
          echo '<div class="embed-responsive embed-responsive-16by9" style="width: 100%;">
            <iframe class="embed-responsive-item" src="all_map.php"></iframe>
          </div>';
        }else{
          echo '<div class="embed-responsive embed-responsive-16by9" style="width: 100%;">
            <iframe  class="embed-responsive-item" src="new_map.php"></iframe>
          </div>';
        }
      }
    ?>
    <!-- /.row ---------------------------------------------------------------------->
  </section>
  <!-- /.content -->
</div>

   <!-- map -->
   <!-- /map -->



  <!-- /.content -->

<!-- /.content-wrapper -->
