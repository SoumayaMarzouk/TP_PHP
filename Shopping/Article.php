<html>
<head>

</head>
<body>

<?php

class Article  {
    private $reference;
    private $libelle;
    private $fournisseur;
	private $prix;
	private $Qte;
 
    function __construct($reference, $libelle, $fournisseur,$prix,$Qte) {
        $this->reference=$reference;
        $this->libelle = $libelle;
        $this->fournisseur = $fournisseur;
		$this->prix = $prix;
		$this->Qte = $Qte;
    
    }
    
    public function __get($attr) {
        if (!isset($this->$attr)) return "erreur";
        else return ($this->$attr);}
    public function __set($attr,$value) {
            $this->$attr = $value; }
            
    public function __toString() 
	{
		$s="<tr> <td> $this->reference </td><td> $this->libelle </td><td> $this->fournisseur </td><td> $this->prix </td><td> $this->Qte </td></tr>";
		return $s; 
		} 
		
		public static function ajouterArticle($article)
		{
			include("connexion.php");
		
			$nb=$conn->exec("insert into article values('$article->reference','$article->libelle',$article->prix,$article->Qte,$article->fournisseur)") or die(print_r($conn->errorInfo()));
			
			return $nb;
			}
		
		public static function supprimerArticle($ref)
		{
			include("connexion.php");
			$conn->exec("delete from article where ref='$ref'");
		}
		
		public static function chercherArticle()
		{
			include("connexion.php");
			//tableau qui va contenir les objets article
			$listArticles=[];
			$resultat=$conn->query("select * from article");
			$donnees=$resultat->fetchAll();
			foreach($donnees as $ar)
			{
				$f=$ar['id_fournisseur'];
				$reultF=$conn->query("select nom_four from fournisseur where id_four=$f");
				$LigneFour=$reultF->fetch();
				
				$listArticles[]=new article($ar['ref'],$ar['libelle'],$LigneFour['nom_four'],$ar['prix'],$ar['Qt']);
			}
			return $listArticles;
		}
		
        
}




?>
</body>
</html>
