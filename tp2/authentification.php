<?php

$login=$_post["login"];
$mp=$_post["mdp"];

if($login=='admin' && $mp=='admin')
{
	echo 'Bonjour'.$login.'<br>';
	echo "vous etes connecté";
}
else
	header ('Location:authentification.html');

?>