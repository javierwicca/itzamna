<?php

namespace Negocio;

class FuncionesNegocio {
	
	function __construct() {
	}
	
	/**
 * REEMPLAZA NOTACIÓN EN HTML POR CARACTERES ESPECIALES.
 * @param Texto a Reemplazar
 * @return Texto reemplazado
 * @author Ing. Juan Carlos Medina Hernández.
 */
	public function reempHtmlCaracEsp($texto) {
		return str_replace(array('&Ntilde;','&ntilde;','&Aacute;','&aacute;','&Eacute;','&eacute;','&Iacute;','&iacute;','&Oacute;','&oacute;',
		'&Uacute;','&uacute;','&ordm;','&lt;','&gt;','&ordf;','&copy;','&reg;'),array('Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>',
		'ª','©','®'),$texto);
	}
	/**
	 * REEMPLAZA CARACTERES ESPECIALES POR SU RESPECTIVA NOTACIÓN EN HTML.
	 * @param Texto a Reemplazar
	 * @return Texto reemplazado
	 * @author Ing. Juan Carlos Medina Hernández.
	 */
	public function reempCaracEspHtml($texto) {
		return str_replace(array('Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>','ª','©','®',"\n","\r","\n\r","\r\n"),
				array('&Ntilde;','&ntilde;','&Aacute;','&aacute;','&Eacute;','&eacute;','&Iacute;','&iacute;','&Oacute;','&oacute;','&Uacute;','&uacute;',
						'&ordm;','&lt;','&gt;','&ordf;','&copy;','&reg;','<br>','<br>','<br>','<br>'), $texto);
	}
	/**
	 * REEMPLAZA CARACTERES QUE PUEDAN AFECTAR EL BUEN FUNCIONAMIENTO DEL DOJO.
	 * @param Texto a Reemplazar
	 * @return Texto reemplazado
	 * @author Ing. Juan Carlos Medina Hernández.
	 */
	function reempCaracEspDojo($texto) {
		$texto=trim($texto);
		$texto=str_replace(array("'","\n","\r","\n\r"), array("\'","@@br||","@@br||","@@br||"),$texto);
		return $texto;
	}
	/**
	 * REEMPLAZA NOTACIÓN EN JS POR CARACTERES ESPECIALES.
	 * @param Texto a Reemplazar
	 * @return Texto reemplazado
	 * @author Ing. Juan Carlos Medina Hernández.
	 */
	function reempJsCaracEsp($texto) {
		return str_replace(array('#Ntilde;','#ntilde;','#Aacute;','#aacute;','#Eacute;','#eacute;','#Iacute;','#iacute;','#Oacute;','#oacute;',
				'#Uacute;','#uacute;','#ordm;','#lt;','#gt;','#ordf;','#copy;','#reg;'),array('Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>',
						'ª','©','®'),$texto);
	}
	/**
	 * CONVIERTE FORMATO DE FECHA Y HORA YYYY-MM-DD HH:MM:SS A DD/MM/YYYY HH:MM:SS AM/PM
	 * @param Fecha y hora en Formato YYYY-MM-DD HH:MM:SS
	 * @return Fecha y hora en Formato DD/MM/YYYY HH:MM:SS AM/PM
	 * @author Ing. Juan Carlos Medina Hernández
	 */
	function formatAmPm($fecha) {
		$fecha_hora=explode(' ',$fecha);
		$fc=explode('-',$fecha_hora[0]);
		$hora=explode(':',$fecha_hora[1]);
	
		$fc_hora="$fc[2]/$fc[1]/$fc[0] ";
	
		if ($hora[0]<12) {
			$ampm='AM';
		} else {
			$ampm='PM';
		}
		if ($hora[0]>=13) $hora[0]-=12;
	
		if (strlen($hora[0])==1) $hora[0]="0$hora[0]";
	
		$fc_hora.="$hora[0]:$hora[1]:$hora[2] $ampm";
	
		return $fc_hora;
	}
	/**
	 * CONVIERTE HORA HH:MM:SS A HH:MM:SS AM/PM
	 * @param Hora en Formato HH:MM:SS
	 * @return Hora en Formato HH:MM:SS AM/PM
	 * @author Ing. Juan Carlos Medina Hernández
	 */
	function formatHrAmPm($hora) {
		$hora=explode(':',$hora);
	
		if ($hora[0]<12) {
			$ampm='AM';
		} else {
			$ampm='PM';
		}
		if ($hora[0]>=13) $hora[0]-=12;
	
		if (strlen($hora[0])==1) $hora[0]="0$hora[0]";
	
		switch (count($hora)) {
			case 1:
				$hr="$hora[0] $ampm";
				break;
					
			case 2:
				$hr="$hora[0]:$hora[1] $ampm";
				break;
					
			case 3:
				$hr="$hora[0]:$hora[1]:$hora[2] $ampm";
				break;
					
		}
	
		return $hr;
	}
	
