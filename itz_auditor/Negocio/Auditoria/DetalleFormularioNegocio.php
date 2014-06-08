<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\DetalleFormularioEntidad;

class DetalleFormularioNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarDetalleFormulario(DetalleFormularioEntidad $detalleFormulario){
		return $this->fachadaDAO->listarDetalleFormulario($detalleFormulario);
	}
}

?>