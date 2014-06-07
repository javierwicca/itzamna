<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/DirectorioEntidad.php';

use DAO\ConexionBD;
use Entidades\DirectorioEntidad;

class DirectorioDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarDirectorio(DirectorioEntidad $directorio) {
		$directorioRespuesta=null;
		$consulta="select d.dir_identificacion,d.dir_tipo_documento,d.dir_lugar_documento,d.dir_digito_v,d.dir_tipo_persona,d.dir_apellidos,d.dir_nombres,d.dir_direccion,d.".
		"dir_telefono,d.dir_correo,d.dir_ciudad_direccion,d.dir_barrio,d.dir_fecha_nac,d.dir_lugar_nac,d.dir_estado,d.dir_direccion[0] as dir_residencia,d.dir_direccion[1] ".
		"as dir_correspondencia,d.dir_direccion[2] as dir_contacto,d.dir_telefono[0] as celular,d.dir_telefono[1] as tel_fijo,d.dir_telefono[2] as fax,d.dir_telefono[3] as ".
		"otr_tel,d.dir_ciudad_direccion[0] as ciudad_residencia,d.dir_ciudad_direccion[1] as ciudad_correspondencia,d.dir_ciudad_direccion[2] as ciudad_contacto,trim(d.".
		"dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres from iau_directorio d where 1=1 ".$directorio->getWhere();
		
		if ($directorio->getOrder()!='') $consulta.=" order by ".$directorio->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$directorioRespuesta=new DirectorioEntidad();
		$directorioRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aDirectorio){
					$directorioRespuesta->setIdx($i);
					$directorioRespuesta->setIdentificacion($aDirectorio[dir_identificacion]);
					$directorioRespuesta->setTipoDocumento($aDirectorio[dir_tipo_documento]);
					$directorioRespuesta->setLugarDocumento($aDirectorio[dir_lugar_documento]);
					$directorioRespuesta->setDigitoV($aDirectorio[dir_digito_v]);
					$directorioRespuesta->setTipoPersona($aDirectorio[dir_tipo_persona]);
					$directorioRespuesta->setApellidos($aDirectorio[dir_apellidos]);
					$directorioRespuesta->setNombres($aDirectorio[dir_nombres]);
					$directorioRespuesta->setDireccion($aDirectorio[dir_direccion]);
					$directorioRespuesta->setTelefono($aDirectorio[dir_telefono]);
					$directorioRespuesta->setCorreo($aDirectorio[dir_correo]);
					$directorioRespuesta->setCiudadDireccion($aDirectorio[dir_ciudad_direccion]);
					$directorioRespuesta->setBarrio($aDirectorio[dir_barrio]);
					$directorioRespuesta->setFechaNac($aDirectorio[dir_fecha_nac]);
					$directorioRespuesta->setLugarNac($aDirectorio[dir_lugar_nac]);
					$directorioRespuesta->setEstado($aDirectorio[cli_estado]);
					$i++;
				}
			}
		}
		return $directorioRespuesta;
	}
	
	public function adicionarDirectorio(DirectorioEntidad $directorio) {
		$directorioRespuesta=null;
		
		$identificacion=$directorio->getIdentificacion();
		$tipo_documento=$directorio->getTipoDocumento();
		$lugar_documento=$directorio->getLugarDocumento();
		$digito_v=$directorio->getDigitoV();
		$tipo_persona=$directorio->getTipoPersona();
		$apellidos=$directorio->getApellidos();
		$nombres=$directorio->getNombres();
		$direccion=$directorio->getDireccion();
		$telefono=$directorio->getTelefono();
		$correo=$directorio->getCorreo();
		$ciudad_direccion=$directorio->getCiudadDireccion();
		$barrio=$directorio->getBarrio();
		$fecha_nac=$directorio->getFechaNac();
		$lugar_nac=$directorio->getLugarNac();
		$estado=$directorio->getEstado();
		
		$consulta="insert into iau_directorio (dir_identificacion,dir_tipo_documento,dir_lugar_documento,dir_digito_v,dir_tipo_persona,dir_apellidos,dir_nombres,".
		"dir_direccion,dir_telefono,dir_correo,dir_ciudad_direccion,dir_barrio,dir_fecha_nac,dir_lugar_nac,dir_estado) values ($identificacion[0],'$tipo_documento[0]',";
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
		
		$directorioRespuesta=new DirectorioEntidad();
		$directorioRespuesta=$directorio;
		$directorioRespuesta->setResultado($resultado);
		
		return $directorioRespuesta;
	}
	
	public function modificarDirectorio(DirectorioEntidad $directorio) {
		$directorioRespuesta=null;
		
		$identificacion=$directorio->getIdentificacion();
		$tipo_documento=$directorio->getTipoDocumento();
		$lugar_documento=$directorio->getLugarDocumento();
		$digito_v=$directorio->getDigitoV();
		$tipo_persona=$directorio->getTipoPersona();
		$apellidos=$directorio->getApellidos();
		$nombres=$directorio->getNombres();
		$direccion=$directorio->getDireccion();
		$telefono=$directorio->getTelefono();
		$correo=$directorio->getCorreo();
		$ciudad_direccion=$directorio->getCiudadDireccion();
		$barrio=$directorio->getBarrio();
		$fecha_nac=$directorio->getFechaNac();
		$lugar_nac=$directorio->getLugarNac();
		$estado=$directorio->getEstado();
		
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
		
		$directorioRespuesta=new DirectorioEntidad();
		$directorioRespuesta=$directorio;
		$directorioRespuesta->setResultado($resultado);
		
		return $directorioRespuesta;
	}
	
	public function inactivarDirectorio(DirectorioEntidad $directorio) {
		$directorioRespuesta=null;
		
		$identificacion=$directorio->getIdentificacion();
		$estado=$directorio->getEstado();
		
		$consulta="update iau_directorio set dir_estado='$estado[0]' where dir_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$directorioRespuesta=new DirectorioEntidad();
		$directorioRespuesta=$directorio;
		$directorioRespuesta->setResultado($resultado);
		
		return $directorioRespuesta;
	}
	
}

?>