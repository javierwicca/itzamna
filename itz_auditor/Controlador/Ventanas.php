<?php
namespace Controller;

header('Content-Type: text/html; charset=ISO-8859-1');
require_once '../Entidades/Auditoria/BienServiciosEntidad.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';
require_once '../Entidades/Auditoria/DetallePagosEntidad.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';
require_once '../Entidades/Auditoria/ImpuestoPagosEntidad.php';
require_once '../Entidades/Auditoria/MovimientoEntidad.php';
require_once '../Entidades/Auditoria/PagosEntidad.php';
require_once '../Entidades/Auditoria/ProveedoresEntidad.php';
require_once '../Entidades/Configuracion/CiiuDirectorioEntidad.php';
require_once '../Entidades/Configuracion/ClientesEntidad.php';
require_once '../Entidades/Configuracion/DirectorioEntidad.php';
require_once '../Entidades/Configuracion/LugaresEntidad.php';
require_once '../Entidades/Configuracion/ModulosEntidad.php';
require_once '../Entidades/Configuracion/ParametrosEntidad.php';
require_once '../Entidades/Configuracion/PermisosExcepcionalesEntidad.php';
require_once '../Entidades/Configuracion/RolesEntidad.php';
require_once '../Entidades/Configuracion/RolesPermisosEntidad.php';
require_once '../Entidades/Configuracion/RolesUsuariosEntidad.php';
require_once '../Entidades/Configuracion/UsuarioEntidad.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';
require_once '../Negocio/General/NegocioFacade.php';
require_once '../PHPExcel/Classes/PHPExcel/Cell.php';
require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';

use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\ClientesEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DetallePagosEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
use Entidades\ImpuestoPagosEntidad;
use Entidades\LugaresEntidad;
use Entidades\ModificadorTablasEntidad;
use Entidades\ModulosEntidad;
use Entidades\MovimientoEntidad;
use Entidades\PagosEntidad;
use Entidades\ParametrosEntidad;
use Entidades\PermisosExcepcionalesEntidad;
use Entidades\ProveedoresEntidad;
use Entidades\RolesEntidad;
use Entidades\RolesPermisosEntidad;
use Entidades\RolesUsuariosEntidad;
use Entidades\UsuarioEntidad;
use Negocio\NegocioFacade;
use PHPExcel_Cell;
use PHPExcel_IOFactory;

class Ventana{
	
	private $BienServiciosEntidad;
	private $CiiuDirectorioEntidad;
	private $ClientesEntidad;
	private $CuentaPucEntidad;
	private $DetallePagosEntidad;
	private $DirectorioEntidad;
	private $DocPagosEntidad;
	private $DocProveedoresEntidad;
	private $ImpuestoPagosEntidad;
	private $LugaresEntidad;
	private $ModificadorTablasEntidad;
	private $ModulosEntidad;
	private $MovimientoEntidad;
	private $NegocioFacade;
	private $PagosEntidad;
	private $ParametrosEntidad;
	private $PermisosExcepcionalesEntidad;
	private $ProveedoresEntidad;
	private $RolesEntidad;
	private $RolesPermisosEntidad;
	private $RolesUsuariosEntidad;
	private $UsuarioEntidad;
	
	function __construct(){
		if (!isset($this->BienServiciosEntidad)) $this->BienServiciosEntidad=new BienServiciosEntidad();
		if (!isset($this->CiiuDirectorioEntidad)) $this->CiiuDirectorioEntidad=new CiiuDirectorioEntidad();
		if (!isset($this->ClientesEntidad)) $this->ClientesEntidad=new ClientesEntidad();
		if (!isset($this->CuentaPucEntidad)) $this->CuentaPucEntidad=new CuentaPucEntidad();
		if (!isset($this->DetallePagosEntidad)) $this->DetallePagosEntidad=new DetallePagosEntidad();
		if (!isset($this->DirectorioEntidad)) $this->DirectorioEntidad=new DirectorioEntidad();
		if (!isset($this->DocPagosEntidad)) $this->DocPagosEntidad=new DocPagosEntidad();
		if (!isset($this->DocProveedoresEntidad)) $this->DocProveedoresEntidad=new DocProveedoresEntidad();
		if (!isset($this->ImpuestoPagosEntidad)) $this->ImpuestoPagosEntidad=new ImpuestoPagosEntidad();
		if (!isset($this->LugaresEntidad)) $this->LugaresEntidad=new LugaresEntidad();
		if (!isset($this->ModificadorTablasEntidad)) $this->ModificadorTablasEntidad=new ModificadorTablasEntidad();
		if (!isset($this->ModulosEntidad)) $this->ModulosEntidad=new ModulosEntidad();
		if (!isset($this->MovimientoEntidad)) $this->MovimientoEntidad=new MovimientoEntidad();
		if (!isset($this->NegocioFacade)) $this->NegocioFacade=new NegocioFacade();
		if (!isset($this->PagosEntidad)) $this->PagosEntidad=new PagosEntidad();
		if (!isset($this->ParametrosEntidad)) $this->ParametrosEntidad=new ParametrosEntidad();
		if (!isset($this->PermisosExcepcionalesEntidad)) $this->PermisosExcepcionalesEntidad=new PermisosExcepcionalesEntidad();
		if (!isset($this->ProveedoresEntidad)) $this->ProveedoresEntidad=new ProveedoresEntidad();
		if (!isset($this->RolesEntidad)) $this->RolesEntidad=new RolesEntidad();
		if (!isset($this->RolesPermisosEntidad)) $this->RolesPermisosEntidad=new RolesPermisosEntidad();
		if (!isset($this->RolesUsuariosEntidad)) $this->RolesUsuariosEntidad=new RolesUsuariosEntidad();
		if (!isset($this->UsuarioEntidad)) $this->UsuarioEntidad=new UsuarioEntidad();
				
	}
	
	function workflow($ventana,$accion) {
		
		global $FechaInicio;
		
		if ($_REQUEST[fechaInicio]=='') $FechaInicio=date('YmsHisu');
		else $FechaInicio=$_REQUEST[fechaInicio];
		
		@session_name("ITZAudID-$FechaInicio");
		session_start();
		
		$ventana_ac = new Ventana();
		
		$ventana_ac->$ventana($accion);
	}
	
