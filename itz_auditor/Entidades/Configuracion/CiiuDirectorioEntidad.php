<?php
namespace Entidades;

class CiiuDirectorioEntidad{
	private $identificacion;
	private $ciiu;
	private $lugar;
	private $principal;
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
		return $this->identificacion;
	}
	
	public function setCiiu($_ciiu) {
		$this->ciiu[$this->idx]= $_ciiu;
	}
	
	public function getCiiu() {
		return $this->ciiu;
	}
	
	public function setLugar($_lugar) {
		$this->lugar[$this->idx]= $_lugar;
	}
	
	public function getLugar() {
		return $this->lugar;
	}
	
	public function setPrincipal($_principal) {
		$this->principal[$this->idx]= $_principal;
	}
	
	public function getPrincipal() {
		return $this->principal;
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