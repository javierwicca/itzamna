<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';

use DAO\ConexionBD;
use Entidades\ModificadorTablasEntidad;

class ModificadorTablasDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarModificadorTablas(ModificadorTablasEntidad $modificadorTablas) {
		$modificadorTablasRespuesta=null;
		$consulta="select mt.mta_tabla,mt.mta_llave,mt.mta_consecutivo,mt.mta_usuario,mt.mta_fecha_hora,mt.mta_datos_anterior,mt.mta_datos_despues from ".
		"iau_modificador_tablas mt where 1=1 ".$modificadorTablas->getWhere();
		
		if ($modificadorTablas->getOrder()!='') $consulta.=" order by ".$modificadorTablas->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$modificadorTablasRespuesta=new ModificadorTablasEntidad();
		$modificadorTablasRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aModificadorTablasRespuesta){
					$modificadorTablasRespuesta->setIdx($i);
					$modificadorTablasRespuesta->setTabla($aModificadorTablasRespuesta[mta_tabla]);
					$modificadorTablasRespuesta->setLlave($aModificadorTablasRespuesta[mta_llave]);
					$modificadorTablasRespuesta->setConsecutivo($aModificadorTablasRespuesta[mta_consecutivo]);
					$modificadorTablasRespuesta->setUsuario($aModificadorTablasRespuesta[mta_usuario]);
					$modificadorTablasRespuesta->setFechaHora($aModificadorTablasRespuesta[mta_fecha_hora]);
					$modificadorTablasRespuesta->setDatosAnterior($aModificadorTablasRespuesta[mta_datos_anterior]);
					$modificadorTablasRespuesta->setDatosDespues($aModificadorTablasRespuesta[mta_datos_despues]);
					$i++;
				}
			}
		}
		return $modificadorTablasRespuesta;
	}
	
	public function ultUsuarioFechaHora(ModificadorTablasEntidad $modificadorTablas) {
		$modificadorTablasRespuesta=null;
		$consulta="select mt.mta_usuario as usuario,mt.mta_fecha_hora as fecha_hora from iau_modificador_tablas mt where mt.mta_consecutivo=(select max(mt1.mta_consecutivo)".
		" from iau_modificador_tablas mt1 where mt.mta_tabla=mt1.mta_tabla and mt.mta_llave=mt1.mta_llave) ".$modificadorTablas->getWhere();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$modificadorTablasRespuesta=new ModificadorTablasEntidad();
		$modificadorTablasRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aModificadorTablasRespuesta){
					$modificadorTablasRespuesta->setIdx($i);
					$modificadorTablasRespuesta->setUsuario($aModificadorTablasRespuesta[usuario]);
					$modificadorTablasRespuesta->setFechaHora($aModificadorTablasRespuesta[fecha_hora]);
					$i++;
				}
			}
		}
		return $modificadorTablasRespuesta;
	}
	
	public function adicionarModificadorTablas(ModificadorTablasEntidad $modificadorTablas) {
		$modificadorTablasRespuesta=null;
		
		$tabla=$modificadorTablas->getTabla();
		$llave=$modificadorTablas->getLlave();
		$usuario=$modificadorTablas->getUsuario();
		$fechaHora=$modificadorTablas->getFechaHora();
		$datosAnterior=$modificadorTablas->getDatosAnterior();
		$datosDespues=$modificadorTablas->getDatosDespues();
		
		for ($i=0;$i<count($tabla);$i++) {
			$consulta="select max(mt.mta_consecutivo) as consecutivo from iau_modificador_tablas mt where mt.mta_tabla='$tabla[$i]' and mt.mta_llave='$llave[$i]'";
			
			$resultado=$this->conexion->consulta($consulta);
			
			$codigo=0;
			
			if ($fila=pg_fetch_assoc($resultado)) $codigo=$fila[consecutivo];
			
			$codigo++;
			$modificadorTablas->setIdx($i);
			$modificadorTablas->setConsecutivo($codigo);
		}
		
		$consecutivo=$modificadorTablas->getConsecutivo();
		
		for ($i=0;$i<count($tabla);$i++) {
			$consulta="insert into iau_modificador_tablas (mta_tabla,mta_llave,mta_consecutivo,mta_usuario,mta_fecha_hora,mta_datos_anterior,mta_datos_despues) values ".
			"('$tabla[$i]','$llave[$i]',$consecutivo[$i],$usuario[$i],'$fechaHora[$i]','$datosAnterior[$i]','$datosDespues[$i]');";
			
			$resultado=$this->conexion->consulta($consulta);
		}
		
		$modificadorTablasRespuesta=new ModificadorTablasEntidad();
		$modificadorTablasRespuesta->setResultado($resultado);
		
		return $modificadorTablasRespuesta;
	}
	
}

?>