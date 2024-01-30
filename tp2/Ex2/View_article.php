<!DOCTYPE HTML>
<html>
<head>
    <style>
        td {
            vertical-align:top;
        }
        h1 {
            text-align: center;
        }    
        .st {
            color: blue;
        }
		.msgE{color:red;}
    </style>
</head>
<body>

    <?php


//Les messages d'erreurs sont initialement vides
$msgErreurRef="";
$msgErreurLib="";
$msgErreurPV="";
$msgErreurPrix="";
$msgErreurQte="";

 $ref="";
 $libelle="";
 $PV=array();
 $four=array();
 $prix="";
 $qte="";


 if(isset($_GET["ref"])) //si le formulaire a été soumis (l'utilisateur a cliqué sur "submit")
 {
	 if (!empty($_GET["ref"]))
		 $ref=$_GET["ref"];
	 else
		  $msgErreurRef="le champ reference est requis";
	  if (!empty($_GET["prix"]))
		 $prix=$_GET["prix"];
	 else
		  $msgErreurPrix="le champ Prix est requis";
	  if (!empty($_GET["qte"]))
		 $qte=$_GET["qte"];
	 else
		  $msgErreurQte="le champ Qte en stock est requis";
	  
	  if (!empty($_GET["libelle"]))
		 $libelle=$_GET["libelle"];
	 else
		  $msgErreurLib="le champ libelle est requis";
	  
	  if (!empty($_GET["PV"]))
		 $PV=$_GET["PV"];
	 else
		  $msgErreurPV="il faut choisir au moins un point de vente";
	  
	  $four=$_GET["four"];
 }
   


?>

    <h1>Saisir un article</h1><br><br>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <table>
            <tr>
                <td><label for="ref">référence</label>: </td>
                <td><input name="ref" type="text" value="<?php echo $ref;?>" /><span class="msgE">
                        <?php echo $msgErreurRef; ?></span></td>
            </tr>
            <tr>
                <td><label for="libelle">libellé</label>: </td>
                <td><input name="libelle" type="text" value="<?php echo $libelle;?>"/>
                <span class="msgE">
                        <?php echo $msgErreurLib; ?></span></td>
            </tr>
			<tr>
                <td><label for="prix">Prix</label>: </td>
                <td><input name="prix" type="text" /><span class="msgE">
                        <?php echo $msgErreurPrix; ?></span></td>
            </tr>
			<tr>
                <td><label for="qte">Qte en stock</label>: </td>
                <td><input name="qte" type="text" /><span class="msgE">
                        <?php echo $msgErreurQte; ?></span></td>
            </tr>

            <tr>
                <td> <label for="four">Fournisseur</label>:</td>
                <td>
                    <select name="four[]" multiple size=2>
                        <option selected="selected" value="fournisseur1">fournisseur1</option>
                        <option value="fournisseur2">fournisseur2</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td> <label for="PV">Point de vente</label></td>
                <td>
                    <input type="checkbox" name="PV[]" value="Sfax">Sfax
                    <br>
                    <input type="checkbox" name="PV[]" value="Gabes">Gabes <span class="msgE">
                        <?php echo "  ".$msgErreurPV; ?></span></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="Submit">


    </form>



    <h3> Informations de l'article</h3><br><br>
    <span class="st">Référence:</span>
    <?php echo $ref;?><br>
    <span class="st">Libelle:</span>
    <?php echo $libelle;?><br>
	<span class="st">Prix:</span>
    <?php echo $prix;?><br>
	<span class="st">Quantité en stock:</span>
    <?php echo $qte;?><br>
    <span class="st">Fournisseur:</span>
    <ul>
        <?php 
        foreach($four as $f)
            echo "<li> $f </li>" ; 
        ?>
    </ul>

    <span class="st">Points de vente: </span>
    <ul>
        <?php 
        foreach($PV as $p)
            echo "<li> $p </li>" ; 
        ?>
    </ul>

</body>

</html>
