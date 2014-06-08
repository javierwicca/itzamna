<?php
namespace Negocio;
require_once '../Negocio/Auditoria/BienServiciosNegocio.php';
require_once '../Negocio/Auditoria/CuentaPucNegocio.php';
require_once '../Negocio/Auditoria/DetalleFormularioNegocio.php';
require_once '../Negocio/Auditoria/DetallePagosNegocio.php';
require_once '../Negocio/Auditoria/DocPagosNegocio.php';
require_once '../Negocio/Auditoria/DocProveedoresNegocio.php';
require_once '../Negocio/Auditoria/EncabezadoFormularioNegocio.php';
require_once '../Negocio/Auditoria/ImpuestoPagosNegocio.php';
require_once '../Negocio/Auditoria/MovimientoNegocio.php';
require_once '../Negocio/Auditoria/PagosNegocio.php';
require_once '../Negocio/Auditoria/ProveedoresNegocio.php';
require_once '../Negocio/Auditoria/SaldosNegocio.php';
require_once '../Negocio/Configuracion/AccesoModulosNegocio.php';
require_once '../Negocio/Configuracion/CiiuDirectorioNegocio.php';
require_once '../Negocio/Configuracion/CiiuNegocio.php';
require_once '../Negocio/Configuracion/ClientesNegocio.php';
require_once '../Negocio/Configuracion/DirectorioNegocio.php';
require_once '../Negocio/Configuracion/LugaresNegocio.php';
require_once '../Negocio/Configuracion/ModulosNegocio.php';
require_once '../Negocio/Configuracion/ParametrosNegocio.php';
require_once '../Negocio/Configuracion/PermisosExcepcionalesNegocio.php';
require_once '../Negocio/Configuracion/RolesNegocio.php';
require_once '../Negocio/Configuracion/RolesPermisosNegocio.php';
require_once '../Negocio/Configuracion/RolesUsuariosNegocio.php';
require_once '../Negocio/Configuracion/UsuarioNegocio.php';
require_once '../Negocio/General/CorreoNegocio.php';
require_once '../Negocio/General/ModificadorTablasNegocio.php';
require_once 'FuncionesNegocio.php';
require_once 'INegocioFacade.php';

require_once '../Entidades/Auditoria/BienServiciosEntidad.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';
require_once '../Entidades/Auditoria/DetalleFormularioEntidad.php';
require_once '../Entidades/Auditoria/DetallePagosEntidad.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';
require_once '../Entidades/Auditoria/EncabezadoFormularioEntidad.php';
require_once '../Entidades/Auditoria/ImpuestoPagosEntidad.php';
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
require_once '../Entidades/General/CorreoEntidad.php';
require_once '../Entidades/General/ModificadorTablasEntidad.php';

use Negocio\AccesoModulosNegocio;
use Negocio\BienServiciosNegocio;
use Negocio\CiiuDirectorioNegocio;
use Negocio\CiiuNegocio;
use Negocio\ClientesNegocio;
use Negocio\CorreoNegocio;
use Negocio\CuentaPucNegocio;
use Negocio\DetalleFormularioNegocio;
use Negocio\DetallePagosNegocio;
use Negocio\DirectorioNegocio;
use Negocio\DocPagosNegocio;
use Negocio\DocProveedoresNegocio;
use Negocio\EncabezadoFormularioNegocio;
use Negocio\ImpuestoPagosNegocio;
use Negocio\LugaresNegocio;
use Negocio\ModificadorTablasNegocio;
use Negocio\ModulosNegocio;
use Negocio\MovimientoNegocio;
use Negocio\PagosNegocio;
use Negocio\ParametrosNegocio;
use Negocio\PermisosExcepcionalesNegocio;
use Negocio\ProveedoresNegocio;
use Negocio\RolesNegocio;
use Negocio\RolesPermisosNegocio;
use Negocio\RolesUsuariosNegocio;
use Negocio\SaldosNegocio;
use Negocio\UsuarioNegocio;

