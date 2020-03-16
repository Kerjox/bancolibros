<!DOCTYPE html>
<?php
require 'conexion.php';
       session_start();
       if ($_GET['destination']!="") {
          $destination="AND l.Titulo='$_GET[destination]'";
       }
       //Ver si hay algo almacenado en la variable session
        if (!isset($_SESSION["usuario"])) {            
            $boton_login = "<a href='./login' class='btn btn-outlined'>Log in <i class='fas fa-sign-in-alt'></i></a>";
            $bienvenida = "";
            $botonlibros = "/login?location=addbooks";
       }else {           
            $boton_login = "<a href='logout' class='btn btn-outlined'>Log out <i class='fas fa-door-open'></i></a>";
            $sql = $conn->query("SELECT Nombre FROM usuarios WHERE DNI=$_SESSION[usuario]");
            $valores = mysqli_fetch_array($sql);
            $botonlibros = "/addbooks";
            $bienvenida = "<p>Bienvenid@ $valores[Nombre]</p>";
            $sqladmin = $conn->query("SELECT DNI FROM admin WHERE DNI=$_SESSION[usuario]");
            $resultado = $sqladmin->num_rows;
            $menu = "<li><a href='bookslist'>Libros publicados</a></li><li><a href='addbooks'>Publicar libro</a></li><li><a href='mensajes'>Mensajes</a></li>";
            //$resultado =1;
            if ($resultado != 0) {
               $admin = "<li><a href='admin'>Admin</a></li>";
           }else {
               $admin = "";
           }
         }
                 
