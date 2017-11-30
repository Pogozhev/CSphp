<?php
$data = json_decode(file_get_contents("php://input")); 
$name = $data->name;
$gisx = $data->gisx;
$gisy = $data->gisy;
$crop = $data->crop;
include('regFiles/bd.php');
$result = $mysqli->query("INSERT INTO test_field (name, gisx, gisy, crop) VALUES ('$name','$gisx','$gisy', '$crop')");
?>