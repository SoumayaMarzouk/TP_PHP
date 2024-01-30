<?php
//var_dump($_FILES);
if (isset($_FILES['mon_fichier'])) 
{    
	$fichier = $_FILES['mon_fichier'];    
	echo 'Nom du fichier : ' . $fichier['name'] . '<br>';    
	echo 'Type MIME du fichier : ' . $fichier['type'] . '<br>';    
	echo 'Taille du fichier : ' . $fichier['size'] . ' octets<br>';   
	echo 'Emplacement temporaire du fichier : ' . $fichier['tmp_name'] . '<br>';
}
if(isset($_FILES['mon_fichier']) && $_FILES['mon_fichier']['error'] == 0) {   
    // Vérifie si le fichier a été uploadé sans erreur.    
   $nom_fichier = $_FILES['mon_fichier']['name'];    
   $destination = 'uploads/' . $nom_fichier;    
   // Déplace le fichier de l'emplacement temporaire vers le répertoire //permanent.    
   if(move_uploaded_file($_FILES['mon_fichier']['tmp_name'], $destination)){        
       echo 'Fichier téléchargé avec succès.';    
   } else {        
       echo 'Une erreur est survenue lors du téléchargement.';    	
   }
} else {   
echo 'Une erreur est survenue lors du téléchargement du fichier.';
}

?>
