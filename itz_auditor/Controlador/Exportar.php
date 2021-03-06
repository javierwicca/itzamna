<?php
namespace Controller;

header('Content-Type: text/html; charset=ISO-8859-1');
require_once '../Entidades/Auditoria/BienServiciosEntidad.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';
require_once '../Entidades/Auditoria/DetallePagosEntidad.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';
require_once '../Entidades/Auditoria/ImpuestoPagosEntidad.php';
require_once '../Entidades/Auditoria/PagosEntidad.php';
require_once '../Entidades/Auditoria/ProveedoresEntidad.php';
require_once '../Entidades/Configuracion/CiiuDirectorioEntidad.php';
require_once '../Entidades/Configuracion/ClientesEntidad.php';
require_once '../Entidades/Configuracion/DirectorioEntidad.php';
require_once '../Entidades/Configuracion/ModulosEntidad.php';
require_once '../Entidades/Configuracion/ParametrosEntidad.php';
require_once '../Entidades/Configuracion/RolesEntidad.php';
require_once '../Entidades/Configuracion/RolesPermisosEntidad.php';
require_once '../Entidades/Configuracion/UsuarioEntidad.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';
require_once '../Negocio/General/NegocioFacade.php';

use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\ClientesEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DetallePagosEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
use Entidades\ImpuestoPagosEntidad;
use Entidades\ModificadorTablasEntidad;
use Entidades\ModulosEntidad;
use Entidades\PagosEntidad;
use Entidades\ParametrosEntidad;
use Entidades\ProveedoresEntidad;
use Entidades\RolesEntidad;
use Entidades\RolesPermisosEntidad;
use Entidades\UsuarioEntidad;
use Negocio\NegocioFacade;

class Exportar{
	
