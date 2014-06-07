<?php
namespace DAO;
require_once '../DAO/General/ConexionBD.php';
require_once '../Entidades/General/CorreoEntidad.php';

use DAO\ConexionBD;
use Entidades\CorreoEntidad;

class CorreoDAO{
	private $conexion;
	
	function __construct(){
		if (!isset($this->conexion)) {
			$this->conexion=new ConexionBD();
			$this->conexion->abrirConexion();
		}
	}
	
	public function enviarCorreo(CorreoEntidad $correo) {
		$consulta="select mc.mac_cuenta,mc.mac_calidad from iau_mail_cuentas mc where mc.mac_plantilla=".$correo->getPlantilla();
		
		$resultado=$this->conexion->consulta($consulta);
		
		while($fila=pg_fetch_assoc($resultado)){
			if($fila[mac_calidad]!='to'){
				$encabezados.="$fila[mac_calidad]: $fila[mac_cuenta]\n";
			}else{
				if($to=='') $to.=$fila[mac_cuenta];
				else $to.=",$fila[mac_cuenta]";
			}
		}
		
		if ($to=='') {
			if (is_array($correo->getTo())) $to=implode(',', $correo->getTo());
		} else {
			if (is_array($correo->getTo())) $to.=",".implode(',', $correo->getTo());
		}
		
		if (is_array($correo->getCc())) $encabezados.="cc: ".implode(',', $correo->getTo());
		
		$consulta="select mp.map_asunto,mp.map_contenido from iau_mail_plantilla mp where mp.map_plantilla=".$correo->getPlantilla();
		
		$resultado=$this->conexion->consulta($consulta);
		
		while($fila=pg_fetch_assoc($resultado)){
			$asunto=$fila[map_asunto];
			$contenido=$fila[map_contenido];
		}
		
		$encabezados.="X-Mailer: PHP/". phpversion()."\n";
		if ($correo->getSeparador()=='') {
			$encabezados.="Content-Type: text/html; charset=\"ISO-8859-1\"\n";
		} else {
			$encabezados.="Content-Type: multipart/mixed;\n";
			$encabezados.=" boundary=".$correo->getSeparador()."\n\n";
			$contenido.="--".$correo->getSeparador()."\n";
			$contenido.="Content-Type: text/html; charset=\"ISO-8859-1\"\n";
			$contenido.="Content-Transfer-Encoding: 7bit\n\n";
		}
		
		$datos_encabezado=$correo->getDatosEncabezado();
		for($i=0;$i<=count($datos_encabezado);$i++) $asunto=str_replace("#$i#",$datos_encabezado[$i],$asunto);
		
		$datos_cuerpo=$correo->getDatosCuerpo();
		for($i=0;$i<=count($datos_cuerpo);$i++) $contenido=str_replace("#$i#",$datos_cuerpo[$i],$contenido);
		
		if ($correo->getSeparador()!='') {
			$archivo=$correo->getArchivo();
			$tipo_archivo=$correo->getTipoArchivo();
			$nombre_archivo=$correo->getNombreArchivo();
			for($i=0;$i<=count($archivo);$i++) {
				$contenido.="\n--".$correo->getSeparador()."\n";
				$contenido.="Content-Type: ".$tipo_archivo[$i]."; name=\"$nombre_archivo[$i]\"\n";
				$contenido.="Content-Disposition: inline; filename=\"$nombre_archivo[$i]\"\n";
				$contenido.="Content-Transfer-Encoding: base64\n\n";
				$contenido.=$archivo[$i];
			}
		}
		
		if (!empty($to)) mail($to,$asunto,$contenido,$encabezados);
	}
}

?>