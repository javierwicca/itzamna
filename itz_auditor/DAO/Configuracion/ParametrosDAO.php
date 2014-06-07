<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/ParametrosEntidad.php';

use DAO\ConexionBD;
use Entidades\ParametrosEntidad;

class ParametrosDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarParametros(ParametrosEntidad $parametros) {
		$parametrosRespuesta=null;
		$consulta="select max(array_upper(p.par_caracter,1)) as dim_car,max(array_upper(p.par_entero,1)) as dim_ent,max(array_upper(p.par_decimal,1)) as dim_dec from ".
		"iau_parametros p where 1=1 ".$parametros->getWhere();
		
		$resultado=$this->conexion->consulta($consulta);
		if ($fila=pg_fetch_assoc($resultado)) {
			$dim_car=$fila[dim_car];
			$dim_ent=$fila[dim_ent];
			$dim_dec=$fila[dim_dec];
		}
		
		$consulta="select p.par_parametro,p.par_elemento,p.par_detalle,p.par_caracter,p.par_entero,p.par_decimal";
				
		if ($dim_car!='') for ($i=0;$i<=$dim_car;$i++) $consulta.=",p.par_caracter[$i] as par_caracter_$i";
		if ($dim_ent!='') for ($i=0;$i<=$dim_ent;$i++) $consulta.=",p.par_entero[$i] as par_entero_$i";
		if ($dim_dec!='') for ($i=0;$i<=$dim_dec;$i++) $consulta.=",p.par_decimal[$i] as par_decimal_$i";
		
		$consulta.=" from iau_parametros p where 1=1 ".$parametros->getWhere();
		
		if ($parametros->getOrder()!='') $consulta.=" order by ".$parametros->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$parametrosRespuesta=new ParametrosEntidad();
		$parametrosRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aParametros){
					$parametrosRespuesta->setIdx($i);
					$parametrosRespuesta->setParametro($aParametros[par_parametro]);
					$parametrosRespuesta->setElemento($aParametros[par_elemento]);
					$parametrosRespuesta->setDetalle($aParametros[par_detalle]);
					$parametrosRespuesta->setCaracter($aParametros[par_caracter]);
					$parametrosRespuesta->setEntero($aParametros[par_entero]);
					$parametrosRespuesta->setDecimal($aParametros[par_decimal]);
					$i++;
				}
			}
		}
		return $parametrosRespuesta;
	}
	
	public function adicionarParametros(ParametrosEntidad $parametros) {
		$parametrosRespuesta=null;
		
		/*
		$consulta="insert into iau_parametros (ciu_codigo,ciu_lugar,ciu_detalle,ciu_tarifa) values ($identificacion[0],";
		if ($lugar_documento[0]!='') $consulta.="'$lugar_documento[0]',";
		else $consulta.="null,";
		if ($digito_v[0]!='') $consulta.="'$digito_v[0]',";
		else $consulta.="null,";
		if ($tipo_persona[0]!='') $consulta.="'$tipo_persona[0]',";
		else $consulta.="null,";
		if ($apellidos[0]!='') $consulta.="'$apellidos[0]',";
		else $consulta.="null,";
		if ($nombres[0]!='') $consulta.="'$nombres[0]',";
		else $consulta.="null,";
		if ($direccion[0]!='') $consulta.="'$direccion[0]',";
		else $consulta.="null,";
		if ($telefono[0]!='') $consulta.="'$telefono[0]',";
		else $consulta.="null,";
		if ($correo[0]!='') $consulta.="'$correo[0]',";
		else $consulta.="null,";
		if ($ciudad_direccion[0]!='') $consulta.="'$ciudad_direccion[0]',";
		else $consulta.="null,";
		if ($barrio[0]!='') $consulta.="'$barrio[0]',";
		else $consulta.="null,";
		if ($fecha_nac[0]!='') $consulta.="'$fecha_nac[0]',";
		else $consulta.="null,";
		if ($lugar_nac[0]!='') $consulta.="'$lugar_nac[0]',";
		else $consulta.="null,";
		$consulta.="'$estado[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		*/
		$parametrosRespuesta=new ParametrosEntidad();
		$parametrosRespuesta=$parametros;
		$parametrosRespuesta->setResultado($resultado);
		
		return $parametrosRespuesta;
	}
	
	public function modificarParametros(ParametrosEntidad $parametros) {
		$parametrosRespuesta=null;
		/*
		$identificacion=$parametros->getIdentificacion();
		$tipo_documento=$parametros->getTipoDocumento();
		$lugar_documento=$parametros->getLugarDocumento();
		$digito_v=$parametros->getDigitoV();
		$tipo_persona=$parametros->getTipoPersona();
		$apellidos=$parametros->getApellidos();
		$nombres=$parametros->getNombres();
		$direccion=$parametros->getDireccion();
		$telefono=$parametros->getTelefono();
		$correo=$parametros->getCorreo();
		$ciudad_direccion=$parametros->getCiudadDireccion();
		$barrio=$parametros->getBarrio();
		$fecha_nac=$parametros->getFechaNac();
		$lugar_nac=$parametros->getLugarNac();
		$estado=$parametros->getEstado();
		
		$consulta="update iau_directorio set dir_tipo_documento='$tipo_documento[0]',";
		if ($lugar_documento[0]!='') $consulta.="dir_lugar_documento='$lugar_documento[0]',";
		else $consulta.="dir_lugar_documento=null,";
		if ($digito_v[0]!='') $consulta.="dir_digito_v='$digito_v[0]',";
		else $consulta.="dir_digito_v=null,";
		if ($tipo_persona[0]!='') $consulta.="dir_tipo_persona='$tipo_persona[0]',";
		else $consulta.="dir_tipo_persona=null,";
		if ($apellidos[0]!='') $consulta.="dir_apellidos='$apellidos[0]',";
		else $consulta.="dir_apellidos=null,";
		if ($nombres[0]!='') $consulta.="dir_nombres='$nombres[0]',";
		else $consulta.="dir_nombres=null,";
		if ($direccion[0]!='') $consulta.="dir_direccion='$direccion[0]',";
		else $consulta.="dir_direccion=null,";
		if ($telefono[0]!='') $consulta.="dir_telefono='$telefono[0]',";
		else $consulta.="dir_telefono=null,";
		if ($correo[0]!='') $consulta.="dir_correo='$correo[0]',";
		else $consulta.="dir_correo=null,";
		if ($ciudad_direccion[0]!='') $consulta.="dir_ciudad_direccion='$ciudad_direccion[0]',";
		else $consulta.="dir_ciudad_direccion0null,";
		if ($barrio[0]!='') $consulta.="dir_barrio='$barrio[0]',";
		else $consulta.="dir_barrio=null,";
		if ($fecha_nac[0]!='') $consulta.="dir_fecha_nac='$fecha_nac[0]',";
		else $consulta.="dir_fecha_nac=null,";
		if ($lugar_nac[0]!='') $consulta.="dir_lugar_nac='$lugar_nac[0]',";
		else $consulta.="dir_lugar_nac=null,";
		$consulta.="dir_estado='$estado[0]' where dir_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		*/
		$parametrosRespuesta=new ParametrosEntidad();
		$parametrosRespuesta=$parametros;
		$parametrosRespuesta->setResultado($resultado);
		
		return $parametrosRespuesta;
	}
	
}

?>