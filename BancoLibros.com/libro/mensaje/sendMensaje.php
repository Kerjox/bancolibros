<?php
//Hacer la conexion
require '../../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (!isset($_SESSION["usuario"])) {
     header("location:/");
}
//Datos que entran
$desde = $_SESSION["usuario"];
$para = $_GET["para"];
$IDlibro = $_GET["libro"];
$mensaje = $_POST["message"];
//Consulta de insercion
//echo "<p>ISBN: $isbn</p><br><p>Titulo: $titulo</p><br><p>Modulo: $modulo</p><br><p>Editorial: $editorial</p><br><p>Usuario: $usuario</p><br><p>Precio: $precio</p><br><p>Vendido: $vendido</p><br><p>Comentarios: $comentarios</p><hr>";
$sql = "INSERT INTO mensajes (Desde, Para, IDlibro, Mensaje, Fecha) values ('$desde','$para','$IDlibro','$mensaje',now())";

if ($conn->query($sql)) {
    header("location:/") ;

} else {
    echo "Error: " . $sql . "" . $conn->error;
}