<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\LugaresEntidad;

class LugaresNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarLugares(LugaresEntidad $lugares){
		return $this->fachadaDAO->listarLugares($lugares);
	}
	
	public function adicionarLugares(LugaresEntidad $lugares){
		return $this->fachadaDAO->adicionarLugares($lugares);
	}
	
	public function modificarLugares(LugaresEntidad $lugares){
		return $this->fachadaDAO->modificarLugares($lugares);
	}
}

?>