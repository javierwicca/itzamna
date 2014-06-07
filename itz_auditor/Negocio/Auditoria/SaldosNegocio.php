<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\SaldosEntidad;

class SaldosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarSaldos(SaldosEntidad $saldos){
		return $this->fachadaDAO->listarSaldos($saldos);
	}
	
	public function borrarSaldos(SaldosEntidad $saldos){
		return $this->fachadaDAO->borrarSaldos($saldos);
	}
	
	public function insertarSaldos(SaldosEntidad $saldos){
		return $this->fachadaDAO->insertarSaldos($saldos);
	}
	
	public function insertarSaldosCop(SaldosEntidad $saldos){
		return $this->fachadaDAO->insertarSaldosCop($saldos);
	}
}

?>