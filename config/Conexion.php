<?php

class Conexion{

 	private $user 	= "root";
 	private $passw	= "pldb800";
 	private $host 	= "localhost";
	private $db   	= "dxlatam_pt";
	private $conexion;

	public function connect(){
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND 	=> 'SET NAMES utf8',
			PDO::ATTR_ERRMODE 				=> PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_FOUND_ROWS 		=> true,
			PDO::ATTR_PERSISTENT 			=> true
		);
		
		try {
			$this->conexion = new PDO(
				'mysql:host='.$this->host.';dbname='.$this->db,$this->user, $this->passw, $options
			);

		} catch (PDOException $e) {
			print 'Error: '. $e->getMessage();
			die();
		}
		return $this->conexion;		
	}

	public function close(){
		$this->conexion = null;
	}

}
