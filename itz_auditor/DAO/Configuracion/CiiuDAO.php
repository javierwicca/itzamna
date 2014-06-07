<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/CiiuEntidad.php';

use DAO\ConexionBD;
use Entidades\CiiuEntidad;

class CiiuDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarCiiu(CiiuEntidad $ciiu) {
		$ciiuRespuesta=null;
		$consulta="select c.ciu_codigo,c.ciu_lugar,c.ciu_detalle,c.ciu_tarifa,c.ciu_version from iau_ciiu c where 1=1 ".$ciiu->getWhere();
		
		if ($ciiu->getOrder()!='') $consulta.=" order by ".$ciiu->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$ciiuRespuesta=new CiiuEntidad();
		$ciiuRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aCiiu){
					$ciiuRespuesta->setIdx($i);
					$ciiuRespuesta->setCodigo($aCiiu[ciu_codigo]);
					$ciiuRespuesta->setLugar($aCiiu[ciu_lugar]);
					$ciiuRespuesta->setDetalle($aCiiu[ciu_detalle]);
					$ciiuRespuesta->setTarifa($aCiiu[ciu_tarifa]);
					$ciiuRespuesta->setVersion($aCiiu[ciu_version]);
					$i++;
				}
			}
		}
		return $ciiuRespuesta;
	}
	
	public function adicionarCiiu(CiiuEntidad $ciiu) {
		$ciiuRespuesta=null;
		
		/*
		$consulta="insert into iau_ciiu (ciu_codigo,ciu_lugar,ciu_detalle,ciu_tarifa) values ($identificacion[0],";
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
		$ciiuRespuesta=new CiiuEntidad();
		$ciiuRespuesta=$ciiu;
		$ciiuRespuesta->setResultado($resultado);
		
		return $ciiuRespuesta;
	}
	
	public function modificarCiiu(CiiuEntidad $ciiu) {
		$ciiuRespuesta=null;
		/*
		$identificacion=$ciiu->getIdentificacion();
		$tipo_documento=$ciiu->getTipoDocumento();
		$lugar_documento=$ciiu->getLugarDocumento();
		$digito_v=$ciiu->getDigitoV();
		$tipo_persona=$ciiu->getTipoPersona();
		$apellidos=$ciiu->getApellidos();
		$nombres=$ciiu->getNombres();
		$direccion=$ciiu->getDireccion();
		$telefono=$ciiu->getTelefono();
		$correo=$ciiu->getCorreo();
		$ciudad_direccion=$ciiu->getCiudadDireccion();
		$barrio=$ciiu->getBarrio();
		$fecha_nac=$ciiu->getFechaNac();
		$lugar_nac=$ciiu->getLugarNac();
		$estado=$ciiu->getEstado();
		
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
		$ciiuRespuesta=new CiiuEntidad();
		$ciiuRespuesta=$ciiu;
		$ciiuRespuesta->setResultado($resultado);
		
		return $ciiuRespuesta;
	}
	
}

?>