<?php
require '../../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (!isset($_SESSION["usuario"])) {
    header("location:../../index.php");
}

$sql = $conn->query("DELETE FROM libros WHERE IDlibro = $_GET[id]");

mysqli_query($conn,$sql);

header("location:bookslist.php")

?>