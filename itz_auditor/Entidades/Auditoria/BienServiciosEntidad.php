<?php
namespace Entidades;

class BienServiciosEntidad{
	private $consecutivo;
	private $bienServicio;
	private $prRetefuentej;
	private $prRetefuenten;
	private $vlUvt;
	private $prIva;
	private $prConsumo;
	private $detallado;
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
	
	public function setConsecutivo($_consecutivo) {
		$this->consecutivo[$this->idx]= $_consecutivo;
	}
	
	public function getConsecutivo() {
		return $this->consecutivo;
	}
	
	public function setBienServicio($_bienServicio) {
		$this->bienServicio[$this->idx]= $_bienServicio;
	}
	
	public function getBienServicio() {
		return $this->bienServicio;
	}
	
	public function setPrRetefuentej($_prRetefuentej) {
		$this->prRetefuentej[$this->idx]= $_prRetefuentej;
	}
	
	public function getPrRetefuentej() {
		return $this->prRetefuentej;
	}
	
	public function setPrRetefuenten($_prRetefuenten) {
		$this->prRetefuenten[$this->idx]= $_prRetefuenten;
	}
	
	public function getPrRetefuenten() {
		return $this->prRetefuenten;
	}
	
	public function setVlUvt($_prVlUvt) {
		$this->vlUvt[$this->idx]= $_prVlUvt;
	}
	
	public function getVlUvt() {
		return $this->vlUvt;
	}
	
	public function setPrIva($_prIva) {
		$this->prIva[$this->idx]= $_prIva;
	}
	
	public function getPrIva() {
		return $this->prIva;
	}
	
	public function setPrConsumo($_prConsumo) {
		$this->prConsumo[$this->idx]= $_prConsumo;
	}
	
	public function getPrConsumo() {
		return $this->prConsumo;
	}
	
	public function setDetallado($_detallado) {
		$this->detallado[$this->idx]= $_detallado;
	}
	
	public function getDetallado() {
		return $this->detallado;
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