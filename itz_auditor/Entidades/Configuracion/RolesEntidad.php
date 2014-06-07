<?php
namespace Entidades;
setlocale(LC_CTYPE, 'es_ES');
class RolesEntidad{
	private $codigo;
	private $nombre;
	private $estado;
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
	
	public function setEstado($_estado) {
		$this->estado[$this->idx]= $_estado;
	}
	
	public function getEstado() {
		return $this->estado;
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