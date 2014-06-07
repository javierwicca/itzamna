<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\ProveedoresEntidad;

class ProveedoresNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarProveedores(ProveedoresEntidad $proveedores) {
		return $this->fachadaDAO->listarProveedores($proveedores);
	}
	
	public function adicionarProveedores(ProveedoresEntidad $proveedores) {
		return $this->fachadaDAO->adicionarProveedores($proveedores);
	}
	
	public function modificarProveedores(ProveedoresEntidad $proveedores) {
		return $this->fachadaDAO->modificarProveedores($proveedores);
	}
	
	public function inactivarProveedores(ProveedoresEntidad $proveedores) {
		return $this->fachadaDAO->inactivarProveedores($proveedores);
	}
}

?>