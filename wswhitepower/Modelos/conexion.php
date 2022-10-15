<?php

class Conexion{
	private static $instancia = null;

	public function __construct(){
	   $dsn = 'mysql:host=www.futprojs.com;dbname=u354826722_FUTPROJS'; 
	   $user = 'u354826722_FutProJS'; 
	   $password = 'FutproJS2022'; 
		try {       
			self::$instancia = new PDO($dsn, $user, $password);   
			self::$instancia->exec("SET CHARACTER SET utf8");
		} catch (PDOException $e) {
			echo "Error!: " . $e->getMessage();
			die();
		}           
	}
	
	public static function Singleton(){
		return self::$instancia;
	}
}