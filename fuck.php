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
      /*session_start();
      include('regFiles/bd.php');
      $q = $mysqli->query("SELECT * FROM ".$_SESSION['login']."");
      if (mysql_num_rows($q)==0){
          $ebuchaya_ditch = 'true';
      }else{
          $ebuchaya_ditch = 'false';
      }*/
      echo "<script>alert(".$_SESSION['login'].")</script>";
    ?>
    <div class="embed-responsive embed-responsive-16by9" style="width: 100%;">
      <iframe class="embed-responsive-item" src="new_map.php"></iframe>
    </div>

    <!-- /.row ---------------------------------------------------------------------->




  </section>
  <!-- /.content -->
</div>

   <!-- map -->
   <!-- /map -->



  <!-- /.content -->

<!-- /.content-wrapper -->
