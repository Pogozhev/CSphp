<?php
session_start();
$login = $_SESSION['login'];

header("Content-Type: application/json");
$v = json_decode(stripslashes(file_get_contents("php://input")));
$v = json_decode(stripslashes($_GET["data"]));

include('regFiles/bd.php');

$field_name = $v[1];
$square = $v[2];
$culture = $v[3];
$outer_coords = [];
$inner_coords = [];
// outerCoords

//var_dump($v[0]);

// outerCoords
$x = 0;
$query = "INSERT INTO `".$login."` (name, gisx, gisy, square, crop) VALUES ";
foreach ($v[0][0] as $mrazota) {
  $query .= "('".$field_name."', '".$mrazota->lat."', '".$mrazota->lng."', '".$square."', '".$culture."'),";
}
$i = 0;
// innerCoords
if(count($v[0]) > 2){
  foreach ($v[0] as $key) {
    if($i !== 0){
      $x = 0;
      foreach ($key as $suka) {
        $inner_coords[$i-1][0][$x] = $suka->lat;
        $inner_coords[$i-1][1][$x] = $suka->lng;
        $query .= "('".$field_name."_inner_".$i."', '".$mrazota->lat."', '".$mrazota->lng."', '".$square."', '".$culture."'),";
        $x++;
      }
    }
    $i++;
  }
}

$query = rtrim($query,", ");
$result = $mysqli->query($query);
if($result){
  echo "good";
}else{
  echo "bad";
}
?>