	/**
	 * CAMBIAR DE FORMATO LAS FECHAS 'DD/MM/AAAA' A 'AAAA-MM-DD'
	 * @param Fecha con Formato 'DD/MM/AAAA' date.
	 * @return Fecha con Formato 'AAAA-MM-DD'.
	 * @author Ing. Juan Carlos Medina Hernández.
	 * */
	function formatFc($fecha) {
		if ($fecha!='') {
			$fc_hora=explode(' ',$fecha);
			$fecha=$fc_hora[0];
			$a_fecha=explode('/',$fecha);
			if (count($fc_hora)==1) {
				return $a_fecha[2].'-'.$a_fecha[1].'-'.$a_fecha[0];
			} else {
				return $a_fecha[2].'-'.$a_fecha[1].'-'.$a_fecha[0].' '.$fc_hora[1];
			}
		} else {
			return '';
		}
	}
	/**
	 * CAMBIAR DE FORMATO LAS FECHAS 'AAAA-MM-DD' A 'DD/MM/AAAA'
	 * @param Fecha con Formato 'AAAA-MM-DD' date.
	 * @return Fecha con Formato 'DD/MM/AAAA'.
	 * @author Ing. Juan Carlos Medina Hernández.
	 * */
	function formatCf($fecha) {
		if ($fecha!='') {
			$fc_hora=explode(' ',$fecha);
			$fecha=$fc_hora[0];
			$a_fecha=explode('-',$fecha);
			if (count($fc_hora)==1) {
				return $a_fecha[2].'/'.$a_fecha[1].'/'.$a_fecha[0];
			} else {
				return $a_fecha[2].'/'.$a_fecha[1].'/'.$a_fecha[0].' '.$fc_hora[1];
			}
		}
	}
	/**
	 * CONVERTIR ARREGLOS POSTGRESQL A ARREGLOS PHP
	 * @param Arreglo PostgreSQL array.
	 * @return Arreglo en PHP.
	 * @author Ing. Juan Carlos Medina Hernández.
	 * */
	function arSqlArPhp($a_sql) {
		$a_sql=str_replace(array('{"','"}','",',',"'),array('{','}',',',','), $a_sql);
		$a_sql=substr($a_sql,strpos($a_sql,'{')+1);
		$a_sql=str_replace('}','',$a_sql);
	
		if (strlen($a_sql)>0) {
			$a_php=explode(',',$a_sql);
		}
		for ($i=0;$i<count($a_php);$i++) {
			if (substr($a_php[$i],0,1)=='"') $a_php[$i]=substr($a_php[$i],1);
			if (substr($a_php[$i],strlen($a_php[$i])-1,1)=='"') $a_php[$i]=substr($a_php[$i],0,strlen($a_php[$i])-1);
		}
		return $a_php;
	}
	/**
	 * CONVERTIR ARREGLOS PHP A ARREGLOS POSTGRESQL
	 * @param Arreglo PHP array.
	 * @return Arreglo en PostgreSQL.
	 * @author Ing. Juan Carlos Medina Hernández.
	 * */
	function arPhpArSql($a_php) {
		if (count($a_php)>0) $a_sql="[0:".(count($a_php)-1)."]={".implode(',',$a_php)."}";
		return $a_sql;
	}
	/**
	 * CONVERTIR FECHAS ENVIADAS POR DOJO A FORMATO POSTGRESQL
	 * @param Fecha en formato dojo.
	 * @return Fecha en formato PostgreSQL.
	 * @author Ing. Juan Carlos Medina Hernández.
	 * */
	function fomatDjFc($fecha) {
		if (trim($fecha)!='') {
			$a_fecha=explode(' ', $fecha);
			if ($a_fecha[3]!='') {
				switch (strtolower($a_fecha[1])) {
					case 'jan':
						$a_fecha[1]='01';
						break;
					case 'feb':
						$a_fecha[1]='02';
						break;
					case 'mar':
						$a_fecha[1]='03';
						break;
					case 'apr':
						$a_fecha[1]='04';
						break;
					case 'may':
						$a_fecha[1]='05';
						break;
					case 'jun':
						$a_fecha[1]='06';
						break;
					case 'jul':
						$a_fecha[1]='07';
						break;
					case 'aug':
						$a_fecha[1]='08';
						break;
					case 'sep':
						$a_fecha[1]='09';
						break;
					case 'oct':
						$a_fecha[1]='10';
						break;
					case 'nov':
						$a_fecha[1]='11';
						break;
					case 'dic':
						$a_fecha[1]='12';
						break;
						
				}
				return "$a_fecha[3]-$a_fecha[1]-$a_fecha[2]";
			}
		}
	}
}

?>