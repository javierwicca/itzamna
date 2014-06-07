<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\DetallePagosEntidad;

class DetallePagosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->fachadaDAO->listarDetallePagos($detallePagos);
	}
	
	public function adicionarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->fachadaDAO->adicionarDetallePagos($detallePagos);
	}
	
	public function modificarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->fachadaDAO->modificarDetallePagos($detallePagos);
	}
}

?>