<?php
//---------------- CONEXION ----------------//
class Conexion {
	private $config;
	private $host;
	private $user;
	private $pass;
	private $bd;
	private $mysqli;

	public function __construct() {
		$this->config = parse_ini_file("config.ini",true);
		$this->host = $this->config["database"]["host"];
		$this->user = $this->config["database"]["username"];
		$this->pass = $this->config["database"]["password"];
		$this->bd = $this->config["database"]["dbname"];
		/*$this->host = "localhost";
		$this->user = "danieladvm";
		$this->pass = "dani123";
		$this->bd = "scores";*/
		$this->mysqli = new mysqli($this->host,$this->user,$this->pass,$this->bd);
	}

	public function desconectar() {
		$this->mysqli->close();
	}
	
	public function ejecutarQuery($query) {
		return $this->mysqli->query($query);
	}
	
	public function ejecutarMultiQuery($query) {
		$this->mysqli->multi_query($query);
		return $this->mysqli->store_result();
	}

	function __destruct() {}
}

?>