	function vRol($accion) {
		
		$rol=base64_decode($_REQUEST[rol]);
		
		if ($accion!='A') {
			$this->RolesEntidad->setWhere(" and r.rol_codigo=".base64_decode($_REQUEST[rol]));
			$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
				
			$codigo=$rolesRetorna->getCodigo();
			$nombre=$rolesRetorna->getNombre();
			$estado=$rolesRetorna->getEstado();
			$datos_ant=base64_encode("rol_codigo=$codigo[0]; rol_nombre=$nombre[0]; ror_estado=$estado[0]");
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_roles' and mt.mta_llave='$codigo[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod=$usuario[0];
			$fc_sis_mod=$fecha[0];
		} else {
			$datos_ant=base64_encode("");
			$usr_mod=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod=date('Y-m-d H:i:s');
		}
		
		if ($accion=='M'&&$estado[0]=='I') $dis='';
		else $dis='readonly="readonly"';
		
		if ($accion=='I') {
			$estado[0]='I';
			$dis_n='readonly="readonly"';
		}
		
		$this->ModulosEntidad->setOrder('mm.mme_codigo');
		$this->ModulosEntidad->setWhere(" and mm.mme_codigo>=0");
		$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
		$resultado=$modulosRetorna->getResultado();
		
		$i=0;
		while ($fila=pg_fetch_assoc($resultado)) {
			$modulo[$i]=$fila[mme_codigo];
			$nombre_m[$i]=$fila[mme_nombre];
			$mod_sup[$i]=$fila[par_detalle];
			
			if ($accion!='A') {
				$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol=$rol and rp.rpe_modulo=$fila[mme_codigo]");
				$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
				$resultado_rp=$rolesPermisosRetorna->getResultado();
				if ($fila_rp=pg_fetch_assoc($resultado_rp)) {
					$accion_rp[$i]='M';
					$datos_ant_rp[$i]=base64_encode("rpe_rol=$rol; rpe_modulo=$fila[mme_codigo]; rpe_consulta=$fila_rp[rpe_consulta]; rpe_adicionar=$fila_rp[rpe_adicionar];".
					" rpe_modificar=$fila_rp[rpe_modificar]; rpe_eliminar=$fila_rp[rpe_eliminar]");
					$consultar[$i]=$fila_rp[rpe_consulta];
					$adicionar[$i]=$fila_rp[rpe_adicionar];
					$modificar[$i]=$fila_rp[rpe_modificar];
					$eliminar[$i]=$fila_rp[rpe_eliminar];
				} else {
					$datos_ant_rp[$i]=base64_encode("");
					$accion_rp[$i]='A';
				}
			}
			$i++;
		}
		
		include '../Ventanas/Configuracion/vRol.php';
	}
	
	function vInfoRol($accion) {
		
		$rol=base64_decode($_REQUEST[rol]);
		
		$this->RolesEntidad->setWhere(" and r.rol_codigo=".base64_decode($_REQUEST[rol]));
		$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
			
		$codigo=$rolesRetorna->getCodigo();
		$nombre=$rolesRetorna->getNombre();
		$estado=$rolesRetorna->getEstado();
		
		$this->ModulosEntidad->setOrder('mm.mme_codigo');
		$this->ModulosEntidad->setWhere(" and mm.mme_codigo>=0");
		$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
		$resultado=$modulosRetorna->getResultado();
		
		$i=0;
		while ($fila=pg_fetch_assoc($resultado)) {
			$modulo[$i]=$fila[mme_codigo];
			$nombre_m[$i]=$fila[mme_nombre];
			$mod_sup[$i]=$fila[par_detalle];
			
			$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol=$rol and rp.rpe_modulo=$fila[mme_codigo]");
			$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
			$resultado_rp=$rolesPermisosRetorna->getResultado();
			if ($fila_rp=pg_fetch_assoc($resultado_rp)) {
				$consultar[$i]=$fila_rp[rpe_consulta];
				$adicionar[$i]=$fila_rp[rpe_adicionar];
				$modificar[$i]=$fila_rp[rpe_modificar];
				$eliminar[$i]=$fila_rp[rpe_eliminar];
			}
			$i++;
		}
		
		include '../Ventanas/Configuracion/vInfoRol.php';
	}
	
	function vCliente($accion) {
		$cliente=base64_decode($_REQUEST[cliente]);
		
		if ($accion!='A') {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
			
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
			
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
			
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			
			if ($a_ciudad_domicilio[0]!='NULL') {
				$ciudad_domicilio=$a_ciudad_domicilio[0];
				$depto_domicilio=substr($ciudad_domicilio,0,5);
				$pais_domicilio=substr($ciudad_domicilio,0,3);
			} else {
				$pais_domicilio='COL';
			}
			
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
			} else {
				$pais_correspondencia='COL';
			}
			
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
			} else {
				$pais_contacto='COL';
			}
			
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
			
			$barrio=$directorioRetorna->getBarrio();
			
			$estado_d=$directorioRetorna->getEstado();
			
			$this->ClientesEntidad->setWhere(" and c.cli_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente])));
			$clienteRetorna=$this->NegocioFacade->listarClientes($this->ClientesEntidad);
			$tipo_sociedad=$clienteRetorna->getTipoSociedad();
			$tipo_regimen=$clienteRetorna->getTipoRegimen();
			$autorretenedor=$clienteRetorna->getAutorretenedor();
			$retenedor_iva=$clienteRetorna->getRetenedorIva();
			$retefuente_todos=$clienteRetorna->getRetefuenteTodos();
			$gc=$clienteRetorna->getGc();
			$ciudad_s=$clienteRetorna->getSucursal();
			$dir_s=$clienteRetorna->getDirSucursal();
			$representante=$clienteRetorna->getRepresentante();
			
			$ciudad_sucursal=$this->NegocioFacade->arSqlArPhp($ciudad_s[0]);
			for ($i=0;$i<count($ciudad_sucursal);$i++) {
				$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
				$pais_sucursal[$i]=substr($ciudad_sucursal[$i],0,3);
			}
			
			$dir_sucursal=$this->NegocioFacade->arSqlArPhp($dir_s[0]);
			
			$estado_c=$clienteRetorna->getEstado();
			
			if ($representante[0]!='') {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".$representante[0]);
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
				$identificacion_r=$directorioRetorna->getIdentificacion();
				$tipo_persona_r=$directorioRetorna->getTipoPersona();
				$digito_v_r=$directorioRetorna->getDigitoV();
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				$ciudad_documento_r=$directorioRetorna->getLugarDocumento();
				$depto_documento_r[0]=substr($ciudad_documento_r[0],0,5);
				$pais_documento_r[0]=substr($ciudad_documento_r[0],0,3);
				
				$nombres_r=$directorioRetorna->getNombres();
				$apellidos_r=$directorioRetorna->getApellidos();
				$nac_r=$directorioRetorna->getFechaNac();
				$correo_r=$directorioRetorna->getCorreo();
				
				$ciudad_nac_r=$directorioRetorna->getLugarNac();
				$depto_nac_r[0]=substr($ciudad_nac_r[0],0,5);
				$pais_nac_r[0]=substr($ciudad_nac_r[0],0,3);
				
				$direcciones_r=$directorioRetorna->getDireccion();
				$a_direcciones_r=$this->NegocioFacade->arSqlArPhp($direcciones_r[0]);
				if ($a_direcciones_r[0]!='NULL') $dir_residencia_r=$a_direcciones_r[0];
				if ($a_direcciones_r[1]!='NULL') $dir_correspondencia_r=$a_direcciones_r[1];
				if ($a_direcciones_r[2]!='NULL') $dir_contacto_r=$a_direcciones_r[2];
				
				$ciudad_r=$directorioRetorna->getCiudadDireccion();
				$a_ciudad_domicilio_r=$this->NegocioFacade->arSqlArPhp($ciudad_r[0]);
				if ($a_ciudad_domicilio_r[0]!='NULL') {
					$ciudad_domicilio_r=$a_ciudad_domicilio_r[0];
					$depto_domicilio_r=substr($ciudad_domicilio_r,0,5);
					$pais_domicilio_r=substr($ciudad_domicilio_r,0,3);
				} else {
					$pais_domicilio_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[1]!='NULL') {
					$ciudad_correspondencia_r=$a_ciudad_domicilio_r[1];
					$depto_correspondencia_r=substr($ciudad_correspondencia_r,0,5);
					$pais_correspondencia_r=substr($ciudad_correspondencia_r,0,3);
				} else {
					$pais_correspondencia_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[2]!='NULL') {
					$ciudad_contacto_r=$a_ciudad_domicilio_r[2];
					$depto_contacto_r=substr($ciudad_contacto_r,0,5);
					$pais_contacto_r=substr($ciudad_contacto_r,0,3);
				} else {
					$pais_contacto_r='COL';
				}
				
				$telefonos_r=$directorioRetorna->getTelefono();
				$a_telefonos_r=$this->NegocioFacade->arSqlArPhp($telefonos_r[0]);
				if ($a_telefonos_r[0]!='NULL') $celular_r=$a_telefonos_r[0];
				if ($a_telefonos_r[1]!='NULL') $telefono_r=$a_telefonos_r[1];
				if ($a_telefonos_r[2]!='NULL') $fax_r=$a_telefonos_r[2];
				if ($a_telefonos_r[3]!='NULL') $otro_tel_r=$a_telefonos_r[3];
				
				$barrio_r=$directorioRetorna->getBarrio();
				
				$estado_r=$directorioRetorna->getEstado();
			}
			
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente]))." and c.cdi_lugar='COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu=$ciiuDirectorioRetorna->getCiiu();
			$principal=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version[$i]=$fila[ciu_version];
				$i++;
			}
			
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente]))." and c.cdi_lugar<>'COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu_ci=$ciiuDirectorioRetorna->getCiiu();
			$lug_ciiu_ci=$ciiuDirectorioRetorna->getLugar();
			$principal_ci=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version_ci[$i]=$fila[ciu_version];
				$i++;
			}
			
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
			"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
			"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=$estado_d[0]");
			
			$datos_ant_c=base64_encode("cli_identificacion=$identificacion[0]; cli_tipo_sociedad=$tipo_sociedad[0]; cli_autorretenedor=$autorretenedor[0]; cli_gc=".
			"$gc[0]; cli_sucursal=$ciudad_s[0]; cli_dir_sucursal=$dir_s[0]; cli_representante=$representante[0]; cli_estado=$estado_c[0]; cli_tipo_regimen=".
			"$tipo_regimen[0]; cli_retenedor_iva=$retenedor_iva[0]; cli_retefuente_todos=$retefuente_todos[0]");
			
			$datos_ant_r=base64_encode("dir_identificacion=$identificacion_r[0]; dir_tipo_documento=$tipo_documento_r[0]; dir_lugar_documento=$ciudad_documento_r[0]; ".
			"dir_digito_v=$digito_v_r[0]; dir_tipo_persona=$tipo_persona_r[0]; dir_apellidos=$apellidos_r[0]; dir_nombres=$nombres_r[0]; dir_direccion=$direcciones_r[0]; ".
			"dir_telefono=$telefonos_r[0]; dir_correo=$correo_r[0]; dir_ciudad_direccion=$ciudad_r[0]; dir_barrio=$barrio_r[0]; dir_fecha_nac=$nac_r[0]; dir_lugar_nac=".
			"$ciudad_nac_r[0]; dir_estado=$estado_r[0]");
			
			for ($i=0;$i<count($ciiu);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[$i]; cdi_lugar=COL; cdi_principal=$principal[$i]");
			}
			
			for ($i=0;$i<count($ciiu_ci);$i++) {
				$datos_ant_ci_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu_ci[$i]; cdi_lugar=$lug_ciiu_ci[$i]; cdi_principal=$principal_ci[$i]");
			}
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_clientes' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_c=$usuario[0];
			$fc_sis_mod_c=$fecha[0];
				
			if ($representante[0]!='') {
				$accion_r='M';
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$representante[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_r=$usuario[0];
				$fc_sis_mod_r=$fecha[0];
			} else {
				$accion_r='A';
				$usr_mod_r=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_r=date('Y-m-d H:i:s');
			}
				
			if ($ciiu[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave='$identificacion[0]##$ciiu[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci=$usuario[0];
				$fc_sis_mod_ci=$fecha[0];
			} else {
				$usr_mod_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci=date('Y-m-d H:i:s');
			}
			
			if ($ciiu_ci[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>".
				"'$identificacion[0]##$ciiu_ci[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci_ci=$usuario[0];
				$fc_sis_mod_ci_ci=$fecha[0];
			} else {
				$usr_mod_ci_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci_ci=date('Y-m-d H:i:s');
			}
			
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$pais_documento_r[0]='COL';
			$pais_nac_r[0]='COL';
			$pais_domicilio_r='COL';
			$pais_correspondencia_r='COL';
			$pais_contacto_r='COL';
			$usr_mod_d=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod_d=date('Y-m-d H:i:s');
			$usr_mod_c=$usr_mod_d;
			$fc_sis_mod_c=$fc_sis_mod_d;
			$usr_mod_r=$usr_mod_d;
			$fc_sis_mod_r=$fc_sis_mod_d;
			$usr_mod_ci=$usr_mod_d;
			$fc_sis_mod_ci=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			$datos_ant_d=base64_encode("");
				
			$datos_ant_c=base64_encode("");
			
			$datos_ant_r=base64_encode("");
		}
		
		if ($accion=='M'&&$estado_c[0]=='I') $estado_c[0]='A';
		
		if ($accion=='I') {
			$estado_c[0]='I';
			$dis_n='readonly="readonly"';
		}
		
		include '../Ventanas/Configuracion/vCliente.php';
	}
	
	function vInfoCliente($accion) {
		$cliente=base64_decode($_REQUEST[cliente]);
	
		if ($accion!='A') {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento[0]'");
			$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$tipo_documento=$parametrosRetorna->getDetalle();
			
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_documento=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_documento=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_documento=$lugaresRetorna->getNombre();
							
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
				
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_nac=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_nac=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_nac=$lugaresRetorna->getNombre();
			
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
				
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
				
			if ($a_ciudad_domicilio[0]!='NULL') {
			$ciudad_domicilio=$a_ciudad_domicilio[0];
			$depto_domicilio=substr($ciudad_domicilio,0,5);
			$pais_domicilio=substr($ciudad_domicilio,0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_domicilio=$lugaresRetorna->getNombre();
			
			} else {
				$pais_domicilio='COL';
			}
				
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_correspondencia=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_correspondencia=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_correspondencia=$lugaresRetorna->getNombre();
						
			} else {
				$pais_correspondencia='COL';
			}
				
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_contacto=$lugaresRetorna->getNombre();
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_contacto=$lugaresRetorna->getNombre();
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_contacto=$lugaresRetorna->getNombre();
				
			} else {
				$pais_contacto='COL';
			}
			
			$telefonos=$directorioRetorna->getTelefono();
			$telefonos=$directorioRetorna->getTelefono();
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
				
			$barrio=$directorioRetorna->getBarrio();
				
			$estado_d=$directorioRetorna->getEstado();
				
			$this->ClientesEntidad->setWhere(" and c.cli_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente])));
			$clienteRetorna=$this->NegocioFacade->listarClientes($this->ClientesEntidad);
			
			$tipo_sociedad=$clienteRetorna->getTipoSociedad();
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDSOC' and p.par_elemento='$tipo_sociedad[0]'");
			$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$tipo_sociedad=$parametrosRetorna->getDetalle();
				
			
			$tipo_regimen=$clienteRetorna->getTipoRegimen();
			$autorretenedor=$clienteRetorna->getAutorretenedor();
			$retenedor_iva=$clienteRetorna->getRetenedorIva();
			$retefuente_todos=$clienteRetorna->getRetefuenteTodos();
			$gc=$clienteRetorna->getGc();
			$ciudad_s=$clienteRetorna->getSucursal();
			$dir_s=$clienteRetorna->getDirSucursal();
			$representante=$clienteRetorna->getRepresentante();
				
			$ciudad_sucursal=$this->NegocioFacade->arSqlArPhp($ciudad_s[0]);
			for ($i=0;$i<count($ciudad_sucursal);$i++) {
				
				$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
				$pais_sucursal[$i]=substr($ciudad_sucursal[$i],0,3);
				
				if ($ciudad_sucursal[$i]!='NULL') {
					
					$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
					$pais_sucursal[$i]=substr($depto_sucursal[$i],0,3);
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_sucursal[$i]=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_sucursal[$i]=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_sucursal[$i]=$lugaresRetorna->getNombre();
						
				} else {
					$pais_contacto='COL';
				}
				
			}
				
			$dir_sucursal=$this->NegocioFacade->arSqlArPhp($dir_s[0]);
				
			$estado_c=$clienteRetorna->getEstado();
				
			if ($representante[0]!='') {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".$representante[0]);
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
	
				$identificacion_r=$directorioRetorna->getIdentificacion();
				$tipo_persona_r=$directorioRetorna->getTipoPersona();
				$digito_v_r=$directorioRetorna->getDigitoV();
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento_r[0]'");
				$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
				$tipo_documento_r=$parametrosRetorna->getDetalle();
					
				$ciudad_documento_r=$directorioRetorna->getLugarDocumento();
				$depto_documento_r[0]=substr($ciudad_documento_r[0],0,5);
				$pais_documento_r[0]=substr($ciudad_documento_r[0],0,3);
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_documento_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_documento_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_documento_r=$lugaresRetorna->getNombre();
				
				$nombres_r=$directorioRetorna->getNombres();
				$apellidos_r=$directorioRetorna->getApellidos();
				$nac_r=$directorioRetorna->getFechaNac();
				$correo_r=$directorioRetorna->getCorreo();
	
				$ciudad_nac_r=$directorioRetorna->getLugarNac();
				$depto_nac_r[0]=substr($ciudad_nac_r[0],0,5);
				$pais_nac_r[0]=substr($ciudad_nac_r[0],0,3);
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_nac_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_nac_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_nac_r=$lugaresRetorna->getNombre();
	
				$direcciones_r=$directorioRetorna->getDireccion();
				$a_direcciones_r=$this->NegocioFacade->arSqlArPhp($direcciones_r[0]);
				if ($a_direcciones_r[0]!='NULL') $dir_residencia_r=$a_direcciones_r[0];
				if ($a_direcciones_r[1]!='NULL') $dir_correspondencia_r=$a_direcciones_r[1];
				if ($a_direcciones_r[2]!='NULL') $dir_contacto_r=$a_direcciones_r[2];
	
				$ciudad_r=$directorioRetorna->getCiudadDireccion();
				$a_ciudad_domicilio_r=$this->NegocioFacade->arSqlArPhp($ciudad_r[0]);
					
				if ($a_ciudad_domicilio_r[0]!='NULL') {
					$ciudad_domicilio_r=$a_ciudad_domicilio_r[0];
					$depto_domicilio_r=substr($ciudad_domicilio_r,0,5);
					$pais_domicilio_r=substr($ciudad_domicilio_r,0,3);
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_domicilio_r=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_domicilio_r=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_domicilio_r=$lugaresRetorna->getNombre();
						
				} else {
					$pais_domicilio_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[1]!='NULL') {
					$ciudad_correspondencia_r=$a_ciudad_domicilio_r[1];
					$depto_correspondencia_r=substr($ciudad_correspondencia_r,0,5);
					$pais_correspondencia_r=substr($ciudad_correspondencia_r,0,3);
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_correspondencia_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_correspondencia_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_correspondencia_r=$lugaresRetorna->getNombre();
						
				} else {
					$pais_correspondencia_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[2]!='NULL') {
					$ciudad_contacto_r=$a_ciudad_domicilio_r[2];
					$depto_contacto_r=substr($ciudad_contacto_r,0,5);
					$pais_contacto_r=substr($ciudad_contacto_r,0,3);
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_contacto_r=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_contacto_r=$lugaresRetorna->getNombre();
						
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_contacto_r=$lugaresRetorna->getNombre();
						
				} else {
					$pais_contacto_r='COL';
				}
	
				$telefonos_r=$directorioRetorna->getTelefono();
				$a_telefonos_r=$this->NegocioFacade->arSqlArPhp($telefonos_r[0]);
				if ($a_telefonos_r[0]!='NULL') $celular_r=$a_telefonos_r[0];
				if ($a_telefonos_r[1]!='NULL') $telefono_r=$a_telefonos_r[1];
				if ($a_telefonos_r[2]!='NULL') $fax_r=$a_telefonos_r[2];
				if ($a_telefonos_r[3]!='NULL') $otro_tel_r=$a_telefonos_r[3];
	
				$barrio_r=$directorioRetorna->getBarrio();
	
				$estado_r=$directorioRetorna->getEstado();
			}
				
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente]))." and c.cdi_lugar='COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
				
			$ciiu=$ciiuDirectorioRetorna->getCiiu();
			$principal=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version[$i]=$fila[ciu_version];
				$nn_ciiu[$i]=$fila[ciu_detalle];
				$i++;
			}
				
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[cliente]))." and c.cdi_lugar<>'COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
				
			$ciiu_ci=$ciiuDirectorioRetorna->getCiiu();
			
			$lug_ciiu_ci=$ciiuDirectorioRetorna->getLugar();			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$lug_ciiu_ci'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$lug_ciiu_ci=$lugaresRetorna->getNombre();
			
			$principal_ci=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version_ci[$i]=$fila[ciu_version];
				$nn_ciiu_ci[$i]=$fila[ciu_detalle];
				$i++;
			}
				
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
					"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
					"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
					"$ciudad_nac[0]; dir_estado=$estado_d[0]");
				
			$datos_ant_c=base64_encode("cli_identificacion=$identificacion[0]; cli_tipo_sociedad=$tipo_sociedad[0]; cli_autorretenedor=$autorretenedor[0]; cli_gc=".
					"$gc[0]; cli_sucursal=$ciudad_s[0]; cli_dir_sucursal=$dir_s[0]; cli_representante=$representante[0]; cli_estado=$estado_c[0]; cli_tipo_regimen=".
					"$tipo_regimen[0]; cli_retenedor_iva=$retenedor_iva[0]; cli_retefuente_todos=$retefuente_todos[0]");
				
			$datos_ant_r=base64_encode("dir_identificacion=$identificacion_r[0]; dir_tipo_documento=$tipo_documento_r[0]; dir_lugar_documento=$ciudad_documento_r[0]; ".
					"dir_digito_v=$digito_v_r[0]; dir_tipo_persona=$tipo_persona_r[0]; dir_apellidos=$apellidos_r[0]; dir_nombres=$nombres_r[0]; dir_direccion=$direcciones_r[0]; ".
					"dir_telefono=$telefonos_r[0]; dir_correo=$correo_r[0]; dir_ciudad_direccion=$ciudad_r[0]; dir_barrio=$barrio_r[0]; dir_fecha_nac=$nac_r[0]; dir_lugar_nac=".
					"$ciudad_nac_r[0]; dir_estado=$estado_r[0]");
				
			for ($i=0;$i<count($ciiu);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[$i]; cdi_lugar=COL; cdi_principal=$principal[$i]");
			}
				
			for ($i=0;$i<count($ciiu_ci);$i++) {
				$datos_ant_ci_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu_ci[$i]; cdi_lugar=$lug_ciiu_ci[$i]; cdi_principal=$principal_ci[$i]");
			}
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
	
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_clientes' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_c=$usuario[0];
			$fc_sis_mod_c=$fecha[0];
	
			if ($representante[0]!='') {
				$accion_r='M';
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$representante[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_r=$usuario[0];
				$fc_sis_mod_r=$fecha[0];
			} else {
				$accion_r='A';
				$usr_mod_r=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_r=date('Y-m-d H:i:s');
			}
	
			if ($ciiu[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave='$identificacion[0]##$ciiu[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci=$usuario[0];
				$fc_sis_mod_ci=$fecha[0];
			} else {
				$usr_mod_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci=date('Y-m-d H:i:s');
			}
				
			if ($ciiu_ci[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>".
						"'$identificacion[0]##$ciiu_ci[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci_ci=$usuario[0];
				$fc_sis_mod_ci_ci=$fecha[0];
			} else {
				$usr_mod_ci_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci_ci=date('Y-m-d H:i:s');
			}
				
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$pais_documento_r[0]='COL';
			$pais_nac_r[0]='COL';
			$pais_domicilio_r='COL';
			$pais_correspondencia_r='COL';
			$pais_contacto_r='COL';
			$usr_mod_d=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod_d=date('Y-m-d H:i:s');
			$usr_mod_c=$usr_mod_d;
			$fc_sis_mod_c=$fc_sis_mod_d;
			$usr_mod_r=$usr_mod_d;
			$fc_sis_mod_r=$fc_sis_mod_d;
			$usr_mod_ci=$usr_mod_d;
			$fc_sis_mod_ci=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			$datos_ant_d=base64_encode("");
	
			$datos_ant_c=base64_encode("");
				
			$datos_ant_r=base64_encode("");
		}
	
		if ($accion=='M'&&$estado_c[0]=='I') $estado_c[0]='A';
	
		if ($accion=='I') {
			$estado_c[0]='I';
			$dis_n='readonly="readonly"';
		}
	
		include '../Ventanas/Configuracion/vInfoCliente.php';
	}
	
	function vProveedor($accion) {
		$proveedor=base64_decode($_REQUEST[proveedor]);
		
		if ($accion!='A') {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
			
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
			
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
			
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			
			if ($a_ciudad_domicilio[0]!='NULL') {
				$ciudad_domicilio=$a_ciudad_domicilio[0];
				$depto_domicilio=substr($ciudad_domicilio,0,5);
				$pais_domicilio=substr($ciudad_domicilio,0,3);
			} else {
				$pais_domicilio='COL';
			}
			
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
			} else {
				$pais_correspondencia='COL';
			}
			
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
			} else {
				$pais_contacto='COL';
			}
			
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
			
			$barrio=$directorioRetorna->getBarrio();
			
			$estado_d=$directorioRetorna->getEstado();
			
			$this->ProveedoresEntidad->setWhere(" and p.prv_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$proveedorRetorna=$this->NegocioFacade->listarProveedores($this->ProveedoresEntidad);
			$tipo_sociedad=$proveedorRetorna->getTipoSociedad();
			$tipo_regimen=$proveedorRetorna->getTipoRegimen();
			$autorretenedor=$proveedorRetorna->getAutorretenedor();
			$retenedor_iva=$proveedorRetorna->getRetenedorIva();
			$profesion_liberal=$proveedorRetorna->getProfesionLiberal();
			$ley_1429=$proveedorRetorna->getLey1429();
			$gc=$proveedorRetorna->getGc();
			$ciudad_s=$proveedorRetorna->getSucursal();
			$dir_s=$proveedorRetorna->getDirSucursal();
			$representante=$proveedorRetorna->getRepresentante();
			
			$ciudad_sucursal=$this->NegocioFacade->arSqlArPhp($ciudad_s[0]);
			for ($i=0;$i<count($ciudad_sucursal);$i++) {
				$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
				$pais_sucursal[$i]=substr($ciudad_sucursal[$i],0,3);
			}
			
			$dir_sucursal=$this->NegocioFacade->arSqlArPhp($dir_s[0]);
			
			$estado_p=$proveedorRetorna->getEstado();
			
			if ($representante[0]!='') {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".$representante[0]);
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
				$identificacion_r=$directorioRetorna->getIdentificacion();
				$tipo_persona_r=$directorioRetorna->getTipoPersona();
				$digito_v_r=$directorioRetorna->getDigitoV();
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				$ciudad_documento_r=$directorioRetorna->getLugarDocumento();
				$depto_documento_r[0]=substr($ciudad_documento_r[0],0,5);
				$pais_documento_r[0]=substr($ciudad_documento_r[0],0,3);
				
				$nombres_r=$directorioRetorna->getNombres();
				$apellidos_r=$directorioRetorna->getApellidos();
				$nac_r=$directorioRetorna->getFechaNac();
				$correo_r=$directorioRetorna->getCorreo();
					
				$ciudad_nac_r=$directorioRetorna->getLugarNac();
				$depto_nac_r[0]=substr($ciudad_nac_r[0],0,5);
				$pais_nac_r[0]=substr($ciudad_nac_r[0],0,3);
				
				$direcciones_r=$directorioRetorna->getDireccion();
				$a_direcciones_r=$this->NegocioFacade->arSqlArPhp($direcciones_r[0]);
				if ($a_direcciones_r[0]!='NULL') $dir_residencia_r=$a_direcciones_r[0];
				if ($a_direcciones_r[1]!='NULL') $dir_correspondencia_r=$a_direcciones_r[1];
				if ($a_direcciones_r[2]!='NULL') $dir_contacto_r=$a_direcciones_r[2];
				
				$ciudad_r=$directorioRetorna->getCiudadDireccion();
				$a_ciudad_domicilio_r=$this->NegocioFacade->arSqlArPhp($ciudad_r[0]);
				if ($a_ciudad_domicilio_r[0]!='NULL') {
					$ciudad_domicilio_r=$a_ciudad_domicilio_r[0];
					$depto_domicilio_r=substr($ciudad_domicilio_r,0,5);
					$pais_domicilio_r=substr($ciudad_domicilio_r,0,3);
				} else {
					$pais_domicilio_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[1]!='NULL') {
					$ciudad_correspondencia_r=$a_ciudad_domicilio_r[1];
					$depto_correspondencia_r=substr($ciudad_correspondencia_r,0,5);
					$pais_correspondencia_r=substr($ciudad_correspondencia_r,0,3);
				} else {
					$pais_correspondencia_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[2]!='NULL') {
					$ciudad_contacto_r=$a_ciudad_domicilio_r[2];
					$depto_contacto_r=substr($ciudad_contacto_r,0,5);
					$pais_contacto_r=substr($ciudad_contacto_r,0,3);
				} else {
					$pais_contacto_r='COL';
				}
				
				$telefonos_r=$directorioRetorna->getTelefono();
				$a_telefonos_r=$this->NegocioFacade->arSqlArPhp($telefonos_r[0]);
				if ($a_telefonos_r[0]!='NULL') $celular_r=$a_telefonos_r[0];
				if ($a_telefonos_r[1]!='NULL') $telefono_r=$a_telefonos_r[1];
				if ($a_telefonos_r[2]!='NULL') $fax_r=$a_telefonos_r[2];
				if ($a_telefonos_r[3]!='NULL') $otro_tel_r=$a_telefonos_r[3];
				
				$barrio_r=$directorioRetorna->getBarrio();
				
				$estado_r=$directorioRetorna->getEstado();
			}
			
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor]))." and c.cdi_lugar='COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu=$ciiuDirectorioRetorna->getCiiu();
			$principal=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version[$i]=$fila[ciu_version];
				$i++;
			}
			
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor]))." and c.cdi_lugar<>'COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu_ci=$ciiuDirectorioRetorna->getCiiu();
			$lug_ciiu_ci=$ciiuDirectorioRetorna->getLugar();
			$principal_ci=$ciiuDirectorioRetorna->getPrincipal();
			
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version_ci[$i]=$fila[ciu_version];
				$i++;
			}
			
			$this->DocProveedoresEntidad->setWhere(" and p.dpr_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$docProveedoresRetorna=$this->NegocioFacade->listarDocProveedores($this->DocProveedoresEntidad);
			
			$tipo_doc_pr=$docProveedoresRetorna->getTipoDocumento();
			$fecha_doc=$docProveedoresRetorna->getFechaDoc();
			$num_documento=$docProveedoresRetorna->getNumDocumento();
			$detalle=$docProveedoresRetorna->getDetalle();
			
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
			"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
			"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=$estado_d[0]");
			
			$datos_ant_p=base64_encode("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=$autorretenedor[0]; prv_gc=".
			"$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_p[0]; prv_tipo_regimen=".
			"$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
			
			$datos_ant_r=base64_encode("dir_identificacion=$identificacion_r[0]; dir_tipo_documento=$tipo_documento_r[0]; dir_lugar_documento=$ciudad_documento_r[0]; ".
			"dir_digito_v=$digito_v_r[0]; dir_tipo_persona=$tipo_persona_r[0]; dir_apellidos=$apellidos_r[0]; dir_nombres=$nombres_r[0]; dir_direccion=$direcciones_r[0]; ".
			"dir_telefono=$telefonos_r[0]; dir_correo=$correo_r[0]; dir_ciudad_direccion=$ciudad_r[0]; dir_barrio=$barrio_r[0]; dir_fecha_nac=$nac_r[0]; dir_lugar_nac=".
			"$ciudad_nac_r[0]; dir_estado=$estado_r[0]");
			
			for ($i=0;$i<count($ciiu);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[$i]; cdi_lugar=COL; cdi_principal=$principal[$i]");
			}
			
			for ($i=0;$i<count($ciiu_ci);$i++) {
				$datos_ant_ci_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu_ci[$i]; cdi_lugar=$lug_ciiu_ci[$i]; cdi_principal=$principal_ci[$i]");
			}
			
			for ($i=0;$i<count($tipo_doc_pr);$i++) {
				$datos_ant_do[$i]=base64_encode("dpr_identificacion=$identificacion[0]; dpr_tipo_documento=$tipo_doc_pr[$i]; dpr_fecha_doc=$fecha_doc[$i]; dpr_num_documento".
				"=$num_documento[$i]; dpr_detalle=$detalle[$i]");
			}
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_proveedores' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_p=$usuario[0];
			$fc_sis_mod_p=$fecha[0];
			
			if ($representante[0]!='') {
				$accion_r='M';
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$representante[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_r=$usuario[0];
				$fc_sis_mod_r=$fecha[0];
			} else {
				$accion_r='A';
				$usr_mod_r=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_r=date('Y-m-d H:i:s');
			}
			
			if ($ciiu[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave='$identificacion[0]##$ciiu[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci=$usuario[0];
				$fc_sis_mod_ci=$fecha[0];
			} else {
				$usr_mod_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci=date('Y-m-d H:i:s');
			}
			
			if ($ciiu_ci[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>".
				"'$identificacion[0]##$ciiu_ci[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci_ci=$usuario[0];
				$fc_sis_mod_ci_ci=$fecha[0];
			} else {
				$usr_mod_ci_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci_ci=date('Y-m-d H:i:s');
			}
			if ($tipo_doc_pr[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_doc_proveedores' and mt.mta_llave='$identificacion[0]##$tipo_doc_pr[0]##$fecha_doc[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_do=$usuario[0];
				$fc_sis_mod_do=$fecha[0];
			} else {
				$usr_mod_do=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_do=date('Y-m-d H:i:s');
			}
			
			
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$pais_documento_r[0]='COL';
			$pais_nac_r[0]='COL';
			$pais_domicilio_r='COL';
			$pais_correspondencia_r='COL';
			$pais_contacto_r='COL';
			$usr_mod_d=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod_d=date('Y-m-d H:i:s');
			$usr_mod_p=$usr_mod_d;
			$fc_sis_mod_p=$fc_sis_mod_d;
			$usr_mod_r=$usr_mod_d;
			$fc_sis_mod_r=$fc_sis_mod_d;
			$usr_mod_ci=$usr_mod_d;
			$fc_sis_mod_ci=$fc_sis_mod_d;
			$usr_mod_do=$usr_mod_d;
			$fc_sis_mod_do=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			
			$datos_ant_d=base64_encode("");
			
			$datos_ant_p=base64_encode("");
			
			$datos_ant_r=base64_encode("");
		}
		
		if ($accion=='M'&&$estado_p[0]=='I') $estado_p[0]='A';
		
		if ($accion=='I') {
			$estado_p[0]='I';
			$dis_n='readonly="readonly"';
		}
		
		include '../Ventanas/Auditoria/vProveedor.php';
	}
	
	function vInfoProveedor($accion) {
		$proveedor=base64_decode($_REQUEST[proveedor]);
	
		if ($accion!='A') {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			
			////////////// Arreglo tipo documento
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento[0]'");
			$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$tipo_documento=$parametrosRetorna->getDetalle();
			
			////////////// Arreglo lugar de expedicion de documento
				
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
				
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_documento=$lugaresRetorna->getNombre();
				
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_documento=$lugaresRetorna->getNombre();
				
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_documento[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_documento=$lugaresRetorna->getNombre();
			
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
			
			////////////// Arreglo lugar de nacimiento
		
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_nac=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_nac=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_nac[0]'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_nac=$lugaresRetorna->getNombre();
			
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
				
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
				
			if ($a_ciudad_domicilio[0]!='NULL') {
			$ciudad_domicilio=$a_ciudad_domicilio[0];
			$depto_domicilio=substr($ciudad_domicilio,0,5);
			$pais_domicilio=substr($ciudad_domicilio,0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_domicilio=$lugaresRetorna->getNombre();
			
			} else {
				$pais_domicilio='COL';
			}
				
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_correspondencia=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_correspondencia=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_correspondencia'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_correspondencia=$lugaresRetorna->getNombre();
						
			} else {
				$pais_correspondencia='COL';
			}
				
			
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
				
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_contacto=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_contacto=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_contacto'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_contacto=$lugaresRetorna->getNombre();
			} else {
				$pais_contacto='COL';
			}
				
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
				
			$barrio=$directorioRetorna->getBarrio();
				
			$estado_d=$directorioRetorna->getEstado();
				
			$this->ProveedoresEntidad->setWhere(" and p.prv_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$proveedorRetorna=$this->NegocioFacade->listarProveedores($this->ProveedoresEntidad);
			
			////////////// Arreglo tipo de sociedad
			$tipo_sociedad=$proveedorRetorna->getTipoSociedad();
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDSOC' and p.par_elemento='$tipo_sociedad[0]'");
			$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$tipo_sociedad=$parametrosRetorna->getDetalle();
			
			$tipo_regimen=$proveedorRetorna->getTipoRegimen();
			$autorretenedor=$proveedorRetorna->getAutorretenedor();
			$retenedor_iva=$proveedorRetorna->getRetenedorIva();
			$profesion_liberal=$proveedorRetorna->getProfesionLiberal();
			$ley_1429=$proveedorRetorna->getLey1429();
			$gc=$proveedorRetorna->getGc();
			$ciudad_s=$proveedorRetorna->getSucursal();
			$dir_s=$proveedorRetorna->getDirSucursal();
			$representante=$proveedorRetorna->getRepresentante();
				
			
			$ciudad_sucursal=$this->NegocioFacade->arSqlArPhp($ciudad_s[0]);
			for ($i=0;$i<count($ciudad_sucursal);$i++) {
			
				$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
				$pais_sucursal[$i]=substr($ciudad_sucursal[$i],0,3);
			
				if ($ciudad_sucursal[$i]!='NULL') {
						
					$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
					$pais_sucursal[$i]=substr($depto_sucursal[$i],0,3);
			
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_sucursal[$i]=$lugaresRetorna->getNombre();
			
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_sucursal[$i]=$lugaresRetorna->getNombre();
			
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_sucursal[$i]'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_sucursal[$i]=$lugaresRetorna->getNombre();
			
				} else {
					$pais_contacto='COL';
				}
			
			}
				
			$dir_sucursal=$this->NegocioFacade->arSqlArPhp($dir_s[0]);
				
			$estado_p=$proveedorRetorna->getEstado();
				
			if ($representante[0]!='') {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".$representante[0]);
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
	
				$identificacion_r=$directorioRetorna->getIdentificacion();
				$tipo_persona_r=$directorioRetorna->getTipoPersona();
				$digito_v_r=$directorioRetorna->getDigitoV();

				// arreglo tipo de documento representante
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento_r[0]'");
				$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
				$tipo_documento_r=$parametrosRetorna->getDetalle();
				
				// arreglo pais de expedicion
				
				$ciudad_documento_r=$directorioRetorna->getLugarDocumento();
				$depto_documento_r[0]=substr($ciudad_documento_r[0],0,5);
				$pais_documento_r[0]=substr($ciudad_documento_r[0],0,3);
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_documento_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_documento_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_documento_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_documento_r=$lugaresRetorna->getNombre();
	
				$nombres_r=$directorioRetorna->getNombres();
				$apellidos_r=$directorioRetorna->getApellidos();
				$nac_r=$directorioRetorna->getFechaNac();
				$correo_r=$directorioRetorna->getCorreo();
					
				$ciudad_nac_r=$directorioRetorna->getLugarNac();
				$depto_nac_r[0]=substr($ciudad_nac_r[0],0,5);
				$pais_nac_r[0]=substr($ciudad_nac_r[0],0,3);
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$ciudad_nac_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$depto_nac_r=$lugaresRetorna->getNombre();
					
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_nac_r[0]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$pais_nac_r=$lugaresRetorna->getNombre();			
				
				$direcciones_r=$directorioRetorna->getDireccion();
				$a_direcciones_r=$this->NegocioFacade->arSqlArPhp($direcciones_r[0]);
				if ($a_direcciones_r[0]!='NULL') $dir_residencia_r=$a_direcciones_r[0];
				if ($a_direcciones_r[1]!='NULL') $dir_correspondencia_r=$a_direcciones_r[1];
				if ($a_direcciones_r[2]!='NULL') $dir_contacto_r=$a_direcciones_r[2];
				
	///arreglo para traer los nombres de las ciudades de contactos
				
				$ciudad_r=$directorioRetorna->getCiudadDireccion();
				$a_ciudad_domicilio_r=$this->NegocioFacade->arSqlArPhp($ciudad_r[0]);
					
				if ($a_ciudad_domicilio_r[0]!='NULL') {
					$ciudad_domicilio_r=$a_ciudad_domicilio_r[0];
					$depto_domicilio_r=substr($ciudad_domicilio_r,0,5);
					$pais_domicilio_r=substr($ciudad_domicilio_r,0,3);
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_domicilio_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_domicilio_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_domicilio_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_domicilio_r=$lugaresRetorna->getNombre();
				
				} else {
					$pais_domicilio_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[1]!='NULL') {
					$ciudad_correspondencia_r=$a_ciudad_domicilio_r[1];
					$depto_correspondencia_r=substr($ciudad_correspondencia_r,0,5);
					$pais_correspondencia_r=substr($ciudad_correspondencia_r,0,3);
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_correspondencia_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_correspondencia_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_correspondencia_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_correspondencia_r=$lugaresRetorna->getNombre();
				
				} else {
					$pais_correspondencia_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[2]!='NULL') {
					$ciudad_contacto_r=$a_ciudad_domicilio_r[2];
					$depto_contacto_r=substr($ciudad_contacto_r,0,5);
					$pais_contacto_r=substr($ciudad_contacto_r,0,3);
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$ciudad_contacto_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$depto_contacto_r=$lugaresRetorna->getNombre();
				
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_contacto_r'");
					$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$pais_contacto_r=$lugaresRetorna->getNombre();
				
				} else {
					$pais_contacto_r='COL';
				}
	
				$telefonos_r=$directorioRetorna->getTelefono();
				$a_telefonos_r=$this->NegocioFacade->arSqlArPhp($telefonos_r[0]);
				if ($a_telefonos_r[0]!='NULL') $celular_r=$a_telefonos_r[0];
				if ($a_telefonos_r[1]!='NULL') $telefono_r=$a_telefonos_r[1];
				if ($a_telefonos_r[2]!='NULL') $fax_r=$a_telefonos_r[2];
				if ($a_telefonos_r[3]!='NULL') $otro_tel_r=$a_telefonos_r[3];
	
				$barrio_r=$directorioRetorna->getBarrio();
	
				$estado_r=$directorioRetorna->getEstado();
			}
				
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor]))." and c.cdi_lugar='COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
		///////////////////ciudad actividades Dian					
			$ciiu=$ciiuDirectorioRetorna->getCiiu();
			$principal=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version[$i]=$fila[ciu_version];
				$nn_ciiu[$i]=$fila[ciu_detalle];
				$nn_ciiu_ci[$i]=$fila[ciu_detalle];
				$i++;
			}
			
				
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor]))." and c.cdi_lugar<>'COL'");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
//////////////////////////////////////				
			
			$ciiu_ci=$ciiuDirectorioRetorna->getCiiu();
			$lug_ciiu_ci=$ciiuDirectorioRetorna->getLugar();
			
			
			$principal_ci=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version_ci[$i]=$fila[ciu_version];
				$this->LugaresEntidad->setWhere(" and l.lug_codigo='$fila[cdi_lugar]'");
				$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				$lug_ciiu_ci[$i]=$lugaresRetorna->getNombre();
				$i++;
			}
				
			$this->DocProveedoresEntidad->setWhere(" and p.dpr_identificacion=".str_replace(',', '', base64_decode($_REQUEST[proveedor])));
			$docProveedoresRetorna=$this->NegocioFacade->listarDocProveedores($this->DocProveedoresEntidad);
				
			$tipo_doc_pr=$docProveedoresRetorna->getTipoDocumento();
			
			$i=0;
			while ($fila=pg_fetch_assoc($docProveedoresRetorna->getResultado())){
				$tipo_doc_pr[$i]=$fila[par_detalle];
				$i++;
			}
			
			
			$fecha_doc=$docProveedoresRetorna->getFechaDoc();
			$num_documento=$docProveedoresRetorna->getNumDocumento();
			$detalle=$docProveedoresRetorna->getDetalle();
			
			$tipo_documento_r=$directorioRetorna->getTipoDocumento();
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento_r[0]'");
			$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$tipo_documento_r=$parametrosRetorna->getDetalle();
			
			
			
				
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
					"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
					"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
					"$ciudad_nac[0]; dir_estado=$estado_d[0]");
				
			$datos_ant_p=base64_encode("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=$autorretenedor[0]; prv_gc=".
					"$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_p[0]; prv_tipo_regimen=".
					"$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
				
			$datos_ant_r=base64_encode("dir_identificacion=$identificacion_r[0]; dir_tipo_documento=$tipo_documento_r[0]; dir_lugar_documento=$ciudad_documento_r[0]; ".
					"dir_digito_v=$digito_v_r[0]; dir_tipo_persona=$tipo_persona_r[0]; dir_apellidos=$apellidos_r[0]; dir_nombres=$nombres_r[0]; dir_direccion=$direcciones_r[0]; ".
					"dir_telefono=$telefonos_r[0]; dir_correo=$correo_r[0]; dir_ciudad_direccion=$ciudad_r[0]; dir_barrio=$barrio_r[0]; dir_fecha_nac=$nac_r[0]; dir_lugar_nac=".
					"$ciudad_nac_r[0]; dir_estado=$estado_r[0]");
				
			for ($i=0;$i<count($ciiu);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[$i]; cdi_lugar=COL; cdi_principal=$principal[$i]");
			}
				
			for ($i=0;$i<count($ciiu_ci);$i++) {
				$datos_ant_ci_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu_ci[$i]; cdi_lugar=$lug_ciiu_ci[$i]; cdi_principal=$principal_ci[$i]");
			}
				
			for ($i=0;$i<count($tipo_doc_pr);$i++) {
				$datos_ant_do[$i]=base64_encode("dpr_identificacion=$identificacion[0]; dpr_tipo_documento=$tipo_doc_pr[$i]; dpr_fecha_doc=$fecha_doc[$i]; dpr_num_documento".
						"=$num_documento[$i]; dpr_detalle=$detalle[$i]");
			}
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
	
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_proveedores' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_p=$usuario[0];
			$fc_sis_mod_p=$fecha[0];
				
			if ($representante[0]!='') {
				$accion_r='M';
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$representante[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_r=$usuario[0];
				$fc_sis_mod_r=$fecha[0];
			} else {
				$accion_r='A';
				$usr_mod_r=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_r=date('Y-m-d H:i:s');
			}
				
			if ($ciiu[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave='$identificacion[0]##$ciiu[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci=$usuario[0];
				$fc_sis_mod_ci=$fecha[0];
			} else {
				$usr_mod_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci=date('Y-m-d H:i:s');
			}
				
			if ($ciiu_ci[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>".
						"'$identificacion[0]##$ciiu_ci[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci_ci=$usuario[0];
				$fc_sis_mod_ci_ci=$fecha[0];
			} else {
				$usr_mod_ci_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci_ci=date('Y-m-d H:i:s');
			}
			if ($tipo_doc_pr[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_doc_proveedores' and mt.mta_llave='$identificacion[0]##$tipo_doc_pr[0]##$fecha_doc[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_do=$usuario[0];
				$fc_sis_mod_do=$fecha[0];
			} else {
				$usr_mod_do=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_do=date('Y-m-d H:i:s');
			}
				
				
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$pais_documento_r[0]='COL';
			$pais_nac_r[0]='COL';
			$pais_domicilio_r='COL';
			$pais_correspondencia_r='COL';
			$pais_contacto_r='COL';
			$usr_mod_d=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod_d=date('Y-m-d H:i:s');
			$usr_mod_p=$usr_mod_d;
			$fc_sis_mod_p=$fc_sis_mod_d;
			$usr_mod_r=$usr_mod_d;
			$fc_sis_mod_r=$fc_sis_mod_d;
			$usr_mod_ci=$usr_mod_d;
			$fc_sis_mod_ci=$fc_sis_mod_d;
			$usr_mod_do=$usr_mod_d;
			$fc_sis_mod_do=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
				
			$datos_ant_d=base64_encode("");
				
			$datos_ant_p=base64_encode("");
				
			$datos_ant_r=base64_encode("");
		}
	
		if ($accion=='M'&&$estado_p[0]=='I') $estado_p[0]='A';
	
		if ($accion=='I') {
			$estado_p[0]='I';
			$dis_n='readonly="readonly"';
		}
	
		include '../Ventanas/Auditoria/vInfoProveedor.php';
	}
	
	function vSubirMasivoProveedor($accion) {
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		include '../Ventanas/Auditoria/vSubirMasivoProveedor.php';
	}
	
	function vSubirMasivoCuentaPuc($accion) {
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		include '../Ventanas/Auditoria/vSubirMasivoCuentaPuc.php';
	}
	
	function vSubirMasivoCuentaPuc1($accion) {
		
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		if (base64_decode($_REQUEST[delimitador_campo])=='') {
			$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
			$mx_col=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestDataColumn());
			
			for ($i=0;$i<$mx_col;$i++) {
				if (base64_decode($_REQUEST[encabezados])=='true') {
					if (utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')
							->getValue())!='') $col[$i]=utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')->getValue());
					else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
					
				} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
				$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
			}
			
		} else {
			if (base64_decode($_REQUEST[delimitador_campo])=='{Tabuladores}') $del='	';
			else if (base64_decode($_REQUEST[delimitador_campo])=='{Espacio}') $del=' ';
			else $del=base64_decode($_REQUEST[delimitador_campo]);
			
			$fila=1;
			if (($gestor = fopen(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]), "r")) !== false) {
				if (($datos = fgetcsv($gestor, 1000, $del)) !== false) {
					for ($i=0;$i<count($datos);$i++) {
						if (base64_decode($_REQUEST[encabezados])=='true') {
							if ($datos[$i]!='') $col[$i]=$datos[$i];
							else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
					}
				}
				fclose($gestor);
			}
			
		}
		
		include '../Ventanas/Auditoria/vSubirMasivoCuentaPuc1.php';
	}
	
	function vSubirMasivoMovimiento1($accion) {
		
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		if (base64_decode($_REQUEST[delimitador_campo])=='') {
			$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
			$mx_col=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestDataColumn());
			
			for ($i=0;$i<$mx_col;$i++) {
				if (base64_decode($_REQUEST[encabezados])=='true') {
					if (utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')
							->getValue())!='') $col[$i]=utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')->getValue());
					else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
					
				} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
				$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
			}
			
		} else {
			if (base64_decode($_REQUEST[delimitador_campo])=='{Tabuladores}') $del='	';
			else if (base64_decode($_REQUEST[delimitador_campo])=='{Espacio}') $del=' ';
			else $del=base64_decode($_REQUEST[delimitador_campo]);
			
			$fila=1;
			if (($gestor = fopen(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]), "r")) !== false) {
				if (($datos = fgetcsv($gestor, 1000, $del)) !== false) {
					for ($i=0;$i<count($datos);$i++) {
						if (base64_decode($_REQUEST[encabezados])=='true') {
							if ($datos[$i]!='') $col[$i]=$datos[$i];
							else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
					}
				}
				fclose($gestor);
			}
			
		}
		$color=array('#e5f2ff','#fff2d9');
		include '../Ventanas/Auditoria/vSubirMasivoMovimiento1.php';
	}
	
	function vSubirMasivoSaldos1($accion) {
		
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		if (base64_decode($_REQUEST[delimitador_campo])=='') {
			$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
			$mx_col=PHPExcel_Cell::columnIndexFromString($objPHPExcel->getActiveSheet()->getHighestDataColumn());
			
			for ($i=0;$i<$mx_col;$i++) {
				if (base64_decode($_REQUEST[encabezados])=='true') {
					if (utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')
							->getValue())!='') $col[$i]=utf8_decode($objPHPExcel->getActiveSheet()->getCell(PHPExcel_Cell::stringFromColumnIndex($i).'1')->getValue());
					else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
					
				} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
				$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
			}
			
		} else {
			if (base64_decode($_REQUEST[delimitador_campo])=='{Tabuladores}') $del='	';
			else if (base64_decode($_REQUEST[delimitador_campo])=='{Espacio}') $del=' ';
			else $del=base64_decode($_REQUEST[delimitador_campo]);
			
			$fila=1;
			if (($gestor = fopen(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]), "r")) !== false) {
				if (($datos = fgetcsv($gestor, 1000, $del)) !== false) {
					for ($i=0;$i<count($datos);$i++) {
						if (base64_decode($_REQUEST[encabezados])=='true') {
							if ($datos[$i]!='') $col[$i]=$datos[$i];
							else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						} else $col[$i]='COLUMNA '.PHPExcel_Cell::stringFromColumnIndex($i);
						$cd_col[$i]=PHPExcel_Cell::stringFromColumnIndex($i);
					}
				}
				fclose($gestor);
			}
			
		}
		$color=array('#e5f2ff','#fff2d9');
		include '../Ventanas/Auditoria/vSubirMasivoSaldos1.php';
	}
	
	function vSubirMasivoMovimiento($accion) {
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		include '../Ventanas/Auditoria/vSubirMasivoMovimiento.php';
	}
	
	function vSubirMasivoSaldos($accion) {
		$usr_mod=base64_decode($_SESSION[ITZAudUs]);
		$fc_sis_mod=date('Y-m-d H:i:s');
		include '../Ventanas/Auditoria/vSubirMasivoSaldos.php';
	}
	
	function vPago($accion) {
		$pago=base64_decode($_REQUEST[pago]);
		
		if ($accion!='A') {
			$this->PagosEntidad->setWhere(" and p.pag_consecutivo=$pago");
			$pagoRetorna=$this->NegocioFacade->listarPagos($this->PagosEntidad);
			
			$no_pago=$pagoRetorna->getConsecutivo();
			$cliente=$pagoRetorna->getCliente();
			$proveedor=$pagoRetorna->getProveedor();
			$banco=$pagoRetorna->getBanco();
			$cta_bancaria=$pagoRetorna->getCtaBancaria();
			$tp_cuenta=$pagoRetorna->getTipoCuenta();
			$fecha_pago=$pagoRetorna->getFecha();
			$no_documento=$pagoRetorna->getNoDocumento();
			$vl_pago=$pagoRetorna->getVlPago();
			$obs_pago=$pagoRetorna->getObservaciones();
			$lug_pago=$pagoRetorna->getLugar();
			$ciudad_pago=$lug_pago[0];
			$depto_pago=substr($ciudad_pago,0,5);
			$pais_pago=substr($ciudad_pago,0,3);
			
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=$cliente[0]");
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
			$t_persona_cli=$directorioRetorna->getTipoPersona();
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			$t_ciudad_dom_cli=$a_ciudad_domicilio[0];
			
			$this->ClientesEntidad->setWhere(" and c.cli_identificacion=$cliente[0]");
			$clienteRetorna=$this->NegocioFacade->listarClientes($this->ClientesEntidad);
			$t_regimen_cli=$clienteRetorna->getTipoRegimen();
			$t_autoret_cli=$clienteRetorna->getAutorretenedor();
			$t_reteiva_cli=$clienteRetorna->getRetenedorIva();
			$t_gc_cli=$clienteRetorna->getGc();
			$t_rete_todos_cli=$clienteRetorna->getRetefuenteTodos();
			$t_ciudad_suc_cli=$clienteRetorna->getSucursal();
			
			$this->DetallePagosEntidad->setWhere(" and dp.dpa_pago=$pago");
			$detallePagoRetorna=$this->NegocioFacade->listarDetallePagos($this->DetallePagosEntidad);
			$cons_det_pago=$detallePagoRetorna->getConsecutivo();
			$bien_serv=$detallePagoRetorna->getBienServicio();
			$vl_det_pago=$detallePagoRetorna->getValor();
			$t_info=$detallePagoRetorna->getInfo();
			$i=0;
			while ($fila=pg_fetch_assoc($detallePagoRetorna->getResultado())){
				$t_cons_serv[$i]=$fila[bse_consecutivo];
				$t_det_serv[$i]=$fila[bse_detallado];
				$t_bien_serv[$i]=$fila[bse_bien_servicio];
				$t_retej[$i]=$fila[bse_pr_retefuentej];
				$t_reten[$i]=$fila[bse_pr_retefuenten];
				$t_uvt[$i]=$fila[bse_vl_uvt];
				$t_iva[$i]=$fila[bse_pr_iva];
				$t_consumo[$i]=$fila[bse_pr_consumo];
				$datos_ant_dp[$i]=base64_encode("dpa_pago=$fila[dpa_pago]; dpa_consecutivo=$fila[dpa_consecutivo]; dpa_bien_servicio=$fila[dpa_bien_servicio]; dpa_valor=".
				"$fila[dpa_valor]; dpa_info=$fila[dpa_info]");
				$i++;
			}
			
			$this->ImpuestoPagosEntidad->setWhere(" and ip.ipa_pago=$pago and p.par_caracter[0]='SUMA'");
			$this->ImpuestoPagosEntidad->setOrder("p.par_entero");
			
			$impuestoPagoRetorna=$this->NegocioFacade->listarImpuestoPagos($this->ImpuestoPagosEntidad);
			$i=0;
				
			while ($fila=pg_fetch_assoc($impuestoPagoRetorna->getResultado())){
				$cd_impue_s[$i]=$fila[ipa_impuesto];
				$ds_impue_s[$i]=$fila[par_detalle];
				$vl_impue_s[$i]=$fila[ipa_vl_impuesto];
				$ca_impue_s[$i]=$this->NegocioFacade->arSqlArPhp($fila[par_caracter]);
				$datos_ant_is[$i]=base64_encode("ipa_pago=$fila[ipa_pago]; ipa_impuesto=$fila[ipa_impuesto]; ipa_vl_impuesto=$fila[ipa_vl_impuesto];");
				$accion_is[$i]='M';
				$i++;
			}
			
			$this->ImpuestoPagosEntidad->setWhere(" and ip.ipa_pago=$pago and p.par_caracter[0]='RETENCION'");
			$this->ImpuestoPagosEntidad->setOrder("p.par_entero");
				
			$impuestoPagoRetorna=$this->NegocioFacade->listarImpuestoPagos($this->ImpuestoPagosEntidad);
			$i=0;
			
			while ($fila=pg_fetch_assoc($impuestoPagoRetorna->getResultado())){
				$cd_impue_r[$i]=$fila[ipa_impuesto];
				$ds_impue_r[$i]=$fila[par_detalle];
				$vl_impue_r[$i]=$fila[ipa_vl_impuesto];
				$ca_impue_r[$i]=$this->NegocioFacade->arSqlArPhp($fila[par_caracter]);
				$datos_ant_ir[$i]=base64_encode("ipa_pago=$fila[ipa_pago]; ipa_impuesto=$fila[ipa_impuesto]; ipa_vl_impuesto=$fila[ipa_vl_impuesto];");
				$accion_ir[$i]='M';
				$i++;
			}
			
			$this->DocPagosEntidad->setWhere(" and p.dpa_pago=$pago");
			$docPagosRetorna=$this->NegocioFacade->listarDocPagos($this->DocPagosEntidad);
			
			$cons_doc_pa=$docPagosRetorna->getConsecutivo();
			$tipo_doc_pa=$docPagosRetorna->getTipoDocumento();
			$num_documento_pa=$docPagosRetorna->getNumDocumento();
			$detalle_pa=$docPagosRetorna->getDetalle();
			
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=$proveedor[0]");
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
			
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
			
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
			
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			
			if ($a_ciudad_domicilio[0]!='NULL') {
				$ciudad_domicilio=$a_ciudad_domicilio[0];
				$depto_domicilio=substr($ciudad_domicilio,0,5);
				$pais_domicilio=substr($ciudad_domicilio,0,3);
			} else {
				$ciudad_domicilio='COL';
			}
			
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
			} else {
				$ciudad_correspondencia='COL';
			}
			
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
			} else {
				$ciudad_contacto='COL';
			}
			
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
			
			$barrio=$directorioRetorna->getBarrio();
			
			$estado_d=$directorioRetorna->getEstado();
			
			$this->ProveedoresEntidad->setWhere(" and p.prv_identificacion=$proveedor[0]");
			$proveedorRetorna=$this->NegocioFacade->listarProveedores($this->ProveedoresEntidad);
			$tipo_sociedad=$proveedorRetorna->getTipoSociedad();
			$tipo_regimen=$proveedorRetorna->getTipoRegimen();
			$autorretenedor=$proveedorRetorna->getAutorretenedor();
			$retenedor_iva=$proveedorRetorna->getRetenedorIva();
			$profesion_liberal=$proveedorRetorna->getProfesionLiberal();
			$ley_1429=$proveedorRetorna->getLey1429();
			$gc=$proveedorRetorna->getGc();
			$ciudad_s=$proveedorRetorna->getSucursal();
			$dir_s=$proveedorRetorna->getDirSucursal();
			$representante=$proveedorRetorna->getRepresentante();
			
			$ciudad_sucursal=$this->NegocioFacade->arSqlArPhp($ciudad_s[0]);
			for ($i=0;$i<count($ciudad_sucursal);$i++) {
				$depto_sucursal[$i]=substr($ciudad_sucursal[$i],0,5);
				$pais_sucursal[$i]=substr($ciudad_sucursal[$i],0,3);
			}
			
			$dir_sucursal=$this->NegocioFacade->arSqlArPhp($dir_s[0]);
			
			$estado_p=$proveedorRetorna->getEstado();
			
			if ($representante[0]!='') {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".$representante[0]);
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
				$identificacion_r=$directorioRetorna->getIdentificacion();
				$tipo_persona_r=$directorioRetorna->getTipoPersona();
				$digito_v_r=$directorioRetorna->getDigitoV();
				$tipo_documento_r=$directorioRetorna->getTipoDocumento();
				$ciudad_documento_r=$directorioRetorna->getLugarDocumento();
				$depto_documento_r[0]=substr($ciudad_documento_r[0],0,5);
				$pais_documento_r[0]=substr($ciudad_documento_r[0],0,3);
				
				$nombres_r=$directorioRetorna->getNombres();
				$apellidos_r=$directorioRetorna->getApellidos();
				$nac_r=$directorioRetorna->getFechaNac();
				$correo_r=$directorioRetorna->getCorreo();
					
				$ciudad_nac_r=$directorioRetorna->getLugarNac();
				$depto_nac_r[0]=substr($ciudad_nac_r[0],0,5);
				$pais_nac_r[0]=substr($ciudad_nac_r[0],0,3);
				
				$direcciones_r=$directorioRetorna->getDireccion();
				$a_direcciones_r=$this->NegocioFacade->arSqlArPhp($direcciones_r[0]);
				if ($a_direcciones_r[0]!='NULL') $dir_residencia_r=$a_direcciones_r[0];
				if ($a_direcciones_r[1]!='NULL') $dir_correspondencia_r=$a_direcciones_r[1];
				if ($a_direcciones_r[2]!='NULL') $dir_contacto_r=$a_direcciones_r[2];
				
				$ciudad_r=$directorioRetorna->getCiudadDireccion();
				$a_ciudad_domicilio_r=$this->NegocioFacade->arSqlArPhp($ciudad_r[0]);
				if ($a_ciudad_domicilio_r[0]!='NULL') {
					$ciudad_domicilio_r=$a_ciudad_domicilio_r[0];
					$depto_domicilio_r=substr($ciudad_domicilio_r,0,5);
					$pais_domicilio_r=substr($ciudad_domicilio_r,0,3);
				} else {
					$pais_domicilio_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[1]!='NULL') {
					$ciudad_correspondencia_r=$a_ciudad_domicilio_r[1];
					$depto_correspondencia_r=substr($ciudad_correspondencia_r,0,5);
					$pais_correspondencia_r=substr($ciudad_correspondencia_r,0,3);
				} else {
					$pais_correspondencia_r='COL';
				}
				
				if ($a_ciudad_domicilio_r[2]!='NULL') {
					$ciudad_contacto_r=$a_ciudad_domicilio_r[2];
					$depto_contacto_r=substr($ciudad_contacto_r,0,5);
					$pais_contacto_r=substr($ciudad_contacto_r,0,3);
				} else {
					$pais_contacto_r='COL';
				}
				
				$telefonos_r=$directorioRetorna->getTelefono();
				$a_telefonos_r=$this->NegocioFacade->arSqlArPhp($telefonos_r[0]);
				if ($a_telefonos_r[0]!='NULL') $celular_r=$a_telefonos_r[0];
				if ($a_telefonos_r[1]!='NULL') $telefono_r=$a_telefonos_r[1];
				if ($a_telefonos_r[2]!='NULL') $fax_r=$a_telefonos_r[2];
				if ($a_telefonos_r[3]!='NULL') $otro_tel_r=$a_telefonos_r[3];
				
				$barrio_r=$directorioRetorna->getBarrio();
				
				$estado_r=$directorioRetorna->getEstado();
			}
			
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$proveedor[0] and c.cdi_lugar='COL'");
			$this->CiiuDirectorioEntidad->setOrder("c.cdi_lugar,c.cdi_principal desc,c.cdi_ciiu");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu=$ciiuDirectorioRetorna->getCiiu();
			$principal=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())){
				$version[$i]=$fila[ciu_version];
				$i++;
			}
			$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$proveedor[0] and c.cdi_lugar<>'COL'");
			$this->CiiuDirectorioEntidad->setOrder("c.cdi_lugar,c.cdi_principal desc,c.cdi_ciiu");
			$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
			
			$ciiu_ci=$ciiuDirectorioRetorna->getCiiu();
			$lug_ciiu_ci=$ciiuDirectorioRetorna->getLugar();
			$principal_ci=$ciiuDirectorioRetorna->getPrincipal();
			$i=0;
			while ($fila=pg_fetch_assoc($ciiuDirectorioRetorna->getResultado())) {
				$tarifa_ci_ci[$i]=$fila[ciu_tarifa];
				$version_ci[$i]=$fila[ciu_version];
				$i++;
			}
			
			$this->DocProveedoresEntidad->setWhere(" and p.dpr_identificacion=$proveedor[0]");
			$docProveedoresRetorna=$this->NegocioFacade->listarDocProveedores($this->DocProveedoresEntidad);
			
			$tipo_doc_pr=$docProveedoresRetorna->getTipoDocumento();
			$fecha_doc=$docProveedoresRetorna->getFechaDoc();
			$num_documento=$docProveedoresRetorna->getNumDocumento();
			$detalle=$docProveedoresRetorna->getDetalle();
			
			$datos_ant_pg=base64_encode("pag_consecutivo=$pago; pag_cliente=$cliente[0]; pag_proveedor=$proveedor[0]; ".
			"pag_banco=$banco[0]; pag_cta_bancaria=$cta_bancaria[0]; pag_tipo_cuenta=$tp_cuenta[0]; pag_fecha=$fecha_pago[0]; pag_no_documento=$no_documento[0]; ".
			"pag_vl_pago=$vl_pago[0]; pag_observaciones=$obs_pago[0]; pag_lugar=$ciudad_pago[0]");
			
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
			"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
			"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=$estado_d[0]");
			
			$datos_ant_p=base64_encode("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=$autorretenedor[0]; prv_gc=".
			"$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_c[0]; prv_tipo_regimen=".
			"$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
			
			$datos_ant_r=base64_encode("dir_identificacion=$identificacion_r[0]; dir_tipo_documento=$tipo_documento_r[0]; dir_lugar_documento=$ciudad_documento_r[0]; ".
			"dir_digito_v=$digito_v_r[0]; dir_tipo_persona=$tipo_persona_r[0]; dir_apellidos=$apellidos_r[0]; dir_nombres=$nombres_r[0]; dir_direccion=$direcciones_r[0]; ".
			"dir_telefono=$telefonos_r[0]; dir_correo=$correo_r[0]; dir_ciudad_direccion=$ciudad_r[0]; dir_barrio=$barrio_r[0]; dir_fecha_nac=$nac_r[0]; dir_lugar_nac=".
			"$ciudad_nac_r[0]; dir_estado=$estado_r[0]");
			
			for ($i=0;$i<count($ciiu);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[$i]; cdi_lugar=COL; cdi_principal=$principal[$i]");
			}
			
			for ($i=0;$i<count($ciiu_ci);$i++) {
				$datos_ant_ci[$i]=base64_encode("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu_ci[$i]; cdi_lugar=$lug_ciiu_ci[$i]; cdi_principal=$principa_cil[$i]");
			}
			
			for ($i=0;$i<count($tipo_doc_pr);$i++) {
				$datos_ant_do[$i]=base64_encode("dpr_identificacion=$identificacion[0]; dpr_tipo_documento=$tipo_doc_pr[$i]; dpr_fecha_doc=$fecha_doc[$i]; dpr_num_documento".
				"=$num_documento[$i]; dpr_detalle=$detalle[$i]");
			}
			
			for ($i=0;$i<count($tipo_doc_pa);$i++) {
				$datos_ant_do_pa[$i]=base64_encode("dpa_pago=$pago; dpa_consecutivo=$cons_doc_pa[$i]; dpa_tipo_documento=$tipo_doc_pa[$i]; dpa_num_documento".
				"=$num_documento_pa[$i]; dpa_detalle=$detalle_pa[$i]");
			}
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_d=$usuario[0];
			$fc_sis_mod_d=$fecha[0];
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_pagos' and mt.mta_llave='$pago'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_pg=$usuario[0];
			$fc_sis_mod_pg=$fecha[0];
			$fc_mod=explode(' ', $fc_sis_mod_pg);
			
			if (!(base64_decode($_SESSION[ITZAudUs])==$usr_mod_pg&&$fc_mod[0]==date('Y-m-d'))) $dis_n='readonly="readonly"';
			
			if ($representante[0]!='') {
				$accion_r='M';
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_directorio' and mt.mta_llave='$representante[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_r=$usuario[0];
				$fc_sis_mod_r=$fecha[0];
			} else {
				$accion_r='A';
				$usr_mod_r=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_r=date('Y-m-d H:i:s');
			}
			
			if ($ciiu[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave='$identificacion[0]##$ciiu[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci=$usuario[0];
				$fc_sis_mod_ci=$fecha[0];
			} else {
				$usr_mod_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci=date('Y-m-d H:i:s');
			}
			
			if ($ciiu_ci[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>".
				"'$identificacion[0]##$ciiu_ci[0]##COL'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_ci_ci=$usuario[0];
				$fc_sis_mod_ci_ci=$fecha[0];
			} else {
				$usr_mod_ci_ci=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_ci_ci=date('Y-m-d H:i:s');
			}
			if ($tipo_doc_pr[0]!='') {
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_doc_proveedores' and mt.mta_llave='$identificacion[0]##$tipo_doc_pr[0]##$fecha_doc[0]'");
				$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
				$usuario=$modificadorTablasRetorna->getUsuario();
				$fecha=$modificadorTablasRetorna->getFechaHora();
				$usr_mod_do=$usuario[0];
				$fc_sis_mod_do=$fecha[0];
			} else {
				$usr_mod_do=base64_decode($_SESSION[ITZAudUs]);
				$fc_sis_mod_do=date('Y-m-d H:i:s');
			}
			
			
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$pais_documento_r[0]='COL';
			$pais_nac_r[0]='COL';
			$pais_domicilio_r='COL';
			$pais_correspondencia_r='COL';
			$pais_contacto_r='COL';
			$usr_mod_d=base64_decode($_SESSION[ITZAudUs]);
			$ciudad_pago='COL11001';
			$depto_pago='COL11';
			$pais_pago='COL';
			$fc_sis_mod_d=date('Y-m-d H:i:s');
			$usr_mod_p=$usr_mod_d;
			$fc_sis_mod_p=$fc_sis_mod_d;
			$usr_mod_r=$usr_mod_d;
			$fc_sis_mod_r=$fc_sis_mod_d;
			$usr_mod_ci=$usr_mod_d;
			$fc_sis_mod_ci=$fc_sis_mod_d;
			$usr_mod_do=$usr_mod_d;
			$fc_sis_mod_do=$fc_sis_mod_d;
			$usr_mod_ci_ci=$usr_mod_d;
			$fc_sis_mod_ci_ci=$fc_sis_mod_d;
			$usr_mod_pg=$usr_mod_d;
			$fc_sis_mod_pg=$fc_sis_mod_d;
			
			$datos_ant_d=base64_encode("");
			
			$datos_ant_p=base64_encode("");
			
			$datos_ant_r=base64_encode("");
			
			$this->ParametrosEntidad->setWhere(" and p.par_caracter[0]='SUMA' and p.par_caracter[2]='ACTIVO'");
			$this->ParametrosEntidad->setOrder("p.par_entero");
				
			$parametrosPagoRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$i=0;
			
			while ($fila=pg_fetch_assoc($parametrosPagoRetorna->getResultado())){
				$cd_impue_s[$i]=$fila[par_elemento];
				$ds_impue_s[$i]=$fila[par_detalle];
				$vl_impue_s[$i]=0;
				$ca_impue_s[$i]=$this->NegocioFacade->arSqlArPhp($fila[par_caracter]);
				$datos_ant_is[$i]=base64_encode("");
				$accion_is[$i]='A';
				$i++;
			}
				
			$this->ParametrosEntidad->setWhere(" and p.par_parametro='IMPUE' and p.par_caracter[0]='RETENCION' and p.par_caracter[2]='ACTIVO'");
			$this->ParametrosEntidad->setOrder("p.par_entero");
				
			$parametrosPagoRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
			$i=0;
			
			while ($fila=pg_fetch_assoc($parametrosPagoRetorna->getResultado())){
				$cd_impue_r[$i]=$fila[par_elemento];
				$ds_impue_r[$i]=$fila[par_detalle];
				$vl_impue_r[$i]=0;
				$ca_impue_r[$i]=$this->NegocioFacade->arSqlArPhp($fila[par_caracter]);
				$datos_ant_ir[$i]=base64_encode("");
				$accion_ir[$i]='A';
				$i++;
			}
		}
		
		$this->ParametrosEntidad->setWhere(" and p.par_parametro='PARSI' and p.par_elemento='UVT'");
		$this->ParametrosEntidad->setOrder("p.par_entero");
		
		$parametrosPagoRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
		$i=0;
		
		if ($fila=pg_fetch_assoc($parametrosPagoRetorna->getResultado())) $uvt=$this->NegocioFacade->arSqlArPhp($fila[par_entero]);
		
		if ($accion=='M'&&$estado_p[0]=='I') $estado_p[0]='A';
		
		if ($accion=='I') {
			$estado_p[0]='I';
			$dis_n='readonly="readonly"';
		}
		
		include '../Ventanas/Auditoria/vPago.php';
	}
	
	function vUsuario($accion) {
		$usuario=base64_decode($_REQUEST[usuario]);
		
		if ($accion!='A') {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$depto_documento[0]=substr($ciudad_documento[0],0,5);
			$pais_documento[0]=substr($ciudad_documento[0],0,3);
			if ($pais_documento[0]=='') $pais_documento[0]='COL';
			
			$nombres=$directorioRetorna->getNombres();
			$apellidos=$directorioRetorna->getApellidos();
			$nac=$directorioRetorna->getFechaNac();
			$correo=$directorioRetorna->getCorreo();
				
			$ciudad_nac=$directorioRetorna->getLugarNac();
			$depto_nac[0]=substr($ciudad_nac[0],0,5);
			$pais_nac[0]=substr($ciudad_nac[0],0,3);
			if ($pais_nac[0]=='') $pais_nac[0]='COL';
				
			$direcciones=$directorioRetorna->getDireccion();
			$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
			if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
			if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
			if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
				
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
				
			if ($a_ciudad_domicilio[0]!='NULL') {
				$ciudad_domicilio=$a_ciudad_domicilio[0];
				$depto_domicilio=substr($ciudad_domicilio,0,5);
				$pais_domicilio=substr($ciudad_domicilio,0,3);
			} else {
				$pais_domicilio='COL';
			}
				
			if ($a_ciudad_domicilio[1]!='NULL') {
				$ciudad_correspondencia=$a_ciudad_domicilio[1];
				$depto_correspondencia=substr($ciudad_correspondencia,0,5);
				$pais_correspondencia=substr($ciudad_correspondencia,0,3);
			} else {
				$pais_correspondencia='COL';
			}
				
			if ($a_ciudad_domicilio[2]!='NULL') {
				$ciudad_contacto=$a_ciudad_domicilio[2];
				$depto_contacto=substr($ciudad_contacto,0,5);
				$pais_contacto=substr($ciudad_contacto,0,3);
			} else {
				$pais_contacto='COL';
			}
				
			$telefonos=$directorioRetorna->getTelefono();
			$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
			if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
			if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
			if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
			if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
				
			$barrio=$directorioRetorna->getBarrio();
				
			$estado_d=$directorioRetorna->getEstado();
			
			$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
			$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
				
			$estado=$usuarioRetorna->getEstado();
			$tipo_usuario=$usuarioRetorna->getTipoUsuario();
			$clave=$usuarioRetorna->getClave();
			$requiere_cambio=$usuarioRetorna->getRequiereCambio();
			
			$this->ModulosEntidad->setOrder('mm.mme_codigo');
			$this->ModulosEntidad->setWhere(" and mm.mme_codigo>=0");
			$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
			$resultado=$modulosRetorna->getResultado();
				
			$i=0;
			while ($fila=pg_fetch_assoc($resultado)) {
				$modulo[$i]=$fila[mme_codigo];
				$nombre_m[$i]=$fila[mme_nombre];
				$mod_sup[$i]=$fila[par_detalle];
				$i++;
			}
			
			$this->RolesUsuariosEntidad->setWhere(" and ru.rus_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario]))." and ru.rus_empresa=-1");
			$rolesUsuariosRetorna=$this->NegocioFacade->listarRolesUsuarios($this->RolesUsuariosEntidad);
			$rol_s=$rolesUsuariosRetorna->getRol();
			$cliente_s=$rolesUsuariosRetorna->getEmpresa();
			$estado_s=$rolesUsuariosRetorna->getEstado();
			
			for ($i=0;$i<count($rol_s);$i++){
				$datos_ant_r_s[$i]=base64_encode("rus_rol=$rol_s[$i]; rus_usuario=$identificacion[0]; rus_empresa=$cliente_s[$i]; rus_estado=$estado_s[$i]");
				$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol=$rol_s[$i]");
				$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
				$resultado_rp=$rolesPermisosRetorna->getResultado();
				while ($fila_rp=pg_fetch_assoc($resultado_rp)) {
					$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_s[$i] and pe.pex_modulo=$fila_rp[rpe_modulo] and pe.pex_empresa=$cliente_s[$i] and ".
					"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
					$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
					$resultado_pe=$rolesPermisosExcepcionales->getResultado();
					if (pg_num_rows($resultado_pe)>0) {
						if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
							$accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]='M';
							$datos_ant_pe_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=base64_encode("pex_usuario=$fila_pe[pex_usuario]; pex_modulo=$fila_pe[pex_modulo]; ".
							"pex_empresa=$fila_pe[pex_empresa]; pex_rol=$fila_pe[pex_rol]; pex_consulta=$fila_pe[pex_consulta]; pex_adicionar=$fila_pe[pex_adicionar]; ".
							"pex_modificar=$fila_pe[pex_modificar]; pex_eliminar=$fila_pe[pex_eliminar]");
							$consultar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_consulta];
							$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_adicionar];
							$modificar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_modificar];
							$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_eliminar];
						}
					} else {
						$accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]='N';
						$datos_ant_pe_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=base64_encode("");
						$consultar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_consulta];
						$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_adicionar];
						$modificar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_modificar];
						$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_eliminar];
					}
				}
				
				for ($j=0;$j<count($modulo);$j++) {
					if ($accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=='') {
						$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_s[$i] and pe.pex_modulo=$modulo[$j] and pe.pex_empresa=$cliente_s[$i] and ".
								"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
						$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
						$resultado_pe=$rolesPermisosExcepcionales->getResultado();
						if (pg_num_rows($resultado_pe)>0) {
							if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
								$accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]='M';
								$datos_ant_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=base64_encode("pex_usuario=$fila_pe[pex_usuario]; pex_modulo=$fila_pe[pex_modulo]; ".
										"pex_empresa=$fila_pe[pex_empresa]; pex_rol=$fila_pe[pex_rol]; pex_consulta=$fila_pe[pex_consulta]; pex_adicionar=$fila_pe[pex_adicionar]; ".
										"pex_modificar=$fila_pe[pex_modificar]; pex_eliminar=$fila_pe[pex_eliminar]");
								$consultar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_consulta];
								$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_adicionar];
								$modificar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_modificar];
								$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$$modulo[$j]]=$fila_pe[pex_eliminar];
							}
						} else {
							$accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]='N';
							$datos_ant_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=base64_encode("");
							
						}
					}
				}
			}
			
			$this->RolesUsuariosEntidad->setWhere(" and ru.rus_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario]))." and ru.rus_empresa<>-1");
			$rolesUsuariosRetorna=$this->NegocioFacade->listarRolesUsuarios($this->RolesUsuariosEntidad);
			$rol_u=$rolesUsuariosRetorna->getRol();
			$cliente_u=$rolesUsuariosRetorna->getEmpresa();
			$estado_u=$rolesUsuariosRetorna->getEstado();
			
			for ($i=0;$i<count($rol_u);$i++) {
				$datos_ant_r_u[$i]=base64_encode("rus_rol=$rol_u[$i]; rus_usuario=$identificacion[0]; rus_empresa=$cliente_u[$i];".
				"rus_estado=$estado_u[$i]");
				
				$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol=$rol_u[$i]");
				$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
				$resultado_rp=$rolesPermisosRetorna->getResultado();
				while ($fila_rp=pg_fetch_assoc($resultado_rp)) {
					$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_u[$i] and pe.pex_modulo=$fila_rp[rpe_modulo] and pe.pex_empresa=$cliente_u[$i] and ".
					"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
					$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
					$resultado_pe=$rolesPermisosExcepcionales->getResultado();
					
					if (pg_num_rows($resultado_pe)>0) {
						if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
							$accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]='M';
							$datos_ant_pe_u[$rol_s[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=base64_encode("pex_usuario=$fila_pe[pex_usuario]; pex_modulo=$fila_pe[pex_modulo]; ".
							"pex_empresa=$fila_pe[pex_empresa]; pex_rol=$fila_pe[pex_rol]; pex_consulta=$fila_pe[pex_consulta]; pex_adicionar=$fila_pe[pex_adicionar]; ".
							"pex_modificar=$fila_pe[pex_modificar]; pex_eliminar=$fila_pe[pex_eliminar]");
							$consultar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_consulta];
							$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_adicionar];
							$modificar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_modificar];
							$eliminar_u[$rol_u[$i]][$cliente_u[$i]][$$fila_rp[rpe_modulo]]=$fila_pe[pex_eliminar];
						}
					} else {
						$accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]='N';
						$datos_ant_pe_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=base64_encode("");
						$consultar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_consulta];
						$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_adicionar];
						$modificar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_modificar];
						$eliminar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_eliminar];
					}
				}
				
				for ($j=0;$j<count($modulo);$j++) {
					if ($accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=='') {
						$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_u[$i] and pe.pex_modulo=$modulo[$j] and pe.pex_empresa=$cliente_u[$i] and ".
						"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
						$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
						$resultado_pe=$rolesPermisosExcepcionales->getResultado();
						if (pg_num_rows($resultado_pe)>0) {
							if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
								$accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]='M';
								$datos_ant_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=base64_encode("pex_usuario=$fila_pe[pex_usuario]; pex_modulo=$fila_pe[pex_modulo]; ".
								"pex_empresa=$fila_pe[pex_empresa]; pex_rol=$fila_pe[pex_rol]; pex_consulta=$fila_pe[pex_consulta]; pex_adicionar=$fila_pe[pex_adicionar]; ".
								"pex_modificar=$fila_pe[pex_modificar]; pex_eliminar=$fila_pe[pex_eliminar]");
								$consultar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_consulta];
								$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_adicionar];
								$modificar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_modificar];
								$eliminar_u[$rol_s[$i]][$cliente_u[$i]][$$modulo[$j]]=$fila_pe[pex_eliminar];
							}
						} else {
							$accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]='N';
							$datos_ant_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=base64_encode("");
						}
						
					}
				}
			}
			
			$datos_ant_d=base64_encode("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
			"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
			"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=$estado_d[0]");
				
			$datos_ant_u=base64_encode("usu_identificacion=$identificacion[0]; usu_correo=$correo[0]; usu_estado=$estado_u; usu_tipo_usuario=$tipo_usuario; ".
			"usu_clave=$clave; usu_requiere_cambio=$requiere_cambio");
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_usuarios' and mt.mta_llave='$identificacion[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod_u=$usuario[0];
			$fc_sis_mod_u=$fecha[0];
			
		} else {
			$accion_r='A';
			$pais_documento[0]='COL';
			$pais_nac[0]='COL';
			$pais_domicilio='COL';
			$pais_correspondencia='COL';
			$pais_contacto='COL';
			$usr_mod_u=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod_u=date('Y-m-d H:i:s');
			
			$datos_ant_d=base64_encode("");
			
			$datos_ant_u=base64_encode("");
			
		}
		
		if ($accion=='M'&&$estado_u[0]=='I') $estado_u[0]='A';
		
		if ($accion=='I') {
			$estado_u[0]='I';
			$dis_n='readonly="readonly"';
		}
		
		include '../Ventanas/Configuracion/vUsuario.php';
	}
	
	function vInfoUsuario($accion) {
		$usuario=str_replace(',', '', base64_decode($_REQUEST[usuario]));
		
		$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=$usuario");
		$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
		$identificacion=$directorioRetorna->getIdentificacion();
		$tipo_persona=$directorioRetorna->getTipoPersona();
		$digito_v=$directorioRetorna->getDigitoV();
		
		$tipo_documento=$directorioRetorna->getTipoDocumento();
		$this->ParametrosEntidad->setWhere(" and p.par_parametro='TDIDE' and p.par_elemento='$tipo_documento[0]'");
		$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
		$tipo_documento=$parametrosRetorna->getDetalle();
		
		$ciudad_documento=$directorioRetorna->getLugarDocumento();
		$depto_documento[0]=substr($ciudad_documento[0],0,5);
		$pais_documento[0]=substr($ciudad_documento[0],0,3);
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$ciudad_documento=$lugaresRetorna->getNombre();
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_documento[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$depto_documento=$lugaresRetorna->getNombre();
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_documento[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$pais_documento=$lugaresRetorna->getNombre();
		
		$nombres=$directorioRetorna->getNombres();
		$apellidos=$directorioRetorna->getApellidos();
		$nac=$directorioRetorna->getFechaNac();
		$correo=$directorioRetorna->getCorreo();
				
		$ciudad_nac=$directorioRetorna->getLugarNac();
		$depto_nac[0]=substr($ciudad_nac[0],0,5);
		$pais_nac[0]=substr($ciudad_nac[0],0,3);
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_nac[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$ciudad_nac=$lugaresRetorna->getNombre();
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_nac[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$depto_nac=$lugaresRetorna->getNombre();
		
		$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_nac[0]'");
		$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
		$pais_nac=$lugaresRetorna->getNombre();
		
		
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			
		if ($a_ciudad_domicilio[0]!='NULL') {
			$ciudad_domicilio=$a_ciudad_domicilio[0];
			$depto_domicilio=substr($ciudad_domicilio,0,5);
			$pais_domicilio=substr($ciudad_domicilio,0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_domicilio=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_domicilio'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_domicilio=$lugaresRetorna->getNombre();
			
		} else {
			$pais_domicilio='COL';
		}
			
		if ($a_ciudad_domicilio[1]!='NULL') {
			$ciudad_correspondencia=$a_ciudad_domicilio[1];
			$depto_correspondencia=substr($ciudad_correspondencia,0,5);
			$pais_correspondencia=substr($ciudad_correspondencia,0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_correspondencia'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_correspondencia=$lugaresRetorna->getNombre();
				
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_correspondencia'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_correspondencia=$lugaresRetorna->getNombre();
				
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_correspondencia'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_correspondencia=$lugaresRetorna->getNombre();
					
		} else {
			$pais_correspondencia='COL';
		}
			
		if ($a_ciudad_domicilio[2]!='NULL') {
			$ciudad_contacto=$a_ciudad_domicilio[2];
			$depto_contacto=substr($ciudad_contacto,0,5);
			$pais_contacto=substr($ciudad_contacto,0,3);
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_contacto'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$ciudad_contacto=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$depto_contacto'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$depto_contacto=$lugaresRetorna->getNombre();
			
			$this->LugaresEntidad->setWhere(" and l.lug_codigo='$pais_contacto'");
			$lugaresRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
			$pais_contacto=$lugaresRetorna->getNombre();
			
		} else {
			$pais_contacto='COL';
		}
		
		$direcciones=$directorioRetorna->getDireccion();
		$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
		if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
		if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
		if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
			
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
			
			
		$telefonos=$directorioRetorna->getTelefono();
		$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
		if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
		if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
		if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
		if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
			
		$barrio=$directorioRetorna->getBarrio();
			
		$estado_d=$directorioRetorna->getEstado();
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
			
		$estado=$usuarioRetorna->getEstado();
		$tipo_usuario=$usuarioRetorna->getTipoUsuario();
		$clave=$usuarioRetorna->getClave();
		$requiere_cambio=$usuarioRetorna->getRequiereCambio();
		
		$this->ModulosEntidad->setOrder('mm.mme_codigo');
		$this->ModulosEntidad->setWhere(" and mm.mme_codigo>=0");
		$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
		$resultado=$modulosRetorna->getResultado();
			
		$i=0;
		while ($fila=pg_fetch_assoc($resultado)) {
			$modulo[$i]=$fila[mme_codigo];
			$nombre_m[$i]=$fila[mme_nombre];
			$mod_sup[$i]=$fila[par_detalle];
			$i++;
		}
		
		$this->RolesUsuariosEntidad->setWhere(" and ru.rus_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario]))." and ru.rus_empresa=-1");
		$rolesUsuariosRetorna=$this->NegocioFacade->listarRolesUsuarios($this->RolesUsuariosEntidad);
		$rol_s=$rolesUsuariosRetorna->getRol();
		$cliente_s=$rolesUsuariosRetorna->getEmpresa();
		$estado_s=$rolesUsuariosRetorna->getEstado();
		
		for ($i=0;$i<count($rol_s);$i++){
			$this->RolesEntidad->setWhere("and r.rol_codigo = $rol_s[$i]");
			$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
			$nm_rol_s[$i]=$rolesRetorna->getNombre();
			$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
			$resultado_rp=$rolesPermisosRetorna->getResultado();
			while ($fila_rp=pg_fetch_assoc($resultado_rp)) {
				$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_s[$i] and pe.pex_modulo=$fila_rp[rpe_modulo] and pe.pex_empresa=$cliente_s[$i] and ".
				"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
				$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
				$resultado_pe=$rolesPermisosExcepcionales->getResultado();
				if (pg_num_rows($resultado_pe)>0) {
					if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
						$consultar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_consulta];
						$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_adicionar];
						$modificar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_modificar];
						$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_eliminar];
					}
				} else {
					$consultar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_consulta];
					$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_adicionar];
					$modificar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_modificar];
					$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_eliminar];
				}
			}
			
			for ($j=0;$j<count($modulo);$j++) {
				if ($accion_pe_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=='') {
					$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_s[$i] and pe.pex_modulo=$modulo[$j] and pe.pex_empresa=$cliente_s[$i] and ".
							"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
					$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
					$resultado_pe=$rolesPermisosExcepcionales->getResultado();
					if (pg_num_rows($resultado_pe)>0) {
						if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
							$consultar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_consulta];
							$adicionar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_adicionar];
							$modificar_s[$rol_s[$i]][$cliente_s[$i]][$modulo[$j]]=$fila_pe[pex_modificar];
							$eliminar_s[$rol_s[$i]][$cliente_s[$i]][$$modulo[$j]]=$fila_pe[pex_eliminar];
						}
					}
				}
			}
		}
		
		$this->RolesUsuariosEntidad->setWhere(" and ru.rus_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario]))." and ru.rus_empresa<>-1");
		$rolesUsuariosRetorna=$this->NegocioFacade->listarRolesUsuarios($this->RolesUsuariosEntidad);
		$rol_u=$rolesUsuariosRetorna->getRol();
		$cliente_u=$rolesUsuariosRetorna->getEmpresa();
		$estado_u=$rolesUsuariosRetorna->getEstado();
		
		for ($i=0;$i<count($rol_u);$i++) {
			
			$this->DirectorioEntidad->setWhere("and d.dir_identificacion = $cliente_u[$i]");
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			if($fila = pg_fetch_assoc($directorioRetorna->getResultado())) {
				$nm_cliente[$i]=$fila[nombres];
			}
			
			$this->RolesEntidad->setWhere("and r.rol_codigo = $rol_u[$i]");
			$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
			$nm_rol_s[$i]=$rolesRetorna->getNombre();
			
			$datos_ant_r_u[$i]=base64_encode("rus_rol=$rol_u[$i]; rus_usuario=$identificacion[0]; rus_empresa=$cliente_u[$i];".
			"rus_estado=$estado_u[$i]");
			
			$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol=$rol_u[$i]");
			$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
			$resultado_rp=$rolesPermisosRetorna->getResultado();
			while ($fila_rp=pg_fetch_assoc($resultado_rp)) {
				$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_u[$i] and pe.pex_modulo=$fila_rp[rpe_modulo] and pe.pex_empresa=$cliente_u[$i] and ".
				"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
				$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
				$resultado_pe=$rolesPermisosExcepcionales->getResultado();
				if (pg_num_rows($resultado_pe)>0) {
					if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
						$consultar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_consulta];
						$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_adicionar];
						$modificar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_pe[pex_modificar];
						$eliminar_u[$rol_u[$i]][$cliente_u[$i]][$$fila_rp[rpe_modulo]]=$fila_pe[pex_eliminar];
					}
				} else {
					$consultar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_consulta];
					$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_adicionar];
					$modificar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_modificar];
					$eliminar_u[$rol_u[$i]][$cliente_u[$i]][$fila_rp[rpe_modulo]]=$fila_rp[rpe_eliminar];
				}
			}
			
			for ($j=0;$j<count($modulo);$j++) {
				if ($accion_pe_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=='') {
					$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_rol=$rol_u[$i] and pe.pex_modulo=$modulo[$j] and pe.pex_empresa=$cliente_u[$i] and ".
					"pe.pex_usuario=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
					$rolesPermisosExcepcionales=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
					$resultado_pe=$rolesPermisosExcepcionales->getResultado();
					if (pg_num_rows($resultado_pe)>0) {
						if ($fila_pe=pg_fetch_assoc($resultado_pe)) {
							$consultar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_consulta];
							$adicionar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_adicionar];
							$modificar_u[$rol_u[$i]][$cliente_u[$i]][$modulo[$j]]=$fila_pe[pex_modificar];
							$eliminar_u[$rol_s[$i]][$cliente_u[$i]][$$modulo[$j]]=$fila_pe[pex_eliminar];
						}
					}
				}
			}
		}
		
		$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_usuarios' and mt.mta_llave='$identificacion[0]'");
		$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
		$usuario=$modificadorTablasRetorna->getUsuario();
		$fecha=$modificadorTablasRetorna->getFechaHora();
		$usr_mod_u=$usuario[0];
		$fc_sis_mod_u=$fecha[0];
		
		include '../Ventanas/Configuracion/vInfoUsuario.php';
	}
	
	function vCambioClave($accion) {
		$usuario=base64_decode($_SESSION[ITZAudUs]);
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=$usuario");
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$identificacion=$usuarioRetorna->getIdentificacion();
		$correo=$usuarioRetorna->getCorreo();
		$estado_u=$usuarioRetorna->getEstado();
		$tipo_usuario=$usuarioRetorna->getTipoUsuario();
		$clave=$usuarioRetorna->getClave();
		$requiere_cambio=$usuarioRetorna->getRequiereCambio();
		
		$datos_ant=base64_encode("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=$estado_u; usu_tipo_usuario=$tipo_usuario; usu_clave=$clave; ".
		"usu_requiere_cambio=$requiere_cambio");
		
		$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_usuarios' and mt.mta_llave='$identificacion'");
		$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
		$usuario=$modificadorTablasRetorna->getUsuario();
		$fecha=$modificadorTablasRetorna->getFechaHora();
		$usr_mod=$usuario[0];
		$fc_sis_mod=$fecha[0];
		
		include '../Ventanas/General/vCambioClave.php';
	}
	
	function vSalida() {
		include '../Ventanas/General/vSalida.php';
	}
	
	function vExportar() {
		include '../Ventanas/General/vExportar.php';
	}
	
	function vBienOServicio($accion) {
		$usuario=base64_decode($_REQUEST[usuario]);
	
		if ($accion!='A') {
			$this->BienServiciosEntidad->setWhere(" and bs.bse_consecutivo=".base64_decode($_REQUEST[bien_servicio]));
			$bienServiciosRetorna=$this->NegocioFacade->listarBienServicios($this->BienServiciosEntidad);
			
			$c_bien_servicio=$bienServiciosRetorna->getConsecutivo();
			$bien_servicio=$bienServiciosRetorna->getBienServicio();
			$pr_retefuentej=$bienServiciosRetorna->getPrRetefuentej();
			$pr_retefuenten=$bienServiciosRetorna->getPrRetefuenten();
			$vl_uvt=$bienServiciosRetorna->getVlUvt();
			$pr_iva=$bienServiciosRetorna->getPrIva();
			$pr_consumo=$bienServiciosRetorna->getPrConsumo();
			$detallado=$bienServiciosRetorna->getDetallado();
			
			$datos_ant_bs=base64_encode("bse_consecutivo=$c_bien_servicio[0]; bse_bien_servicio=$bien_servicio[0]; bse_pr_retefuentej=$pr_retefuentej[0]; ".
			"bse_pr_retefuenten=$pr_retefuenten[0]; bse_vl_uvt=$vl_uvt[0]; bse_pr_iva=$pr_iva[0]; bse_pr_consumo=$pr_consumo[0]; bse_detallado=$detallado[0]");
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_bien_servicios' and mt.mta_llave='$c_bien_servicio[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$uss_mod=$usuario[0];
			$fc_sis_moe=$fecha[0];
			
		} else {
			$usr_mod=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod=date('Y-m-d H:i:s');
			
			$eatos_ant_bs=base64_encode("");
			
		}
		
		include '../Ventanas/Auditoria/vBienOServicio.php';
	}
	
	function vInfoBienOServicio($accion) {
		$usuario=base64_decode($_REQUEST[usuario]);
	
		if ($accion!='A') {
			$this->BienServiciosEntidad->setWhere(" and bs.bse_consecutivo=".base64_decode($_REQUEST[bien_servicio]));
			$bienServiciosRetorna=$this->NegocioFacade->listarBienServicios($this->BienServiciosEntidad);
				
			$c_bien_servicio=$bienServiciosRetorna->getConsecutivo();
			$bien_servicio=$bienServiciosRetorna->getBienServicio();
			$pr_retefuentej=$bienServiciosRetorna->getPrRetefuentej();
			$pr_retefuenten=$bienServiciosRetorna->getPrRetefuenten();
			$vl_uvt=$bienServiciosRetorna->getVlUvt();
			$pr_iva=$bienServiciosRetorna->getPrIva();
			$pr_consumo=$bienServiciosRetorna->getPrConsumo();
			$detallado=$bienServiciosRetorna->getDetallado();
				
			$datos_ant_bs=base64_encode("bse_consecutivo=$c_bien_servicio[0]; bse_bien_servicio=$bien_servicio[0]; bse_pr_retefuentej=$pr_retefuentej[0]; ".
					"bse_pr_retefuenten=$pr_retefuenten[0]; bse_vl_uvt=$vl_uvt[0]; bse_pr_iva=$pr_iva[0]; bse_pr_consumo=$pr_consumo[0]; bse_detallado=$detallado[0]");
				
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_bien_servicios' and mt.mta_llave='$c_bien_servicio[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$uss_mod=$usuario[0];
			$fc_sis_moe=$fecha[0];
				
		} else {
			$usr_mod=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod=date('Y-m-d H:i:s');
				
			$eatos_ant_bs=base64_encode("");
				
		}
	
		include '../Ventanas/Auditoria/vInfoBienesServicios.php';
	}
	
	function vCuentaPuc($accion) {
		$usuario=base64_decode($_REQUEST[usuario]);
		
		if ($accion!='A') {
			$this->CuentaPucEntidad->setWhere(" and cp.cup_cliente=".base64_decode($_REQUEST[cliente])." and cp.cup_codigo='".base64_decode($_REQUEST[cuenta_puc])."'");
			$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
			
			$cliente=$cuentaPucRetorna->getCliente();
			$codigo=$cuentaPucRetorna->getCodigo();
			$nombre=$cuentaPucRetorna->getNombre();
			$ecuacion_patrimonial=$cuentaPucRetorna->getEcuacionPatrimonial();
			$nivel_detalle=$cuentaPucRetorna->getNivelDetalle();
			$naturaleza=$cuentaPucRetorna->getNaturaleza();
			$datos_ant=base64_encode("cup_cliente=$cliente[0]; cup_codigo=$codigo[0]; cup_nombre=$nombre[0]; cup_ecuacion_patrimonial=$ecuacion_patrimonial[0]; ".
			"cup_nivel_detalle=$nivel_detalle[0]; cup_naturaleza=$naturaleza[0]");
			
			$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_cuenta_puc' and mt.mta_llave='$cliente[0]##$codigo[0]'");
			$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
			$usuario=$modificadorTablasRetorna->getUsuario();
			$fecha=$modificadorTablasRetorna->getFechaHora();
			$usr_mod=$usuario[0];
			$fc_sis_mod=$fecha[0];
			
		} else {
			$usr_mod=base64_decode($_SESSION[ITZAudUs]);
			$fc_sis_mod=date('Y-m-d H:i:s');
			
			$datos_ant=base64_encode("");
			
		}
		
		include '../Ventanas/Auditoria/vCuentaPuc.php';
	}
	
	function vInfoCuentaPuc($accion) {
		$usuario=base64_decode($_REQUEST[usuario]);
		
		$this->CuentaPucEntidad->setWhere(" and cp.cup_cliente=".base64_decode($_REQUEST[cliente])." and cp.cup_codigo='".base64_decode($_REQUEST[cuenta_puc])."'");
		$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
		
		$cliente=$cuentaPucRetorna->getCliente();
		if ($fila=pg_fetch_assoc($cuentaPucRetorna->getResultado())) $nm_cliente=$fila[nombres];
		$codigo=$cuentaPucRetorna->getCodigo();
		$nombre=$cuentaPucRetorna->getNombre();
		$ecuacion_patrimonial=$cuentaPucRetorna->getEcuacionPatrimonial();
		$nivel_detalle=$cuentaPucRetorna->getNivelDetalle();
		$naturaleza=$cuentaPucRetorna->getNaturaleza();
		$datos_ant=base64_encode("cup_cliente=$cliente[0]; cup_codigo=$codigo[0]; cup_nombre=$nombre[0]; cup_ecuacion_patrimonial=$ecuacion_patrimonial[0]; ".
		"cup_nivel_detalle=$nivel_detalle[0]; cup_naturaleza=$naturaleza[0]");
		
		$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_cuenta_puc' and mt.mta_llave='$cliente[0]##$codigo[0]'");
		$modificadorTablasRetorna=$this->NegocioFacade->ultUsuarioFechaHora($this->ModificadorTablasEntidad);
		$usuario=$modificadorTablasRetorna->getUsuario();
		$fecha=$modificadorTablasRetorna->getFechaHora();
		$usr_mod=$usuario[0];
		$fc_sis_mod=$fecha[0];
		
		
		include '../Ventanas/Auditoria/vInfoCuentaPuc.php';
	}
	
	function vInfoMovimiento($accion) {
		$where.=" and m.mov_cliente=".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[cliente])))." and m.mov_anio_mes='".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[anio_mes])))."' and m.mov_numero_comprobante=".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[no_comprobante])))." and m.mov_codigo_comprobante='".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[cd_comprobante])))."'";
		
		$this->MovimientoEntidad->setWhere($where);
		
		$this->MovimientoEntidad->setOrder("m.mov_consecutivo");
		$movimientoRetorna=$this->NegocioFacade->listarMovimiento($this->MovimientoEntidad);
		
		$resultado=$movimientoRetorna->getResultado();
		
		if (pg_num_rows($resultado)>0) {
			$i=0;
			$tot_deb=0;
			$tot_cre=0;
			while ($filas=pg_fetch_assoc($resultado)) {
				$nm_cliente=$filas[nombres];
				$nm_comprobante=$filas[nm_comprobante];
				$no_comprobante=$filas[mov_numero_comprobante];
				$fc_comprobante=$this->NegocioFacade->formatCf($filas[mov_fecha_movimiento]);
				$usr_empresa=$filas[mov_usuario_empresa];
				$fc_empresa=$this->NegocioFacade->formatCf($filas[mov_fecha_empresa]);
				$cuenta_puc[$i]=$filas[cuenta_puc];
				$tercero[$i]=$filas[mov_tercero];
				$segundo_tercero[$i]=$filas[mov_segundo_tercero];
				$cencos[$i]=$filas[mov_centro_costo];
				$detalle[$i]=$filas[mov_detalle];
				$valor[$i]=$filas[mov_valor];
				$deb_cre[$i]=$filas[debito_credito];
				
				if ($filas[mov_naturaleza]=='D') $tot_deb+=$filas[mov_valor];
				else $tot_cre+=$filas[mov_valor];
				
				$i++;
			}
		}
		
		include '../Ventanas/Auditoria/vInfoMovimiento.php';
	}
}

$ventana = new Ventana();
$ventana->workflow(base64_decode($_REQUEST["ventana"]),base64_decode($_REQUEST["accion"]));
?>