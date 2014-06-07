<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/MovimientoEntidad.php';

use DAO\ConexionBD;
use Entidades\MovimientoEntidad;

class MovimientoDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarMovimiento(MovimientoEntidad $movimiento) {
		$movimientoRespuesta=null;
		$consulta="select m.mov_cliente,m.mov_numero_comprobante,m.mov_codigo_comprobante,m.mov_nombre_comprobante,m.mov_fecha_movimiento,m.mov_anio_mes,m.mov_consecutivo,".
		"m.mov_cuenta_puc,m.mov_tercero,m.mov_segundo_tercero,m.mov_centro_costo,m.mov_detalle,m.mov_naturaleza,m.mov_valor,m.mov_estado,m.mov_usuario_empresa,m.".
		"mov_fecha_empresa,trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres,case m.mov_naturaleza when 'D' then ".
		"'débito' when 'C' then 'crédito' end as debito_credito,case m.mov_estado when 'C' then 'correcto' when 'A' then 'anulado' end as estado,m.mov_cuenta_puc||' - '|| ".
		"case when (select cp.cup_nombre from iau_cuenta_puc cp where cp.cup_cliente=m.mov_cliente and cp.cup_codigo=m.mov_cuenta_puc) is null then '' else (select cp.".
		"cup_nombre from iau_cuenta_puc cp where cp.cup_cliente=m.mov_cliente and cp.cup_codigo=m.mov_cuenta_puc) end as cuenta_puc,m.mov_codigo_comprobante||case when m.".
		"mov_nombre_comprobante is null then '' else '-'||m.mov_nombre_comprobante end as nm_comprobante,m.mov_fecha_hora_copia,m.mov_usuario from iau_movimiento m,".
		"iau_directorio d where m.mov_cliente=d.dir_identificacion ".$movimiento->getWhere();
		
