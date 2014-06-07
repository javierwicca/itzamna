<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';

use DAO\DAOFacade;
use Entidades\ModulosEntidad;
use Entidades\UsuarioEntidad;


class ModulosNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO)) $this->fachadaDAO=new DAOFacade();
	}
	
	public function listarModulos(ModulosEntidad $modulos) {
		return $this->fachadaDAO->listarModulos($modulos);
	}
	
	public function listarModulosUsuario(UsuarioEntidad $usuario) {
		return  $this->fachadaDAO->listarModulosUsuario($usuario);
	}
}

?>