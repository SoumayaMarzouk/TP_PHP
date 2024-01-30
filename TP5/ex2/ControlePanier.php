<?php
include("connexion.php");
include('panier.php');
session_start();
if(isset($_GET['submit'])){
	$reference = $_GET['ref'];
	$qte = $_GET['qtestk'];
	if (!isset($_SESSION['panier'])) {
		$p = new panier();
		//var_dump($p); // Debug statement
		$p->addPanier($reference, $qte);
		$_SESSION['panier'] = serialize($p);
		echo($p);
		//echo '<script> document.location.href="panier_view.php"</script>';
	} else {
		$p = unserialize($_SESSION['panier']);
		//var_dump($p); // Debug statement
		$p->addPanier($reference, $qte);
		$_SESSION['panier'] = serialize($p);
		echo($p);
		//echo '<script> document.location.href="panier_view.php"</script>';
	}
}


//consulter panier
	/*if (!isset($_SESSION['panier'])) {
		echo "Votre panier est vide";
	} else {
		$p = $_SESSION['panier'];
		echo $p;*/
	

?>


