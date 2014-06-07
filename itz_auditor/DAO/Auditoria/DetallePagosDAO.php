<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/DetallePagosEntidad.php';

use DAO\ConexionBD;
use Entidades\DetallePagosEntidad;

class DetallePagosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarDetallePagos(DetallePagosEntidad $detallePagos) {
		$detallePagosRespuesta=null;
		$consulta="select dp.dpa_pago,dp.dpa_consecutivo,dp.dpa_bien_servicio,dp.dpa_valor,dp.dpa_info,bs.bse_pr_retefuentej,bs.bse_pr_retefuenten,bs.bse_vl_uvt,bs.".
		"bse_pr_iva,bs.bse_pr_consumo,bs.bse_consecutivo,bs.bse_bien_servicio,bs.bse_detallado from iau_detalle_pagos dp,iau_bien_servicios bs where dp.dpa_bien_servicio=bs.".
		"bse_consecutivo ".$detallePagos->getWhere();
		
		if ($detallePagos->getOrder()!='') $consulta.=" order by ".$detallePagos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$detallePagosRespuesta=new DetallePagosEntidad();
		$detallePagosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aDetallePagos){
					$detallePagosRespuesta->setIdx($i);
					$detallePagosRespuesta->setPago($aDetallePagos[dpa_pago]);
					$detallePagosRespuesta->setConsecutivo($aDetallePagos[dpa_consecutivo]);
					$detallePagosRespuesta->setBienServicio($aDetallePagos[dpa_bien_servicio]);
					$detallePagosRespuesta->setValor($aDetallePagos[dpa_valor]);
					$detallePagosRespuesta->setInfo($aDetallePagos[dpa_info]);
					$i++;
				}
			}
		}
		return $detallePagosRespuesta;
	}
	
	public function adicionarDetallePagos(DetallePagosEntidad $detallePagos) {
		$detallePagosRespuesta=null;
		
		$pago=$detallePagos->getPago();
		$bien_servicio=$detallePagos->getBienServicio();
		$valor=$detallePagos->getValor();
		$info=$detallePagos->getInfo();
		
		$consulta="select max(dpa_consecutivo) as consecutivo from iau_detalle_pagos where dpa_pago=$pago[0]";
		$resultado=$this->conexion->consulta($consulta);
		$consecutivo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $consecutivo=$fila[consecutivo];
		$consecutivo++;
		
		$detallePagos->setConsecutivo($consecutivo);
		
		$consecutivo=$detallePagos->getConsecutivo();
		
		$consulta="insert into iau_detalle_pagos (dpa_pago,dpa_consecutivo,dpa_bien_servicio,dpa_valor,dpa_info) values ($pago[0],$consecutivo[0],";
		if ($bien_servicio[0]!='') $consulta.="'$bien_servicio[0]',";
		else $consulta.="null,";
		if ($valor[0]!='') $consulta.="'$valor[0]',";
		else $consulta.="null,";
		if ($info[0]!='') $consulta.="'$info[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$detallePagosRespuesta=new DetallePagosEntidad();
		$detallePagosRespuesta=$detallePagos;
		$detallePagosRespuesta->setResultado($resultado);
		
		return $detallePagosRespuesta;
	}
	
	public function modificarDetallePagos(DetallePagosEntidad $detallePagos) {
		$detallePagosRespuesta=null;
		
		$consecutivo=$detallePagos->getConsecutivo();
		$pago=$detallePagos->getPago();
		$bien_servicio=$detallePagos->getBienServicio();
		$valor=$detallePagos->getValor();
		$info=$detallePagos->getInfo();
		
		$consulta="update iau_detalle_pagos set ";
		if ($bien_servicio[0]!='') $consulta.="dpa_bien_servicio='$bien_servicio[0]',";
		else $consulta.="dpa_bien_servicio=null,";
		if ($valor[0]!='') $consulta.="dpa_valor='$valor[0]',";
		else $consulta.="dpa_valor=null,";
		if ($info[0]!='') $consulta.="dpa_info='$info[0]'";
		else $consulta.="dpa_info=null";
		$consulta.=" where dpa_pago=$pago[0] and dpa_consecutivo=$consecutivo[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$detallePagosRespuesta=new DetallePagosEntidad();
		$detallePagosRespuesta=$detallePagos;
		$detallePagosRespuesta->setResultado($resultado);
		
		return $detallePagosRespuesta;
	}
	
}

?>