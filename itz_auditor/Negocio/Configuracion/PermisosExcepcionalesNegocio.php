<?php

namespace Negocio;

require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\PermisosExcepcionalesEntidad;

class PermisosExcepcionalesNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->fachadaDAO->listarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function adicionarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->fachadaDAO->adicionarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function modificarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->fachadaDAO->modificarPermisosExcepcionales($permisosExcepcionales);
	}
}

?>