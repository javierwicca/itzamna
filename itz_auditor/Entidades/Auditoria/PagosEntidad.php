<?php
namespace Entidades;

class PagosEntidad{
	private $consecutivo;
	private $cliente;
	private $proveedor;
	private $banco;
	private $ctaBancaria;
	private $tipoCuenta;
	private $fecha;
	private $noDocumento;
	private $vlPago;
	private $observaciones;
	private $lugar;
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
	
	public function setCliente($_cliente) {
		$this->cliente[$this->idx]= $_cliente;
	}
	
	public function getCliente() {
		return $this->cliente;
	}
	
	public function setProveedor($_proveedor) {
		$this->proveedor[$this->idx]= $_proveedor;
	}
	
	public function getProveedor() {
		return $this->proveedor;
	}
	
	public function setBanco($_banco) {
		$this->banco[$this->idx]= $_banco;
	}
	
	public function getBanco() {
		return $this->banco;
	}
	
	public function setCtaBancaria($_ctaBancaria) {
		$this->ctaBancaria[$this->idx]= $_ctaBancaria;
	}
	
	public function getCtaBancaria() {
		return $this->ctaBancaria;
	}
	
	public function setTipoCuenta($_tipoCuenta) {
		$this->tipoCuenta[$this->idx]= $_tipoCuenta;
	}
	
	public function getTipoCuenta() {
		return $this->tipoCuenta;
	}
	
	public function setFecha($_fecha) {
		$this->fecha[$this->idx]= $_fecha;
	}
	
	public function getFecha() {
		return $this->fecha;
	}
	
	public function setNoDocumento($_noDocumento) {
		$this->noDocumento[$this->idx]= $_noDocumento;
	}
	
	public function getNoDocumento() {
		return $this->noDocumento;
	}
	
	public function setVlPago($_vlPago) {
		$this->vlPago[$this->idx]= $_vlPago;
	}
	
	public function getVlPago() {
		return $this->vlPago;
	}
	
	public function setObservaciones($_observaciones) {
		$this->observaciones[$this->idx]= $_observaciones;
	}
	
	public function getObservaciones() {
		return $this->observaciones;
	}
	
	public function setLugar($_lugar) {
		$this->lugar[$this->idx]= $_lugar;
	}
	
	public function getLugar() {
		return $this->lugar;
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