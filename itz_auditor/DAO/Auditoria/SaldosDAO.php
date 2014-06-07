<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/SaldosEntidad.php';

use DAO\ConexionBD;
use Entidades\SaldosEntidad;

class SaldosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarSaldos(SaldosEntidad $saldos) {
		$saldosRespuesta=null;
		$consulta="select s.sal_cliente,s.sal_anio_mes,s.sal_consecutivo,s.sal_cuenta_puc,s.sal_tercero,s.sal_segundo_tercero,s.sal_centro_costo,s.sal_saldo_anterior,s.".
		"sal_valor_debito,s.sal_valor_credito,trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres,s.sal_cuenta_puc||".
		"' - '|| case when (select cp.cup_nombre from iau_cuenta_puc cp where cp.cup_cliente=s.sal_cliente and cp.cup_codigo=s.sal_cuenta_puc) is null then '' else (select ".
		"cp.cup_nombre from iau_cuenta_puc cp where cp.cup_cliente=s.sal_cliente and cp.cup_codigo=s.sal_cuenta_puc) end as cuenta_puc,s.sal_fecha_hora_copia,s.sal_usuario,".
		"substr(s.sal_anio_mes,1,4) as anio,substr(s.sal_anio_mes,5,2) as mes from iau_saldos s,iau_directorio d where s.sal_cliente=d.dir_identificacion ".
		$saldos->getWhere();
		
		if ($saldos->getOrder()!='') $consulta.=" order by ".$saldos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$saldosRespuesta=new SaldosEntidad();
		$saldosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aSaldos){
					$saldosRespuesta->setIdx($i);
					$saldosRespuesta->setCliente($aSaldos[sal_cliente]);
					$saldosRespuesta->setAnioMes($aSaldos[sal_anio_mes]);
					$saldosRespuesta->setConsecutivo($aSaldos[sal_consecutivo]);
					$saldosRespuesta->setCuentaPuc($aSaldos[sal_cuenta_puc]);
					$saldosRespuesta->setTercero($aSaldos[sal_tercero]);
					$saldosRespuesta->setSegundoTercero($aSaldos[sal_segundo_tercero]);
					$saldosRespuesta->setCentroCosto($aSaldos[sal_centro_costo]);
					$saldosRespuesta->setSaldoInicial($aSaldos[sal_saldo_inicial]);
					$saldosRespuesta->setValorDebito($aSaldos[sal_valor_debito]);
					$saldosRespuesta->setValorCredito($aSaldos[sal_valor_credito]);
					$saldosRespuesta->setUsuarioEmpresa($aSaldos[sal_usuario_empresa]);
					$saldosRespuesta->setFechaEmpresa($aSaldos[sal_fecha_empresa]);
					$i++;
				}
			}
		}
		return $saldosRespuesta;
	}
	
	public function borrarSaldos(SaldosEntidad $saldos) {
		$saldosRespuesta=null;
		$consulta="delete from iau_saldos ".$saldos->getWhere();
		$resultado=$this->conexion->consulta($consulta);
		
		$saldosRespuesta=new SaldosEntidad();
		$saldosRespuesta->setResultado($resultado);
		
		return $saldosRespuesta;
	}
	
	public function insertarSaldosCop(SaldosEntidad $saldos) {
		$archivo=$saldos->getArchivo();
		
		$usuario=$saldos->getUsuario();
		$consulta.="insert into iau_saldos_cop (sal_cliente,sal_anio_mes,sal_consecutivo,sal_cuenta_puc,sal_tercero,sal_segundo_tercero,sal_centro_costo,sal_saldo_inicial,".
		"sal_valor_debito,sal_valor_credito,sal_fecha_hora_copia,sal_archivo,sal_usuario) select sal_cliente,sal_anio_mes,sal_consecutivo,sal_cuenta_puc,sal_tercero,".
		"sal_segundo_tercero,sal_centro_costo,sal_saldo_inicial,sal_valor_debito,sal_valor_credito,sal_fecha_hora_copia,'$archivo[0]',sal_usuario from iau_saldos ".
		$saldos->getWhere();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$saldosRespuesta=new SaldosEntidad();
		$saldosRespuesta->setResultado($resultado);
		
		return $saldosRespuesta;
	}
	
	public function insertarSaldos(SaldosEntidad $saldos) {
		$saldosRespuesta=null;
		
		$cliente=$saldos->getCliente();
		$anioMes=$saldos->getAnioMes();
		$consecutivo=$saldos->getConsecutivo();
		$cuentaPuc=$saldos->getCuentaPuc();
		$tercero=$saldos->getTercero();
		$segundoTercero=$saldos->getSegundoTercero();
		$centroCosto=$saldos->getcentroCosto();
		$saldoInicial=$saldos->getSaldoInicia();
		$valorDebito=$saldos->getValorDebito();
		$valorCredito=$saldos->getValorCredito();
		$usuario=$saldos->getUsuario();
		
		for ($i=0;$i<count($cliente);$i++) {
			$consulta.="insert into iau_saldos (sal_cliente,sal_fecha_saldos,sal_anio_mes,sal_consecutivo,sal_cuenta_puc,sal_tercero,sal_segundo_tercero,sal_centro_costo,".
			"sal_saldo_inicial,sal_valor_debito,sal_valor_credito,sal_fecha_hora_copia,sal_usuario) values ($cliente[$i],";
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
			if ($saldoInicial[$i]!='') $consulta.="$saldoInicial[$i],";
			else $consulta.="null,";
			if ($valorDebito[$i]!='') $consulta.="$valorDebito[$i],";
			else $consulta.="null,";
			if ($valorCredito[$i]!='') $consulta.="$valorCredito[$i],";
			else $consulta.="null,";
			$consulta.="current_timestamp,$usuario[0]);";
		}
		
		$resultado=$this->conexion->consulta($consulta);
		
		$saldosRespuesta=new SaldosEntidad();
		$saldosRespuesta=$saldos;
		$saldosRespuesta->setResultado($resultado);
		
		return $saldosRespuesta;
	}
	
}

?>