	private $BienServiciosEntidad;
	private $CiiuDirectorioEntidad;
	private $ClientesEntidad;
	private $CuentaPucEntidad;
	private $DetallePagosEntidad;
	private $DirectorioEntidad;
	private $DocPagosEntidad;
	private $DocProveedoresEntidad;
	private $ImpuestoPagosEntidad;
	private $ModificadorTablasEntidad;
	private $ModulosEntidad;
	private $NegocioFacade;
	private $PagosEntidad;
	private $ParametrosEntidad;
	private $ProveedoresEntidad;
	private $RolesEntidad;
	private $RolesPermisosEntidad;
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
		if (!isset($this->ModificadorTablasEntidad)) $this->ModificadorTablasEntidad=new ModificadorTablasEntidad();
		if (!isset($this->ModulosEntidad)) $this->ModulosEntidad=new ModulosEntidad();
		if (!isset($this->NegocioFacade)) $this->NegocioFacade=new NegocioFacade();
		if (!isset($this->PagosEntidad)) $this->PagosEntidad=new PagosEntidad();
		if (!isset($this->ParametrosEntidad)) $this->ParametrosEntidad=new ParametrosEntidad();
		if (!isset($this->ProveedoresEntidad)) $this->ProveedoresEntidad=new ProveedoresEntidad();
		if (!isset($this->RolesEntidad)) $this->RolesEntidad=new RolesEntidad();
		if (!isset($this->RolesPermisosEntidad)) $this->RolesPermisosEntidad=new RolesPermisosEntidad();
		if (!isset($this->UsuarioEntidad)) $this->UsuarioEntidad=new UsuarioEntidad();
		
	}
	
	function workflow() {
		
		global $FechaInicio;
		
		if ($_REQUEST[fechaInicio]=='') $FechaInicio=date('YmdHisu');
		else $FechaInicio=$_REQUEST[fechaInicio];
		
		@session_name("ITZAudID-$FechaInicio");
		session_start();
		
		$pagina=explode('/',base64_decode($_SESSION[ITZAudPag]));
		
		$pagina[1]=str_replace('.php', '', $pagina[1]);
		
		$exportar_ac = new Exportar();
		$exportar_ac->$pagina[1]();
	}
	
	function roles() {
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if ($_REQUEST[list_t_nombre]!='') $where=" and r.rol_nombre ilike '%".pg_escape_string($_REQUEST[list_t_nombre])."%'";
		
		$this->RolesEntidad->setWhere($where);
		
		$this->RolesEntidad->setOrder("r.rol_estado,r.rol_nombre");
		$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
		
		$resultado=$rolesRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
		}
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Configuracion/roles.php";
	}
	
	function cuentaPuc() {
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if ($_REQUEST[list_t_cta_puc]!='') $where=" and cp.cup_codigo like '$_REQUEST[list_t_cta_puc]%'";
		if (base64_decode($_REQUEST[list_t_nombre_puc])!='') $where=" and cp.cup_nombre ilike '%".pg_escape_string($_REQUEST[list_t_nombre_puc])."%'";
		if (base64_decode($_REQUEST[list_t_nm_cliente])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else ".
				"d.dir_apellidos end) ilike '%".pg_escape_string($_REQUEST[list_t_nm_cliente])."%'";
		
		$this->CuentaPucEntidad->setWhere($where);
		
		$this->CuentaPucEntidad->setOrder("nombres,cp.cup_codigo");
		$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
		
		$resultado=$cuentaPucRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
		}
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Auditoria/cuentaPuc.php";
	}
	
	function clientes() {	
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if (base64_decode($_REQUEST[list_t_cliente])!='') $where=" and c.cli_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_cliente]));
		
		if (base64_decode($_REQUEST[list_t_nombre])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else ".
		"d.dir_apellidos end) ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre])))."%'";
		
		$this->ClientesEntidad->setWhere($where);
		
		$this->ClientesEntidad->setOrder("c.cli_estado,nombres");
		$clientesRetorna=$this->NegocioFacade->listarClientes($this->ClientesEntidad);
		
		$resultado=$clientesRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
		}
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Configuracion/clientes.php";
	}
	
	function Proveedores() {
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if (base64_decode($_REQUEST[list_t_proveedor])!='') $where=" and p.prv_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_proveedor]));		
		if (base64_decode($_REQUEST[list_t_nombre])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre])))."%'";
		
		$this->ProveedoresEntidad->setWhere($where);
		
		$this->ProveedoresEntidad->setOrder("p.prv_estado,nombres");
		$proveedoresRetorna=$this->NegocioFacade->listarProveedores($this->ProveedoresEntidad);
		
		$resultado=$proveedoresRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
			
		}
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Auditoria/proveedores.php";
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
			
			if (!(base64_decode($_SESSION[ITZAudUs])==$usr_mod_pg&&$fc_mod[0]==date('Y-m-d'))) $dis_n='disabled="disabled"';
			
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
				$this->ModificadorTablasEntidad->setWhere(" and mt.mta_tabla='iau_ciiu_directorio' and mt.mta_llave like '$identificacion[0]##$ciiu_ci[0]%' and mt.mta_llave<>
						'$identificacion[0]##$ciiu_ci[0]##COL'");
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
			$dis_n='disabled="disabled"';
		}
		
		include '../Ventanas/Auditoria/vPago.php';
	}
	
	function usuarios() {
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if (base64_decode($_REQUEST[list_t_usuario])!='') $where=" and u.usu_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_usuario]));
		
		if (base64_decode($_REQUEST[list_t_nombre])!='') $where.=" and d.dir_nombres||' '||d.dir_apellidos ilike '%".
				pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre])))."%'";
		
		$this->UsuarioEntidad->setWhere($where);
		$this->UsuarioEntidad->setOrder("u.usu_estado,nombres");
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
		}
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Configuracion/usuarios.php";
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
	
	function bienesServicios () {
		
		$tipo=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_tipo]));
		if ($_REQUEST[list_t_bien_serv]!='') $where=" and bs.bse_consecutivo=".$_REQUEST[list_t_bien_serv];
		if ($_REQUEST[list_t_bien_servicio]!='') $where.=" and bs.bse_bien_servicio ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp($_REQUEST[list_t_bien_servicio]))."%'";
		if ($_REQUEST[list_s_detallado]!='') $where.=" and bs.bse_detallado in (".$_REQUEST[list_s_detallado].")";
		
		$this->BienServiciosEntidad->setWhere($where);
		
		$this->BienServiciosEntidad->setOrder("bs.bse_bien_servicio");
		$bienServiciosRetorna=$this->NegocioFacade->listarBienServicios($this->BienServiciosEntidad);
		
		$resultado=$bienServiciosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $datos.="##";
				$datos.=implode('@@',$filas);
				$i++;
			}
		}
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) if ($filas=pg_fetch_assoc($resultado)) $nm_usr=ucwords(strtolower($filas[nombres]));
		
		include "../Exportar/$tipo/Auditoria/bienesServicios.php";
		
	}
}

$ventana = new Exportar();
$ventana->workflow();
?>