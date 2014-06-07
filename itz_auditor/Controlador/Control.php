<?php
namespace Controller;
header('Content-Type: text/html; charset=ISO-8859-1');
require_once '../Entidades/Auditoria/BienServiciosEntidad.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';
require_once '../Entidades/Auditoria/MovimientoEntidad.php';
require_once '../Entidades/Auditoria/PagosEntidad.php';
require_once '../Entidades/Auditoria/ProveedoresEntidad.php';
require_once '../Entidades/Auditoria/SaldosEntidad.php';
require_once '../Entidades/Configuracion/AccesoModulosEntidad.php';
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
require_once '../Entidades/General/ModificadorTablasEntidad.php';
require_once '../Negocio/General/NegocioFacade.php';

use Entidades\AccesoModulosEntidad;
use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\CiiuEntidad;
use Entidades\ClientesEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
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
use Entidades\SaldosEntidad;
use Entidades\UsuarioEntidad;
use Negocio\NegocioFacade;

class Control{
	
	private $AccesoModulosEntidad;
	private $BienServiciosEntidad;
	private $CiiuDirectorioEntidad;
	private $CiiuEntidad;
	private $ClientesEntidad;
	private $CuentaPucEntidad;
	private $DirectorioEntidad;
	private $DocPagosEntidad;
	private $DocProveedoresEntidad;
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
	private $SaldosEntidad;
	private $UsuarioEntidad;
	
	function __construct(){
		if (!isset($this->AccesoModulosEntidad)) $this->AccesoModulosEntidad=new AccesoModulosEntidad();
		if (!isset($this->BienServiciosEntidad))$this->BienServiciosEntidad=new BienServiciosEntidad();
		if (!isset($this->CiiuDirectorioEntidad))$this->CiiuDirectorioEntidad=new CiiuDirectorioEntidad();
		if (!isset($this->CiiuEntidad))$this->CiiuEntidad=new CiiuEntidad();
		if (!isset($this->ClientesEntidad)) $this->ClientesEntidad=new ClientesEntidad();
		if (!isset($this->CuentaPucEntidad)) $this->CuentaPucEntidad=new CuentaPucEntidad();
		if (!isset($this->DirectorioEntidad))$this->DirectorioEntidad=new DirectorioEntidad();
		if (!isset($this->DocPagosEntidad)) $this->DocPagosEntidad=new DocPagosEntidad();
		if (!isset($this->DocProveedoresEntidad)) $this->DocProveedoresEntidad=new DocProveedoresEntidad();
		if (!isset($this->NegocioFacade)) $this->NegocioFacade=new NegocioFacade();
		if (!isset($this->LugaresEntidad))$this->LugaresEntidad=new LugaresEntidad();
		if (!isset($this->ModificadorTablasEntidad)) $this->ModificadorTablasEntidad=new ModificadorTablasEntidad();
		if (!isset($this->ModulosEntidad)) $this->ModulosEntidad=new ModulosEntidad();
		if (!isset($this->MovimientoEntidad)) $this->MovimientoEntidad=new MovimientoEntidad();
		if (!isset($this->PagosEntidad)) $this->PagosEntidad=new PagosEntidad();
		if (!isset($this->ParametrosEntidad))$this->ParametrosEntidad=new ParametrosEntidad();
		if (!isset($this->PermisosExcepcionalesEntidad))$this->PermisosExcepcionalesEntidad=new PermisosExcepcionalesEntidad();
		if (!isset($this->ProveedoresEntidad)) $this->ProveedoresEntidad=new ProveedoresEntidad();
		if (!isset($this->RolesEntidad)) $this->RolesEntidad=new RolesEntidad();
		if (!isset($this->RolesPermisosEntidad)) $this->RolesPermisosEntidad=new RolesPermisosEntidad();
		if (!isset($this->RolesUsuariosEntidad)) $this->RolesUsuariosEntidad=new RolesUsuariosEntidad();
		if (!isset($this->SaldosEntidad)) $this->SaldosEntidad=new SaldosEntidad();
		if (!isset($this->UsuarioEntidad)) $this->UsuarioEntidad=new UsuarioEntidad();
	}
	
	function workflow($action) {
		global $FechaInicio;
		
		if ($_REQUEST[fechaInicio]=='') $FechaInicio=date('YmdHisu');
		else $FechaInicio=$_REQUEST[fechaInicio];
		
		@session_name("ITZAudID-$FechaInicio");
		session_start();
		
		$control_ac=new Control();
		
		$control_ac->$action();
		
	}
	
	function cargarSesion() {
		global $FechaInicio;
		
		if ($_REQUEST[pagina]!='') $_SESSION[ITZAudPag]=$_REQUEST[pagina];
		else if ($_SESSION[ITZAudPag]=='') $_SESSION[ITZAudPag]=base64_encode('Acceso/login.php');
		
		echo $FechaInicio;
	}
	
	function cerrarSesion() {
		$_SESSION[ITZAudPag]='';
		$_SESSION[ITZAudUs]='';
		$_SESSION[ITZAudTyUs]='';
		session_unset();
		session_destroy();
	}
	
	function crearFrame() {
		echo '<iframe src="'.base64_decode($_SESSION[ITZAudPag]).'" width="100%" height="100%" marginheight="0" marginwidth="0" noresize scrolling="yes" frameborder="0" '.
		'id="fr_acc" name="fr_acc"></iframe>';
	}
	
