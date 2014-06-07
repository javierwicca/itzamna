<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\ImpuestoPagosEntidad;

class ImpuestoPagosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->fachadaDAO->listarImpuestoPagos($impuestoPagos);
	}
	
	public function adicionarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->fachadaDAO->adicionarImpuestoPagos($impuestoPagos);
	}
	
	public function modificarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->fachadaDAO->modificarImpuestoPagos($impuestoPagos);
	}
}

?>