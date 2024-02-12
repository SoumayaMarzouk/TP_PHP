<?php

$login=$_POST["login"];
$mp=$_POST["mdp"];
if (isset($login)){
if($login=='admin' && $mp=='admin')
{
	echo 'Bonjour '.$login.'<br>';
	echo "vous etes connecté";
}
else
	echo "login/mot de passe incorrect";
}
else
	header ('Location:authentification.html');

?>