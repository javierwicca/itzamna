<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\BienServiciosEntidad;

class BienServiciosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->fachadaDAO->listarBienServicios($bienServicios);
	}
	
	public function adicionarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->fachadaDAO->adicionarBienServicios($bienServicios);
	}
	
	public function modificarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->fachadaDAO->modificarBienServicios($bienServicios);
	}
}

?>