<?php
    include_once "Controleurs/ControleurAccueil.php";
    include_once "Controleurs/ControleurListe.php";
    include_once "Controleurs/Parametres.php";
    include_once "Controleurs/ControleurModifier.php";
    include_once "Controleurs/ControleurAPI.php";
    class Routeur
    {   
        # Créer le routeur tout en récupérant les paramètres HTTP
        function __construct()
        {
            
        }
        public function methode()
        {
            return Parametres::methode();
        }
        public function getArgument($name)
        {
            return Parametres::get($name);
        }

        # Traiter la requête
        public function routerRequete()
        {
            try{
                if($this->methode() == "GET")
                {
                    $action = $this->getArgument("action");
                    if($action == "liste")
                    {
                        $liste = new ControleurListe();
                        $liste->afficherListe();
                    }
                    else if($action == "test")
                    {
                        $liste = new ControleurListe();
                        $liste->afficherListeTest();
                    }
                    else if($action == "") # On a qu'à afficher l'accueil si on a un GET menant a rien
                    {
                        $acc = new ControleurAccueil();
                        $acc->afficherAccueil();
                    }
                    else if($action == "detail")
                    {
                        $liste = new ControleurListe();
                        $liste->afficherDetail(Parametres::get("id"));
                    }
                    else if($action == "legal")
                    {
                        $acc = new ControleurAccueil();
                        $acc->afficherLegal();
                    }
                    else if($action == "modifier")
                    {
                        $mod = new ControleurModifier();
                        $mod->afficherModifier();
                    }
                    else if($action == "historique")
                    {
                        $acc = new ControleurAccueil();
                        $acc->afficherHistorique();
                    }
                    else if($action == "api_type")
                    {
                        $api = new ControleurAPI();
                        $api->obtenirPokemonParType(Parametres::get("id"));
                    }
                    else if($action == "type")
                    {
                        $liste = new ControleurListe();
                        $liste->afficherListeParType();
                    }
                    else
                    {
                        throw new Exception("Page non trouvée : ".$action);
                    }
                }
                else if($this->methode() == "POST")
                {
                    $action = $this->getArgument("action");
                    if($action == "modifier")
                    {
                        $mod = new ControleurModifier();
                        $mod->appliquerModification();
                    }
                }
                else
                {
                    $acc = new ControleurAccueil();
                    $acc->afficherAccueil();
                }
            } catch(Exception $e)
            {
                $err = new Vue("erreur", "Site - Erreur");
                $err->generer(array("erreur" => $e->getMessage()));
            }
        }
    }
?>