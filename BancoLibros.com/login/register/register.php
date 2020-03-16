<?php
//Hacer la conexion
require '../../conexion.php';
//Datos que entran
$dni = htmlspecialchars(filter_input(INPUT_POST, 'dni'));
$nombre = htmlspecialchars(filter_input(INPUT_POST, 'nombre'));
$apellido = htmlspecialchars(filter_input(INPUT_POST, 'apellido'));
$telefono = htmlspecialchars(filter_input(INPUT_POST, 'telefono'));
$mail = htmlspecialchars(filter_input(INPUT_POST, 'mail'));
$pass = htmlspecialchars(filter_input(INPUT_POST, 'pass'));

$encripted_pass=password_hash($pass, PASSWORD_DEFAULT);


$sql = "INSERT INTO usuarios (DNI, Nombre, Apellido, Movil, email, pass) values ('$dni','$nombre','$apellido','$telefono','$mail','$encripted_pass')";

if ($conn->query($sql)) {
    //echo "Respuesta registrada correctamente";
    header("location:/login");
} else {
    //echo "Error: " . $sql . "" . $conn->error;
    echo "<h2>Usuario ya registrado</h2>";
}
