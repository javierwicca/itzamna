<?php
namespace Entidades;

class ImpuestoPagosEntidad{
	private $pago;
	private $impuesto;
	private $vlImpuesto;
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
	
	public function setImpuesto($_impuesto) {
		$this->impuesto[$this->idx]= $_impuesto;
	}
	
	public function getImpuesto() {
		return $this->impuesto;
	}
	
	public function setVlImpuesto($_vlImpuesto) {
		$this->vlImpuesto[$this->idx]= $_vlImpuesto;
	}
	
	public function getVlImpuesto() {
		return $this->vlImpuesto;
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