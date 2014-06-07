<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\AccesoModulosEntidad;

class AccesoModulosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarAccesoModulos(AccesoModulosEntidad $accesoModulos) {
		return $this->fachadaDAO->listarAccesoModulos($accesoModulos);
	}
	
	public function adicionarAccesoModulos(AccesoModulosEntidad $accesoModulos) {
		return $this->fachadaDAO->adicionarAccesoModulos($accesoModulos);
	}
	
}

?>