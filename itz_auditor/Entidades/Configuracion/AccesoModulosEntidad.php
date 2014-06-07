<?php
namespace Entidades;

class AccesoModulosEntidad{
	private $modulo;
	private $usuario;
	private $fechaHora;
	private $acceso;
	private $ip;
	private $where;
	private $order;
	private $idx;
	private $resultado;
	
	public function setIdx($_idx) {
		$this->idx= $_idx;
	}
	
	public function setResultado($_resultado) {
		$this->resultado= $_resultado;
	}
	
	public function getResultado() {
		return $this->resultado;
	}
	
	public function setModulo($_modulo) {
		$this->modulo[$this->idx]= $_modulo;
	}
	
	public function getModulo() {
		return $this->modulo;
	}
	
	public function setUsuario($_usuario) {
		$this->usuario[$this->idx]= $_usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function setFechaHora($_fechaHora) {
		$this->fechaHora[$this->idx]= $_fechaHora;
	}
	
	public function getFechaHora() {
		return $this->fechaHora;
	}
	
	public function setAcceso($_acceso) {
		$this->acceso[$this->idx]= $_acceso;
	}
	
	public function getAcceso() {
		return $this->acceso;
	}
	
	public function setIp($_ip) {
		$this->ip[$this->idx]= $_ip;
	}
	
	public function getIp() {
		return $this->ip;
	}
	
	public function setWhere($_where) {
		$this->where= $_where;
	}
	
	public function getWhere() {
		return $this->where;
	}
	
	public function setOrder($_order) {
		$this->order= $_order;
	}
	
	public function getOrder() {
		return $this->order;
	}
}

?>