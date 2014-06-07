<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\DocPagosEntidad;

class DocPagosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarDocPagos(DocPagosEntidad $docPagos) {
		return $this->fachadaDAO->listarDocPagos($docPagos);
	}
	
	public function adicionarDocPagos(DocPagosEntidad $docPagos) {
		return $this->fachadaDAO->adicionarDocPagos($docPagos);
	}
	
	public function modificarDocPagos(DocPagosEntidad $docPagos) {
		return $this->fachadaDAO->modificarDocPagos($docPagos);
	}
}

?>