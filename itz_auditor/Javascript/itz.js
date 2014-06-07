function object() {
	var peticion = false;
	var testPasado = false;
	try {
		peticion = new XMLHttpRequest();
	} catch (trymicrosoft) {
		try {
			peticion = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (othermicrosoft) {
				try {
					peticion = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (failed) {
					peticion = false;
				}
		}
	}
	if (!peticion) alert("ERROR AL INICIALIZAR!");
	return peticion;
}
function foco(elemento) {
	elemento.focus();
	
	if (elemento.type == 'text'||elemento.type == 'password') {
		//elemento.select();
	}
	
}
/**VALIDA QUE LE DIGITEN VALOR, SI fl_cero ES TRUE TAMBIÉN VALIDA QUE NO LE DIGITEN CERO**/
function valida(campo,mensaje,fl_cero) {
	
	if (trim(campo.value)==='') {
		foco(campo);
		mensaje_dj('ERROR',mensaje,'OK','ERROR','',campo);
		return false;
	}
	
	if (fl_cero) {
		if (campo.value=='0') {
			foco(campo);
			mensaje_dj('ERROR',mensaje,'OK','ERROR','',campo);
			return false;
		}
	}
	
	return true;
}

/** FUNCION PARA VALIDAR LOS CAMPOS MAIL O CORREO **/
function validaCorreo(campo) {
	var cad=campo.value;
	if (cad!='') {
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(cad)){
			return true;
		} else {
			mensaje_dj('ERROR','El Correo El&eacute;ctronico Digitado no es Valido.','OK','ERROR','',campo);
			return false;
		}
	}
	return true;
}//cierra funcion

/***FUNCIÓN PARA MOSTRAR MENSAJES CON DOJO*/
function mensaje_dj(titulo,mensaje,boton,icono,pagina,formulario,pag_cancela,menu_cancela) {
	
	var fl=true;
	dojo.require("dijit.Dialog");
	dojo.require("dijit.form.Button");
	if (dijit.byId('mensaje_dj')) dijit.byId('mensaje_dj').destroy();
	if (dijit.byId('cb_mensaje_dj')) dijit.byId('cb_mensaje_dj').destroy();
	if (dijit.byId('cb_cancela_dj')) dijit.byId('cb_cancela_dj').destroy();
	
	var dialog = new dijit.Dialog({id:"mensaje_dj", title:titulo, style:"width: 300px;"});
	content='<table width="100%"><tr><td valign="center"><img src="../../imagenes/i_'+icono.toLowerCase();
	content+='.png"></td><td valign="center" style="text-align: center;">'+mensaje+'</td></tr><tr><td colspan="2" style="text-align: center;">';
	if (boton=='OK') {
		if (pagina!=''&&pagina!='-5'&&pagina!='consultar') {
			content+='<button name="cb_mensaje_dj" id="cb_mensaje_dj" type="button" dojoType="dijit.form.Button" style="color: black;" ';
			content+='onclick="cargarSesion (\''+pagina+'\',true,\'../../\',parent.document.getElementById(window.name).parentNode);">ACEPTAR</button>';
		} else {
			content+='<button name="cb_mensaje_dj" id="cb_mensaje_dj" type="submit" dojoType="dijit.form.Button" style="color: black;" ';
			content+='onclick="dijit.byId(\'mensaje_dj\').hide();">ACEPTAR</button>';
			/*dojo.connect(dijit.byId('mensaje_dj'), "hide", function() {
				foco(formulario);
				if (pagina=='consultar') consultar();
			});*/
		}
	} else if (boton=='OKCANCEL') {
		
		content+='<button name="cb_mensaje_dj" id="cb_mensaje_dj" type="button" dojoType="dijit.form.Button" style="color: black;" ';
		content+='onclick="document.'+formulario.name+'.submit();">SI</button>';
		content+='<button name="cb_cancela_dj" id="cb_cancela_dj" type="button" dojoType="dijit.form.Button" style="color: black;" onclick="';
		if (pag_cancela!='') {
			content+='document.'+formulario.name+'.pagina.value=base64_encode(\''+pag_cancela+'\');document.'+formulario.name+'.menu.value=';
			content+='base64_encode(\''+menu_cancela+'\');document.'+formulario.name+'.permiso.value=base64_encode(\'consulta\');document.';
			content+=formulario.name+'.submit();';
		}
		content+='dijit.byId(\'mensaje_dj\').hide();">NO</button>';
		
	}
	content+='</td></tr></table>';
	dialog.setContent(content);
	dialog.startup();
	dialog.show();
	return dialog;
}
function cargarFrame(pagina,frame){
	frame.src=pagina;
}
function cargarSesion (pagina,frame,dir,elemento) {
	
	var peticion=false,envio='',datos= new Array();
	peticion=object();
	fragment_url=dir+'Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
			if (peticion.readyState == 4) {
				if (pagina=='') document.getElementById('fechaInicio').value=peticion.responseText;
				else parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value=peticion.responseText;
				//if (dir=='') location='Presentacion/';
				if (frame) crearFrame(dir,elemento);
			}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('cargarSesion')+'&dir='+base64_encode(dir)+'&pagina='+base64_encode(pagina);
	if (pagina=='') envio+='&fechaInicio='+document.getElementById('fechaInicio').value;
	else envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}
function cerrarSesion (pagina,frame,dir,elemento) {
	var peticion=false,envio='',datos= new Array();
	peticion=object();
	fragment_url=dir+'Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
			if (peticion.readyState == 4) {
				mensaje_dj('ERROR','El Correo El&eacute;ctronico Digitado no es Valido.','OK','ERROR','',campo);
			}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('cerrarSesion');
	peticion.send(envio);
}
function crearFrame (dir,elemento) {
	var peticion=false,envio='',datos= new Array();
	peticion=object();
	fragment_url=dir+'Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			elemento.innerHTML=peticion.responseText;
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('crearFrame');
	if (dir=='../') envio+='&fechaInicio='+document.getElementById('fechaInicio').value;
	else envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function registraAcceso (modulo,acceso) {
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('registraAcceso')+'&modulo='+base64_encode(modulo)+'&acceso='+base64_encode(acceso);
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}
function ver_menu() {
	if (document.getElementById('menu_izq').getAttribute("class")=="oculto") {
		document.getElementById('menu_izq').setAttribute("class","visible");
	} else {
		document.getElementById('menu_izq').setAttribute("class","oculto");
	}
	Effect.toggle('menu_der','appear');
	return false;
}
function cargarMenu (modulo,acceso) {
	var peticion=false,envio='',datos= new Array();
	peticion=object();
	fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			document.getElementById('td_menu').innerHTML=peticion.responseText;
			piePagina (modulo,acceso);
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('menu')+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}
/**
 * CREAR BOTONES EN LA PAGINA DE ACUERDO A PERMISOS
 * @param Modulo para verificar permisos.
 * @param Nombre de la pagina.
 * @param Arreglo de campos para enfocar al momento de abrir las ventanas: [0]: Adicionar, [1]: Modificar, [2]: Inactivar, [3]: Información, [4]: Exportar.
 * @param Arreglo con flag para indicar si se debe o no mostrar el boton; 1: Si, 0: No; Botones: [0]: Adicionar, [1]: Modificar, [2]: Inactivar, [3]: Información, 
 * [4]: Exportar.
 * @param Valor adicional al titulo de la ventana.
 * @param Parametros de envio de información para actaulizar datos.
 * @param Arreglo con codigo de modulos adicionales.
 * @param Arreglo con botones adicionales.
 * @param Arreglo con id para generar tooltip.
 * @param Arreglo con mensaje para generar tooltip.
 * @param Tipo de acceso para registrar.
 * @return Html con los botones.
 * @author Ing. Juan Carlos Medina Hernández
 */
function cargarPermisos (modulo,nombre,campoEnfoque,botones,titulo,envio_p,modulosAd,botonesAd,idTooltip,labelTooltip,acceso) {
	var peticion=false,envio='',datos= new Array();
	peticion=object();
	fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			document.getElementById('botones').innerHTML=peticion.responseText;
			
			if (document.getElementById('b_adi')) {
				new dijit.Tooltip({connectId:'b_adi',id:'b_adic_tooltip',position:"above, below",label:"Adicionar "+nombre.toLowerCase()});
			}
			
			if (document.getElementById('b_mod')) {
				new dijit.Tooltip({connectId:'b_mod',id:'b_mod_tooltip',position:"above, below",label:"Modificar "+nombre.toLowerCase()});
			}
			
			if (document.getElementById('b_ina')) {
				new dijit.Tooltip({connectId:'b_ina',id:'b_ina_tooltip',position:"above, below",label:"Inactivar "+nombre.toLowerCase()});
			}
			
			if (document.getElementById('b_inf')) {
				new dijit.Tooltip({connectId:'b_inf',id:'b_inf_tooltip',position:"above, below",label:"Informaci&oacute;n "+nombre.toLowerCase()});
			}
			
			if (document.getElementById('b_exp')) {
				new dijit.Tooltip({connectId:'b_exp',id:'b_exp_tooltip',position:"above, below",label:"Exportar Listado"});
			}
			
			for (i=0;i<idTooltip.length;i++) {
				if (document.getElementById(idTooltip[i])) {
					new dijit.Tooltip({connectId:idTooltip,id:idTooltip[i]+'_tooltip',position:"above, below",label:labelTooltip[i]});
				}
			}
			cargarMenu(modulo,acceso);
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('cargarPermisos')+'&modulo='+base64_encode(modulo)+'&nombre='+base64_encode(nombre);
	
	for (i=0;i<campoEnfoque.length;i++) envio+='&campoEnfoque[]='+base64_encode(campoEnfoque[i]);
	for (i=0;i<botones.length;i++) envio+='&botones[]='+base64_encode(botones[i]);
	for (i=0;i<titulo.length;i++) envio+='&titulo[]='+base64_encode(titulo[i]);
	
	envio+='&envio_p='+base64_encode(envio_p);
	
	for (i=0;i<modulosAd.length;i++) envio+='&modulosAd[]='+base64_encode(modulosAd[i]);
	for (i=0;i<botonesAd.length;i++) envio+='&botonesAd[]='+base64_encode(reemp_carac_esp_js(botonesAd[i]));
	
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function piePagina (modulo,acceso) {
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			document.getElementById('td_pie_pagina').innerHTML=peticion.responseText;
			registraAcceso (modulo,acceso);
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='action='+base64_encode('piePagina')+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}
function formatNumber(campo, sep, prefix){
	
	prefix = prefix || '';
	num = unformatNumber(campo.value);
	num += '';
	var splitStr = num.split('x');
	var splitLeft = splitStr[0];
	var splitRight = splitStr.length > 1 ? 'x' + splitStr[1] : '';
	var regx = /(\d+)(\d{3})/;
	
	if (campo.value != ''&&campo.value != '-') {
  	while (regx.test(splitLeft)) {
  		splitLeft = splitLeft.replace(regx, '$1' + sep + '$2');
  	}
  	
  	campo.value = prefix + splitLeft + splitRight;
  }
}

function unformatNumber(num) {
	return num.replace(/([^0-9\-\.])/g,'')*1;
}
/**
 * CREAR UN SALTO DE LINEA EN HTML 
 * @param String a cambiar.
 * @return String con salto de linea html
 */
function salto_linea_html(valor) {
	if (valor!=''&&valor!=null) return str_replace(array('@@','||'),array('<','>'),valor);
	else return '';
}
function retorna_num(valor) {
	var numero= new Array();
	
	numero=valor.split('');
	var fl_num=false;
	var vl_num='';
	
	for (i=0;i<numero.length;i++) {
		if ((numero[i]=='-'||parseFloat(numero[i])>=1)&&!fl_num) fl_num=true;
		if (fl_num) vl_num+=numero[i];
	}
	if (vl_num=='') vl_num='0';
	
	return vl_num;
}
/**
 * REEMPLAZA CARACTERES QUE PUEDAN AFECTAR EL BUEN FUNCIONAMIENTO DEL DOJO.
 * @param Texto a Reemplazar
 * @return Texto reemplazado
 * @author Ing. Juan Carlos Medina Hernández.
 */
function reempCaracEspDojo(texto) {
	texto=trim(texto);
	texto=str_replace(array("'","\n","\r","\n\r"), array("\'","@@br||","@@br||","@@br||"),texto);
	return texto;
}
function reemp_carac_esp_js(texto) {
	return str_replace(['Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>','ª','©','®'], 
	['#Ntilde;','#ntilde;','#Aacute;','#aacute;','#Eacute;','#eacute;','#Iacute;','#iacute;','#Oacute;','#oacute;','#Uacute;','#uacute;',
	'#ordm;','#lt;','#gt;','#ordf;','#copy;','#reg;'],texto);
}
/**
 * 
 * REEMPLAZA CARACTERES ESPECIALES POR SU RESPECTIVA NOTACIÓN EN HTML.
 * @param Texto a Reemplazar
 * @return Texto reemplazado
 * @author Ing. Juan Carlos Medina Hernández.
 */
function reemp_carac_esp_html(texto) {
	return str_replace(['Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>','ª','©','®'], 
	['&Ntilde;','&ntilde;','&Aacute;','&aacute;','&Eacute;','&eacute;','&Iacute;','&iacute;','&Oacute;','&oacute;','&Uacute;','&uacute;',
	'&ordm;','&lt;','&gt;','&ordf;','&copy;','&reg;'], texto);
}
/**
 * 
 * REEMPLAZA NOTACIÓN EN HTML POR CARACTERES ESPECIALES.
 * @param Texto a Reemplazar
 * @return Texto reemplazado
 * @author Ing. Juan Carlos Medina Hernández.
 */
function reempHtmlCaracEsp(texto) {
	return str_replace(['&Ntilde;','&ntilde;','&Aacute;','&aacute;','&Eacute;','&eacute;','&Iacute;','&iacute;','&Oacute;','&oacute;',
	'&Uacute;','&uacute;','&ordm;','&lt;','&gt;','&ordf;','&copy;','&reg;'],['Ñ','ñ','Á','á','É','é','Í','í','Ó','ó','Ú','ú','º','<','>',
	'ª','©','®'],texto);
}
function abrirVentana(ventana,accion,titulo,envio,modulo,campo_foco) {
	var peticion=false;
	peticion=object();
	fragment_url='../../Controlador/Ventanas.php';
	
	if (dijit.byId('ventana')) dijit.byId('ventana').destroy();
	if (dijit.byId('indeterminateBar1')) dijit.byId('indeterminateBar1').destroy();
	
	var dialog=new dijit.Dialog({id:"ventana",title:titulo, style:"width: auto;"});
	dialog.setContent('Procesando informaci&oacute;n, por favor espere.<div style="width:400px" indeterminate="true" id="indeterminateBar1" dojoType="'+
			'dijit.ProgressBar"></div>');
	dialog.startup();
	dialog.show();
	
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			i=0;
			while (dijit.byId('i_dojo_'+i)) {
				dijit.byId('i_dojo_'+i).destroy();
				i++;
			}
			if (dijit.byId('indeterminateBar1')) dijit.byId('indeterminateBar1').destroy();
			dialog.setContent(peticion.responseText);
			dialog.startup();
			dialog.show();
			if (dijit.byId(campo_foco)) foco(dijit.byId(campo_foco));
			if (modulo!='') registraAcceso(modulo, accion);
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	envio='ventana='+base64_encode(ventana)+'&accion='+base64_encode(accion)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value+envio;
	peticion.send(envio);
}

function cargarCiudad(objeto,tipo,codigo) {
	objeto.url="../../Stores/comboLugares.php?tipo="+tipo+"&codigo="+codigo;
	objeto.close();
}

function cargarCombo(objeto,url) {
	objeto.url=url;
	objeto.close();
}

/******FUNCION PARA CAMBIAR DE FORMATO LAS FECHAS 'DD/MM/YYYY' A 'YYYY-MM-DD'*/
function formatFc(fecha) {
	
	if (fecha!='') {
		var fc_hora = new Array();
		fc_hora=fecha.split(' ');
		fecha=fc_hora[0];
		var a_fecha = new Array();
		a_fecha=fecha.split('/');
		if (fc_hora.length==1) {
			return a_fecha[2]+'-'+a_fecha[1]+'-'+a_fecha[0];
		} else {
			return a_fecha[2]+'-'+a_fecha[1]+'-'+a_fecha[0]+' '+fc_hora[1];
		}
	} else {
		return '';
	}
}

/******FUNCION PARA CAMBIAR DE FORMATO LAS FECHAS 'YYYY-MM-DD' A 'DD/MM/YYYY'*/
function formatCf(fecha) {
	
	if (fecha!='') {
		var fc_hora = new Array();
		fc_hora=fecha.split(' ');
		fecha=fc_hora[0];
		var a_fecha = new Array();
		a_fecha=fecha.split('-');
		if (fc_hora.length==1) {
			return a_fecha[2]+'/'+a_fecha[1]+'/'+a_fecha[0];
		} else {
			return a_fecha[2]+'/'+a_fecha[1]+'/'+a_fecha[0]+' '+fc_hora[1];
		}
	} else {
		return '';
	}
}
/**
 * CONVIERTE FORMATO DE FECHA Y HORA YYYY-MM-DD HH:MM:SS A DD/MM/YYYY HH:MM:SS AM/PM
 * @param Fecha y hora en Formato YYYY-MM-DD HH:MM:SS
 * @return Fecha y hora en Formato DD/MM/YYYY HH:MM:SS AM/PM
 * @author Ing. Juan Carlos Medina Hernández
 */
function formatAmPm(fecha) {
	var fecha_hora=new Array(),fc=new Array(),hora=new Array();
	var fc_hora='',ampm='',
	fecha_hora=fecha.split(' ');
	fc=fecha_hora[0].split('-');
	hora=fecha_hora[1].split(':');
	
	fc_hora=fc[2]+'/'+fc[1]+'/'+fc[0]+' ';
	
	if (parseFloat(hora[0])<12) {
		ampm='AM';
	} else {
		ampm='PM';
	}
	
	if (parseFloat(hora[0])>=13) hora[0]=(parseFloat(hora[0])-12).toString();
	
	if (hora[0].length==1) hora[0]='0'+hora[0];
	
	fc_hora+=hora[0]+':'+hora[1]+':'+hora[2]+' '+ampm;
	
	return fc_hora;
}
/*************FUNCION PARA DETERMINAR LA SEGURIDAD DE UNA CONTRASEÑA**********/
function seguridadClave(clave){
	var seguridad = 0;
	if (clave.length!=0){
		if (tieneNumeros(clave) && tieneLetras(clave)) seguridad += 30;
		
		if (tieneMinusculas(clave) && tieneMayusculas(clave)) seguridad += 30;
		
		if (clave.length >= 4 && clave.length <= 5){
			seguridad += 10;
		} else {
			if (clave.length >= 6 && clave.length <= 8){
				seguridad += 30;
			} else {
				if (clave.length > 8) seguridad += 40;
			}
		}
	}
	return seguridad
}
/*************FUNCION PARA DETERMINAR SI TEXTO TIENE NUMEROS**********/
function tieneNumeros(texto){
	var numeros="0123456789";
	for (i = 0; i < texto.length; i++) {
		if (numeros.indexOf(texto.charAt(i), 0) != -1) return true;
	}
	return false;
}

/*************FUNCION PARA DETERMINAR SI TEXTO TIENE LETRAS**********/
function tieneLetras(texto){
	var letras="abcdefghyjklmnñopqrstuvwxyz";
	texto = texto.toLowerCase();
	for(i=0; i< texto.length; i++){
		if (letras.indexOf(texto.charAt(i), 0) != -1) {
			return true;
		}
	}
	return false;
}

/*************FUNCION PARA DETERMINAR SI TEXTO TIENE LETRAS MINISCULAS**********/
function tieneMinusculas(texto){
	var letras="abcdefghyjklmnñopqrstuvwxyz";
	for(i=0; i< texto.length; i++){
		if (letras.indexOf(texto.charAt(i),0)!=-1) return true;
	}
	return false;
}

/*************FUNCION PARA DETERMINAR SI TEXTO TIENE LETRAS MAYUSCULAS**********/
function tieneMayusculas(texto){
	var letras="abcdefghyjklmnñopqrstuvwxyz";
	letras=letras.toUpperCase();
	for(i=0; i< texto.length; i++){
		if (letras.indexOf(texto.charAt(i),0)!=-1) return 1;
	}
	return 0;
}

/*************FUNCION PARA VERIFICAR QUE SEA NUMERICO UN CAMPO**********/
function esNumero(campo){
	if (isNaN(campo.value)) {
		alert('..:: Valor Digitado No Es Numerico ::..');
		campo.value='';
	}
}
function mostrarSeguridad(contra) {
	var segtext=seguridadClave(contra);
	var seg=document.getElementById("seguridad");
	var segdiv='';
	
	if (parseInt(segtext)>=0&&parseInt(segtext)<=20) {
		segdiv='MUY BAJA-';
		seg.setAttribute("class","muy_baja");
	} else if (parseInt(segtext)>=21&&parseInt(segtext)<=40) {
		segdiv='BAJA-';
		seg.setAttribute("class","baja");
	} else if (parseInt(segtext)>=41&&parseInt(segtext)<=60) {
		segdiv='MEDIA-';
		seg.setAttribute("class","media");
	} else if (parseInt(segtext)>=61&&parseInt(segtext)<=80) {
		segdiv='ALTA-';
		seg.setAttribute("class","alta");
	} else {
		segdiv='MUY ALTA-';
		seg.setAttribute("class","muy_alta");
	}
	
	seg.innerHTML= 'SEGURIDAD: ' + segdiv+segtext+'%';
}

function act_cambio(){
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor digite la anterior contrase&ntilde;a.',true)) return false;
	
	if (!valida(dijit.byId('i_dojo_1'), 'Por favor digite la nueva contrase&ntilde;a.',true)) return false;
	
	if (!valida(dijit.byId('i_dojo_2'), 'Por favor confirme la contrase&ntilde;a.',true)) return false;
	
	if (dijit.byId('i_dojo_1').value!=dijit.byId('i_dojo_2').value) {
		mensaje_dj('ERROR','La contrase&ntilde;a nueva no coincide con la de confirmaci&oacute;n','OK','ERROR','',dijit.byId('i_dojo_2'));
		return false;
	}
	
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/AdicionarModificar.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				foco(dijit.byId('i_dojo_1'));
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId('i_dojo_1'));
			} else {
				dijit.byId('ventana').hide();
			}
		}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vCambioClave')+'&datos_ant='+reemp_carac_esp_js(document.getElementById('datos_ant').value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		i++;
	}
	peticion.send(envio);
	
	return false;
}

