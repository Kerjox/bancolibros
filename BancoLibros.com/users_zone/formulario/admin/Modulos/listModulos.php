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
        <TITLE> Lista de libros </TITLE>
        <link rel="stylesheet" href="/admin/tabla.css">
        <link rel="stylesheet" href="/fonts/css/all.css">
    </HEAD>

    <BODY>
        <div id="main-container">
            <table>
                <thead>
                    <th>Módulo</th>
                    <th>Ciclo</th>
                    <th></th>
                    <th></th>
                </thead>
                <?php
                $sql = $conn->query("SELECT m.Modulo,c.Ciclo,m.IDmodulo FROM modulos as m,ciclos as c WHERE (m.IDciclo = c.IDciclo)");

                while ($valores = mysqli_fetch_array($sql)) {
                    echo "<tr>
                      <td>$valores[Modulo]</td>
                      <td>$valores[Ciclo]</td>
                      <td><a href='./editModulosForm.php?id=$valores[IDmodulo]' style='color: black'><i class='far fa-edit'></i></i></a></td>
                      <td><a href='./deleteModulo.php?id=$valores[IDmodulo]' style='color: red'><i class='far fa-trash-alt'></i></a></td>
                      </tr>";
                }
                ?>
            </table>
            <div><a href="/admin"><button><i class="fas fa-home"></i> Inicio</button></a> <a href="./addModulosForm.php"><button><i class="fas fa-plus-circle"></i> Agregar Módulo</button></a></div>
        </div>
    </BODY>

    </HTML>