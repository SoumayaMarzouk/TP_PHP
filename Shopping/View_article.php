<?php
//version2: sessions 

//session_start();
?>

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
		.stylTab, .stylTab td, .stylTab th{
			border: 1px solid black;
		}
		
    </style>
</head>

<body>

 <?php
 
	if (!isset($_COOKIE['log']))
	{
	header ('Location:authentification.html');
            
	}
	else{
		$login=$_COOKIE['log'];
		echo "Utilisateur:$login <br>";
		if (isset($_COOKIE['compteur']))
		{
			$message = "Vous etes deja venu ".$_COOKIE['compteur']." fois<br>";
            $c = $_COOKIE['compteur'] + 1;
        }
        else
        {
            $message = "c'est votre première visite<br>";
            $c = 1;
        }
        setCookie("compteur", $c);
        echo $message;
		}
 
 
 //-------version2: sessions:----------
 
	/* if(!isset($_SESSION["user"]))
	{
		header ('Location:authentification.html');
	}
	else{
		
		$login=$_SESSION["user"];
		echo "Utilisateur: $login<br>";
		
		
	} */
 //------------------------------------
 
//Les messages d'erreurs sont initialement vides
$msgErreurRef="";
$msgErreurLib="";
$msgErreurPV="";
$msgErreurPrix="";
$msgErreurQte="";

 $ref="";
 $libelle="";
 $PV=array();
 $four="";
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
		  $msgErreurPV="il faut choisir au moins au point de vente";
	  
	  $four=$_GET["four"];
 }
   


?>

    <h1>Saisir un article</h1><br><br>
    <form name="f" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <table>
            <tr>
                <td><label for="ref">référence</label>: </td>
                <td><input name="ref" type="text" value="<?php echo $ref;?>" /><span class="msgE">
                        <?php echo $msgErreurRef; ?></span></td>
            </tr>
            <tr>
                <td><label for="libelle">libellé</label>: </td>
                <td><input name="libelle" type="text" /><span class="msgE">
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
                    <select name="four" >
					<?php 
					include_once("connexion.php");
					
					$sql=$conn->query("select * from fournisseur");
					$donneesF = $sql->fetchAll();
					foreach ($donneesF as $ligne)
						{ echo '<option value='.$ligne[0].'>'.$ligne[1].'</option>'; 
						}

                        ?>
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
		<input type="button" name="sup" value="supprimer article" onclick="suppArticle(document.f.ref.value)">
		
    </form>
	<script>
	function suppArticle(x,y)
	{
		
		document.location.href='suppr.php?ref='+x;
	}
	</script>
	



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
        
            echo $four ; 
        ?>
    </ul>

    <span class="st">Points de vente: </span>
    <ul>
        <?php 
        foreach($PV as $p)
            echo "<li> $p </li>" ; 
        ?>
    </ul>
	
	<?php
	include("Article.php");
	//insertion de l'article dans la table "article"
	if($ref!=null && $libelle!=null && $prix!=null && $qte!=null)
	{
		//$nb=$conn->exec("insert into article values ('$ref', '$libelle',$prix,$qte,$four)");
		// if ($nb>0) echo '<script>alert("article ajouté avec succès")</script>';
		
		//version2: insertion de l'article en passant par l'objet Article
		$Ar=new Article($ref,$libelle,$four,$prix,$qte);
		$nb=Article::ajouterArticle($Ar);
		if($nb>0)
		{
			echo '<script>alert("Article ajouté")</script>';
			//affichage de tous les articles
			$listArt=Article::chercherArticle();
			echo "<h3>La liste de tous les articles</h3>";
			echo "<table class='stylTab'>";
			echo "<tr><th>référence</th><th>Libellé</th><th>fournisseur</th><th>Prix</th><th>Qte stock</th></tr>";
			foreach($listArt as $Art)
			{
				echo $Art;
			}
			echo "</table>";
			
		}
	}
	
	?>

</body>

</html>
