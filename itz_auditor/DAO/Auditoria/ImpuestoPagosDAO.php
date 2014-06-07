<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/ImpuestoPagosEntidad.php';

use DAO\ConexionBD;
use Entidades\ImpuestoPagosEntidad;

class ImpuestoPagosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos) {
		$impuestoPagosRespuesta=null;
		$consulta="select ip.ipa_pago,ip.ipa_impuesto,ip.ipa_vl_impuesto,p.par_detalle,p.par_caracter from iau_impuesto_pagos ip,iau_parametros p where ip.ipa_impuesto=p.".
		"par_elemento and p.par_parametro='IMPUE' ".$impuestoPagos->getWhere();
		
		if ($impuestoPagos->getOrder()!='') $consulta.=" order by ".$impuestoPagos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$impuestoPagosRespuesta=new ImpuestoPagosEntidad();
		$impuestoPagosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aImpuestoPagos){
					$impuestoPagosRespuesta->setIdx($i);
					$impuestoPagosRespuesta->setPago($aImpuestoPagos[ipa_pago]);
					$impuestoPagosRespuesta->setImpuesto($aImpuestoPagos[ipa_impuesto]);
					$impuestoPagosRespuesta->setVlImpuesto($aImpuestoPagos[ipa_vl_impuesto]);
					$i++;
				}
			}
		}
		return $impuestoPagosRespuesta;
	}
	
	public function adicionarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos) {
		$impuestoPagosRespuesta=null;
		
		$pago=$impuestoPagos->getPago();
		$impuesto=$impuestoPagos->getImpuesto();
		$vl_impuesto=$impuestoPagos->getVlImpuesto();
		
		$consulta="insert into iau_impuesto_pagos (ipa_pago,ipa_impuesto,ipa_vl_impuesto) values ($pago[0],'$impuesto[0]',";
		if ($vl_impuesto[0]!='') $consulta.="'$vl_impuesto[0]'";
		else $consulta.="null,";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$impuestoPagosRespuesta=new ImpuestoPagosEntidad();
		$impuestoPagosRespuesta=$impuestoPagos;
		$impuestoPagosRespuesta->setResultado($resultado);
		
		return $impuestoPagosRespuesta;
	}
	
	public function modificarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos) {
		$impuestoPagosRespuesta=null;
		
		$pago=$impuestoPagos->getPago();
		$impuesto=$impuestoPagos->getImpuesto();
		$vl_impuesto=$impuestoPagos->getVlImpuesto();
		
		$consulta="update iau_impuesto_pagos set ";
		if ($vl_impuesto[0]!='') $consulta.="ipa_vl_impuesto='$vl_impuesto[0]'";
		else $consulta.="ipa_vl_impuesto=null";
		$consulta.=" where ipa_pago=$pago[0] and ipa_impuesto='$impuesto[0]'";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$impuestoPagosRespuesta=new ImpuestoPagosEntidad();
		$impuestoPagosRespuesta=$impuestoPagos;
		$impuestoPagosRespuesta->setResultado($resultado);
		
		return $impuestoPagosRespuesta;
	}
	
}

?>