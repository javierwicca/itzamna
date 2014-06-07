<?php
namespace Entidades;

class SaldosEntidad{
	private $cliente;
	private $anioMes;
	private $consecutivo;
	private $cuentaPuc;
	private $tercero;
	private $segundoTercero;
	private $centroCosto;
	private $saldoInicial;
	private $valorDebito;
	private $valorCredito;
	private $fechaHoraCopia;
	private $archivo;
	private $usuario;
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
	
	public function setCliente($_cliente) {
		$this->cliente[$this->idx]= $_cliente;
	}
	
	public function getCliente() {
		return $this->cliente;
	}
	
	public function setAnioMes($_anioMes) {
		$this->anioMes[$this->idx]= $_anioMes;
	}
	
	public function getAnioMes() {
		return $this->anioMes;
	}
	
	public function setConsecutivo($_consecutivo) {
		$this->consecutivo[$this->idx]= $_consecutivo;
	}
	
	public function getConsecutivo() {
		return $this->consecutivo;
	}
	
	public function setCuentaPuc($_cuentaPuc) {
		$this->cuentaPuc[$this->idx]= $_cuentaPuc;
	}
	
	public function getCuentaPuc() {
		return $this->cuentaPuc;
	}
	
	public function setTercero($_tercero) {
		$this->tercero[$this->idx]= $_tercero;
	}
	
	public function getTercero() {
		return $this->tercero;
	}
	
	public function setSegundoTercero($_segundoTercero) {
		$this->segundoTercero[$this->idx]= $_segundoTercero;
	}
	
	public function getSegundoTercero() {
		return $this->segundoTercero;
	}
	
	public function setCentroCosto($_centroCosto) {
		$this->centroCosto[$this->idx]= $_centroCosto;
	}
	
	public function getCentroCosto() {
		return $this->centroCosto;
	}
	
	public function setSaldoInicial($_saldoInicial) {
		$this->saldoInicial[$this->idx]= $_saldoInicial;
	}
	
	public function getSaldoInicia() {
		return $this->saldoInicial;
	}
	
	public function setValorDebito($_valorDebito) {
		$this->valorDebito[$this->idx]= $_valorDebito;
	}
	
	public function getValorDebito() {
		return $this->valorDebito;
	}
	
	public function setValorCredito($_valorCredito) {
		$this->valorCredito[$this->idx]= $_valorCredito;
	}
	
	public function getValorCredito() {
		return $this->valorCredito;
	}
	
	public function setFechaHoraCopia($_fechaHoraCopia) {
		$this->fechaHoraCopia[$this->idx]= $_fechaHoraCopia;
	}
	
	public function getFechaHoraCopia() {
		return $this->fechaHoraCopia;
	}
	
	public function setArchivo($_archivo) {
		$this->archivo[$this->idx]= $_archivo;
	}
	
	public function getArchivo() {
		return $this->archivo;
	}
	
	public function setUsuario($_usuario) {
		$this->usuario[$this->idx]= $_usuario;
	}
	
	public function getUsuario() {
		return $this->usuario;
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
	
	public function setAccion($_accion) {
		$this->accion[$this->idx]= $_accion;
	}
	
	public function getAccion() {
		return $this->accion;
	}
}

?>