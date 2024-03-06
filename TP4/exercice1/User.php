
	<?php
		class User{
			private $login;
			private $password;

			function __construct($login,$password){
				$this->login = $login;
				$this->password = $password;

			}	
			//private $data =array();

			public function __get($attr) {
				if (!isset($this->$attr)) return "erreur";
				else return ($this->$attr);
			}
			
			public function __set($attr,$value) {
				$this->$attr = $value;
			 }
			public function __isset($attr) {
				return isset($this->$attr ); 
			}
	
			public function __toString() {
				$s="connection avec l'utilisateur $this->login est etablie avec succés";
				return $s;
			}
			/*public static function connect($login,$password){
				if($login != "admin" || $password != "admin")
				
					return false;
				return true;
			}*/
			public function connect(){
				include("connexion.php");
				$sql = $conn->query("SELECT * FROM users WHERE login = '$this->login' 
				and password='$this->password'");
				$user=$sql->fetch(PDO::FETCH_OBJ); // Récupérer sous forme d’objet

				if ($sql->rowCount()>0)
				{ echo 'Login: '.$user->login.'<br>';}
					//header ('Location:View_article.php');
					else
					header ('Location:authentification.html');
					}
			/*public function connect(){
				include("connexion.php");

				$reglog = $conn->prepare("SELECT login,password FROM users WHERE login= :login AND password= :password ");
				$reglog->bindParam(':login',$this->login);
				$reglog->bindParam(':password',$this->password);
				$reglog->execute();
				//*****Liaison des résultats à des variables
				$reglog->bindColumn('login', $prenom);
				$reglog->bindColumn('password', $nom); 
				 //les cordonnées du user existent dans la table de la BD				
				if ($reglog->rowCount()>0) 
				{
					header ('Location:View_article.php');}
					else
					header ('Location:authentification.html');
					} */


				}
				
	?>

