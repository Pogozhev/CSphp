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

var_dump($v);
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
