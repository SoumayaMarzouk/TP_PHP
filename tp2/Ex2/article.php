<!DOCTYPE HTML>
<html>
<head>
    <style>
        h1 {
            text-align: center;
        }
        Body {
            margin-left: 20px;
        }
        .st {
            color: blue;
        }
    </style>
</head>
<body>
    <?php
    $libelle = $_GET["libelle"];
    $ref = $_GET["ref"];
    $four = $_GET["four"];
    $PV = $_GET["PV"];
?>
    <h1> Informations de l'article</h1><br><br>
    <span class="st">Référence:</span>
    <?php echo $ref;?><br>
    <span class="st">Libelle:</span>
    <?php echo $libelle;?><br>
    <span class="st">Fournisseur:</span>
    <ul>
        <?php 
            if(!empty($four))
                {                
                    foreach($four as $f)
                     echo "<li> $f </li>" ; 
                }
        ?>
    </ul>

    <span class="st">Points de vente: </span>
    <ul>
        <?php 
            if(isset($PV))
                {
                foreach($PV as $p)
                echo "<li> $p </li>" ; 
                }	
        ?>
    </ul>
</body>

</html>