use Entidades\AccesoModulosEntidad;
use Entidades\BienServiciosEntidad;
use Entidades\CiiuDirectorioEntidad;
use Entidades\CiiuEntidad;
use Entidades\ClientesEntidad;
use Entidades\CorreoEntidad;
use Entidades\CuentaPucEntidad;
use Entidades\DetalleFormularioEntidad;
use Entidades\DetallePagosEntidad;
use Entidades\DirectorioEntidad;
use Entidades\DocPagosEntidad;
use Entidades\DocProveedoresEntidad;
use Entidades\EncabezadoFormularioEntidad;
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
use Entidades\SaldosEntidad;
use Entidades\UsuarioEntidad;
use DAO\EncabezadoFormularioDAO;

class NegocioFacade implements INegocioFacade{
	
	private $accesoModulosNegocio;
	private $bienServiciosNegocio;
	private $ciiuDirectorioNegocio;
	private $ciiuNegocio;
	private $clientesNegocio;
	private $correoNegocio;
	private $cuentaPucNegocio;
	private $detalleFormularioNegocio;
	private $detallePagosNegocio;
	private $directorioNegocio;
	private $docPagosNegocio;
	private $docProveedoresNegocio;
	private $encabezadoFormularioNegocio;
	private $funcionesNegocio;
	private $impuestoPagosNegocio;
	private $lugaresNegocio;
	private $modificadorTablasNegocio;
	private $modulosNegocio;
	private $movimientoNegocio;
	private $pagosNegocio;
	private $parametrosNegocio;
	private $permisosExcepcionalesNegocio;
	private $proveedoresNegocio;
	private $rolesNegocio;
	private $rolesPermisosNegocio;
	private $rolesUsuariosNegocio;
	private $saldosNegocio;
	private $usuarioNegocio;
	
	function __construct(){
		if (!isset($this->accesoModulosNegocio))$this->accesoModulosNegocio=new AccesoModulosNegocio();
		if (!isset($this->bienServiciosNegocio))$this->bienServiciosNegocio=new BienServiciosNegocio();
		if (!isset($this->ciiuDirectorioNegocio))$this->ciiuDirectorioNegocio=new CiiuDirectorioNegocio();
		if (!isset($this->ciiuNegocio))$this->ciiuNegocio=new CiiuNegocio();
		if (!isset($this->clientesNegocio))$this->clientesNegocio=new ClientesNegocio();
		if (!isset($this->correoNegocio))$this->correoNegocio=new CorreoNegocio();
		if (!isset($this->cuentaPucNegocio))$this->cuentaPucNegocio=new CuentaPucNegocio();
		if (!isset($this->detalleFormularioNegocio))$this->detalleFormularioNegocio=new DetallePagosNegocio();
		if (!isset($this->detallePagosNegocio))$this->detallePagosNegocio=new DetallePagosNegocio();
		if (!isset($this->directorioNegocio))$this->directorioNegocio=new DirectorioNegocio();
		if (!isset($this->docPagosNegocio))$this->docPagosNegocio=new DocPagosNegocio();
		if (!isset($this->docProveedoresNegocio))$this->docProveedoresNegocio=new DocProveedoresNegocio();
		if (!isset($this->encabezadoFormularioNegocio))$this->encabezadoFormularioNegocio=new EncabezadoFormularioDAO();
		if (!isset($this->funcionesNegocio))$this->funcionesNegocio=new FuncionesNegocio();
		if (!isset($this->impuestoPagosNegocio))$this->impuestoPagosNegocio=new ImpuestoPagosNegocio();
		if (!isset($this->lugaresNegocio))$this->lugaresNegocio=new LugaresNegocio();
		if (!isset($this->modificadorTablasNegocio))$this->modificadorTablasNegocio=new ModificadorTablasNegocio();
		if (!isset($this->modulosNegocio))$this->modulosNegocio=new ModulosNegocio();
		if (!isset($this->movimientoNegocio))$this->movimientoNegocio=new MovimientoNegocio();
		if (!isset($this->pagosNegocio))$this->pagosNegocio=new PagosNegocio();
		if (!isset($this->parametrosNegocio))$this->parametrosNegocio=new ParametrosNegocio();
		if (!isset($this->permisosExcepcionalesNegocio))$this->permisosExcepcionalesNegocio=new PermisosExcepcionalesNegocio();
		if (!isset($this->proveedoresNegocio))$this->proveedoresNegocio=new ProveedoresNegocio();
		if (!isset($this->rolesNegocio))$this->rolesNegocio=new RolesNegocio();
		if (!isset($this->rolesPermisosNegocio))$this->rolesPermisosNegocio=new RolesPermisosNegocio();
		if (!isset($this->rolesUsuariosNegocio))$this->rolesUsuariosNegocio=new RolesUsuariosNegocio();
		if (!isset($this->saldosNegocio))$this->saldosNegocio=new SaldosNegocio();
		if (!isset($this->usuarioNegocio))$this->usuarioNegocio=new UsuarioNegocio();
		
	}
	
