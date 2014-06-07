<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/AccesoModulosEntidad.php';

use DAO\ConexionBD;
use Entidades\AccesoModulosEntidad;

class AccesoModulosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarAccesoModulos(AccesoModulosEntidad $accesoModulos) {
		$accesoModulosRespuesta=null;
		$consulta="select a.amo_modulo,a.amo_usuario,a.amo_fecha_hora,a.amo_acceso,a.amo_ip from iau_acceso_modulos m where 1=1 ".$accesoModulos->getWhere();
		
		if ($accesoModulos->getOrder()!='') $consulta.=" order by ".$accesoModulos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$accesoModulosRespuesta=new AccesoModulosEntidad();
		$accesoModulosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aAccesoModulos){
					$accesoModulosRespuesta->setIdx($i);
					$accesoModulosRespuesta->setModulo($aAccesoModulos[amo_modulo]);
					$accesoModulosRespuesta->setUsuario($aAccesoModulos[amo_usuario]);
					$accesoModulosRespuesta->setFechaHora($aAccesoModulos[amo_fecha_hora]);
					$accesoModulosRespuesta->setAcceso($aAccesoModulos[amo_acceso]);
					$accesoModulosRespuesta->setIp($aAccesoModulos[amo_ip]);
					$i++;
				}
			}
		}
		return $accesoModulosRespuesta;
	}
	
	public function adicionarAccesoModulos(AccesoModulosEntidad $accesoModulos) {
		$accesoModulosRespuesta=null;
		
		$modulo=$accesoModulos->getModulo();
		$usuario=$accesoModulos->getUsuario();
		$fecha_hora=$accesoModulos->getFechaHora();
		$acceso=$accesoModulos->getAcceso();
		$ip=$accesoModulos->getIp();
		
		$consulta="insert into iau_acceso_modulos (amo_modulo,amo_usuario,amo_fecha_hora,amo_acceso,amo_ip) values ($modulo[0],$usuario[0],'$fecha_hora[0]','$acceso[0]',".
		"'$ip[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$accesoModulosRespuesta=new AccesoModulosEntidad();
		$accesoModulosRespuesta=$accesoModulos;
		$accesoModulosRespuesta->setResultado($resultado);
		
		return $accesoModulosRespuesta;
	}
	
	
}

?>