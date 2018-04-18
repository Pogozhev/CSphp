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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <style>
    #field{
      height: 625px;
    }
  </style>
</head>
<body>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Панель мониторинга культур
        <small>Версия 0.1</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Дом</a></li>
        <li class="active">Панель мониторинга культур</li>
      </ol>
    </section>
    <div class="cont">
      <div class="rowq">
      <div class="panel panel-default col-md-5 qwe" id="weather" style="margin-left: 4.5%; margin-top: 80px;">
        <div class="panel-body"><h4>Погода</h4></div>
        <div>
          <?php
            include('regFiles/bd.php');
            //$req = file_get_contents('https://api.darksky.net/forecast/de7110e6266a554bf34c89f2bf9d85a5/56.4138,84.9264?lang=ru');
            $arr = json_decode($req);
            $days = [];
            $table_string = "<table class='table'><tbody>";
            $day_count = 0;
            foreach ($arr->daily->data as $key) {
              $date = strtotime("+{$day_count} day");
              $temp_0 = number_format(($key->temperatureHigh - 32)*5/9, 2);
              $temp_1 = number_format(($key->temperatureLow - 32)*5/9, 2);
              $temp = ($temp_0 + $temp_1)/2;
              $wind = $key->windSpeed;
              array_push($days, $temp);
              $table_string .= "<tr><td><img src='svg/wi-day-fog.svg' width='50px'></td><td><div style='margin-left: 100px;'>".date('l j F', $date)."<br><p style='margin-left: 25px;'>{$temp}°C</p></div></td><td>{$wind} m/s</td></tr>";
              $day_count++;
            }
            echo $table_string . "</tbody></table>";
            //var_dump($days);
          ?>
        </div>
      </div>
      <div class="panel panel-default col-md-6 qwe" id="field" style="margin-top: 80px; margin-left: 10px;">
        <div class="panel-body"><h4>Поля</h4><hr></div>
        <!-- 16:9 aspect ratio -->
        <div class="embed-responsive embed-responsive-16by9">
          <iframe class="embed-responsive-item" scrolling="no" src="http://localhost/CSphp1/chart/index.html"></iframe>
        </div>
        <div>
        </div>
      </div>
      </div>
    </div>
  </body>
  </html>
