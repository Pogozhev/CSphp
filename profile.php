    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="cropsafe.html"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">Александр Погожев</h3>

              <p class="text-muted text-center">Software Engineer</p>


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About account Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Аккаунт</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Права аккаунта </strong>
              <?php
                include('regFiles/bd.php');
                $result = $mysqli->query("SELECT * FROM people WHERE name = '".$_SESSION['login']."'");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      $rules = $row['rules'];
                      $companys = $row['companys'];
                    }
                }
                switch ($rules) {
                  case 'admin':

                    break;
                  case 'manager':
                    # code...
                    break;
                  case 'company':
                    # code...
                    break;
                  default:
                    # code...
                    break;
                }
                echo $rules;
              ?>
              <p class="text-muted">

              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Расположение</strong>

              <p class="text-muted">Россия, Томск</p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i>Культуры</strong>

              <p>
                <span class="label label-success">Пшеница озимая</span>
                <span class="label label-success">Картофель</span>
                <span class="label label-success">Озимая рожь</span>
                <span class="label label-success">Яровая пшеница</span>
                <span class="label label-success">Рожь</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Памятка</strong>

              <p>Вы тут царь и Бог творите, что хотите !!! </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div>
            <table class="table table-hover">
              <tr>
                <td><b>#</b></td>
                <td><b>Имя</b></td>
                <td><b>Email</b></td>
                <td><b>Телефон</b></td>
                <td><b>Права</b></td>
                <td><b>Компании</b></td>
              </tr>
              <?php
                include('regFiles/bd.php');
                $result = $mysqli->query("SELECT * FROM people");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      //echo $row['id'];
                      $tmp = '<tr onclick="change_info(`'.$row["id"].'`,`'.$row["name"].'`,`'.$row["mail"].'`,`'.$row["mobile"].'`,`'.$row["rules"].'`,`'.$row["companys"].'`)"><td>'.$row["id"].'</td><td>'.$row["name"]
                      .'</td><td>'.$row["mail"].'</td><td>'.$row["mobile"].'</td><td>'.$row["rules"].'</td><td>'.$row["companys"].'</td></td>';
                      echo $tmp;
                    }
                }//
              ?>
            </table>
            <div class="modal fade" style="margin-top: 5%;" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" style="width: 300px;">
                <div class="modal-body">
                  <div class="row" style="width: 500px; height: 500px; border-radius: 5%; background-color: white;">
                    <h1 style="margin-top: 15px; margin-left: 15px;"><b>Редактировать: </b></h1><hr>
                    <div style="margin-top: 15px; margin-left: 15px;">
                      <input class="name" id="name" type="text" value="Admin">
                      <input style="margin-top: 15px;" class="name" id="email" type="text" value="test@test.ru">
                      <input style="margin-top: 15px;" class="name" id="mobile" type="text" value="2281337">
                      <select id="rules" style="margin-top: 15px; width: 400px;" class="form-control">
                        <option>admin</option>
                        <option>manager</option>
                        <option>company</option>
                      </select><hr>
                      <p style="margin-top: 15px;"><b>Companys:</b></p>
                      <div style="margin-top: 15px;" class="checkbox">
                        <?php
                          include('regFiles/bd.php');
                          $result = $mysqli->query("SELECT * FROM people");
                          if ($result->num_rows > 0) {
                              while($row = $result->fetch_assoc()) {
                                if($row['rules'] == 'company'){
                                  echo '<label>
                                    <input type="checkbox" value="">
                                    '.$row["name"].'
                                  </label>';
                                }
                              }
                          }
                        ?>
                      </div>
                      <hr>
                      <center><button onclick="save_data()" class="btn btn-lg btn-success">Сохранить</button></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <style>
            .name{
              font-size: 2.5em;
              border: 0;
              -webkit-box-shadow: inset 0 1px 1px rgba(255, 255, 255, .255);
                      box-shadow: inset 0 1px 1px rgba(255, 255, 255, .255);
              -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                   -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                      transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            }
            .name:focus{
              border: 0;
              border-color: white;
              outline: 0;
              -webkit-box-shadow: inset 0 1px 1px rgba(255,255,255,.255), 0 0 8px rgba(255, 255, 255, .6);
                      box-shadow: inset 0 1px 1px rgba(255,255,255,.255), 0 0 8px rgba(255, 255, 255, .6);

            }
          </style>
          <script>
              var array = [];
              var id_global = 0;
              function save_data(){
                array.push(id_global)
                array.push(document.getElementById('name').value)
                array.push(document.getElementById('email').value)
                array.push(document.getElementById('mobile').value)
                array.push(document.getElementById('rules').value)
                console.log(array);
                var xhr = new XMLHttpRequest();
                var url = "/save_people.php?data=" + encodeURIComponent(JSON.stringify(array));
                xhr.open("GET", url, true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log(xhr.responseText);
                        if(xhr.responseText == 'good'){
                          location.reload();
                        }
                    }
                };
                xhr.send();
              }
              function change_info(id, name, mail, mobile, rules, companys){
                id_global = id;
                document.getElementById('name').value = name;
                document.getElementById('email').value = mail;
                document.getElementById('rules').value = rules;
                document.getElementById('mobile').value = mobile;
                //alert(rules);
                $('#myModal').modal('show');
              }
            </script>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
