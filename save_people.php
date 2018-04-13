<?php
  // удаляю старую строчку в people
  // вставляю новую
  // переименовываю таблицу с полями
  // если новое название не соответствует старому - заменяю на новое во всех строках столбца companys
  // сохраняю пароль и новому нейму даю старый пароль
  header("Content-Type: application/json");
  // build a PHP variable from JSON sent using POST method
  $v = json_decode(stripslashes(file_get_contents("php://input")));
  // build a PHP variable from JSON sent using GET method
  $v = json_decode(stripslashes($_GET["data"]));
  // encode the PHP variable to JSON and send it back on client-side

  include('regFiles/bd.php');
  var_dump($v);
  $result = $mysqli->query("SELECT * FROM people WHERE name = '".$v[1]."'");
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $password = $row['password'];
        $name = $row['name'];
        echo $name;
      }
  }
  $result = $mysqli->query("DELETE FROM `people` WHERE  name = '".$v[1]."'");
  $result = $mysqli->query("RENAME TABLE  `".$name."` TO  `".$v[1]."`");
  $result = $mysqli->query("INSERT INTO people (name, mail, mobile, rules, password) VALUES ('".$v[1]."','".$v[2]."','".$v[3]."','".$v[4]."','".$password."');");
  if($result){
    echo "good";
  }else{
    echo "bad";
  }
?>
