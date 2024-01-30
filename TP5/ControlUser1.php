<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
include("User.php");
session_start(); 
			$login=$_GET['login'];
			$password=$_GET['password'];
			$p= new User($login,$password);
			$s=$p->connect();
			//$s=User::connect($login,$password);
			if($s == false)
				{//echo "login ou password incorrect";}
				header ('Location:authentificationOO.html');}
			else 			
			{	//echo $p;
				//echo 'Login: '.$user->login.'<br>';				
				//Ecriture des cookies
				//setcookie("log",$login,time() + 86400); // 86400 = 1 jour
			
				//setcookie("pass",$password,time() + 86400);
				//-------version2: sessions:----------
				$_SESSION["user"]=$login;
				//------------------------------------
				//echo "vous etes connecté";
				header ('Location:viewarticle.php');
				//header ('Location:View_article.php');
			}
		?>
</body>
</html>