<?php 
  session_start();
  
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php"); 
    exit;
  }  
  
  require_once "config.php";
  
  $username = $password = "";
  $username_err = $password_err = "";
  
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(empty(trim($_POST["txt_login"]))){
        $username_err = "Por favor ingrese nombre de usuario.";
    } else{
        $username = trim($_POST["txt_login"]);
    }
    
    if(empty(trim($_POST["txt_password"]))){
        $password_err = "Por favor, introduzca su contraseña.";
    } else{
        $password = trim($_POST["txt_password"]);
    }    
   
    if(empty($username_err) && empty($password_err)){		 
    
        $sql = "SELECT id, rut, clave, id_perfil FROM Usuarios WHERE rut = replace(REPLACE(?,'-',''),'.','')";
        if($stmt = mysqli_prepare($con, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            $param_username = $username;
            
            if(mysqli_stmt_execute($stmt)){                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
					                    
                    mysqli_stmt_bind_result($stmt, $id, $rut, $hashed_password, $id_perfil);
                    if(mysqli_stmt_fetch($stmt)){
                        // if(password_verify($password, $hashed_password)){
                        if ($password == $hashed_password){
                            
                            session_start();                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $rut; 
                            $_SESSION["IMAGEN"] = "../imagenes/fotos_usuarios/NN.png"; 
                            $_SESSION["ID_PERFIL"] = $id_perfil; 
                            
                            
                            header("location: index.php");
                            
                        } else{
                            $username_err = "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                        }
                    }
                } else{
                    $username_err = "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                }
            } else{
                $username_err = "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
        else{
			$username_err = "¡Uy! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
		}
        
        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);   
    
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Grupo61 - Login</title>

  <link href="css/venta.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>                  
                  <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  method="post">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="txt_login" placeholder="Ingrese usuario">
                       <span class="help-block"><?php echo $username_err; ?></span>                      
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="txt_password" placeholder="Contraseña">
                      <span class="help-block"><?php echo $password_err; ?></span>
                    </div>                    
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">                    
                  </form> 
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">¿Ha olvidado la contraseña?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Crear una nueva cuenta!</a>
                  </div>                                             
                </div>
                
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <script src="script/jquery/jquery.min.js"></script>
  <script src="script/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="script/venta.js"></script>

</body>

</html>
