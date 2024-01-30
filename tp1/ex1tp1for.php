<?php
$tab=array("Dupont","Schmoll","Smith","Stan","Londres");
echo "<ul>";
/*foreach($tab as $valeur)
{
	echo "<li>". $valeur ."</li>";
}
echo "</ul>";*/
for ($i=0; $i<sizeof($tab); $i++)
 {
    echo "<li>". $tab[$i] . "</li>";
}
 echo "</ul>";

?>