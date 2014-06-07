<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/RolesUsuariosEntidad.php';

use DAO\ConexionBD;
use Entidades\RolesUsuariosEntidad;

class RolesUsuariosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		$rolesUsuariosRespuesta=null;
		$consulta="select ru.rus_rol,ru.rus_usuario,ru.rus_empresa,ru.rus_estado from iau_roles_usuarios ru where 1=1 ".$rolesUsuarios->getWhere();
		
		if ($rolesUsuarios->getOrder()!='') $consulta.=" order by ".$rolesUsuarios->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesUsuariosRespuesta=new RolesUsuariosEntidad();
		$rolesUsuariosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aRolesUsuarios){
					$rolesUsuariosRespuesta->setIdx($i);
					$rolesUsuariosRespuesta->setRol($aRolesUsuarios[rus_rol]);
					$rolesUsuariosRespuesta->setUsuario($aRolesUsuarios[rus_usuario]);
					$rolesUsuariosRespuesta->setEmpresa($aRolesUsuarios[rus_empresa]);
					$rolesUsuariosRespuesta->setEstado($aRolesUsuarios[rus_estado]);
					$i++;
				}
			}
		}
		return $rolesUsuariosRespuesta;
	}
	
	public function adicionarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		
		$rol=$rolesUsuarios->getRol();
		$usuario=$rolesUsuarios->getUsuario();
		$empresa=$rolesUsuarios->getEmpresa();
		$estado=$rolesUsuarios->getEstado();
		$consulta="insert into iau_roles_usuarios (rus_rol,rus_usuario,rus_empresa,rus_estado) values($rol[0],$usuario[0],$empresa[0],'$estado[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesUsuariosRespuesta=new RolesUsuariosEntidad();
		$rolesUsuariosRespuesta=$rolesUsuarios;
		$rolesUsuariosRespuesta->setResultado($resultado);
		return $rolesUsuariosRespuesta;
	}
	
	public function modificarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		$rolesUsuariosRespuesta=null;
		
		$rol=$rolesUsuarios->getRol();
		$usuario=$rolesUsuarios->getUsuario();
		$empresa=$rolesUsuarios->getEmpresa();
		$estado=$rolesUsuarios->getEstado();
		
		$consulta="update iau_roles_usuarios set rus_estado='$estado[0]' where rus_rol=$rol[0] and rus_usuario=$usuario[0] and rus_empresa=$empresa[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesUsuariosRespuesta=new RolesUsuariosEntidad();
		$rolesUsuariosRespuesta=$rolesUsuarios;
		$rolesUsuariosRespuesta->setResultado($resultado);
		return $rolesUsuariosRespuesta;
	}
	
}

?>