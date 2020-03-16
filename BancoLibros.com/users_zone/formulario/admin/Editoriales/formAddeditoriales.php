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

        ?>


<form action="<?php echo "addeditorial.php?id=$_GET[id]"?>" method="POST" enctype="multipart/form-data">
<input type="text" name="editorial">
<input type="submit" value="Enviar">
</form>
				