function cerrar_sesion(){
	
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			dijit.byId('ventana').hide();
			//parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value='';
			cargarSesion('Acceso/login.php',true,'../../',parent.document.getElementById(window.name).parentNode,'');
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('cerrarSesion')+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	
	return false;
}
function arSqlArJavascript(a_sql) {
	var a_javascript=new Array();
	a_sql=a_sql.substr(a_sql.indexOf('{')+1);
	a_sql=a_sql.replace('}','');
	
	if (a_sql.length>0) a_javascript=a_sql.split(',');
	for (i=0;i<a_javascript.length;i++) {
		
		if (a_javascript[i].substr(0,1)=='"') a_javascript[i]=a_javascript[i].substr(1,a_javascript[i].length);
		if (a_javascript[i].substr(a_javascript[i].length-1,1)=='"') a_javascript[i]=a_javascript[i].substr(0,a_javascript[i].length-1);
		
	}
	return a_javascript;
}
/**
 * LLENAR CON CARACTER A LA IZQUIERDA
 * @param Longitud del Campo smallint
 * @param Valor string
 * @param Caracter con se rellena.
 * @return Valor con Caracteres al Izquierda de Acuerdo a la Longitud.
 * */
function caracterIzquierda(longitud,valor,caracter) {
	var cadena='';
	longitud-=valor.length;
	
	for(i=1;i<=longitud;i++) {
		cadena+=caracter;
	}
	return cadena+valor;
}
/**
 * LLENAR CON CARACTER A LA DERECHA
 * @param Longitud del Campo smallint
 * @param Valor integer
 * @param Caracter con se rellena.
 * @return Valor con Caracteres al Derecha de Acuerdo a la Longitud.
 * */
