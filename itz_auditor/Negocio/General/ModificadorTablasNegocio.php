<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\ModificadorTablasEntidad;

class ModificadorTablasNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarModificadorTablas(ModificadorTablasEntidad $modificadorTablas) {
		return $this->fachadaDAO->listarModificadorTablas($modificadorTablas);
	}
	
	public function ultUsuarioFechaHora(ModificadorTablasEntidad $modificadorTablas) {
		return $this->fachadaDAO->ultUsuarioFechaHora($modificadorTablas);
	}
	
	public function adicionarModificadorTablas(ModificadorTablasEntidad $modificadorTablas) {
		return $this->fachadaDAO->adicionarModificadorTablas($modificadorTablas);
	}
}

?>