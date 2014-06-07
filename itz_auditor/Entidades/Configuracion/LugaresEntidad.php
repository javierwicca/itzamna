<?php
namespace Entidades;

class LugaresEntidad{
	private $codigo;
	private $nombre;
	private $tipo;
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
	
	public function setNombre($_nombre) {
		$this->nombre[$this->idx]= $_nombre;
	}
	
	public function getNombre() {
		return $this->nombre;
	}
	
	public function setTipo($_tipo) {
		$this->tipo[$this->idx]= $_tipo;
	}
	
	public function getTipo() {
		return $this->tipo;
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