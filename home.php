<?php
    require_once("session.php");
    require_once("class.user.php");

    $auth_user = new USER();
    $user_id = $_SESSION['user_session'];
    
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    switch ($userRow['session_usr']) {
      case 1:
       header('Location:p_sadmin.php');
        break;
      case 2:
       header('Location:p_sidtal.php');
        break;
      case 3:
       header('Location:p_dase.php');
        break;
      case 4:
       header('Location:p_prof.php');
        break;
      default:
        header('Location:index.php');
        break;
    }
?>