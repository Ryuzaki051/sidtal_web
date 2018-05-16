<?php
    require_once("session.php");
    require_once("class.user.php");
    $auth_user = new USER();
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

     if(!$userRow['session_usr']==1){
      header('Location:logout.php?logout=true');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial=scale=1, shrink-to-fit=no">
  <title>Bienvenido S-Admin <?php print($userRow['user_name']); ?></title>
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
        <a class="nav-link" href="p_sadmin.php">Inicio <span class="sr-only">(current)</span></a>
      </li>
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Constancias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="xConsconstanciasCurso.php">Constancias Cursos</a>
          <a class="dropdown-item" href="xConsParticipantesCurso.php">Participantes Cursos</a>
          <a class="dropdown-item" href="xConsConstanciasCursoHist.php">Constancias Cursos Historico</a>
          <a class="dropdown-item" href="xConsParticipantesCursoHist.php">Participantes Cursos Historico</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="xConsConstanciasCertificaciones.php">Constancias Certificaciones</a>
          <a class="dropdown-item" href="xConsParticipantesCertificacion.php">Participantes Certificaciones</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="xConsKardex.php">Kardex</a>

        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Conferencias
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="xConfConferencias.php">Conferencias</a>
          <a class="dropdown-item" href="xConfPersonasRegistradas.php">Personas Registradas</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="">Registro Asistencia</a>
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
      <h2 class="display-6">Menu de Super Administrador</h2>
      <p class="lead">Bienvenido al Sistema de Administración del IFP</p>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="page/img/usuario-registrados.png" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Usuarios SIDTAL</h5>
            <p class="card-text">Administrar Usuarios.</p>
            <a href="listar_usuario.php" class="btn btn-primary">Abrir</a>
          </div>
        </div>  
      </div>

      <div class="col-md-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="page/img/conferencia-ventas.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Conferencias</h5>
            <p class="card-text">Registro de Asistencias para Jueves de Cultura Jurídica.</p>
            <a href="#" class="btn btn-primary">Abrir</a>
          </div>
        </div>  
      </div>

      <div class="col-md-4">
        <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="page/img/kardex-tres-cajones.jpg" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Kardex</h5>
            <p class="card-text">Generación de Kardex.</p>
            <a href="#" class="btn btn-primary">Abrir</a>
          </div>
        </div>  
      </div>

    </div>
  </div>

  <div class="container">
    <footer id="pie">
      <?php include('pie.php'); ?>
    </footer>
  </div>
  </body>
</html>