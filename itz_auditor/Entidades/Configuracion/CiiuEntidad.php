<?php
namespace Entidades;

class CiiuEntidad{
	private $codigo;
	private $lugar;
	private $detalle;
	private $tarifa;
	private $version;
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
	
	public function setCodigo($_codigo) {
		$this->codigo[$this->idx]= $_codigo;
	}
	
	public function getCodigo() {
		return $this->codigo;
	}
	
	public function setLugar($_lugar) {
		$this->lugar[$this->idx]= $_lugar;
	}
	
	public function getLugar() {
		return $this->lugar;
	}
	
	public function setDetalle($_detalle) {
		$this->detalle[$this->idx]= $_detalle;
	}
	
	public function getDetalle() {
		return $this->detalle;
	}
	
	public function setTarifa($_tarifa) {
		$this->tarifa[$this->idx]= $_tarifa;
	}
	
	public function getTarifa() {
		return $this->tarifa;
	}
	
	public function setVersion($_version) {
		$this->vresion[$this->idx]= $_version;
	}
	
	public function getVersion() {
		return $this->version;
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