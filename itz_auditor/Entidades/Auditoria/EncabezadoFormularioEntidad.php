<?php
namespace Entidades;

class EncabezadoFormularioEntidad{
	private $consecutivo;
	private $impuesto;
	private $entidad;
	private $periodicidad;
	private $nombre;
	private $codigo;
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
	
	public function setConsecutivo($_consecutivo) {
		$this->consecutivo[$this->idx]= $_consecutivo;
	}
	
	public function getConsecutivo() {
		return $this->consecutivo;
	}
	
	public function setImpuesto($_impuesto) {
		$this->impuesto[$this->idx]= $_impuesto;
	}
	
	public function getImpuesto() {
		return $this->impuesto;
	}
	
	public function setEntidad($_entidad) {
		$this->entidad[$this->idx]= $_entidad;
	}
	
	public function getEntidad() {
		return $this->entidad;
	}
	
	public function setPeriodicidad($_periodicidad) {
		$this->periodicidad[$this->idx]= $_periodicidad;
	}
	
	public function getPeriodicidad() {
		return $this->periodicidad;
	}
	
	public function setNombre($_nombre) {
		$this->nombre[$this->idx]= $_nombre;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function setCodigo($_codigo) {
		$this->codigo[$this->idx]= $_codigo;
	}
	
	public function getCodigo() {
		return $this->codigo;
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