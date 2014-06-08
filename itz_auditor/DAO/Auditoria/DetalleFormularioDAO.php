<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/DetalleFormularioEntidad.php';

use DAO\ConexionBD;
use Entidades\DetalleFormularioEntidad;

class DetalleFormularioDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarDetalleFormulario(DetalleFormularioEntidad $detalleFormulario) {
		$detalleFormularioRespuesta=null;
		$consulta="select df.dfo_formulario,df.dfo_consecutivo,df.dfo_detalle,df.dfo_tipo,df.dfo_no_renglon,df.dfo_renglon_relacion,df.dfo_simbolo,df.dfo_renglon_inicial,".
		"df.dfo_renglon_final from iau_detalle_formulario df where 1=1 ".
		$detalleFormulario->getWhere();
		
		if ($detalleFormulario->getOrder()!='') $consulta.=" order by ".$detalleFormulario->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$detalleFormularioRespuesta=new DetalleFormularioEntidad();
		$detalleFormularioRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aDetalleFormulario){
					$detalleFormularioRespuesta->setIdx($i);
					$detalleFormularioRespuesta->setFormulario($aDetalleFormulario[dfo_formulario]);
					$detalleFormularioRespuesta->setConsecutivo($aDetalleFormulario[dfo_consecutivo]);
					$detalleFormularioRespuesta->setDetalle($aDetalleFormulario[dfo_detalle]);
					$detalleFormularioRespuesta->setTipo($aDetalleFormulario[dfo_tipo]);
					$detalleFormularioRespuesta->setNoRenglon($aDetalleFormulario[dfo_no_renglon]);
					$detalleFormularioRespuesta->setRenglonRelacion($aDetalleFormulario[dfo_renglon_relacion]);
					$detalleFormularioRespuesta->setSimbolo($aDetalleFormulario[dfo_simbolo]);
					$detalleFormularioRespuesta->setRenglonInicial($aDetalleFormulario[dfo_renglon_inicial]);
					$detalleFormularioRespuesta->setRenglonFinal($aDetalleFormulario[dfo_renglon_final]);
					$i++;
				}
			}
		}
		return $detalleFormularioRespuesta;
	}
}

?>