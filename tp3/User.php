<?php
class User 
{
    private $login;
    private $mdp;
    function __construct($login, $mdp) {
        $this->login=$login;
        $this->mdp = $mdp;
            }
        public function __get($attr) {
        if (!isset($this->$attr)) 
        return "erreur";
            else return ($this->$attr);}
        public function __set($attr,$value) {
            $this->$attr = $value; }
        public function __isset($attr) {
        return isset($this->$attr ); }
        public function __toString() {
        $s="Vous êtes connectés avec l'utilisateur' $this->login";
        return $s;}
        public static function connect($login,$mdp){
            if($login != "admin" || $mdp != "admin")
            
                return false;
            return true;


        }
    }

?>