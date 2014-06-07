<?php

namespace Negocio;
require_once '../DAO/General/DAOFacade.php';
use DAO\DAOFacade;
use Entidades\UsuarioEntidad;

class UsuarioNegocio {
	
	private $fachadaDAO;
	
	function __construct() {
		if (!isset($this->fachadaDAO))$this->fachadaDAO=new DAOFacade();
	}
	
	public function buscarUsuario(UsuarioEntidad $usuario) {
		return $this->fachadaDAO->buscarUsuario($usuario);
	}
	
	public function adicionarUsuario(UsuarioEntidad $usuario) {
		return $this->fachadaDAO->adicionarUsuario($usuario);
	}
	
	public function modificarUsuario(UsuarioEntidad $usuario) {
		return $this->fachadaDAO->modificarUsuario($usuario);
	}
	
	public function inactivarUsuario(UsuarioEntidad $usuario) {
		return $this->fachadaDAO->inactivarUsuario($usuario);
	}
	
	public function cambioClave(UsuarioEntidad $usuario) {
		return $this->fachadaDAO->cambioClave($usuario);
	}
	
	public function encriptaClave($usuario,$clave) {
		return md5(sha1($usuario).hash('ripemd128',$clave));
	}
}

?>