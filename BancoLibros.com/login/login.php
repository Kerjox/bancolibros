<?php
/*
$dni = htmlspecialchars(filter_input(INPUT_POST, 'DNI'));
$pass = htmlspecialchars(filter_input(INPUT_POST, 'password'));

$pass_cifrada=password_hash($pass, PASSWORD_DEFAULT);
*//*
try {

$conn=new PDO("mysql:host=localhost; dbname=bancolibros", "kerjox", "IVSZ2e12");

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Consulta
    $sql="SELECT * FROM usuarios WHERE DNI= :user AND pass= :pass";

    $resultado=$conn->prepare($sql);

    $user=htmlentities(addslashes($_POST["user"])); 
    $password=htmlentities(addslashes($_POST["password"]));

    $resultado->bindValue(":user", $user, PDO::PARAM_INT);
    $resultado->bindValue(":pass", "$password", PDO::PARAM_STR);

    $resultado->execute();
    $registro=$resultado->rowCount();
    $pass_encripted=password_hash($password, PASSWORD_DEFAULT);

    if ($registro != 0) {
        //Sesion para el usuario
        session_start();
        $_SESSION["usuario"]=$_POST["user"];
        
        //echo "<h2>Adelante</h2>";
        //echo "$pass_encripted";
        header("location:../index.php");
    }else {
        header("location:./index.html");
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}*/

        try{

            $location = $_GET["location"];
	
            $login=htmlentities(addslashes($_POST["user"]));
            
            $password=htmlentities(addslashes($_POST["password"]));
            
            $contador=0;
        
            $base=new PDO("mysql:host=localhost; dbname=bancolibros" , "kerjox", "IVSZ2e12");
            
            $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
            $sql="SELECT * FROM usuarios WHERE DNI= :login";
            
            $resultado=$base->prepare($sql);	
                
            $resultado->execute(array(":login"=>$login));
                
                while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){			
                    
                    if (password_verify($password, $registro['pass'])) {
                        $contador++;
                    }
                    
                }
        
                if ($contador>0) {
                    //Sesion para el usuario
                session_start();
                $_SESSION["usuario"]=$_POST["user"];
               // echo"Usuario registrado";
                header("location:$location");
                } else {
                    //echo"usuarios no registrado";
                    header("location:./");
                }
        					
		
		
		$resultado->closeCursor();

	
	
}catch(Exception $e){
	
	die("Error: " . $e->getMessage());
	
	
	
}

?>