<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\PagosEntidad;

class PagosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarPagos(PagosEntidad $pagos){
		return $this->fachadaDAO->listarPagos($pagos);
	}
	
	public function adicionarPagos(PagosEntidad $pagos){
		return $this->fachadaDAO->adicionarPagos($pagos);
	}
	
	public function modificarPagos(PagosEntidad $pagos){
		return $this->fachadaDAO->modificarPagos($pagos);
	}
}

?>