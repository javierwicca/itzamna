<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\DocProveedoresEntidad;

class DocProveedoresNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->fachadaDAO->listarDocProveedores($docProveedores);
	}
	
	public function adicionarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->fachadaDAO->adicionarDocProveedores($docProveedores);
	}
	
	public function modificarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->fachadaDAO->modificarDocProveedores($docProveedores);
	}
}

?>