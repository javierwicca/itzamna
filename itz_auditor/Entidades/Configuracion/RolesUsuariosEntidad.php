<?php
namespace Entidades;
setlocale(LC_CTYPE, 'es_ES');
class RolesUsuariosEntidad{
	private $rol;
	private $usuario;
	private $empresa;
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
	
	public function setRol($_rol) {
		$this->rol[$this->idx]= $_rol;
	}
	
	public function getRol() {
		return $this->rol;
	}
	
	public function setUsuario($_usuario) {
		$this->usuario[$this->idx]= $_usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function setEmpresa($_empresa) {
		$this->empresa[$this->idx]= $_empresa;
	}
	
	public function getEmpresa() {
		return $this->empresa;
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