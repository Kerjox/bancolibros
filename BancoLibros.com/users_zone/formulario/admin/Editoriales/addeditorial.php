<?php
//Hacer la conexion
$true = $_GET['true'];
require '../../../../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (!isset($_SESSION["usuario"]) && $true != 1) {
     header("location:../../../../index.php");    
}
$editorial = htmlspecialchars(filter_input(INPUT_POST, 'editorial'));

$sql = "INSERT INTO editoriales (Editorial) values ('$editorial')";
if ($conn->query($sql)) {
    header("location:listaeditoriales.php?true=1") ;

} else {
    echo "Error: " . $sql . "" . $conn->error;
}
?>
