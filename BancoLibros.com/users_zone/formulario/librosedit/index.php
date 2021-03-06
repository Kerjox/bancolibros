<?php
require '../../../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (!isset($_SESSION["usuario"])) {
     header("location:../../../login");
}
?>

<?php
$query = $conn->query("SELECT l.IDlibro,l.IDusuario,u.DNI FROM libros AS l, usuarios AS u WHERE l.IDusuario=u.DNI AND l.IDlibro=$_GET[id] AND u.DNI='$_SESSION[usuario]';");
$resultado = $query->num_rows;
if ($resultado == 0) {
    header("location:../../../");
}else {
	
	$sql = $conn->query("SELECT * FROM libros WHERE IDlibro=$_GET[id]");
	$valor = mysqli_fetch_array($sql);
}
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Editar Libros</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/bookstack.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">
		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="<?php echo "../editbooks.php?id=$_GET[id]"?>" method="POST" enctype="multipart/form-data">
				<span class="contact100-form-title">
					Publica un libro
				</span>


				<div class="wrap-input100 validate-input" data-validate="Name is required">
					<label class="label-input100" for="isbn">ISBN</label>
					<input id="isbn" class="input100" type="text" name="isbn" placeholder="Introduce el isbn aquí" value="<?php echo"$valor[ISBN]";?>"
					<span class="focus-input100"></span>
				</div>


				<div class="wrap-input100 validate-input" data-validate = "Se requiere un nombre valido">
					<label class="label-input100" for="titulo">Titulo libro</label>
					<input id="titulo" class="input100" type="text" name="titulo" placeholder="Introduce el nombre del libro" value="<?php echo"$valor[Titulo]";?>">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100">
					<div class="label-input100">Módulos</div>
					<div>
                        <select name="modulo" id="modulo" class="js-select2">
                            <option value="">Selecciona:</option>
                            <?php
                            $query = $conn->query("SELECT m.IDmodulo,m.Modulo,c.Ciclo FROM modulos as m, ciclos as c WHERE m.IDciclo=c.IDciclo");

                            while ($valores = mysqli_fetch_array($query)) {

								echo '<option value="'.$valores['IDmodulo'].'" '.(($valores['IDmodulo']==$valor['IDmodulo'])?'selected="selected"':"").'>'.$valores["Modulo"] . " -- " . $valores["Ciclo"].'</option>';
                            }
                            ?>
                        </select>
						<div class="dropDownSelect2"></div>
					</div>
					<span class="focus-input100"></span>
                </div>
                
                <div class="wrap-input100">
					<div class="label-input100">Editoriales</div>
					<div>
                    <select name="editorial" id="editorial" class="js-select2">
                            <option value="">Selecciona:</option>
                            <?php
                            $query = $conn->query("SELECT * FROM editoriales");

                            while ($valores = mysqli_fetch_array($query)) {

								echo '<option value="'.$valores['IDeditorial'].'" '.(($valores['IDeditorial']==$valor['IDeditorial'])?'selected="selected"':"").'>'.$valores["Editorial"].'</option>';
                            }
                            ?>
                        </select>
						<div class="dropDownSelect2"></div>
					</div>
					<span class="focus-input100"></span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate="Precio requerido">
					<label class="label-input100" for="precio">Precio</label>
					<input id="precio" class="input100" type="text" name="precio" placeholder="Introduce el precio aquí" value="<?php echo "$valor[Precio]";?>">
					<span class="focus-input100"></span>
                </div>
                
                

                <div class="wrap-input100">
					<div class="label-input100">Disponible</div>
					<div>
                    <select name="vendido" id="vendido" class="js-select2">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
						<div class="dropDownSelect2"></div>
					</div>
					<span class="focus-input100"></span>
                </div>

                <div class="wrap-input100">
					<label class="label-input100" for="foto">Portada</label>
					<input id="imagen" class="input100" type="file" name="imagen" placeholder="Introduce la foto">
					<span class="focus-input100"></span>
                </div>

				<div class="wrap-input100">
					<label class="label-input100" for="comentarios">Comentarios</label>
					<textarea id="comentarios" class="input100" name="comentarios" placeholder="Type your comments here..."><?php echo"$valor[Comentarios]"?></textarea>
					<span class="focus-input100"></span>
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn">
						Send
					</button>
				</div>

				<div class="contact100-form-social flex-c-m">
					<a href="#" class="contact100-form-social-item flex-c-m bg1 m-r-5">
						<i class="fa fa-facebook-f" aria-hidden="true"></i>
					</a>

					<a href="#" class="contact100-form-social-item flex-c-m bg2 m-r-5">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>

					<a href="#" class="contact100-form-social-item flex-c-m bg3">
						<i class="fa fa-youtube-play" aria-hidden="true"></i>
					</a>
				</div>
			</form>

			<div class="contact100-more flex-col-c-m" style="background-image: url('images/bg-01.jpg');">
			</div>
		</div>
	</div>





<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
		$(".js-select2").each(function(){
			$(this).on('select2:open', function (e){
				$(this).parent().next().addClass('eff-focus-selection');
			});
		});
		$(".js-select2").each(function(){
			$(this).on('select2:close', function (e){
				$(this).parent().next().removeClass('eff-focus-selection');
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-23581568-13');
	</script>
</body>
</html>
