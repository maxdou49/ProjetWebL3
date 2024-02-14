<?php
    class Config
    {
        private static $conf;

        static public function get($nom)
        {
            if(empty(self::$conf))
            {
                $conf = parse_ini_file(__DIR__."/../Config/config.ini");
            }
            return $conf[$nom];
        }
    }
?>