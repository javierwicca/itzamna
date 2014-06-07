<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\CiiuDirectorioEntidad;

class CiiuDirectorioNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->fachadaDAO->listarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function adicionarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->fachadaDAO->adicionarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function modificarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->fachadaDAO->modificarCiiuDirectorio($ciiuDirectorio);
	}
}

?>