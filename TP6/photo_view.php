<?php
if (isset($_GET['refPr']))
{  $reff=$_GET['refPr'];}
    ?>
<form action="photo_control.php" 
	method="post" 
	enctype="multipart/form-data"> 
       
<label for="mon_fichier">Sélectionnez un produit à telecharger :</label>  
  
<input type = "file" name="mon_fichier" id="mon_fichier"><br>   
<input type="hidden" name="reff" value="<?=$reff?>" />
<input type="submit" value="Télécharger"></form>


