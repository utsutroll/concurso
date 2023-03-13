<?php 
class Conexion{

	public static function Conectar(){

		define('db_host','localhost');//Nombre del host
		define('db_user','root');//Usuario de la base de datos
		define('db_pass','root');//Contraseña de usuario de base de datos
		define('db_name','concurso');//Nombre de la base de datos

		//$opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf-8");

		try{
			$conexion = new PDO("mysql:host=".db_host."; dbname=".db_name,db_user,db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			return $conexion; //Conexion al Servidor y a la Base de Datos
		}catch(Exception $e){
			die("El error de Conexion es: ". $e->getMessage()); //Muestra un Mensaje se hay un error al Conectar a la Base de Datos

		}
	}
}
    date_default_timezone_set('America/Caracas');

$objeto = new Conexion();
$conexion = $objeto->Conectar();

$sql= "SELECT * FROM data ORDER BY RAND() LIMIT 1";
$res=$conexion->prepare($sql);
$res->execute();

$data=$res->fetchAll(PDO::FETCH_ASSOC);

print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviar el el array final en formato jason a JS

$conexion=NULL;
