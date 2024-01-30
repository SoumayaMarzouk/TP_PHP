<?php
include 'photo_view.php';
$ref=$_POST['reff'];
//var_dump($_FILES);
/*if (isset($_FILES['mon_fichier'])) 
{    
	$fichier = $_FILES['mon_fichier'];    
	echo 'Nom du fichier : ' . $fichier['name'] . '<br>';    
	echo 'Type MIME du fichier : ' . $fichier['type'] . '<br>';    
	echo 'Taille du fichier : ' . $fichier['size'] . ' octets<br>';   
	echo 'Emplacement temporaire du fichier : ' . $fichier['tmp_name'] . '<br>';
}*/
if(isset($_FILES['mon_fichier']) && $_FILES['mon_fichier']['error'] == 0) {   
    // Vérifie si le fichier a été uploadé sans erreur.  
   $nom_fichier = $_FILES['mon_fichier']['name'];    
   $tmpName = $_FILES['mon_fichier']['tmp_name'];
    $size = $_FILES['mon_fichier']['size'];
    $error = $_FILES['mon_fichier']['error'];
   $destination = 'Article_photo/photo_' . $ref;   
   //découper une chaîne de caractère en plusieurs morceaux à partir d’un délimiteur
   $tabExtension = explode('.', $nom_fichier);
   //mettre en minuscule le dernier élément de ce tableau
    $extension = strtolower(end($tabExtension)); 
    //Tableau des extensions que l'on accepte
    $extensions = ['jpg','jpeg'];
    $maxSize = 5000000;
    $file = $destination.".".$extension;
    if(in_array($extension, $extensions) && $size <= $maxSize && $error==0){
        move_uploaded_file($tmpName, $file);
        header("Location: addPanierView.php?refimg=" . $ref . "&photo=" . $file);
    }
    else{
        echo "Mauvaise extension ou taille trop grande";
    }}
    
   
?>

    
