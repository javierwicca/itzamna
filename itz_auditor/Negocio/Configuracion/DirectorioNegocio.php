<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\DirectorioEntidad;

class DirectorioNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarDirectorio(DirectorioEntidad $directorio){
		return $this->fachadaDAO->listarDirectorio($directorio);
	}
	
	public function adicionarDirectorio(DirectorioEntidad $directorio){
		return $this->fachadaDAO->adicionarDirectorio($directorio);
	}
	
	public function modificarDirectorio(DirectorioEntidad $directorio){
		return $this->fachadaDAO->modificarDirectorio($directorio);
	}
	
	public function inactivarDirectorio(DirectorioEntidad $Directorio){
		return $this->fachadaDAO->inactivarDirectorio($directorio);
	}
}

?>