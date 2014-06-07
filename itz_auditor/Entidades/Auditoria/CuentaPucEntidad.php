<?php
namespace Entidades;

class CuentaPucEntidad{
	private $cliente;
	private $codigo;
	private $nombre;
	private $ecuacionPatrimonial;
	private $nivelDetalle;
	private $naturaleza;
	private $accion;
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
	
	public function setCliente($_cliente) {
		$this->cliente[$this->idx]= $_cliente;
	}
	
	public function getCliente() {
		return $this->cliente;
	}
	
	public function setCodigo($_codigo) {
		$this->codigo[$this->idx]= $_codigo;
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setNombre($_nombre) {
		$this->nombre[$this->idx]= $_nombre;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function setEcuacionPatrimonial($_ecuacionPatrimonial) {
		$this->ecuacionPatrimonial[$this->idx]= $_ecuacionPatrimonial;
	}
	
	public function getEcuacionPatrimonial() {
		return $this->ecuacionPatrimonial;
	}
	
	public function setNivelDetalle($_nivelDetalle) {
		$this->nivelDetalle[$this->idx]= $_nivelDetalle;
	}
	
	public function getNivelDetalle() {
		return $this->nivelDetalle;
	}
	
	public function setNaturaleza($_naturaleza) {
		$this->naturaleza[$this->idx]= $_naturaleza;
	}
	
	public function getNaturaleza() {
		return $this->naturaleza;
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
	
	public function setAccion($_accion) {
		$this->accion[$this->idx]= $_accion;
	}
	
	public function getAccion() {
		return $this->accion;
	}
}

?>