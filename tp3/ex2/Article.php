<?php

class Article
{
    private $reference;
    private $libelle;
    private $prix;
    private $qteEnStock;
   


    function __construct($reference, $libelle, $prix, $qteEnStock)
    {
        $this->reference = $reference;
        $this->libelle = $libelle;
        $this->prix = $prix;
        $this->qteEnStock = $qteEnStock;
    }


    public function __get($attr)
    {
        if (!isset($this->$attr))
            return "erreur";
        else
            return ($this->$attr);
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }


    public function __toString()
    {
        $s = "<tr> <td> $this->reference </td>
                    <td> $this->libelle </td>
                    <td> $this->prix </td>
                    <td> $this->qteEnStock </td>
                    </tr>";                    
        return $s;
    }
    public static function ajouter($article)
		{
			include("connexion.php");
		
			$nb=$conn->exec("INSERT into article values('$article->reference','$article->libelle',$article->prix,$article->qteEnStock)") or die(print_r($conn->errorInfo()));
			
			return $nb;
			}
		
		public static function supprimer($ref)
		{
			include("connexion.php");
			$conn->exec("DELETE from article where ref='$ref'");
		}
        public static function modifier($ref)
		{
			include("connexion.php");
			$conn->exec("UPDATE article SET libelle = :libelle, prix = :prix , 
            Qtstock = :qtstock WHERE ref='$ref'");
		}
} // fin de la classe


$a1=new Article(324,"Souris",100,10);
$a1::ajouter($a1);
//$a2=new Article(325,"Tablette",250,70,["Four1","Four2"],["pv1","pv2"]);
//$a3=new Article(326,"Ecran",470,80,"Four3","pv1");
//echo $a1;
//echo $a2;
//echo $a3;

/*
echo "Le libelle est : ".$a1->libelle."<br>";
$a1->reference=5000;
echo "Le prix est : ".$a1->prix."<br>";
*/

/*
echo "<br>";
echo "<table border=1>";
echo "<tr><td>Reference</td><td>libelle</td><td>Prix</td>
<td>qteEnStock</td><td>fournisseur</td></tr>";

echo $a1; 
echo $a2; 
echo $a3; 
echo "</table>";
<ul style="list-style-type:none;">
*/