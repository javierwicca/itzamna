<?php
namespace Entidades;
setlocale(LC_CTYPE, 'es_ES');
class RolesPermisosEntidad{
	private $rol;
	private $modulo;
	private $consulta;
	private $adicionar;
	private $modificar;
	private $eliminar;
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
	
	public function setModulo($_modulo) {
		$this->modulo[$this->idx]= $_modulo;
	}
	
	public function getModulo() {
		return $this->modulo;
	}
	
	public function setConsulta($_consulta) {
		$this->consulta[$this->idx]= $_consulta;
	}
	
	public function getConsulta() {
		return $this->consulta;
	}
	
	public function setAdicionar($_adicionar) {
		$this->adicionar[$this->idx]= $_adicionar;
	}
	
	public function getAdicionar() {
		return $this->adicionar;
	}
	
	public function setModificar($_modificar) {
		$this->modificar[$this->idx]= $_modificar;
	}
	
	public function getModificar() {
		return $this->modificar;
	}
	
	public function setEliminar($_eliminar) {
		$this->eliminar[$this->idx]= $_eliminar;
	}
	
	public function getEliminar() {
		return $this->eliminar;
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