	function acceso() {
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_REQUEST[usr]));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		$usuario=$usuarioRetorna->getIdentificacion();
		if ($usuario[0]=='') {
			echo 'ERROR##Usuario digitado no existe.##usr##detener';
			return;
		}
		
		if ($usuarioRetorna->getEstado()!='A') {
			echo 'ERROR##Usuario digitado se encuentra inactivo.##usr##detener';
			return;
		}
		
		$clave_dig=$this->NegocioFacade->encriptaClave(base64_decode($_REQUEST[usr]), base64_decode($_REQUEST[passwd]));
		$clave=$usuarioRetorna->getClave();
		
		if ($clave_dig!=$clave) {
			echo 'ERROR##Contrase&ntilde;a incorrecta.##passwd##detener';
			return;
		}else{
			if ($_REQUEST[usr]!='') $_SESSION[ITZAudUs]=$_REQUEST[usr];
			if ($usuarioRetorna->getTipoUsuario()!='') $_SESSION[ITZAudTyUs]=base64_encode($usuarioRetorna->getTipoUsuario());
			if ($usuarioRetorna->getRequiereCambio()=='t') echo 'ADVERTENCIA##Es usted un usuario nuevo o se le renov&oacute; la contrase&ntilde;a, debe cambiarla para '.
			'poder continuar.##passwd##seguir';
		}
	}
	
	function cambioClave() {
		
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
		$this->ModificadorTablasEntidad->setDatosAnterior("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=".
		"$estado; usu_tipo_usuario=$tipo_usuario; usu_clave=$clave_ant; usu_requiere_cambio=t");
		$this->ModificadorTablasEntidad->setDatosDespues("usu_identificacion=$identificacion; usu_correo=$correo; usu_estado=".
		"$estado; usu_tipo_usuario=$tipo_usuario; usu_clave=$clave; usu_requiere_cambio=$requiere_cambio");
		
		$modificadorTablasRetorna=$this->NegocioFacade->adicionarModificadorTablas($this->ModificadorTablasEntidad);
		
		if (is_string($modificadorTablasRetorna->getResultado())) {
			echo $modificadorTablasRetorna->getResultado();
			return;
		}
	}
	
	function menu() {
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		switch ($usuarioRetorna->getTipoUsuario()) {
			case 'A':
				$this->ModulosEntidad->setWhere(" and not mm.mme_imagen is null and mm.mme_imagen<>'' and mm.mme_codigo>=0");
				break;
			case 'S':
				$this->ModulosEntidad->setWhere(" and not mm.mme_imagen is null and mm.mme_imagen<>'' and mm.mme_codigo>=0 and mm.mme_codigo in (select rp.rpe_modulo from ".
				"iau_roles_permisos rp,iau_roles r,iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ru.rus_rol=r.rol_codigo ".
				"and ru.rus_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa=-1 and rp.rpe_modulo not in (select pe.pex_modulo from ".
				"iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) union all select pe.pex_modulo ".
				"from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.pex_consulta and pe.pex_empresa=-1 ".
				"and pe.pex_usuario=ru.rus_usuario and pe.pex_rol=ru.rus_rol and pe.pex_empresa=ru.rus_empresa and ru.rus_estado='A')");
				break;
			case 'U':
				$this->ModulosEntidad->setWhere(" and not mm.mme_imagen is null and mm.mme_imagen<>'' and mm.mme_codigo>=0 and mm.mme_codigo in (select rp.rpe_modulo from ".
				"iau_roles_permisos rp,iau_roles r,iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ru.rus_rol=r.rol_codigo ".
				"and ru.rus_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa<>-1 and rp.rpe_modulo not in (select pe.pex_modulo from ".
				"iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) union all select pe.pex_modulo ".
				"from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.pex_consulta and pe.pex_empresa<>-1".
				" and pe.pex_usuario=ru.rus_usuario and pe.pex_rol=ru.rus_rol and pe.pex_empresa=ru.rus_empresa and ru.rus_estado='A')");
				break;
		}
		
		$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
		
		$html='<table cellpadding="2" cellspacing="2" style="text-align: left;"><tr><td class="oculto" id="menu_izq" onclick="ver_menu();" width="20px;" valign="top">'.
		'&nbsp;<br>'.implode('<br>',str_split('ITZ. AUDITOR')).'</td><td id="menu_der" style="display: none;" valign="top"><table id="tabla" class="caja" '.
		'width="100%"><tr><td><table class="fondo">';
		
		$j=0;
		$modulo=$modulosRetorna->getModulo();
		$nombreMostrar=$modulosRetorna->getNombreMostrar();
		$imagen=$modulosRetorna->getImagen();
		$mod_sup=$modulosRetorna->getModulo();
		$carpeta=$modulosRetorna->getPagina();
		
		for ($i=0;$i<count($modulo);$i++) {
			$html.='<tr><td onclick="Effect.toggle(\'menu_'.$j.'\',\'appear\'); return false;" style="background-color: #accbff; padding: 1.5px;"><img src="../../imagenes'.
			'/'.$imagen[$i].'" border="0" ><span class="span">'.$this->NegocioFacade->reempCaracEspHtml($nombreMostrar[$i]).'</span></td></tr><tr style="display: none;" '.
			'id="menu_'.$j.'"><td style="padding-left: 5px;"><table width="100%"><tbody class="p1">';
			
			switch ($usuarioRetorna->getTipoUsuario()) {
				case 'A':
					$this->ModulosEntidad->setWhere(" and mm.mme_modulo='".$modulo[$i]."' and mm.mme_menu_sup<>'' and not mm.mme_menu_sup is null");
					break;
				case 'S':
					$this->ModulosEntidad->setWhere(" and mm.mme_modulo='".$modulo[$i]."' and mm.mme_menu_sup<>'' and not mm.mme_menu_sup is null and mm.mme_codigo in (select ".
					"rp.rpe_modulo from iau_roles_permisos rp,iau_roles r,iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ru.".
					"rus_rol=r.rol_codigo and ru.rus_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa=-1 and rp.rpe_modulo not in (select ".
					"pe.pex_modulo from iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) union all ".
					"select pe.pex_modulo from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.pex_consulta ".
					"and pe.pex_empresa=-1 and pe.pex_usuario=ru.rus_usuario and pe.pex_rol=ru.rus_rol and pe.pex_empresa=ru.rus_empresa and ru.rus_estado='A')");
					break;
				case 'U':
					$this->ModulosEntidad->setWhere(" and mm.mme_modulo='".$modulo[$i]."' and mm.mme_menu_sup<>'' and not mm.mme_menu_sup is null and mm.mme_codigo in (select ".
					"rp.rpe_modulo from iau_roles_permisos rp,iau_roles r,iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ".
					"ru.rus_rol=r.rol_codigo and ru.rus_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa<>-1 and rp.rpe_modulo not in (".
					"select pe.pex_modulo from iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) ".
					"union all select pe.pex_modulo from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.".
					"pex_consulta and pe.pex_empresa<>-1 and pe.pex_usuario=ru.rus_usuario and pe.pex_rol=ru.rus_rol and pe.pex_empresa=ru.rus_empresa and ru.rus_estado='A')");
					break;
			}
			
			$this->ModulosEntidad->setOrder('mm.mme_orden');
			$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
				
			unset($ds_menu);
			unset($menu_sup);
			unset($menu_sec);
			unset($menu);
			unset($pagina);
			unset($codigo);
				
			$ds_menu=$modulosRetorna->getMenuSup();
			$menu=$modulosRetorna->getNombreMostrar();
			$pagina=$modulosRetorna->getPagina();
			$codigo=$modulosRetorna->getCodigo();
				
			for ($l=0;$l<count($ds_menu);$l++) {
				$ds_menu_i=explode('/',$ds_menu[$l]);
				$menu_sup[$l]=$ds_menu_i[0];
				if (count($ds_menu_i)>1) {
					$menu_sec[$l]=$ds_menu_i[1];
				} else {
					$menu_sec[$l]='';
				}
			}
				
			for ($k=0;$k<count($menu_sup);$k++) {
				$fl_mnsup=false;
				$fl_mnsec=false;
				$fl_trsup=false;
				$fl_trsec=false;
					
				if ($k==0) {
					$fl_mnsup=true;
				} elseif ($menu_sup[$k]!=$menu_sup[$k-1]) {
					$fl_mnsup=true;
				}
					
				if ($fl_mnsup) {
					$j++;
					$html.='<tr><td onclick="Effect.toggle(\'menu_'.$j.'\',\'appear\'); return false;" style="padding: 1.5px;"><img src="../../imagenes/desc.png" border="0">'.
					'<span class="span">.:'.$this->NegocioFacade->reempCaracEspHtml($menu_sup[$k]).':.</span></td></tr><tr style="display: none;" id="menu_'.$j.'"><td style="'.
					'padding-left: 5px;"><table width="100%"><tbody class="p2">';
				}
					
				if ($menu_sec[$k]!='') {
					if ($k==0) {
						$fl_mnsec=true;
					} elseif ($menu_sec[$k]!=$menu_sec[$k-1]) {
						$fl_mnsec=true;
					}
				
					if ($fl_mnsec) {
						$j++;
						$html.='<tr><td onclick="Effect.toggle(\'menu_'.$j.'\',\'appear\'); return false;" style="padding: 1.5px;"><img src="../../imagenes/desc.png" border="0'.
						'"><span class="span">.:'.$this->NegocioFacade->reempCaracEspHtml($menu_sec[$k]).':.</span></td></tr><tr style="display: none;" id="menu_'.$j.'"><td><'.
						'table style="padding-left: 5px;" width="100%"><tbody class="p2">';
					}
				}
					
				$html.='<tr><td style="padding: 1.5px;" onclick="cargarSesion(\''.$carpeta[$i].'/'.$pagina[$k].'\',true,\'../../\',parent.document.getElementById(window.'.
				'name).parentNode);"><a class="a1" href="#"><img src="../../imagenes/bullet_green.png" align="left" border="0" height="16" width="16"><span class="span">'.
				$this->NegocioFacade->reempCaracEspHtml($menu[$k]).'</span></a></td></tr>';
					
				if ($menu_sec[$k]!='') {
					if ($k+1==count($menu_sup)) {
						$fl_trsec=true;
					} elseif ($menu_sec[$k]!=$menu_sec[$k+1]) {
						$fl_trsec=true;
					}
					
					if ($fl_trsec) {
						$html.='</tbody></table></td></tr>';
					}
				}
					
				if ($k+1==count($menu_sup)) {
					$fl_trsup=true;
				} elseif ($menu_sup[$k]!=$menu_sup[$k+1]) {
					$fl_trsup=true;
				}
					
				if ($fl_trsup) {
					$html.='</tbody></table></td></tr>';
				}
			}
			
			$html.='</tbody></table></td></tr>';
			$j++;
		}
		
		$html.='<tr><td onclick="abrirVentana(\'vCambioClave\',\'A\',\'CAMBIAR CONTRASE&Ntilde;A USUARIO '.base64_decode($_SESSION[ITZAudUs]).'\',\'\',\'\',\'i_dojo_0\');" '.
		'style="background-color: #accbff; padding: 1.5px;"><img src="../../imagenes/i_camb_clave.png" border="0" ><span class="span">CAMBIAR CONTRASE&Ntilde;A</span></td>'.
		'</tr><tr><td onclick="abrirVentana(\'vSalida\',\'S\',\'SALIDA SEGURA USUARIO '.base64_decode($_SESSION[ITZAudUs]).'\',\'\',\'\',\'i_dojo_0\');" style="background-'.
		'color: #accbff; padding: 1.5px;"><img src="../../imagenes/i_salir.png" border="0" ><span class="span">SALIDA SEGURA</span></td></tr></table>';
		echo $html;
	}
	
	function cargarPermisos() {
		
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
		
		$fl_adi=false;
		$fl_mod=false;
		$fl_ina=false;
		
		switch ($usuarioRetorna->getTipoUsuario()) {
			case 'A':
				$fl_adi=true;
				$fl_mod=true;
				$fl_ina=true;
				break;
				
			case 'S':
				$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and pe.pex_modulo=".
				base64_decode($_REQUEST[modulo])." and pe.pex_empresa=-1");
				
				$permisosExcepcionalesRetorna=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
				if (pg_num_rows($permisosExcepcionalesRetorna->getResultado())>0) {
					$a_adi=$permisosExcepcionalesRetorna->getAdicionar();
					$a_mod=$permisosExcepcionalesRetorna->getModificar();
					$a_ina=$permisosExcepcionalesRetorna->getEliminar();
					for ($i=0;$i<count($a_adi);$i++) {
						if ($a_adi[$i]=='t') $fl_adi=true;
						if ($a_mod[$i]=='t') $fl_mod=true;
						if ($a_ina[$i]=='t') $fl_ina=true;
					}
				} else {
					$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol in (select ru.rus_rol from iau_roles_usuarios ru where ru.rus_usuario=".
					base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa=-1)");
					
					$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
					if (pg_num_rows($rolesPermisosRetorna->getResultado())>0) {
						$a_adi=$rolesPermisosRetorna->getAdicionar();
						$a_mod=$rolesPermisosRetorna->getModificar();
						$a_ina=$rolesPermisosRetorna->getEliminar();
						for ($i=0;$i<count($a_adi);$i++) {
							if ($a_adi[$i]=='t') $fl_adi=true;
							if ($a_mod[$i]=='t') $fl_mod=true;
							if ($a_ina[$i]=='t') $fl_ina=true;
						}
					}
				}
				break;
				
			case 'U':
				$this->PermisosExcepcionalesEntidad->setWhere(" and pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and pe.pex_modulo=".
				base64_decode($_REQUEST[modulo])." and pe.pex_empresa<>-1");
				
				$permisosExcepcionalesRetorna=$this->NegocioFacade->listarPermisosExcepcionales($this->PermisosExcepcionalesEntidad);
				if (pg_num_rows($permisosExcepcionalesRetorna->getResultado())>0) {
					$a_adi=$permisosExcepcionalesRetorna->getAdicionar();
					$a_mod=$permisosExcepcionalesRetorna->getModificar();
					$a_ina=$permisosExcepcionalesRetorna->getEliminar();
					for ($i=0;$i<count($a_adi);$i++) {
						if ($a_adi[$i]=='t') $fl_adi=true;
						if ($a_mod[$i]=='t') $fl_mod=true;
						if ($a_ina[$i]=='t') $fl_ina=true;
					}
				} else {
					$this->RolesPermisosEntidad->setWhere(" and rp.rpe_rol in (select ru.rus_rol from iau_roles_usuarios ru where ru.rus_usuario=".
					base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa<>-1)");
					
					$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
					if (pg_num_rows($rolesPermisosRetorna->getResultado())>0) {
						$a_adi=$rolesPermisosRetorna->getAdicionar();
						$a_mod=$rolesPermisosRetorna->getModificar();
						$a_ina=$rolesPermisosRetorna->getEliminar();
						for ($i=0;$i<count($a_adi);$i++) {
							if ($a_adi[$i]=='t') $fl_adi=true;
							if ($a_mod[$i]=='t') $fl_mod=true;
							if ($a_ina[$i]=='t') $fl_ina=true;
						}
					}
				}
				break;
		}
		
		$html='<table cellpadding="2" cellspacing="2"><tr>';
		$nombre=base64_decode($_REQUEST[nombre]);
		
		if ($fl_adi&&base64_decode($_REQUEST[botones][0])=='1') {
			$html.='<td id="td_adic"><input name="b_adi" id="b_adi" type="button" class="b_adi" value="" onclick="abrirVentana(\'v'.
			str_replace(' ', '',ucwords(mb_strtolower($nombre))).'\',\'A'.'\',\'ADICIONAR '.mb_strtoupper($nombre).'\',\'\',\'2\',\''.base64_decode($_REQUEST[campoEnfoque][0]).
			'\');"></td>';
		}
		
		if ($fl_mod&&base64_decode($_REQUEST[botones][1])=='1') {
			$html.='<td id="td_mod" style="display: none;"><input name="b_mod" id="b_mod" type="button" class="b_mod" value="" onclick="abrirVentana(\'v'.
			str_replace(' ', '',ucwords(mb_strtolower($nombre))).'\',\'M\',\'MODIFICAR '.mb_strtoupper($nombre);
			for ($i=0;$i<count($_REQUEST[titulo]);$i++) {
				if ($i>0) $html.='+\' -';
				$html.=' \'+'.base64_decode($_REQUEST[titulo][$i]);
			}
			$html.=','.base64_decode($_REQUEST[envio_p]).',\'2\',\''.base64_decode($_REQUEST[campoEnfoque][1]).'\');"></td>';
		}
		
		if ($fl_ina&&base64_decode($_REQUEST[botones][2])=='1') {
			$html.='<td id="td_ina" style="display: none;"><input name="b_ina" id="b_ina" type="button" class="b_ina" value="" onclick="abrirVentana(\'v'.
			str_replace(' ', '',ucwords(mb_strtolower($nombre))).'\',\'I\',\'INACTIVAR '.mb_strtoupper($nombre);
			for ($i=0;$i<count($_REQUEST[titulo]);$i++) {
				if ($i>0) $html.='+\' -';
				$html.=' \'+'.base64_decode($_REQUEST[titulo][$i]);
			}
			$html.=','.base64_decode($_REQUEST[envio_p]).',\'1\',\''.base64_decode($_REQUEST[campoEnfoque][2]).'\');"></td>';
		}
		
		if (base64_decode($_REQUEST[modulosAd][0])!='no') {
			for ($i=0;$i<count($_REQUEST[modulosAd]);$i++) {
				$fl_modulo=false;
				$mod=explode('-',base64_decode($_REQUEST[modulosAd][$i]));
				switch ($usuarioRetorna->getTipoUsuario()) {
					case 'A':
						$fl_modulo=true;
						break;
					case 'S':
						$this->ModulosEntidad->setWhere(" and mm.mme_codigo=$mod[0] and mm.mme_codigo in (select rp.rpe_modulo from iau_roles_permisos rp,iau_roles r,".
						"iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ru.rus_rol=r.rol_codigo and ru.rus_usuario=".
						base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa=-1 and rp.rpe_$mod[1] and rp.rpe_modulo not in (select pe.pex_modulo from ".
						"iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) union all select pe.".
						"pex_modulo from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.pex_consulta and pe.".
						"pex_empresa=-1 and pe.pex_usuario=ru.rus_usuario and pe.pex_$mod[1] and pe.pex_rol=ru.rus_rol and pe.pex_empresa=ru.rus_empresa and ru.rus_estado='A')");
						
						$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
						if (pg_num_rows($modulosRetorna->getResultado())>0) $fl_modulo=true;
						break;
					case 'U':
						$this->ModulosEntidad->setWhere(" and mm.mme_codigo=$mod[0]  and mm.mme_codigo in (select rp.rpe_modulo from iau_roles_permisos rp,iau_roles r,".
						"iau_roles_usuarios ru where rp.rpe_rol=r.rol_codigo and r.rol_estado='A' and rp.rpe_consulta and ru.rus_rol=r.rol_codigo and ru.rus_usuario=".
						base64_decode($_SESSION[ITZAudUs])." and ru.rus_estado='A' and ru.rus_empresa<>-1 and rp.rpe_$mod[1] and rp.rpe_modulo not in (select ".
						"pe.pex_modulo from iau_permisos_excepcionales pe where ru.rus_usuario=pe.pex_usuario and ru.rus_empresa=pe.pex_empresa and ru.rus_rol=pe.pex_rol) union all".
						" select pe.pex_modulo from iau_permisos_excepcionales pe,iau_roles_usuarios ru where pe.pex_usuario=".base64_decode($_SESSION[ITZAudUs])." and pe.".
						"pex_consulta and pe.pex_empresa<>-1 and pe.pex_usuario=ru.rus_usuario and pe.pex_rol=ru.rus_rol and pe.pex_$mod[1] and pe.pex_empresa=ru.rus_empresa and ru.".
						"rus_estado='A')");
						
						$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
						if (pg_num_rows($modulosRetorna->getResultado())>0) $fl_modulo=true;
						break;
				}
				
				if ($fl_modulo) $html.=$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[botonesAd][$i]));
				
			}
		}
		
		if (base64_decode($_REQUEST[botones][3])=='1') {
			$html.='<td id="td_inf" style="display: none;"><input name="b_inf" id="b_inf" type="button" class="b_inf" value="" onclick="abrirVentana(\'vInfo'.
			str_replace(' ', '',ucwords(mb_strtolower($nombre))).'\',\'I\',\'INFORMACI&Oacute;N '.mb_strtoupper($nombre);
			for ($i=0;$i<count($_REQUEST[titulo]);$i++) {
				if ($i>0) $html.='+\' -';
				$html.=' \'+'.base64_decode($_REQUEST[titulo][$i]);
			}
			$html.=','.base64_decode($_REQUEST[envio_p]).',\'\',\'\');">';
		}
		
		if (base64_decode($_REQUEST[botones][4])=='1') {
			$html.='<td id="td_exp" style="display: none;"><input name="b_exp" id="b_exp" type="button" class="b_exp" value="" onclick="abrirVentana(\'vExportar\',\'E\',\''.
			'EXPORTAR LISTADO\',\'\',\'\',\''.base64_decode($_REQUEST[campoEnfoque][2]).'\');"></td>';
		}
		
		$html.='</tr></table>';
		echo $html;
	}
	
	function piePagina() {
			
		$this->UsuarioEntidad->setWhere(" and u.usu_identificacion=".base64_decode($_SESSION[ITZAudUs]));
			
		$usuarioRetorna=$this->NegocioFacade->buscarUsuario($this->UsuarioEntidad);
			
		$resultado=$usuarioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			if ($filas=pg_fetch_assoc($resultado)) {
				$html='<table width="100%"><tr><td width="35%"><div style="text-align: left; color: gray; margin-bottom: 0px; font-size: 10pt; font-family: \'Times New '.
				'Roman\', Times, serif">'.ucwords(strtolower($filas[nombres])).'</div></td><td width="30%"><div style="text-align: center; color: gray; margin-bottom: 0px; '.
				'font-size: 10pt; font-family: \'Times New Roman\', Times, serif">&copy; 2010-'.date('Y').' ITZAMN&Aacute; S.A.S.</div></td><td width="35%"><div style="text'.
				'-align: right; color: gray; margin-bottom: 0px; font-size: 10pt; font-family: \'Times New Roman\', Times, serif" id="fc_actual">'.date("d/m/Y g:i:s A").
				'</div></td></tr></table>';
			}
			echo $html;
		}
	}
	
	function consultarUsuarios() {
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
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarRoles() {
		
		if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre]))!='') $where=" and r.rol_nombre ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre])))."%'";
		
		$this->RolesEntidad->setWhere($where);
		
		$this->RolesEntidad->setOrder("r.rol_estado,r.rol_nombre");
		$rolesRetorna=$this->NegocioFacade->listarRoles($this->RolesEntidad);
		
		$resultado=$rolesRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarRolesPermisos() {
		
		if (base64_decode($_REQUEST[list_t_rol])!='') $where=" and rp.rpe_rol = ".pg_escape_string(base64_decode($_REQUEST[list_t_rol]))."";
		
		$this->RolesPermisosEntidad->setWhere($where);
		
		$this->RolesPermisosEntidad->setOrder("rp.rpe_rol,rp.rpe_modulo");
		$rolesPermisosRetorna=$this->NegocioFacade->listarRolesPermisos($this->RolesPermisosEntidad);
		
		$resultado=$rolesPermisosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarClientes() {
		
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
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarProveedores() {
		
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
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarDocProveedores() {
		
		if (base64_decode($_REQUEST[list_t_proveedor])!='') $where=" and p.dpr_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_proveedor]));
		
		if (base64_decode($_REQUEST[list_t_nombre])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) ilike '%".
		base64_decode($_REQUEST[list_t_nombre])."%'";
		
		$this->DocProveedoresEntidad->setWhere($where);
		$this->DocProveedoresEntidad->setOrder("p.dpr_identificacion");
		$docProveedoresRetorna=$this->NegocioFacade->listarDocProveedores($this->DocProveedoresEntidad);
		
		$resultado=$docProveedoresRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarPagos() {
		
		if (base64_decode($_REQUEST[list_t_pago])!='') $where=" and p.pag_consecutivo=".str_replace(',', '', base64_decode($_REQUEST[list_t_pago]));
		
		if (base64_decode($_REQUEST[list_t_proveedor])!='') $where.=" and p.pag_proveedor=".str_replace(',', '', base64_decode($_REQUEST[list_t_proveedor]));
		
		if (base64_decode($_REQUEST[list_t_cliente])!='') $where.=" and p.pag_cliente=".str_replace(',', '', base64_decode($_REQUEST[list_t_cliente]));
		
		if (base64_decode($_REQUEST[list_t_nombre_p])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) ilike ".
		"'%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre_p])))."%'";
		
		if (base64_decode($_REQUEST[list_t_nombre_c])!='') $where.=" and trim(d1.dir_nombres||' '||case when d1.dir_apellidos is null then '' else d1.dir_apellidos end) ".
		"ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre_c])))."%'";
		
		$this->PagosEntidad->setWhere($where);
		$this->PagosEntidad->setOrder("p.pag_consecutivo desc");
		$pagosRetorna=$this->NegocioFacade->listarPagos($this->PagosEntidad);
		
		$resultado=$pagosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarDocPagos() {
		
		$this->DocPagosEntidad->setWhere(base64_decode($_REQUEST[where]));
		$docPagosRetorna=$this->NegocioFacade->listarDocPagos($this->DocPagosEntidad);
		
		$resultado=$docPagosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarDirectorio() {
		
		if (base64_decode($_REQUEST[list_t_identificacion])!='') $where=" and d.dir_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_identificacion]));
		
		if (base64_decode($_REQUEST[list_t_nombre])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' elsed.dir_apellidos end) ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre])))."%'";
		
		$this->DirectorioEntidad->setWhere($where);
		
		//$this->DirectorioEntidad->setOrder("d.cli_estado");
		$directorioRetorna=$this->NegocioFacade->listarDirectorio($this->DirectorioEntidad);
		
		$resultado=$directorioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarCiiu() {
		
		if (base64_decode($_REQUEST[list_t_ciiu])!='') $where=" and c.ciu_codigo='".base64_decode($_REQUEST[list_t_ciiu])."'";
		if (base64_decode($_REQUEST[list_t_lugar])!='') $where.=" and c.ciu_lugar='".base64_decode($_REQUEST[list_t_lugar])."'";
		
		$this->CiiuEntidad->setWhere($where);
		
		$this->CiiuEntidad->setOrder("c.ciu_codigo,c.ciu_lugar");
		$ciiuRetorna=$this->NegocioFacade->listarCiiu($this->CiiuEntidad);
		
		$resultado=$ciiuRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarCiiuDirectorio() {
		
		if (base64_decode($_REQUEST[list_t_identificacion])!='') $where=" and c.cdi_identificacion=".str_replace(',', '', base64_decode($_REQUEST[list_t_identificacion]));
		
		$this->CiiuDirectorioEntidad->setWhere($where);
		
		$this->CiiuDirectorioEntidad->setOrder("c.cdi_identificacion,c.cdi_lugar,c.cdi_principal desc,c.cdi_ciiu");
		$ciiuDirectorioRetorna=$this->NegocioFacade->listarCiiuDirectorio($this->CiiuDirectorioEntidad);
		
		$resultado=$ciiuDirectorioRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarBienServicios() {
		
		if (base64_decode($_REQUEST[list_t_bien_serv])!='') $where=" and bs.bse_consecutivo=".base64_decode($_REQUEST[list_t_bien_serv]);
		if (base64_decode($_REQUEST[list_t_bien_servicio])!='') $where.=" and bs.bse_bien_servicio ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_bien_servicio])))."%'";
		if (base64_decode($_REQUEST[list_s_detallado])!='') $where.=" and bs.bse_detallado in (".base64_decode($_REQUEST[list_s_detallado]).")";
		
		$this->BienServiciosEntidad->setWhere($where);
		
		$this->BienServiciosEntidad->setOrder("bs.bse_bien_servicio");
		$bienServiciosRetorna=$this->NegocioFacade->listarBienServicios($this->BienServiciosEntidad);
		
		$resultado=$bienServiciosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarCuentaPuc() {
		
		if (base64_decode($_REQUEST[list_t_cta_puc])!='') $where=" and cp.cup_codigo like '".base64_decode($_REQUEST[list_t_cta_puc])."%'";
		if (base64_decode($_REQUEST[list_t_nombre_puc])!='') $where=" and cp.cup_nombre ilike '%".
		pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nombre_puc])))."%'";
		if (base64_decode($_REQUEST[list_t_nm_cliente])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else ".
				"d.dir_apellidos end) ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nm_cliente])))."%'";
		
		$this->CuentaPucEntidad->setWhere($where);
		
		$this->CuentaPucEntidad->setOrder("nombres,cp.cup_codigo");
		$cuentaPucRetorna=$this->NegocioFacade->listarCuentaPuc($this->CuentaPucEntidad);
		
		$resultado=$cuentaPucRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarMovimiento() {
		
		if (is_array($_REQUEST[list_t_cta_puc])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_cp]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and m.mov_cuenta_puc = '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and m.mov_cuenta_puc <> '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'EMPIEZA CON':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and m.mov_cuenta_puc like '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."%'";
					break;
					
				case 'TERMINA EN':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and m.mov_cuenta_puc like '%".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'CONTIENE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and m.mov_cuenta_puc like '%".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."%'";
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc_f]))!='') {
							$where.=" and m.mov_cuenta_puc between '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."' and '".
							$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc_f]))."'";
						} else {
							$where.=" and m.mov_cuenta_puc = '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_cta_puc]);$i++) {
						if (base64_decode($_REQUEST[list_t_cta_puc][$i])!='') $cd_ctapuc[count($cd_ctapuc)]=base64_decode($_REQUEST[list_t_cta_puc][$i]);
					}
					if (count($cd_ctapuc)>0) $where.=" and m.mov_cuenta_puc in ('".implode("','", $cd_ctapuc)."')";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_cta_puc])!='') $where.=" and m.mov_cuenta_puc = '".base64_decode($_REQUEST[list_t_cta_puc])."'";
		}
		
		if (is_array($_REQUEST[list_t_fc_mov])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_fm]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento = '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento <> '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MAYOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento >= '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MAYOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento > '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MENOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento <= '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MENOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento < '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov_f]))!='') {
							$where.=" and m.mov_fecha_movimiento between '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."' and '".
							$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov_f]))."'";
						} else {
							$where.=" and m.mov_fecha_movimiento = '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_fc_mov]);$i++) {
						if (base64_decode($_REQUEST[list_t_fc_mov][$i])!='') $fc_movimiento[count($fc_movimiento)]=$this->NegocioFacade->
						reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]));
					}
					if (count($fc_movimiento)>0) $where.=" and m.mov_fecha_movimiento in ('".implode("','", $fc_movimiento)."')";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_fc_mov])!='') $where.=" and m.mov_fecha_movimiento = '".base64_decode($_REQUEST[list_t_fc_mov])."'";
		}
		
		if (is_array($_REQUEST[list_t_vl_mov])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_vm]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor = ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor <> ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MAYOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor >= ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MAYOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor > ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MENOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor <= ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MENOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and m.mov_valor < ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov_f]))!='') {
							$where.=" and m.mov_valor between ".$this->NegocioFacade->str_replace(',', '', $this->NegocioFacade->
							reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])))." and ".str_replace(',', '', $this->NegocioFacade->
							reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov_f])));
						} else {
							$where.=" and m.mov_valor = ".str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_vl_mov]);$i++) {
						if (base64_decode($_REQUEST[list_t_vl_mov][$i])!='') $vl_movimiento[count($vl_movimiento)]=str_replace(',', '', $this->NegocioFacade->
						reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					}
					if (count($fc_movimiento)>0) $where.=" and m.mov_valor in (".implode(",", $vl_movimiento).")";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_vl_mov])!='') $where.=" and m.mov_valor = ".str_replace(',', '', $this->NegocioFacade->
			reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
		}
		
		if (base64_decode($_REQUEST[list_t_nm_cliente])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else ".
		"d.dir_apellidos end) ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nm_cliente])))."%'";
		
		if (base64_decode($_REQUEST[list_t_comprobante])!='') $where.=" and m.mov_codigo_comprobante||case when m.mov_nombre_comprobante is null then '' else '-'||m.".
		"mov_nombre_comprobante end ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_comprobante])))."%'";
		
		if (base64_decode($_REQUEST[list_s_estado])!='') $where.=" and m.mov_estado in (".base64_decode($_REQUEST[list_s_estado]).")";
		
		$this->MovimientoEntidad->setWhere($where);
		
		$this->MovimientoEntidad->setOrder("nombres,m.mov_fecha_movimiento,m.mov_nombre_comprobante,m.mov_numero_comprobante");
		$movimientoRetorna=$this->NegocioFacade->listarMovimiento($this->MovimientoEntidad);
		
		$resultado=$movimientoRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarSaldos() {
		
		if (is_array($_REQUEST[list_t_cta_puc])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_cp]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and s.sal_cuenta_puc = '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and s.sal_cuenta_puc <> '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'EMPIEZA CON':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and s.sal_cuenta_puc like '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."%'";
					break;
					
				case 'TERMINA EN':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and s.sal_cuenta_puc like '%".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
					break;
					
				case 'CONTIENE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') $where.=" and s.sal_cuenta_puc like '%".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."%'";
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc_f]))!='') {
							$where.=" and s.sal_cuenta_puc between '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."' and '".
							$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc_f]))."'";
						} else {
							$where.=" and s.sal_cuenta_puc = '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_cta_puc][0]))."'";
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_cta_puc]);$i++) {
						if (base64_decode($_REQUEST[list_t_cta_puc][$i])!='') $cd_ctapuc[count($cd_ctapuc)]=base64_decode($_REQUEST[list_t_cta_puc][$i]);
					}
					if (count($cd_ctapuc)>0) $where.=" and s.sal_cuenta_puc in ('".implode("','", $cd_ctapuc)."')";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_cta_puc])!='') $where.=" and m.mov_cuenta_puc = '".base64_decode($_REQUEST[list_t_cta_puc])."'";
		}
		
		if (is_array($_REQUEST[list_t_fc_mov])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_fm]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento = '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento <> '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MAYOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento >= '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MAYOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento > '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MENOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento <= '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'MENOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') $where.=" and m.mov_fecha_movimiento < '".
					$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov_f]))!='') {
							$where.=" and m.mov_fecha_movimiento between '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."' and '".
							$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov_f]))."'";
						} else {
							$where.=" and m.mov_fecha_movimiento = '".$this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]))."'";
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_fc_mov]);$i++) {
						if (base64_decode($_REQUEST[list_t_fc_mov][$i])!='') $fc_movimiento[count($fc_movimiento)]=$this->NegocioFacade->
						reempJsCaracEsp(base64_decode($_REQUEST[list_t_fc_mov][0]));
					}
					if (count($fc_movimiento)>0) $where.=" and m.mov_fecha_movimiento in ('".implode("','", $fc_movimiento)."')";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_fc_mov])!='') $where.=" and m.mov_fecha_movimiento = '".base64_decode($_REQUEST[list_t_fc_mov])."'";
		}
		
		if (is_array($_REQUEST[list_t_vl_mov])) {
			switch ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_s_cond_vm]))) {
				case 'IGUAL':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor = ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'DIFERENTE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor <> ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MAYOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor >= ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MAYOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor > ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MENOR O IGUAL A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor <= ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'MENOR A':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') $where.=" and s.sal_valor < ".
					str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					break;
					
				case 'ENTRE':
					if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0]))!='') {
						if ($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov_f]))!='') {
							$where.=" and s.sal_valor between ".$this->NegocioFacade->str_replace(',', '', $this->NegocioFacade->
							reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])))." and ".str_replace(',', '', $this->NegocioFacade->
							reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov_f])));
						} else {
							$where.=" and s.sal_valor = ".str_replace(',', '', $this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
						}
					}
					break;
					
				case 'VARIAS':
					for ($i=0;$i<count($_REQUEST[list_t_vl_mov]);$i++) {
						if (base64_decode($_REQUEST[list_t_vl_mov][$i])!='') $vl_movimiento[count($vl_movimiento)]=str_replace(',', '', $this->NegocioFacade->
						reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
					}
					if (count($fc_movimiento)>0) $where.=" and s.sal_valor in (".implode(",", $vl_movimiento).")";
					break;
			}
			
			
		} else {
			if (base64_decode($_REQUEST[list_t_vl_mov])!='') $where.=" and s.sal_valor = ".str_replace(',', '', $this->NegocioFacade->
			reempJsCaracEsp(base64_decode($_REQUEST[list_t_vl_mov][0])));
		}
		
		if (base64_decode($_REQUEST[list_t_nm_cliente])!='') $where.=" and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else ".
		"d.dir_apellidos end) ilike '%".pg_escape_string($this->NegocioFacade->reempJsCaracEsp(base64_decode($_REQUEST[list_t_nm_cliente])))."%'";
		
		$this->SaldosEntidad->setWhere($where);
		
		$this->SaldosEntidad->setOrder("nombres,s.sal_anio_mes,s.sal_cuenta_puc,s.sal_centro_costo,s.sal_tercero,s.sal_segundo_tercero");
		$saldosRetorna=$this->NegocioFacade->listarSaldos($this->SaldosEntidad);
		
		$resultado=$saldosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print;
		}
	}
	
	function consultarModulos() {
		
		if (base64_decode($_REQUEST[list_t_codigo])!='') $where=" and mm.mme_codigo=".base64_decode($_REQUEST[list_t_codigo]);
		
		$this->ModulosEntidad->setWhere($where);
		
		$this->ModulosEntidad->setOrder("mm.mme_codigo");
		$modulosRetorna=$this->NegocioFacade->listarModulos($this->ModulosEntidad);
		
		$resultado=$modulosRetorna->getResultado();
		if (pg_num_rows($resultado)>0) {
			$i=0;
			while ($filas=pg_fetch_row($resultado)) {
				if ($i>0) $print.="##";
				$print.=implode('@@',$filas);
				$i++;
			}
			echo $print.'$$'.$_SESSION[ITZAudUs].'$$'.$this->NegocioFacade->formatAmPm(date('Y-m-d H:i:s'));
		}
	}
	
	function registraAcceso() {
		$this->AccesoModulosEntidad->setIdx(0);
		$this->AccesoModulosEntidad->setModulo(base64_decode($_REQUEST[modulo]));
		$this->AccesoModulosEntidad->setUsuario(base64_decode($_SESSION[ITZAudUs]));
		$this->AccesoModulosEntidad->setFechaHora(date('Y-m-d H:i:s'));
		$this->AccesoModulosEntidad->setAcceso(base64_decode($_REQUEST[acceso]));
		if ($_SERVER) {
			if ( $_SERVER[HTTP_X_FORWARDED_FOR] ) {
				$ip_real = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} elseif ( $_SERVER['HTTP_CLIENT_IP'] ) {
				$ip_real = $_SERVER['HTTP_CLIENT_IP'];
			} else {
				$ip_real = $_SERVER['REMOTE_ADDR'];
			}
		} else {
			if ( getenv( 'HTTP_X_FORWARDED_FOR' ) ) {
				$ip_real = getenv( 'HTTP_X_FORWARDED_FOR' );
			} elseif ( getenv( 'HTTP_CLIENT_IP' ) ) {
				$ip_real = getenv( 'HTTP_CLIENT_IP' );
			} else {
				$ip_real = getenv( 'REMOTE_ADDR' );
			}
		}
		echo $ip_real;
		$this->AccesoModulosEntidad->setIp($ip_real);
		$accesoModulosRetorna=$this->NegocioFacade->adicionarAccesoModulos($this->AccesoModulosEntidad);
	}
}

$control = new Control();
$control->workflow(base64_decode($_REQUEST["action"]));
?>