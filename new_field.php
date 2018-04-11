<?php
session_start();
$login = $_SESSION['login'];
//echo $login;
// Handling data in JSON format on the server-side using PHP
//
header("Content-Type: application/json");
// build a PHP variable from JSON sent using POST method
$v = json_decode(stripslashes(file_get_contents("php://input")));
// build a PHP variable from JSON sent using GET method
$v = json_decode(stripslashes($_GET["data"]));
// encode the PHP variable to JSON and send it back on client-side

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
foreach ($v[0][0] as $key) {
  $query .= "('".$field_name."', '".$key->lat."', '".$key->lng."', '".$square."', '".$culture."'),";
}
$i = 0;
// innerCoords
if(count($v[0]) > 1){
  foreach ($v[0] as $key) {
    if($i !== 0){
      $x = 0;
      //var_dump($key);
      foreach ($key as $var) {
        $inner_coords[$i-1][0][$x] = $var->lat;
        $inner_coords[$i-1][1][$x] = $var->lng;
        $query .= "('".$field_name."_inner_".$i."', '".$var->lat."', '".$var->lng."', '".$square."', '".$culture."'),";
        $x++;
      }
    }
    $i++;
  }
}
var_dump($inner_coords);
echo count($v[0]);
$query = rtrim($query,", ");
echo $query;
$result = $mysqli->query($query);

/*
echo "Outer\n";
var_dump($outer_coords);
echo "Inner\n";
var_dump($inner_coords);
*/


//var_dump($outer_coords);
//var_dump($v[0][0]);
//$result = $mysqli->query("SELECT id FROM people WHERE mail='$login'");
//Add field to table
//var_dump($v);
?>
