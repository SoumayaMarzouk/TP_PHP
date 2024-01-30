<html>

<head>
    <title>Article</title>
    <meta charset="utf-8" />

    <style>
        .msgRed {
            color: red;
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
?>
    <form action="ControlArticle.php" method="POST">
        <br><label for="ref">Référence de l'article : </label>
        <br><input type="text" name="ref"> <br>
        <br><label for="lib">Libellé de l'article : </label>
        <br><input type="text" name="lib"><br>
        <br><label for="frs">Fournisseur de l'article : </label>

        <br><select multiple name="frs[]">
            <?php
            include_once("connexion.php");
            $sql = $conn->query("select * from fournisseur");
            $donneesF = $sql->fetchAll();
            foreach ($donneesF as $ligne) {
                echo '<option value=' . $ligne[0] . '>' . $ligne[1] . '</option>';
            }

            ?>
        </select><br>


        <br><label for="pv">Point de vente : <?php if (isset($_POST['ref']) && !isset($_POST['pv'])) echo "<span class='msgRed'>il faut cocher au moins un point de vente</span>" ?><br>
            <input type="checkbox" name="pv[]" value="PV1">Point de vente 1 <br>
            <input type="checkbox" name="pv[]" value="PV2">Point de vente 2 <br>
            <input type="checkbox" name="pv[]" value="PV3">Point de vente 3 <br>
            <br><label for="prix">Prix de l'article : </label>
            <br><input type="number" name="pr" min="0"><br>
            <br><label for="qte">Quantité disponible : </label>
            <br><input type="number" name="qt" min="0"><br>
            <br><input type="submit"  name="ajouter" value="Ajouter">
            <input type="submit" name="modifier" value="Modifier">
            <input type="submit" name="supprimer" value="supprimer">
    </form>

    <?php
    include("Article1.php");
    //affichage de tous les articles
    $listArt = Article::AfficherArticles();
    echo "<h3>La liste de tous les articles</h3>";
    echo "<table class='tab'>";
    echo "<tr><th>référence</th><th>Libellé</th><th>fournisseurs</th><th>Prix</th><th>Qte stock</th></tr>";
    foreach ($listArt as $Art) {
        
        echo $Art;
       
    }
    
    echo "</table>";
    ?>
    
    
</body>

</html>