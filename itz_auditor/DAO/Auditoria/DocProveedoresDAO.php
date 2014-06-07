<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';

use DAO\ConexionBD;
use Entidades\DocProveedoresEntidad;

class DocProveedoresDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarDocProveedores(DocProveedoresEntidad $docProveedores) {
		$docProveedoresRespuesta=null;
		$consulta="select p.dpr_identificacion,p.dpr_tipo_documento,p.dpr_fecha_doc,p.dpr_num_documento,p.dpr_detalle,pa.par_detalle 
				from iau_doc_proveedores p, iau_parametros pa where p.dpr_tipo_documento = pa.par_elemento and pa.par_parametro = 'TDCPR' ".
		$docProveedores->getWhere();
		
		if ($docProveedores->getOrder()!='') $consulta.=" order by ".$docProveedores->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docProveedoresRespuesta=new DocProveedoresEntidad();
		$docProveedoresRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aDocProveedores){
					$docProveedoresRespuesta->setIdx($i);
					$docProveedoresRespuesta->setIdentificacion($aDocProveedores[dpr_identificacion]);
					$docProveedoresRespuesta->setTipoDocumento($aDocProveedores[dpr_tipo_documento]);
					$docProveedoresRespuesta->setFechaDoc($aDocProveedores[dpr_fecha_doc]);
					$docProveedoresRespuesta->setNumDocumento($aDocProveedores[dpr_num_documento]);
					$docProveedoresRespuesta->setDetalle($aDocProveedores[dpr_detalle]);
					$i++;
				}
			}
		}
		return $docProveedoresRespuesta;
	}
	
	public function adicionarDocProveedores(DocProveedoresEntidad $docProveedores) {
		$docProveedoresRespuesta=null;
		
		$identificacion=$docProveedores->getIdentificacion();
		$tipo_documento=$docProveedores->getTipoDocumento();
		$fecha_doc=$docProveedores->getFechaDoc();
		$num_documento=$docProveedores->getNumDocumento();
		$detalle=$docProveedores->getDetalle();
		
		$consulta="insert into iau_doc_proveedores (dpr_identificacion,dpr_tipo_documento,dpr_fecha_doc,dpr_num_documento,dpr_detalle) values ($identificacion[0],";
		if ($tipo_documento[0]!='') $consulta.="'$tipo_documento[0]',";
		else $consulta.="null,";
		if ($fecha_doc[0]!='') $consulta.="'$fecha_doc[0]',";
		else $consulta.="null,";
		if ($num_documento[0]!='') $consulta.="'$num_documento[0]',";
		else $consulta.="null,";
		if ($detalle[0]!='') $consulta.="'$detalle[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docProveedoresRespuesta=new DocProveedoresEntidad();
		$docProveedoresRespuesta=$docProveedores;
		$docProveedoresRespuesta->setResultado($resultado);
		
		return $docProveedoresRespuesta;
	}
	
	public function modificarDocProveedores(DocProveedoresEntidad $docProveedores) {
		$docProveedoresRespuesta=null;
		
		$identificacion=$docProveedores->getIdentificacion();
		$tipo_documento=$docProveedores->getTipoDocumento();
		$fecha_doc=$docProveedores->getFechaDoc();
		$num_documento=$docProveedores->getNumDocumento();
		$detalle=$docProveedores->getDetalle();
		
		$consulta="update iau_doc_proveedores set ";
		if ($num_documento[0]!='') $consulta.="dpr_num_documento='$num_documento[0]',";
		else $consulta.="dpr_num_documento=null,";
		if ($detalle[0]!='') $consulta.="dpr_detalle='$detalle[0]'";
		else $consulta.="dpr_detalle=null";
		$consulta.=" where dpr_identificacion=$identificacion[0] and dpr_tipo_documento='$tipo_documento[0]' and dpr_fecha_doc='$fecha_doc[0]'";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$docProveedoresRespuesta=new DocProveedoresEntidad();
		$docProveedoresRespuesta=$docProveedores;
		$docProveedoresRespuesta->setResultado($resultado);
		
		return $docProveedoresRespuesta;
	}
	
}

?>