function caracterDerecha(longitud,valor,caracter) {
	longitud-=valor.length;
	for(i=1;i<=longitud;i++) {
		cadena+=caracter;
	}
	return valor+cadena;
}
/**
 * Calcula el digito de verificación para un nit
 * @param nit
 * @returns dv
 */
function calculaDV(nit) {
	var formula,dv;
	nit=caracterIzquierda(15,str_replace(',', '', nit),'0');
	formula=(nit.substr(14,1)*3+nit.substr(13,1)*7+nit.substr(12,1)*13+nit.substr(11,1)*17+nit.substr(10,1)*19+nit.substr(9,1)*23+nit.substr(8,1)*29+nit.substr(7,1)*37+
			nit.substr(6,1)*41+nit.substr(5,1)*43+nit.substr(4,1)*47+nit.substr(3,1)*53+nit.substr(2,1)*59+nit.substr(1,1)*67+nit.substr(0,1)*71)%11;
	if (formula==0) {
		dv=0;
	} else if (formula==1){
		dv=1;
	} else {
		dv=11-formula;
	}
	return dv;
}

function exportar() {
	document.getElementById('list_tipo').value=base64_encode(dijit.byId('i_dojo_0').value);
	document.getElementById('list_delimitado').value=base64_encode(dijit.byId('i_dojo_1').value);
	document.getElementById('list_otro').value=base64_encode(dijit.byId('i_dojo_2').value);
	document.getElementById('fechaInicio').value=parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	document.f_consulta.action='../../Controlador/Exportar.php';
	document.f_consulta.submit();
	document.f_consulta.action='';
	dijit.byId('ventana').hide();
}
/** codigo generado para eliminar filas de una tabla*/
function eliminar_fila(id_tabla,id_fila) {
	var fila=document.getElementById(id_fila);
	var tabla=document.getElementById(id_tabla);
	tabla.removeChild(fila); // REMUEVE LA FILA
}