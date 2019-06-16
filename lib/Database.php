<?php
    class database{
        public static $db_host="localhost";
        public static $db_user="root";
        public static $db_pass="";
        public static $db_name="project_ecom";



        public static function connect(){
            $db= new mysqli(self::$db_host,self::$db_user,self::$db_pass,self::$db_name);
            if(!$db){
                return "Connection fail";
            }else{
                return $db;
            }
        }
    }
?>