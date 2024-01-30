<?php
//---------version2: sessions:--------------

//session_start();

//--------------------------------

$login=$_POST["login"];
$mp=$_POST["mdp"];

include("connexion.php");

$sql = $conn->query("SELECT * FROM users WHERE login = '$login' and passwd='$mp'");
$user=$sql->fetch(PDO::FETCH_OBJ); // Récupérer sous forme d’objet

if ($sql->rowCount()>0) //les cordonnées du user existent dans la table de la BD

{
	echo 'Login: '.$user->login.'<br>';
	
	//Ecriture des cookies
	setcookie("log",$login,time() + 86400); // 86400 = 1 jour

    setcookie("pass",$mp,time() + 86400);


	
	//-------version2: sessions:----------
	//$_SESSION["user"]=$login;
	//------------------------------------
	//echo "vous etes connecté";
	header ('Location:View_article.php');

}
else
	header ('Location:authentification.html');

?>