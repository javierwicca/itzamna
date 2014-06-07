<?php
namespace Controller;
setlocale(LC_CTYPE, 'es_ES');
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
require_once '../Entidades/Configuracion/ModulosEntidad.php';
require_once '../Entidades/Configuracion/PermisosExcepcionalesEntidad.php';
require_once '../Entidades/Configuracion/RolesEntidad.php';
require_once '../Entidades/Configuracion/RolesPermisosEntidad.php';
require_once '../Entidades/Configuracion/RolesUsuariosEntidad.php';
require_once '../Entidades/Configuracion/UsuarioEntidad.php';
require_once '../Entidades/General/CorreoEntidad.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';
require_once '../Negocio/General/NegocioFacade.php';
require_once '../PHPExcel/Classes/PHPExcel.php';
require_once '../PHPExcel/Classes/PHPExcel/Cell.php';
require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';

use DAO\ModificadorTablasDAO;
use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\ClientesEntidad;
use Entidades\CorreoEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DetallePagosEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
use Entidades\ImpuestoPagosEntidad;
use Entidades\ModificadorTablasEntidad;
use Entidades\ModulosEntidad;
use Entidades\MovimientoEntidad;
use Entidades\PagosEntidad;
use Entidades\PermisosExcepcionalesEntidad;
use Entidades\ProveedoresEntidad;
use Entidades\RolesEntidad;
use Entidades\RolesPermisosEntidad;
use Entidades\RolesUsuariosEntidad;
use Entidades\UsuarioEntidad;
use Negocio\NegocioFacade;
use PHPExcel;
use PHPExcel_Cell;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;

class AdicionarModificar{
	
