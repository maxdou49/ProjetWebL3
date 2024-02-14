<?php
    require_once "Controleurs/Config.php";
    class BDD
    {
        static public $bdd = null;

        static private function getBDD()
        {
            if(self::$bdd == null)
            {
                $dsn = Config::get("dsn");
                $login = Config::get("login");
                $mdp = Config::get("mdp");
                self::$bdd = new PDO($dsn, $login, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            return self::$bdd;
        }

        static public function executerRequete($sql, $params=null)
        {
            if($params)
            {
                $res = self::getBDD()->prepare($sql);
                $res->execute($params);
            }
            else
            {
                $res = self::getBDD()->query($sql);
            }
            return $res;
        }

        static public function logXML($type, $desc)
        {
            $xml = new DOMDocument();
            if($xml->load("data/histo.xml"))
            {
                $root = $xml->documentElement;
                $operation = $xml->createElement("operation");

                $typeNode = $xml->createElement("type");
                $typeNode->appendChild($xml->createTextNode($type));
                
                $date = $xml->createElement("horodate");
                $date->appendChild($xml->createTextNode(date("Y-m-d H:i:s")));

                $descNode = $xml->createElement("desc");
                $descNode->appendChild($xml->createTextNode($desc));

                $operation->appendChild($typeNode);
                $operation->appendChild($date);
                $operation->appendChild($descNode);
                $root->appendChild($operation);
                $xml->save("data/histo.xml");
            }
        }

        static public function obtenirXML()
        {
            $xml = simplexml_load_file("data/histo.xml");
            return $xml;
        }
    }
?>