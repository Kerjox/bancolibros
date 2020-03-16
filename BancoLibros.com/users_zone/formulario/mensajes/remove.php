<?php
require '../../../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (!isset($_SESSION["usuario"])) {
    header("location:/");
}

$sql = $conn->query("DELETE FROM mensajes WHERE IDmensaje = $_GET[id]");

mysqli_query($conn,$sql);

header("location:/mensajes")

?>