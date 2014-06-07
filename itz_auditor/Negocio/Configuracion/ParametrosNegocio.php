<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\ParametrosEntidad;

class ParametrosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarParametros(ParametrosEntidad $parametros){
		return $this->fachadaDAO->listarParametros($parametros);
	}
	
	public function adicionarParametros(ParametrosEntidad $parametros){
		return $this->fachadaDAO->adicionarParametros($parametros);
	}
	
	public function modificarParametros(ParametrosEntidad $parametros){
		return $this->fachadaDAO->modificarParametros($parametros);
	}
}

?>