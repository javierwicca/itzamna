<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/PagosEntidad.php';

use DAO\ConexionBD;
use Entidades\PagosEntidad;

class PagosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarPagos(PagosEntidad $pagos) {
		$pagosRespuesta=null;
		$consulta="select p.pag_consecutivo,p.pag_cliente,p.pag_proveedor,p.pag_banco,p.pag_cta_bancaria,p.pag_tipo_cuenta,p.pag_fecha,p.pag_no_documento,p.pag_vl_pago,p.".
		"pag_observaciones,p.pag_lugar,trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres_prov,trim(d1.dir_nombres||' '".
		"||case when d1.dir_apellidos is null then '' else d1.dir_apellidos end) as nombres_cli,p1.par_detalle as ds_banco,case p.pag_tipo_cuenta when 'A' then 'AHORROS' ".
		"when 'C' then 'CORRIENTE' end ds_tp_cta from iau_pagos p left outer join iau_parametros p1 on (p.pag_banco=p1.par_elemento and p1.par_parametro='BANCO'),".
		"iau_directorio d,iau_directorio d1 where p.pag_proveedor=d.dir_identificacion and p.pag_cliente=d1.dir_identificacion ".$pagos->getWhere();
		
		if ($pagos->getOrder()!='') $consulta.=" order by ".$pagos->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$pagosRespuesta=new PagosEntidad();
		$pagosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aPagos){
					$pagosRespuesta->setIdx($i);
					$pagosRespuesta->setConsecutivo($aPagos[pag_consecutivo]);
					$pagosRespuesta->setCliente($aPagos[pag_cliente]);
					$pagosRespuesta->setProveedor($aPagos[pag_proveedor]);
					$pagosRespuesta->setBanco($aPagos[pag_banco]);
					$pagosRespuesta->setCtaBancaria($aPagos[pag_cta_bancaria]);
					$pagosRespuesta->setTipoCuenta($aPagos[pag_tipo_cuenta]);
					$pagosRespuesta->setFecha($aPagos[pag_fecha]);
					$pagosRespuesta->setCtaBancaria($aPagos[pag_cta_bancaria]);
					$pagosRespuesta->setVlPago($aPagos[pag_vl_pago]);
					$pagosRespuesta->setObservaciones($aPagos[pag_observaciones]);
					$pagosRespuesta->setLugar($aPagos[pag_lugar]);
					$i++;
				}
			}
		}
		return $pagosRespuesta;
	}
	
	public function adicionarPagos(PagosEntidad $pagos) {
		$pagosRespuesta=null;
		
		$consulta="select max(pag_consecutivo) as consecutivo from iau_pagos";
		$resultado=$this->conexion->consulta($consulta);
		$consecutivo=0;
		
		if ($fila=pg_fetch_assoc($resultado)) $consecutivo=$fila[consecutivo];
		$consecutivo++;
		
		$pagos->setConsecutivo($consecutivo);
		
		$consecutivo=$pagos->getConsecutivo();
		$cliente=$pagos->getCliente();
		$proveedor=$pagos->getProveedor();
		$banco=$pagos->getBanco();
		$cta_bancaria=$pagos->getCtaBancaria();
		$tipo_cuenta=$pagos->getTipoCuenta();
		$fecha=$pagos->getFecha();
		$no_documento=$pagos->getNoDocumento();
		$vl_pago=$pagos->getVlPago();
		$observaciones=$pagos->getObservaciones();
		$lugar=$pagos->getLugar();
		
		$consulta="insert into iau_pagos (pag_consecutivo,pag_cliente,pag_proveedor,pag_banco,pag_cta_bancaria,pag_tipo_cuenta,pag_fecha,pag_no_documento,pag_vl_pago,".
		"pag_observaciones,pag_lugar) values ($consecutivo[0],";
		if ($cliente[0]!='') $consulta.="'$cliente[0]',";
		else $consulta.="null,";
		if ($proveedor[0]!='') $consulta.="'$proveedor[0]',";
		else $consulta.="null,";
		if ($banco[0]!='') $consulta.="'$banco[0]',";
		else $consulta.="null,";
		if ($cta_bancaria[0]!='') $consulta.="'$cta_bancaria[0]',";
		else $consulta.="null,";
		if ($tipo_cuenta[0]!='') $consulta.="'$tipo_cuenta[0]',";
		else $consulta.="null,";
		if ($fecha[0]!='') $consulta.="'$fecha[0]',";
		else $consulta.="null,";
		if ($no_documento[0]!='') $consulta.="'$no_documento[0]',";
		else $consulta.="null,";
		if ($vl_pago[0]!='') $consulta.="'$vl_pago[0]',";
		else $consulta.="null,";
		if ($observaciones[0]!='') $consulta.="'$observaciones[0]',";
		else $consulta.="null,";
		if ($lugar[0]!='') $consulta.="'$lugar[0]'";
		else $consulta.="null";
		$consulta.=")";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$pagosRespuesta=new PagosEntidad();
		$pagosRespuesta=$pagos;
		$pagosRespuesta->setResultado($resultado);
		
		return $pagosRespuesta;
	}
	
	public function modificarPagos(PagosEntidad $pagos) {
		$pagosRespuesta=null;
		
		$consecutivo=$pagos->getConsecutivo();
		$cliente=$pagos->getCliente();
		$proveedor=$pagos->getProveedor();
		$banco=$pagos->getBanco();
		$cta_bancaria=$pagos->getCtaBancaria();
		$tipo_cuenta=$pagos->getTipoCuenta();
		$fecha=$pagos->getFecha();
		$no_documento=$pagos->getNoDocumento();
		$vl_pago=$pagos->getVlPago();
		$observaciones=$pagos->getObservaciones();
		$lugar=$pagos->getLugar();
		
		$consulta="update iau_pagos set ";
		if ($cliente[0]!='') $consulta.="pag_cliente='$cliente[0]',";
		else $consulta.="pag_cliente=null,";
		if ($proveedor[0]!='') $consulta.="pag_proveedor='$proveedor[0]',";
		else $consulta.="pag_proveedor=null,";
		if ($banco[0]!='') $consulta.="pag_banco='$banco[0]',";
		else $consulta.="pag_banco=null,";
		if ($cta_bancaria[0]!='') $consulta.="pag_cta_bancaria='$cta_bancaria[0]',";
		else $consulta.="pag_cta_bancaria=null,";
		if ($tipo_cuenta[0]!='') $consulta.="pag_tipo_cuenta='$tipo_cuenta[0]',";
		else $consulta.="pag_tipo_cuenta=null,";
		if ($fecha[0]!='') $consulta.="pag_fecha='$fecha[0]',";
		else $consulta.="pag_fecha=null,";
		if ($no_documento[0]!='') $consulta.="pag_no_documento='$no_documento[0]',";
		else $consulta.="pag_no_documento=null,";
		if ($vl_pago[0]!='') $consulta.="pag_vl_pago='$vl_pago[0]',";
		else $consulta.="pag_vl_pago=null,";
		if ($observaciones[0]!='') $consulta.="pag_observaciones='$observaciones[0]',";
		else $consulta.="pag_observaciones=null,";
		if ($lugar[0]!='') $consulta.="pag_lugar='$lugar[0]'";
		else $consulta.="pag_lugar=null";
		$consulta.=" where pag_consecutivo=$consecutivo[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$pagosRespuesta=new PagosEntidad();
		$pagosRespuesta=$pagos;
		$pagosRespuesta->setResultado($resultado);
		
		return $pagosRespuesta;
	}
	
}

?>