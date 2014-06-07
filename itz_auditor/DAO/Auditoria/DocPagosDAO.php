<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';

use DAO\ConexionBD;
use Entidades\DocPagosEntidad;

class DocPagosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarDocPagos(DocPagosEntidad $docPagos) {
		$docPagosRespuesta=null;
		$consulta="select p.dpa_pago,p.dpa_consecutivo,p.dpa_tipo_documento,p.dpa_num_documento,p.dpa_detalle from iau_doc_pagos p where 1=1 ".$docPagos->getWhere();
		
		if ($docPagos->getOrder()!='') $consulta.=" order by ".$docPagos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docPagosRespuesta=new DocPagosEntidad();
		$docPagosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aDocPagos){
					$docPagosRespuesta->setIdx($i);
					$docPagosRespuesta->setPago($aDocPagos[dpa_pago]);
					$docPagosRespuesta->setConsecutivo($aDocPagos[dpa_consecutivo]);
					$docPagosRespuesta->setTipoDocumento($aDocPagos[dpa_tipo_documento]);
					$docPagosRespuesta->setNumDocumento($aDocPagos[dpa_num_documento]);
					$docPagosRespuesta->setDetalle($aDocPagos[dpa_detalle]);
					$i++;
				}
			}
		}
		return $docPagosRespuesta;
	}
	
	public function adicionarDocPagos(DocPagosEntidad $docPagos) {
		$docPagosRespuesta=null;
		
		$pago=$docPagos->getPago();
		
		$consulta="select max(dpa_consecutivo) as consecutivo from iau_doc_pagos where dpa_pago0$pago[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		$consecutivo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $consecutivo=$fila[consecutivo];
		$consecutivo++;
		
		$docPagos->setConsecutivo($consecutivo);
		
		$tipo_documento=$docPagos->getTipoDocumento();
		$consecutivo=$docPagos->getConsecutivo();
		$num_documento=$docPagos->getNumDocumento();
		$detalle=$docPagos->getDetalle();
		
		$consulta="insert into iau_doc_pagos (dpa_pago,dpa_consecutivo,dpa_tipo_documento,dpa_num_documento,dpa_detalle) values ($pago[0],$consecutivo[0],";
		if ($tipo_documento[0]!='') $consulta.="'$tipo_documento[0]',";
		else $consulta.="null,";
		if ($num_documento[0]!='') $consulta.="'$num_documento[0]',";
		else $consulta.="null,";
		if ($detalle[0]!='') $consulta.="'$detalle[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docPagosRespuesta=new DocPagosEntidad();
		$docPagosRespuesta=$docPagos;
		$docPagosRespuesta->setResultado($resultado);
		
		return $docPagosRespuesta;
	}
	
	public function modificarDocPagos(DocPagosEntidad $docPagos) {
		$docPagosRespuesta=null;
		
		$pago=$docPagos->getPago();
		$tipo_documento=$docPagos->getTipoDocumento();
		$consecutivo=$docPagos->getConsecutivo();
		$num_documento=$docPagos->getNumDocumento();
		$detalle=$docPagos->getDetalle();
		
		$consulta="update iau_doc_pagos set ";
		if ($num_documento[0]!='') $consulta.="dpa_num_documento='$num_documento[0]',";
		else $consulta.="dpa_num_documento=null,";
		if ($detalle[0]!='') $consulta.="dpa_detalle='$detalle[0]'";
		else $consulta.="dpa_detalle=null";
		$consulta.=" where dpa_pago=$pago[0] and dpa_consecutivo=$consecutivo[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docPagosRespuesta=new DocPagosEntidad();
		$docPagosRespuesta=$docPagos;
		$docPagosRespuesta->setResultado($resultado);
		
		return $docPagosRespuesta;
	}
	
}

?>