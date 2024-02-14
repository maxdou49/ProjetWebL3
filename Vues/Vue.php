<?php
    require_once "Controleurs/Config.php";
    class Vue
    {
        private $base;
        private $page;
        private $title;

        public function __construct($page, $title="Site")
        {
            # On charge la configuration
            $this->base = Config::get("racine");

            $this->page = "Vues/vues/".$page.".php";
            $this->title = $title;
        }

        public function generer($donnees)
        {
            $contenu = $this->genererFichier($this->page, $donnees);
            $vue = $this->genererFichier("Vues/template.php", array(
                "contenu" => $contenu,
                "base" => $this->base,
                "title" => $this->title
            ));
            echo $vue;
        }

        public function genererFichier($fichier, $donnees)
        {
            if(file_exists($fichier))
            {
                # On récupère les données
                extract($donnees);

                # On charge la vue dans un tampon
                ob_start();
                include $fichier;
                return ob_get_clean();
            }
            else
            {
                throw new Exception("Page ".$fichier." introuvable");
            }
        }
    }
?>