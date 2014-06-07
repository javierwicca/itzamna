<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/RolesPermisosEntidad.php';

use DAO\ConexionBD;
use Entidades\RolesPermisosEntidad;

class RolesPermisosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		$rolesPermisosRespuesta=null;
		$consulta="select rp.rpe_rol,rp.rpe_modulo,rp.rpe_consulta,rp.rpe_adicionar,rp.rpe_modificar,rp.rpe_eliminar from iau_roles_permisos rp where 1=1 ".
		$rolesPermisos->getWhere();
		
		if ($rolesPermisos->getOrder()!='') $consulta.=" order by ".$rolesPermisos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesPermisosRespuesta=new RolesPermisosEntidad();
		$rolesPermisosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aRolesPermisos){
					$rolesPermisosRespuesta->setIdx($i);
					$rolesPermisosRespuesta->setRol($aRolesPermisos[rpe_rol]);
					$rolesPermisosRespuesta->setModulo($aRolesPermisos[rpe_modulo]);
					$rolesPermisosRespuesta->setConsulta($aRolesPermisos[rpe_consulta]);
					$rolesPermisosRespuesta->setAdicionar($aRolesPermisos[rpe_adicionar]);
					$rolesPermisosRespuesta->setModificar($aRolesPermisos[rpe_modificar]);
					$rolesPermisosRespuesta->setEliminar($aRolesPermisos[rpe_eliminar]);
					$i++;
				}
			}
		}
		return $rolesPermisosRespuesta;
	}
	
	public function adicionarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		
		$rol=$rolesPermisos->getRol();
		$modulo=$rolesPermisos->getModulo();
		$consultar=$rolesPermisos->getConsulta();
		$adicionar=$rolesPermisos->getAdicionar();
		$modificar=$rolesPermisos->getModificar();
		$eliminar=$rolesPermisos->getEliminar();
		$consulta="insert into iau_roles_permisos (rpe_rol,rpe_modulo,rpe_consulta,rpe_adicionar,rpe_modificar,rpe_eliminar) values($rol[0],$modulo[0],'$consultar[0]',".
		"'$adicionar[0]','$modificar[0]','$eliminar[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesPermisosRespuesta=new RolesPermisosEntidad();
		$rolesPermisosRespuesta=$rolesPermisos;
		$rolesPermisosRespuesta->setResultado($resultado);
		return $rolesPermisosRespuesta;
	}
	
	public function modificarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		$rolesPermisosRespuesta=null;
		
		$rol=$rolesPermisos->getRol();
		$modulo=$rolesPermisos->getModulo();
		$consultar=$rolesPermisos->getConsulta();
		$adicionar=$rolesPermisos->getAdicionar();
		$modificar=$rolesPermisos->getModificar();
		$eliminar=$rolesPermisos->getEliminar();
		
		$consulta="update iau_roles_permisos set rpe_consulta='$consultar[0]',rpe_adicionar='$adicionar[0]',rpe_modificar='$modificar[0]',rpe_eliminar='$eliminar[0]' where ".
		"rpe_rol=$rol[0] and rpe_modulo=$modulo[0]";
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesPermisosRespuesta=new RolesPermisosEntidad();
		$rolesPermisosRespuesta=$rolesPermisos;
		$rolesPermisosRespuesta->setResultado($resultado);
		return $rolesPermisosRespuesta;
	}
	
}

?>