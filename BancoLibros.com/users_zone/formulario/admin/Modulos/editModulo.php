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
//Datos que entran
$id = $_GET['id'];
$modulo = "'".htmlspecialchars(filter_input(INPUT_POST, 'modulo'))."'";
$ciclo =htmlspecialchars(filter_input(INPUT_POST, 'ciclo'));

$sql = "UPDATE modulos SET Modulo=$modulo, IDciclo=$ciclo WHERE IDmodulo=$id";

if ($conn->query($sql)) {
    header("location:listModulos.php") ;

} else {
    echo "Error: " . $sql . "" . $conn->error;
}
