
<html>

<head>

    <style>
        .tab,
        .tab th,
        .tab td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
        }
    </style>

</head>

<body>



<?php

class article {
  private $reference;
  private $libelle;
  private $fournisseurs;
  private $prix;
  private $Qte;
  
  

  function __construct($reference, $libelle, $fournisseurs , $prix,$Qte)
  {
      $this->reference = $reference;
      $this->libelle = $libelle;
      $this->fournisseurs = $fournisseurs;
      //  $this->pv = $pv;
      $this->prix = $prix;
      $this->Qte = $Qte;
  }  


  public function __get($attr)
  {
      if (!isset($this->$attr)) return "erreur";
      else return ($this->$attr);
  }

  public function __set($attr, $value)
  {
      $this->$attr = $value;
  }


  public function __toString()
  {
      $s = "<tr> <td> $this->reference </td><td> $this->libelle </td><td><ul>";

      foreach ($this->fournisseurs as $f)
          $s = $s . "<li> $f </li>";
      $s = $s . "</ul></td>";
      //foreach ($this->pv as $p)
      //   $s = $s . "<li> $p </li>";


      $s = $s . "<td> $this->prix </td><td> $this->Qte </td></tr>";
      return $s;
  }




  public static function ajouterArticle($article)
  {

    // awl 7aja lazmni n7l cnx
    include("Connexion.php");


   //exec pour les commandes de mise à jour 
    $nb=$conn->exec("insert into article values ('$article->reference','$article->libelle',$article->prix, $article->Qte)")

    // pour lancer l'exception 
    or die(print_r($conn->errorInfo()));


    //puisque 3andi liste deroulante des fournisseurs lazmni boucle foreach 5trha 3ibara 3la tableau 
    foreach($article->fournisseurs as $f){

        //article_fournisseur c'est une table mawjouda fi BD shopping fiha reference et l'id de fournisseur 
        $conn->exec("insert into article_fournisseur values('$article->reference'
        ,'$f')")

        //lancer lexception si 'l ya
        or die(print_r($conn->errorInfo()));
    }
    //pour retourner la ligne inserer
    return $nb;
  }
    


      // la methode supprimer
      public static function supprimerArticle($ref)
        {
            include("Connexion.php");
            $nb = $conn->exec("delete from article where ref='$ref'");
            //$conn->exec("delete from article_fournisseur where ref='$ref'");
            return $nb;
        }





        //La methode modifier

       public static function modifierArticle($art) {
        
        //exec traj3 int 
            include("Connexion.php");

         $nb = $conn->exec("UPDATE article SET ref ='$art->reference', libelle = '$art->libelle' ,  
         prix = $art->prix , qte_Stock = $art->Qte WHERE ref = '$art->reference'")

        
         or die(print_r($conn->errorInfo()));

            if ($nb > 0) {
                $conn->exec("delete from article_fournisseur where ref='$art->reference'");
                foreach ($art->fournisseurs as $f) {

                    $conn->exec("insert into article_fournisseur values('$article->reference'
                    ,'$f')")
                    
                    or die(print_r($conn->errorInfo()));
                }
            }
            

            return $nb;

        }

    




// afficher article pour afficher le rt sous forme d'un tableau
// c'est une methode static 
    public static function AfficherArticles(){
        // 1/ouvrir la cnx

        include("Connexion.php");

        //3lech sna3thaa
        $listArticles = [];//c'est un tab
        //$sql variable jdida 7attit feha la reuete prepare
        //bech najim n connecti 3al base  w nlanci req lazmni dima n7ott la requete fi variable illi 7attit fiha cnx mte3i
        $sql = $conn ->prepare("select * from article");
        $sql ->execute();//pour executer la req prepare
        //On affiche les infos de la table
        //tlabt minh bch y7ottli le resultat de la req prepare fi tableau associatif
        $resultat =  $sql ->fetchAll(PDO::FETCH_ASSOC);
        //parcourir le tableau associatif 
        foreach ($resultat as $ar) {  
            //sna3 variable jdida 7att fiha req               
        $sqlF = $conn->prepare("SELECT * from article_fournisseur 
        where ref=:ref");//hedhi chma3neha mfhimthech blbehii
        $sqlF->bindParam(':ref',$ar['ref']);
        $sqlF ->execute();


         //7attit rt de req $sqlF fi tableau assoc
        $resultatF = $sqlF->fetchAll();
            //récupérer le tableau des fournisseurs de l'article
            $listFour = [];//c'est un tab
            foreach ($resultatF as $ligneF) {
                    $listFour[] = $ligneF['id'];
                    }           
            $listArticles[] = new article($ar['ref'], $ar['libelle'],$listFour, $ar['prix'], $ar['qte_Stock'] );
        }
          
        return $listArticles;
    }





    public static function chercherArticles($refLib, $pmin, $pmax)
    {

        include("Connexion.php");
        $listArticles = [];
        // requete
        $req = "SELECT * FROM article WHERE 1=1";
        if ($refLib != '') {
            $req .= " AND ref LIKE '%$refLib%' OR libelle LIKE '%$refLib%'";
        }

        if ($pmin != '') {
            $req .= " AND prix >= $pmin";
        }
        if ($pmax != '') {
            $req .= " AND prix <= $pmax";
        }
        $sql = $conn->query($req);
        $resultat = $sql->fetchAll();

        foreach ($resultat as $ar) {
            $sqlF = $conn->query("SELECT * from article_fournisseur 
            where ref='{$ar['ref']}'");        
            $resultatF = $sqlF->fetchAll();//ref='{$ar['ref']}'
            //récupérer le tableau des fournisseurs de l'article
            $listFour = [];
            foreach ($resultatF as $ligneF) {
                $listFour[] = $ligneF['id'];
            }

            $listArticles[] = new article(
                $ar['ref'],
                $ar['libelle'],
                $listFour,
                $ar['prix'],
                $ar['qte_Stock']
            );
        }
        return $listArticles;
    }
}











?>

    
</body>
</html>