<?php

namespace Negocio;

require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\RolesUsuariosEntidad;

class RolesUsuariosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->fachadaDAO->listarRolesUsuarios($rolesUsuarios);
	}
	
	public function adicionarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->fachadaDAO->adicionarRolesUsuarios($rolesUsuarios);
	}
	
	public function modificarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->fachadaDAO->modificarRolesUsuarios($rolesUsuarios);
	}
}

?>