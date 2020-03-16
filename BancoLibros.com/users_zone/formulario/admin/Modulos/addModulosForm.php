    <?php

    require "../../../../conexion.php";
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("location:../../../../index.php");
    } else {
        $sqladmin = $conn->query("SELECT DNI FROM admin WHERE DNI=$_SESSION[usuario]");
        $resultado = $sqladmin->num_rows;
        if ($resultado == 0) {
            header("location:../../../../index.php");
        }
    }



    ?>
    <HTML>

    <HEAD>
        <TITLE> Formulario Modulos </TITLE>
    </HEAD>

    <BODY>
        <form action='<?php echo "addModulo.php" ?>' method="POST" enctype="multipart/form-data">
            <table border="1" align="center" width="60%">
                <td>Ciclo</td>
                <td>
                    <select name="ciclo" id="ciclo" required>
                        <option value="">Selecciona:</option>
                        <?php
                        $query = $conn->query("SELECT IDciclo,Ciclo FROM ciclos");

                        while ($valores = mysqli_fetch_array($query)) {

                            echo '<option value="' . $valores["IDciclo"] . '">' . $valores["Ciclo"] . '</option>';
                        }
                        ?>
                    </select>
                </td>
                </tr>
                <tr>
                    <td>Módulo</td>
                    <td><input type="text" name="modulo" size="50" required></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="Enviar"></td>
                </tr>
            </table>
        </form>
    </BODY>

    </HTML>