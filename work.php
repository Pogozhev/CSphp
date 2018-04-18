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
    <div class="row">
      <center><div id="field_table" class="col-md-4">
        <h1>1 день</h1>
        <input type="text" class="form-control" id="tmax1" placeholder="Максимальная температура"><br>
        <input type="text" class="form-control" id="tmin1" placeholder="Минимальная температура">
        <div class="radio">
          <label>
            <input type="radio" onclick="document.getElementById('osadki1').style.display = 'block';" name="optionsRadios1" id="osadki_1" value="option1">
            Осадки были
          </label>
        </div>
        <div class="radio">
          <label>
            <input onclick="document.getElementById('osadki_mm').style.display = 'none';" type="radio" name="optionsRadios1" id="osadki_0" value="option2" checked>
            Осадков не было
          </label>
        </div>
        <input style="display: none" type="text" class="form-control" id="osadki1" placeholder="Осадки в мм"><br>
        <center>

        </center><br>
      </div>
      <div id="field_table" class="col-md-4">
        <h1>2 день</h1>
        <input type="text" class="form-control" id="tmax2" placeholder="Максимальная температура"><br>
        <input type="text" class="form-control" id="tmin2" placeholder="Минимальная температура">
        <div class="radio">
          <label>
            <input type="radio" onclick="document.getElementById('osadki2').style.display = 'block';" name="optionsRadios2" id="osadki_2" value="option1">
            Осадки были
          </label>
        </div>
        <div class="radio">
          <label>
            <input onclick="document.getElementById('osadki_mm').style.display = 'none';" type="radio" name="optionsRadios2" id="osadki_0" value="option2" checked>
            Осадков не было
          </label>
        </div>
        <input style="display: none" type="text" class="form-control" id="osadki2" placeholder="Осадки в мм"><br>
        <center>

        </center><br>
      </div>
      <div id="field_table" class="col-md-4">
        <h1>3 день</h1>
        <input type="text" class="form-control" id="tmax3" placeholder="Максимальная температура"><br>
        <input type="text" class="form-control" id="tmin3" placeholder="Минимальная температура">
        <div class="radio">
          <label>
            <input type="radio" onclick="document.getElementById('osadki3').style.display = 'block';" name="optionsRadios3" id="osadki_3" value="option1">
            Осадки были
          </label>
        </div>
        <div class="radio">
          <label>
            <input onclick="document.getElementById('osadki_mm').style.display = 'none';" type="radio" name="optionsRadios3" id="osadki_0" value="option2" checked>
            Осадков не было
          </label>
        </div>
        <input style="display: none" type="text" class="form-control" id="osadki3" placeholder="Осадки в мм"><br>
        <center>

        </center><br>
      </div></center>
    </div>
    <center><div class="row">
      <div id="field_table" class="col-md-4">
        <h1>4 день</h1>
        <input type="text" class="form-control" id="tmax4" placeholder="Максимальная температура"><br>
        <input type="text" class="form-control" id="tmin4" placeholder="Минимальная температура">
        <div class="radio">
          <label>
            <input type="radio" onclick="document.getElementById('osadki4').style.display = 'block';" name="optionsRadios4" id="osadki_4" value="option1">
            Осадки были
          </label>
        </div>
        <div class="radio">
          <label>
            <input onclick="document.getElementById('osadki_mm').style.display = 'none';" type="radio" name="optionsRadios4" id="osadki_0" value="option2" checked>
            Осадков не было
          </label>
        </div>
        <input style="display: none" type="text" class="form-control" id="osadki4" placeholder="Осадки в мм"><br>
        <center>

        </center><br>
      </div>
      <div id="field_table" class="col-md-4">
        <h1>5 день</h1>
        <input type="text" class="form-control" id="tmax5" placeholder="Максимальная температура"><br>
        <input type="text" class="form-control" id="tmin5" placeholder="Минимальная температура">
        <div class="radio">
          <label>
            <input type="radio" onclick="document.getElementById('osadki5').style.display = 'block';" name="optionsRadios5" id="osadki_5" value="option1">
            Осадки были
          </label>
        </div>
        <div class="radio">
          <label>
            <input onclick="document.getElementById('osadki_mm').style.display = 'none';" type="radio" name="optionsRadios5" id="osadki_0" value="option2" checked>
            Осадков не было
          </label>
        </div>
        <input style="display: none" type="text" class="form-control" id="osadki5" placeholder="Осадки в мм"><br>
        <center>
        </center><br>
      </div>
    </div></center>
    <center><button onclick="yes()" class="btn btn-lg btn-success">Отправить</button></center>
  </body>
  <script>
  var myArray = [];
  var osadki = [];
  var e1;
  function yes(){
    D2 = document.getElementById('tmax1').value
    D3 = document.getElementById('tmax2').value
    D4 = document.getElementById('tmax3').value
    D5 = document.getElementById('tmax4').value
    D6 = document.getElementById('tmax5').value
    for (var i = 1; i < 6; i++) {
      myArray.push(document.getElementById('tmin'+i).value)
    }
    console.log(myArray);
    C2 = myArray[0];
    max = C2;
    for (i = 1; i < myArray.length; ++i) {
        if (myArray[i] < C2) C2 = myArray[i];
    }
    for (var i = 1; i < 6; i++) {
      if(document.getElementById('osadki_'+i).checked){
        osadki.push(1)
      }else{
        osadki.push(0)
      }
    }
    C2 = document.getElementById('tmin1').value
    C3 = document.getElementById('tmin2').value
    C4 = document.getElementById('tmin3').value
    C5 = document.getElementById('tmin4').value
    C6 = document.getElementById('tmin5').value
    E2 = osadki[0]
    E3 = osadki[1]
    E4 = osadki[2]
    E5 = osadki[3]
    E6 = osadki[4]
    y1 = 0.75 * D2 + 0.41 * D3 + 0.41 * D4 + 0.27 * D5 + 0.74 *D6 + 0.3 *C2 - 0.07 * C3 - 0.16 * C4 + 0.06 * C5 + 0.01 * C6 + 2.88 * E2 + 1.98 * E3 + 1.98 * E4 + 1.79 * E5 + 0.53 * E6-32.47;
    y2 = 0.63 * D2 + 0.37 * D3 + 0.49 * D4 + 0.22 * D5 + 0.65 * D6 + 0.24 *C2 - 0.06 * C3- 0.15 * C4 - 0.135 * C5 + 0.15 * C6 + 4.88 * E2 + 3.55 * E3 + 3.34 *E4 + 2.5 * E5 + 2.29 *E6-31.34;
    console.log(y1);
    console.log(y2);
    if(y1<y2){
     //alert('Возможно заражение!');
     var xhr = new XMLHttpRequest();
     var url = "http://cropsafe.ru//send_message.php?q=1";
     xhr.open("GET", url, true);
     xhr.setRequestHeader("Content-Type", "application/json");
     xhr.onreadystatechange = function () {
         if (xhr.readyState === 4 && xhr.status === 200) {
             console.log(xhr.responseText);
         }
     };
     xhr.send();
    }else{
      var xhr = new XMLHttpRequest();
      var url = "http://cropsafe.ru//send_message.php?q=0";
      xhr.open("GET", url, true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText);
          }
      };
      xhr.send();
      //alert('Заражения не будет')
    }
  }
  </script>
</html>
