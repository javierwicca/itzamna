<?php
namespace Entidades;

class UsuarioEntidad{
	private $identificacion;
	private $correo;
	private $estado;
	private $tipoUsuario;
	private $clave;
	private $requiereCambio;
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
	
	public function setIdentificacion($_identificacion) {
		$this->identificacion[$this->idx]= $_identificacion;
	}
	
	public function getIdentificacion() {
		return $this->identificacion[$this->idx];
	}
	
	public function setCorreo($_correo) {
		$this->correo[$this->idx]= $_correo;
	}
	
	public function getCorreo() {
		return $this->correo[$this->idx];
	}
	
	public function setEstado($_estado) {
		$this->estado[$this->idx]= $_estado;
	}
	
	public function getEstado() {
		return $this->estado[$this->idx];
	}
	
	public function setTipoUsuario($_tipoUsuario) {
		$this->tipoUsuario[$this->idx]= $_tipoUsuario;
	}
	
	public function getTipoUsuario() {
		return $this->tipoUsuario[$this->idx];
	}
	
	public function setClave($_clave) {
		$this->clave[$this->idx]= $_clave;
	}
	
	public function getClave() {
		return $this->clave[$this->idx];
	}
	
	public function setRequiereCambio($_requiereCambio) {
		$this->requiereCambio[$this->idx]= $_requiereCambio;
	}
	
	public function getRequiereCambio() {
		return $this->requiereCambio[$this->idx];
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