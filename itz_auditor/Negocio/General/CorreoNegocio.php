<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\CorreoEntidad;

class CorreoNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function enviarCorreo(CorreoEntidad $correo) {
		return $this->fachadaDAO->enviarCorreo($correo);
	}
}

?>