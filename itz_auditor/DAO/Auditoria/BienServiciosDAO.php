<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/BienServiciosEntidad.php';

use DAO\ConexionBD;
use Entidades\BienServiciosEntidad;

class BienServiciosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarBienServicios(BienServiciosEntidad $bienServicios) {
		$bienServiciosRespuesta=null;
		$consulta="select bs.bse_consecutivo,bs.bse_bien_servicio,bs.bse_pr_retefuentej,bs.bse_pr_retefuenten,bs.bse_vl_uvt,bs.bse_pr_iva,bs.bse_pr_consumo,bs.bse_detallado ".
		"from iau_bien_servicios bs where 1=1 ".$bienServicios->getWhere();
		
		if ($bienServicios->getOrder()!='') $consulta.=" order by ".$bienServicios->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$bienServiciosRespuesta=new BienServiciosEntidad();
		$bienServiciosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aBienServicios){
					$bienServiciosRespuesta->setIdx($i);
					$bienServiciosRespuesta->setConsecutivo($aBienServicios[bse_consecutivo]);
					$bienServiciosRespuesta->setBienServicio($aBienServicios[bse_bien_servicio]);
					$bienServiciosRespuesta->setPrRetefuentej($aBienServicios[bse_pr_retefuentej]);
					$bienServiciosRespuesta->setPrRetefuenten($aBienServicios[bse_pr_retefuenten]);
					$bienServiciosRespuesta->setVlUvt($aBienServicios[bse_vl_uvt]);
					$bienServiciosRespuesta->setPrIva($aBienServicios[bse_pr_iva]);
					$bienServiciosRespuesta->setPrConsumo($aBienServicios[bse_pr_consumo]);
					$bienServiciosRespuesta->setDetallado($aBienServicios[bse_detallado]);
					$i++;
				}
			}
		}
		return $bienServiciosRespuesta;
	}
	
	public function adicionarBienServicios(BienServiciosEntidad $bienServicios) {
		$bienServiciosRespuesta=null;
		
		$consulta="select max(bse_consecutivo) as consecutivo from iau_bien_servicios";
		$resultado=$this->conexion->consulta($consulta);
		$consecutivo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $consecutivo=$fila[consecutivo];
		$consecutivo++;
		
		$bienServicios->setConsecutivo($consecutivo);
		
		$consecutivo=$bienServicios->getConsecutivo();
		$bien_servicio=$bienServicios->getBienServicio();
		$pr_retefuentej=$bienServicios->getPrRetefuentej();
		$pr_retefuenten=$bienServicios->getPrRetefuenten();
		$vl_uvt=$bienServicios->getVlUvt();
		$pr_iva=$bienServicios->getPrIva();
		$pr_consumo=$bienServicios->getPrConsumo();
		$detallado=$bienServicios->getDetallado();
		
		$consulta="insert into iau_bien_servicios (bse_consecutivo,bse_bien_servicio,bse_pr_retefuentej,bse_pr_retefuenten,bse_vl_uvt,bse_pr_iva,bse_pr_consumo,bse_detallado".
		") values ($consecutivo[0],";
		if ($bien_servicio[0]!='') $consulta.="'$bien_servicio[0]',";
		else $consulta.="null,";
		if ($pr_retefuentej[0]!='') $consulta.="'$pr_retefuentej[0]',";
		else $consulta.="null,";
		if ($pr_retefuenten[0]!='') $consulta.="'$pr_retefuenten[0]',";
		else $consulta.="null,";
		if ($vl_uvt[0]!='') $consulta.="'$vl_uvt[0]',";
		else $consulta.="null,";
		if ($pr_iva[0]!='') $consulta.="'$pr_iva[0]',";
		else $consulta.="null,";
		if ($pr_consumo[0]!='') $consulta.="'$pr_consumo[0]',";
		else $consulta.="null,";
		if ($detallado[0]!='') $consulta.="'$detallado[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$bienServiciosRespuesta=new BienServiciosEntidad();
		$bienServiciosRespuesta=$bienServicios;
		$bienServiciosRespuesta->setResultado($resultado);
		
		return $bienServiciosRespuesta;
	}
	
	public function modificarBienServicios(BienServiciosEntidad $bienServicios) {
		$bienServiciosRespuesta=null;
		
		$consecutivo=$bienServicios->getConsecutivo();
		$bien_servicio=$bienServicios->getBienServicio();
		$pr_retefuentej=$bienServicios->getPrRetefuentej();
		$pr_retefuenten=$bienServicios->getPrRetefuenten();
		$vl_uvt=$bienServicios->getVlUvt();
		$pr_iva=$bienServicios->getPrIva();
		$pr_consumo=$bienServicios->getPrConsumo();
		$detallado=$bienServicios->getDetallado();
		
		$consulta="update iau_bien_servicios set ";
		if ($bien_servicio[0]!='') $consulta.="bse_bien_servicio='$bien_servicio[0]',";
		else $consulta.="bse_bien_servicio=null,";
		if ($pr_retefuentej[0]!='') $consulta.="bse_pr_retefuentej='$pr_retefuentej[0]',";
		else $consulta.="bse_pr_retefuentej=null,";
		if ($pr_retefuenten[0]!='') $consulta.="bse_pr_retefuenten='$pr_retefuenten[0]',";
		else $consulta.="bse_pr_retefuenten=null,";
		if ($vl_uvt[0]!='') $consulta.="bse_vl_uvt='$vl_uvt[0]',";
		else $consulta.="bse_vl_uvt=null,";
		if ($pr_iva[0]!='') $consulta.="bse_pr_iva='$pr_iva[0]',";
		else $consulta.="bse_pr_iva=null,";
		if ($pr_consumo[0]!='') $consulta.="bse_pr_consumo='$pr_consumo[0]',";
		else $consulta.="bse_pr_consumo=null,";
		if ($detallado[0]!='') $consulta.="bse_detallado='$detallado[0]'";
		else $consulta.="bse_detallado=null";
		$consulta.=" where bse_consecutivo=$consecutivo[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$bienServiciosRespuesta=new BienServiciosEntidad();
		$bienServiciosRespuesta=$bienServicios;
		$bienServiciosRespuesta->setResultado($resultado);
		
		return $bienServiciosRespuesta;
	}
	
}

?>