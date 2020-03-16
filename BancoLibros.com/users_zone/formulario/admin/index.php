<?php
require "../../../conexion.php";
session_start();

if (!isset($_SESSION["usuario"])) {
    header("location:../../../");    
}else{
    $sqladmin = $conn->query("SELECT DNI FROM admin WHERE DNI=$_SESSION[usuario]");
    $resultado = $sqladmin->num_rows;
    if ($resultado != 0) {
        $sql = $conn->query("SELECT nombre,apellido FROM usuarios WHERE DNI= $_SESSION[usuario]");
            $valores = mysqli_fetch_array($sql);
        
            echo "<h2>Bienvenido $valores[nombre] $valores[apellido]</h2><br>";
        
    }else {
        header("location:../../../");
    }
}

?>

<html>
    <body>
        <a href="/">Inicio</a><br>
        <a href="/admin/editoriales">Editoriales</a><br>
        <a href="/admin/libros">Libros publicados por los usuario</a><br>
        <a href="/admin/modulos">Modulos</a><br>
        <a href="../logout">Cerrar Sesión</a>
    </body>
</html>