		if ($movimiento->getOrder()!='') $consulta.=" order by ".$movimiento->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$movimientoRespuesta=new MovimientoEntidad();
		$movimientoRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aMovimiento){
					$movimientoRespuesta->setIdx($i);
					$movimientoRespuesta->setCliente($aMovimiento[mov_cliente]);
					$movimientoRespuesta->setNumeroComprobante($aMovimiento[mov_numero_comprobante]);
					$movimientoRespuesta->setCodigoComprobante($aMovimiento[mov_codigo_comprobante]);
					$movimientoRespuesta->setNombreComprobante($aMovimiento[mov_nombre_comprobante]);
					$movimientoRespuesta->setFechaMovimiento($aMovimiento[mov_fecha_movimiento]);
					$movimientoRespuesta->setAnioMes($aMovimiento[mov_anio_mes]);
					$movimientoRespuesta->setConsecutivo($aMovimiento[mov_consecutivo]);
					$movimientoRespuesta->setCuentaPuc($aMovimiento[mov_cuenta_puc]);
					$movimientoRespuesta->setTercero($aMovimiento[mov_tercero]);
					$movimientoRespuesta->setSegundoTercero($aMovimiento[mov_segundo_tercero]);
					$movimientoRespuesta->setCentroCosto($aMovimiento[mov_centro_costo]);
					$movimientoRespuesta->setDetalle($aMovimiento[mov_detalle]);
					$movimientoRespuesta->setNaturaleza($aMovimiento[mov_naturaleza]);
					$movimientoRespuesta->setValor($aMovimiento[mov_valor]);
					$movimientoRespuesta->setEstado($aMovimiento[mov_estado]);
					$movimientoRespuesta->setUsuarioEmpresa($aMovimiento[mov_usuario_empresa]);
					$movimientoRespuesta->setFechaEmpresa($aMovimiento[mov_fecha_empresa]);
					$movimientoRespuesta->setFechaHoraCopia($aMovimiento[mov_fecha_hora_copia]);
					$movimientoRespuesta->setUsuario($aMovimiento[mov_usuario]);
					$i++;
				}
			}
		}
		return $movimientoRespuesta;
	}
	
	public function comboMovimiento(MovimientoEntidad $movimiento) {
		$movimientoRespuesta=null;
		$consulta="select distinct m.mov_codigo_comprobante||case when m.mov_nombre_comprobante is null then '' else '-'||m.mov_nombre_comprobante end as nm_comprobante from".
		" iau_movimiento m,iau_directorio d where m.mov_cliente=d.dir_identificacion ".$movimiento->getWhere();
		
		if ($movimiento->getOrder()!='') $consulta.=" order by ".$movimiento->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$movimientoRespuesta=new MovimientoEntidad();
		$movimientoRespuesta->setResultado($resultado);
		
		return $movimientoRespuesta;
	}
	
	public function borrarMovimiento(MovimientoEntidad $movimiento) {
		$movimientoRespuesta=null;
		$consulta="delete from iau_movimiento ".$movimiento->getWhere();
		$resultado=$this->conexion->consulta($consulta);
		
		$movimientoRespuesta=new MovimientoEntidad();
		$movimientoRespuesta->setResultado($resultado);
		
		return $movimientoRespuesta;
	}
	
	public function insertarMovimientoCop(MovimientoEntidad $movimiento) {
		$archivo=$movimiento->getArchivo();
		
		$usuario=$movimiento->getUsuario();
		$consulta.="insert into iau_movimiento_cop (mov_cliente,mov_numero_comprobante,mov_codigo_comprobante,mov_nombre_comprobante,mov_fecha_movimiento,mov_anio_mes,".
		"mov_consecutivo,mov_cuenta_puc,mov_tercero,mov_segundo_tercero,mov_centro_costo,mov_detalle,mov_naturaleza,mov_valor,mov_estado,mov_usuario_empresa,".
		"mov_fecha_empresa,mov_fecha_hora_copia,mov_archivo,mov_usuario) select mov_cliente,mov_numero_comprobante,mov_codigo_comprobante,mov_nombre_comprobante,".
		"mov_fecha_movimiento,mov_anio_mes,mov_consecutivo,mov_cuenta_puc,mov_tercero,mov_segundo_tercero,mov_centro_costo,mov_detalle,mov_naturaleza,mov_valor,mov_estado,".
		"mov_usuario_empresa,mov_fecha_empresa,mov_fecha_hora_copia,'$archivo[0]',mov_usuario from iau_movimiento ".$movimiento->getWhere();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$movimientoRespuesta=new MovimientoEntidad();
		$movimientoRespuesta->setResultado($resultado);
		
		return $movimientoRespuesta;
	}
	
	public function insertarMovimiento(MovimientoEntidad $movimiento) {
		$movimientoRespuesta=null;
		
		$cliente=$movimiento->getCliente();
		$numeroDocumento=$movimiento->getNumeroComprobante();
		$codigoDocumento=$movimiento->getCodigoComprobante();
		$nombreDocumento=$movimiento->getNombreComprobante();
		$fechaMovimiento=$movimiento->getFechaMovimiento();
		$anioMes=$movimiento->getAnioMes();
		$consecutivo=$movimiento->getConsecutivo();
		$cuentaPuc=$movimiento->getCuentaPuc();
		$tercero=$movimiento->getTercero();
		$segundoTercero=$movimiento->getSegundoTercero();
		$centroCosto=$movimiento->getcentroCosto();
		$detalle=$movimiento->getDetalle();
		$naturaleza=$movimiento->getNaturaleza();
		$valor=$movimiento->getValor();
		$estado=$movimiento->getEstado();
		$usuarioEmpresa=$movimiento->getUsuarioEmpresa();
		$fechaEmpresa=$movimiento->getFechaEmpresa();
		$usuario=$movimiento->getUsuario();
		
		for ($i=0;$i<count($cliente);$i++) {
			$consulta.="insert into iau_movimiento (mov_cliente,mov_numero_comprobante,mov_codigo_comprobante,mov_nombre_comprobante,mov_fecha_movimiento,mov_anio_mes,".
			"mov_consecutivo,mov_cuenta_puc,mov_tercero,mov_segundo_tercero,mov_centro_costo,mov_detalle,mov_naturaleza,mov_valor,mov_estado,mov_usuario_empresa,".
			"mov_fecha_empresa,mov_fecha_hora_copia,mov_usuario) values ($cliente[$i],";
			if ($numeroDocumento[$i]!='') $consulta.="$numeroDocumento[$i],";
			else $consulta.="null,";
			if ($codigoDocumento[$i]!='') $consulta.="'$codigoDocumento[$i]',";
			else $consulta.="null,";
			if ($nombreDocumento[$i]!='') $consulta.="'$nombreDocumento[$i]',";
			else $consulta.="null,";
			if ($fechaMovimiento[$i]!='') $consulta.="'$fechaMovimiento[$i]',";
			else $consulta.="null,";
			if ($anioMes[$i]!='') $consulta.="'$anioMes[$i]',";
			else $consulta.="null,";
			if ($consecutivo[$i]!='') $consulta.="$consecutivo[$i],";
			else $consulta.="null,";
			if ($cuentaPuc[$i]!='') $consulta.="'$cuentaPuc[$i]',";
			else $consulta.="null,";
			if ($tercero[$i]!='') $consulta.="'$tercero[$i]',";
			else $consulta.="null,";
			if ($segundoTercero[$i]!='') $consulta.="'$segundoTercero[$i]',";
			else $consulta.="null,";
			if ($centroCosto[$i]!='') $consulta.="'$centroCosto[$i]',";
			else $consulta.="null,";
			if ($detalle[$i]!='') $consulta.="'$detalle[$i]',";
			else $consulta.="null,";
			if ($naturaleza[$i]!='') $consulta.="'$naturaleza[$i]',";
			else $consulta.="null,";
			if ($valor[$i]!='') $consulta.="$valor[$i],";
			else $consulta.="null,";
			if ($estado[$i]!='') $consulta.="'$estado[$i]',";
			else $consulta.="null,";
			if ($usuarioEmpresa[$i]!='') $consulta.="'$usuarioEmpresa[$i]',";
			else $consulta.="null,";
			if ($fechaEmpresa[$i]!='') $consulta.="'$fechaEmpresa[$i]',";
			else $consulta.="null,";
			$consulta.="current_timestamp,$usuario[0]);";
		}
		
		$resultado=$this->conexion->consulta($consulta);
		
		$movimientoRespuesta=new MovimientoEntidad();
		$movimientoRespuesta=$movimiento;
		$movimientoRespuesta->setResultado($resultado);
		
		return $movimientoRespuesta;
	}
	
}

?>