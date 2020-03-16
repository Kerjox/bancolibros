    <?php
    require '../../conexion.php';
    session_start();
    //Ver si hay algo almacenado en la variable session
    if (!isset($_SESSION["usuario"])) {
        header("location:/login/login.php");
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
                    <th>ISBN</th>
                    <th>Título <a href="./?order=Titulo" style="color: white"> <?php if ($_GET['order']=='Titulo') {
                        echo"<i class='fas fa-sort-down'></i>";
                    } else {
                        echo "<i class='fas fa-sort-up'></i>";
                    }
                     ?></a></th>
                    <th>Módulo <a href="./?order=Modulo" style="color: white"> <?php if ($_GET['order']=='Modulo') {
                        echo"<i class='fas fa-sort-down'></i>";
                    } else {
                        echo "<i class='fas fa-sort-up'></i>";
                    }
                     ?></a></th>
                    <th>Editorial <a href="./?order=Editorial" style="color: white"> <?php if ($_GET['order']=='Editorial') {
                        echo"<i class='fas fa-sort-down'></i>";
                    } else {
                        echo "<i class='fas fa-sort-up'></i>";
                    }
                     ?></a></th>
                    <th>Precio <a href="./?order=Precio" style="color: white"> <?php if ($_GET['order']=='Precio') {
                        echo"<i class='fas fa-sort-down'></i>";
                    } else {
                        echo "<i class='fas fa-sort-up'></i>";
                    }
                     ?></a></th>
                    <th>Disponible <a href="./?order=vendido" style="color: white"> <?php if ($_GET['order']=='vendido') {
                        echo"<i class='fas fa-sort-down'></i>";
                    } else {
                        echo "<i class='fas fa-sort-up'></i>";
                    }
                     ?></a></th>
                    <th></th>
                    <th></th>
                </thead>
                <?php
                if (isset($_GET['order'])) {
                    $order = 'order by '. $_GET['order'];
                }
                $sql = $conn->query("SELECT * FROM libros as l,modulos as m,editoriales as e WHERE (l.IDmodulo = m.IDmodulo AND l.IDeditorial = e.IDeditorial AND IDusuario = $_SESSION[usuario]) $order");

                while ($valores = mysqli_fetch_array($sql)) {
                    echo "<tr>
                      <td>$valores[ISBN]</td>
                      <td>$valores[Titulo]</td>
                      <td>$valores[Modulo]</td>
                      <td>$valores[Editorial]</td>
                      <td>$valores[Precio] €</td>
                      <td>".(($valores['Vendido']==1)?'<i class="fas fa-check"></i>':'<i class="fas fa-times"></i>')."</td>
                      <td><a href='librosedit?id=$valores[IDlibro]' style='color: black'><i class='far fa-edit'></i></i></a></td>
                      <td><a href='./deletelibro.php?id=$valores[IDlibro]' style='color: red'><i class='far fa-trash-alt'></i></a></td>
                      </tr>";
                }
                ?>
            </table>
                <div><a href="/"><button><i class="fas fa-home"></i> Inicio</button></a> <a href="/addbooks"><button><i class="fas fa-plus-circle"></i> Agregar Libro</button></a></div>
        </div>
    </BODY>

    </HTML>