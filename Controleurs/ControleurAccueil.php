<?php
    include "Vues/Vue.php";
    require_once "Modeles/BDD.php";

    class ControleurAccueil
    {
        public function __construct()
        {

        }
        
        //Affiche la page d'accueil
        public function afficherAccueil()
        {
            $vue = new Vue("accueil");
            $vue->generer(array());
        }

        //Affiche les mentions légales
        public function afficherLegal()
        {
            $vue = new Vue("legal");
            $vue->generer(array());
        }

        //Affiche l'historique
        public function afficherHistorique()
        {
            $vue = new Vue("historique");
            $vue->generer(array("xml" => BDD::obtenirXML()));
        }
    }
?>