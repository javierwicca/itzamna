<?php
namespace Controller;
setlocale(LC_CTYPE, 'es_ES');
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
require_once '../Entidades/Configuracion/CiiuEntidad.php';
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
require_once '../Entidades/General/CorreoEntidad.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';
require_once '../Negocio/General/NegocioFacade.php';
require_once '../PHPExcel/Classes/PHPExcel/IOFactory.php';

use DAO\ModificadorTablasDAO;
use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\CiiuEntidad;
use Entidades\ClientesEntidad;
use Entidades\CorreoEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DetallePagosEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
use Entidades\ImpuestoPagosEntidad;
use Entidades\LugaresEntidad;
use Entidades\ModificadorTablasEntidad;
use Entidades\ModulosEntidad;
use Entidades\ParametrosEntidad;
use Entidades\PagosEntidad;
use Entidades\PermisosExcepcionalesEntidad;
use Entidades\ProveedoresEntidad;
use Entidades\RolesEntidad;
use Entidades\RolesPermisosEntidad;
use Entidades\RolesUsuariosEntidad;
use Entidades\UsuarioEntidad;
use Negocio\NegocioFacade;
use PHPExcel_IOFactory;

class SubirMasivo{
	
	private $BienServiciosEntidad;
	private $CiiuDirectorioEntidad;
	private $CiiuEntidad;
	private $ClientesEntidad;
	private $CorreoEntidad;
	private $CuentaPucEntidad;
	private $DirectorioEntidad;
	private $DetallePagosEntidad;
	private $DocPagosEntidad;
	private $DocProveedoresEntidad;
	private $ImpuestoPagosEntidad;
	private $LugaresEntidad;
	private $ModificadorTablasEntidad;
	private $ModulosEntidad;
	private $NegocioFacade;
	private $ParametrosEntidad;
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
		if (!isset($this->CiiuEntidad)) $this->CiiuEntidad=new CiiuEntidad();
		if (!isset($this->ClientesEntidad)) $this->ClientesEntidad=new ClientesEntidad();
		if (!isset($this->CorreoEntidad)) $this->CorreoEntidad=new CorreoEntidad();
		if (!isset($this->CuentaPucEntidad)) $this->CuentaPucEntidad=new CuentaPucEntidad();
		if (!isset($this->DetallePagosEntidad)) $this->DetallePagosEntidad=new DetallePagosEntidad();
		if (!isset($this->DirectorioEntidad)) $this->DirectorioEntidad=new DirectorioEntidad();
		if (!isset($this->DocPagosEntidad)) $this->DocPagosEntidad=new DocPagosEntidad();
		if (!isset($this->DocProveedoresEntidad)) $this->DocProveedoresEntidad=new DocProveedoresEntidad();
		if (!isset($this->ImpuestoPagosEntidad)) $this->ImpuestoPagosEntidad=new ImpuestoPagosEntidad();
		if (!isset($this->LugaresEntidad)) $this->LugaresEntidad=new LugaresEntidad();
		if (!isset($this->ModificadorTablasEntidad)) $this->ModificadorTablasEntidad=new ModificadorTablasEntidad();
		if (!isset($this->ModulosEntidad)) $this->ModulosEntidad=new ModulosEntidad();
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
	