	public function buscarUsuario(UsuarioEntidad $usuario) {
		return $this->usuarioNegocio->buscarUsuario($usuario);
	}
	
	public function adicionarUsuario(UsuarioEntidad $usuario) {
		return $this->usuarioNegocio->adicionarUsuario($usuario);
	}
	
	public function modificarUsuario(UsuarioEntidad $usuario) {
		return $this->usuarioNegocio->modificarUsuario($usuario);
	}
	
	public function inactivarUsuario(UsuarioEntidad $usuario) {
		return $this->usuarioNegocio->inactivarUsuario($usuario);
	}
	
	public function cambioClave(UsuarioEntidad $usuario) {
		return $this->usuarioNegocio->cambioClave($usuario);
	}
	
	public function encriptaClave($usuario,$clave) {
		return $this->usuarioNegocio->encriptaClave($usuario,$clave);
	}
	
	public function listarModulos(ModulosEntidad $modulos) {
		return $this->modulosNegocio->listarModulos($modulos);
	}
	
	public function listarRoles(RolesEntidad $roles) {
		return $this->rolesNegocio->listarRoles($roles);
	}
	
	public function adicionarRoles(RolesEntidad $roles) {
		return $this->rolesNegocio->adicionarRoles($roles);
	}
	
	public function modificarRoles(RolesEntidad $roles) {
		return $this->rolesNegocio->modificarRoles($roles);
	}
	
	public function inactivarRoles(RolesEntidad $roles) {
		return $this->rolesNegocio->inactivarRoles($roles);
	}
	
