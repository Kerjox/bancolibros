<?php
    require '../../../conexion.php';
    session_start();
    //Ver si hay algo almacenado en la variable session
    if (!isset($_SESSION["usuario"])) {
        header("location:/login/login.php");
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Mensajes</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="/fonts/css/all.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1">
					<div class="table100-firstcol">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Usuario</th>
								</tr>
							</thead>
							<tbody>
							<?php
                            $sql = $conn->query("SELECT u.Nombre, u.Apellido, m.IDmensaje FROM mensajes as m, usuarios as u WHERE m.Desde=u.DNI");

                            while ($valores = mysqli_fetch_array($sql)) {

                                echo "<tr class='row100 body'>
										<td class='cell100 column1'><a href='remove.php?id=$valores[IDmensaje]' style='color: red'><i class='far fa-trash-alt'></i></a> $valores[Nombre] $valores[Apellido]</td>
									  </tr>";
                            }
                            ?>
							</tbody>
						</table>
						
					</div>
					
					<div class="wrap-table100-nextcols js-pscroll">
						<div class="table100-nextcols">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column2">Libro</th>
										<th class="cell100 column3">Fecha</th>
										<th class="cell100 column4">Mensaje</th>
									</tr>
								</thead>
								<tbody>
									<?php
								$sql = $conn->query("SELECT l.Titulo, m.Fecha, m.Mensaje FROM mensajes as m, libros as l WHERE m.IDlibro=l.IDlibro");

								while ($valores = mysqli_fetch_array($sql)) {

									echo "<tr class='row100 body'>
									<td class='cell100 column2'>$valores[Titulo]</td>
									<td class='cell100 column3'>$valores[Fecha]</td>
									<td class='cell100 column4'>$valores[Mensaje]</td>
								</tr>";
								}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<a href="/"><button><i class="fas fa-home"></i> Inicio</button></a>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})

			$(this).on('ps-x-reach-start', function(){
				$(this).parent().find('.table100-firstcol').removeClass('shadow-table100-firstcol');
			});

			$(this).on('ps-scroll-x', function(){
				$(this).parent().find('.table100-firstcol').addClass('shadow-table100-firstcol');
			});

		});

		
		
		
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>