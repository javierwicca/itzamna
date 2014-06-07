<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/RolesEntidad.php';

use DAO\ConexionBD;
use Entidades\RolesEntidad;

class RolesDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarRoles(RolesEntidad $roles) {
		$rolesRespuesta=null;
		$consulta="select r.rol_codigo,r.rol_nombre,r.rol_estado from iau_roles r where 1=1 ".$roles->getWhere();
		
		if ($roles->getOrder()!='') $consulta.=" order by ".$roles->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesRespuesta=new RolesEntidad();
		$rolesRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aRoles){
					$rolesRespuesta->setIdx($i);
					$rolesRespuesta->setCodigo($aRoles[rol_codigo]);
					$rolesRespuesta->setNombre($aRoles[rol_nombre]);
					$rolesRespuesta->setEstado($aRoles[rol_estado]);
					$i++;
				}
			}
		}
		return $rolesRespuesta;
	}
	
	public function adicionarRoles(RolesEntidad $roles) {
		$rolesRespuesta=null;
		$consulta="select max(r.rol_codigo) as codigo from iau_roles r";
		
		$resultado=$this->conexion->consulta($consulta);
		$codigo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $codigo=$fila[codigo];
		$codigo++;
		
		$roles->setCodigo($codigo);
		
		$codigo=$roles->getCodigo();
		$nombre=$roles->getNombre();
		$estado=$roles->getEstado();
		$consulta="insert into iau_roles (rol_codigo,rol_nombre,rol_estado) values($codigo[0],'$nombre[0]','$estado[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesRespuesta=new RolesEntidad();
		$rolesRespuesta=$roles;
		$rolesRespuesta->setResultado($resultado);
		return $rolesRespuesta;
	}
	
	public function modificarRoles(RolesEntidad $roles) {
		$rolesRespuesta=null;
		$codigo=$roles->getCodigo();
		$nombre=$roles->getNombre();
		$estado=$roles->getEstado();
		$consulta="update iau_roles set rol_nombre='$nombre[0]',rol_estado='$estado[0]' where rol_codigo=$codigo[0]";
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesRespuesta=new RolesEntidad();
		$rolesRespuesta=$roles;
		$rolesRespuesta->setResultado($resultado);
		return $rolesRespuesta;
	}
	
	public function inactivarRoles(RolesEntidad $roles) {
		$rolesRespuesta=null;
		
		$codigo=$roles->getCodigo();
		$estado=$roles->getEstado();
		
		$consulta="update iau_roles set rol_estado='$estado[0]' where rol_codigo=$codigo[0]";
		$resultado=$this->conexion->consulta($consulta);
		
		$rolesRespuesta=new RolesEntidad();
		$rolesRespuesta=$roles;
		$rolesRespuesta->setResultado($resultado);
		return $rolesRespuesta;
	}
	
}

?>