	public function listarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->rolesPermisosNegocio->listarRolesPermisos($rolesPermisos);
	}
	
	public function adicionarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->rolesPermisosNegocio->adicionarRolesPermisos($rolesPermisos);
	}
	
	public function modificarRolesPermisos(RolesPermisosEntidad $rolesPermisos) {
		return $this->rolesPermisosNegocio->modificarRolesPermisos($rolesPermisos);
	}
	
	public function listarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->rolesUsuariosNegocio->listarRolesUsuarios($rolesUsuarios);
	}
	
	public function adicionarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->rolesUsuariosNegocio->adicionarRolesUsuarios($rolesUsuarios);
	}
	
	public function modificarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios) {
		return $this->rolesUsuariosNegocio->modificarRolesUsuarios($rolesUsuarios);
	}
	
	public function listarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->permisosExcepcionalesNegocio->listarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function adicionarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->permisosExcepcionalesNegocio->adicionarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function modificarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales) {
		return $this->permisosExcepcionalesNegocio->modificarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function listarClientes(ClientesEntidad $clientes) {
		return $this->clientesNegocio->listarClientes($clientes);
	}
	
	public function adicionarClientes(ClientesEntidad $clientes) {
		return $this->clientesNegocio->adicionarClientes($clientes);
	}
	
	public function modificarClientes(ClientesEntidad $clientes) {
		return $this->clientesNegocio->modificarClientes($clientes);
	}
	
	public function inactivarClientes(ClientesEntidad $clientes) {
		return $this->clientesNegocio->inactivarClientes($clientes);
	}
	
	public function listarProveedores(ProveedoresEntidad $proveedores) {
		return $this->proveedoresNegocio->listarProveedores($proveedores);
	}
	
	public function adicionarProveedores(ProveedoresEntidad $proveedores) {
		return $this->proveedoresNegocio->adicionarProveedores($proveedores);
	}
	
	public function modificarProveedores(ProveedoresEntidad $proveedores) {
		return $this->proveedoresNegocio->modificarProveedores($proveedores);
	}
	
	public function inactivarProveedores(ProveedoresEntidad $proveedores) {
		return $this->proveedoresNegocio->inactivarProveedores($proveedores);
	}
	
	public function listarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->docProveedoresNegocio->listarDocProveedores($docProveedores);
	}
	
	public function adicionarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->docProveedoresNegocio->adicionarDocProveedores($docProveedores);
	}
	
	public function modificarDocProveedores(DocProveedoresEntidad $docProveedores) {
		return $this->docProveedoresNegocio->modificarDocProveedores($docProveedores);
	}
	
	public function listarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioNegocio->listarDirectorio($directorio);
	}
	
	public function adicionarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioNegocio->adicionarDirectorio($directorio);
	}
	
	public function modificarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioNegocio->modificarDirectorio($directorio);
	}
	
	public function inactivarDirectorio(DirectorioEntidad $Directorio){
		return $this->directorioNegocio->inactivarDirectorio($directorio);
	}
	
	public function listarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuNegocio->listarCiiu($ciiu);
	}
	
	public function adicionarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuNegocio->adicionarCiiu($ciiu);
	}
	
	public function modificarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuNegocio->modificarCiiu($ciiu);
	}
	
	public function listarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioNegocio->listarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function adicionarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioNegocio->adicionarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function modificarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioNegocio->modificarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function listarParametros(ParametrosEntidad $parametros){
		return $this->parametrosNegocio->listarParametros($parametros);
	}
	
	public function adicionarParametros(ParametrosEntidad $parametros){
		return $this->parametrosNegocio->adicionarParametros($parametros);
	}
	
	public function modificarParametros(ParametrosEntidad $parametros){
		return $this->parametrosNegocio->modificarParametros($parametros);
	}
	
	public function listarLugares(LugaresEntidad $lugares){
		return $this->lugaresNegocio->listarLugares($lugares);
	}
	
	public function adicionarLugares(LugaresEntidad $lugares){
		return $this->lugaresNegocio->adicionarLugares($lugares);
	}
	
	public function modificarLugares(LugaresEntidad $lugares){
		return $this->lugaresNegocio->modificarLugares($lugares);
	}
	
	public function listarModulosUsuario(UsuarioEntidad $usuario){
		return $this->modulosNegocio->listarModulosUsuario($usuario);
	}
	
	public function listarModificadorTablas(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasNegocio->listarModificadorTablas($modificadorTablas);
	}
	
	public function adicionarModificadorTablas(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasNegocio->adicionarModificadorTablas($modificadorTablas);
	}
	
	public function ultUsuarioFechaHora(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasNegocio->ultUsuarioFechaHora($modificadorTablas);
	}
	
	public function listarAccesoModulos(AccesoModulosEntidad $accesoModulos){
		return $this->accesoModulosNegocio->listarAccesoModulos($accesoModulos);
	}
	
	public function adicionarAccesoModulos(AccesoModulosEntidad $accesoModulos){
		return $this->accesoModulosNegocio->adicionarAccesoModulos($accesoModulos);
	}
	
	public function listarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosNegocio->listarBienServicios($bienServicios);
	}
	
	public function adicionarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosNegocio->adicionarBienServicios($bienServicios);
	}
	
	public function modificarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosNegocio->modificarBienServicios($bienServicios);
	}
	
	public function listarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosNegocio->listarDetallePagos($detallePagos);
	}
	
	public function adicionarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosNegocio->adicionarDetallePagos($detallePagos);
	}
	
	public function modificarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosNegocio->modificarDetallePagos($detallePagos);
	}
	
	public function listarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosNegocio->listarDocPagos($docPagos);
	}
	
	public function adicionarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosNegocio->adicionarDocPagos($docPagos);
	}
	
	public function modificarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosNegocio->modificarDocPagos($docPagos);
	}
	
	public function listarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosNegocio->listarImpuestoPagos($impuestoPagos);
	}
	
	public function adicionarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosNegocio->adicionarImpuestoPagos($impuestoPagos);
	}
	
	public function modificarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosNegocio->modificarImpuestoPagos($impuestoPagos);
	}
	
	public function listarPagos(PagosEntidad $pagos){
		return $this->pagosNegocio->listarPagos($pagos);
	}
	
	public function adicionarPagos(PagosEntidad $pagos){
		return $this->pagosNegocio->adicionarPagos($pagos);
	}
	
	public function modificarPagos(PagosEntidad $pagos){
		return $this->pagosNegocio->modificarPagos($pagos);
	}
	
	public function listarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->cuentaPucNegocio->listarCuentaPuc($cuentaPuc);
	}
	
	public function modificarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->cuentaPucNegocio->modificarCuentaPuc($cuentaPuc);
	}
	
	public function listarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoNegocio->listarMovimiento($movimiento);
	}
	
	public function comboMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoNegocio->comboMovimiento($movimiento);
	}
	
	public function borrarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoNegocio->borrarMovimiento($movimiento);
	}
	
	public function insertarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoNegocio->insertarMovimiento($movimiento);
	}
	
	public function insertarMovimientoCop(MovimientoEntidad $movimiento){
		return $this->movimientoNegocio->insertarMovimientoCop($movimiento);
	}
	
	public function listarSaldos(SaldosEntidad $saldos){
		return $this->saldosNegocio->listarSaldos($saldos);
	}
	
	public function borrarSaldos(SaldosEntidad $saldos){
		return $this->saldosNegocio->borrarSaldos($saldos);
	}
	
	public function insertarSaldos(SaldosEntidad $saldos){
		return $this->saldosNegocio->insertarSaldos($saldos);
	}
	
	public function insertarSaldosCop(SaldosEntidad $saldos){
		return $this->saldosNegocio->insertarSaldosCop($saldos);
	}
	
	public function enviarCorreo(CorreoEntidad $correo){
		return $this->correoNegocio->enviarCorreo($correo);
	}
	
	public function listarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->encabezadoFormularioNegocio->listarEncabezadoFormulario($encabezadoFormulario);
	}
	
	public function adicionarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->encabezadoFormularioNegocio->adicionarEncabezadoFormulario($encabezadoFormulario);
	}
	
	public function modificarEncabezadoFormulario(EncabezadoFormularioEntidad $encabezadoFormulario){
		return $this->encabezadoFormularioNegocio->modificarEncabezadoFormulario($encabezadoFormulario);
	}
	
	public function listarDetalleFormulario(DetalleFormularioEntidad $detalleFormulario){
		return $this->encabezadoFormularioNegocio->listarDetalleFormulario($detalleFormulario);
	}
	
	public function reempHtmlCaracEsp($texto) {
		return $this->funcionesNegocio->reempHtmlCaracEsp($texto);
	}
	
	public function reempCaracEspHtml($texto) {
		return $this->funcionesNegocio->reempCaracEspHtml($texto);
	}
	
	public function reempCaracEspDojo($texto) {
		return $this->funcionesNegocio->reempCaracEspDojo($texto);
	}
	
	public function reempJsCaracEsp($texto) {
		return $this->funcionesNegocio->reempJsCaracEsp($texto);
	}
	
	public function formatAmPm($fecha) {
		return $this->funcionesNegocio->formatAmPm($fecha);
	}
	
	public function formatHrAmPm($fecha) {
		return $this->funcionesNegocio->formatHrAmPm($fecha);
	}
	
	public function formatFc($fecha) {
		return $this->funcionesNegocio->formatFc($fecha);
	}
	
	public function formatCf($fecha) {
		return $this->funcionesNegocio->formatCf($fecha);
	}
	
	public function fomatDjFc($fecha) {
		return $this->funcionesNegocio->fomatDjFc($fecha);
	}
	
	public function arPhpArSql($a_php) {
		return $this->funcionesNegocio->arPhpArSql($a_php);
	}
	
	public function arSqlArPhp($a_sql) {
		return $this->funcionesNegocio->arSqlArPhp($a_sql);
	}
	
}
?>