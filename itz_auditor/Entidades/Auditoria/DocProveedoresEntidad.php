<?php
namespace Entidades;

class DocProveedoresEntidad{
	private $identificacion;
	private $tipoDocumento;
	private $fechaDoc;
	private $numDocumento;
	private $detalle;
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
	
	public function setIdentificacion($_identificacion) {
		$this->identificacion[$this->idx]= $_identificacion;
	}
	
	public function getIdentificacion() {
		return $this->identificacion;
	}
	
	public function setTipoDocumento($_tipoDocumento) {
		$this->tipoDocumento[$this->idx]= $_tipoDocumento;
	}
	
	public function getTipoDocumento() {
		return $this->tipoDocumento;
	}
	
	public function setFechaDoc($_fechaDoc) {
		$this->fechaDoc[$this->idx]= $_fechaDoc;
	}
	
	public function getFechaDoc() {
		return $this->fechaDoc;
	}
	
	public function setNumDocumento($_numDocumento) {
		$this->numDocumento[$this->idx]= $_numDocumento;
	}
	
	public function getNumDocumento() {
		return $this->numDocumento;
	}
	
	public function setDetalle($_detalle) {
		$this->detalle[$this->idx]= $_detalle;
	}
	
	public function getDetalle() {
		return $this->detalle;
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