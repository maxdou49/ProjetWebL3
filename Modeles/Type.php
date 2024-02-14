<?php
    require_once "Modeles/BDD.php";
    class Type
    {
        private string $nom;
        private int $id;
        private $img;
        private $chart;

        static private $listeTypes = array();

        private function __construct($id = 0)
        {
            $this->id = $id;
            $req = BDD::executerRequete("SELECT type_name FROM types WHERE type_id=?;", array($id));
            if($line = $req->fetch())
            {
                $this->nom = $line["type_name"];
            }
            else
            {
                $this->nom = "???";
            }
            $imgpath = "public/img/types/".$this->nom.".png";
            if(file_exists($imgpath))
            {
                $this->img = $imgpath;
            }
            else
            {
                $this->img = "";
            }

            $this->chart = null;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getImage()
        {
            return $this->img;
        }

        public function toArray()
        {
            return array(
                "id" => $this->id,
                "nom" => $this->nom
            );
        }

        public function getAffinites()
        {
            if($this->chart == null)
            {
                $req = BDD::executerRequete("SELECT atk, mult FROM typechart WHERE def=?;", array($this->id));
                $this->chart = array();
                while($t = $req->fetch())
                {
                    $this->chart[$t["atk"]] = $t["mult"];
                }
            }
            return $this->chart;
        }

        public function getAffiniteType($type)
        {
            $aff = $this->getAffinites();
            if(isset($aff[$type]))
            {
                return $aff[$type];
            }
            return 10;
        }

        //Récupérer un type mis en cache
        static public function obtenirType($id)
        {
            if(!isset(self::$listeTypes[$id]))
            {
                self::$listeTypes[$id] = new Type($id);
            }
            return self::$listeTypes[$id];
        }

        //Cherche le type pour avoir son nom. Les données sont mis en cache
        static public function nomType($id)
        {
            return self::obtenirType($id)->getNom();
        }
        
        //Liste le nom des types
        static public function listerTypes()
        {
            $ret = array();
            $req = BDD::executerRequete("SELECT type_id, type_name FROM types;");
            while($line = $req->fetch())
            {
                array_push($ret, array("id" => $line["type_id"], "nom" => $line["type_name"]));
            }
            return $ret;
        }
    }
?>