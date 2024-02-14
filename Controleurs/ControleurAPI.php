<?php
    require_once "Modeles/Pokemon.php";

    class ControleurAPI
    {
        public function __construct()
        {

        }

        public function obtenirPokemonParType($type)
        {
            $liste = Pokemon::listerPokemonType($type);
            $json = array();
            foreach($liste as $p)
            {
                $json[] = $p->toArray();
            }
            echo json_encode($json);
        }
    }
?>