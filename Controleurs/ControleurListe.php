<?php
    require_once "Modeles/Pokemon.php";
    require_once "Modeles/Type.php";
    class ControleurListe
    {
        public function __construct()
        {

        }

        //Affiche la liste brute
        public function afficherListeTest()
        {
            
            $vue = new Vue("testListe");
            $vue->generer(array("liste" => Pokemon::listerPokemon()));
        }

        //Affiche la liste formatée
        public function afficherListe()
        {
            $vue = new Vue("liste");
            $vue->generer(array("liste" => Pokemon::listerPokemon()));
        }

        //Affiche les détail d'un seul Pokémon
        public function afficherDetail($id)
        {
            $vue = new Vue("detail");
            $vue->generer(array("poke" => new Pokemon($id)));
        }

        //Affiche la liste par type
        public function afficherListeParType()
        {
            $vue = new Vue("type");
            $vue->generer(array("liste" => Type::listerTypes()));
        }
    }
?>