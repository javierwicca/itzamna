<?php
namespace Entidades;

class ProveedoresEntidad{
	private $identificacion;
	private $tipoSociedad;
	private $autorretenedor;
	private $gc;
	private $sucursal;
	private $dirSucursal;
	private $representante;
	private $tipoRegimen;
	private $retenedorIva;
	private $profesionLiberal;
	private $ley1429;
	private $estado;
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
	
	public function setTipoSociedad($_tipoSociedad) {
		$this->tipoSociedad[$this->idx]= $_tipoSociedad;
	}
	
	public function getTipoSociedad() {
		return $this->tipoSociedad;
	}
	
	public function setAutorretenedor($_autorretenedor) {
		$this->autorretenedor[$this->idx]= $_autorretenedor;
	}
	
	public function getAutorretenedor() {
		return $this->autorretenedor;
	}
	
	public function setGc($_gc) {
		$this->gc[$this->idx]= $_gc;
	}
	
	public function getGc() {
		return $this->gc;
	}
	
	public function setSucursal($_sucursal) {
		$this->sucursal[$this->idx]= $_sucursal;
	}
	
	public function getSucursal() {
		return $this->sucursal;
	}
	
	public function setDirSucursal($_dirSucursal) {
		$this->dirSucursal[$this->idx]= $_dirSucursal;
	}
	
	public function getDirSucursal() {
		return $this->dirSucursal;
	}
	
	public function setRepresentante($_representante) {
		$this->representante[$this->idx]= $_representante;
	}
	
	public function getRepresentante() {
		return $this->representante;
	}
	
	public function setTipoRegimen($_tipoRegimen) {
		$this->tipoRegimen[$this->idx]= $_tipoRegimen;
	}
	
	public function getTipoRegimen() {
		return $this->tipoRegimen;
	}
	
	public function setRetenedorIva($_retenedorIva) {
		$this->retenedorIva[$this->idx]= $_retenedorIva;
	}
	
	public function getRetenedorIva() {
		return $this->retenedorIva;
	}
	
	public function setProfesionLiberal($_profesionLiberal) {
		$this->profesionLiberal[$this->idx]= $_profesionLiberal;
	}
	
	public function getProfesionLiberal() {
		return $this->profesionLiberal;
	}
	
	public function setLey1429($_ley1429) {
		$this->ley1429[$this->idx]= $_ley1429;
	}
	
	public function getLey1429() {
		return $this->ley1429;
	}
	
	public function setEstado($_estado) {
		$this->estado[$this->idx]= $_estado;
	}
	
	public function getEstado() {
		return $this->estado;
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