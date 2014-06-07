<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/LugaresEntidad.php';

use DAO\ConexionBD;
use Entidades\LugaresEntidad;

class LugaresDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarLugares(LugaresEntidad $lugares) {
		$lugaresRespuesta=null;
		$consulta="select l.lug_codigo,l.lug_nombre,l.lug_tipo from iau_lugares l where 1=1 ".$lugares->getWhere();
		
		if ($lugares->getOrder()!='') $consulta.=" order by ".$lugares->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$lugaresRespuesta=new LugaresEntidad();
		$lugaresRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aLugares){
					$lugaresRespuesta->setIdx($i);
					$lugaresRespuesta->setCodigo($aLugares[lug_codigo]);
					$lugaresRespuesta->setNombre($aLugares[lug_nombre]);
					$lugaresRespuesta->setTipo($aLugares[lug_tipo]);
					$i++;
				}
			}
		}
		return $lugaresRespuesta;
	}
	
	public function adicionarLugares(LugaresEntidad $lugares) {
		$lugaresRespuesta=null;
		
		/*
		$consulta="insert into iau_lugares (ciu_codigo,ciu_lugar,ciu_detalle,ciu_tarifa) values ($identificacion[0],";
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
		$lugaresRespuesta=new LugaresEntidad();
		$lugaresRespuesta=$lugares;
		$lugaresRespuesta->setResultado($resultado);
		
		return $lugaresRespuesta;
	}
	
	public function modificarLugares(LugaresEntidad $lugares) {
		$lugaresRespuesta=null;
		/*
		$identificacion=$lugares->getIdentificacion();
		$tipo_documento=$lugares->getTipoDocumento();
		$lugar_documento=$lugares->getLugarDocumento();
		$digito_v=$lugares->getDigitoV();
		$tipo_persona=$lugares->getTipoPersona();
		$apellidos=$lugares->getApellidos();
		$nombres=$lugares->getNombres();
		$direccion=$lugares->getDireccion();
		$telefono=$lugares->getTelefono();
		$correo=$lugares->getCorreo();
		$ciudad_direccion=$lugares->getCiudadDireccion();
		$barrio=$lugares->getBarrio();
		$fecha_nac=$lugares->getFechaNac();
		$lugar_nac=$lugares->getLugarNac();
		$estado=$lugares->getEstado();
		
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
		$lugaresRespuesta=new LugaresEntidad();
		$lugaresRespuesta=$lugares;
		$lugaresRespuesta->setResultado($resultado);
		
		return $lugaresRespuesta;
	}
	
}

?>