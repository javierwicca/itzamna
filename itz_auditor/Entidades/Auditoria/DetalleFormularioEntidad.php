<?php
namespace Entidades;

class DetalleFormularioEntidad{
	private $formulario;
	private $consecutivo;
	private $detalle;
	private $tipo;
	private $noRenglon;
	private $renglonRelacion;
	private $simbolo;
	private $renglonInicial;
	private $renglonFinal;
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
	
	public function setFormulario($_formulario) {
		$this->formulario[$this->idx]= $_formulario;
	}
	
	public function getFormulario() {
		return $this->formulario;
	}
	
	public function setConsecutivo($_consecutivo) {
		$this->consecutivo[$this->idx]= $_consecutivo;
	}
	
	public function getConsecutivo() {
		return $this->consecutivo;
	}
	
	public function setDetalle($_detalle) {
		$this->detalle[$this->idx]= $_detalle;
	}
	
	public function getDetalle() {
		return $this->detalle;
	}
	
	public function setTipo($_tipo) {
		$this->tipo[$this->idx]= $_tipo;
	}
	
	public function getTipo() {
		return $this->tipo;
	}
	
	public function setNoRenglon($_noRenglon) {
		$this->noRenglon[$this->idx]= $_noRenglon;
	}
	
	public function getNoRenglon() {
		return $this->noRenglon;
	}
	
	public function setRenglonRelacion($_renglonRelacion) {
		$this->renglonRelacion[$this->idx]= $_renglonRelacion;
	}
	
	public function getRenglonRelacion() {
		return $this->renglonRelacion;
	}
	
	public function setSimbolo($_simbolo) {
		$this->simbolo[$this->idx]= $_simbolo;
	}
	
	public function getSimbolo() {
		return $this->simbolo;
	}
	
	public function setRenglonInicial($_renglonInicial) {
		$this->renglonInicial[$this->idx]= $_renglonInicial;
	}
	
	public function getRenglonInicial() {
		return $this->renglonInicial;
	}
	
	public function setRenglonFinal($_renglonFinal) {
		$this->renglonFinal[$this->idx]= $_renglonFinal;
	}
	
	public function getRenglonFinal() {
		return $this->renglonFinal;
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