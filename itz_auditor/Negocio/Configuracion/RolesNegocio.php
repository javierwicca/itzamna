<?php

namespace Negocio;

require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\RolesEntidad;

class RolesNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarRoles(RolesEntidad $roles) {
		return $this->fachadaDAO->listarRoles($roles);
	}
	
	public function adicionarRoles(RolesEntidad $roles) {
		return $this->fachadaDAO->adicionarRoles($roles);
	}
	
	public function modificarRoles(RolesEntidad $roles) {
		return $this->fachadaDAO->modificarRoles($roles);
	}
	
	public function inactivarRoles(RolesEntidad $roles) {
		return $this->fachadaDAO->inactivarRoles($roles);
	}
}

?>