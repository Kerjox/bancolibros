<?php
require "../../../../conexion.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:../../../../index.php");    
}else{
    $sqladmin = $conn->query("SELECT DNI FROM admin WHERE DNI=$_SESSION[usuario]");
    $resultado = $sqladmin->num_rows;
    if ($resultado == 0) {
        header("location:../../../../index.php");
    }
}
$id=$_GET['id'];
$editorial="'".$_POST['editorial']."'";
$sql = "UPDATE editoriales SET Editorial=$editorial WHERE IDeditorial=$id";

if ($conn->query($sql)) {
    header("location:listaeditoriales.php");

} else {
    echo "Error: " . $sql . "" . $conn->error;
}
?>
