<?php
namespace DAO;
require_once '../DAO/Auditoria/BienServiciosDAO.php';
require_once '../DAO/Auditoria/CuentaPucDAO.php';
require_once '../DAO/Auditoria/DetallePagosDAO.php';
require_once '../DAO/Auditoria/DocPagosDAO.php';
require_once '../DAO/Auditoria/DocProveedoresDAO.php';
require_once '../DAO/Auditoria/ImpuestoPagosDAO.php';
require_once '../DAO/Auditoria/MovimientoDAO.php';
require_once '../DAO/Auditoria/PagosDAO.php';
require_once '../DAO/Auditoria/ProveedoresDAO.php';
require_once '../DAO/Auditoria/SaldosDAO.php';
require_once '../DAO/Configuracion/AccesoModulosDAO.php';
require_once '../DAO/Configuracion/CiiuDAO.php';
require_once '../DAO/Configuracion/CiiuDirectorioDAO.php';
require_once '../DAO/Configuracion/ClientesDAO.php';
require_once '../DAO/Configuracion/DirectorioDAO.php';
require_once '../DAO/Configuracion/LugaresDAO.php';
require_once '../DAO/Configuracion/ModulosDAO.php';
require_once '../DAO/Configuracion/ParametrosDAO.php';
require_once '../DAO/Configuracion/PermisosExcepcionalesDAO.php';
require_once '../DAO/Configuracion/RolesDAO.php';
require_once '../DAO/Configuracion/RolesPermisosDAO.php';
require_once '../DAO/Configuracion/RolesUsuariosDAO.php';
require_once '../DAO/Configuracion/UsuarioDAO.php';
require_once '../DAO/General/CorreoDAO.php';
require_once '../DAO/General/ModificadorTablasDAO.php';
require_once 'IDAOFacade.php';

require_once '../Entidades/Auditoria/BienServiciosEntidad.php';
require_once '../Entidades/Auditoria/CuentaPucEntidad.php';
require_once '../Entidades/Auditoria/DetallePagosEntidad.php';
require_once '../Entidades/Auditoria/DocPagosEntidad.php';
require_once '../Entidades/Auditoria/DocProveedoresEntidad.php';
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

use DAO\AccesoModulosDAO;
use DAO\BienServiciosDAO;
use DAO\CiiuDAO;
use DAO\CiiuDirectorioDAO;
use DAO\ClientesDAO;
use DAO\CorreoDAO;
use DAO\CuentaPucDAO;
use DAO\DetallePagosDAO;
use DAO\DirectorioDAO;
use DAO\DocPagosDAO;
use DAO\DocProveedoresDAO;
use DAO\ImpuestoPagosDAO;
use DAO\LugaresDAO;
use DAO\ModifacadorTablasDAO;
use DAO\ModulosDAO;
use DAO\MovimientoDAO;
use DAO\PagosDAO;
use DAO\ParametrosDAO;
use DAO\PermisosExcepcionalesDAO;
use DAO\ProveedoresDAO;
use DAO\RolesDAO;
use DAO\RolesPermisosDAO;
use DAO\RolesUsuariosDAO;
use DAO\SaldosDAO;
use DAO\UsuarioDAO;

use Entidades\AccesoModulosEntidad;
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

class DAOFacade implements IDAOFacade{
	
	private $accesoModulosDAO;
	private $bienServiciosDAO;
	private $ciiuDAO;
	private $ciiuDirectorioDAO;
	private $clientesDAO;
	private $correoDAO;
	private $cuentaPucDAO;
	private $detallePagosDAO;
	private $directorioDAO;
	private $docPagosDAO;
	private $docProveedoresDAO;
	private $impuestoPagosDAO;
	private $lugaresDAO;
	private $modificadorTablasDAO;
	private $modulosDAO;
	private $movimientoDAO;
	private $pagosDAO;
	private $parametrosDAO;
	private $permisosExcepcionalesDAO;
	private $proveedoresDAO;
	private $rolesDAO;
	private $rolesPermisosDAO;
	private $rolesUsuariosDAO;
	private $saldosDAO;
	private $usuarioDAO;
	
