<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/ModulosEntidad.php';
require_once '../Entidades/Configuracion/UsuarioEntidad.php';

use DAO\ConexionBD;
use Entidades\ModulosEntidad;
use Entidades\UsuarioEntidad;

class ModulosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarModulos(ModulosEntidad $modulos) {
		$modulosRespuesta=null;
		$consulta="select mm.mme_codigo,mm.mme_nombre,mm.mme_nombre_mostrar,mm.mme_modulo,mm.mme_pagina,mm.mme_imagen,mm.mme_menu_sup,mm.mme_orden,p.par_detalle from ".
		"iau_modulos_menus mm,iau_parametros p where mm.mme_modulo=p.par_elemento and p.par_parametro='MODUL' ".$modulos->getWhere();
		if ($modulos->getOrder()!='') $consulta.=" order by ".$modulos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$modulosRespuesta=new ModulosEntidad();
		$modulosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aModulos){
					$modulosRespuesta->setIdx($i);
					$modulosRespuesta->setCodigo($aModulos[mme_codigo]);
					$modulosRespuesta->setNombre($aModulos[mme_nombre]);
					$modulosRespuesta->setNombreMostrar($aModulos[mme_nombre_mostrar]);
					$modulosRespuesta->setModulo($aModulos[mme_modulo]);
					$modulosRespuesta->setPagina($aModulos[mme_pagina]);
					$modulosRespuesta->setImagen($aModulos[mme_imagen]);
					$modulosRespuesta->setMenuSup($aModulos[mme_menu_sup]);
					$modulosRespuesta->setOrden($aModulos[mme_orden]);
					$i++;
				}
			}
		}
		return $modulosRespuesta;
	}
	
	public function listarModulosUsuario(UsuarioEntidad $usuario) {
		$modulosRespuesta=null;
		$consulta="select distinct mm.mme_codigo,mm.mme_nombre,mm.mme_nombre_mostrar,mm.mme_modulo,mm.mme_pagina,mm.mme_imagen,mm.mme_menu_sup,mm.mme_orden from ".
		"iau_modulos_menus mm inner join iau_roles_permisos rp on mm.mme_codigo=rp.rpe_modulo and rp.rpe_consulta inner join iau_roles ro on ro.rol_codigo=rp.rpe_rol and ro.".
		"rol_estado='A' inner join iau_roles_usuarios ru on ru.rus_rol=rp.rpe_rol where 1=1 and ru.rus_usuario=".base64_decode($usuario->getIdentificacion())." union select ".
		"distinct mm.mme_codigo,mm.mme_nombre,mm.mme_nombre_mostrar,mm.mme_modulo,mm.mme_pagina,mm.mme_imagen,mm.mme_menu_sup,mm.mme_orden from iau_modulos_menus mm inner ".
		"join iau_permisos_excepcionales pe on mm.mme_codigo=pe.pex_modulo and pe.pex_consulta where 1=1 and pe.pex_usuario =".base64_decode($usuario->getIdentificacion());
		
		$resultado=$this->conexion->consulta($consulta);
		
		$modulosRespuesta=new ModulosEntidad();
		$modulosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aModulos){
					$modulosRespuesta->setIdx($i);
					$modulosRespuesta->setCodigo($aModulos[mme_codigo]);
					$modulosRespuesta->setNombre($aModulos[mme_nombre]);
					$modulosRespuesta->setNombreMostrar($aModulos[mme_nombre_mostrar]);
					$modulosRespuesta->setModulo($aModulos[mme_modulo]);
					$modulosRespuesta->setPagina($aModulos[mme_pagina]);
					$modulosRespuesta->setImagen($aModulos[mme_imagen]);
					$modulosRespuesta->setMenuSup($aModulos[mme_menu_sup]);
					$modulosRespuesta->setOrden($aModulos[mme_orden]);
					$i++;
				}
			}
		}
		return $modulosRespuesta;
	}
	
}

?>