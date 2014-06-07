<?php
namespace Entidades;

class DirectorioEntidad{
	private $identificacion;
	private $tipoDocumento;
	private $lugarDocumento;
	private $digitoV;
	private $tipoPersona;
	private $apellidos;
	private $nombres;
	private $direccion;
	private $telefono;
	private $correo;
	private $ciudadDireccion;
	private $barrio;
	private $fechaNac;
	private $lugarNac;
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
	
	public function setTipoDocumento($_tipoDocumento) {
		$this->tipoDocumento[$this->idx]= $_tipoDocumento;
	}
	
	public function getTipoDocumento() {
		return $this->tipoDocumento;
	}
	
	public function setLugarDocumento($_lugarDocumento) {
		$this->lugarDocumento[$this->idx]= $_lugarDocumento;
	}
	
	public function getLugarDocumento() {
		return $this->lugarDocumento;
	}
	
	public function setDigitoV($_digitoV) {
		$this->digitoV[$this->idx]= $_digitoV;
	}
	
	public function getDigitoV() {
		return $this->digitoV;
	}
	
	public function setTipoPersona($_tipoPersona) {
		$this->tipoPersona[$this->idx]= $_tipoPersona;
	}
	
	public function getTipoPersona() {
		return $this->tipoPersona;
	}
	
	public function setApellidos($_apellidos) {
		$this->apellidos[$this->idx]= $_apellidos;
	}
	
	public function getApellidos() {
		return $this->apellidos;
	}
	
	public function setNombres($_nombres) {
		$this->nombres[$this->idx]= $_nombres;
	}
	
	public function getNombres() {
		return $this->nombres;
	}
	
	public function setDireccion($_direccion) {
		$this->direccion[$this->idx]= $_direccion;
	}
	
	public function getDireccion() {
		return $this->direccion;
	}
	
	public function setTelefono($_telefono) {
		$this->telefono[$this->idx]= $_telefono;
	}
	
	public function getTelefono() {
		return $this->telefono;
	}
	
	public function setCorreo($_correo) {
		$this->correo[$this->idx]= $_correo;
	}
	
	public function getCorreo() {
		return $this->correo;
	}
	
	public function setCiudadDireccion($_ciudadDireccion) {
		$this->ciudadDireccion[$this->idx]= $_ciudadDireccion;
	}
	
	public function getCiudadDireccion() {
		return $this->ciudadDireccion;
	}
	
	public function setBarrio($_barrio) {
		$this->barrio[$this->idx]= $_barrio;
	}
	
	public function getBarrio() {
		return $this->barrio;
	}
	
	public function setFechaNac($_fechaNac) {
		$this->fechaNac[$this->idx]= $_fechaNac;
	}
	
	public function getFechaNac() {
		return $this->fechaNac;
	}
	
	public function setLugarNac($_lugarNac) {
		$this->lugarNac[$this->idx]= $_lugarNac;
	}
	
	public function getLugarNac() {
		return $this->lugarNac;
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