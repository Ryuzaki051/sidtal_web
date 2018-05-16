<?php
 require_once("session.php");
require_once('class.user.php');
$user = new USER();
$auth_user = new USER();
$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$useradm=$stmt->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['btn-signup']))
{
	$ucve = strip_tags($_POST['txt_cve']);
	$uname = strip_tags($_POST['txt_uname']);
	$apPat = strip_tags($_POST['txt_appat']);
	$apMat = strip_tags($_POST['txt_apmat']);
	$umail = strip_tags($_POST['txt_umail']);
	$upass = strip_tags($_POST['txt_upass']);
	$session = strip_tags($_POST['txt_session']);
	$estatus = strip_tags($_POST['txt_estatus']);	
	
	if($ucve=="")	{
		$error[] = "Provee una clave de usuario valida !";	
	}
	else if($uname=="")	{
		$error[] = "Provee un nombre de usuario valido !";	
	}
	else if($umail=="")	{
		$error[] = "¡Provee una cuenta de email id!";	
	}
	else if(!filter_var($umail, FILTER_VALIDATE_EMAIL))	{
		$error[] = '¡Por favor ingresa un correo electronico valido !';
	}
	else if($upass=="")	{
		$error[] = "¡Provee una contraseña !";
	}
	else if(strlen($upass) < 6){
		$error[] = "¡La contraseña debe contener almenos 6 caracteres!";	
	}else if($estatus=="")	{
		$error[] = "¡El estatus se define con un valor 1 / 0!";	
	}
	else
	{
		try
		{
			$stmt = $user->runQuery("SELECT user_cve ,user_name FROM users WHERE user_cve=:cve OR user_name=:uname");
			$stmt->execute(array(':cve'=>$ucve, ':uname'=>$uname));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['user_cve']==$ucve) {
				$error[] = "¡Lo sentimos esta clave ya existe !";
			}
			else if($row['user_name']==$uname) {
				$error[] = "¡Lo sentimos ese nombre de usuario ya existe !";
			}
			else
			{
				if($user->register($ucve, $uname, $apPat,$apMat,$umail,$upass,$session,$estatus)){	
					$user->redirect('sign-up.php?joined');
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}	
}

?>
<!DOCTYPE html">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Registrar Usuario </title>
	<link rel="shortcut icon" href="page/img/sdtl.ico">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-slim.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<img class="img-fluid imgportada" src="page/img/SIDTAL.png"></img>
	</div>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#">IFP-CDMX</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="p_sadmin.php">Inicio <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Constancias
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Constancias Cursos</a>
							<a class="dropdown-item" href="#">Participantes Cursos</a>
							<a class="dropdown-item" href="#">Constancias Cursos Historico</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Constancias Certificaciones</a>
							<a class="dropdown-item" href="#">Participantes Certificaciones</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Kardex</a>

						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Conferencias
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Conferencias</a>
							<a class="dropdown-item" href="#">Personas Registradas</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Registro Asistencia</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Asistentes</a>
							<a class="dropdown-item" href="#">Estadísticas</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Convocatorias
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Categorías</a>
							<a class="dropdown-item" href="#">Convocatorias</a>
							<a class="dropdown-item" href="#">Publicaciones</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Manual</a>
						</div>

					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Formación</a>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Usuarios
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="sign-up.php" target="_self">Registro de Usuarios</a>
							<a class="dropdown-item" href="listar_usuario.php" target="_self">Listado de Usuarios</a>
						</div>

					</li>
				</ul>
				<ul class="navbar-nav mr-auto my-2 my-lg-0">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Hola <?php print($useradm['user_name']); ?>
						</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="profile.php?id=<?php echo $useradm['user_id']; ?>">Configurar Perfil</a>
							<a class="dropdown-item" href="sidtalrights.php">Acerca de SIDTAL</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="logout.php?logout=true">Cerrar Sessión</a>
						</div>

					</li>
				</ul>
			</div>
		</nav>
	</div>
	
	<div class="signin-form">
		<div class="container">
			<form method="post" class="form-signin">
				<h2 class="form-signin-heading">Registro Usuario</h2><hr />
				<?php
				if(isset($error))
				{
					foreach($error as $error)
					{
						?>
						<div class="alert alert-danger">
							<i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
						</div>
						<?php
					}
				}
				else if(isset($_GET['joined']))
				{
					?>
					<div class="alert alert-info">
						<i class="glyphicon glyphicon-log-in"></i> &nbsp; Usuario Registrado <a href='index.php'>Ingresar</a> Aquí
					</div>
					<?php
				}
				?>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="txt_cve" placeholder="Ingresa Clave" value="<?php if(isset($error)){echo $ucve;}?>" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_uname" placeholder="Nombre" value="<?php if(isset($error)){echo $uname;}?>" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_appat" placeholder="Apellido Paterno" value="<?php if(isset($error)){echo $apPat;}?>" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_apmat" placeholder="Apellido Materno" value="<?php if(isset($error)){echo $apMat;}?>" />
						</div>
					</div><!--Fin de col-md-6  1-->

					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="txt_umail" placeholder="Ingresa tu email" value="<?php if(isset($error)){echo $umail;}?>" />
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="txt_upass" placeholder="Ingresa la contraseña" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_session" placeholder="Session de Usuario" value="<?php if(isset($error)){echo $session;}?>" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="txt_estatus" placeholder="Estatus del usuario" value="<?php if(isset($error)){echo $estatus;}?>" />
						</div>
					</div><!--Fin de col-md-6  2-->
					<div class="clearfix"></div><hr/>
					<div class="row">
						<div class="col-md-2">
						<div class="form-group">
							<button type="submit" class="btn btn-primary" name="btn-signup">
								Registrar
							</button>
						</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							<input type="reset" class="btn btn-warning" value="Borrar información">
						</div>
					    </div>

					    <div class="col-md-4">
						<div class="form-group">
							<a class="btn btn-success" href="listar_usuario.php">Listado de usuarios</a>
						</div>
					    </div>

					    <div class="col-md-2">
						<div class="form-group">
							<a class="btn btn-danger" href="p_sadmin.php">Regresar</a>
						</div>
					    </div>
					</div><!--Fin de Row -->
				</div><!--Fin de Row -->
				<br />
			</form>

		</div>
	</div>
	
</body>
</html>


