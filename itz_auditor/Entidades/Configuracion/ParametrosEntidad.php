<?php
namespace Entidades;

class ParametrosEntidad{
	private $parametro;
	private $elemento;
	private $detalle;
	private $caracter;
	private $entero;
	private $decimal;
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
	
	public function setParametro($_parametro) {
		$this->parametro[$this->idx]= $_parametro;
	}
	
	public function getParametro() {
		return $this->parametro;
		
	}
	
	public function setElemento($_elemento) {
		$this->elemento[$this->idx]= $_elemento;
	}
	
	public function getElemento() {
		return $this->elemento;
	}
	
	public function setDetalle($_detalle) {
		$this->detalle[$this->idx]= $_detalle;
	}
	
	public function getDetalle() {
		return $this->detalle;
	}
	
	public function setCaracter($_caracter) {
		$this->caracter[$this->idx]= $_caracter;
	}
	
	public function getCaracter() {
		return $this->caracter;
	}
	
	public function setEntero($_entero) {
		$this->entero[$this->idx]= $_entero;
	}
	
	public function getEntero() {
		return $this->caracter;
	}
	
	public function setDecimal($_decimal) {
		$this->decimal[$this->idx]= $_decimal;
	}
	
	public function getDecimal() {
		return $this->decimal;
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