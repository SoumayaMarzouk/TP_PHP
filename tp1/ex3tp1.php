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

 
    
<table>
<tr><th>nom</th><th>moyenne</th></tr>

<?php
$tab=array("ali"=>2,"med"=>13,"Karim"=>12);

function couleur($m)
{
    if($m<10)
	  return'red';
    else return 'green';
}
  
   
//affichage avec tableau HTML
foreach ($tab as $nom => $moy)
{
    $chaine=couleur($moy);
    echo "<tr>";
    echo "<td >$nom</td><td style='background-color: $chaine;'>$moy</td>" ;
    
    
    echo "</tr>";
}
 

?>
</table>
    </body>
</html>

