<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\EncabezadoFormularioEntidad;

class EncabezadoFormularioNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->fachadaDAO->listarEncabezadoFormulario($encabezadoFormulario);
	}
	
	public function adicionarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->fachadaDAO->adicionarEncabezadoFormulario($encabezadoFormulario);
	}
	
	public function modificarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->fachadaDAO->modificarEncabezadoFormulario($encabezadoFormulario);
	}
}

?>