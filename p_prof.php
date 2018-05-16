<?php
    require_once("session.php");
    require_once("class.user.php");
    $auth_user = new USER();
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

     if(!$userRow['session_usr']==4){
      header('Location:logout.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial=scale=1, shrink-to-fit=no">
  <title>Bienvenido Compañero: <?php print($userRow['user_name']); ?></title>
  <link rel="shortcut icon" href="page/img/sdtl.ico">
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
        <a class="nav-link" href="p_prof.php">Inicio <span class="sr-only">(current)</span></a>
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
    </ul>

    <ul class="navbar-nav mr-auto my-2 my-lg-0">
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Hola <?php print($userRow['user_name']); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="profile.php?id=<?php $userRow['user_id']; ?>">Configurar Perfil</a>
          <a class="dropdown-item" href="sidtalrights.php">Acerca de SIDTAL</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php?logout=true">Cerrar Sessión</a>
        </div>
       
      </li>
      </ul>
    
  </div>
</nav>

  </div>
  <div class="container">
    <div class="jumbotron">
      <h2 class="display-6">Menu de Profesionalización</h2>
      <p class="lead">Bienvenido al Sistema de Administración del IFP</p>
    </div>
  </div>

  <div class="container">
    <footer id="pie">
      <?php include('pie.php'); ?>
    </footer>
  </div>
  </body>
</html>