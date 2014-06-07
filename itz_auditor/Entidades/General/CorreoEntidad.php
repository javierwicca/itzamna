<?php
namespace Entidades;

class CorreoEntidad{
	private $plantilla;
	private $datosEncabezado;
	private $datosCuerpo;
	private $to;
	private $cc;
	private $bcc;
	private $separador;
	private $tipoArchivo;
	private $nombreArchivo;
	private $archivo;
	
	public function setPlantilla($_plantilla) {
		$this->plantilla= $_plantilla;
	}
	
	public function getPlantilla() {
		return $this->plantilla;
	}
	
	public function setDatosEncabezado($_datosEncabezado) {
		$this->datosEncabezado= $_datosEncabezado;
	}
	
	public function getDatosEncabezado() {
		return $this->datosEncabezado;
	}
	
	public function setDatosCuerpo($_datosCuerpo) {
		$this->datosCuerpo= $_datosCuerpo;
	}
	
	public function getDatosCuerpo() {
		return $this->datosCuerpo;
	}
	
	public function setTo($_to) {
		$this->to= $_to;
	}
	
	public function getTo() {
		return $this->to;
	}
	
	public function setCc($_cc) {
		$this->cc= $_cc;
	}
	
	public function getCc() {
		return $this->cc;
	}
	
	public function setBcc($_bcc) {
		$this->bcc= $_bcc;
	}
	
	public function getBcc() {
		return $this->bcc;
	}
	
	public function setSeparador($_separador) {
		$this->separador= $_separador;
	}
	
	public function getSeparador() {
		return $this->separador;
	}
	
	public function setTipoArchivo($_tipoArchivo) {
		$this->tipoArchivo= $_tipoArchivo;
	}
	
	public function getTipoArchivo() {
		return $this->tipoArchivo;
	}
	
	public function setNombreArchivo($_nombreArchivo) {
		$this->nombreArchivo= $_nombreArchivo;
	}
	
	public function getNombreArchivo() {
		return $this->nombreArchivo;
	}
	
	public function setArchivo($_archivo) {
		$this->archivo= $_archivo;
	}
	
	public function getArchivo() {
		return $this->archivo;
	}
}

?>