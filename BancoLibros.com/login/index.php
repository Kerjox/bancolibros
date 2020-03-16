<?php
require '../conexion.php';
session_start();
//Ver si hay algo almacenado en la variable session
if (isset($_SESSION["usuario"])) {
    header("location:/");
}
if (!isset($_GET["location"])) {
   $location = "login.php?location=/";
}elseif ($_GET["location"] == "libro"){
   $location = "login.php?location=/libro?id=$_GET[id]";
}elseif ($_GET["location"] == "addbooks") {
   $location = "login.php?location=/addbooks";
}

?>

<html>
<head>
   <meta charset="UTF-8">
   <title>Log In</title>
   <link rel="stylesheet" href="./css/style.css">
   <link rel="stylesheet" href="../fonts/css/all.css">
   
</head>

<body>
   <!-- partial:index.partial.html -->
   <div class="overlay">
      <!-- LOGN IN FORM by Omar Dsoky -->
      <form id="login" action="<?php echo "$location" ?>" method="POST">
         <!--   con = Container  for items in the form-->
         <div class="con">
            <!--     Start  header Content  -->
            <header class="head-form">
               <h2>Log In</h2>
               <!--     A welcome message or an explanation of the login form -->
               <p>login here using your DNI and password</p>
            </header>
            <!--     End  header Content  -->
            <br>
            <div class="field-set">
               
               <!--   user name -->
               <span class="input-item">
                  <i class="fa fa-user-circle"></i>
               </span>
               <!--   user name Input-->
               <input class="form-input" id="txt-input" name="user" type="text" placeholder="@DNI" required>

               <br>
               
               <!--   Password -->
               
               <span class="input-item">
                  <i class="fa fa-key"></i>
               </span>
               <!--   Password Input-->
               <input class="form-input" type="password" placeholder="Password" id="password" name="password" required>
               
               <!--      Show/hide password  -->
               <span>
                  <i class="fa fa-eye" aria-hidden="true" type="button" id="eye"></i>
               </span>
               
               
               <br>
               <!--        buttons -->
               <!--      button LogIn -->
               <button class="log-in"> Log In </button>
            </div>

            <!--   other buttons -->
            <div class="other">
               <!--      Forgot Password button-->
               <button class="btn submits frgt-pass">Forgot Password</button>
               <!--     Sign Up button -->
               <button class="btn submits sign-up" onclick="document.location.href='/register'"> Sign Up
                  <!--         Sign Up font icon -->
                  <i class="fa fa-user-plus" aria-hidden="true"></i>
               </button>
               <!--      End Other the Division -->
            </div>
            
            <!--   End Conrainer  -->
         </div>
         
         <!-- End Form -->
      </form>
   </div>
   <!-- partial -->
   
</body>
<script src="./login/js/script.js"></script>
</html>