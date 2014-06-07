<?php
namespace Entidades;

class DetallePagosEntidad{
	private $pago;
	private $consecutivo;
	private $bienServicio;
	private $valor;
	private $prConsumo;
	private $info;
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
	
	public function setPago($_pago) {
		$this->pago[$this->idx]= $_pago;
	}
	
	public function getPago() {
		return $this->pago;
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
	
	public function setValor($_valor) {
		$this->valor[$this->idx]= $_valor;
	}
	
	public function getValor() {
		return $this->valor;
	}
	
	public function setInfo($_info) {
		$this->info[$this->idx]= $_info;
	}
	
	public function getInfo() {
		return $this->info;
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