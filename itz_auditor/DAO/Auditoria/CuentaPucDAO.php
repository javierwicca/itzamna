<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';

use DAO\ConexionBD;
use Entidades\CuentaPucEntidad;

class CuentaPucDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarCuentaPuc(CuentaPucEntidad $cuentaPuc) {
		$cuentaPucRespuesta=null;
		$consulta="select cp.cup_cliente,cp.cup_codigo,cp.cup_nombre,cp.cup_ecuacion_patrimonial,cp.cup_nivel_detalle,cp.cup_naturaleza,trim(d.dir_nombres||' '||case when ".
		"d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres,case cp.cup_ecuacion_patrimonial when 'AC' then 'Activo' when 'PA' then 'Pasivo' when 'CA' ".
		"then 'Capital o patrimonio' when 'IN' then 'Ingreso' when 'EG' then 'EGRESO' when 'OD' then 'Cuentas de orden deudoras' when 'OA' then 'Cuentas de orden acreedoras'".
		" end as ecuacion_patrimonial,case cp.cup_naturaleza when 'D' then 'débito' when 'C' then 'crédito' end as naturaleza from iau_cuenta_puc cp,iau_directorio d where ".
		"cp.cup_cliente=d.dir_identificacion ".$cuentaPuc->getWhere();
		
		if ($cuentaPuc->getOrder()!='') $consulta.=" order by ".$cuentaPuc->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$cuentaPucRespuesta=new CuentaPucEntidad();
		$cuentaPucRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aCuentaPuc){
					$cuentaPucRespuesta->setIdx($i);
					$cuentaPucRespuesta->setCliente($aCuentaPuc[cup_cliente]);
					$cuentaPucRespuesta->setCodigo($aCuentaPuc[cup_codigo]);
					$cuentaPucRespuesta->setNombre($aCuentaPuc[cup_nombre]);
					$cuentaPucRespuesta->setEcuacionPatrimonial($aCuentaPuc[cup_ecuacion_patrimonial]);
					$cuentaPucRespuesta->setNivelDetalle($aCuentaPuc[cup_nivel_detalle]);
					$cuentaPucRespuesta->setNaturaleza($aCuentaPuc[cup_naturaleza]);
					$i++;
				}
			}
		}
		return $cuentaPucRespuesta;
	}
	
	public function modificarCuentaPuc(CuentaPucEntidad $cuentaPuc) {
		$cuentaPucRespuesta=null;
		
		$cliente=$cuentaPuc->getCliente();
		$accion=$cuentaPuc->getAccion();
		$codigo=$cuentaPuc->getCodigo();
		$nombre=$cuentaPuc->getNombre();
		$ecuacion_patrimonial=$cuentaPuc->getEcuacionPatrimonial();
		$nivel_detalle=$cuentaPuc->getNivelDetalle();
		$naturaleza=$cuentaPuc->getNaturaleza();
		for ($i=0;$i<count($cliente);$i++) {
			if ($accion[$i]=='A') {
				$consulta.="insert into iau_cuenta_puc (cup_cliente,cup_codigo,cup_nombre,cup_ecuacion_patrimonial,cup_nivel_detalle,cup_naturaleza) values ($cliente[$i],".
				"'$codigo[$i]',";
				if ($nombre[$i]!='') $consulta.="'$nombre[$i]',";
				else $consulta.="null,";
				if ($ecuacion_patrimonial[$i]!='') $consulta.="'$ecuacion_patrimonial[$i]',";
				else $consulta.="null,";
				if ($nivel_detalle[$i]!='') $consulta.="$nivel_detalle[$i],";
				else $consulta.="null,";
				if ($naturaleza[$i]!='') $consulta.="'$naturaleza[$i]'";
				else $consulta.="null";
				$consulta.=");";
			} else {
				$consulta.="update iau_cuenta_puc set ";
				if ($nombre[$i]!='') $consulta.="cup_nombre='$nombre[$i]',";
				else $consulta.="cup_nombre=null,";
				if ($ecuacion_patrimonial[$i]!='') $consulta.="cup_ecuacion_patrimonial='$ecuacion_patrimonial[$i]',";
				else $consulta.="cup_ecuacion_patrimonial=null,";
				if ($nivel_detalle[$i]!='') $consulta.="cup_nivel_detalle=$nivel_detalle[$i],";
				else $consulta.="cup_nivel_detalle=null,";
				if ($naturaleza[$i]!='') $consulta.="cup_naturaleza='$naturaleza[$i]'";
				else $consulta.="cup_naturaleza=null";
				$consulta.=" where cup_cliente=$cliente[$i] and cup_codigo='$codigo[$i]';";
			}
		}
		
		$resultado=$this->conexion->consulta($consulta);
		
		$cuentaPucRespuesta=new CuentaPucEntidad();
		$cuentaPucRespuesta=$cuentaPuc;
		$cuentaPucRespuesta->setResultado($resultado);
		
		return $cuentaPucRespuesta;
	}
	
}

?>