?>
<html>
   <head>
      <title>BancoLibros</title>
      <meta charset="utf-8">
      <meta name="description" content="Traveling HTML5 Template" />
      <meta name="author" content="Design Hooks" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Raleway:400,700" rel="stylesheet" />
      <link href="img/favicon.png" type="image/x-icon" rel="shortcut icon" />
      <link href="css/screen.css" rel="stylesheet" />
      <link rel="stylesheet" href="./fonts/css/all.css">
   </head>
   <body class="home" id="page">
      <!-- Header -->
      <header class="main-header">
         <div class="container">
            <div class="header-content">
               <a href="/">
                  <img src="img/site-identity.png" alt="site identity" />
               </a>

               <nav class="site-nav">
                  <ul class="clean-list site-links">
                     <?php echo "$admin"; echo "$menu";;
                     ?>
                     
                  </ul>
                  <?php echo"$boton_login"?>
               
                  </nav>
            </div>
         </div>
      </header>

      <!-- Main Content -->
      <div class="content-box">
         <!-- Hero Section -->
         <section class="section section-hero">
            <div class="hero-box">
               <div class="container">
                  <div class="hero-text align-center">
                     <h1>¿Buscas un libro?</h1>
                     <?php 
                     echo"$bienvenida"?>
                  </div>

                  <form class="destinations-form" method="POST" action="/search.php" name="search">
                     <div class="input-line">
                        <input type="text" name="destination" value="" class="form-input check-value" placeholder="Qué libro quieres buscar?" />
                        <button type="button" name="destination-submit" class="form-submit btn btn-special" onclick="document.search.submit()">Buscar <i class="fas fa-search"></i></button>
                     </div>
                  </form>
               </div>
            </div>

            <!-- Statistics Box -->
            <div class="container">
               <div class="statistics-box">
                  <div class="statistics-item">
                     <?php
                     //Libros 
                     $sqlibros = $conn->query("SELECT * FROM libros");
                     $libros = mysqli_num_rows($sqlibros);
                     
                     //Usuarios
                     $sqlusuarios = $conn->query("SELECT * FROM usuarios");
                     $usuarios = mysqli_num_rows($sqlusuarios);
                     
                     //Ciclos
                     $sqlciclos = $conn->query("SELECT * FROM ciclos");
                     $ciclos = mysqli_num_rows($sqlciclos);

                     //Modulos
                     $sqlmodulos = $conn->query("SELECT * FROM modulos");
                     $modulos = mysqli_num_rows($sqlmodulos);
                     
                     ?>
                     <span class="value"><?php echo "$libros"?></span>
                     <p class="title">Libros</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value"><?php echo "$usuarios"?></span>
                     <p class="title">Usuarios</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value"><?php echo "$ciclos"?></span>
                     <p class="title">Ciclos</p>
                  </div>

                  <div class="statistics-item">
                     <span class="value"><?php echo "$modulos"?></span>
                     <p class="title">Modulos</p>
                  </div>
               </div>
            </div>
         </section>

         <!-- Destinations Section -->
         <section class="section section-destination">
            <!-- Title -->
            <div class="section-title">
               <div class="container">
                  <h2 class="title">Libros publicados recientemente</h2>
                  <p class="sub-title">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et</p>
               </div>
            </div>

            <!-- Content -->
            <div class="container">
            <?php
            $lastbooks = $_GET['books']+3;
               $sql = $conn->query("SELECT l.*, e.editorial FROM libros as l, editoriales as e where l.IDeditorial = e.IDeditorial and l.vendido = 1 $destination order by Fecha desc limit $lastbooks") ;
               $control = 0;

               while ($valores = mysqli_fetch_array($sql)) {
                  $control++;
                   echo "<div class='col-md-8 col-sm-12 col-xs-24'>
                   <div class='destination-box'>
                      <div class='box-cover'>
                         <a href='/libro/?id=$valores[IDlibro]'>
                            <img src='./img/libros/$valores[Foto]' alt='destination image' />
                         </a>
                      </div>

                      <span class='boats-qty'>$valores[Precio] €</span>

                      <div class='box-details'>
                         <div class='box-meta'>
                            <h4 class='city'>$valores[Titulo]</h4>
                            <p class='country'>$valores[editorial]</p>
                         </div>
                      </div>
                   </div>
                </div>";
               }
            ?>
            <!--<div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-2.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">621</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Ibiza</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-2.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">620€</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Ibiza</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-2.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">621</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Ibiza</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-3.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">543</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Palma de Mallorca</h4>
                              <p class="country">Spain</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-4.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">495</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Portofino</h4>
                              <p class="country">Italy</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-8 col-sm-12 col-xs-24">
                     <div class="destination-box">
                        <div class="box-cover">
                           <a href="#">
                              <img src="img/destination-5.jpg" alt="destination image" />
                           </a>
                        </div>

                        <span class="boats-qty">402</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="city">Port Hercules</h4>
                              <p class="country">Monaco</p>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="load-destinations-box">
                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-4.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">495</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Portofino</h4>
                                 <p class="country">Italy</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-5.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">402</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Port Hercules</h4>
                                 <p class="country">Monaco</p>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-8 col-sm-12 col-xs-24">
                        <div class="destination-box">
                           <div class="box-cover">
                              <a href="#">
                                 <img src="img/destination-3.jpg" alt="destination image" />
                              </a>
                           </div>

                           <span class="boats-qty">543</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="city">Palma de Mallorca</h4>
                                 <p class="country">Spain</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>-->

               <div class="align-center">
                  <a href="<?php echo"/?books=$lastbooks&destination=$_GET[destination]"?>" class="btn btn-special"><span class="text">Ver más libros publicados</span></a>
               </div>
            </div>
         </section>

         <!-- Parallax Box -->
         <div class="parallax-box">
            <div class="container">
               <div class="text align-center">
                  <h1>¿Quieres vender tus libros?</h1>
                  <p>Solo tienes que crearte una cuenta para vender libros</p>

                  <a href="<?php echo "$botonlibros" ?>" class="btn btn-special no-icon size-2x">Vender libros</a>
               </div>
            </div>
         </div>

         <!-- Boats Section -->
         <!--<section class="section section-boats">-->
            <!-- Title -->
            <!--<div class="section-title">
               <div class="container">
                  <h2 class="title">Packs por Ciclos</h2>
                  <p class="sub-title">Puedes encontrar libros mas varatos que por separado</p>
               </div>
            </div>-->

            <!-- Content -->
            <!--<div class="container">
               <div class="row">
                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-1.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€580 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Delphia 47</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Gdansk, Poland</li>
                                 <li class="berths">8 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-2.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€950 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Sense 55</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Portofino, Itali</li>
                                 <li class="berths">12 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-3.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€820 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Cruiser 51</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Palma de Mallorca, Spain</li>
                                 <li class="berths">10 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-sm-12 col-xs-24">
                     <div class="boat-box">
                        <div class="box-cover">
                           <img src="img/boat-4.jpg" alt="destination image" />
                        </div>

                        <span class="boat-price">€400 / day</span>

                        <div class="box-details">
                           <div class="box-meta">
                              <h4 class="boat-name">Cruiser 41S</h4>
                              <ul class="clean-list boat-meta">
                                 <li class="location">Lisbon, Portugal</li>
                                 <li class="berths">8 Berths</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="load-boats-box">
                     <div class="col-sm-12 col-xs-24">
                        <div class="boat-box">
                           <div class="box-cover">
                              <img src="img/boat-2.jpg" alt="destination image" />
                           </div>

                           <span class="boat-price">€950 / day</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="boat-name">Sense 55</h4>
                                 <ul class="clean-list boat-meta">
                                    <li class="location">Portofino, Itali</li>
                                    <li class="berths">12 Berths</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-sm-12 col-xs-24">
                        <div class="boat-box">
                           <div class="box-cover">
                              <img src="img/boat-1.jpg" alt="destination image" />
                           </div>

                           <span class="boat-price">€580 / day</span>

                           <div class="box-details">
                              <div class="box-meta">
                                 <h4 class="boat-name">Delphia 47</h4>
                                 <ul class="clean-list boat-meta">
                                    <li class="location">Gdansk, Poland</li>
                                    <li class="berths">8 Berths</li>
                                 </ul>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="align-center">
                  <a href="<?php echo"/?books=$lastbooks"?>" class="btn btn-default btn-load-boats"><span class="text">Load more boats</span><i class="icon-spinner6"></i></a>
               </div>
            </div>
         </section>
      </div>-->

      <!-- Footer -->
      <footer class="main-footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Top Locations</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                        <li><a href="#">incididunt ut labore</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Featured Boats</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-9">
                  <div class="widget widget_social">
                     <h5 class="widget-title">Subscribe to our newsletter</h5>
                     <form class="subscribe-form">
                        <div class="input-line">
                           <input type="text" name="subscribe-email" value="" placeholder="Your email address" />
                        </div>
                        <button type="button" name="subscribe-submit" class="btn btn-special no-icon">Subscribe</button>
                     </form>

                     <ul class="clean-list social-block">
                        <li>
                           <a href="#"><i class="icon-facebook"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="icon-twitter"></i></a>
                        </li>
                        <li>
                           <a href="#"><i class="icon-google-plus"></i></a>
                        </li>
                     </ul>
                  </div>
               </div>

               <div class="col-md-5">
                  <div class="widget widget_links">
                     <h5 class="widget-title">Contact us</h5>
                     <ul>
                        <li><a href="#">Lorem impsum dolor</a></li>
                        <li><a href="#">Sit amet consectetur</a></li>
                        <li><a href="#">Adipisicing elit</a></li>
                        <li><a href="#">Eiusmod tempor</a></li>
                        <li><a href="#">incididunt ut labore</a></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </footer>

      <!-- Scripts -->
      <script src="js/jquery.js"></script>
      <script src="js/functions.js"></script>
      
   </body>
</html>
