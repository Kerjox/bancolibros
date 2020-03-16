<?php
require 'conexion.php'; 
if ($_POST['destination']=="") {
    header("location:/");
}else{
$serach=$_POST['destination'];
header("location:/?destination=$serach");
}
?>