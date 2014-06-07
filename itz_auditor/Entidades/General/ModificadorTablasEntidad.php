<?php
namespace Entidades;

class ModificadorTablasEntidad{
	private $tabla;
	private $llave;
	private $consecutivo;
	private $usuario;
	private $fechaHora;
	private $datosAnterior;
	private $datosDespues;
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
	
	public function setTabla($_tabla) {
		$this->tabla[$this->idx]= $_tabla;
	}
	
	public function getTabla() {
		return $this->tabla;
	}
	
	public function setLlave($_llave) {
		$this->llave[$this->idx]= $_llave;
	}
	
	public function getLlave() {
		return $this->llave;
	}
	
	public function setConsecutivo($_consecutivo) {
		$this->consecutivo[$this->idx]= $_consecutivo;
	}
	
	public function getConsecutivo() {
		return $this->consecutivo;
	}
	
	public function setUsuario($_usuario) {
		$this->usuario[$this->idx]= $_usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
	}
	
	public function setFechaHora($_fechaHora) {
		$this->fechaHora[$this->idx]= $_fechaHora;
	}
	
	public function getFechaHora() {
		return $this->fechaHora;
	}
	
	public function setDatosAnterior($_datosAnterior) {
		$this->datosAnterior[$this->idx]= $_datosAnterior;
	}
	
	public function getDatosAnterior() {
		return $this->datosAnterior;
	}
	
	public function setDatosDespues($_datosDespues) {
		$this->datosDespues[$this->idx]= $_datosDespues;
	}
	
	public function getDatosDespues() {
		return $this->datosDespues;
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