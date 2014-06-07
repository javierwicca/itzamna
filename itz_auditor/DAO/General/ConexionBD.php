<?php

namespace DAO;
class ConexionBD{
	private $conexion;
	private $puerto;
	private $servidor;
	private $usuario;
	private $contraseña;
	private $baseDatos;
	
	function __construct() {
		$datos=parse_ini_file('../Config/itz_auditor.ini',true);
		
		$this->servidor=$datos['bd']['servidor'];
		$this->usuario=$datos['bd']['usuario'];
		$this->contraseña=$datos['bd']['contraseña'];
		$this->baseDatos=$datos['bd']['baseDatos'];
		$this->puerto=$datos['bd']['puerto'];
	}
	
	public function abrirConexion(){
		if (!isset($this->conexion)) {
			
			$this->conexion=(pg_connect("dbname=".$this->baseDatos." host=".$this->servidor." user=".$this->usuario." password=".$this->contraseña." port=".$this->puerto))
				or die(pg_errormessage());
		}
	}
	
	public function consulta($consulta){
		
		$resultado = pg_query($this->conexion,$consulta);
		
		if (!$resultado) {
			$resultado = 'Error Ejecutando Consulta '.pg_errormessage($this->conexion);
		}
		return $resultado;
	}
	
	public function resultados($consulta){
		return pg_fetch_all($consulta);
	}
	
	public function totalResultados($consulta){
		return pg_num_rows($consulta);
	}
	
	public function totalRegistrosAfectados($consulta) {
		return pg_affected_rows($consulta);
	}
}
?>