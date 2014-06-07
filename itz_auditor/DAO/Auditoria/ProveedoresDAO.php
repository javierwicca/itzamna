<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Auditoria/ProveedoresEntidad.php';

use DAO\ConexionBD;
use Entidades\ProveedoresEntidad;

class ProveedoresDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarProveedores(ProveedoresEntidad $proveedores) {
		$proveedoresRespuesta=null;
		$consulta="select p.prv_identificacion,p.prv_tipo_sociedad,p.prv_autorretenedor,p.prv_gc,p.prv_sucursal,p.prv_dir_sucursal,p.prv_representante,p.prv_tipo_regimen,p.".
		"prv_estado,d.dir_direccion[0] as dir_residencia,d.dir_direccion[1] as dir_correspondencia,d.dir_direccion[2] as dir_contacto,d.dir_telefono[0] as celular,d.".
		"dir_telefono[1] as tel_fijo,d.dir_telefono[2] as fax,trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres,case ".
		"dir_tipo_persona when 'N' then 'NATURAL' when 'J' then 'JURÍDICA' end as ds_tipo_persona,(select p.par_detalle from iau_parametros p where p.par_parametro='TDIDE' ".
		"and p.par_elemento=d.dir_tipo_documento) as ds_tipo_documento,p.prv_retenedor_iva,p.prv_profesion_liberal,p.prv_ley_1429 from iau_proveedores p,iau_directorio d ".
		"where d.dir_identificacion=p.prv_identificacion ".$proveedores->getWhere();
		
