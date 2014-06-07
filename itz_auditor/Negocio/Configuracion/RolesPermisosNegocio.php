<?php

namespace Negocio;

require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\RolesPermisosEntidad;

class RolesPermisosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->fachadaDAO->listarRolesPermisos($rolesPermisos);
	}
	
	public function adicionarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->fachadaDAO->adicionarRolesPermisos($rolesPermisos);
	}
	
	public function modificarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->fachadaDAO->modificarRolesPermisos($rolesPermisos);
	}
}

?>