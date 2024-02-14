<?php
    require_once "Modeles/BDD.php";
    require_once "Modeles/Type.php";
    class Pokemon
    {
        private string $nom;
        private int $dex;
        private int $taille;
        private int $poids;
        private array $type;

        public function __construct($dex = 0)
        {
            $this->dex = $dex;
            //On cherche dans la BDD
            $req = BDD::executerRequete("SELECT * FROM pokemon WHERE pok_id=?;", array($dex));
            if($line = $req->fetch())
            {
                $this->nom = $line["pok_name"];
                $this->taille = $line["pok_height"];
                $this->poids = $line["pok_weight"];
            }
            else
            {
                $this->nom = "??????????"; //Non ce n'est pas une référence obscure cachée
                $this->taille = 0;
                $this->poids = 0;
            }
            $this->type = array(null,null);
            $req = BDD::executerRequete("SELECT type_id, slot FROM pokemon_types WHERE pok_id=?;", array($dex));
            while($line = $req->fetch())
            {
                $this->type[$line["slot"]-1] = Type::obtenirType($line["type_id"]);
            }
            if(!$this->type[0])
            {
                $this->type[0] = Type::obtenirType(0);
            }
        }
        
        public function getID()
        {
            return $this->dex;
        }
        public function getNom()
        {
            return $this->nom;
        }
        public function getType1()
        {
            return $this->type[0];
        }
        public function getType2()
        {
            return $this->type[1];
        }

        public function getTaille()
        {
            return ($this->taille);
        }
        public function getPoids()
        {
            return ($this->poids);
        }

        public function toArray()
        {
            $ret = array(
                "id" => $this->dex,
                "nom" => $this->nom,
                "taille" => $this->taille,
                "poids" => $this->poids,
                "type1" => $this->type[0]->toArray()
            );
            if($this->type[1])
            {
                $ret["type2"] = $this->type[1]->toArray();
            }
            return $ret;
        }

        public function getAffinites()
        {
            $ret = array();
            $affType = $this->type[0]->getAffinites();
            foreach($affType as $k => $v)
            {
                $ret[$k] = $v/10.0;
            }
            if($this->type[1])
            {
                $affType = $this->type[1]->getAffinites();
                foreach($affType as $k => $v)
                {
                    $ret[$k] = $ret[$k] * ($v/10.0);
                }
            }
            return $ret;
        }

        static public function listerPokemon()
        {
            $ret = array();
            BDD::logXML("voir", "Récupération de la liste des Pokémon.");
            $req = BDD::executerRequete("SELECT pok_id FROM pokemon;");
            while($line = $req->fetch())
            {
                array_push($ret, new Pokemon($line["pok_id"]));
            }
            return $ret;
        }

        static public function listerNom()
        {
            $ret = array();
            $req = BDD::executerRequete("SELECT pok_id, pok_name FROM pokemon;");
            while($line = $req->fetch())
            {
                array_push($ret, array("id" => $line["pok_id"], "nom" => $line["pok_name"]));
            }
            return $ret;
        }

        static public function listerPokemonType($type)
        {
            $ret = array();
            BDD::logXML("voir", "Récupération des Pokémon avec le type ".$type);
            $req = BDD::executerRequete("SELECT DISTINCT pok_id FROM pokemon_types WHERE type_id=?;", array($type));
            while($line = $req->fetch())
            {
                array_push($ret, new Pokemon($line["pok_id"]));
            }
            return $ret;
        } 
    }
?>