	function __construct(){
		if (!isset($this->accesoModulosDAO))$this->accesoModulosDAO=new AccesoModulosDAO();
		if (!isset($this->bienServiciosDAO))$this->bienServiciosDAO=new BienServiciosDAO();
		if (!isset($this->ciiuDAO))$this->ciiuDAO=new CiiuDAO();
		if (!isset($this->ciiuDirectorioDAO))$this->ciiuDirectorioDAO=new CiiuDirectorioDAO();
		if (!isset($this->clientesDAO))$this->clientesDAO=new ClientesDAO();
		if (!isset($this->correoDAO))$this->correoDAO=new CorreoDAO();
		if (!isset($this->cuentaPucDAO))$this->cuentaPucDAO=new CuentaPucDAO();
		if (!isset($this->detallePagosDAO))$this->detallePagosDAO=new DetallePagosDAO();
		if (!isset($this->directorioDAO))$this->directorioDAO=new DirectorioDAO();
		if (!isset($this->docPagosDAO))$this->docPagosDAO=new DocPagosDAO();
		if (!isset($this->docProveedoresDAO))$this->docProveedoresDAO=new DocProveedoresDAO();
		if (!isset($this->impuestoPagosDAO))$this->impuestoPagosDAO=new ImpuestoPagosDAO();
		if (!isset($this->lugaresDAO))$this->lugaresDAO=new LugaresDAO();
		if (!isset($this->modificadorTablasDAO))$this->modificadorTablasDAO=new ModificadorTablasDAO();
		if (!isset($this->modulosDAO))$this->modulosDAO=new ModulosDAO();
		if (!isset($this->movimientoDAO))$this->movimientoDAO=new MovimientoDAO();
		if (!isset($this->pagosDAO))$this->pagosDAO=new PagosDAO();
		if (!isset($this->parametrosDAO))$this->parametrosDAO=new ParametrosDAO();
		if (!isset($this->permisosExcepcionalesDAO))$this->permisosExcepcionalesDAO=new PermisosExcepcionalesDAO();
		if (!isset($this->proveedoresDAO))$this->proveedoresDAO=new ProveedoresDAO();
		if (!isset($this->rolesDAO))$this->rolesDAO=new RolesDAO();
		if (!isset($this->rolesPermisosDAO))$this->rolesPermisosDAO=new RolesPermisosDAO();
		if (!isset($this->rolesUsuariosDAO))$this->rolesUsuariosDAO=new RolesUsuariosDAO();
		if (!isset($this->saldosDAO))$this->saldosDAO=new SaldosDAO();
		if (!isset($this->usuarioDAO))$this->usuarioDAO=new UsuarioDAO();
				
	}
	
	public function buscarUsuario(UsuarioEntidad $usuario){
		return $this->usuarioDAO->buscarUsuario($usuario);
	}
	
	public function adicionarUsuario(UsuarioEntidad $usuario){
		return $this->usuarioDAO->adicionarUsuario($usuario);
	}
	
	public function modificarUsuario(UsuarioEntidad $usuario){
		return $this->usuarioDAO->modificarUsuario($usuario);
	}
	
	public function inactivarUsuario(UsuarioEntidad $usuario){
		return $this->usuarioDAO->inactivarUsuario($usuario);
	}
	
	public function cambioClave(UsuarioEntidad $usuario){
		return $this->usuarioDAO->cambioClave($usuario);
	}
	
	public function listarModulos(ModulosEntidad $modulos){
		return $this->modulosDAO->listarModulos($modulos);
	}
	
	public function listarModulosUsuario(UsuarioEntidad $usuario){
		return $this->modulosDAO->listarModulosUsuario($usuario);
	}
	
	public function listarRoles(RolesEntidad $roles){
		return $this->rolesDAO->listarRoles($roles);
	}
	
	public function adicionarRoles(RolesEntidad $roles){
		return $this->rolesDAO->adicionarRoles($roles);
	}
	
	public function modificarRoles(RolesEntidad $roles){
		return $this->rolesDAO->modificarRoles($roles);
	}
	
	public function inactivarRoles(RolesEntidad $roles){
		return $this->rolesDAO->inactivarRoles($roles);
	}
	
	public function listarRolesPermisos(RolesPermisosEntidad $rolesPermisos){
		return $this->rolesPermisosDAO->listarRolesPermisos($rolesPermisos);
	}
	
	public function adicionarRolesPermisos(RolesPermisosEntidad $rolesPermisos){
		return $this->rolesPermisosDAO->adicionarRolesPermisos($rolesPermisos);
	}
	
