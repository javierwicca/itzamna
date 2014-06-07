<?php
namespace Entidades;

class ModulosEntidad{
	private $codigo;
	private $nombre;
	private $nombreMostrar;
	private $modulo;
	private $pagina;
	private $imagen;
	private $menuSup;
	private $orden;
	private $where;
	private $order;
	private $idx;
	
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
	
	public function setNombreMostrar($_nombreMostrar) {
		$this->nombreMostrar[$this->idx]= $_nombreMostrar;
	}
	
	public function getNombreMostrar() {
		return $this->nombreMostrar;
	}
	
	public function setModulo($_modulo) {
		$this->modulo[$this->idx]= $_modulo;
	}
	
	public function getModulo() {
		return $this->modulo;
	}
	
	public function setPagina($_pagina) {
		$this->pagina[$this->idx]= $_pagina;
	}
	
	public function getPagina() {
		return $this->pagina;
	}
	
	public function setImagen($_imagen) {
		$this->imagen[$this->idx]= $_imagen;
	}
	
	public function getImagen() {
		return $this->imagen;
	}
	
	public function setMenuSup($_menuSup) {
		$this->menuSup[$this->idx]= $_menuSup;
	}
	
	public function getMenuSup() {
		return $this->menuSup;
	}
	
	public function setOrden($_orden) {
		$this->orden[$this->idx]= $_orden;
	}
	
	public function getOrden() {
		return $this->orden;
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