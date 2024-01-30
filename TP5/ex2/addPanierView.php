<!DOCTYPE HTML>
<html>

<head>
    <style>
    .messagErreur {
        color: red;
    }

    table {
        border-collapse: collapse;
    }

    .stylTab {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <?php

    session_start();
    if (!isset($_SESSION["user"])) {
        header('Location:authentificationOO.html');
    } else {
        $login = $_SESSION["user"];
        echo "Utilisateur:$login <br>";
    }   
    
    include 'connexion.php';
    include 'Article.php';
      //------------------------------------
if (isset($_GET['refAj']))
{  $reff=$_GET['refAj'];
    echo "<table class='tab'>";
    echo "<tr> <th> Reference </th><th> Libelle </th><th> Prix </th><th> Quantité en stock</th></tr>";
    Article::DescriptionArticle($reff);
    }
    ?>

    <h3 align=center>
        <FONT size="10" align=center> <I><B>Ajouter au Panier</B></I></FONT>
    </h3><br><br>
    <form name="form1" action="ControlePanier.php" method="GET"> 

        <table>
            <tr>
                
                <td>
                <label>Référence</label>:</td>
                <td> <input name="ref" value="<?=$reff?>"></td>
            </tr>
            <tr>
                <td><label>Quantité à commander</label>:</td>
                <td> <input name="qtestk" type="number" /></td>
            </tr>
            <tr>
                <td colspan="2"> 
                <input type="submit" name="submit" value="Ajouter au panier">
                                    </td>
            </tr>
        </table>
    </form>

    <?php
/*
    if (isset($_GET['annuler'])) {
        unset($_SESSION['panier']);
    }

    if (isset($_GET['commade'])) {
        if (!isset($_SESSION['panier']))
            echo '<script> alert("votre panier est vide") </script>';
        else {
            $_SESSION['panier']->updateBD();
            echo '<script> alert("votre commande est bien confirmée") </script>';
            unset($_SESSION['panier']);
        }
    }*/
    ?>