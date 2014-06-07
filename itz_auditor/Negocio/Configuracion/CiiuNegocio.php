<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\CiiuEntidad;

class CiiuNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarCiiu(CiiuEntidad $ciiu){
		return $this->fachadaDAO->listarCiiu($ciiu);
	}
	
	public function adicionarCiiu(CiiuEntidad $ciiu){
		return $this->fachadaDAO->adicionarCiiu($ciiu);
	}
	
	public function modificarCiiu(CiiuEntidad $ciiu){
		return $this->fachadaDAO->modificarCiiu($ciiu);
	}
}

?>