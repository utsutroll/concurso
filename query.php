<?php 
$DB_HOST=$_ENV['DB_HOST'];
$DB_USER=$_ENV['DB_USER'];
$DB_PASS=$_ENV['DB_PASS'];
$DB_NAME=$_ENV['DB_NAME'];

class Conexion{

	public static function Conectar(){

		define('db_host', '.$DB_HOST.');//Nombre del host
		define('db_user','.$DB_USER.');//Usuario de la base de datos
		define('db_pass','.$DB_PASS.');//Contraseña de usuario de base de datos
		define('db_name','.$DB_NAME.');//Nombre de la base de datos */

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
