<?php
    class Parametres
    {
        private static $param;
        private static $post;
        private static $method;

        static private function fetch()
        {
            self::$param = array();
            self::$method = "";
            if(!empty($_GET))
            {
                self::$method = "GET";
                self::$param = array_merge(self::$param, $_GET);
            }
            if(!empty($_POST))
            {
                self::$method = "POST";
                self::$param = array_merge(self::$param, $_POST);
            }
        }

        static public function get($nom)
        {
            if(empty(self::$param))
            {
                self::fetch();
            }
            if(isset(self::$param[$nom]))
            {
                return self::$param[$nom];
            }
            else
            {
                throw new Exception("Paramètre ".$nom." non défini.");
            }
        }

        static public function getDefault($nom, $defaut)
        {
            if(empty(self::$param))
            {
                self::fetch();
            }
            if(isset(self::$param[$nom]))
            {
                return self::$param[$nom];
            }
            else
            {
                return $defaut;
            }
        }

        static public function methode()
        {
            if(!isset(self::$method))
            {
                self::fetch();
            }
            return self::$method;
        }

        static public function existe($nom)
        {
            if(empty(self::$param))
            {
                self::fetch();
            }
            return isset(self::$param[$nom]);
        }
    }
?>