<html>

<head>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <th>nom</th>
            <th>moyenne</th>
        </tr>
        <?php
        require 'util.php';



        //affichage avec tableau HTML
        foreach ($tab as $nom => $moy) {
            $chaine = couleur($moy);
        ?>

            <tr>
                <td><?= $nom ?></td>
                <td style='background-color: <?= $chaine ?>;'> <?= $moy ?></td>
            </tr>

        <?php } ?>

    </table>
</body>

</html>