		if ($proveedores->getOrder()!='') $consulta.=" order by ".$proveedores->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$proveedoresRespuesta=new ProveedoresEntidad();
		$proveedoresRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aProveedores){
					$proveedoresRespuesta->setIdx($i);
					$proveedoresRespuesta->setIdentificacion($aProveedores[prv_identificacion]);
					$proveedoresRespuesta->setTipoSociedad($aProveedores[prv_tipo_sociedad]);
					$proveedoresRespuesta->setAutorretenedor($aProveedores[prv_autorretenedor]);
					$proveedoresRespuesta->setGc($aProveedores[prv_gc]);
					$proveedoresRespuesta->setSucursal($aProveedores[prv_sucursal]);
					$proveedoresRespuesta->setDirSucursal($aProveedores[prv_dir_sucursal]);
					$proveedoresRespuesta->setRepresentante($aProveedores[prv_representante]);
					$proveedoresRespuesta->setTipoRegimen($aProveedores[prv_tipo_regimen]);
					$proveedoresRespuesta->setRetenedorIva($aProveedores[prv_retenedor_iva]);
					$proveedoresRespuesta->setProfesionLiberal($aProveedores[prv_profesion_liberal]);
					$proveedoresRespuesta->setLey1429($aProveedores[prv_ley_1429]);
					$proveedoresRespuesta->setEstado($aProveedores[prv_estado]);
					$i++;
				}
			}
		}
		return $proveedoresRespuesta;
	}
	
	public function adicionarProveedores(ProveedoresEntidad $proveedores) {
		$proveedoresRespuesta=null;
		
		$identificacion=$proveedores->getIdentificacion();
		$tipo_sociedad=$proveedores->getTipoSociedad();
		$autorretenedor=$proveedores->getAutorretenedor();
		$gc=$proveedores->getGc();
		$sucursal=$proveedores->getSucursal();
		$dir_sucursal=$proveedores->getDirSucursal();
		$representante=$proveedores->getRepresentante();
		$tipo_regimen=$proveedores->getTipoRegimen();
		$retenedor_iva=$proveedores->getRetenedorIva();
		$profesion_liberal=$proveedores->getProfesionLiberal();
		$ley_1429=$proveedores->getLey1429();
		$estado=$proveedores->getEstado();
		
		$consulta="insert into iau_proveedores (prv_identificacion,prv_tipo_sociedad,prv_autorretenedor,prv_gc,prv_sucursal,prv_dir_sucursal,prv_representante,".
		"prv_tipo_regimen,prv_retenedor_iva,prv_profesion_liberal,prv_ley_1429,prv_estado) values ($identificacion[0],";
		if ($tipo_sociedad[0]!='') $consulta.="'$tipo_sociedad[0]',";
		else $consulta.="null,";
		if ($autorretenedor[0]!='') $consulta.="'$autorretenedor[0]',";
		else $consulta.="null,";
		if ($gc[0]!='') $consulta.="'$gc[0]',";
		else $consulta.="null,";
		if ($sucursal[0]!='') $consulta.="'$sucursal[0]',";
		else $consulta.="null,";
		if ($dir_sucursal[0]!='') $consulta.="'$dir_sucursal[0]',";
		else $consulta.="null,";
		if ($representante[0]!='') $consulta.="'$representante[0]',";
		else $consulta.="null,";
		if ($tipo_regimen[0]!='') $consulta.="'$tipo_regimen[0]',";
		else $consulta.="null,";
		if ($retenedor_iva[0]!='') $consulta.="'$retenedor_iva[0]',";
		else $consulta.="null,";
		if ($profesion_liberal[0]!='') $consulta.="'$profesion_liberal[0]',";
		else $consulta.="null,";
		if ($ley_1429[0]!='') $consulta.="'$ley_1429[0]',";
		else $consulta.="null,";
		$consulta.="'$estado[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$proveedoresRespuesta=new ProveedoresEntidad();
		$proveedoresRespuesta=$proveedores;
		$proveedoresRespuesta->setResultado($resultado);
		
		return $proveedoresRespuesta;
	}
	
	public function modificarProveedores(ProveedoresEntidad $proveedores) {
		$proveedoresRespuesta=null;
		
		$identificacion=$proveedores->getIdentificacion();
		$tipo_sociedad=$proveedores->getTipoSociedad();
		$autorretenedor=$proveedores->getAutorretenedor();
		$gc=$proveedores->getGc();
		$sucursal=$proveedores->getSucursal();
		$dir_sucursal=$proveedores->getDirSucursal();
		$representante=$proveedores->getRepresentante();
		$tipo_regimen=$proveedores->getTipoRegimen();
		$estado=$proveedores->getEstado();
		$retenedor_iva=$proveedores->getRetenedorIva();
		$profesion_liberal=$proveedores->getProfesionLiberal();
		$ley_1429=$proveedores->getLey1429();
		
		$consulta="update iau_proveedores set ";
		if ($tipo_sociedad[0]!='') $consulta.="prv_tipo_sociedad='$tipo_sociedad[0]',";
		else $consulta.="prv_tipo_sociedad=null,";
		if ($autorretenedor[0]!='') $consulta.="prv_autorretenedor='$autorretenedor[0]',";
		else $consulta.="prv_autorretenedor=null,";
		if ($gc[0]!='') $consulta.="prv_gc='$gc[0]',";
		else $consulta.="prv_gc=null,";
		if ($sucursal[0]!='') $consulta.="prv_sucursal='$sucursal[0]',";
		else $consulta.="prv_sucursal=null,";
		if ($dir_sucursal[0]!='') $consulta.="prv_dir_sucursal='$dir_sucursal[0]',";
		else $consulta.="prv_dir_sucursal=null,";
		if ($representante[0]!='') $consulta.="prv_representante='$representante[0]',";
		else $consulta.="prv_representante=null,";
		if ($tipo_regimen[0]!='') $consulta.="prv_tipo_regimen='$tipo_regimen[0]',";
		else $consulta.="prv_tipo_regimen=null,";
		if ($retenedor_iva[0]!='') $consulta.="prv_retenedor_iva='$retenedor_iva[0]',";
		else $consulta.="prv_retenedor_iva=null,";
		if ($profesion_liberal[0]!='') $consulta.="prv_profesion_liberal='$profesion_liberal[0]',";
		else $consulta.="prv_profesion_liberal=null,";
		if ($ley_1429[0]!='') $consulta.="prv_ley_1429='$ley_1429[0]',";
		else $consulta.="prv_ley_1429=null,";
		$consulta.="prv_estado='$estado[0]' where prv_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$proveedoresRespuesta=new ProveedoresEntidad();
		$proveedoresRespuesta=$proveedores;
		$proveedoresRespuesta->setResultado($resultado);
		
		return $proveedoresRespuesta;
	}
	
	public function inactivarProveedores(ProveedoresEntidad $proveedores) {
		$proveedoresRespuesta=null;
		
		$identificacion=$proveedores->getIdentificacion();
		$estado=$proveedores->getEstado();
		
		$consulta="update iau_proveedores set prv_estado='$estado[0]' where prv_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$proveedoresRespuesta=new ProveedoresEntidad();
		$proveedoresRespuesta=$proveedores;
		$proveedoresRespuesta->setResultado($resultado);
		
		return $proveedoresRespuesta;
	}
	
}

?>