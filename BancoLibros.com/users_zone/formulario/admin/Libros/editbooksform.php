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
    <HTML>

    <HEAD>
        <TITLE> Formulario Libos </TITLE>
    </HEAD>

    <BODY>
        <?php
            $sql = $conn->query("SELECT * FROM libros WHERE IDlibro=$_GET[id]");
            $valor = mysqli_fetch_array($sql);
        ?>
        <form action='<?php echo "editbooks.php?id=$_GET[id]"?>' method="POST" enctype="multipart/form-data">
            <table border="1" align="center" width="60%">
                <tr>
                    <td>Usuario</td>
                    <td><input type="text" name="usuario" maxlength="17" value="<?php echo"$valor[IDusuario]";?>" required></td>
                </tr>
                <tr>
                    <td>ISBN</td>
                    <td><input type="text" name="isbn" maxlength="17" value="<?php echo"$valor[ISBN]";?>" size="25" required></td>
                </tr>
                <tr>
                    <td>Título</td>
                    <td><input type="text" name="titulo" size="50" value="<?php echo"$valor[Titulo]";?>" required></td>
                </tr>
                <tr>
                    <td>Módulo</td>
                    <td>
                        <select name="modulo" id="modulo" required>
                            <option value="">Selecciona:</option>
                            <?php
                            $query = $conn->query("SELECT m.IDmodulo,m.Modulo,c.Ciclo FROM modulos as m, ciclos as c WHERE m.IDciclo=c.IDciclo");

                            while ($valores = mysqli_fetch_array($query)) {

								echo '<option value="'.$valores['IDmodulo'].'" '.(($valores['IDmodulo']==$valor['IDmodulo'])?'selected="selected"':"").'>'.$valores["Modulo"] . " -- " . $valores["Ciclo"].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Editorial</td>
                    <td>
                        <select name="editorial" id="editorial" required>
                            <option value="">Selecciona:</option>
                            <?php
                            $query = $conn->query("SELECT * FROM editoriales");

                            while ($valores = mysqli_fetch_array($query)) {

								echo '<option value="'.$valores['IDeditorial'].'" '.(($valores['IDeditorial']==$valor['IDeditorial'])?'selected="selected"':"").'>'.$valores["Editorial"].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Precio</td>
                    <td><input type="text" name="precio" id="precio" value="<?php echo "$valor[Precio]";?>" placeholder="Poner decimales con punto" required></td>
                </tr>
                <tr>
                    <td>Disponible</td>
                    <td>
                        <select name="vendido" id="vendido">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Imagen (.jpg, .png, .gif)</td>
                    <td><input type="file" name="imagen"></td>
                </tr>
                <tr>
                    <td>Datos adicionales</td>
                    <td><textarea name="comentarios" id="comentarios" cols="50" rows="5"><?php echo"$valor[Comentarios]"?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Actualizar"></td>
                </tr>
            </table>
        </form>
    </BODY>

    </HTML>