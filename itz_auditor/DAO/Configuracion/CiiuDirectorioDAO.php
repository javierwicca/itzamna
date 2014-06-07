<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/CiiuDirectorioEntidad.php';

use DAO\ConexionBD;
use Entidades\CiiuDirectorioEntidad;

class CiiuDirectorioDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio) {
		$ciiuDirectorioRespuesta=null;
		$consulta="select c.cdi_identificacion,c.cdi_ciiu,c.cdi_lugar,c.cdi_principal,ci.ciu_tarifa,ci.ciu_version,ci.ciu_detalle from iau_ciiu_directorio c,iau_ciiu ci where c.cdi_ciiu=ci.".
		"ciu_codigo and c.cdi_lugar=ci.ciu_lugar ".$ciiuDirectorio->getWhere();
		
		if ($ciiuDirectorio->getOrder()!='') $consulta.=" order by ".$ciiuDirectorio->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$ciiuDirectorioRespuesta=new CiiuDirectorioEntidad();
		$ciiuDirectorioRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aCiiuDirectorio){
					$ciiuDirectorioRespuesta->setIdx($i);
					$ciiuDirectorioRespuesta->setIdentificacion($aCiiuDirectorio[cdi_identificacion]);
					$ciiuDirectorioRespuesta->setCiiu($aCiiuDirectorio[cdi_ciiu]);
					$ciiuDirectorioRespuesta->setLugar($aCiiuDirectorio[cdi_lugar]);
					$ciiuDirectorioRespuesta->setPrincipal($aCiiuDirectorio[cdi_principal]);
					$i++;
				}
			}
		}
		return $ciiuDirectorioRespuesta;
	}
	
	public function adicionarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio) {
		$ciiuDirectorioRespuesta=null;
		$identificacion=$ciiuDirectorio->getIdentificacion();
		$ciiu=$ciiuDirectorio->getCiiu();
		$lugar=$ciiuDirectorio->getLugar();
		$principal=$ciiuDirectorio->getPrincipal();
		$consulta="insert into iau_ciiu_directorio (cdi_identificacion,cdi_ciiu,cdi_lugar,cdi_principal) values ($identificacion[0],'$ciiu[0]','$lugar[0]','$principal[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$ciiuDirectorioRespuesta=new CiiuDirectorioEntidad();
		$ciiuDirectorioRespuesta=$ciiuDirectorio;
		$ciiuDirectorioRespuesta->setResultado($resultado);
		
		return $ciiuDirectorioRespuesta;
	}
	
	public function modificarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio) {
		$ciiuDirectorioRespuesta=null;
		
		$identificacion=$ciiuDirectorio->getIdentificacion();
		$ciiu=$ciiuDirectorio->getCiiu();
		$lugar=$ciiuDirectorio->getLugar();
		$principal=$ciiuDirectorio->getPrincipal();
		$consulta="update iau_ciiu_directorio set cdi_principal='$principal[0]' where cdi_identificacion=$identificacion[0] and cdi_ciiu='$ciiu[0]' and cdi_lugar='$lugar[0]'";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$ciiuDirectorioRespuesta=new CiiuDirectorioEntidad();
		$ciiuDirectorioRespuesta=$ciiuDirectorio;
		$ciiuDirectorioRespuesta->setResultado($resultado);
		
		return $ciiuDirectorioRespuesta;
	}
	
}

?>