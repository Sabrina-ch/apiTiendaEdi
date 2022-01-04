<?php
class AccesoDatos{
    private static $objAccesoDatos;
    private $objetoPDO;



    public static function obtenerInstancia(){
        //si no está seteado lo construyo
        if(!isset(self::$objAccesoDatos)){
            self::$objAccesoDatos = new AccesoDatos();

        }
        //si está seteado lo retorno
        return self::$objAccesoDatos;
    }


    private function __construct() {
       
       /*$link='mysql:host=localhost;dbname=editienda';
         $usuario='root';
         $pass='';*/
        
         //base Clever
        $link='mysql.services.clever-cloud.com:3306/dbname=btwjmvayjds0wjxeootr';
         $usuario='u96m3qvxa99rezo1';
         $pass='';



         //conexion remotemysql
         /*$link='mysql:host=remotemysql.com:3306;dbname=AkM8zIqj97';
         $usuario='AkM8zIqj97';
         $pass='nCoJlsR3pi';*/

        try {

        $this->objetoPDO = new PDO($link,$usuario,$pass);
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }

    public function consultaRealizar($consulta){

        return  $this->objetoPDO->prepare($consulta);
    }
}