<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/UsuarioEntidad.php';

use DAO\ConexionBD;
use Entidades\UsuarioEntidad;

class UsuarioDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function buscarUsuario(UsuarioEntidad $usuario) {
		$usuarioRespuesta=null;
		$consulta="select u.usu_identificacion,u.usu_correo,u.usu_estado,u.usu_tipo_usuario,u.usu_clave,u.usu_requiere_cambio,d.dir_nombres||' '||d.dir_apellidos as nombres,".
		"case u.usu_tipo_usuario when 'A' then 'ADMINISTRADOR' when 'S' then 'SUPER USUARIO' when 'U' then 'USUARIO' end as ds_tipo_usr from iau_usuarios u,iau_directorio d ".
		"where d.dir_identificacion=u.usu_identificacion ".
		$usuario->getWhere();
		
		if ($usuario->getOrder()!='') $consulta.=" order by ".$usuario->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		$usuarioRespuesta=new UsuarioEntidad();
		$usuarioRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aUsuario){
					$usuarioRespuesta->setIdx($i);
					$usuarioRespuesta->setIdentificacion($aUsuario[usu_identificacion]);
					$usuarioRespuesta->setCorreo($aUsuario[usu_correo]);
					$usuarioRespuesta->setEstado($aUsuario[usu_estado]);
					$usuarioRespuesta->setTipoUsuario($aUsuario[usu_tipo_usuario]);
					$usuarioRespuesta->setClave($aUsuario[usu_clave]);
					$usuarioRespuesta->setRequiereCambio($aUsuario[usu_requiere_cambio]);
					$i++;
				}
			}
		}
		return $usuarioRespuesta;
	}
	public function adicionarUsuario(UsuarioEntidad $usuario) {
		$usuarioRespuesta=null;
	
		$identificacion=$usuario->getIdentificacion();
		$correo=$usuario->getCorreo();
		$estado=$usuario->getEstado();
		$tipo_usuario=$usuario->getTipoUsuario();
		$clave=$usuario->getClave();
		$requiere_cambio=$usuario->getRequiereCambio();
	
		$consulta="insert into iau_usuarios (usu_identificacion,usu_correo,usu_estado,usu_tipo_usuario,usu_clave,usu_requiere_cambio) values ($identificacion,";
		if ($correo!='') $consulta.="'$correo',";
		else $consulta.="null,";
		if ($estado!='') $consulta.="'$estado',";
		else $consulta.="null,";
		if ($tipo_usuario!='') $consulta.="'$tipo_usuario',";
		else $consulta.="null,";
		if ($clave!='') $consulta.="'$clave',";
		else $consulta.="null,";
		if ($requiere_cambio!='') $consulta.="'$requiere_cambio'";
		else $consulta.="null";
		$consulta.=")";
	
		$resultado=$this->conexion->consulta($consulta);
	
		$usuarioRespuesta=new UsuarioEntidad();
		$usuarioRespuesta=$usuario;
		$usuarioRespuesta->setResultado($resultado);
	
		return $usuarioRespuesta;
	}
	
	public function modificarUsuario(UsuarioEntidad $usuario) {
		$usuarioRespuesta=null;
	
		$identificacion=$usuario->getIdentificacion();
		$correo=$usuario->getCorreo();
		$estado=$usuario->getEstado();
		$tipo_usuario=$usuario->getTipoUsuario();
		$clave=$usuario->getClave();
		$requiere_cambio=$usuario->getRequiereCambio();
	
		$consulta="update iau_usuarios set ";
		if ($correo!='') $consulta.="usu_correo='$correo',";
		else $consulta.="usu_correo=null,";
		if ($estado!='') $consulta.="usu_estado='$estado',";
		else $consulta.="usu_estado=null,";
		if ($tipo_usuario!='') $consulta.="usu_tipo_usuario='$tipo_usuario'";
		else $consulta.="usu_tipo_usuario=null";
		$consulta.=" where usu_identificacion=$identificacion";
	
		$resultado=$this->conexion->consulta($consulta);
	
		$usuarioRespuesta=new UsuarioEntidad();
		$usuarioRespuesta=$usuario;
		$usuarioRespuesta->setResultado($resultado);
	
		return $usuarioRespuesta;
	}
	
	public function inactivarUsuario(UsuarioEntidad $usuario) {
		$usuarioRespuesta=null;
	
		$identificacion=$usuario->getIdentificacion();
		$correo=$usuario->getCorreo();
		$estado=$usuario->getEstado();
		$tipo_usuario=$usuario->getTipoUsuario();
		$clave=$usuario->getClave();
		$requiere_cambio=$usuario->getRequiereCambio();
	
		$consulta="update iau_usuarios set ";
		if ($estado[0]!='') $consulta.="usu_estado='$estado'";
		else $consulta.="usu_estado=null";
		$consulta.=" where usu_identificacion=$identificacion";
		
		$resultado=$this->conexion->consulta($consulta);
	
		$usuarioRespuesta=new UsuarioEntidad();
		$usuarioRespuesta=$usuario;
		$usuarioRespuesta->setResultado($resultado);
	
		return $usuarioRespuesta;
	}
	
	public function cambioClave(UsuarioEntidad $usuario) {
		$usuarioRespuesta=null;
	
		$identificacion=$usuario->getIdentificacion();
		$correo=$usuario->getCorreo();
		$estado=$usuario->getEstado();
		$tipo_usuario=$usuario->getTipoUsuario();
		$clave=$usuario->getClave();
		$requiere_cambio=$usuario->getRequiereCambio();
	
		$consulta="update iau_usuarios set ";
		if ($requiere_cambio[0]!='') $consulta.="usu_requiere_cambio='$requiere_cambio',";
		else $consulta.="usu_requiere_cambio=null,";
		if ($clave!='') $consulta.="usu_clave='$clave'";
		else $consulta.="usu_clave=null";
		$consulta.=" where usu_identificacion=$identificacion";
		
		$resultado=$this->conexion->consulta($consulta);
	
		$usuarioRespuesta=new UsuarioEntidad();
		$usuarioRespuesta=$usuario;
		$usuarioRespuesta->setResultado($resultado);
	
		return $usuarioRespuesta;
	}
}

?>