	private $BienServiciosEntidad;
	private $CiiuDirectorioEntidad;
	private $ClientesEntidad;
	private $CorreoEntidad;
	private $CuentaPucEntidad;
	private $DirectorioEntidad;
	private $DetallePagosEntidad;
	private $DocPagosEntidad;
	private $DocProveedoresEntidad;
	private $ImpuestoPagosEntidad;
	private $NegocioFacade;
	private $ModificadorTablasEntidad;
	private $ModulosEntidad;
	private $MovimientoEntidad;
	private $PagosEntidad;
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
		if (!isset($this->CorreoEntidad)) $this->CorreoEntidad=new CorreoEntidad();
		if (!isset($this->CuentaPucEntidad)) $this->CuentaPucEntidad=new CuentaPucEntidad();
		if (!isset($this->DetallePagosEntidad)) $this->DetallePagosEntidad=new DetallePagosEntidad();
		if (!isset($this->DirectorioEntidad)) $this->DirectorioEntidad=new DirectorioEntidad();
		if (!isset($this->DocPagosEntidad)) $this->DocPagosEntidad=new DocPagosEntidad();
		if (!isset($this->DocProveedoresEntidad)) $this->DocProveedoresEntidad=new DocProveedoresEntidad();
		if (!isset($this->ImpuestoPagosEntidad)) $this->ImpuestoPagosEntidad=new ImpuestoPagosEntidad();
		if (!isset($this->ModificadorTablasEntidad)) $this->ModificadorTablasEntidad=new ModificadorTablasEntidad();
		if (!isset($this->ModulosEntidad)) $this->ModulosEntidad=new ModulosEntidad();
		if (!isset($this->MovimientoEntidad)) $this->MovimientoEntidad=new MovimientoEntidad();
		if (!isset($this->NegocioFacade)) $this->NegocioFacade=new NegocioFacade();
		if (!isset($this->PagosEntidad)) $this->PagosEntidad=new PagosEntidad();
		if (!isset($this->PermisosExcepcionalesEntidad)) $this->PermisosExcepcionalesEntidad=new PermisosExcepcionalesEntidad();
		if (!isset($this->ProveedoresEntidad)) $this->ProveedoresEntidad=new ProveedoresEntidad();
		if (!isset($this->RolesEntidad)) $this->RolesEntidad=new RolesEntidad();
		if (!isset($this->RolesPermisosEntidad)) $this->RolesPermisosEntidad=new RolesPermisosEntidad();
		if (!isset($this->RolesUsuariosEntidad)) $this->RolesUsuariosEntidad=new RolesUsuariosEntidad();
		if (!isset($this->UsuarioEntidad)) $this->UsuarioEntidad=new UsuarioEntidad();
	}
	
	function workflow($ventana) {
		
		global $FechaInicio;
		
		if ($_REQUEST[fechaInicio]=='') $FechaInicio=date('YmsHisu');
		else $FechaInicio=$_REQUEST[fechaInicio];
		
		@session_name("ITZAudID-$FechaInicio");
		session_start();
		
		$ventana_ac= new AdicionarModificar();
		$ventana_ac->$ventana();
	}
	
	function vRol() {
		$accion=base64_decode($_REQUEST["accion"]);
		
		$this->RolesEntidad->setIdx(0);
		$this->RolesEntidad->setCodigo(base64_decode($_REQUEST[rol]));
		$this->RolesEntidad->setNombre(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombre]))));
		$this->RolesEntidad->setEstado(pg_escape_string(base64_decode($_REQUEST[estado])));
		switch ($accion) {
			case 'A':
				$rolesRetorna=$this->NegocioFacade->adicionarRoles($this->RolesEntidad);
				break;
			
			case 'M':
				$rolesRetorna=$this->NegocioFacade->modificarRoles($this->RolesEntidad);
				break;
			
			case 'I':
				$rolesRetorna=$this->NegocioFacade->inactivarRoles($this->RolesEntidad);
				break;
		}
		
		if (is_string($rolesRetorna->getResultado())) {
			echo $rolesRetorna->getResultado();
			return;
		}
		
		$codigo=$rolesRetorna->getCodigo();
		$nombre=$rolesRetorna->getNombre();
		$estado=$rolesRetorna->getEstado();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_roles');
		$this->ModificadorTablasEntidad->setLlave($codigo[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant])));
		$this->ModificadorTablasEntidad->setDatosDespues("rol_codigo=$codigo[0]; rol_nombre=$nombre[0]; ror_estado=$estado[0]");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		for ($i=0;$i<count($_REQUEST[accion_rp]);$i++) {
			$this->RolesPermisosEntidad->setIdx(0);
			$this->RolesPermisosEntidad->setRol(base64_decode($_REQUEST[rol]));
			$this->RolesPermisosEntidad->setModulo(base64_decode($_REQUEST[modulo][$i]));
			$this->RolesPermisosEntidad->setConsulta(base64_decode($_REQUEST["c_lis_".($i+1)]));
			$this->RolesPermisosEntidad->setAdicionar(base64_decode($_REQUEST["c_add_".($i+1)]));
			$this->RolesPermisosEntidad->setModificar(base64_decode($_REQUEST["c_mod_".($i+1)]));
			$this->RolesPermisosEntidad->setEliminar(base64_decode($_REQUEST["c_ina_".($i+1)]));
			
			switch (base64_decode($_REQUEST[accion_rp][$i])) {
				case 'A':
					$rolesPermisosRetorna=$this->NegocioFacade->adicionarRolesPermisos($this->RolesPermisosEntidad);
					break;
						
				case 'M':
					$rolesPermisosRetorna=$this->NegocioFacade->modificarRolesPermisos($this->RolesPermisosEntidad);
					break;
						
			}
			
			if (is_string($rolesPermisosRetorna->getResultado())) {
				echo $rolesPermisosRetorna->getResultado();
				return;
			}
			
			$rol=$rolesPermisosRetorna->getRol();
			$modulo=$rolesPermisosRetorna->getModulo();
			$consulta=$rolesPermisosRetorna->getConsulta();
			$adicionar=$rolesPermisosRetorna->getAdicionar();
			$modificar=$rolesPermisosRetorna->getModificar();
			$eliminar=$rolesPermisosRetorna->getEliminar();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_roles_permisos');
			$this->ModificadorTablasEntidad->setLlave("$rol[0]##$modulo[0]");
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_rp][$i])));
			$this->ModificadorTablasEntidad->setDatosDespues("rpe_rol=$rol[0]; rpe_modulo=$modulo[0]; rpe_consulta=$consulta[0]; rpe_adicionar=$adicionar[0]; rpe_modificar=".
			"$modificar[0]; rpe_eliminar=$eliminar[0]");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
			
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
			
		}
		
	}
	
	function vCliente() {
		$accion_d=base64_decode($_REQUEST["accion_d"]);
		$this->DirectorioEntidad->setIdx(0);
		$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento]))));
		$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento]))));
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))!='NaN') {
			$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))));
		} else {
			$this->DirectorioEntidad->setDigitoV('');
		}
		
		$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))));
		if (base64_decode($_REQUEST[tipo_persona])=='N')
			$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos]))));
		else $this->DirectorioEntidad->setApellidos('');
		
		$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))!='')
			$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))).'"';
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))).'"';
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))).'"';
		else $direccion[2]='null';
		
		$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular]))!='')
			$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular])));
		else $telefono[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono]))!='')
			$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono])));
		else $telefono[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax]))!='')
			$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax])));
		else $telefono[2]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel]))!='')
			$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel])));
		else $telefono[3]='null';
		
		$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
		
		$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio]))!='')
			$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio])));
		else $ciudad[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia]))!='')
			$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia])));
		else $ciudad[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto]))!='')
			$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto])));
		else $ciudad[2]='null';
		
		$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
		
		$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac])))));
		$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac]))));
		$this->DirectorioEntidad->setEstado('A');
		
		switch ($accion_d) {
			case 'A':
				$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
				break;
				
			case 'M':
			case 'I':
				$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
				break;
				
		}
		
		if (is_string($directorioRetorna->getResultado())) {
			echo $directorioRetorna->getResultado();
			return;
		}
		
		$identificacion=$directorioRetorna->getIdentificacion();
		$tipo_documento=$directorioRetorna->getTipoDocumento();
		$ciudad_documento=$directorioRetorna->getLugarDocumento();
		$digito_v=$directorioRetorna->getDigitoV();
		$tipo_persona=$directorioRetorna->getTipoPersona();
		$apellidos=$directorioRetorna->getApellidos();
		$nombres=$directorioRetorna->getNombres();
		$direcciones=$directorioRetorna->getApellidos();
		$telefonos=$directorioRetorna->getTelefono();
		$correo=$directorioRetorna->getCorreo();
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$barrio=$directorioRetorna->getBarrio();
		$nac=$directorioRetorna->getFechaNac();
		$ciudad_nac=$directorioRetorna->getLugarNac();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_directorio');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_d])));
		$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
		"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
		"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac".
		"=$ciudad_nac[0]; dir_estado=A");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		$accion_c=base64_decode($_REQUEST["accion_c"]);
		
		$this->ClientesEntidad->setIdx(0);
		$this->ClientesEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->ClientesEntidad->setTipoSociedad(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_sociedad]))));
		$this->ClientesEntidad->setAutorretenedor(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[autorretenedor]))));
		$this->ClientesEntidad->setGc(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[gc]))));
		$this->ClientesEntidad->setRetefuenteTodos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[retefuente_todos]))));
		
		$j=0;
		for ($i=1;$i<=base64_decode($_REQUEST[filas_suc]);$i++) {
			if (base64_decode($_REQUEST["v_suc_$i"])=='S') {
				$dir_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["dir_sucursal_$i"])));
				$ciu_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_sucursal_$i"])));
		
				$j++;
			}
		}
		
		$this->ClientesEntidad->setSucursal($this->NegocioFacade->arPhpArSql($ciu_suc));
		$this->ClientesEntidad->setDirSucursal($this->NegocioFacade->arPhpArSql($dir_suc));
		$this->ClientesEntidad->setRepresentante(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
		$this->ClientesEntidad->setTipoRegimen(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_regimen]))));
		$this->ClientesEntidad->setRetenedorIva(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[retenedor_iva]))));
		$this->ClientesEntidad->setEstado(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[estado]))));
		
		switch ($accion_c) {
			case 'A':
				$clientesRetorna=$this->NegocioFacade->adicionarClientes($this->ClientesEntidad);
				break;
				
			case 'M':
				$clientesRetorna=$this->NegocioFacade->modificarClientes($this->ClientesEntidad);
				break;
				
			case 'I':
				$clientesRetorna=$this->NegocioFacade->inactivarClientes($this->ClientesEntidad);
				break;
		}
		
		if (is_string($clientesRetorna->getResultado())) {
			echo $clientesRetorna->getResultado();
			return;
		}
		
		$identificacion=$clientesRetorna->getIdentificacion();
		$tipo_sociedad=$clientesRetorna->getTipoSociedad();
		$autorretenedor=$clientesRetorna->getAutorretenedor();
		$gc=$clientesRetorna->getGc();
		$ciudad_s=$clientesRetorna->getSucursal();
		$dir_s=$clientesRetorna->getDirSucursal();
		$representante=$clientesRetorna->getRepresentante();
		$estado_c=$clientesRetorna->getEstado();
		$tipo_regimen=$clientesRetorna->getTipoRegimen();
		$retenedor_iva=$clientesRetorna->getAutorretenedor();
		$retefuente_todos=$clientesRetorna->getRetefuenteTodos();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_clientes');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_c])));
		$this->ModificadorTablasEntidad->setDatosDespues("cli_identificacion=$identificacion[0]; cli_tipo_sociedad=$tipo_sociedad[0]; cli_autorretenedor=".
		"$autorretenedor[0]; cli_gc=$gc[0]; cli_sucursal=$ciudad_s[0]; cli_dir_sucursal=$dir_s[0]; cli_representante=$representante[0]; cli_estado=$estado_c[0]; ".
		"cli_tipo_regimen=$tipo_regimen[0]; cli_retenedor_iva=$retenedor_iva[0]; cli_retefuente_todos=$retefuente_todos[0]");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))=='J'&&str_replace('', ',', base64_decode($_REQUEST[identificacion_r]))!='') {
			$accion_r=base64_decode($_REQUEST["accion_r"]);
			$this->DirectorioEntidad->setIdx(0);
			$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
			$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento_r]))));
			$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento_r]))));
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))!='NaN') {
				$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))));
			} else {
				$this->DirectorioEntidad->setDigitoV('');
			}
			
			$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona_r]))));
			if (base64_decode($_REQUEST[tipo_persona_r])=='N')
				$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos_r]))));
			else $this->DirectorioEntidad->setApellidos('');
			$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres_r]))));
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))!='')
				$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))).'"';
			else $direccion[0]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))!='')
				$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))).'"';
			else $direccion[1]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))!='')
				$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))).'"';
			else $direccion[2]='null';
			
			$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r]))!='')
				$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r])));
			else $telefono[0]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r]))!='')
				$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r])));
			else $telefono[1]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r]))!='')
				$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r])));
			else $telefono[2]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r]))!='')
				$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r])));
			else $telefono[3]='null';
			
			$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
			
			$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo_r]))));
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r]))!='')
				$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r])));
			else $ciudad[0]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r]))!='')
				$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r])));
			else $ciudad[1]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r]))!='')
				$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r])));
			else $ciudad[2]='null';
			
			$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
			
			$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac_r])))));
			$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac_r]))));
			$this->DirectorioEntidad->setEstado('A');
			
			switch ($accion_r) {
				case 'A':
					$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
					break;
					
				case 'M':
				case 'I':
					$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
					break;
						
			}
			
			if (is_string($directorioRetorna->getResultado())) {
				echo $directorioRetorna->getResultado();
				return;
			}
				
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$apellidos=$directorioRetorna->getApellidos();
			$nombres=$directorioRetorna->getNombres();
			$direcciones=$directorioRetorna->getApellidos();
			$telefonos=$directorioRetorna->getTelefono();
			$correo=$directorioRetorna->getCorreo();
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$barrio=$directorioRetorna->getBarrio();
			$nac=$directorioRetorna->getFechaNac();
			$ciudad_nac=$directorioRetorna->getLugarNac();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_directorio');
			$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_r])));
			$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
			"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
			"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; ".
			"dir_lugar_nac=$ciudad_nac[0]; dir_estado=A");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
			
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_$i"])=='S') {
				$accion_ci=base64_decode($_REQUEST["accion_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar('COL');
				if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))==$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal"]))){
					$this->CiiuDirectorioEntidad->setPrincipal('t');
				} else {
					$this->CiiuDirectorioEntidad->setPrincipal('f');
				}
				
				switch ($accion_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu_ci]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_ci_$i"])=='S') {
				$accion_ci_ci=base64_decode($_REQUEST["accion_ci_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setPrincipal(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal_ci_$i"]))));
				
				switch ($accion_ci_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
	}
	
	function vProveedor() {
		$accion_d=base64_decode($_REQUEST["accion_d"]);
		$this->DirectorioEntidad->setIdx(0);
		$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento]))));
		$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento]))));
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))!='NaN') {
			$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))));
		} else {
			$this->DirectorioEntidad->setDigitoV('');
		}
		$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))));
		if (base64_decode($_REQUEST[tipo_persona])=='N')
			$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos]))));
		else $this->DirectorioEntidad->setApellidos('');
		$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))!='')
			$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))).'"';
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))).'"';
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))).'"';
		else $direccion[2]='null';
		
		$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular]))!='')
			$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular])));
		else $telefono[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono]))!='')
			$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono])));
		else $telefono[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax]))!='')
			$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax])));
		else $telefono[2]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel]))!='')
			$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel])));
		else $telefono[3]='null';
		
		$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
		
		$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio]))!='')
			$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio])));
		else $ciudad[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia]))!='')
			$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia])));
		else $ciudad[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto]))!='')
			$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto])));
		else $ciudad[2]='null';
		
		$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
		
		$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac])))));
		$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac]))));
		$this->DirectorioEntidad->setEstado('A');
		
		switch ($accion_d) {
			case 'A':
				$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
				break;
				
			case 'M':
			case 'I':
				$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
				break;
				
		}
		
		if (is_string($directorioRetorna->getResultado())) {
			echo $directorioRetorna->getResultado();
			return;
		}
		
		$identificacion=$directorioRetorna->getIdentificacion();
		$tipo_documento=$directorioRetorna->getTipoDocumento();
		$ciudad_documento=$directorioRetorna->getLugarDocumento();
		$digito_v=$directorioRetorna->getDigitoV();
		$tipo_persona=$directorioRetorna->getTipoPersona();
		$apellidos=$directorioRetorna->getApellidos();
		$nombres=$directorioRetorna->getNombres();
		$direcciones=$directorioRetorna->getApellidos();
		$telefonos=$directorioRetorna->getTelefono();
		$correo=$directorioRetorna->getCorreo();
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$barrio=$directorioRetorna->getBarrio();
		$nac=$directorioRetorna->getFechaNac();
		$ciudad_nac=$directorioRetorna->getLugarNac();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_directorio');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_d])));
		$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
		"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
		"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac".
		"=$ciudad_nac[0]; dir_estado=A");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		$accion_p=base64_decode($_REQUEST["accion_p"]);
		
		$this->ProveedoresEntidad->setIdx(0);
		$this->ProveedoresEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->ProveedoresEntidad->setTipoSociedad(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_sociedad]))));
		$this->ProveedoresEntidad->setAutorretenedor(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[autorretenedor]))));
		$this->ProveedoresEntidad->setGc(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[gc]))));
		$this->ProveedoresEntidad->setProfesionLiberal(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[profesion_liberal]))));
		$this->ProveedoresEntidad->setLey1429(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ley_1429]))));
		
		$j=0;
		for ($i=1;$i<=base64_decode($_REQUEST[filas_suc]);$i++) {
			if (base64_decode($_REQUEST["v_suc_$i"])=='S') {
				$dir_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["dir_sucursal_$i"])));
				$ciu_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_sucursal_$i"])));
				
				$j++;
			}
		}
		
		$this->ProveedoresEntidad->setSucursal($this->NegocioFacade->arPhpArSql($ciu_suc));
		$this->ProveedoresEntidad->setDirSucursal($this->NegocioFacade->arPhpArSql($dir_suc));
		$this->ProveedoresEntidad->setRepresentante(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
		$this->ProveedoresEntidad->setTipoRegimen(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_regimen]))));
		$this->ProveedoresEntidad->setRetenedorIva(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[retenedor_iva]))));
		$this->ProveedoresEntidad->setEstado(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[estado]))));
		
		switch ($accion_p) {
			case 'A':
				$proveedoresRetorna=$this->NegocioFacade->adicionarProveedores($this->ProveedoresEntidad);
				break;
				
			case 'M':
				$proveedoresRetorna=$this->NegocioFacade->modificarProveedores($this->ProveedoresEntidad);
				break;
				
			case 'I':
				$proveedoresRetorna=$this->NegocioFacade->inactivarProveedores($this->ProveedoresEntidad);
				break;
		}
		
		if (is_string($proveedoresRetorna->getResultado())) {
			echo $proveedoresRetorna->getResultado();
			return;
		}
		
		$identificacion=$proveedoresRetorna->getIdentificacion();
		$tipo_sociedad=$proveedoresRetorna->getTipoSociedad();
		$autorretenedor=$proveedoresRetorna->getAutorretenedor();
		$gc=$proveedoresRetorna->getGc();
		$ciudad_s=$proveedoresRetorna->getSucursal();
		$dir_s=$proveedoresRetorna->getDirSucursal();
		$representante=$proveedoresRetorna->getRepresentante();
		$estado_c=$proveedoresRetorna->getEstado();
		$tipo_regimen=$proveedoresRetorna->getTipoRegimen();
		$retenedor_iva=$proveedoresRetorna->getAutorretenedor();
		$profesion_liberal=$proveedoresRetorna->getProfesionLiberal();
		$ley_1429=$proveedoresRetorna->getLey1429();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_proveedores');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_p])));
		$this->ModificadorTablasEntidad->setDatosDespues("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=".
		"$autorretenedor[0]; prv_gc=$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_c[0]; ".
		"prv_tipo_regimen=$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))=='J'&&str_replace('', ',', base64_decode($_REQUEST[identificacion_r]))!='') {
			$accion_r=base64_decode($_REQUEST["accion_r"]);
			$this->DirectorioEntidad->setIdx(0);
			$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
			$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento_r]))));
			$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento_r]))));
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))!='NaN') {
				$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))));
			} else {
				$this->DirectorioEntidad->setDigitoV('');
			}
			$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona_r]))));
			if (base64_decode($_REQUEST[tipo_persona_r])=='N')
				$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos_r]))));
			else $this->DirectorioEntidad->setApellidos('');
			$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres_r]))));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))!='')
				$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))).'"';
			else $direccion[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))!='')
				$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))).'"';
			else $direccion[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))!='')
				$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))).'"';
			else $direccion[2]='null';
				
			$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r]))!='')
				$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r])));
			else $telefono[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r]))!='')
				$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r])));
			else $telefono[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r]))!='')
				$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r])));
			else $telefono[2]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r]))!='')
				$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r])));
			else $telefono[3]='null';
				
			$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
				
			$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo_r]))));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r]))!='')
				$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r])));
			else $ciudad[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r]))!='')
				$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r])));
			else $ciudad[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r]))!='')
				$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r])));
			else $ciudad[2]='null';
				
			$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
				
			$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac_r])))));
			$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac_r]))));
			$this->DirectorioEntidad->setEstado('A');
				
			switch ($accion_r) {
				case 'A':
					$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
					break;
						
				case 'M':
				case 'I':
					$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
					break;
						
			}
			
			if (is_string($directorioRetorna->getResultado())) {
				echo $directorioRetorna->getResultado();
				return;
			}
			
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$apellidos=$directorioRetorna->getApellidos();
			$nombres=$directorioRetorna->getNombres();
			$direcciones=$directorioRetorna->getApellidos();
			$telefonos=$directorioRetorna->getTelefono();
			$correo=$directorioRetorna->getCorreo();
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$barrio=$directorioRetorna->getBarrio();
			$nac=$directorioRetorna->getFechaNac();
			$ciudad_nac=$directorioRetorna->getLugarNac();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_directorio');
			$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_r])));
			$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
			"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
			"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=A");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_$i"])=='S') {
				$accion_ci=base64_decode($_REQUEST["accion_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar('COL');
				if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))==$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal"]))){
					$this->CiiuDirectorioEntidad->setPrincipal('t');
				} else {
					$this->CiiuDirectorioEntidad->setPrincipal('f');
				}
				
				switch ($accion_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu_ci]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_ci_$i"])=='S') {
				$accion_ci_ci=base64_decode($_REQUEST["accion_ci_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setPrincipal(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal_ci_$i"]))));
				
				switch ($accion_ci_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_doc_pr]);$i++) {
			if (base64_decode($_REQUEST["v_doc_pr_$i"])=='S') {
				$accion_do=base64_decode($_REQUEST["accion_do_$i"]);
				
				$this->DocProveedoresEntidad->setIdx(0);
				$this->DocProveedoresEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->DocProveedoresEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["tipo_doc_pr_$i"]))));
				$this->DocProveedoresEntidad->setFechaDoc(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode
						($_REQUEST["fc_doc_$i"])))));
				$this->DocProveedoresEntidad->setNumDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["num_doc_$i"]))));
				$this->DocProveedoresEntidad->setDetalle(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["det_doc_$i"]))));
				switch ($accion_do) {
					case 'A':
						$docProveedoresDirectorioRetorna=$this->NegocioFacade->adicionarDocProveedores($this->DocProveedoresEntidad);
						break;
						
					case 'M':
						$docProveedoresDirectorioRetorna=$this->NegocioFacade->modificarDocProveedores($this->DocProveedoresEntidad);
						break;
				}
				
				if (is_string($docProveedoresDirectorioRetorna->getResultado())) {
					echo $docProveedoresDirectorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$docProveedoresDirectorioRetorna->getIdentificacion();
				$tipo_doc_pr=$docProveedoresDirectorioRetorna->getTipoDocumento();
				$fecha_doc=$docProveedoresDirectorioRetorna->getFechaDoc();
				$num_documento=$docProveedoresDirectorioRetorna->getNumDocumento();
				$detalle=$docProveedoresDirectorioRetorna->getDetalle();
				$datos_ant_do[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_do_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_doc_proveedores');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$tipo_doc_pr[0]##$fecha_doc[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_do[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("dpr_identificacion=$identificacion[0]; dpr_tipo_documento=$tipo_doc_pr[$i]; dpr_fecha_doc=$fecha_doc[$i]; ".
				"dpr_num_documento=$num_documento[$i]; dpr_detalle=$detalle[$i]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
	}
	
function vPago() {
		$accion_d=base64_decode($_REQUEST["accion_d"]);
		$this->DirectorioEntidad->setIdx(0);
		$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento]))));
		$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))!='NaN') {
			$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))));
		} else {
			$this->DirectorioEntidad->setDigitoV('');
		}
		$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))));
		if (base64_decode($_REQUEST[tipo_persona])=='N')
			$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos]))));
		else $this->DirectorioEntidad->setApellidos('');
		$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))!='')
			$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))).'"';
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))).'"';
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))).'"';
		else $direccion[2]='null';
		
		$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular]))!='')
			$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular])));
		else $telefono[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono]))!='')
			$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono])));
		else $telefono[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax]))!='')
			$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax])));
		else $telefono[2]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel]))!='')
			$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel])));
		else $telefono[3]='null';
		
		$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
		
		$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio]))!='')
			$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio])));
		else $ciudad[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia]))!='')
			$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia])));
		else $ciudad[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto]))!='')
			$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto])));
		else $ciudad[2]='null';
		
		$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
		
		$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac])))));
		$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac]))));
		$this->DirectorioEntidad->setEstado('A');
		
		switch ($accion_d) {
			case 'A':
				$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
				break;
				
			case 'M':
			case 'I':
				$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
				break;
				
		}
		
		if (is_string($directorioRetorna->getResultado())) {
			echo $directorioRetorna->getResultado();
			return;
		}
		
		$identificacion=$directorioRetorna->getIdentificacion();
		$tipo_documento=$directorioRetorna->getTipoDocumento();
		$ciudad_documento=$directorioRetorna->getLugarDocumento();
		$digito_v=$directorioRetorna->getDigitoV();
		$tipo_persona=$directorioRetorna->getTipoPersona();
		$apellidos=$directorioRetorna->getApellidos();
		$nombres=$directorioRetorna->getNombres();
		$direcciones=$directorioRetorna->getApellidos();
		$telefonos=$directorioRetorna->getTelefono();
		$correo=$directorioRetorna->getCorreo();
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$barrio=$directorioRetorna->getBarrio();
		$nac=$directorioRetorna->getFechaNac();
		$ciudad_nac=$directorioRetorna->getLugarNac();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_directorio');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_d])));
		$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
		"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
		"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac".
		"=$ciudad_nac[0]; dir_estado=A");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		$accion_d=base64_decode($_REQUEST["accion_d"]);
		
		$this->ProveedoresEntidad->setIdx(0);
		$this->ProveedoresEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->ProveedoresEntidad->setTipoSociedad(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_sociedad]))));
		$this->ProveedoresEntidad->setAutorretenedor(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[autorretenedor]))));
		$this->ProveedoresEntidad->setGc(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[gc]))));
		$this->ProveedoresEntidad->setProfesionLiberal(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[profesion_liberal]))));
		$this->ProveedoresEntidad->setLey1429(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ley_1429]))));
		
		$j=0;
		for ($i=1;$i<=base64_decode($_REQUEST[filas_suc]);$i++) {
			if (base64_decode($_REQUEST["v_suc_$i"])=='S') {
				$dir_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["dir_sucursal_$i"])));
				$ciu_suc[$j]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_sucursal_$i"])));
				
				$j++;
			}
		}
		
		$this->ProveedoresEntidad->setSucursal($this->NegocioFacade->arPhpArSql($ciu_suc));
		$this->ProveedoresEntidad->setDirSucursal($this->NegocioFacade->arPhpArSql($dir_suc));
		$this->ProveedoresEntidad->setRepresentante(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
		$this->ProveedoresEntidad->setTipoRegimen(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_regimen]))));
		$this->ProveedoresEntidad->setRetenedorIva(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[retenedor_iva]))));
		$this->ProveedoresEntidad->setEstado(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[estado]))));
		
		switch ($accion_d) {
			case 'A':
				$proveedoresRetorna=$this->NegocioFacade->adicionarProveedores($this->ProveedoresEntidad);
				break;
				
			case 'M':
				$proveedoresRetorna=$this->NegocioFacade->modificarProveedores($this->ProveedoresEntidad);
				break;
				
			case 'I':
				$proveedoresRetorna=$this->NegocioFacade->inactivarProveedores($this->ProveedoresEntidad);
				break;
		}
		
		if (is_string($proveedoresRetorna->getResultado())) {
			echo $proveedoresRetorna->getResultado();
			return;
		}
		
		$identificacion=$proveedoresRetorna->getIdentificacion();
		$tipo_sociedad=$proveedoresRetorna->getTipoSociedad();
		$autorretenedor=$proveedoresRetorna->getAutorretenedor();
		$gc=$proveedoresRetorna->getGc();
		$ciudad_s=$proveedoresRetorna->getSucursal();
		$dir_s=$proveedoresRetorna->getDirSucursal();
		$representante=$proveedoresRetorna->getRepresentante();
		$estado_c=$proveedoresRetorna->getEstado();
		$tipo_regimen=$proveedoresRetorna->getTipoRegimen();
		$retenedor_iva=$proveedoresRetorna->getRetenedorIva();
		$profesion_liberal=$proveedoresRetorna->getProfesionLiberal();
		$ley_1429=$proveedoresRetorna->getLey1429();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_proveedores');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_p])));
		$this->ModificadorTablasEntidad->setDatosDespues("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=".
		"$autorretenedor[0]; prv_gc=$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_c[0]; ".
		"prv_tipo_regimen=$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))=='J'&&str_replace('', ',', base64_decode($_REQUEST[identificacion_r]))!='') {
			$accion_r=base64_decode($_REQUEST["accion_r"]);
			$this->DirectorioEntidad->setIdx(0);
			$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion_r])));
			$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento_r]))));
			$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento_r]))));
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))!='NaN') {
				$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v_r]))));
			} else {
				$this->DirectorioEntidad->setDigitoV('');
			}
			$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona_r]))));
			if (base64_decode($_REQUEST[tipo_persona_r])=='N')
				$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos_r]))));
			else $this->DirectorioEntidad->setApellidos('');
			$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres_r]))));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))!='')
				$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r]))).'"';
			else $direccion[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))!='')
				$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))).'"';
			else $direccion[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))!='')
				$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))).'"';
			else $direccion[2]='null';
				
			$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r]))!='')
				$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular_r])));
			else $telefono[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r]))!='')
				$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono_r])));
			else $telefono[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r]))!='')
				$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax_r])));
			else $telefono[2]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r]))!='')
				$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel_r])));
			else $telefono[3]='null';
				
			$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
				
			$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo_r]))));
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r]))!='')
				$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio_r])));
			else $ciudad[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r]))!='')
				$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia_r])));
			else $ciudad[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r]))!='')
				$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto_r])));
			else $ciudad[2]='null';
				
			$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
				
			$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac_r])))));
			$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac_r]))));
			$this->DirectorioEntidad->setEstado('A');
				
			switch ($accion_r) {
				case 'A':
					$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
					break;
						
				case 'M':
				case 'I':
					$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
					break;
						
			}
			
			if (is_string($directorioRetorna->getResultado())) {
				echo $directorioRetorna->getResultado();
				return;
			}
			
			$identificacion=$directorioRetorna->getIdentificacion();
			$tipo_documento=$directorioRetorna->getTipoDocumento();
			$ciudad_documento=$directorioRetorna->getLugarDocumento();
			$digito_v=$directorioRetorna->getDigitoV();
			$tipo_persona=$directorioRetorna->getTipoPersona();
			$apellidos=$directorioRetorna->getApellidos();
			$nombres=$directorioRetorna->getNombres();
			$direcciones=$directorioRetorna->getApellidos();
			$telefonos=$directorioRetorna->getTelefono();
			$correo=$directorioRetorna->getCorreo();
			$ciudad=$directorioRetorna->getCiudadDireccion();
			$barrio=$directorioRetorna->getBarrio();
			$nac=$directorioRetorna->getFechaNac();
			$ciudad_nac=$directorioRetorna->getLugarNac();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_directorio');
			$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_r])));
			$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
			"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
			"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
			"$ciudad_nac[0]; dir_estado=A");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_$i"])=='S') {
				$accion_ci=base64_decode($_REQUEST["accion_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar('COL');
				if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_$i"]))==$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal"]))){
					$this->CiiuDirectorioEntidad->setPrincipal('t');
				} else {
					$this->CiiuDirectorioEntidad->setPrincipal('f');
				}
				
				switch ($accion_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_ciiu_ci]);$i++) {
			if (base64_decode($_REQUEST["v_ciiu_ci_$i"])=='S') {
				$accion_ci_ci=base64_decode($_REQUEST["accion_ci_ci_$i"]);
				
				$this->CiiuDirectorioEntidad->setIdx(0);
				$this->CiiuDirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->CiiuDirectorioEntidad->setCiiu(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setLugar(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["ciudad_ciiu_ci_$i"]))));
				$this->CiiuDirectorioEntidad->setPrincipal(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_principal_ci_$i"]))));
				
				switch ($accion_ci_ci) {
					case 'A':
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
						
					case 'M':
						$ciiuDiretorioRetorna=$this->NegocioFacade->modificarCiiuDirectorio($this->CiiuDirectorioEntidad);
						break;
				}
				
				if (is_string($ciiuDiretorioRetorna->getResultado())) {
					echo $ciiuDiretorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
				$ciiu=$ciiuDiretorioRetorna->getCiiu();
				$lugar=$ciiuDiretorioRetorna->getLugar();
				$principal=$ciiuDiretorioRetorna->getPrincipal();
				$datos_ant_ci_ci[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_ci_ci_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ci_ci[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=$principal[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_doc_pr]);$i++) {
			if (base64_decode($_REQUEST["v_doc_pr_$i"])=='S') {
				$accion_do=base64_decode($_REQUEST["accion_do_$i"]);
				
				$this->DocProveedoresEntidad->setIdx(0);
				$this->DocProveedoresEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
				$this->DocProveedoresEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["tipo_doc_pr_$i"]))));
				$this->DocProveedoresEntidad->setFechaDoc(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode
						($_REQUEST["fc_doc_$i"])))));
				
				$this->DocProveedoresEntidad->setNumDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["num_doc_$i"]))));
				$this->DocProveedoresEntidad->setDetalle(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["det_doc_$i"]))));
				switch ($accion_do) {
					case 'A':
						$docProveedoresDirectorioRetorna=$this->NegocioFacade->adicionarDocProveedores($this->DocProveedoresEntidad);
						break;
						
					case 'M':
						$docProveedoresDirectorioRetorna=$this->NegocioFacade->modificarDocProveedores($this->DocProveedoresEntidad);
						break;
				}
				
				if (is_string($docProveedoresDirectorioRetorna->getResultado())) {
					echo $docProveedoresDirectorioRetorna->getResultado();
					return;
				}
				
				$identificacion=$docProveedoresDirectorioRetorna->getIdentificacion();
				$tipo_doc_pr=$docProveedoresDirectorioRetorna->getTipoDocumento();
				$fecha_doc=$docProveedoresDirectorioRetorna->getFechaDoc();
				$num_documento=$docProveedoresDirectorioRetorna->getNumDocumento();
				$detalle=$docProveedoresDirectorioRetorna->getDetalle();
				$datos_ant_do[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_do_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_doc_proveedores');
				$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$tipo_doc_pr[0]##$fecha_doc[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_do[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("dpr_identificacion=$identificacion[0]; dpr_tipo_documento=$tipo_doc_pr[$i]; dpr_fecha_doc=$fecha_doc[$i]; ".
				"dpr_num_documento=$num_documento[$i]; dpr_detalle=$detalle[$i]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		$accion_pg=base64_decode($_REQUEST["accion_pg"]);
		$datos_ant_pg=base64_decode($_REQUEST["datos_ant_pg"]);
		$this->PagosEntidad->setIdx(0);
		$this->PagosEntidad->setConsecutivo(base64_decode($_REQUEST[no_pago]));
		$this->PagosEntidad->setCliente(base64_decode($_REQUEST[cliente]));
		$this->PagosEntidad->setProveedor(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->PagosEntidad->setBanco(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[banco]))));
		$this->PagosEntidad->setCtaBancaria(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[cta_bancaria]))));
		$this->PagosEntidad->setTipoCuenta(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tp_cuenta]))));
		$this->PagosEntidad->setFecha(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fecha_pago])))));
		$this->PagosEntidad->setVlPago(str_replace(',', '', base64_decode($_REQUEST[vl_pago])));
		$this->PagosEntidad->setObservaciones(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[obs_pago]))));
		$this->PagosEntidad->setLugar(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_pago]))));
		
		switch ($accion_pg) {
			case 'A':
				$pagosRetorna=$this->NegocioFacade->adicionarPagos($this->PagosEntidad);
				break;
		
			case 'M':
				$pagosRetorna=$this->NegocioFacade->modificarPagos($this->PagosEntidad);
				break;
		}
		
		if (is_string($pagosRetorna->getResultado())) {
			echo $pagosRetorna->getResultado();
			return;
		}
		
		$pago=$pagosRetorna->getConsecutivo();
		$cliente=$pagosRetorna->getCliente();
		$proveedor=$pagosRetorna->getProveedor();
		$banco=$pagosRetorna->getBanco();
		$cta_bancaria=$pagosRetorna->getCtaBancaria();
		$tp_cuenta=$pagosRetorna->getTipoCuenta();
		$fecha_pago=$pagosRetorna->getFecha();
		$vl_pago=$pagosRetorna->getVlPago();
		$obs_pago=$pagosRetorna->getObservaciones();
		$ciudad_pago=$pagosRetorna->getLugar();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_pagos');
		$this->ModificadorTablasEntidad->setLlave($pago[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_pg);
		$this->ModificadorTablasEntidad->setDatosDespues("pag_consecutivo=$pago[0]; pag_cliente=$cliente[0]; pag_proveedor=$proveedor[0]; pag_banco=$banco[0]; ".
		"pag_cta_bancaria=$cta_bancaria[0]; pag_tipo_cuenta=$tp_cuenta[0]; pag_fecha=$fecha_pago[0]; pag_no_documento=; pag_vl_pago=$vl_pago[0]; pag_observaciones=".
		"$obs_pago[0]; pag_lugar=$ciudad_pago[0]");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_det_pago]);$i++) {
			if (base64_decode($_REQUEST["v_doc_dp_$i"])=='S') {
				$accion_dp=base64_decode($_REQUEST["accion_dp_$i"]);
				$datos_ant_dp=base64_decode($_REQUEST["datos_ant_dp_$i"]);
				$this->DetallePagosEntidad->setIdx(0);
				$this->DetallePagosEntidad->setPago($pago[0]);
				$this->DetallePagosEntidad->setConsecutivo(base64_decode($_REQUEST["t_cons_dp_$i"]));
				$this->DetallePagosEntidad->setBienServicio(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["bien_serv_$i"]))));
				$this->DetallePagosEntidad->setValor(str_replace(',', '', base64_decode($_REQUEST["vl_det_pago_$i"])));
				$this->DetallePagosEntidad->setInfo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["t_info_$i"]))));
				
				switch ($accion_dp) {
					case 'A':
						$detallePagosRetorna=$this->NegocioFacade->adicionarDetallePagos($this->DetallePagosEntidad);
						break;
				
					case 'M':
						$detallePagosRetorna=$this->NegocioFacade->modificarDetallePagos($this->DetallePagosEntidad);
						break;
				}
				
				if (is_string($detallePagosRetorna->getResultado())) {
					echo $detallePagosRetorna->getResultado();
					return;
				}
				
				$consecutivo=$detallePagosRetorna->getConsecutivo();
				$bien_servicio=$detallePagosRetorna->getBienServicio();
				$valor=$detallePagosRetorna->getValor();
				$info=$detallePagosRetorna->getInfo();
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_detalle_pagos');
				$this->ModificadorTablasEntidad->setLlave("$pago[0]##$consecutivo[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_dp[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("dpa_pago=$pago[0]; dpa_consecutivo=$consecutivo[0]; dpa_bien_servicio=$bien_servicio[0]; dpa_valor=$valor[0]; ".
				"dpa_info=$info[0]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
			
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_imp_s]);$i++) {
			$accion_is=base64_decode($_REQUEST["accion_is_$i"]);
			$datos_ant_is=base64_decode($_REQUEST["datos_ant_is_$i"]);
			$this->ImpuestoPagosEntidad->setIdx(0);
			$this->ImpuestoPagosEntidad->setPago($pago[0]);
			$this->ImpuestoPagosEntidad->setImpuesto(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_imp_s_$i"]))));
			$this->ImpuestoPagosEntidad->setVlImpuesto(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["vl_imp_s_$i"]))));
			
			switch ($accion_is) {
				case 'A':
					$impuestoPagosRetorna=$this->NegocioFacade->adicionarImpuestoPagos($this->ImpuestoPagosEntidad);
					break;
			
				case 'M':
					$impuestoPagosRetorna=$this->NegocioFacade->modificarImpuestoPagos($this->ImpuestoPagosEntidad);
					break;
			}
			
			if (is_string($impuestoPagosRetorna->getResultado())) {
				echo $impuestoPagosRetorna->getResultado();
				return;
			}
			
			$impuesto=$impuestoPagosRetorna->getImpuesto();
			$vl_impuesto=$impuestoPagosRetorna->getVlImpuesto();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_impuesto_pagos');
			$this->ModificadorTablasEntidad->setLlave("$pago[0]");
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_is[$i]);
			$this->ModificadorTablasEntidad->setDatosDespues("ipa_pago=$pago[0]; ipa_impuesto=$impuesto[0]; ipa_vl_impuesto=$vl_impuesto[0];");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
			
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_imp_r]);$i++) {
			$accion_ir=base64_decode($_REQUEST["accion_ir_$i"]);
			$datos_ant_ir=base64_decode($_REQUEST["datos_ant_ir_$i"]);
			$this->ImpuestoPagosEntidad->setIdx(0);
			$this->ImpuestoPagosEntidad->setPago($pago[0]);
			$this->ImpuestoPagosEntidad->setImpuesto(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cd_imp_r_$i"]))));
			$this->ImpuestoPagosEntidad->setVlImpuesto(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["vl_imp_r_$i"]))));
			
			switch ($accion_ir) {
				case 'A':
					$impuestoPagosRetorna=$this->NegocioFacade->adicionarImpuestoPagos($this->ImpuestoPagosEntidad);
					break;
			
				case 'M':
					$impuestoPagosRetorna=$this->NegocioFacade->modificarImpuestoPagos($this->ImpuestoPagosEntidad);
					break;
			}
			
			if (is_string($impuestoPagosRetorna->getResultado())) {
				echo $impuestoPagosRetorna->getResultado();
				return;
			}
			
			$impuesto=$impuestoPagosRetorna->getImpuesto();
			$vl_impuesto=$impuestoPagosRetorna->getVlImpuesto();
			
			$this->ModificadorTablasEntidad->setIdx(0);
			$this->ModificadorTablasEntidad->setTabla('iau_impuesto_pagos');
			$this->ModificadorTablasEntidad->setLlave("$pago[0]");
			$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
			$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ir[$i]);
			$this->ModificadorTablasEntidad->setDatosDespues("ipa_pago=$pago[0]; ipa_impuesto=$impuesto[0]; ipa_vl_impuesto=$vl_impuesto[0];");
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
			
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo $modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		for ($i=1;$i<=base64_decode($_REQUEST[filas_doc_pa]);$i++) {
			if (base64_decode($_REQUEST["v_doc_pa_$i"])=='S') {
				$accion_do=base64_decode($_REQUEST["accion_do_pa_$i"]);
				
				$this->DocPagosEntidad->setIdx(0);
				$this->DocPagosEntidad->setPago($pago[0]);
				$this->DocPagosEntidad->setConsecutivo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["t_cons_do_pa_$i"]))));
				$this->DocPagosEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["tipo_doc_pa_$i"]))));
				$this->DocPagosEntidad->setNumDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["num_doc_pa_$i"]))));
				$this->DocPagosEntidad->setDetalle(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["det_doc_pa_$i"]))));
				switch ($accion_do) {
					case 'A':
						$docPagosRetorna=$this->NegocioFacade->adicionarDocPagos($this->DocPagosEntidad);
						break;
						
					case 'M':
						$docPagosRetorna=$this->NegocioFacade->modificarDocPagos($this->DocPagosEntidad);
						break;
				}
				
				if (is_string($docPagosRetorna->getResultado())) {
					echo $docPagosRetorna->getResultado();
					return;
				}
				
				$cons_doc_pa=$docPagosRetorna->getConsecutivo();
				$tipo_doc_pa=$docPagosRetorna->getTipoDocumento();
				$num_documento_pa=$docPagosRetorna->getNumDocumento();
				$detalle_pa=$docPagosRetorna->getDetalle();
				$datos_ant_do_pa[$i]=pg_escape_string(base64_decode($_REQUEST["datos_ant_do_pa_$i"]));
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_doc_pagos');
				$this->ModificadorTablasEntidad->setLlave("$pago[0]##$cons_doc_pa[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_do_pa[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("dpa_pago=$pago[0]; dpa_consecutivo=$cons_doc_pa[$i]; dpa_tipo_documento=$tipo_doc_pa[$i]; dpa_num_documento".
				"=$num_documento_pa[$i]; dpa_detalle=$detalle_pa[$i]");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
	}
	
	function vUsuario() {
		$accion_d=base64_decode($_REQUEST["accion_d"]);
		$this->DirectorioEntidad->setIdx(0);
		$this->DirectorioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->DirectorioEntidad->setTipoDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_documento]))));
		$this->DirectorioEntidad->setLugarDocumento(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_documento]))));
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))!='NaN') {
			$this->DirectorioEntidad->setDigitoV(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[digito_v]))));
		} else {
			$this->DirectorioEntidad->setDigitoV('');
		}
		
		$this->DirectorioEntidad->setTipoPersona(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_persona]))));
		if (base64_decode($_REQUEST[tipo_persona])=='N')
			$this->DirectorioEntidad->setApellidos(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[apellidos]))));
		else $this->DirectorioEntidad->setApellidos('');
		$this->DirectorioEntidad->setNombres(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombres]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))!='')
			$direccion[0]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia]))).'"';
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))).'"';
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]='"'.pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))).'"';
		else $direccion[2]='null';
		
		$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular]))!='')
			$telefono[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[celular])));
		else $telefono[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono]))!='')
			$telefono[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[telefono])));
		else $telefono[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax]))!='')
			$telefono[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[fax])));
		else $telefono[2]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel]))!='')
			$telefono[3]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[otro_tel])));
		else $telefono[3]='null';
		
		$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefono));
		
		$this->DirectorioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo]))));
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio]))!='')
			$ciudad[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_domicilio])));
		else $ciudad[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia]))!='')
			$ciudad[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_correspondencia])));
		else $ciudad[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto]))!='')
			$ciudad[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_contacto])));
		else $ciudad[2]='null';
		
		$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
		
		$this->DirectorioEntidad->setFechaNac(pg_escape_string($this->NegocioFacade->fomatDjFc($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nac])))));
		$this->DirectorioEntidad->setLugarNac(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ciudad_nac]))));
		$this->DirectorioEntidad->setEstado('A');
		
		switch ($accion_d) {
			case 'A':
				$directorioRetorna=$this->NegocioFacade->adicionarDirectorio($this->DirectorioEntidad);
				break;
				
			case 'M':
			case 'I':
				$directorioRetorna=$this->NegocioFacade->modificarDirectorio($this->DirectorioEntidad);
				break;
				
		}
		
		if (is_string($directorioRetorna->getResultado())) {
			echo $directorioRetorna->getResultado();
			return;
		}
		
		$identificacion=$directorioRetorna->getIdentificacion();
		$tipo_documento=$directorioRetorna->getTipoDocumento();
		$ciudad_documento=$directorioRetorna->getLugarDocumento();
		$digito_v=$directorioRetorna->getDigitoV();
		$tipo_persona=$directorioRetorna->getTipoPersona();
		$apellidos=$directorioRetorna->getApellidos();
		$nombres=$directorioRetorna->getNombres();
		$direcciones=$directorioRetorna->getDireccion();
		$telefonos=$directorioRetorna->getTelefono();
		$correo=$directorioRetorna->getCorreo();
		$ciudad=$directorioRetorna->getCiudadDireccion();
		$barrio=$directorioRetorna->getBarrio();
		$nac=$directorioRetorna->getFechaNac();
		$ciudad_nac=$directorioRetorna->getLugarNac();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_directorio');
		$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_d])));
		$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
		"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
		"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
		"$ciudad_nac[0]; dir_estado=A");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		$accion_u=base64_decode($_REQUEST["accion_u"]);
		
		$this->UsuarioEntidad->setIdx(0);
		$this->UsuarioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[identificacion])));
		$this->UsuarioEntidad->setCorreo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[correo]))));
		$this->UsuarioEntidad->setTipoUsuario(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[tipo_usuario]))));
		$this->UsuarioEntidad->setEstado(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[estado]))));
		$this->UsuarioEntidad->setRequiereCambio(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[req_cambio]))));
		
		switch ($accion_u) {
			case 'A':
				for ($i=1;$i<=4;$i++) {
					$ds_password.=chr(rand(65,90));
					$ds_password.=rand(0,9);
				}
				
				$clave=$this->NegocioFacade->encriptaClave(str_replace(',', '', base64_decode($_REQUEST[identificacion])),$ds_password);
				
				$this->UsuarioEntidad->setRequiereCambio('t');
				$this->UsuarioEntidad->setClave($clave);
				$usuarioRetorna=$this->NegocioFacade->adicionarUsuario($this->UsuarioEntidad);
				break;
				
			case 'M':
				
				$usuarioRetorna=$this->NegocioFacade->modificarUsuario($this->UsuarioEntidad);
				break;
				
			case 'I':
				$usuarioRetorna=$this->NegocioFacade->inactivarUsuario($this->UsuarioEntidad);
				break;
		}
		
		if (is_string($usuarioRetorna->getResultado())) {
			echo $usuarioRetorna->getResultado();
			return;
		}
		
		$identificacion=$usuarioRetorna->getIdentificacion();
		$correo=$usuarioRetorna->getCorreo();
		$estado=$usuarioRetorna->getEstado();
		$tipo_usuario=$usuarioRetorna->getTipoUsuario();
		$clave=$usuarioRetorna->getClave();
		$requiere_cambio=$usuarioRetorna->getRequiereCambio();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_usuarios');
		$this->ModificadorTablasEntidad->setLlave($identificacion);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_u])));
		$this->ModificadorTablasEntidad->setDatosDespues("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=$estado; usu_tipo_usuario=$tipo_usuario; ".
		"usu_clave=$clave; usu_requiere_cambio=$requiere_cambio");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
		
		if ($tipo_usuario=='S') {
			for ($i=1;$i<=base64_decode($_REQUEST[filas_rol_s]);$i++) {
				if (base64_decode($_REQUEST["v_rol_s_$i"])=='S') {
					$rol[count($rol)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["rol_s_$i"])));
					$empresa[count($empresa)]=-1;
					$estado_r[count($estado_r)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["estado_s_$i"])));
					$accion_r[count($accion_r)]=base64_decode($_REQUEST["accion_r_s_$i"]);
					$datos_ant_r[count($datos_ant_r)]=pg_escape_string(base64_decode($_REQUEST["datos_ant_r_s_$i"]));
					for ($j=0;$j<count($_REQUEST["accion_pe_s_$i"]);$j++) {
						if (base64_decode($_REQUEST["accion_pe_s_$i"][$j])!='N') {
							$modulo_pe[count($modulo_pe)]=pg_escape_string(base64_decode($_REQUEST["modulo_s_$i"][$j]));
							$empresa_pe[count($empresa_pe)]=-1;
							$rol_pe[count($rol_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["rol_s_$i"])));
							$consulta_pe[count($consulta_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_lis_s_".$i."_".$j])));
							$adicionar_pe[count($adicionar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_add_s_".$i."_".$j])));
							$modificar_pe[count($modificar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_mod_s_".$i."_".$j])));
							$eliminar_pe[count($eliminar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_ina_s_".$i."_".$j])));
							$accion_pe[count($accion_pe)]=pg_escape_string(base64_decode($_REQUEST["accion_pe_s_$i"][$j]));
							$datos_ant_pe[count($datos_ant_pe)]=pg_escape_string(base64_decode($_REQUEST["datos_ant_pe_s_$i"][$j]));
						}
					}
				}
			}
		} elseif ($tipo_usuario=='U') {
			for ($i=1;$i<=base64_decode($_REQUEST[filas_rol_u]);$i++) {
				if (base64_decode($_REQUEST["v_rol_u_$i"])=='S') {
					$rol[count($rol)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["rol_u_$i"])));
					$empresa[count($empresa)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cliente_u_$i"])));
					$estado_r[count($estado_r)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["estado_u_$i"])));
					$accion_r[count($accion_r)]=base64_decode($_REQUEST["accion_r_u_$i"]);
					$datos_ant_r[count($datos_ant_r)]=pg_escape_string(base64_decode($_REQUEST["datos_ant_r_u_$i"]));
					for ($j=0;$j<count($_REQUEST["accion_pe_u_$i"]);$j++) {
						if (base64_decode($_REQUEST["accion_pe_u_$i"][$j])!='N') {
							$modulo_pe[count($modulo_pe)]=pg_escape_string(base64_decode($_REQUEST["modulo_u_$i"][$j]));
							$empresa_pe[count($empresa_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["cliente_u_$i"])));
							$rol_pe[count($rol_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["rol_u_$i"])));
							$consulta_pe[count($consulta_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_lis_u_".$i."_".$j])));
							$adicionar_pe[count($adicionar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_add_u_".$i."_".$j])));
							$modificar_pe[count($modificar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_mod_u_".$i."_".$j])));
							$eliminar_pe[count($eliminar_pe)]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST["c_ina_u_".$i."_".$j])));
							$accion_pe[count($accion_pe)]=pg_escape_string(base64_decode($_REQUEST["accion_pe_u_$i"][$j]));
							$datos_ant_pe[count($datos_ant_pe)]=pg_escape_string(base64_decode($_REQUEST["datos_ant_pe_u_$i"][$j]));
						}
					}
				}
			}
			
		}
		
		if ($tipo_usuario!='A') {
			for ($i=0;$i<count($rol);$i++) {
				$this->RolesUsuariosEntidad->setIdx(0);
				$this->RolesUsuariosEntidad->setRol($rol[$i]);
				$this->RolesUsuariosEntidad->setUsuario($identificacion);
				$this->RolesUsuariosEntidad->setEmpresa($empresa[$i]);
				$this->RolesUsuariosEntidad->setEstado($estado_r[$i]);
				switch ($accion_r[$i]) {
					case 'A':
						$rolesUsuariosRetorna=$this->NegocioFacade->adicionarRolesUsuarios($this->RolesUsuariosEntidad);
						break;
						
					case 'M':
						$rolesUsuariosRetorna=$this->NegocioFacade->modificarRolesUsuarios($this->RolesUsuariosEntidad);
						break;
				}
				
				if (is_string($rolesUsuariosRetorna->getResultado())) {
					echo $rolesUsuariosRetorna->getResultado();
					return;
				}
				
				$rol_ru=$rolesUsuariosRetorna->getRol();
				$identificacion_ru=$rolesUsuariosRetorna->getUsuario();
				$empresa_ru=$rolesUsuariosRetorna->getEmpresa();
				$estado_ru=$rolesUsuariosRetorna->getEstado();
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_roles_usuarios');
				$this->ModificadorTablasEntidad->setLlave("$rol_ru[0]##$identificacion_ru[0]##$empresa_ru[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_ru[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("rus_rol=$rol_ru[0]; rus_usuario=$identificacion_ru[0]; rus_empresa=$empresa_ru[0]; rus_estado=$estado_ru[0]");
				
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
			
			for ($i=0;$i<count($modulo_pe);$i++) {
				$this->PermisosExcepcionalesEntidad->setIdx(0);
				$this->PermisosExcepcionalesEntidad->setUsuario($identificacion);
				$this->PermisosExcepcionalesEntidad->setModulo($modulo_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setEmpresa($empresa_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setRol($rol_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setConsulta($consulta_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setAdicionar($adicionar_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setModificar($modificar_pe[$i]);
				$this->PermisosExcepcionalesEntidad->setEliminar($eliminar_pe[$i]);
				
				switch ($accion_pe[$i]) {
					case 'A':
						$permisosExcepcionalesRetorna=$this->NegocioFacade->adicionarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
						break;
				
					case 'M':
						$permisosExcepcionalesRetorna=$this->NegocioFacade->modificarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
						break;
				}
				
				if (is_string($permisosExcepcionalesRetorna->getResultado())) {
					echo $permisosExcepcionalesRetorna->getResultado();
					return;
				}
				
				$identificacion_pex=$permisosExcepcionalesRetorna->getUsuario();
				$modulo_pex=$permisosExcepcionalesRetorna->getModulo();
				$empresa_pex=$permisosExcepcionalesRetorna->getEmpresa();
				$rol_pex=$permisosExcepcionalesRetorna->getRol();
				$consulta_pex=$permisosExcepcionalesRetorna->getConsulta();
				$adicionar_pex=$permisosExcepcionalesRetorna->getAdicionar();
				$modificar_pex=$permisosExcepcionalesRetorna->getModificar();
				$eliminar_pex=$permisosExcepcionalesRetorna->getEliminar();
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_permisos_excepcionales');
				$this->ModificadorTablasEntidad->setLlave("$identificacion_pex[0]##$modulo_pex[0]##$empresa_pex[0]##$rol_pex[0]");
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_pe[$i]);
				$this->ModificadorTablasEntidad->setDatosDespues("pex_usuario=$identificacion_pex[0]; pex_modulo=$modulo_pex[0]; pex_empresa=$empresa_pex[0]; pex_rol=".
				"$rol_pex[0]; pex_consulta=$consulta_pex[0]; pex_adicionar=$adicionar_pex[0]; pex_modificar=$modificar_pex[0]; pex_eliminar=$eliminar_pex[0]");
				
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
			}
		}
		
		if ($ds_password!='') {
			$to[0]=$correo;
			$this->CorreoEntidad->setTo($to);
			$datos_cuerpo[0]=ucwords(mb_strtolower($nombres[0]));
			if ($apellidos!='') $datos_cuerpo[0].=" ".ucwords(mb_strtolower($apellidos[0]));
			$datos_cuerpo[1]=$identificacion;
			$datos_cuerpo[2]=$ds_password;
			$datos_cuerpo[3]=$_SERVER['SERVER_NAME'];
			$this->CorreoEntidad->setPlantilla(1);
			$this->CorreoEntidad->setDatosCuerpo($datos_cuerpo);
			
			$this->NegocioFacade->enviarCorreo($this->CorreoEntidad);
			
		}
	}
	
	function vCambioClave() {
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		$usuario=$usuarioRetorna->getIdentificacion();
		
		$clave_ant=$this->NegocioFacade->encriptaClave(base64_decode($_SESSION[ITZAudUs]), base64_decode($_REQUEST[passwd_ant]));
		$clave=$usuarioRetorna->getClave();
		
		if ($clave_ant!=$clave) {
			echo 'Contrase&ntilde;a incorrecta.';
			return;
		}
		
		$clave_nv=$this->NegocioFacade->encriptaClave(base64_decode($_SESSION[ITZAudUs]), base64_decode($_REQUEST[passwd_nv]));
		
		if ($clave_nv==$clave) {
			echo 'La anterior contrase&ntilde;a y la nueva son la misma.';
			return;
		}
		
		$this->UsuarioEntidad->setIdx(0);
		$this->UsuarioEntidad->setIdentificacion(base64_decode($_SESSION[ITZAudUs]));
		$this->UsuarioEntidad->setCorreo($usuarioRetorna->getCorreo());
		$this->UsuarioEntidad->setTipoUsuario($usuarioRetorna->getTipoUsuario());
		$this->UsuarioEntidad->setEstado($usuarioRetorna->getEstado());
		$this->UsuarioEntidad->setRequiereCambio('f');
		$this->UsuarioEntidad->setClave($clave_nv);
		
		$usuarioRetorna=$this->NegocioFacade->cambioClave($this->UsuarioEntidad);
		
		if (is_string($usuarioRetorna->getResultado())) {
			echo $usuarioRetorna->getResultado();
			return;
		}
		
		$identificacion=$usuarioRetorna->getIdentificacion();
		$correo=$usuarioRetorna->getCorreo();
		$estado=$usuarioRetorna->getEstado();
		$tipo_usuario=$usuarioRetorna->getTipoUsuario();
		$clave=$usuarioRetorna->getClave();
		$requiere_cambio=$usuarioRetorna->getRequiereCambio();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_usuarios');
		$this->ModificadorTablasEntidad->setLlave($identificacion);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant])));
		$this->ModificadorTablasEntidad->setDatosDespues("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=$estado; usu_tipo_usuario=$tipo_usuario; ".
		"usu_clave=$clave; usu_requiere_cambio=$requiere_cambio");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
	}
	
	function vRenovarClave() {
		header( 'Content-type: text/html; charset=utf-8' );
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		$usuario=$usuarioRetorna->getIdentificacion();
		
		for ($i=1;$i<=4;$i++) {
			$ds_password.=chr(rand(65,90));
			$ds_password.=rand(0,9);
		}
		
		$clave=$this->NegocioFacade->encriptaClave(str_replace(',', '', base64_decode($_REQUEST[usuario])),$ds_password);
		$datos_ant="usu_identificacion=".$usuarioRetorna->getEstado()."; usu_correo=".$usuarioRetorna->getCorreo()."; usu_estado=".$usuarioRetorna->getEstado().
		"; usu_tipo_usuario=".$usuarioRetorna->getTipoUsuario()."; usu_clave=".$usuarioRetorna->getClave()."; usu_requiere_cambio=".$usuarioRetorna->getRequiereCambio();
		$this->UsuarioEntidad->setIdx(0);
		$this->UsuarioEntidad->setIdentificacion(str_replace(',', '', base64_decode($_REQUEST[usuario])));
		$this->UsuarioEntidad->setCorreo($usuarioRetorna->getCorreo());
		$this->UsuarioEntidad->setTipoUsuario($usuarioRetorna->getTipoUsuario());
		$this->UsuarioEntidad->setEstado($usuarioRetorna->getEstado());
		$this->UsuarioEntidad->setRequiereCambio('t');
		$this->UsuarioEntidad->setClave($clave);
		
		$usuarioRetorna=$this->NegocioFacade->cambioClave($this->UsuarioEntidad);
		
		if (is_string($usuarioRetorna->getResultado())) {
			echo $usuarioRetorna->getResultado();
			return;
		}
		
		$identificacion=$usuarioRetorna->getIdentificacion();
		$correo=$usuarioRetorna->getCorreo();
		$estado=$usuarioRetorna->getEstado();
		$tipo_usuario=$usuarioRetorna->getTipoUsuario();
		$clave=$usuarioRetorna->getClave();
		$requiere_cambio=$usuarioRetorna->getRequiereCambio();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_usuarios');
		$this->ModificadorTablasEntidad->setLlave($identificacion);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant);
		$this->ModificadorTablasEntidad->setDatosDespues("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=$estado; usu_tipo_usuario=$tipo_usuario; ".
		"usu_clave=$clave; usu_requiere_cambio=$requiere_cambio");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		} else {
			$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[usuario])));
			$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
			
			$to[0]=$correo;
			$this->CorreoEntidad->setTo($to);
			if ($fila=pg_fetch_assoc($directorioRetorna->getResultado())) $datos_cuerpo[0]=ucwords(mb_strtolower($fila[nombres]));
			
			$datos_cuerpo[1]=$identificacion;
			$datos_cuerpo[2]=$ds_password;
			$datos_cuerpo[3]=$_SERVER['SERVER_NAME'];
			$this->CorreoEntidad->setPlantilla(2);
			$this->CorreoEntidad->setDatosCuerpo($datos_cuerpo);
				
			$this->NegocioFacade->enviarCorreo($this->CorreoEntidad);
		}
	}
	
	function vBienOServicio() {
		$accion=base64_decode($_REQUEST["accion"]);
		$this->BienServiciosEntidad->setIdx(0);
		$this->BienServiciosEntidad->setConsecutivo(base64_decode($_REQUEST[c_bien_servicio]));
		$this->BienServiciosEntidad->setBienServicio(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[bien_servicio]))));
		$this->BienServiciosEntidad->setPrRetefuentej(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[pr_retefuentej]))));
		$this->BienServiciosEntidad->setPrRetefuenten(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[pr_retefuenten]))));
		$this->BienServiciosEntidad->setVlUvt(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[vl_uvt]))));
		$this->BienServiciosEntidad->setPrIva(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[pr_iva]))));
		$this->BienServiciosEntidad->setPrConsumo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[pr_consumo]))));
		$this->BienServiciosEntidad->setDetallado(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[detallado]))));
		
		switch ($accion) {
			case 'A':
				$bienServiciosRetorna=$this->NegocioFacade->adicionarBienServicios($this->BienServiciosEntidad);
				break;
				
			case 'M':
				$bienServiciosRetorna=$this->NegocioFacade->modificarBienServicios($this->BienServiciosEntidad);
				break;
				
		}
		
		if (is_string($bienServiciosRetorna->getResultado())) {
			echo $bienServiciosRetorna->getResultado();
			return;
		}
		
		$consecutivo=$bienServiciosRetorna->getConsecutivo();
		$bien_servicio=$bienServiciosRetorna->getBienServicio();
		$pr_retefuentej=$bienServiciosRetorna->getPrRetefuentej();
		$pr_retefuenten=$bienServiciosRetorna->getPrRetefuenten();
		$vl_uvt=$bienServiciosRetorna->getVlUvt();
		$pr_iva=$bienServiciosRetorna->getPrIva();
		$pr_consumo=$bienServiciosRetorna->getPrConsumo();
		$detallado=$bienServiciosRetorna->getDetallado();
	
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_bien_servicios');
		$this->ModificadorTablasEntidad->setLlave($consecutivo[0]);
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant])));
		$this->ModificadorTablasEntidad->setDatosDespues("bse_consecutivo=$consecutivo[0]; bse_bien_servicio=$bien_servicio[0]; bse_pr_retefuentej=$pr_retefuentej[0]; ".
		"bse_pr_retefuenten=$pr_retefuenten[0]; bse_vl_uvt=$vl_uvt[0]; bse_pr_iva=$pr_iva[0]; bse_pr_consumo=$pr_consumo[0]; bse_detallado=$detallado[0]");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
	
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
	}
	
	function vCuentaPuc() {
		$accion=base64_decode($_REQUEST["accion"]);
		$this->CuentaPucEntidad->setIdx(0);
		$this->CuentaPucEntidad->setCliente(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[cliente]))));
		$this->CuentaPucEntidad->setCodigo(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[cta_puc]))));
		$this->CuentaPucEntidad->setNombre(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nombre_puc]))));
		$this->CuentaPucEntidad->setEcuacionPatrimonial(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[ecuacion]))));
		$this->CuentaPucEntidad->setNivelDetalle(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[nivel_det]))));
		$this->CuentaPucEntidad->setNaturaleza(pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[naturaleza]))));
		$this->CuentaPucEntidad->setAccion($accion);
		
		$cuentaPucRetorna=$this->NegocioFacade->modificarCuentaPuc($this->CuentaPucEntidad);
		
		if (is_string($cuentaPucRetorna->getResultado())) {
			echo $cuentaPucRetorna->getResultado();
			return;
		}
		
		$cliente=$cuentaPucRetorna->getCliente();
		$codigo=$cuentaPucRetorna->getCodigo();
		$nombre=$cuentaPucRetorna->getNombre();
		$ecuacion_patrimonial=$cuentaPucRetorna->getEcuacionPatrimonial();
		$nivel_detalle=$cuentaPucRetorna->getNivelDetalle();
		$naturaleza=$cuentaPucRetorna->getNaturaleza();
		
		$this->ModificadorTablasEntidad->setIdx(0);
		$this->ModificadorTablasEntidad->setTabla('iau_cuenta_puc');
		$this->ModificadorTablasEntidad->setLlave("$cliente[0]##$codigo[0]");
		$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant])));
		$this->ModificadorTablasEntidad->setDatosDespues("cup_cliente=$cliente[0]; cup_codigo=$codigo[0]; cup_nombre=$nombre[0]; cup_ecuacion_patrimonial=".
		"$ecuacion_patrimonial[0]; cup_nivel_detalle=$nivel_detalle[0]; cup_naturaleza=$naturaleza[0]");
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
	}
	
	function vCuentaPuc1() {
		$cdEcPa=array('AC','PA','CA','CA','IN','EG','CO','OD','OA');
		$nmEcPa=array('ACTIVO','PASIVO','CAPITAL','PATRIMONIO','INGRESO','EGRESO','COSTO','CUENTAS DE ORDEN DEUDORAS','CUENTAS DE ORDEN ACREEDORAS');
		$cdNat=array('D','C');
		$nmNat=array('DÉBITO','CRÉDITO');
		$columnas=explode(',',base64_decode($_REQUEST[columnas]));
		
		$this->CuentaPucEntidad->setWhere(" and cp.cup_cliente=".base64_decode($_REQUEST[cliente]));
		$this->CuentaPucEntidad->setOrder("cp.cup_codigo");
		$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
		if (pg_num_rows($cuentaPucRetorna->getResultado())>0) {
			$cliente=$cuentaPucRetorna->getCliente();
			$codigo=$cuentaPucRetorna->getCodigo();
			$nombre=$cuentaPucRetorna->getNombre();
			$ecuacion_patrimonial=$cuentaPucRetorna->getEcuacionPatrimonial();
			$nivel_detalle=$cuentaPucRetorna->getNivelDetalle();
			$naturaleza=$cuentaPucRetorna->getNaturaleza();
		}
		
		$m=0;
		
		if (base64_decode($_REQUEST[delimitador_campo])=='') {
			$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
			$filas=$objPHPExcel->getActiveSheet()->getHighestDataRow();
			
			if (base64_decode($_REQUEST[encabezados])=='true') $n=2;
			else $n=1;
			
			for ($i=$n;$i<=$filas;$i++) {
				$codigoXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[0].$i)->getValue());
				$nombreXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[1].$i)->getValue());
				$ecuacionPatrimonialXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[2].$i)->getValue());
				$nivelDetalleXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[3].$i)->getValue());
				$naturalezaXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[4].$i)->getValue());
				
				$errorXls=false;
					
				if ($codigoXls!=''||$nombreXls!=''||$ecuacionPatrimonialXls!=''||$nivelDetalleXls!=''||$naturalezaXls!='') {
				
					if (trim($codigoXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Código de la cuenta PUC viene vacio.";
					}
					
					if (trim($nombreXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Nombre de la cuenta PUC viene vacio.";
					}
					
					if (trim($ecuacionPatrimonialXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Ecuación patrimonial viene vacia.";
					} else {
						if (array_search($ecuacionPatrimonialXls, $cdEcPa)===false) {
							$no_similar=0;
							for ($j=0;$j<count($nmEcPa);$j++) {
								similar_text(strtoupper($ecuacionPatrimonialXls), $nmEcPa[$j],$percent);
								if ($percent>$no_similar&&$percent>50) {
									$no_similar=$percent;
									$ecuacionPatrimonialXls=$cdEcPa[$j];
								}
							}
							
							if (array_search($ecuacionPatrimonialXls, $cdEcPa)===false) {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Ecuación patrimonial nos es valida, valores permitidos: AC= ACTIVO, PA= PASIVO, CA= CAPITAL, ".
								"IN= INGRESO, EG= EGRESO, CO= COSTO, OD= CUENTAS DE ORDEN DEUDORAS, OA= CUENTAS DE ORDEN ACREEDORAS";
							}
						}
					}
					
					if (trim($nivelDetalleXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Nivel de detalle viene vacio.";
					} else {
						if (!is_numeric($nivelDetalleXls)) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Nivel de detalle debe ser numerico.";
						}
					}
					
					if (trim($naturalezaXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza de la cuenta viene vacia.";
					} else {
						if (array_search($naturalezaXls, $cdNat)===false) {
							$no_similar=0;
							for ($j=0;$j<count($nmNat);$j++) {
								similar_text(strtoupper($naturalezaXls), $nmNat[$j],$percent);
								if ($percent>$no_similar&&$percent>50) {
									$no_similar=$percent;
									$naturalezaXls=$cdNat[$j];
								}
							}
							
							if (array_search($naturalezaXls, $cdNat)===false) {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza de la cuenta nos es valida, valores permitidos: D= DÉBITO, C= CRÉDITO";
							}
						}
					}
					
					if (!$errorXls) {
						
						if (array_search($codigoXls,$codigo)===false) {
							$accion='A';
							$datos_ant[$m]="";
						} else {
							$accion='M';
							$e=array_search($codigoXls, $codigo);
							$datos_ant[$m]="cup_cliente=$cliente[$e]; cup_codigo=$codigo[$e]; cup_nombre=$nombre[$e]; cup_ecuacion_patrimonial=$ecuacion_patrimonial[$e]; ".
							"cup_nivel_detalle=$nivel_detalle[$e]; cup_naturaleza=$naturaleza[$e]";
						}
						
						$this->CuentaPucEntidad->setIdx(count($this->CuentaPucEntidad->getCodigo()));
						$this->CuentaPucEntidad->setCliente(pg_escape_string(base64_decode($_REQUEST[cliente])));
						$this->CuentaPucEntidad->setCodigo(pg_escape_string($codigoXls));
						$this->CuentaPucEntidad->setNombre(pg_escape_string($nombreXls));
						$this->CuentaPucEntidad->setEcuacionPatrimonial(pg_escape_string($ecuacionPatrimonialXls));
						$this->CuentaPucEntidad->setNivelDetalle(pg_escape_string($nivelDetalleXls));
						$this->CuentaPucEntidad->setNaturaleza(pg_escape_string($naturalezaXls));
						$this->CuentaPucEntidad->setAccion($accion);
						
						$cliente_p[$m]=base64_decode($_REQUEST[cliente]);
						$codigo_p[$m]=$codigoXls;
						$datos_des[$m]="cup_cliente=$cliente_p[$m]; cup_codigo=$codigo_p[$m]; cup_nombre=$nombreXls; cup_ecuacion_patrimonial=$ecuacionPatrimonialXls; ".
						"cup_nivel_detalle=$nivelDetalleXls; cup_naturaleza=$naturalezaXls";
						$m++;
						
					}
				}
			}
			
		} else {
			if (base64_decode($_REQUEST[delimitador_campo])=='{Tabuladores}') $del='	';
			else if (base64_decode($_REQUEST[delimitador_campo])=='{Espacio}') $del=' ';
			else $del=base64_decode($_REQUEST[delimitador_campo]);
			
			if (base64_decode($_REQUEST[encabezados])=='true') $n=2;
			else $n=1;
			$j=0;
			$fila=1;
			
			if (($gestor = fopen(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]), "r")) !== false) {
				while (($datos = fgetcsv($gestor, 1000, $del)) !== false) {
					if ($fila>=$n) {
						$codigoXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[0])-1];
						$nombreXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[1])-1];
						$ecuacionPatrimonialXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[2])-1];
						$nivelDetalleXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[3])-1];
						$naturalezaXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[4])-1];
						
						$errorXls=false;
						
						if ($codigoXls!=''||$nombreXls!=''||$ecuacionPatrimonialXls!=''||$nivelDetalleXls!=''||$naturalezaXls!='') {
							
							if (trim($codigoXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Código de la cuenta PUC viene vacio.";
							}
							
							if (trim($nombreXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Nombre de la cuenta PUC viene vacio.";
							}
							
							if (trim($ecuacionPatrimonialXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Ecuación patrimonial viene vacia.";
							} else {
								if (array_search($ecuacionPatrimonialXls, $cdEcPa)===false) {
									$no_similar=0;
									for ($j=0;$j<count($nmEcPa);$j++) {
										similar_text(strtoupper($ecuacionPatrimonialXls), $nmEcPa[$j],$percent);
										if ($percent>$no_similar&&$percent>50) {
											$no_similar=$percent;
											$ecuacionPatrimonialXls=$cdEcPa[$j];
										}
									}
										
									if (array_search($ecuacionPatrimonialXls, $cdEcPa)===false) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Ecuación patrimonial nos es valida, valores permitidos: AC= ACTIVO, PA= PASIVO, CA= ".
										"CAPITAL, IN= INGRESO, EG= EGRESO, OD= CUENTAS DE ORDEN DEUDORAS, OA= CUENTAS DE ORDEN ACREEDORAS";
									}
								}
							}
							
							if (trim($nivelDetalleXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Nivel de detalle viene vacio.";
							} else {
								if (!is_numeric($nivelDetalleXls)) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Nivel de detalle debe ser numerico.";
								}
							}
							
							if (trim($naturalezaXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Naturaleza de la cuenta viene vacia.";
							} else {
								if (array_search($naturalezaXls, $cdNat)===false) {
									$no_similar=0;
									for ($j=0;$j<count($nmNat);$j++) {
										similar_text(strtoupper($naturalezaXls), $nmNat[$j],$percent);
										if ($percent>$no_similar&&$percent>50) {
											$no_similar=$percent;
											$naturalezaXls=$cdNat[$j];
										}
									}
										
									if (array_search($naturalezaXls, $cdNat)===false) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$fila."||Naturaleza de la cuenta nos es valida, valores permitidos: D= DÉBITO, C= CRÉDITO";
									}
								}
							}
							
							if (!$errorXls) {
								$this->CuentaPucEntidad->setWhere(" and cp.cup_cliente=".base64_decode($_REQUEST[cliente])." and cp.cup_codigo='$codigoXls'");
								$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
								
								if (array_search($codigoXls,$codigo)===false) {
									$accion='A';
									$datos_ant[$m]="";
									
								} else {
									$accion='M';
									$e=array_search($codigoXls, $codigo);
									$datos_ant[$m]="cup_cliente=$cliente[$e]; cup_codigo=$codigo[$e]; cup_nombre=$nombre[$e]; cup_ecuacion_patrimonial=$ecuacion_patrimonial[$e]; ".
									"cup_nivel_detalle=$nivel_detalle[$e]; cup_naturaleza=$naturaleza[$e]";
								}
								
								$this->CuentaPucEntidad->setIdx(count($this->CuentaPucEntidad->getCodigo()));
								$this->CuentaPucEntidad->setCliente(pg_escape_string(base64_decode($_REQUEST[cliente])));
								$this->CuentaPucEntidad->setCodigo(pg_escape_string($codigoXls));
								$this->CuentaPucEntidad->setNombre(pg_escape_string($nombreXls));
								$this->CuentaPucEntidad->setEcuacionPatrimonial(pg_escape_string($ecuacionPatrimonialXls));
								$this->CuentaPucEntidad->setNivelDetalle(pg_escape_string($nivelDetalleXls));
								$this->CuentaPucEntidad->setNaturaleza(pg_escape_string($naturalezaXls));
								$this->CuentaPucEntidad->setAccion($accion);
								
								$cliente_p[$m]=base64_decode($_REQUEST[cliente]);
								$codigo_p[$m]=$codigoXls;
								$datos_des[$m]="cup_cliente=$cliente_p[$m]; cup_codigo=$codigo_p[$m]; cup_nombre=$nombreXls; cup_ecuacion_patrimonial=$ecuacionPatrimonialXls; ".
								"cup_nivel_detalle=$nivelDetalleXls; cup_naturaleza=$naturalezaXls";
								$m++;
							}
						}
					}
					$fila++;
				}
				fclose($gestor);
			}
		}
		
		if (count($this->CuentaPucEntidad->getCliente())>0) {
			$cuentaPucRetorna=$this->NegocioFacade->modificarCuentaPuc($this->CuentaPucEntidad);
				
			if (is_string($cuentaPucRetorna->getResultado())) {
				echo 'error##'.$cuentaPucRetorna->getResultado();
				return;
			}
			
			for ($i=0;$i<count($cliente_p);$i++) {
				$this->ModificadorTablasEntidad->setIdx($i);
				$this->ModificadorTablasEntidad->setTabla('iau_cuenta_puc');
				$this->ModificadorTablasEntidad->setLlave(pg_escape_string("$cliente_p[$i]##$codigo_p[$i]"));
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string($datos_ant[$i]));
				$this->ModificadorTablasEntidad->setDatosDespues(pg_escape_string($datos_des[$i]));
			}
			
			$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
			
			if (is_string($modificadorTablasRetorna->getResultado())) {
				echo 'error##'.$modificadorTablasRetorna->getResultado();
				return;
			}
		}
		
		if (count($inconsistenciasXls)>0) {
			// Create nuevo PHPExcel objeto
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator(utf8_encode("Itzamná SAS"))
			->setLastModifiedBy(utf8_encode("Itzamná SAS"))
			->setTitle(utf8_encode("Itzamná Auditor"))
			->setSubject(utf8_encode("Inconsistencias."))
			->setDescription(utf8_encode("Inconsistencias."))
			->setKeywords(utf8_encode("Inconsistencias."));
			$objPHPExcel->setActiveSheetIndex(0);
			//ENCABEZADO Y PIE DE PAGINA
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Inconsistencias');
			
			$format=
			array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial',
							'bold' => true
					),
					'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('argb' => 'FFffcccc')
					)
			);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($format);
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1',utf8_encode('FILA'));
			$objPHPExcel->getActiveSheet()->setCellValue('B1',utf8_encode('INCONSISTENCIA'));
			
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
			
			$format1=
			array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial'
					)
			);
			
			$format2=
			array(
					'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial'
					)
			);
			
			
			$f=2;
			
			for ($i=0;$i<count($inconsistenciasXls);$i++) {
				$datos=explode('||', $inconsistenciasXls[$i]);
				$objPHPExcel->getActiveSheet()->getStyle("A$f:A$f")->applyFromArray($format1);
				$objPHPExcel->getActiveSheet()->getStyle("B$f:B$f")->applyFromArray($format2);
				$objPHPExcel->getActiveSheet()->getStyle("A$f:B$f")->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$f,utf8_encode($datos[0]));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$f,utf8_encode($datos[1]));
				$f++;
			}
			
			$nm_archivo="inconsistenciasctapuc".date('YmdHis').".xls";
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save(sys_get_temp_dir().'/itz_auditor/'.$nm_archivo);
			echo 'advertencia##Existen inconsistencias en la informaci&oacute;n sumnistrada. Descargarlas en el siguiente enlace: <a href="../../Plantillas/plantilla'.
			'Inconsistencias.php?nmArchivo='.base64_encode($nm_archivo).'" title="Descargar Inconsistencias">Descargar Inconsistencias</a>';
		}
		unlink(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
	}
	
	function vMovimiento() {
		
		$cdDebCre=array('D','C');
		$nmDebCre=array('DÉBITO','CRÉDITO');
		$columnas=explode(',',base64_decode($_REQUEST[columnas]));
		
		$m=0;
		$anioMesXls=base64_decode($_REQUEST[anio]).base64_decode($_REQUEST[mes]);
		
		if (base64_decode($_REQUEST[delimitador_campo])=='') {
			$objPHPExcel = PHPExcel_IOFactory::load(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
			$filas=$objPHPExcel->getActiveSheet()->getHighestDataRow();
			
			$this->CuentaPucEntidad->setWhere(" and cp.cup_cliente=".pg_escape_string(base64_decode($_REQUEST[cliente])));
			$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
			$cuentePucCliente=$cuentaPucRetorna->getCodigo();
			
			if (base64_decode($_REQUEST[encabezados])=='true') $n=2;
			else $n=1;
			
			for ($i=$n;$i<=$filas;$i++) {
				if (is_numeric(strpos($columnas[0], 'vacio'))) $noComprobanteXls= '';
				else $noComprobanteXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[0].$i)->getValue());
				
				if (is_numeric(strpos($columnas[1], 'vacio'))) $cdComprobanteXls= '';
				else $cdComprobanteXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[1].$i)->getValue());
				
				if (is_numeric(strpos($columnas[2], 'vacio'))) $nmComprobanteXls= '';
				else $nmComprobanteXls= utf8_decode(trim($objPHPExcel->getActiveSheet()->getCell($columnas[2].$i)->getValue()));
				
				if (is_numeric(strpos($columnas[3], 'vacio'))) $fechaXls= '';
				else $fechaXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[3].$i)->getValue());
				
				if (is_numeric(strpos($columnas[4], 'vacio'))) $cuentaPUCXls= '';
				else $cuentaPUCXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[4].$i)->getValue());
				
				if (is_numeric(strpos($columnas[5], 'vacio'))) $terceroXls= '';
				else $terceroXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[5].$i)->getValue());
				
				if (is_numeric(strpos($columnas[5], 'vacio'))) $segundoTerceroXls= '';
				else $segundoTerceroXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[6].$i)->getValue());
				
				if (is_numeric(strpos($columnas[7], 'vacio'))) $centroCostoXls= '';
				else $centroCostoXls= utf8_decode(trim($objPHPExcel->getActiveSheet()->getCell($columnas[7].$i)->getValue()));
				
				if (is_numeric(strpos($columnas[8], 'vacio'))) $detalleXls= '';
				else $detalleXls= utf8_decode(trim($objPHPExcel->getActiveSheet()->getCell($columnas[8].$i)->getValue()));
				
				if (is_numeric(strpos($columnas[9], 'vacio'))) $naturalezaXls= '';
				else $naturalezaXls= utf8_decode(strtoupper($objPHPExcel->getActiveSheet()->getCell($columnas[9].$i)->getValue()));
				
				if (is_numeric(strpos($columnas[10], 'vacio'))) $valorXls= '';
				else $valorXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[10].$i)->getValue());
				
				if (is_numeric(strpos($columnas[11], 'vacio'))) $usuarioEmpresaXls= '';
				else $usuarioEmpresaXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[11].$i)->getValue());
				
				if (is_numeric(strpos($columnas[12], 'vacio'))) $fechaEmpresaXls= '';
				else $fechaEmpresaXls= utf8_decode($objPHPExcel->getActiveSheet()->getCell($columnas[12].$i)->getValue());
				
				if (is_numeric(strpos($columnas[13], 'vacio'))) $estadoXls= '';
				else $estadoXls= utf8_decode(strtoupper($objPHPExcel->getActiveSheet()->getCell($columnas[13].$i)->getValue()));
				
				$errorXls=false;
				
				if ($noComprobanteXls!=''||$cdComprobanteXls!=''||$nmComprobanteXls!=''||$fechaXls!=''||$cuentaPUCXls!=''||$auxiliarXls!=''||$centroCostoXls!=''||$detalleXls!=''
				||$naturalezaXls!=''||$valorXls!=''||$estadoXls!=''||$usuarioEmpresaXls!=''||$fechaEmpresaXls!='') {
					
					if (trim($noComprobanteXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Número de comprobante viene vacio.";
					} else {
						if (is_numeric($noComprobanteXls)==false) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Número de comprobante no es numerico.";
						}
					}
					
					if (trim($cdComprobanteXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Código del comprobante viene vacio.";
					}
					
					if (trim($fechaXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha del movimiento viene vacia.";
					} else {
						
						switch (base64_decode($_REQUEST[formato_fecha])) {
							case "AAAA-MM-DD":
								$fecha=explode('-', $fechaXls);
								$anio=$fecha[0];
								$mes=$fecha[1];
								$dia=$fecha[2];
								break;
							case "DD-MM-AAAA":
								$fecha=explode('-', $fechaXls);
								$anio=$fecha[2];
								$mes=$fecha[1];
								$dia=$fecha[0];
								break;
							case "AAAA/MM/DD":
								$fecha=explode('/', $fechaXls);
								$anio=$fecha[0];
								$mes=$fecha[1];
								$dia=$fecha[2];
								break;
							case "DD/MM/AAAA":
								$fecha=explode('/', $fechaXls);
								$anio=$fecha[2];
								$mes=$fecha[1];
								$dia=$fecha[0];
								break;
							case "AAAAMMDD":
								$anio=substr($fechaXls, 0, 4);
								$mes=substr($fechaXls, 4, 2);
								$dia=substr($fechaXls, 6, 2);
								break;
							case "DDMMAAAA":
								$anio=substr($fechaXls, 4, 4);
								$mes=substr($fechaXls, 2, 2);
								$dia=substr($fechaXls, 0, 2);
								break;
						}
						
						$esBisiesto='';
						
						if (is_numeric($anio)==false) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha del movimiento.";
						} else {
							if (strlen($anio)!=4) {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha del movimiento.";
							} else {
								if (is_numeric($mes)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha del movimiento.";
								} else {
									if (strlen($mes)>2) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha del movimiento.";
									} else {
										if (intval($mes)>12||intval($mes)<=0) {
											$errorXls=true;
											$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha del movimiento.";
										} else {
											if (is_numeric($dia)==false) {
												$errorXls=true;
												$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha del movimiento.";
											} else {
												if (strlen($dia)>2) {
													$errorXls=true;
													$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha del movimiento.";
												} else {
													$ultimoDia=intval(date("t",mktime( 0, 0, 0, $mes, 1, $anio )));
													if (intval($dia)>$ultimoDia||intval($dia)<=0) {
														$errorXls=true;
														$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha del movimiento.";
													} else {
														if ($anioMesXls!=$anio.$mes) {
															$errorXls=true;
															$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha del movimiento fuera del rango.";
														} else {
															$fechaXls="$anio-$mes-$dia";
														}
													}
												}
											}
										}
									}
								}
							}
						}
						
					}
					
					if (trim($cuentaPUCXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Cuenta PUC viene vacia.";
					} else {
						
						if (array_search($cuentaPUCXls, $cuentePucCliente)===false) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Cuenta PUC ".$cuentaPUCXls." no existe para el cliente seleccionado.";
						}
					}
					
					if (trim($naturalezaXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza del movimiento viene vacia.";
					} else {
						if (array_search($naturalezaXls, $cdDebCre)===false) {
							$no_similar=0;
							for ($j=0;$j<count($nmDebCre);$j++) {
								similar_text(strtoupper($naturalezaXls), $nmDebCre[$j],$percent);
								if ($percent>$no_similar&&$percent>50) {
									$no_similar=$percent;
									$naturalezaXls=$cdNat[$j];
								}
							}
							
							if (array_search($naturalezaXls, $cdDebCre)===false) {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza del movimiento no es valida, valores permitidos: D= DÉBITO, C= CRÉDITO";
							}
						}
					}
					
					if (trim($valorXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Valor del movimiento viene vacio.";
					} else {
						$valorXls=str_replace(',', '.', $valorXls);
						if (is_numeric($valorXls)==false) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Valor del movimiento no es numerico.";
						}
					}
					
					if (trim($usuarioEmpresaXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Usuario de la empresa viene vacio.";
					}
					
					if (trim($fechaEmpresaXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha de la empresa viene vacia.";
					} else {
					
						switch (base64_decode($_REQUEST[formato_fecha])) {
							case "AAAA-MM-DD":
								$fecha=explode('-', $fechaEmpresaXls);
								$anio=$fecha[0];
								$mes=$fecha[1];
								$dia=$fecha[2];
								break;
							case "DD-MM-AAAA":
								$fecha=explode('-', $fechaEmpresaXls);
								$anio=$fecha[2];
								$mes=$fecha[1];
								$dia=$fecha[0];
								break;
							case "AAAA/MM/DD":
								$fecha=explode('/', $fechaEmpresaXls);
								$anio=$fecha[0];
								$mes=$fecha[1];
								$dia=$fecha[2];
								break;
							case "DD/MM/AAAA":
								$fecha=explode('/', $fechaEmpresaXls);
								$anio=$fecha[2];
								$mes=$fecha[1];
								$dia=$fecha[0];
								break;
							case "AAAAMMDD":
								$anio=substr($fechaEmpresaXls, 0, 4);
								$mes=substr($fechaEmpresaXls, 4, 2);
								$dia=substr($fechaEmpresaXls, 6, 2);
								break;
							case "DDMMAAAA":
								$anio=substr($fechaEmpresaXls, 4, 4);
								$mes=substr($fechaEmpresaXls, 2, 2);
								$dia=substr($fechaEmpresaXls, 0, 2);
								break;
						}
					
						$esBisiesto='';
					
						if (is_numeric($anio)==false) {
							$errorXls=true;
							$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha de la empresa.";
						} else {
							if (strlen($anio)!=4) {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha de la empresa.";
							} else {
								if (is_numeric($mes)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
								} else {
									if (strlen($mes)>2) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
									} else {
										if (intval($mes)>12||intval($mes)<=0) {
											$errorXls=true;
											$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
										} else {
											if (is_numeric($dia)==false) {
												$errorXls=true;
												$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
											} else {
												if (strlen($dia)>2) {
													$errorXls=true;
													$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
												} else {
													$ultimoDia=intval(date("t",mktime( 0, 0, 0, $mes, 1, $anio )));
													if (intval($dia)>$ultimoDia||intval($dia)<=0) {
														$errorXls=true;
														$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
													} else {
														$fechaEmpresaXls="$anio-$mes-$dia";
													}
												}
											}
										}
									}
								}
							}
						}
						
					}
					
					if (trim($estadoXls)=='') {
						$errorXls=true;
						$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Estado del movimiento viene vacio.";
					}
					
					if (!$errorXls) {
						if ($mov=='') $mov=1;
						else $mov++;
						
						$this->MovimientoEntidad->setIdx(count($this->MovimientoEntidad->getCliente()));
						$this->MovimientoEntidad->setCliente(pg_escape_string(base64_decode($_REQUEST[cliente])));
						$this->MovimientoEntidad->setNumeroComprobante(pg_escape_string($noComprobanteXls));
						$this->MovimientoEntidad->setCodigoComprobante(pg_escape_string($cdComprobanteXls));
						$this->MovimientoEntidad->setNombreComprobante(pg_escape_string($nmComprobanteXls));
						$this->MovimientoEntidad->setFechaMovimiento(pg_escape_string($fechaXls));
						$this->MovimientoEntidad->setAnioMes(pg_escape_string($anioMesXls));
						$this->MovimientoEntidad->setConsecutivo(pg_escape_string($mov));
						$this->MovimientoEntidad->setCuentaPuc(pg_escape_string($cuentaPUCXls));
						$this->MovimientoEntidad->setTercero(pg_escape_string($terceroXls));
						$this->MovimientoEntidad->setSegundoTercero(pg_escape_string($segundoTerceroXls));
						$this->MovimientoEntidad->setCentroCosto(pg_escape_string($centroCostoXls));
						$this->MovimientoEntidad->setDetalle(pg_escape_string($detalleXls));
						$this->MovimientoEntidad->setNaturaleza(pg_escape_string($naturalezaXls));
						$this->MovimientoEntidad->setValor(pg_escape_string($valorXls));
						$this->MovimientoEntidad->setEstado(pg_escape_string($estadoXls));
						$this->MovimientoEntidad->setUsuarioEmpresa(pg_escape_string($usuarioEmpresaXls));
						$this->MovimientoEntidad->setFechaEmpresa(pg_escape_string($fechaEmpresaXls));
						$m++;
						
					}
				}
			}
			
		} else {
			if (base64_decode($_REQUEST[delimitador_campo])=='{Tabuladores}') $del='	';
			else if (base64_decode($_REQUEST[delimitador_campo])=='{Espacio}') $del=' ';
			else $del=base64_decode($_REQUEST[delimitador_campo]);
			
			if (base64_decode($_REQUEST[encabezados])=='true') $n=2;
			else $n=1;
			$j=0;
			$fila=1;
			
			if (($gestor = fopen(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]), "r")) !== false) {
				while (($datos = fgetcsv($gestor, 1000, $del)) !== false) {
					if ($fila>=$n) {
						
						if (is_numeric(strpos($columnas[0], 'vacio'))) $noComprobanteXls= '';
						else $noComprobanteXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[0])-1];
						
						if (is_numeric(strpos($columnas[1], 'vacio'))) $cdComprobanteXls= '';
						else $cdComprobanteXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[1])-1];
						
						if (is_numeric(strpos($columnas[2], 'vacio'))) $nmComprobanteXls= '';
						else $nmComprobanteXls= trim($datos[PHPExcel_Cell::columnIndexFromString($columnas[2])-1]);
						
						if (is_numeric(strpos($columnas[3], 'vacio'))) $fechaXls= '';
						else $fechaXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[3])-1];
						
						if (is_numeric(strpos($columnas[4], 'vacio'))) $cuentaPUCXls= '';
						else $cuentaPUCXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[4])-1];
						
						if (is_numeric(strpos($columnas[5], 'vacio'))) $terceroXls= '';
						else $terceroXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[5])-1];
						
						if (is_numeric(strpos($columnas[6], 'vacio'))) $segundoTerceroXls= '';
						else $segundoTerceroXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[6])-1];
						
						if (is_numeric(strpos($columnas[7], 'vacio'))) $centroCostoXls= '';
						else $centroCostoXls= trim($datos[PHPExcel_Cell::columnIndexFromString($columnas[7])-1]);
						
						if (is_numeric(strpos($columnas[8], 'vacio'))) $detalleXls= '';
						else $detalleXls= trim($datos[PHPExcel_Cell::columnIndexFromString($columnas[8])-1]);
						
						if (is_numeric(strpos($columnas[9], 'vacio'))) $naturalezaXls= '';
						else $naturalezaXls= strtoupper($datos[PHPExcel_Cell::columnIndexFromString($columnas[9])-1]);
						
						if (is_numeric(strpos($columnas[10], 'vacio'))) $valorXls= '';
						else $valorXls= $datos[PHPExcel_Cell::columnIndexFromString($columnas[10])-1];
						
						if (is_numeric(strpos($columnas[11], 'vacio'))) $usuarioEmpresaXls= '';
						else $usuarioEmpresaXls= strtoupper($datos[PHPExcel_Cell::columnIndexFromString($columnas[11])-1]);
						
						if (is_numeric(strpos($columnas[12], 'vacio'))) $fechaEmpresaXls= '';
						else $fechaEmpresaXls= strtoupper($datos[PHPExcel_Cell::columnIndexFromString($columnas[12])-1]);
						
						if (is_numeric(strpos($columnas[13], 'vacio'))) $estadoXls= '';
						else $estadoXls= strtoupper($datos[PHPExcel_Cell::columnIndexFromString($columnas[13])-1]);
						
						$errorXls=false;
						
						if ($noComprobanteXls!=''||$cdComprobanteXls!=''||$nmComprobanteXls!=''||$fechaXls!=''||$cuentaPUCXls!=''||$auxiliarXls!=''||$centroCostoXls!=''||
						$detalleXls!=''||$naturalezaXls!=''||$valorXls!=''||$estadoXls!=''||$usuarioEmpresaXls!=''||$fechaEmpresaXls!='') {
							
							if (trim($noComprobanteXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Número de comprobante viene vacio.";
							} else {
								if (is_numeric($noComprobanteXls)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Número de comprobante no es numerico.";
								}
							}
							
							if (trim($cdComprobanteXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Código del comprobante viene vacio.";
							}
							
							if (trim($fechaXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha del movimiento viene vacia.";
							} else {
								
								switch (base64_decode($_REQUEST[formato_fecha])) {
									case "AAAA-MM-DD":
										$fecha=explode('-', $fechaXls);
										$anio=$fecha[0];
										$mes=$fecha[1];
										$dia=$fecha[2];
										break;
									case "DD-MM-AAAA":
										$fecha=explode('-', $fechaXls);
										$anio=$fecha[2];
										$mes=$fecha[1];
										$dia=$fecha[0];
										break;
									case "AAAA/MM/DD":
										$fecha=explode('/', $fechaXls);
										$anio=$fecha[0];
										$mes=$fecha[1];
										$dia=$fecha[2];
										break;
									case "DD/MM/AAAA":
										$fecha=explode('/', $fechaXls);
										$anio=$fecha[2];
										$mes=$fecha[1];
										$dia=$fecha[0];
										break;
									case "AAAAMMDD":
										$anio=substr($fechaXls, 0, 4);
										$mes=substr($fechaXls, 4, 2);
										$dia=substr($fechaXls, 6, 2);
										break;
									case "DDMMAAAA":
										$anio=substr($fechaXls, 4, 4);
										$mes=substr($fechaXls, 2, 2);
										$dia=substr($fechaXls, 0, 2);
										break;
								}
								
								$esBisiesto='';
								
								if (is_numeric($anio)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido.";
								} else {
									if (strlen($anio)!=4) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido.";
									} else {
										if (is_numeric($mes)==false) {
											$errorXls=true;
											$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido.";
										} else {
											if (strlen($mes)>2) {
												$errorXls=true;
												$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido.";
											} else {
												if (intval($mes)>12||intval($mes)<=0) {
													$errorXls=true;
													$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido.";
												} else {
													if (is_numeric($dia)==false) {
														$errorXls=true;
														$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido.";
													} else {
														if (strlen($dia)>2) {
															$errorXls=true;
															$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido.";
														} else {
															$ultimoDia=intval(date("t",mktime( 0, 0, 0, $mes, 1, $anio )));
															if (intval($dia)>$ultimoDia||intval($dia)<=0) {
																$errorXls=true;
																$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido.";
															} else {
															if ($anioMesXls!=$anio.$mes) {
																$errorXls=true;
																$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha fuera del rango.";
															} else {
																$fechaXls="$anio-$mes-$dia";
															}
															}
														}
													}
												}
											}
										}
									}
								}
							
							}
							
							if (trim($cuentaPUCXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Cuenta PUC viene vacia.";
							} else {
								if (array_search($cuentaPUCXls, $cuentePucCliente)===false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Cuenta PUC ".$cuentaPUCXls." no existe para el cliente seleccionado.";
								}
							}
							
							if (trim($naturalezaXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza del movimiento viene vacia.";
							} else {
								if (array_search($naturalezaXls, $cdDebCre)===false) {
									$no_similar=0;
									for ($j=0;$j<count($nmDebCre);$j++) {
										similar_text(strtoupper($naturalezaXls), $nmDebCre[$j],$percent);
										if ($percent>$no_similar&&$percent>50) {
											$no_similar=$percent;
											$naturalezaXls=$cdNat[$j];
										}
									}
									
									if (array_search($naturalezaXls, $cdDebCre)===false) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Naturaleza del movimiento no es valida, valores permitidos: D= DÉBITO, C= CRÉDITO";
									}
								}
							}
							
							if (trim($valorXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Valor del movimiento viene vacio.";
							} else {
								if (is_numeric($valorXls)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Valor del movimiento no es numerico.";
								}
							}
							
							if (trim($usuarioEmpresaXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Usuario de la empresa viene vacio.";
							}
								
							if (trim($fechaEmpresaXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Fecha de la empresa viene vacia.";
							} else {
									
								switch (base64_decode($_REQUEST[formato_fecha])) {
									case "AAAA-MM-DD":
										$fecha=explode('-', $fechaEmpresaXls);
										$anio=$fecha[0];
										$mes=$fecha[1];
										$dia=$fecha[2];
										break;
									case "DD-MM-AAAA":
										$fecha=explode('-', $fechaEmpresaXls);
										$anio=$fecha[2];
										$mes=$fecha[1];
										$dia=$fecha[0];
										break;
									case "AAAA/MM/DD":
										$fecha=explode('/', $fechaEmpresaXls);
										$anio=$fecha[0];
										$mes=$fecha[1];
										$dia=$fecha[2];
										break;
									case "DD/MM/AAAA":
										$fecha=explode('/', $fechaEmpresaXls);
										$anio=$fecha[2];
										$mes=$fecha[1];
										$dia=$fecha[0];
										break;
									case "AAAAMMDD":
										$anio=substr($fechaEmpresaXls, 0, 4);
										$mes=substr($fechaEmpresaXls, 4, 2);
										$dia=substr($fechaEmpresaXls, 6, 2);
										break;
									case "DDMMAAAA":
										$anio=substr($fechaEmpresaXls, 4, 4);
										$mes=substr($fechaEmpresaXls, 2, 2);
										$dia=substr($fechaEmpresaXls, 0, 2);
										break;
								}
									
								$esBisiesto='';
									
								if (is_numeric($anio)==false) {
									$errorXls=true;
									$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha de la empresa.";
								} else {
									if (strlen($anio)!=4) {
										$errorXls=true;
										$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Año invalido para fecha de la empresa.";
									} else {
										if (is_numeric($mes)==false) {
											$errorXls=true;
											$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
										} else {
											if (strlen($mes)>2) {
												$errorXls=true;
												$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
											} else {
												if (intval($mes)>12||intval($mes)<=0) {
													$errorXls=true;
													$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Mes invalido para fecha de la empresa.";
												} else {
													if (is_numeric($dia)==false) {
														$errorXls=true;
														$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
													} else {
														if (strlen($dia)>2) {
															$errorXls=true;
															$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
														} else {
															$ultimoDia=intval(date("t",mktime( 0, 0, 0, $mes, 1, $anio )));
															if (intval($dia)>$ultimoDia||intval($dia)<=0) {
																$errorXls=true;
																$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Día invalido para fecha de la empresa.";
															} else {
																$fechaEmpresaXls="$anio-$mes-$dia";
															}
														}
													}
												}
											}
										}
									}
								}
								
							}
							
							if (trim($estadoXls)=='') {
								$errorXls=true;
								$inconsistenciasXls[count($inconsistenciasXls)]=$i."||Estado del movimiento viene vacio.";
							}
							
							if (!$errorXls) {
								if ($mov=='') $mov=1;
								else $mov++;
								
								$this->MovimientoEntidad->setIdx(count($this->MovimientoEntidad->getCliente()));
								$this->MovimientoEntidad->setCliente(pg_escape_string(base64_decode($_REQUEST[cliente])));
								$this->MovimientoEntidad->setNumeroComprobante(pg_escape_string($noComprobanteXls));
								$this->MovimientoEntidad->setCodigoComprobante(pg_escape_string($cdComprobanteXls));
								$this->MovimientoEntidad->setNombreComprobante(pg_escape_string($nmComprobanteXls));
								$this->MovimientoEntidad->setFechaMovimiento(pg_escape_string($fechaXls));
								$this->MovimientoEntidad->setAnioMes(pg_escape_string($anioMesXls));
								$this->MovimientoEntidad->setConsecutivo(pg_escape_string($mov));
								$this->MovimientoEntidad->setCuentaPuc(pg_escape_string($cuentaPUCXls));
								$this->MovimientoEntidad->setTercero(pg_escape_string($terceroXls));
								$this->MovimientoEntidad->setSegundoTercero(pg_escape_string($segundoTerceroXls));
								$this->MovimientoEntidad->setCentroCosto(pg_escape_string($centroCostoXls));
								$this->MovimientoEntidad->setDetalle(pg_escape_string($detalleXls));
								$this->MovimientoEntidad->setNaturaleza(pg_escape_string($naturalezaXls));
								$this->MovimientoEntidad->setValor(pg_escape_string($valorXls));
								$this->MovimientoEntidad->setEstado(pg_escape_string($estadoXls));
								$this->MovimientoEntidad->setUsuarioEmpresa(pg_escape_string($usuarioEmpresaXls));
								$this->MovimientoEntidad->setFechaEmpresa(pg_escape_string($fechaEmpresaXls));
								$m++;
							}
						}
					}
					$fila++;
				}
				fclose($gestor);
			}
		}
		
		if (count($this->MovimientoEntidad->getCliente())>0) {
			
			$this->MovimientoEntidad->setWhere(" where mov_anio_mes='$anioMesXls' and mov_cliente=".pg_escape_string(base64_decode($_REQUEST[cliente])));
			$this->MovimientoEntidad->setIdx(0);
			$this->MovimientoEntidad->setArchivo(pg_escape_string(base64_decode($_REQUEST[archivo])));
			$this->MovimientoEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
			
			$movimientoRetorna=$this->NegocioFacade->insertarMovimientoCop($this->MovimientoEntidad);
			
			if (is_string($movimientoRetorna->getResultado())) {
				echo 'error##'.$cuentaPucRetorna->getResultado();
				return;
			}
			
			$movimientoRetorna=$this->NegocioFacade->borrarMovimiento($this->MovimientoEntidad);
			
			if (is_string($movimientoRetorna->getResultado())) {
				echo 'error##'.$cuentaPucRetorna->getResultado();
				return;
			}
			
			unset($movimientoRetorna);
			
			$movimientoRetorna=$this->NegocioFacade->insertarMovimiento($this->MovimientoEntidad);
			
			if (is_string($movimientoRetorna->getResultado())) {
				echo 'error##'.$cuentaPucRetorna->getResultado();
				return;
			}
		}
		
		if (count($inconsistenciasXls)>0) {
			// Create nuevo PHPExcel objeto
			$objPHPExcel = new PHPExcel();
			// Set document properties
			$objPHPExcel->getProperties()->setCreator(utf8_encode("Itzamná SAS"))
			->setLastModifiedBy(utf8_encode("Itzamná SAS"))
			->setTitle(utf8_encode("Itzamná Auditor"))
			->setSubject(utf8_encode("Inconsistencias."))
			->setDescription(utf8_encode("Inconsistencias."))
			->setKeywords(utf8_encode("Inconsistencias."));
			$objPHPExcel->setActiveSheetIndex(0);
			//ENCABEZADO Y PIE DE PAGINA
			
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Inconsistencias');
			
			$format=
			array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial',
							'bold' => true
					),
					'fill' => array(
							'type' => PHPExcel_Style_Fill::FILL_SOLID,
							'color' => array('argb' => 'FFffcccc')
					)
			);
			
			$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($format);
			
			$objPHPExcel->getActiveSheet()->setCellValue('A1',utf8_encode('FILA'));
			$objPHPExcel->getActiveSheet()->setCellValue('B1',utf8_encode('INCONSISTENCIA'));
			
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
			
			$format1=
			array(
					'alignment' => array(
							'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial'
					)
			);
			
			$format2=
			array(
					'alignment' => array(
							'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'borders' => array(
							'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN,
							)
					),
					'font' => array(
							'size' => 10,
							'name' => 'Arial'
					)
			);
			
			
			$f=2;
			
			for ($i=0;$i<count($inconsistenciasXls);$i++) {
				$datos=explode('||', $inconsistenciasXls[$i]);
				$objPHPExcel->getActiveSheet()->getStyle("A$f:A$f")->applyFromArray($format1);
				$objPHPExcel->getActiveSheet()->getStyle("B$f:B$f")->applyFromArray($format2);
				$objPHPExcel->getActiveSheet()->getStyle("A$f:B$f")->getAlignment()->setWrapText(true);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$f,utf8_encode($datos[0]));
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$f,utf8_encode($datos[1]));
				$f++;
			}
			
			$nm_archivo="inconsistenciasctapuc".date('YmdHis').".xls";
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save(sys_get_temp_dir().'/itz_auditor/'.$nm_archivo);
			echo 'advertencia##Existen inconsistencias en la informaci&oacute;n sumnistrada. Descargarlas en el siguiente enlace: <a href="../../Plantillas/plantilla'.
			'Inconsistencias.php?nmArchivo='.base64_encode($nm_archivo).'" title="Descargar Inconsistencias">Descargar Inconsistencias</a>';
		}
		//unlink(sys_get_temp_dir().'/itz_auditor/'.base64_decode($_REQUEST[archivo]));
	}
}

$AdicionarModificar = new AdicionarModificar();
$AdicionarModificar->workflow(base64_decode($_REQUEST["ventana"]));
?>