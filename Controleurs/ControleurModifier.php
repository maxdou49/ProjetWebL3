<?php
    require_once "Modeles/Pokemon.php";
    require_once "Modeles/BDD.php";
    include_once "Controleurs/Parametres.php";
    class ControleurModifier
    {
        public function __construct()
        {
            
        }
        
        //Affiche modifier
        public function afficherModifier()
        {
            $vue = new Vue("modifier");
            $vue->generer(array("liste" => Pokemon::listerNom()));
        }
        
        // Récupère les paramètres et applique la modification avant de charger Modifier
        public function appliquerModification()
        {
            if(Parametres::existe("poke"))
            {
                $id = (int)Parametres::get("poke");
                $taille = (int)Parametres::getDefault("taille", "0");
                $poids = (int)Parametres::getDefault("poids", "0");
                $poke = new Pokemon($id);
                BDD::executerRequete("UPDATE pokemon SET pok_height=?, pok_weight=? WHERE pok_id=?;", array($taille, $poids, $id));
                BDD::logXML("modifier", "Le Pokémon {$poke->getNom()}(ID=$id) a été modifié. Taille: {$poke->getTaille()}>$taille, Poids {$poke->getPoids()}>$poids.");
            }
            $this->afficherModifier();
        }
    }
?>