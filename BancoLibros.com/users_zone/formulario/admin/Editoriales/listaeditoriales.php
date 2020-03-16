    <?php
    require "../../../../conexion.php";
    session_start();

    if (!isset($_SESSION["usuario"])) {
        header("location:../../../../");
    } else {
        $sqladmin = $conn->query("SELECT DNI FROM admin WHERE DNI=$_SESSION[usuario]");
        $resultado = $sqladmin->num_rows;
        if ($resultado == 0) {
            header("location:../../../../");
        }
    }

    ?>
    <HTML>

    <HEAD>
        <TITLE> Lista de editoriales</TITLE>
        <link rel="stylesheet" href="/admin/tabla.css">
        <link rel="stylesheet" href="/fonts/css/all.css">
    </HEAD>

    <BODY>
        <div id="main-container">
            <table>
                <thead>
                    <th>Editoriales</th>
                    <th></th>
                    <th></th>
                </thead>
                <?php
                $sql = $conn->query("SELECT * FROM editoriales");

                while ($valores = mysqli_fetch_array($sql)) {
                    echo "<tr>
                      <td>$valores[Editorial]</td>
                      <td><a href='formeditareditoriales.php?id=$valores[IDeditorial]' style='color: black'><i class='far fa-edit'></i></i></a></td>
                      <td><a href='borrareditorial.php?id=$valores[IDeditorial]' style='color: red'><i class='far fa-trash-alt'></i></a></td>
                      </tr>";
                }
                ?>
            </table>
            <div><a href="/admin"><button><i class="fas fa-home"></i> Inicio</button></a><a href="formAddeditoriales.php"> <button><i class="fas fa-plus-circle"></i> Agregar</button></a></div>

        </div>
    </BODY>

    </HTML>