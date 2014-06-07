<?php
namespace Entidades;

class MovimientoEntidad{
	private $cliente;
	private $numeroComprobante;
	private $codigoComprobante;
	private $nombreComprobante;
	private $fechaMovimiento;
	private $anioMes;
	private $consecutivo;
	private $cuentaPuc;
	private $tercero;
	private $segundoTercero;
	private $centroCosto;
	private $detalle;
	private $naturaleza;
	private $valor;
	private $estado;
	private $fechaHoraCopia;
	private $archivo;
	private $usuario;
	private $usuarioEmpresa;
	private $fechaEmpresa;
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
	
	public function setNumeroComprobante($_numeroComprobante) {
		$this->numeroComprobante[$this->idx]= $_numeroComprobante;
	}
	
	public function getNumeroComprobante() {
		return $this->numeroComprobante;
	}
	
	public function setCodigoComprobante($_codigoComprobante) {
		$this->codigoComprobante[$this->idx]= $_codigoComprobante;
	}
	
	public function getCodigoComprobante() {
		return $this->codigoComprobante;
	}
	
	public function setNombreComprobante($_nombreComprobante) {
		$this->nombreComprobante[$this->idx]= $_nombreComprobante;
	}
	
	public function getNombreComprobante() {
		return $this->nombreComprobante;
	}
	
	public function setFechaMovimiento($_fechaMovimiento) {
		$this->fechaMovimiento[$this->idx]= $_fechaMovimiento;
	}
	
	public function getFechaMovimiento() {
		return $this->fechaMovimiento;
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
	
	public function setDetalle($_detalle) {
		$this->detalle[$this->idx]= $_detalle;
	}
	
	public function getDetalle() {
		return $this->detalle;
	}
	
	public function setNaturaleza($_naturaleza) {
		$this->naturaleza[$this->idx]= $_naturaleza;
	}
	
	public function getNaturaleza() {
		return $this->naturaleza;
	}
	
	public function setValor($_valor) {
		$this->valor[$this->idx]= $_valor;
	}
	
	public function getValor() {
		return $this->valor;
	}
	
	public function setEstado($_estado) {
		$this->estado[$this->idx]= $_estado;
	}
	
	public function getEstado() {
		return $this->estado;
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
	
	public function setUsuarioEmpresa($_usuarioEmpresa) {
		$this->usuarioEmpresa[$this->idx]= $_usuarioEmpresa;
	}
	
	public function getUsuarioEmpresa() {
		return $this->usuarioEmpresa;
	}
	
	public function setFechaEmpresa($_fechaEmpresa) {
		$this->fechaEmpresa[$this->idx]= $_fechaEmpresa;
	}
	
	public function getFechaEmpresa() {
		return $this->fechaEmpresa;
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