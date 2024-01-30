<?php
//---------version2: sessions:--------------
session_start();


$login=$_GET['login'];
$password=$_GET['password'];
include("connexion.php");

$sql = $conn->query("SELECT * FROM users WHERE login ='$login' and password='$password'");
$user=$sql->fetch(PDO::FETCH_OBJ); // Récupérer sous forme d’objet

if ($sql->rowCount()>0) //les cordonnées du user existent dans la table de la BD

{
	echo 'Login: '.$user->login.'<br>';
	
	//Ecriture des cookies
	//setcookie("log",$login,time() + 86400); // 86400 = 1 jour
    //setcookie("pass",$password,time() + 86400);

	//-------version2: sessions:----------
	$_SESSION["user"]=$login;
	//------------------------------------
	//echo "vous etes connecté";
	header ('Location:viewarticle.php');

}
else
	header ('Location:authentificationOO.html');

?>