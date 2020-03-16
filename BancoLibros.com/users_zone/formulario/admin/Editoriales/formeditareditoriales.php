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

            $sql = $conn->query("SELECT * FROM editoriales WHERE IDeditorial=$_GET[id]");
            $valor = mysqli_fetch_array($sql);
        ?>


<form action="<?php echo "editareditorial.php?id=$_GET[id]"?>" method="POST" enctype="multipart/form-data">
<input type="text" name="editorial" value="<?php echo "$valor[Editorial]"?>">
<input type="submit" value="Actuelizar">
</form>
				