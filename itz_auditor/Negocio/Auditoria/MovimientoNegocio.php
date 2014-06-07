<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\MovimientoEntidad;

class MovimientoNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarMovimiento(MovimientoEntidad $movimiento){
		return $this->fachadaDAO->listarMovimiento($movimiento);
	}
	
	public function comboMovimiento(MovimientoEntidad $movimiento){
		return $this->fachadaDAO->comboMovimiento($movimiento);
	}
	
	public function borrarMovimiento(MovimientoEntidad $movimiento){
		return $this->fachadaDAO->borrarMovimiento($movimiento);
	}
	
	public function insertarMovimiento(MovimientoEntidad $movimiento){
		return $this->fachadaDAO->insertarMovimiento($movimiento);
	}
	
	public function insertarMovimientoCop(MovimientoEntidad $movimiento){
		return $this->fachadaDAO->insertarMovimientoCop($movimiento);
	}
}

?>