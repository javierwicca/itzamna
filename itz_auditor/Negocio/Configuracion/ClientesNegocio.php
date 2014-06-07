<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\ClientesEntidad;

class ClientesNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarClientes(ClientesEntidad $clientes) {
		return $this->fachadaDAO->listarClientes($clientes);
	}
	
	public function adicionarClientes(ClientesEntidad $clientes) {
		return $this->fachadaDAO->adicionarClientes($clientes);
	}
	
	public function modificarClientes(ClientesEntidad $clientes) {
		return $this->fachadaDAO->modificarClientes($clientes);
	}
	
	public function inactivarClientes(ClientesEntidad $clientes) {
		return $this->fachadaDAO->inactivarClientes($clientes);
	}
}

?>