	public function modificarRolesPermisos(RolesPermisosEntidad $rolesPermisos){
		return $this->rolesPermisosDAO->modificarRolesPermisos($rolesPermisos);
	}
	
	public function listarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios){
		return $this->rolesUsuariosDAO->listarRolesUsuarios($rolesUsuarios);
	}
	
	public function adicionarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios){
		return $this->rolesUsuariosDAO->adicionarRolesUsuarios($rolesUsuarios);
	}
	
	public function modificarRolesUsuarios(RolesUsuariosEntidad $rolesUsuarios){
		return $this->rolesUsuariosDAO->modificarRolesUsuarios($rolesUsuarios);
	}
	
	public function listarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales){
		return $this->permisosExcepcionalesDAO->listarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function adicionarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales){
		return $this->permisosExcepcionalesDAO->adicionarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function modificarPermisosExcepcionales(PermisosExcepcionalesEntidad $permisosExcepcionales){
		return $this->permisosExcepcionalesDAO->modificarPermisosExcepcionales($permisosExcepcionales);
	}
	
	public function listarClientes(ClientesEntidad $clientes){
		return $this->clientesDAO->listarClientes($clientes);
	}
	
	public function adicionarClientes(ClientesEntidad $clientes){
		return $this->clientesDAO->adicionarClientes($clientes);
	}
	
	public function modificarClientes(ClientesEntidad $clientes){
		return $this->clientesDAO->modificarClientes($clientes);
	}
	
	public function inactivarClientes(ClientesEntidad $clientes){
		return $this->clientesDAO->inactivarClientes($clientes);
	}
	
	public function listarProveedores(ProveedoresEntidad $proveedores){
		return $this->proveedoresDAO->listarProveedores($proveedores);
	}
	
	public function adicionarProveedores(ProveedoresEntidad $proveedores){
		return $this->proveedoresDAO->adicionarProveedores($proveedores);
	}
	
	public function modificarProveedores(ProveedoresEntidad $proveedores){
		return $this->proveedoresDAO->modificarProveedores($proveedores);
	}
	
	public function inactivarProveedores(ProveedoresEntidad $proveedores){
		return $this->proveedoresDAO->inactivarProveedores($proveedores);
	}
	
	public function listarDocProveedores(DocProveedoresEntidad $docProveedores){
		return $this->docProveedoresDAO->listarDocProveedores($docProveedores);
	}
	
	public function adicionarDocProveedores(DocProveedoresEntidad $docProveedores){
		return $this->docProveedoresDAO->adicionarDocProveedores($docProveedores);
	}
	
	public function modificarDocProveedores(DocProveedoresEntidad $docProveedores){
		return $this->docProveedoresDAO->modificarDocProveedores($docProveedores);
	}
	
	public function listarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioDAO->listarDirectorio($directorio);
	}
	
	public function adicionarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioDAO->adicionarDirectorio($directorio);
	}
	
	public function modificarDirectorio(DirectorioEntidad $directorio){
		return $this->directorioDAO->modificarDirectorio($directorio);
	}
	
	public function inactivarDirectorio(DirectorioEntidad $Directorio){
		return $this->directorioDAO->inactivarDirectorio($directorio);
	}
	
	public function listarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuDAO->listarCiiu($ciiu);
	}
	
	public function adicionarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuDAO->adicionarCiiu($ciiu);
	}
	
	public function modificarCiiu(CiiuEntidad $ciiu){
		return $this->ciiuDAO->modificarCiiu($ciiu);
	}
	
	public function listarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioDAO->listarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function adicionarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioDAO->adicionarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function modificarCiiuDirectorio(CiiuDirectorioEntidad $ciiuDirectorio){
		return $this->ciiuDirectorioDAO->modificarCiiuDirectorio($ciiuDirectorio);
	}
	
	public function listarLugares(LugaresEntidad $lugares){
		return $this->lugaresDAO->listarLugares($lugares);
	}
	
	public function adicionarLugares(LugaresEntidad $lugares){
		return $this->lugaresDAO->adicionarLugares($lugares);
	}
	
	public function modificarLugares(LugaresEntidad $lugares){
		return $this->lugaresDAO->modificarLugares($lugares);
	}
	
	public function listarParametros(ParametrosEntidad $parametros){
		return $this->parametrosDAO->listarParametros($parametros);
	}
	
	public function adicionarParametros(ParametrosEntidad $parametros){
		return $this->parametrosDAO->adicionarParametros($parametros);
	}
	
	public function modificarParametros(ParametrosEntidad $parametros){
		return $this->parametrosDAO->modificarParametros($parametros);
	}
	
	public function listarModificadorTablas(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasDAO->listarModificadorTablas($modificadorTablas);
	}
	
	public function ultUsuarioFechaHora(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasDAO->ultUsuarioFechaHora($modificadorTablas);
	}
	
	public function adicionarModificadorTablas(ModificadorTablasEntidad $modificadorTablas){
		return $this->modificadorTablasDAO->adicionarModificadorTablas($modificadorTablas);
	}
	
	public function listarAccesoModulos(AccesoModulosEntidad $accesoModulos){
		return $this->accesoModulosDAO->listarAccesoModulos($accesoModulos);
	}
	
	public function adicionarAccesoModulos(AccesoModulosEntidad $accesoModulos){
		return $this->accesoModulosDAO->adicionarAccesoModulos($accesoModulos);
	}
	
	public function listarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosDAO->listarBienServicios($bienServicios);
	}
	
	public function adicionarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosDAO->adicionarBienServicios($bienServicios);
	}
	
	public function modificarBienServicios(BienServiciosEntidad $bienServicios){
		return $this->bienServiciosDAO->modificarBienServicios($bienServicios);
	}
	
	public function listarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosDAO->listarDetallePagos($detallePagos);
	}
	
	public function adicionarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosDAO->adicionarDetallePagos($detallePagos);
	}
	
	public function modificarDetallePagos(DetallePagosEntidad $detallePagos){
		return $this->detallePagosDAO->modificarDetallePagos($detallePagos);
	}
	
	public function listarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosDAO->listarDocPagos($docPagos);
	}
	
	public function adicionarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosDAO->adicionarDocPagos($docPagos);
	}
	
	public function modificarDocPagos(DocPagosEntidad $docPagos){
		return $this->docPagosDAO->modificarDocPagos($docPagos);
	}
	
	public function listarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosDAO->listarImpuestoPagos($impuestoPagos);
	}
	
	public function adicionarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosDAO->adicionarImpuestoPagos($impuestoPagos);
	}
	
	public function modificarImpuestoPagos(ImpuestoPagosEntidad $impuestoPagos){
		return $this->impuestoPagosDAO->modificarImpuestoPagos($impuestoPagos);
	}
	
	public function listarPagos(PagosEntidad $pagos){
		return $this->pagosDAO->listarPagos($pagos);
	}
	
	public function adicionarPagos(PagosEntidad $pagos){
		return $this->pagosDAO->adicionarPagos($pagos);
	}
	
	public function modificarPagos(PagosEntidad $pagos){
		return $this->pagosDAO->modificarPagos($pagos);
	}
	
	public function enviarCorreo(CorreoEntidad $correo){
		return $this->correoDAO->enviarCorreo($correo);
	}
	
	public function listarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->cuentaPucDAO->listarCuentaPuc($cuentaPuc);
	}
	
	public function modificarCuentaPuc(CuentaPucEntidad $cuentaPuc){
		return $this->cuentaPucDAO->modificarCuentaPuc($cuentaPuc);
	}
	
	public function listarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoDAO->listarMovimiento($movimiento);
	}
	
	public function comboMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoDAO->comboMovimiento($movimiento);
	}
	
	public function borrarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoDAO->borrarMovimiento($movimiento);
	}
	
	public function insertarMovimiento(MovimientoEntidad $movimiento){
		return $this->movimientoDAO->insertarMovimiento($movimiento);
	}
	
	public function insertarMovimientoCop(MovimientoEntidad $movimiento){
		return $this->movimientoDAO->insertarMovimientoCop($movimiento);
	}
	
	public function listarSaldos(SaldosEntidad $saldos){
		return $this->saldosDAO->listarSaldos($saldos);
	}
	
	public function borrarSaldos(SaldosEntidad $saldos){
		return $this->saldosDAO->borrarSaldos($saldos);
	}
	
	public function insertarSaldos(SaldosEntidad $saldos){
		return $this->saldosDAO->insertarSaldos($saldos);
	}
	
	public function insertarSaldosCop(SaldosEntidad $saldos){
		return $this->saldosDAO->insertarSaldosCop($saldos);
	}
}
?>