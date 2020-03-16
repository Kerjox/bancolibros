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

$sql = $conn->query("DELETE FROM modulos WHERE IDmodulo = $_GET[id]");

mysqli_query($conn,$sql);

header("location:listModulos.php");

?>