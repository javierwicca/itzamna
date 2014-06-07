<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/PermisosExcepcionalesEntidad.php';

use DAO\ConexionBD;
use Entidades\PermisosExcepcionalesEntidad;

class PermisosExcepcionalesDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		$permisosExcepcionalesRespuesta=null;
		$consulta="select pe.pex_usuario,pe.pex_modulo,pe.pex_empresa,pe.pex_rol,pe.pex_consulta,pe.pex_adicionar,pe.pex_modificar,pe.pex_eliminar from ".
		"iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=ru.rus_usuario and pe.pex_empresa=ru.rus_empresa and pe.pex_rol=ru.rus_rol ".
		$permisosExcepcionales->getWhere();
		
		if ($permisosExcepcionales->getOrder()!='') $consulta.=" order by ".$permisosExcepcionales->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$permisosExcepcionalesRespuesta=new PermisosExcepcionalesEntidad();
		$permisosExcepcionalesRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aPermisosExcepcionales){
					$permisosExcepcionalesRespuesta->setIdx($i);
					$permisosExcepcionalesRespuesta->setUsuario($aPermisosExcepcionales[pex_usuario]);
					$permisosExcepcionalesRespuesta->setModulo($aPermisosExcepcionales[pex_modulo]);
					$permisosExcepcionalesRespuesta->setEmpresa($aPermisosExcepcionales[pex_empresa]);
					$permisosExcepcionalesRespuesta->setRol($aPermisosExcepcionales[pex_rol]);
					$permisosExcepcionalesRespuesta->setConsulta($aPermisosExcepcionales[pex_consulta]);
					$permisosExcepcionalesRespuesta->setAdicionar($aPermisosExcepcionales[pex_adicionar]);
					$permisosExcepcionalesRespuesta->setModificar($aPermisosExcepcionales[pex_modificar]);
					$permisosExcepcionalesRespuesta->setEliminar($aPermisosExcepcionales[pex_eliminar]);
					$i++;
				}
			}
		}
		return $permisosExcepcionalesRespuesta;
	}
	
	public function adicionarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		
		$usuario=$permisosExcepcionales->getUsuario();
		$modulo=$permisosExcepcionales->getModulo();
		$empresa=$permisosExcepcionales->getEmpresa();
		$rol=$permisosExcepcionales->getRol();
		$consultar=$permisosExcepcionales->getConsulta();
		$adicionar=$permisosExcepcionales->getAdicionar();
		$modificar=$permisosExcepcionales->getModificar();
		$eliminar=$permisosExcepcionales->getEliminar();
		$consulta="insert into iau_permisos_excepcionales (pex_usuario,pex_modulo,pex_empresa,pex_rol,pex_consulta,pex_adicionar,pex_modificar,pex_eliminar) values(".
		"$usuario[0],$modulo[0],$empresa[0],$rol[0],'$consultar[0]','$adicionar[0]','$modificar[0]','$eliminar[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$permisosExcepcionalesRespuesta=new PermisosExcepcionalesEntidad();
		$permisosExcepcionalesRespuesta=$permisosExcepcionales;
		$permisosExcepcionalesRespuesta->setResultado($resultado);
		return $permisosExcepcionalesRespuesta;
	}
	
	public function modificarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		$permisosExcepcionalesRespuesta=null;
		
		$usuario=$permisosExcepcionales->getUsuario();
		$modulo=$permisosExcepcionales->getModulo();
		$empresa=$permisosExcepcionales->getEmpresa();
		$rol=$permisosExcepcionales->getRol();
		$consultar=$permisosExcepcionales->getConsulta();
		$adicionar=$permisosExcepcionales->getAdicionar();
		$modificar=$permisosExcepcionales->getModificar();
		$eliminar=$permisosExcepcionales->getEliminar();
		
		$consulta="update iau_permisos_excepcionales set pex_consulta='$consultar[0]',pex_adicionar='$adicionar[0]',pex_modificar='$modificar[0]',pex_eliminar='$eliminar[0]' ".
		"where pex_rol=$rol[0] and pex_modulo=$modulo[0] and pex_usuario=$usuario[0] and pex_empresa=$empresa[0]";
		$resultado=$this->conexion->consulta($consulta);
		
		$permisosExcepcionalesRespuesta=new PermisosExcepcionalesEntidad();
		$permisosExcepcionalesRespuesta=$permisosExcepcionales;
		$permisosExcepcionalesRespuesta->setResultado($resultado);
		return $permisosExcepcionalesRespuesta;
	}
	
}

?>