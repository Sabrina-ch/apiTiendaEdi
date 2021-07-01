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
         $link='mysql:host=localhost;dbname=editienda';//conecta la base de datos con el php
         $usuario='root';
         $pass='';

        try {

        $this->objetoPDO = new PDO($link,$usuario,$pass);
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage();
            die();
        }
    }

    public function prepararConsulta($consulta){

        return  $this->objetoPDO->prepare($consulta);
    }
}