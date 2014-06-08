<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/EncabezadoFormularioEntidad.php';

use DAO\ConexionBD;
use Entidades\EncabezadoFormularioEntidad;

class EncabezadoFormularioDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario) {
		$encabezadoFormularioRespuesta=null;
		$consulta="select ef.efo_consecutivo,ef.efo_impuesto,ef.efo_entidad,ef.efo_periodicidad,ef.efo_nombre,ef.efo_codigo from iau_encabezado_formulario ef where 1=1 ".
		$encabezadoFormulario->getWhere();
		
		if ($encabezadoFormulario->getOrder()!='') $consulta.=" order by ".$encabezadoFormulario->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$encabezadoFormularioRespuesta=new EncabezadoFormularioEntidad();
		$encabezadoFormularioRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aEncabezadoFormulario){
					$encabezadoFormularioRespuesta->setIdx($i);
					$encabezadoFormularioRespuesta->setConsecutivo($aEncabezadoFormulario[efo_consecutivo]);
					$encabezadoFormularioRespuesta->setImpuesto($aEncabezadoFormulario[efo_impuesto]);
					$encabezadoFormularioRespuesta->setEntidad($aEncabezadoFormulario[efo_entidad]);
					$encabezadoFormularioRespuesta->setPeriodicidad($aEncabezadoFormulario[efo_periodicidad]);
					$encabezadoFormularioRespuesta->setNombre($aEncabezadoFormulario[efo_nombre]);
					$encabezadoFormularioRespuesta->setCodigo($aEncabezadoFormulario[efo_codigo]);
					$i++;
				}
			}
		}
		return $encabezadoFormularioRespuesta;
	}
	
	public function adicionarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario) {
		$encabezadoFormularioRespuesta=null;
		
		$consulta="select max(efo_consecutivo) as consecutivo from iau_encabezado_formulario";
		$resultado=$this->conexion->consulta($consulta);
		$consecutivo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $consecutivo=$fila[consecutivo];
		$consecutivo++;
		
		$encabezadoFormulario->setConsecutivo($consecutivo);
		
		$consecutivo=$encabezadoFormulario->getConsecutivo();
		$impuesto=$encabezadoFormulario->getImpuesto();
		$entidad=$encabezadoFormulario->getEntidad();
		$periodicidad=$encabezadoFormulario->getPeriodicidad();
		$nombre=$encabezadoFormulario->getNombre();
		$codigo=$encabezadoFormulario->getCodigo();
		
		$consulta="insert into iau_encabezado_formulario (efo_consecutivo,efo_impuesto,efo_entidad,efo_periodicidad,efo_nombre,efo_codigo".
		") values ($consecutivo[0],";
		if ($impuesto[0]!='') $consulta.="'$impuesto[0]',";
		else $consulta.="null,";
		if ($entidad[0]!='') $consulta.="'$entidad[0]',";
		else $consulta.="null,";
		if ($periodicidad[0]!='') $consulta.="'$periodicidad[0]',";
		else $consulta.="null,";
		if ($nombre[0]!='') $consulta.="'$nombre[0]',";
		else $consulta.="null,";
		if ($codigo[0]!='') $consulta.="'$codigo[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$encabezadoFormularioRespuesta=new EncabezadoFormularioEntidad();
		$encabezadoFormularioRespuesta=$encabezadoFormulario;
		$encabezadoFormularioRespuesta->setResultado($resultado);
		
		return $encabezadoFormularioRespuesta;
	}
	
	public function modificarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario) {
		$encabezadoFormularioRespuesta=null;
		
		$consecutivo=$encabezadoFormulario->getConsecutivo();
		$impuesto=$encabezadoFormulario->getImpuesto();
		$entidad=$encabezadoFormulario->getEntidad();
		$periodicidad=$encabezadoFormulario->getPeriodicidad();
		$nombre=$encabezadoFormulario->getNombre();
		$codigo=$encabezadoFormulario->getCodigo();
		
		$consulta="update iau_encabezado_formulario set ";
		if ($impuesto[0]!='') $consulta.="efo_impuesto='$impuesto[0]',";
		else $consulta.="efo_impuesto=null,";
		if ($entidad[0]!='') $consulta.="efo_entidad='$entidad[0]',";
		else $consulta.="efo_entidad=null,";
		if ($periodicidad[0]!='') $consulta.="efo_periodicidad='$periodicidad[0]',";
		else $consulta.="efo_periodicidad=null,";
		if ($nombre[0]!='') $consulta.="efo_nombre='$nombre[0]',";
		else $consulta.="efo_nombre=null,";
		if ($codigo[0]!='') $consulta.="efo_codigo='$codigo[0]'";
		else $consulta.="efo_codigo=null";
		$consulta.=" where efo_consecutivo=$consecutivo[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$encabezadoFormularioRespuesta=new EncabezadoFormularioEntidad();
		$encabezadoFormularioRespuesta=$encabezadoFormulario;
		$encabezadoFormularioRespuesta->setResultado($resultado);
		
		return $encabezadoFormularioRespuesta;
	}
	
}

?>