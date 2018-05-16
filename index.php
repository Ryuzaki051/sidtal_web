<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
    $login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_cve_uname']);
	$umail = strip_tags($_POST['txt_cve_uname']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "¡Nombre de usuario y/o contraseña incorrectos! <br/> ¡Favor de Introducir los datos correctos!";
	}	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIDTAL: Login</title>
<link rel="shortcut icon" href="page/img/sdtl.ico">
<link href="page/bootstrap_login/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="page/bootstrap_login/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link rel="stylesheet" href="page/css/style.css" type="text/css"  />
</head>
<body>
<div class="signin-form">

	<div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Ingresa tus Credenciales</h2><hr />
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
        
        <div class="form-group">
        <input type="text" class="form-control" name="txt_cve_uname" placeholder="Clave ó Nombre de Usuario" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" name="txt_password" placeholder="Tu Contraseña" />
        </div>
       
     	<hr />
        
        <div class="form-group" align="center">
            <button type="submit" name="btn-login" class="btn btn-default">
                	<i class="glyphicon glyphicon-log-in"></i> &nbsp; Ingresar
            </button>
        </div>  
      	<br />
      </form>
    </div>
</div>
</body>
</html>