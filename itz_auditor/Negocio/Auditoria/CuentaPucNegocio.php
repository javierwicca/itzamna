<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\CuentaPucEntidad;

class CuentaPucNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->fachadaDAO->listarCuentaPuc($cuentaPuc);
	}
	
	public function modificarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->fachadaDAO->modificarCuentaPuc($cuentaPuc);
	}
}

?>