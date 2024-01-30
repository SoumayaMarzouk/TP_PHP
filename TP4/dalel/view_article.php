<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<form action="controlArticle.php" method="POST">

  <!--reference-->
<br><label for="ref">Référence de l'article : </label>
        <br><input type="text" name="ref"> <br>


 <!--libelle-->
 <br><label for="lib">Libellé de l'article : </label>
        <br><input type="text" name="lib"><br>  
        
        

   <!--liste fournisseur -->     
  <br><label for="frs">Fournisseur de l'article : </label>

<br><select multiple name="frs[]">      
<?php

include_once("Connexion.php");
 $sql = $conn->query("select * from fournisseur");
            $donneesF = $sql->fetchAll();
            foreach ($donneesF as $ligne) {
                echo '<option value=' . $ligne[0] . '>' . $ligne[1] . '</option>';
            }

?>
</select><br>

<!--Point de vente-->
<br><label for="pv">Point de vente : <?php if (isset($_POST['ref']) && !isset($_POST['pv'])) echo "<span class='msgRed'>il faut cocher au moins un point de vente</span>" ?><br>


<input type="checkbox" name="pv[]" value="PV1">Point de vente 1 <br>
 <input type="checkbox" name="pv[]" value="PV2">Point de vente 2 <br>
  <input type="checkbox" name="pv[]" value="PV3">Point de vente 3 <br>



<!--prix-->
 <br><label for="prix">Prix de l'article : </label>
 <br><input type="number" name="pr" min="0"><br>


 
 <!--Quantite-->
 <br><label for="qte">Quantité disponible : </label>
            <br><input type="number" name="qt" min="0"><br>





   <!--boutton-->

<br><input type="submit"  name="ajouter" value="Ajouter">
<input type="submit" name="supprimer" value="supprimer">
<input type="submit" name="modifier" value="Modifier">

</form>




<hr>
    <h3>Liste des articles</h3>
    <form name="form2" action="view_article.php" method="post">
        <label for="refLibsearch">Référence/libellé : </label>
        <input type="text" name="refLibsearch">

        <label for="prixMin">Prix minimum</label>:
        <input name="prixMin" type="number" size="6" />
        <label for="prixMax">Prix maximum</label>:
        <input name="prixMax" type="number" size="6" />
        <input type="submit" name="chercher" value="chercher">
    </form>
    <br>
    <br>
    <table class='tab'>
        <tr>
            <th>référence</th>
            <th>Libellé</th>
            <th>fournisseurs</th>
            <th>Prix</th>
            <th>Qte stock</th>
            <th>Action</th>
        </tr>
        <?php
        include("article.php");
        // Le cas ou l'utilisateur a lancé une recherche
        $ch = $pmin = $pmax = '';

        if (isset($_POST['chercher'])) 
        {
            if (!empty($_POST['refLibsearch']))
                $ch = $_POST['refLibsearch'];
            if (!empty($_POST['prixMin']))
                $pmin = $_POST['prixMin'];
            if (!empty($_POST['prixMax']))
                $pmax = $_POST['prixMax'];

            //affichage des articles recherchés
            $listArt = article::chercherArticles($ch, $pmin, $pmax);
        } else 
        { 
          //affichage de tous les articles
            $listArt = article::AfficherArticles();
        }
    
        //Question3
        // foreach ($listArt as $Art) {
        //     echo $Art;
        // }
        foreach ($listArt as $Art) {
            echo "<tr><td>" . $Art->reference . "</td>";
            echo "<td>" . $Art->libelle . "</td>";
            //implode:Rassemble les éléments d'un tableau en une chaîne
            echo "<td>" . implode("<br>", $Art->fournisseurs) . "</td>";
            echo "<td>" . $Art->prix . "</td>";
            echo "<td>" . $Art->Qte . "</td>";
            echo "<td><a href='controlArticle.php?refsupp=" . $Art->reference 
            . "'>Supprimer</a></td>";
            /*echo "<td><a href=ControlArticle.php?refsupp=" $Art->reference.
            "&Qtesupp=".$Art->Qte.">Rectifier</a></td>";*/
            echo "</tr>";
        }

        echo "</table>";

      ?>







<?php

/*
    include("article.php");
    //affichage de tous les articles
    $listArt = article::AfficherArticles();
    echo "<h3>La liste de tous les articles</h3>";
    echo "<table class='tab'>";
    echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th></tr>";
    foreach ($listArt as $Art) {
        

        echo $Art;
       
    }
    
    echo "</table>";*/

    

    ?> 
    
    


</body>
</html>