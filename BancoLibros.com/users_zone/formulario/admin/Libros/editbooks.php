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
$isbn = htmlspecialchars(filter_input(INPUT_POST, 'isbn'));
$titulo = "'".htmlspecialchars(filter_input(INPUT_POST, 'titulo'))."'";
$modulo = htmlspecialchars(filter_input(INPUT_POST, 'modulo'));
$editorial = htmlspecialchars(filter_input(INPUT_POST, 'editorial'));
$usuario = htmlspecialchars(filter_input(INPUT_POST, 'usuario'));
$precio = htmlspecialchars(filter_input(INPUT_POST, 'precio'));
$vendido = htmlspecialchars(filter_input(INPUT_POST, 'vendido'));
$comentarios = "'".htmlspecialchars(filter_input(INPUT_POST, 'comentarios'))."'";
//Envio Imagenes
$revisar = getimagesize($_FILES["imagen"]["tmp_name"]);
if ($revisar !== false) {
    $nombre_imagen = uniqid().$_FILES['imagen']['name'];
    $tipo_imagen = $_FILES['imagen']['type'];
    $tamaño_imagen = $_FILES['imagen']['size'];
    if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/png" || $tipo_imagen == "image/gif") {

        if ($tamaño_imagen <= 1000000) {
            //Ruta de la carpeta de subidas
            $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/img/libros/';

            //Mover imagen del directorio temporal al destino
            move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);
        } else {
            echo "El tamaño de la imagen es demasiado grande";
            echo "<br><a href='./formularioLibos.php'>Volver al formulario</a>";
        }
    } else {
        echo "El formato del archivo no es compatible";
        echo "<br><a href='./formularioLibos.php'>Volver al formulario</a>";
    }
}else {
    $nombre_imagen = 'null.jpg';
}

//Consulta de insercion
//echo "<p>ISBN: $isbn</p><br><p>Titulo: $titulo</p><br><p>Modulo: $modulo</p><br><p>Editorial: $editorial</p><br><p>Usuario: $usuario</p><br><p>Precio: $precio</p><br><p>Vendido: $vendido</p><br><p>Comentarios: $comentarios</p><hr>";
$sql = "UPDATE libros SET ISBN=$isbn, Titulo=$titulo, IDmodulo=$modulo, IDeditorial=$editorial, IDusuario=$usuario, Precio=$precio, Vendido=$vendido, Fecha=now(), Comentarios=$comentarios WHERE IDlibro=$id";

if ($conn->query($sql)) {
    header("location:bookslist.php") ;

} else {
    echo "Error: " . $sql . "" . $conn->error;
}
