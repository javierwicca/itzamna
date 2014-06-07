<?php
namespace DAO;

require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/Configuracion/ClientesEntidad.php';

use DAO\ConexionBD;
use Entidades\ClientesEntidad;

class ClientesDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function listarClientes(ClientesEntidad $clientes) {
		$clientesRespuesta=null;
		$consulta="select c.cli_identificacion,c.cli_tipo_sociedad,c.cli_autorretenedor,c.cli_gc,c.cli_sucursal,c.cli_dir_sucursal,c.cli_representante,c.cli_tipo_regimen,c.".
		"cli_estado,d.dir_direccion[0] as dir_residencia,d.dir_direccion[1] as dir_correspondencia,d.dir_direccion[2] as dir_contacto,d.dir_telefono[0] as celular,d.".
		"dir_telefono[1] as tel_fijo,d.dir_telefono[2] as fax,trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else d.dir_apellidos end) as nombres,case d.".
		"dir_tipo_persona when 'N' then 'NATURAL' when 'J' then 'JURÍDICA' end as ds_tipo_persona,(select p.par_detalle from iau_parametros p where p.par_parametro='TDIDE' ".
		"and p.par_elemento=d.dir_tipo_documento) as ds_tipo_documento,c.cli_retenedor_iva,d.dir_tipo_persona,d.dir_ciudad_direccion[0] as ciu_residencia,c.".
		"cli_retefuente_todos from iau_clientes c,iau_directorio d where d.dir_identificacion=c.cli_identificacion ".$clientes->getWhere();
		
		if ($clientes->getOrder()!='') $consulta.=" order by ".$clientes->getOrder();
		
		$resultado=$this->conexion->consulta($consulta);
		
		$clientesRespuesta=new ClientesEntidad();
		$clientesRespuesta->setResultado($resultado);
		
		if (!is_string($resultado)) {
			if ($this->conexion->totalResultados($resultado)>0) {
				$resultados = $this->conexion->resultados($resultado);
				$i=0;
				foreach ($resultados as $aClientes){
					$clientesRespuesta->setIdx($i);
					$clientesRespuesta->setIdentificacion($aClientes[cli_identificacion]);
					$clientesRespuesta->setTipoSociedad($aClientes[cli_tipo_sociedad]);
					$clientesRespuesta->setAutorretenedor($aClientes[cli_autorretenedor]);
					$clientesRespuesta->setGc($aClientes[cli_gc]);
					$clientesRespuesta->setSucursal($aClientes[cli_sucursal]);
					$clientesRespuesta->setDirSucursal($aClientes[cli_dir_sucursal]);
					$clientesRespuesta->setRepresentante($aClientes[cli_representante]);
					$clientesRespuesta->setTipoRegimen($aClientes[cli_tipo_regimen]);
					$clientesRespuesta->setRetenedorIva($aClientes[cli_retenedor_iva]);
					$clientesRespuesta->setRetefuenteTodos($aClientes[cli_retefuente_todos]);
					$clientesRespuesta->setEstado($aClientes[cli_estado]);
					$i++;
				}
			}
		}
		return $clientesRespuesta;
	}
	
	public function adicionarClientes(ClientesEntidad $clientes) {
		$clientesRespuesta=null;
		
		$identificacion=$clientes->getIdentificacion();
		$tipo_sociedad=$clientes->getTipoSociedad();
		$autorretenedor=$clientes->getAutorretenedor();
		$gc=$clientes->getGc();
		$sucursal=$clientes->getSucursal();
		$dir_sucursal=$clientes->getDirSucursal();
		$representante=$clientes->getRepresentante();
		$tipo_regimen=$clientes->getTipoRegimen();
		$retenedor_iva=$clientes->getRetenedorIva();
		$retefuente_todos=$clientes->getRetefuenteTodos();
		$estado=$clientes->getEstado();
		
		$consulta="insert into iau_clientes (cli_identificacion,cli_tipo_sociedad,cli_autorretenedor,cli_gc,cli_sucursal,cli_dir_sucursal,cli_representante,cli_tipo_regimen,".
		"cli_retenedor_iva,cli_retefuente_todos,cli_estado) values ($identificacion[0],";
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
		if ($retefuente_todos[0]!='') $consulta.="'$retefuente_todos[0]',";
		else $consulta.="null,";
		$consulta.="'$estado[0]')";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$clientesRespuesta=new ClientesEntidad();
		$clientesRespuesta=$clientes;
		$clientesRespuesta->setResultado($resultado);
		
		return $clientesRespuesta;
	}
	
	public function modificarClientes(ClientesEntidad $clientes) {
		$clientesRespuesta=null;
		
		$identificacion=$clientes->getIdentificacion();
		$tipo_sociedad=$clientes->getTipoSociedad();
		$autorretenedor=$clientes->getAutorretenedor();
		$gc=$clientes->getGc();
		$sucursal=$clientes->getSucursal();
		$dir_sucursal=$clientes->getDirSucursal();
		$representante=$clientes->getRepresentante();
		$tipo_regimen=$clientes->getTipoRegimen();
		$estado=$clientes->getEstado();
		$retenedor_iva=$clientes->getRetenedorIva();
		$retefuente_todos=$clientes->getRetefuenteTodos();
		
		$consulta="update iau_clientes set ";
		if ($tipo_sociedad[0]!='') $consulta.="cli_tipo_sociedad='$tipo_sociedad[0]',";
		else $consulta.="cli_tipo_sociedad=null,";
		if ($autorretenedor[0]!='') $consulta.="cli_autorretenedor='$autorretenedor[0]',";
		else $consulta.="cli_autorretenedor=null,";
		if ($gc[0]!='') $consulta.="cli_gc='$gc[0]',";
		else $consulta.="cli_gc=null,";
		if ($sucursal[0]!='') $consulta.="cli_sucursal='$sucursal[0]',";
		else $consulta.="cli_sucursal=null,";
		if ($dir_sucursal[0]!='') $consulta.="cli_dir_sucursal='$dir_sucursal[0]',";
		else $consulta.="cli_dir_sucursal=null,";
		if ($representante[0]!='') $consulta.="cli_representante='$representante[0]',";
		else $consulta.="cli_representante=null,";
		if ($tipo_regimen[0]!='') $consulta.="cli_tipo_regimen='$tipo_regimen[0]',";
		else $consulta.="cli_tipo_regimen=null,";
		if ($retenedor_iva[0]!='') $consulta.="cli_retenedor_iva='$retenedor_iva[0]',";
		else $consulta.="cli_retenedor_iva=null,";
		if ($retefuente_todos[0]!='') $consulta.="cli_retefuente_todos='$retefuente_todos[0]',";
		else $consulta.="cli_retefuente_todos=null,";
		$consulta.="cli_estado='$estado[0]' where cli_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$clientesRespuesta=new ClientesEntidad();
		$clientesRespuesta=$clientes;
		$clientesRespuesta->setResultado($resultado);
		
		return $clientesRespuesta;
	}
	
	public function inactivarClientes(ClientesEntidad $clientes) {
		$clientesRespuesta=null;
		
		$identificacion=$clientes->getIdentificacion();
		$estado=$clientes->getEstado();
		
		$consulta="update iau_clientes set cli_estado='$estado[0]' where cli_identificacion=$identificacion[0]";
		
		$resultado=$this->conexion->consulta($consulta);
		
		$clientesRespuesta=new ClientesEntidad();
		$clientesRespuesta=$clientes;
		$clientesRespuesta->setResultado($resultado);
		
		return $clientesRespuesta;
	}
	
}

?>