<?php

require_once('dbconfig.php');

class USER
{	

	private $conn;
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	
	public function register($ucve,$uname,$apPaterno,$apMaterno,$umail,$upass,$session,$est)
	{
		try
		{
			$new_password = password_hash($upass, PASSWORD_DEFAULT);
			
			$stmt = $this->conn->prepare("INSERT INTO users(user_cve,user_name,ApellidoPaterno,ApellidoMaterno,user_email,user_pass,session_usr,estatus) VALUES(:cve,:uname,:apepat,:apemat,:umail, :upass,:session, :sts)");
			
			$stmt->bindparam(":cve", $ucve);
			$stmt->bindparam(":uname", $uname);
			$stmt->bindparam(":apepat", $apPaterno);
			$stmt->bindparam(":apemat", $apMaterno);
			$stmt->bindparam(":umail", $umail);
			$stmt->bindparam(":upass", $new_password);
			$stmt->bindparam(":session", $session);
			$stmt->bindparam(":sts", $est);										  
				
			$stmt->execute();	
			
			return $stmt;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}				
	}
	
	public function doLogin($ucve,$uname,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT user_id, user_cve, user_name, user_pass FROM users WHERE user_cve=:ucve OR user_name=:uname");
			$stmt->execute(array(':ucve'=>$ucve,':uname'=>$uname));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowCount() == 1)
			{
				if(password_verify($upass, $userRow['user_pass']))
				{
					$_SESSION['user_session'] = $userRow['user_id'];
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	
	public function is_loggedin()
	{
		if(isset($_SESSION['user_session']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		header("Location: $url");
	}
	
	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['user_session']);
		return true;
	}
}
?>