	function workflow($datos) {
		
		global $FechaInicio;
		
		$datos=explode('##',$_SERVER['HTTP_X_FILE_NAME']);
		
		$FechaInicio=base64_decode($datos[3]);
		
		if ($FechaInicio=='') $FechaInicio=date('YmsHisu');
		
		@session_name("ITZAudID-$FechaInicio");
		session_start();
		
		$subir_m= new SubirMasivo();
		
		$ventana=base64_decode($datos[1]);
		$subir_m->$ventana($datos);
		
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
			$direccion[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia])));
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia])));
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto])));
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
				$direccion[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r])));
			else $direccion[0]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))!='')
				$direccion[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r])));
			else $direccion[1]='null';
			
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))!='')
				$direccion[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r])));
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
	
	function vProveedor($datos) {
		if (!file_exists('tmp')) mkdir('tmp',0777,true);
		
		$archivo=file_get_contents("php://input");
		file_put_contents('tmp/'.base64_decode($datos[0]), $archivo);
		$objPHPExcel = PHPExcel_IOFactory::load('tmp/'.base64_decode($datos[0]));
		$i=2;
		while ($objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue()!='') {
			$identificacion_xls=str_replace(',', '', $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getValue());
			if (is_numeric($identificacion_xls)) {
				$this->DirectorioEntidad->setWhere(" and d.dir_identificacion=$identificacion_xls");
				$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
				if (pg_num_rows($directorioRetorna->getResultado())>0) {
					$accion='M';
					$identificacion=$directorioRetorna->getIdentificacion();
					
					$tipo_persona=$directorioRetorna->getTipoPersona();
					$tipo_persona_xls=$tipo_persona[0];
					if ($tipo_persona_xls!='N'&&$tipo_persona_xls!='J') $tipo_persona_xls=strtoupper(substr($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue(),0,1));
					
					$digito_v=$directorioRetorna->getDigitoV();
					if ($objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue()!='') $digito_v_xls=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
					else $digito_v_xls=$digito_v[0];
					
					$tipo_documento=$directorioRetorna->getTipoDocumento();
					$tipo_documento_xls=$tipo_documento[0];
					
					$ciudad_documento=$directorioRetorna->getLugarDocumento();
					$ciudad_documento_xls=$ciudad_documento[0];
					
					$nombres=$directorioRetorna->getNombres();
					$nombres_xls=$nombres[0];
					if ($nombres_xls=='') $nombres_xls=$objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue();
					
					$apellidos=$directorioRetorna->getApellidos();
					$apellidos_xls=$apellidos[0];
					if ($apellidos_xls=='') $apellidos_xls=$objPHPExcel->getActiveSheet()->getCell('G'.$i)->getValue();
					
					$nac=$directorioRetorna->getFechaNac();
					
					$correo=$directorioRetorna->getCorreo();
					if ($correo[0]=='') $correo_xls=$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getValue();
					else $correo_xls=$correo[0];
					
					$ciudad_nac=$directorioRetorna->getLugarNac();
					
					$direcciones=$directorioRetorna->getDireccion();
					$a_direcciones=$this->NegocioFacade->arSqlArPhp($direcciones[0]);
					
					if ($a_direcciones[0]!='NULL') $dir_residencia=$a_direcciones[0];
					if ($a_direcciones[1]!='NULL') $dir_correspondencia=$a_direcciones[1];
					if ($a_direcciones[2]!='NULL') $dir_contacto=$a_direcciones[2];
					if ($dir_residencia=='') $dir_residencia='"'.pg_escape_string($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getValue()).'"';
					
					$ciudad=$directorioRetorna->getCiudadDireccion();
					$a_ciudad_domicilio=$this->NegocioFacade->arSqlArPhp($ciudad[0]);
						
					if ($a_ciudad_domicilio[0]!='NULL') $ciudad_domicilio=$a_ciudad_domicilio[0];
					if ($ciudad_domicilio=='') $ciudad_domicilio=pg_escape_string($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getValue());
					
					if ($a_ciudad_domicilio[1]!='NULL') $ciudad_correspondencia=$a_ciudad_domicilio[1];
					
					if ($a_ciudad_domicilio[2]!='NULL') $ciudad_contacto=$a_ciudad_domicilio[2];
					
					$telefonos=$directorioRetorna->getTelefono();
					$a_telefonos=$this->NegocioFacade->arSqlArPhp($telefonos[0]);
					if ($a_telefonos[0]!='NULL') $celular=$a_telefonos[0];
					if ($a_telefonos[1]!='NULL') $telefono=$a_telefonos[1];
					if ($a_telefonos[2]!='NULL') $fax=$a_telefonos[2];
					if ($a_telefonos[3]!='NULL') $otro_tel=$a_telefonos[3];
					
					if ($celular==''&&strlen($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue())==10) 
						$celular=pg_escape_string($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue());
					if ($telefono==''&&strlen($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue())!=10) 
						$telefono=pg_escape_string($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue());
					
					$barrio=$directorioRetorna->getBarrio();
						
					$estado_d=$directorioRetorna->getEstado();
					$datos_ant="dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=$ciudad_documento[0]; ".
					"dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=$direcciones[0]; ".
					"dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; dir_lugar_nac=".
					"$ciudad_nac[0]; dir_estado=$estado_d[0]";
				} else {
					$accion='A';
					$datos_ant="";
					$tipo_persona_xls=strtoupper(substr($objPHPExcel->getActiveSheet()->getCell('E'.$i)->getValue(),0,1));
					$digito_v_xls=$objPHPExcel->getActiveSheet()->getCell('B'.$i)->getValue();
					$tipo_documento_xls=strtoupper($objPHPExcel->getActiveSheet()->getCell('D'.$i)->getValue());
					
					$this->ParametrosEntidad->setWhere(" and p.par_caracter[0]='$tipo_documento_xls' and p.par_parametro='TDIDE'");
					$parametrosRetorna=$this->NegocioFacade->listarParametros($this->ParametrosEntidad);
					
					$elemento=$parametrosRetorna->getElemento();
					$tipo_documento_xls=$elemento[0];
					
					$ciudad_documento_xls=pg_escape_string($objPHPExcel->getActiveSheet()->getCell('C'.$i)->getValue());
					if (strlen($ciudad_documento_xls)=='1') $ciudad_documento_xls='0'.$ciudad_documento_xls;
					
					if (is_numeric($ciudad_documento_xls)) {
						if (strlen($ciudad_documento_xls)=='2') $ciudad_documento_xls='COL'.$ciudad_documento_xls.'001';
						else $ciudad_documento_xls='COL'.$ciudad_documento_xls;
						$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_documento_xls'");
						$lugarRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
						
						if (pg_num_rows($lugarRetorna->getResultado())==0) $ciudad_documento_xls='';
					} else {
						$no_similar=0;
						$cd_similar='';
						$this->LugaresEntidad->setWhere(" and l.lug_tipo in ('C','D') and length(l.lug_codigo)<=8");
						$this->LugaresEntidad->setOrder('l.lug_nombre');
						$lugarRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
						$nombre=$lugarRetorna->getNombre();
						$codigo=$lugarRetorna->getCodigo();
						for ($j=0;$j<count($nombre);$j++) {
							similar_text(strtoupper(utf8_decode($ciudad_documento_xls)), strtoupper($nombre[$j]),$percent);
							if ($percent>$no_similar) {
								$no_similar=$percent;
								$cd_similar=$codigo[$j];
							}
						}
						
						if (strlen($cd_similar)==5) $cd_similar=$cd_similar.'001';
						
						$ciudad_documento_xls=$cd_similar;
					}
					$nombres_xls=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('F'.$i)->getValue()));
					if (strlen($nombres_xls)>70) $nombres_xls=substr($nombres_xls, 0, 70);
					$apellidos_xls=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('G'.$i)->getValue()));
					$dir_residencia='"'.pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('H'.$i)->getValue())).'"';
					$ciudad_domicilio=pg_escape_string($objPHPExcel->getActiveSheet()->getCell('K'.$i)->getValue());
					
					if (strlen($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue())==10) 
						$celular=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue()));
					if (strlen($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue())!=10) 
						$telefono=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('I'.$i)->getValue()));
					
					$correo_xls=$objPHPExcel->getActiveSheet()->getCell('J'.$i)->getValue();
				}
				
				if (strlen($ciudad_domicilio)=='1') $ciudad_domicilio='0'.$ciudad_domicilio;
					
				if (is_numeric($ciudad_domicilio)) {
					if (strlen($ciudad_domicilio)=='2') $ciudad_domicilio='COL'.$ciudad_domicilio.'001';
					else $ciudad_domicilio='COL'.$ciudad_domicilio;
					$this->LugaresEntidad->setWhere(" and l.lug_codigo='$ciudad_domicilio'");
					$lugarRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
				
					if (pg_num_rows($lugarRetorna->getResultado())==0) $ciudad_domicilio='';
				} else {
					$no_similar=0;
					$cd_similar='';
					$this->LugaresEntidad->setWhere(" and l.lug_tipo in ('C','D') and length(l.lug_codigo)<=8");
					$this->LugaresEntidad->setOrder('l.lug_nombre');
					$lugarRetorna=$this->NegocioFacade->listarLugares($this->LugaresEntidad);
					$nombre=$lugarRetorna->getNombre();
					$codigo=$lugarRetorna->getCodigo();
					for ($j=0;$j<count($nombre);$j++) {
						similar_text(strtoupper(utf8_decode($ciudad_domicilio)), strtoupper($nombre[$j]),$percent);
						if ($percent>$no_similar) {
							$no_similar=$percent;
							$cd_similar=$codigo[$j];
						}
					}
				
					if (strlen($cd_similar)==5) $cd_similar=$cd_similar.'001';
				
					$ciudad_domicilio=$cd_similar;
				}
				
				$this->DirectorioEntidad->setIdx(0);
				$this->DirectorioEntidad->setIdentificacion($identificacion_xls);
				$this->DirectorioEntidad->setTipoDocumento($tipo_documento_xls);
				$this->DirectorioEntidad->setLugarDocumento($ciudad_documento_xls);
				$this->DirectorioEntidad->setDigitoV($digito_v_xls);
				$this->DirectorioEntidad->setTipoPersona($tipo_persona_xls);
				if ($tipo_persona_xls=='N') $this->DirectorioEntidad->setApellidos($apellidos_xls);
				else $this->DirectorioEntidad->setApellidos('');
				$this->DirectorioEntidad->setNombres($nombres_xls);
				
				if ($dir_residencia!='') $direccion[0]=$dir_residencia;
				else $direccion[0]='null';
				
				if ($dir_correspondencia!='') $direccion[1]=$dir_correspondencia;
				else $direccion[1]='null';
				
				if ($dir_contacto!='') $direccion[2]=$dir_contacto;
				else $direccion[2]='null';
				
				$this->DirectorioEntidad->setDireccion($this->NegocioFacade->arPhpArSql($direccion));
				
				if ($celular!='') $telefonos[0]=$celular;
				else $telefonos[0]='null';
				
				if ($telefono!='') $telefonos[1]=$telefono;
				else $telefonos[1]='null';
				
				if ($fax!='') $telefonos[2]=$fax;
				else $telefonos[2]='null';
				
				if ($otro_tel!='') $telefonos[3]=$otro_tel;
				else $telefonos[3]='null';
				
				$this->DirectorioEntidad->setTelefono($this->NegocioFacade->arPhpArSql($telefonos));
				
				$this->DirectorioEntidad->setCorreo($correo_xls);
				
				if ($ciudad_domicilio!='') $ciudad[0]=$ciudad_domicilio;
				else $ciudad[0]='null';
				
				if ($ciudad_correspondencia!='') $ciudad[1]=$ciudad_correspondencia;
				else $ciudad[1]='null';
				
				if ($ciudad_contacto!='') $ciudad[2]=$ciudad_contacto;
				else $ciudad[2]='null';
				
				$this->DirectorioEntidad->setCiudadDireccion($this->NegocioFacade->arPhpArSql($ciudad));
				
				$this->DirectorioEntidad->setFechaNac($nac[0]);
				$this->DirectorioEntidad->setLugarNac($ciudad_nac[0]);
				$this->DirectorioEntidad->setEstado('A');
				
				switch ($accion) {
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
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant);
				$this->ModificadorTablasEntidad->setDatosDespues("dir_identificacion=$identificacion[0]; dir_tipo_documento=$tipo_documento[0]; dir_lugar_documento=".
				"$ciudad_documento[0]; dir_digito_v=$digito_v[0]; dir_tipo_persona=$tipo_persona[0]; dir_apellidos=$apellidos[0]; dir_nombres=$nombres[0]; dir_direccion=".
				"$direcciones[0]; dir_telefono=$telefonos[0]; dir_correo=$correo[0]; dir_ciudad_direccion=$ciudad[0]; dir_barrio=$barrio[0]; dir_fecha_nac=$nac[0]; ".
				"dir_lugar_nac=$ciudad_nac[0]; dir_estado=A");
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
				
				$this->ProveedoresEntidad->setWhere(" and p.prv_identificacion=$identificacion_xls");
				$proveedorRetorna=$this->NegocioFacade->listarProveedores($this->ProveedoresEntidad);
				
				unset($tipo_sociedad);
				unset($tipo_regimen);
				unset($autorretenedor);
				unset($retenedor_iva);
				unset($profesion_liberal);
				unset($ley_1429);
				unset($gc);
				unset($ciudad_s);
				unset($dir_s);
				unset($representante);
				unset($estado_p);
				
				if (pg_num_rows($proveedorRetorna->getResultado())>0) {
					$accion_p='M';
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
					$estado_p=$proveedorRetorna->getEstado();
					$datos_ant_p="prv_identificacion=$identificacion_xls; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=$autorretenedor[0]; prv_gc=".
					"$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_p[0]; prv_tipo_regimen=".
					"$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]";
				} else {
					$datos_ant_p="";
					$accion_p='A';
				}
				
				$this->ProveedoresEntidad->setIdx(0);
				$this->ProveedoresEntidad->setIdentificacion($identificacion_xls);
				$this->ProveedoresEntidad->setTipoSociedad($tipo_sociedad[0]);
				$this->ProveedoresEntidad->setAutorretenedor($autorretenedor[0]);
				$this->ProveedoresEntidad->setGc($retenedor_iva[0]);
				$this->ProveedoresEntidad->setProfesionLiberal($profesion_liberal[0]);
				$this->ProveedoresEntidad->setLey1429($ley_1429[0]);
				$this->ProveedoresEntidad->setSucursal($ciudad_s[0]);
				$this->ProveedoresEntidad->setDirSucursal($dir_s[0]);
				$this->ProveedoresEntidad->setRepresentante($representante[0]);
				$this->ProveedoresEntidad->setTipoRegimen($tipo_regimen[0]);
				$this->ProveedoresEntidad->setRetenedorIva($retenedor_iva[0]);
				$this->ProveedoresEntidad->setEstado('A');
				
				switch ($accion_p) {
					case 'A':
						$proveedoresRetorna=$this->NegocioFacade->adicionarProveedores($this->ProveedoresEntidad);
						break;
						
					case 'M':
						$proveedoresRetorna=$this->NegocioFacade->modificarProveedores($this->ProveedoresEntidad);
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
				$estado_p=$proveedoresRetorna->getEstado();
				$tipo_regimen=$proveedoresRetorna->getTipoRegimen();
				$retenedor_iva=$proveedoresRetorna->getAutorretenedor();
				$profesion_liberal=$proveedoresRetorna->getProfesionLiberal();
				$ley_1429=$proveedoresRetorna->getLey1429();
				
				$this->ModificadorTablasEntidad->setIdx(0);
				$this->ModificadorTablasEntidad->setTabla('iau_proveedores');
				$this->ModificadorTablasEntidad->setLlave($identificacion[0]);
				$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
				$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
				$this->ModificadorTablasEntidad->setDatosAnterior($datos_ant_p);
				$this->ModificadorTablasEntidad->setDatosDespues("prv_identificacion=$identificacion[0]; prv_tipo_sociedad=$tipo_sociedad[0]; prv_autorretenedor=".
				"$autorretenedor[0]; prv_gc=$gc[0]; prv_sucursal=$ciudad_s[0]; prv_dir_sucursal=$dir_s[0]; prv_representante=$representante[0]; prv_estado=$estado_p[0]; ".
				"prv_tipo_regimen=$tipo_regimen[0]; prv_retenedor_iva=$retenedor_iva[0]; prv_profesion_liberal=$profesion_liberal[0]; prv_ley_1429=$ley_1429[0]");
				
				$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
				
				if (is_string($modificadorTablasRetorna->getResultado())) {
					echo $modificadorTablasRetorna->getResultado();
					return;
				}
				
				$ciiu_xls=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('L'.$i)->getValue()));
				$this->CiiuEntidad->setWhere(" and c.ciu_codigo='$ciiu_xls' and c.ciu_lugar='COL'");
				
				$ciiuRetorna=$this->NegocioFacade->listarCiiu($this->CiiuEntidad);
				if (pg_num_rows($ciiuRetorna->getResultado())>0) {
					$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$identificacion_xls and c.cdi_lugar='COL' and c.cdi_ciiu='$ciiu_xls'");
					$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
					if (pg_num_rows($ciiuDirectorioRetorna->getResultado())==0) {
						
						$this->CiiuDirectorioEntidad->setIdx(0);
						$this->CiiuDirectorioEntidad->setIdentificacion($identificacion_xls);
						$this->CiiuDirectorioEntidad->setCiiu($ciiu_xls);
						$this->CiiuDirectorioEntidad->setLugar('COL');
						
						$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$identificacion_xls and c.cdi_lugar='COL' and c.cdi_principal");
						$ciiuDirectorioRetorna1=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
						
						if (pg_num_rows($ciiuDirectorioRetorna1->getResultado())==0) {
							$this->CiiuDirectorioEntidad->setPrincipal('t');
						} else {
							$this->CiiuDirectorioEntidad->setPrincipal('f');
						}
						
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						
						if (is_string($ciiuDiretorioRetorna->getResultado())) {
							echo $ciiuDiretorioRetorna->getResultado();
							return;
						}
						
						$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
						$ciiu=$ciiuDiretorioRetorna->getCiiu();
						$lugar=$ciiuDiretorioRetorna->getLugar();
						$principal=$ciiuDiretorioRetorna->getPrincipal();
						
						$this->ModificadorTablasEntidad->setIdx(0);
						$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
						$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
						$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
						$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
						$this->ModificadorTablasEntidad->setDatosAnterior('');
						$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=".
						"$principal[0]");
						$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
						
						if (is_string($modificadorTablasRetorna->getResultado())) {
							echo $modificadorTablasRetorna->getResultado();
							return;
						}
						
					}
				}
				
				$ciiu_xls=pg_escape_string(utf8_decode($objPHPExcel->getActiveSheet()->getCell('M'.$i)->getValue()));
				$this->CiiuEntidad->setWhere(" and c.ciu_codigo='$ciiu_xls' and c.ciu_lugar='COL11001'");
				
				$ciiuRetorna=$this->NegocioFacade->listarCiiu($this->CiiuEntidad);
				if (pg_num_rows($ciiuRetorna->getResultado())>0) {
					$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$identificacion_xls and c.cdi_lugar='COL11001' and c.cdi_ciiu='$ciiu_xls'");
					$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
					if (pg_num_rows($ciiuDirectorioRetorna->getResultado())==0) {
						
						$this->CiiuDirectorioEntidad->setIdx(0);
						$this->CiiuDirectorioEntidad->setIdentificacion($identificacion_xls);
						$this->CiiuDirectorioEntidad->setCiiu($ciiu_xls);
						$this->CiiuDirectorioEntidad->setLugar('COL11001');
						
						$this->CiiuDirectorioEntidad->setWhere(" and c.cdi_identificacion=$identificacion_xls and c.cdi_lugar='COL11001' and c.cdi_principal");
						$ciiuDirectorioRetorna1=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
						
						if (pg_num_rows($ciiuDirectorioRetorna1->getResultado())==0) {
							$this->CiiuDirectorioEntidad->setPrincipal('t');
						} else {
							$this->CiiuDirectorioEntidad->setPrincipal('f');
						}
						
						$ciiuDiretorioRetorna=$this->NegocioFacade->adicionarCiiuDirectorio($this->CiiuDirectorioEntidad);
						
						if (is_string($ciiuDiretorioRetorna->getResultado())) {
							echo $ciiuDiretorioRetorna->getResultado();
							return;
						}
						
						$identificacion=$ciiuDiretorioRetorna->getIdentificacion();
						$ciiu=$ciiuDiretorioRetorna->getCiiu();
						$lugar=$ciiuDiretorioRetorna->getLugar();
						$principal=$ciiuDiretorioRetorna->getPrincipal();
						
						$this->ModificadorTablasEntidad->setIdx(0);
						$this->ModificadorTablasEntidad->setTabla('iau_ciiu_directorio');
						$this->ModificadorTablasEntidad->setLlave("$identificacion[0]##$ciiu[0]##$lugar[0]");
						$this->ModificadorTablasEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
						$this->ModificadorTablasEntidad->setFechaHora(date('Y-m-d H:i:s'));
						$this->ModificadorTablasEntidad->setDatosAnterior('');
						$this->ModificadorTablasEntidad->setDatosDespues("cdi_identificacion=$identificacion[0]; cdi_ciiu=$ciiu[0]; cdi_lugar=$lugar[0]; cdi_principal=".
						"$principal[0]");
						$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
						
						if (is_string($modificadorTablasRetorna->getResultado())) {
							echo $modificadorTablasRetorna->getResultado();
							return;
						}
						
					}
				}
				
			}
			$i++;
		}
		/*
		
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
		}*/
		unlink('tmp/'.base64_decode($datos[0]));
	}
	
	function vCuentaPuc($datos) {
		if (!file_exists(sys_get_temp_dir().'/itz_auditor')) mkdir(sys_get_temp_dir().'/itz_auditor',0777,true);
	
		$archivo=file_get_contents("php://input");
		if (file_put_contents(sys_get_temp_dir().'/itz_auditor/'.base64_decode($datos[0]), $archivo)===false) echo 'Fallo al escribir archivo';
	}
	
	function vMovimiento($datos) {
		if (!file_exists(sys_get_temp_dir().'/itz_auditor')) mkdir(sys_get_temp_dir().'/itz_auditor',0777,true);
	
		$archivo=file_get_contents("php://input");
		if (file_put_contents(sys_get_temp_dir().'/itz_auditor/'.base64_decode($datos[0]), $archivo)===false) echo 'Fallo al escribir archivo';
	}
	
	function vSaldos($datos) {
		if (!file_exists(sys_get_temp_dir().'/itz_auditor')) mkdir(sys_get_temp_dir().'/itz_auditor',0777,true);
	
		$archivo=file_get_contents("php://input");
		if (file_put_contents(sys_get_temp_dir().'/itz_auditor/'.base64_decode($datos[0]), $archivo)===false) echo 'Fallo al escribir archivo';
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
			$direccion[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia])));
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia])));
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto])));
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
		$this->ModificadorTablasEntidad->setDatosAnterior(pg_escape_string(base64_decode($_REQUEST[datos_ant_d])));
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
				$direccion[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia_r])));
			else $direccion[0]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r]))!='')
				$direccion[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia_r])));
			else $direccion[1]='null';
				
			if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r]))!='')
				$direccion[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto_r])));
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
			$direccion[0]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_residencia])));
		else $direccion[0]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia]))!='')
			$direccion[1]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_correspondencia])));
		else $direccion[1]='null';
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto]))!='')
			$direccion[2]=pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[dir_contacto])));
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
}

$SubirMasivo = new SubirMasivo();
$SubirMasivo->workflow($_SERVER['HTTP_X_FILE_NAME']);

?>