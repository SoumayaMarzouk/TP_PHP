<html>
<head>
<style>
table {
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php 
    
echo "<table>";
echo "<tr><th>Nom</th><th>Moyenne</th></tr>";

$tab=array("Ali"=>12,"Mohamed"=>13,"Mariem"=>12);

//affichage avec tableau HTML
foreach ($tab as $cle => $val)
{
    echo "<tr>";
    echo "<td>$cle</td><td>$val</td>" ;
    //echo $val;
    echo "</tr>";
}
echo "</table>";
?>
    </body>
</html>

