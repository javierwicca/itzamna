/**
 * 
 */
dojo.require("dijit.form.Button");
dojo.require("dijit.form.FilteringSelect");
dojo.require("dijit.form.Select");
dojo.require("dijit.form.RadioButton");
dojo.require("dijit.form.NumberTextBox");
dojo.require("dijit.dijit");
dojo.require("dojo.parser");
dojo.require("dojo.data.ItemFileWriteStore");
dojo.require("dojox.grid.EnhancedGrid");
dojo.require("dojox.grid.enhanced.plugins.DnD");
dojo.require("dojox.grid.enhanced.plugins.Menu");
dojo.require("dojox.grid.enhanced.plugins.NestedSorting");
dojo.require("dojox.grid.enhanced.plugins.IndirectSelection");
dojo.require("dijit.layout.TabContainer");
dojo.require("dijit.layout.ContentPane");
dojo.require("dijit.form.CheckBox");
dojo.require("dijit.ProgressBar");
dojo.require("dijit.Dialog");
dojo.require("dijit.form.DateTextBox");
dojo.require("dojo.date.locale");

function inicio() {
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - USUARIOS';
	cargarPermisos ('2','usuario',['i_dojo_0','i_dojo_1','i_dojo_32','','i_dojo_0'],['1','1','1','1','1'],["document.getElementById('list_usuario').value"],
	"'&usuario='+base64_encode(document.getElementById('list_usuario').value)",['4-consulta'],['<td id="td_con" style="display: none;"><input type="button" name="b_con"'+
	'id="b_con" value="" class="b_con" onclick="renovarPassword();"></td>'],['b_con'],['Renovar contrase&ntilde;a:'],'L');
}

var cd=0;

function cargar_grid(datos) {
	a_datos=new Array(),usr= new Array(),act=0;ina=0;
	cd++;
	dojo.declare("dojox.grid.formatterScopeObj", null, {
		store: null,
		_RadioButton: [],
		_CheckBox: [],
		constructor: function(kwArgs){
			this.store = kwArgs.store;
			this._RadioButton = [];
		},
		invalidateCache: function(){
			// Called when we need to clean our cache and destroy our
			// widgets.
			dojo.forEach(this._RadioButton, function(w){
				if(w && w.destroy){
					w.destroy();
				}
			});
			this._RadioButton = [];
		},
		fmtRadioButton: function(value, idx){
			var chk=false;
			var valores=new Array();
			valores[0]='';
			valores[1]='';
			valores=value.split('##');
			if (valores[0]==document.getElementById('list_usuario').value) {
				chk=true;
				if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='';
				if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='';
				if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
			}
			
			if(!this._RadioButton[idx]){
				
				var onclic=function anonymous() {mostrar_bot(this.value);};
				this._RadioButton[idx] = new dijit.form.RadioButton({value: value,name:'b_sel',id:'b_sel_'+idx,onClick:onclic,
					checked:chk});
			} else {
				this._RadioButton[idx].set('value',value);
				this._RadioButton[idx].set('checked',chk);
			}
			
			return this._RadioButton[idx];
		},
		fmtNum: function(value, idx){
			
			valores=value.split('##');
			if (valores[1]=='A') {
				color='black';
			} else {
				color='red';
			}
			
			vl_num=retorna_num(valores[0]);
			
			var div='<div style="color: '+color+';">'+salto_linea_html(number_format(vl_num,0,'',','))+'</div>';
			return div;
		},
		fmtValue: function(value, idx){
			var valores=new Array();
			var color='';
			valores=value.split('##');
			if (valores[1]=='A') {
				color='black';
			} else {
				color='red';
			}
			var div='<div style="color: '+color+';">'+salto_linea_html(valores[0])+'</div>';
			return div;
		}
	});
	
	a_datos=datos.split('##');
	
	if (datos!='') {
		var alto=screen.height-370;
		
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='';
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='none';
		
	} else {
		var alto=0;
		
		if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='none';
		if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='none';
		if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='none';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='';
	}
	
	var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_usuario'});
	
	var columnas=[
								{ name: 'Sel.', field: 'cd_usuario', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
								{ name: 'Usuario', field: 'usuario', width: '10%',styles:"text-align: right;",formatter:"fmtNum"},
								{ name: 'Nombre', field: 'nombres', width: '25%',formatter:"fmtValue"},
								{ name: 'Correo', field: 'correo', width: '15%',formatter:"fmtValue"},
								{ name: 'Perfil', field: 'perfil', width: '10%',formatter:"fmtValue"}
							];
	
	// create a new grid:
	if (dijit.byId('grid_usuario')) {
		var gotItems = function(items, request){
			for(var i = 0; i < items.length; i++){
				var item = items[i];
				store.deleteItem(item);
			}
		};
		
		store.fetch({onComplete: gotItems});
		
		if (datos!='') {
			if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='none';
			if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='none';
			if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='none';
			
			var len_usr=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_usr) len_usr=usr[0].length;
			}
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[2]=='A') act++;
				else ina++;
				store.newItem({
					cd_usuario: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[6]+'##'+cd)),
					usuario: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_usr,'0','STR_PAD_LEFT')+'##'+usr[2])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[6]+'##'+usr[2])),
					correo: str_replace("'", "\'", reempCaracEspDojo(usr[1]+'##'+usr[2])),
					perfil: str_replace("'", "\'", reempCaracEspDojo(usr[7]+'##'+usr[2]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasUsuarios.php',clearOnClose:true});
		
		if (datos!='') {
			var len_usr=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_usr) len_usr=usr[0].length;
			}
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[2]=='A') act++;
				else ina++;
				store.newItem({
					cd_usuario: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[6]+'##'+cd)),
					usuario: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_usr,'0','STR_PAD_LEFT')+'##'+usr[2])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[6]+'##'+usr[2])),
					correo: str_replace("'", "\'", reempCaracEspDojo(usr[1]+'##'+usr[2])),
					perfil: str_replace("'", "\'", reempCaracEspDojo(usr[7]+'##'+usr[2]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_usuario'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_usuario', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Usuario', field: 'usuario', width: '10%',styles:"text-align: right;",formatter:"fmtNum"},
									{ name: 'Nombre', field: 'nombres', width: '25%',formatter:"fmtValue"},
									{ name: 'Correo', field: 'correo', width: '15%',formatter:"fmtValue"},
									{ name: 'Perfil', field: 'perfil', width: '10%',formatter:"fmtValue"}
								];
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_usuario",
			id: "grid_usuario",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_usr"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_usuario').style.height=alto+'px';
	dijit.byId('grid_usuario').render();
}

function consultar() {
	document.getElementById('argumentos').style.display='none';
	var peticion=false,envio='',datos= new Array(),datos_i= new Array(),fragment_url='../../Controlador/Control.php';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
			if (peticion.readyState == 4) {
				cargar_grid(peticion.responseText);
			}
	}
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	for (i=0;i<document.f_consulta.elements.length;i++) {
		if (document.f_consulta.elements[i].name!='') {
			if (envio!='') envio+='&';
			envio+=document.f_consulta.elements[i].name+'='+base64_encode(reemp_carac_esp_js(document.f_consulta.elements[i].value));
		}
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function mostrar_bot(valor) {
	var valores=new Array();
	
	valores=valor.split('##');
	
	if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='';
	if (dijit.byId("b_mod_tooltip")) dijit.byId("b_mod_tooltip").attr('label','Modificar Usuario: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_con')) document.getElementById('td_con').style.display='';
	if (dijit.byId("b_con_tooltip")) dijit.byId("b_con_tooltip").attr('label','Renovar Contrase&ntilde;a Para Usuario: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='';
	if (dijit.byId("b_ina_tooltip")) dijit.byId("b_ina_tooltip").attr('label','Inactivar Usuario: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Usuario: '+reemp_carac_esp_html(valores[1]));
	
	document.f_consulta.list_usuario.value=valores[0];
}

function ver_usuario() {
	if (dijit.byId('i_dojo_0').value!='') {
		var peticion=false,envio='',fragment_url='../../Controlador/Control.php';
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									foco(dijit.byId('i_dojo_0'));
																									mensaje_dj('ERROR','Usuario Digitado Ya Existe.','OK','ERROR','',dijit.byId('i_dojo_0'));
																									dijit.byId('i_dojo_0').set('value','');
																								} else {
																									datos_cedula(dijit.byId('i_dojo_0').value);
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio+='action='+base64_encode('consultarUsuarios')+'&list_t_usuario='+base64_encode(dijit.byId('i_dojo_0').value)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function datos_cedula(valor) {
	var peticion=false,a_fecha=new Array(),fecha,envio='',fragment_url='../../Controlador/Control.php';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								
																								datos=peticion.responseText.split('@@');
																								document.getElementById('accion_d').value='M';
																								document.getElementById('datos_ant_d').value=base64_encode("dir_identificacion="+datos[0]+"; dir_tipo_documento="+
																								datos[1]+"; dir_lugar_documento="+datos[2]+"; dir_digito_v="+datos[3]+" dir_tipo_persona="+datos[4]+
																								"; dir_apellidos="+datos[5]+"; dir_nombres="+datos[6]+"; dir_direccion="+datos[7]+"; dir_telefono="+datos[8]+
																								"; dir_correo="+datos[9]+"; dir_ciudad_direccion="+datos[10]+"; dir_barrio="+datos[11]+"; dir_fecha_nac="+datos[12]+
																								"; dir_lugar_nac="+datos[13]+"; dir_estado="+datos[14]);
																								
																								dijit.byId('i_dojo_2').set('value',datos[3]);
																								dijit.byId('i_dojo_3').set('value',datos[1]);
																								dijit.byId('i_dojo_4').set('value',datos[4]);
																								
																								if (datos[2]!='NULL'&&datos[2]!='') {
																									dijit.byId('i_dojo_6').set('value',datos[2].substr(0,3));
																									cargarCiudad(depto_documento_store,'D',datos[2].substr(0,3));
																									dijit.byId('i_dojo_7').set('value',datos[2].substr(0,5));
																									cargarCiudad(ciudad_documento_store,'C',datos[2].substr(0,5));
																									dijit.byId('i_dojo_8').set('value',datos[2]);
																								}
																								
																								dijit.byId('i_dojo_9').set('value',datos[6]);
																								dijit.byId('i_dojo_10').set('value',datos[5]);
																								dijit.byId('i_dojo_11').set('value',datos[9]);
																								a_fecha=datos[12].split('-');
																								fecha=new Date(a_fecha[0],a_fecha[1]-1,a_fecha[2]);
																								dijit.byId('i_dojo_12').set('value',fecha);
																								
																								dijit.byId('i_dojo_13').set('value',datos[13].substr(0,3));
																								cargarCiudad(depto_nac_store,'D',datos[13].substr(0,3));
																								dijit.byId('i_dojo_14').set('value',datos[13].substr(0,5));
																								cargarCiudad(ciudad_nac_store,'C',datos[13].substr(0,5));
																								dijit.byId('i_dojo_15').set('value',datos[13]);
																								
																								dijit.byId('i_dojo_16').set('value',datos[15]);
																								
																								if (datos[22]!='NULL'&&datos[22]!='') {
																									dijit.byId('i_dojo_17').set('value',datos[22].substr(0,3));
																									cargarCiudad(depto_domicilio_store,'D',datos[22].substr(0,3));
																									dijit.byId('i_dojo_18').set('value',datos[22].substr(0,5));
																									cargarCiudad(ciudad_domicilio_store,'C',datos[22].substr(0,5));
																									dijit.byId('i_dojo_19').set('value',datos[22]);
																								}
																								
																								dijit.byId('i_dojo_20').set('value',datos[16]);
																								
																								if (datos[23]!='NULL'&&datos[23]!='') {
																									dijit.byId('i_dojo_21').set('value',datos[23].substr(0,3));
																									cargarCiudad(depto_correspondencia_store,'D',datos[23].substr(0,3));
																									dijit.byId('i_dojo_22').set('value',datos[23].substr(0,5));
																									cargarCiudad(ciudad_correspondencia_store,'C',datos[23].substr(0,5));
																									dijit.byId('i_dojo_23').set('value',datos[23]);
																								}
																								
																								dijit.byId('i_dojo_24').set('value',datos[17]);
																								
																								if (datos[24]!='NULL'&&datos[24]!='') {
																									dijit.byId('i_dojo_25').set('value',datos[24].substr(0,3));
																									cargarCiudad(depto_contacto_store,'D',datos[24].substr(0,3));
																									dijit.byId('i_dojo_26').set('value',datos[24].substr(0,5));
																									cargarCiudad(ciudad_contacto_store,'C',datos[24].substr(0,5));
																									dijit.byId('i_dojo_27').set('value',datos[24]);
																								}
																								
																								dijit.byId('i_dojo_28').set('value',datos[18]);
																								dijit.byId('i_dojo_29').set('value',datos[19]);
																								dijit.byId('i_dojo_30').set('value',datos[20]);
																								dijit.byId('i_dojo_31').set('value',datos[21]);
																								
																							} else {
																								document.getElementById('accion_d').value='A';
																								document.getElementById('datos_ant_d').value=base64_encode("");
																								dijit.byId('i_dojo_3').set('value','');
																								dijit.byId('i_dojo_4').set('value','');
																								dijit.byId('i_dojo_5').set('value','');
																								
																								dijit.byId('i_dojo_6').set('value','COL');
																								cargarCiudad(depto_documento_store,'D','COL');
																								dijit.byId('i_dojo_7').set('value','');
																								dijit.byId('i_dojo_8').set('value','');
																								
																								dijit.byId('i_dojo_9').set('value','');
																								dijit.byId('i_dojo_10').set('value','');
																								dijit.byId('i_dojo_11').set('value','');
																								dijit.byId('i_dojo_12').set('value','');
																								
																								dijit.byId('i_dojo_13').set('value','COL');
																								cargarCiudad(depto_nac_store,'D','COL');
																								dijit.byId('i_dojo_14').set('value','');
																								dijit.byId('i_dojo_15').set('value','');
																								
																								dijit.byId('i_dojo_16').set('value','');
																								
																								dijit.byId('i_dojo_17').set('value','COL');
																								cargarCiudad(depto_domicilio_store,'D','COL');
																								dijit.byId('i_dojo_18').set('value','');
																								dijit.byId('i_dojo_19').set('value','');
																								
																								dijit.byId('i_dojo_20').set('value','');
																								
																								dijit.byId('i_dojo_21').set('value','COL');
																								cargarCiudad(depto_correspondencia_store,'D','COL');
																								dijit.byId('i_dojo_22').set('value','');
																								dijit.byId('i_dojo_23').set('value','');
																								
																								dijit.byId('i_dojo_24').set('value','');
																								
																								dijit.byId('i_dojo_25').set('value','COL');
																								cargarCiudad(depto_contacto_store,'D','COL');
																								dijit.byId('i_dojo_26').set('value','');
																								dijit.byId('i_dojo_27').set('value','');
																								
																								dijit.byId('i_dojo_28').set('value','');
																								dijit.byId('i_dojo_29').set('value','');
																								dijit.byId('i_dojo_30').set('value','');
																								dijit.byId('i_dojo_31').set('value','');
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio+='action='+base64_encode('consultarDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function cambio_persona(valor) {
	if (valor=='J') {
		document.getElementById('tr_apellidos').style.display='none';
		document.getElementById('fc_nac').innerHTML='Fecha de Creaci&oacute;n';
		document.getElementById('lu_nac').innerHTML='Lugar de Creaci&oacute;n';
		document.getElementById('td_nm').innerHTML='Raz&oacute;n Social*';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n*';
		dijit.byId('i_dojo_3').set('required', true);
		dijit.byId('i_dojo_10').set('value','');
	} else {
		document.getElementById('tr_apellidos').style.display='';
		document.getElementById('fc_nac').innerHTML='Fecha de Nacimiento';
		document.getElementById('lu_nac').innerHTML='Lugar de Nacimiento';
		document.getElementById('td_nm').innerHTML='Nombre*';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n';
		dijit.byId('i_dojo_3').set('required', false);
		
	}
}

function act_usuario() {
	var fl_rol=false;
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor digite el n&uacute;mero de identificaci&oacute;n del usuario.',false)) return false;
	
	if (!valida(dijit.byId('i_dojo_1'), 'Por favor seleccione el tipo de usuario.',false)) return false;
	
	if (dijit.byId('i_dojo_4').value=='J') {
		if (!valida(document.getElementById('i_dojo_2'), 'Por favor digite el digito de verificaci&oacute;n del usuario.',false)) return false;
	}
	
	if (document.getElementById('i_dojo_2').getAttribute("aria-invalid")=='true') {
		foco(document.getElementById('i_dojo_2'));
		mensaje_dj('ERROR','El digito de verificaci&oacute;n no es valido.','OK','ERROR','',document.getElementById('i_dojo_2'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_3'), 'Por favor seleccione el tipo de documento del usuario.',false)) return false;
	
	if (!valida(dijit.byId('i_dojo_8'), 'Por favor seleccione el lugar de expedici&oacute;n del documento del usuario.',false)) return false;
	
	if (dijit.byId('i_dojo_4').value!='J') {
		if (!valida(dijit.byId('i_dojo_9'), 'Por favor digite el nombre del usuario.',false)) return false;
		
		if (!valida(dijit.byId('i_dojo_10'), 'Por favor digite los apellidos del usuario.',false)) return false;
	} else {
		if (!valida(dijit.byId('i_dojo_9'), 'Por favor digite la raz&oacute;n social del usuario.',false)) return false;
	}
	
	if (!valida(dijit.byId('i_dojo_11'), 'Por favor digite el correo el&eacute;ctronico.',false)) return false;
	
	if (!validaCorreo(dijit.byId('i_dojo_11'))) return false;
	
	if (document.getElementById('i_dojo_12').getAttribute("aria-invalid")=='true') {
		foco(document.getElementById('i_dojo_12'));
		mensaje_dj('ERROR','La fecha de nacimiento no es valida.','OK','ERROR','',document.getElementById('i_dojo_12'));
		return false;
	}
	
	if (dijit.byId('i_dojo_1').value=='S') {
		i=1;
		while (document.getElementById('v_rol_s_'+i)) {
			if (document.getElementById('v_rol_s_'+i).value=='S') {
				if (!valida(dijit.byId(document.getElementById('n_rol_s_'+i).value), 'Por favor seleccione el rol.',false)) return false;
				
				if (dijit.byId(document.getElementById('n_estado_s_'+i).value).value=='A') fl_rol=true;
				
				j=1;
				while (document.getElementById('v_rol_s_'+j)) {
					if (document.getElementById('v_rol_s_'+j).value=='S') {
						if (dijit.byId(document.getElementById('n_rol_s_'+i).value).id!=dijit.byId(document.getElementById('n_rol_s_'+j).value).id) {
							if (dijit.byId(document.getElementById('n_rol_s_'+i).value).value==dijit.byId(document.getElementById('n_rol_s_'+j).value).value) {
								foco(dijit.byId(document.getElementById('n_rol_s_'+j)));
								mensaje_dj('ERROR','Se encuentra repetido el rol.','OK','ERROR','',dijit.byId(document.getElementById('n_rol_s_'+j)));
								return false;
							}
						}
					}
					j++;
				}
			}
			i++;
		}
	} else if (dijit.byId('i_dojo_1').value=='U') {
		i=1;
		while (document.getElementById('v_rol_u_'+i)) {
			if (document.getElementById('v_rol_u_'+i).value=='S') {
				if (!valida(dijit.byId(document.getElementById('n_rol_u_'+i).value), 'Por favor seleccione el rol.',false)) return false;
				
				if (!valida(dijit.byId(document.getElementById('n_cliente_u_'+i).value), 'Por favor seleccione el cliente.',false)) return false;
				
				if (dijit.byId(document.getElementById('n_estado_u_'+i).value).value=='A') fl_rol=true;
				
				j=1;
				while (document.getElementById('v_rol_u_'+j)) {
					if (document.getElementById('v_rol_u_'+j).value=='S') {
						if (dijit.byId(document.getElementById('n_rol_u_'+i).value).id!=dijit.byId(document.getElementById('n_rol_u_'+j).value).id) {
							if (dijit.byId(document.getElementById('n_rol_u_'+i).value).value==dijit.byId(document.getElementById('n_rol_u_'+j).value).value&&
									dijit.byId(document.getElementById('n_cliente_u_'+i).value).value==dijit.byId(document.getElementById('n_cliente_u_'+j).value).value) {
								foco(dijit.byId(document.getElementById('n_rol_u_'+j)));
								mensaje_dj('ERROR','Se encuentra repetido el rol y el cliente.','OK','ERROR','',dijit.byId(document.getElementById('n_rol_u_'+j)));
								return false;
							}
						}
					}
					j++;
				}
			}
			i++;
		}
	
		if (!fl_rol) {
			foco(dijit.byId('i_dojo_36'));
			mensaje_dj('ERROR','Debe seleccionar al menos un rol.','OK','ERROR','',dijit.byId('i_dojo_36'));
			return false;
		}
	}
	
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	
	var peticion=false,envio='',fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				if (strpos(peticion.responseText,'CLAVE')===false) {
					foco(dijit.byId('i_dojo_1'));
					mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId('i_dojo_1'));
					document.getElementById('barra_proc').style.display='none';
					document.getElementById('datos').style.display='';
				} else {
					dijit.byId('ventana').hide();
					//mensaje_dj('INFORMACI&Oacute;N',peticion.responseText,'OK','INFO','consultar',dijit.byId('i_dojo_2'));
				}
			} else {
				dijit.byId('ventana').hide();
				consultar();
				
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vUsuario')+'&accion_d='+base64_encode(document.getElementById('accion_d').value)+'&filas_rol_u='+
	base64_encode(document.getElementById('filas_rol_u').value)+'&filas_rol_s='+base64_encode(document.getElementById('filas_rol_s').value)+'&accion_u='+
	base64_encode(document.getElementById('accion_u').value)+'&datos_ant_d='+reemp_carac_esp_js(document.getElementById('datos_ant_d').value)+'&datos_ant_u='+
	reemp_carac_esp_js(document.getElementById('datos_ant_u').value)+'&req_cambio='+base64_encode(reemp_carac_esp_js(document.getElementById('req_cambio').value));
	
	i=1;
	while (document.getElementById('v_rol_u_'+i)) {
		envio+='&accion_r_u_'+i+'='+base64_encode(document.getElementById('accion_r_u_'+i).value)+'&v_rol_u_'+i+'='+
		base64_encode(document.getElementById('v_rol_u_'+i).value)+'&datos_ant_r_u_'+i+'='+base64_encode(document.getElementById('datos_ant_r_u_'+i).value);
		
		j=0;
		while (document.getElementById('modulo_u_'+i+'_'+j)) {
			envio+='&accion_pe_u_'+i+'[]='+base64_encode(document.getElementById('accion_pe_u_'+i+'_'+j).value)+'&modulo_u_'+i+'[]='+
			base64_encode(reemp_carac_esp_js(document.getElementById('modulo_u_'+i+'_'+j).value))+'&datos_ant_pe_u_'+i+'[]='+
			base64_encode(document.getElementById('datos_ant_pe_u_'+i+'_'+j).value);
			j++;
		}
		i++;
	}
	
	i=1;
	while (document.getElementById('v_rol_s_'+i)) {
		envio+='&accion_r_s_'+i+'='+base64_encode(document.getElementById('accion_r_s_'+i).value)+'&v_rol_s_'+i+'='+
		base64_encode(document.getElementById('v_rol_s_'+i).value)+'&datos_ant_r_s_'+i+'='+base64_encode(document.getElementById('datos_ant_r_s_'+i).value);

		j=0;
		while (document.getElementById('modulo_s_'+i+'_'+j)) {
			envio+='&accion_pe_s_'+i+'[]='+base64_encode(document.getElementById('accion_pe_s_'+i+'_'+j).value)+'&modulo_s_'+i+'[]='+
			base64_encode(reemp_carac_esp_js(document.getElementById('modulo_s_'+i+'_'+j).value))+'&datos_ant_pe_s_'+i+'[]='+
			base64_encode(document.getElementById('datos_ant_pe_s_'+i+'_'+j).value);
			j++;
		}
		i++;
	}
	
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		//alert(dijit.byId('i_dojo_'+i).type+'-'+dijit.byId('i_dojo_'+i).checked+'-'+dijit.byId('i_dojo_'+i).name);
		if (dijit.byId('i_dojo_'+i).type!='checkbox') envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		else {
			
			if (dijit.byId('i_dojo_'+i).checked) envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js('t'));
			else envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js('f'));
		}
		i++;
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	//alert(envio);
	peticion.send(envio);
	return false;
}

function cambio_tp_usr(valor) {
	var disp='';
	if (valor!='S') disp='none';
	
	document.getElementById('ta_permisos_s').style.display=disp;
	
	disp='';
	if (valor!='U') disp='none';
	
	document.getElementById('ta_permisos_u').style.display=disp;
	if (valor!='A') {
		if (parseInt(document.getElementById('filas_rol_'+valor.toLowerCase()).value)==0) add_per(valor.toLowerCase());
	}
}

function add_per(tipo) {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_rol_"+tipo).value);
	filas++;
	document.getElementById("filas_rol_"+tipo).value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var td=document.getElementById("td_permisos_"+tipo);
		var tabla=document.createElement("table");
		tabla.setAttribute("class","tabla_usuario");
		tabla.setAttribute("cellpadding","2");
		tabla.setAttribute("cellspacing","2");
		tabla.setAttribute("width","100%");
		tabla.setAttribute("id","ta_permisos_"+tipo+"_"+filas.toString());
		td.appendChild(tabla);
		
		var tbody=document.createElement("tbody");
		tbody.setAttribute("id","tb_permisos_"+tipo+"_"+filas.toString());
		tabla.appendChild(tbody);
		
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_rol_p_"+tipo+"_"+filas.toString());
		tbody.appendChild(tr);
		
		var td=document.createElement("td");
		if (tipo=='s') td.setAttribute("colspan","4");
		else td.setAttribute("colspan","6");
		td.setAttribute("class","titulo");
		tr.appendChild(td);
		
		var span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='PERMISOS';
		
		onclic=function anonymous() {add_per(tipo);};
		campo_dojo=new dijit.form.Button({type:"button",name:'add_per'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		if (filas!=1) {
			filas_d++;
			
			onclic=function anonymous() {eli_per(tipo,filas.toString());};
			campo_dojo=new dijit.form.Button({type:"button",name:'b_elim_'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
			td.appendChild(campo_dojo.domNode);
		}
		
		filas_d++;
		
		tr=document.createElement("tr");
		tr.setAttribute("id","tr_rol_"+tipo+"_"+filas.toString());
		tbody.appendChild(tr);
		
		td=document.createElement("td");
		tr.appendChild(td);
		td.innerHTML='Rol*';
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_r_"+tipo+"_"+filas);
		campo.setAttribute("id","accion_r_"+tipo+"_"+filas);
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'A');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_rol_"+tipo+"_"+filas);
		campo.setAttribute("id","v_rol_"+tipo+"_"+filas);
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_r_"+tipo+"_"+filas);
		campo.setAttribute("id","datos_ant_r_"+tipo+"_"+filas);
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_rol_"+tipo+"_"+filas);
		campo.setAttribute("id","n_rol_"+tipo+"_"+filas);
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_r=new dojo.data.ItemFileReadStore({jsId:'rol_store_'+tipo+'_'+filas+'_store',id:'rol_store_'+tipo+'_'+filas+'_store',
			url:"../../Stores/comboRoles.php?where= and r.rol_estado='A'",urlPreventCache:false,clearOnClose:true});
		
		var onchan=function anonymous() {permisos_rol(this);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'rol_'+tipo+'_'+filas,id:'i_dojo_'+filas_d,style:"width: 150px;",
			placeHolder:"Seleccione el rol",promptMessage:"Seleccione el rol.",required:true,store:store_r,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		if (tipo=='s') {
			campo_dojo=new dijit.form.ValidationTextBox({name:'cliente_s_'+filas,id:'i_dojo_'+filas_d,style:"display: none;",value:'-1'});
			td.appendChild(campo_dojo.domNode);
		} else {
			td=document.createElement("td");
			tr.appendChild(td);
			td.innerHTML='Cliente*';
			
			td=document.createElement("td");
			td.setAttribute("class","texto_mayus");
			tr.appendChild(td);
			
			campo=document.createElement("input");
			campo.setAttribute("name","n_cliente_u_"+filas);
			campo.setAttribute("id","n_cliente_u_"+filas);
			campo.setAttribute("type","hidden");
			campo.setAttribute("value","i_dojo_"+filas_d);
			td.appendChild(campo);
			
			var store_r=new dojo.data.ItemFileReadStore({jsId:'cliente_store_u_'+filas+'_store',id:'cliente_store_u_'+filas+'_store',
				url:'../../Stores/comboClientes.php',urlPreventCache:false,clearOnClose:true});
			
			campo_dojo=new dijit.form.FilteringSelect({name:'cliente_u_'+filas,id:'i_dojo_'+filas_d,style:"width: 300px;",
				placeHolder:"Seleccione el cliente",promptMessage:"Seleccione el cliente.",required:true,store:store_r,searchAttr:"name",
				highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
			td.appendChild(campo_dojo.domNode);
		}
		
		td=document.createElement("td");
		tr.appendChild(td);
		td.innerHTML='Estado*';
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_estado_"+tipo+"_"+filas);
		campo.setAttribute("id","n_estado_"+tipo+"_"+filas);
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.Select({name:'estado_'+tipo+'_'+filas,id:'i_dojo_'+filas_d,required:true,options: [{ label: "ACTIVO", value: "A", selected: true }],
			disabled:true});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
	} else {
		var td=document.getElementById("td_permisos_"+tipo);
		var tabla=document.createElement("<table class='tabla_usuario' cellpadding='2' cellspacing='2' width='100%' id='ta_permisos_"+tipo+"_"+filas.toString()+"'>");
		td.appendChild(tabla);
		
		var tbody=document.createElement("<tbody id='tb_permisos_"+tipo+"_"+filas.toString()+"'>");
		tabla.appendChild(tbody);
		
		var tr=document.createElement("<tr id='tr_rol_p_"+tipo+"_"+filas.toString()+"'>");
		tbody.appendChild(tr);
		
		
		if (tipo=='s') var td=document.createElement("td colspan='4' class='titulo'>");
		else td=document.createElement("td colspan='6' class='titulo'>");
		
		tr.appendChild(td);
		
		var span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='PERMISOS';
		
		onclic=function anonymous() {add_per(tipo);};
		campo_dojo=new dijit.form.Button({type:"button",name:'add_per'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		if (filas!=1) {
			filas_d++;
			
			onclic=function anonymous() {eli_per(tipo,filas.toString());};
			campo_dojo=new dijit.form.Button({type:"button",name:'b_elim_'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
			td.appendChild(campo_dojo.domNode);
		}
		
		tr=document.createElement("<tr id='tr_rol_"+tipo+"_"+filas.toString()+"'>");
		tbody.appendChild(tr);
		
		td=document.createElement("td");
		tr.appendChild(td);
		td.innerHTML='Rol*';
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_r_"+tipo+"_"+filas+"' id='accion_r_"+tipo+"_"+filas+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_rol_"+tipo+"_"+filas+"' id='v_rol_"+tipo+"_"+filas+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_r_"+tipo+"_"+filas+"' id='datos_ant_r_"+tipo+"_"+filas+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_rol_"+tipo+"_"+filas+"' id='n_rol_"+tipo+"_"+filas+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_r=new dojo.data.ItemFileReadStore({jsId:'rol_store_'+tipo+'_'+filas+'_store',id:'rol_store_'+tipo+'_'+filas+'_store',
			url:"../../Stores/comboRoles.php?where= and r.rol_estado='A'",urlPreventCache:false,clearOnClose:true});
		
		var onchan=function anonymous() {permisos_rol(this);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'rol_'+tipo+'_'+filas,id:'i_dojo_'+filas_d,style:"width: 150px;",
			placeHolder:"Seleccione el rol",promptMessage:"Seleccione el rol.",required:true,store:store_r,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		if (tipo=='s') {
			campo_dojo=new dijit.form.ValidationTextBox({name:'cliente_s_'+filas,id:'i_dojo_'+filas_d,style:"display: none;",value:'-1'});
			td.appendChild(campo_dojo.domNode);
		} else {
			td=document.createElement("td");
			tr.appendChild(td);
			td.innerHTML='Cliente*';
			
			td=document.createElement("<td class='texto_mayus'>");
			tr.appendChild(td);
			
			campo=document.createElement("<input name='n_cliente_u_"+filas+"' id='n_cliente_u_"+filas+"' type='hidden' value='i_dojo_"+filas_d+"'>");
			td.appendChild(campo);
			
			var store_r=new dojo.data.ItemFileReadStore({jsId:'cliente_store_u_'+filas+'_store',id:'cliente_store_u_'+filas+'_store',
				url:'../../Stores/comboClientes.php',urlPreventCache:false,clearOnClose:true});
			
			campo_dojo=new dijit.form.FilteringSelect({name:'cliente_u_'+filas,id:'i_dojo_'+filas_d,style:"width: 300px;",
				placeHolder:"Seleccione el cliente",promptMessage:"Seleccione el cliente.",required:true,store:store_r,searchAttr:"name",
				highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
			td.appendChild(campo_dojo.domNode);
		}
		
		td=document.createElement("td");
		tr.appendChild(td);
		td.innerHTML='Estado*';
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_estado_"+tipo+"_"+filas+"' id='n_estado_"+tipo+"_"+filas+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.Select({name:'estado_'+tipo+'_'+filas,id:'i_dojo_'+filas_d,required:true,options: [{ label: "ACTIVO", value: "A", selected: true }],
			disabled:true});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
	}
	document.getElementById("filas_dojo").value=filas_d;
	cargar_modulos(tipo,filas);
}

function eli_per(tipo,no_id) {
	document.getElementById("v_rol_"+tipo+"_"+no_id).value='N';
	document.getElementById("ta_permisos_"+tipo+"_"+no_id).style.display='none';
}

function cambio_per(campo) {
	var id=new Array();
	id=campo.name.split('_');
	no_id=id[2]+'_'+id[3]+'_'+id[4];
	if (dijit.byId(document.getElementById('n_lis_'+no_id).value).checked) {
		dijit.byId(document.getElementById('n_add_'+no_id).value).set('disabled',false);
		dijit.byId(document.getElementById('n_mod_'+no_id).value).set('disabled',false);
		dijit.byId(document.getElementById('n_ina_'+no_id).value).set('disabled',false);
	} else {
		dijit.byId(document.getElementById('n_add_'+no_id).value).set('disabled',true);
		dijit.byId(document.getElementById('n_mod_'+no_id).value).set('disabled',true);
		dijit.byId(document.getElementById('n_ina_'+no_id).value).set('disabled',true);
		dijit.byId(document.getElementById('n_add_'+no_id).value).set('checked',false);
		dijit.byId(document.getElementById('n_mod_'+no_id).value).set('checked',false);
		dijit.byId(document.getElementById('n_ina_'+no_id).value).set('checked',false);
	}
}

function cambio_pex(campo) {
	var id=new Array();
	id=campo.name.split('_');
	no_id=id[2]+'_'+id[3]+'_'+id[4];
	if (document.getElementById('accion_pe_'+no_id).value!='M') {
		if (dijit.byId(document.getElementById('n_lis_'+no_id).value).checked.toString().substring(0,1)!=document.getElementById('t_lis_'+no_id).value||
		dijit.byId(document.getElementById('n_add_'+no_id).value).checked.toString().substring(0,1)!=document.getElementById('t_add_'+no_id).value||
		dijit.byId(document.getElementById('n_mod_'+no_id).value).checked.toString().substring(0,1)!=document.getElementById('t_mod_'+no_id).value) {
			document.getElementById('accion_pe_'+no_id).value='A';
			document.getElementById('datos_ant_pe_'+no_id).value=base64_encode('');
		} else {
			document.getElementById('accion_pe_'+no_id).value='N';
		}
	}
}

function cargar_modulos(tipo,filas) {
	var peticion=false,datos=new Array(),datos_a=new Array(),info=new Array(),envio='',fragment_url='../../Controlador/Control.php',filas_d,ds_menu_sup='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								filas_d=parseInt(document.getElementById("filas_dojo").value);
																								info=peticion.responseText.split('$$');
																								datos=info[0].split('##');
																								
																								if (navigator.appName!='Microsoft Internet Explorer') {
																									var tabla=document.getElementById("tb_permisos_"+tipo+"_"+filas.toString());
																									var tr=document.createElement("tr");
																									tr.setAttribute("id","tr_mod_"+tipo+"_"+filas.toString());
																									tr.setAttribute("style","");
																									tabla.appendChild(tr);
																									
																									td=document.createElement("td");
																									if (tipo=='s') td.setAttribute("colspan","4");
																									else td.setAttribute("colspan","6");
																									tr.appendChild(td);
																									
																									campo=document.createElement("input");
																									campo.setAttribute("name","filas_mod_"+tipo+"_"+filas);
																									campo.setAttribute("id","filas_mod_"+tipo+"_"+filas);
																									campo.setAttribute("value",datos.length);
																									campo.setAttribute("type","hidden");
																									td.appendChild(campo);
																									
																									tabla=document.createElement("table");
																									tabla.setAttribute("width","100%");
																									tabla.setAttribute("class","tabla_rol");
																									tabla.setAttribute("cellpadding","2");
																									tabla.setAttribute("cellspacing","2");
																									td.appendChild(tabla);
																									
																									var tbody=document.createElement("tbody");
																									tabla.appendChild(tbody);
																									
																								} else {
																									var tabla=document.getElementById("tb_permisos_"+tipo+"_"+filas.toString());
																									var tr=document.createElement("<tr id='tr_mod_"+tipo+"_"+filas.toString()+"' style=''>");
																									tabla.appendChild(tr);
																									
																									if (tipo=='s') td=document.createElement("<td colspan='4'>");
																									else td=document.createElement("<td colspan='6'>");
																									tr.appendChild(td);
																									
																									campo=document.createElement("<input name='filas_mod_"+tipo+"_"+filas+"' id='filas_mod_"+tipo+"_"+filas+"' value='"+
																											datos.length+"' type='hidden'>");
																									td.appendChild(campo);
																									
																									tabla=document.createElement("<table width='100%' class='tabla_rol' cellpadding='2' cellspacing='2'>");
																									td.appendChild(tabla);
																									
																									var tbody=document.createElement("tbody");
																									tabla.appendChild(tbody);
																									
																								}
																								
																								for (i=0;i<datos.length;i++) {
																									datos_a=datos[i].split('@@');
																									if (navigator.appName!='Microsoft Internet Explorer') {
																										if (ds_menu_sup!=datos_a[8]) {
																											tr=document.createElement("tr");
																											tbody.appendChild(tr);
																											
																											td=document.createElement("td");
																											td.setAttribute("class","titulo");
																											td.setAttribute("colspan","5");
																											tr.appendChild(td);
																											td.innerHTML=reempHtmlCaracEsp(datos_a[8]);
																											
																											tr=document.createElement("tr");
																											tbody.appendChild(tr);
																											
																											td=document.createElement("td");
																											td.setAttribute("class","tit_tabla");
																											tr.appendChild(td);
																											td.innerHTML='Men&uacute;';
																											
																											td=document.createElement("td");
																											td.setAttribute("class","tit_tabla");
																											tr.appendChild(td);
																											td.innerHTML='Listar';
																											
																											td=document.createElement("td");
																											td.setAttribute("class","tit_tabla");
																											tr.appendChild(td);
																											td.innerHTML='Adicionar';
																											
																											td=document.createElement("td");
																											td.setAttribute("class","tit_tabla");
																											tr.appendChild(td);
																											td.innerHTML='Modificar';
																											
																											td=document.createElement("td");
																											td.setAttribute("class","tit_tabla");
																											tr.appendChild(td);
																											td.innerHTML='Inactivar';
																											ds_menu_sup=datos_a[8];
																										}
																										
																										tr=document.createElement("tr");
																										tbody.appendChild(tr);
																										
																										td=document.createElement("td");
																										tr.appendChild(td);
																										
																										span=document.createElement("span");
																										td.appendChild(span);
																										span.innerHTML=reempHtmlCaracEsp(datos_a[1]);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","modulo_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","modulo_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value",datos_a[0]);
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","accion_pe_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","accion_pe_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","N");
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","datos_ant_pe_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","datos_ant_pe_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value",base64_encode(''));
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										td=document.createElement("td");
																										td.setAttribute("align","center");
																										tr.appendChild(td);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","n_lis_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","n_lis_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","i_dojo_"+filas_d);
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","t_lis_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","t_lis_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","f");
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										var onclic=function anonymous() {cambio_per(this);cambio_pex(this);};
																										campo_dojo=new dijit.form.CheckBox({name:'c_lis_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("td");
																										td.setAttribute("align","center");
																										tr.appendChild(td);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","n_add_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","n_add_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","i_dojo_"+filas_d);
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","t_add_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","t_add_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","f");
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										var onclic=function anonymous() {cambio_pex(this);};
																										campo_dojo=new dijit.form.CheckBox({name:'c_add_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("td");
																										td.setAttribute("align","center");
																										tr.appendChild(td);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","n_mod_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","n_mod_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","i_dojo_"+filas_d);
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","t_mod_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","t_mod_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","f");
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo_dojo=new dijit.form.CheckBox({name:'c_mod_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("td");
																										td.setAttribute("align","center");
																										tr.appendChild(td);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","n_ina_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","n_ina_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","i_dojo_"+filas_d);
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo=document.createElement("input");
																										campo.setAttribute("name","t_ina_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("id","t_ina_"+tipo+"_"+filas+"_"+i);
																										campo.setAttribute("value","f");
																										campo.setAttribute("type","hidden");
																										td.appendChild(campo);
																										
																										campo_dojo=new dijit.form.CheckBox({name:'c_ina_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										filas_d++;
																									} else {
																										if (ds_menu_sup!=datos_a[8]) {
																											tr=document.createElement("tr");
																											tbody.appendChild(tr);
																											
																											td=document.createElement("<td class='titulo' colspan='5'>");
																											tr.appendChild(td);
																											td.innerHTML=reempHtmlCaracEsp(datos_a[8]);
																											
																											tr=document.createElement("tr");
																											tbody.appendChild(tr);
																											
																											td=document.createElement("<td class='tit_tabla'>");
																											tr.appendChild(td);
																											td.innerHTML='Men&uacute;';
																											
																											td=document.createElement("<td class='tit_tabla'>");
																											tr.appendChild(td);
																											td.innerHTML='Listar';
																											
																											td=document.createElement("<td class='tit_tabla'>");
																											tr.appendChild(td);
																											td.innerHTML='Adicionar';
																											
																											td=document.createElement("<td class='tit_tabla'>");
																											tr.appendChild(td);
																											td.innerHTML='Modificar';
																											
																											td=document.createElement("<td class='tit_tabla'>");
																											tr.appendChild(td);
																											td.innerHTML='Inactivar';
																											ds_menu_sup=datos_a[8];
																										}
																										
																										tr=document.createElement("tr");
																										tbody.appendChild(tr);
																										
																										td=document.createElement("td");
																										tr.appendChild(td);
																										
																										span=document.createElement("span");
																										td.appendChild(span);
																										span.innerHTML=reempHtmlCaracEsp(datos_a[1]);
																										
																										campo=document.createElement("<input name='modulo_"+tipo+"_"+filas+"_"+i+"' id='modulo_"+tipo+"_"+filas+"_"+i+
																										"' value='"+datos_a[0]+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='accion_pe_"+tipo+"_"+filas+"_"+i+"' id='accion_pe_"+tipo+"_"+filas+
																										"_"+i+"' value='N' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='datos_ant_pe_"+tipo+"_"+filas+"_"+i+"' id='datos_ant_pe_"+tipo+"_"+
																										filas+"_"+i+"' value='"+base64_encode('')+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										td=document.createElement("<td align='center'>");
																										tr.appendChild(td);
																										
																										campo=document.createElement("<input name='n_lis_"+tipo+"_"+filas+"_"+i+"' id='n_lis_"+tipo+"_"+filas+"_"+i+
																										"' value='i_dojo_"+filas_d+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='t_lis_"+tipo+"_"+filas+"_"+i+"' id='t_lis_"+tipo+"_"+filas+"_"+i+
																										"' value='f' type='hidden'>");
																										td.appendChild(campo);
																										
																										var onclic=function anonymous() {cambio_per(this);cambio_pex(this);};
																										campo_dojo=new dijit.form.CheckBox({name:'c_lis_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("<td align='center'>");
																										tr.appendChild(td);
																										
																										campo=document.createElement("<input name='n_add_"+tipo+"_"+filas+"_"+i+"' id='n_add_"+tipo+"_"+filas+
																										"' value='i_dojo_"+filas_d+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='t_add_"+tipo+"_"+filas+"_"+i+"' id='t_add_"+tipo+"_"+filas+
																										"' value='f' type='hidden'>");
																										td.appendChild(campo);
																										
																										var onclic=function anonymous() {cambio_pex(this);};
																										campo_dojo=new dijit.form.CheckBox({name:'c_add_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("<td align='center'>");
																										tr.appendChild(td);
																										
																										campo=document.createElement("<input name='n_mod_"+tipo+"_"+filas+"_"+i+"' id='n_mod_"+tipo+"_"+filas+"_"+i+
																										"' value='i_dojo_"+filas_d+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='t_mod_"+tipo+"_"+filas+"_"+i+"' id='t_mod_"+tipo+"_"+filas+"_"+i+
																										"' value='f' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo_dojo=new dijit.form.CheckBox({name:'c_mod_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										
																										filas_d++;
																										
																										td=document.createElement("<td align='center'>");
																										tr.appendChild(td);
																										
																										campo=document.createElement("<input name='n_ina_"+tipo+"_"+filas+"_"+i+"' id='n_ina_"+tipo+"_"+filas+"_"+i+
																										"' value='i_dojo_"+filas_d+"' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo=document.createElement("<input name='t_ina_"+tipo+"_"+filas+"_"+i+"' id='t_ina_"+tipo+"_"+filas+"_"+i+
																										"' value='f' type='hidden'>");
																										td.appendChild(campo);
																										
																										campo_dojo=new dijit.form.CheckBox({name:'c_ina_'+tipo+'_'+filas+'_'+i,id:'i_dojo_'+filas_d,onClick:onclic,
																											disabled:true});
																										td.appendChild(campo_dojo.domNode);
																										filas_d++;
																									}
																								}
																								
																								if (navigator.appName!='Microsoft Internet Explorer') {
																									var tabla=document.getElementById("tb_permisos_"+tipo+"_"+filas.toString());
																									var tr=document.createElement("tr");
																									tr.setAttribute("id","tr_rol_b_"+tipo+"_"+filas.toString());
																									tr.setAttribute("style","");
																									tabla.appendChild(tr);
																									
																									td=document.createElement("td");
																									if (tipo=='s') td.setAttribute("colspan","4");
																									else td.setAttribute("colspan","6");
																									td.setAttribute("align","center");
																									tr.appendChild(td);
																									
																									campo_dojo=new dijit.form.Button({type:"submit",name:'aceptar'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),
																										label:"Aceptar"});
																									td.appendChild(campo_dojo.domNode);
																									
																									filas_d++;
																									
																									new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:"i_dojo_"+filas_d.toString(),position:"above, below",
																										label:"Guardar cambios y cerrar."});
																									
																									filas_d++;
																									
																									onclic=function anonymous() {dijit.byId('ventana').hide();};
																									campo_dojo=new dijit.form.Button({type:"button",name:'b_elim_'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),
																										onClick:onclic,label:"Cancelar"});
																									td.appendChild(campo_dojo.domNode);
																									
																									filas_d++;
																									
																									new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:"i_dojo_"+filas_d.toString(),position:"above, below",
																										label:"Cerrar sin guardar cambios."});
																									
																									filas_d++;
																									
																									var tr=document.createElement("tr");
																									tr.setAttribute("id","tr_rol_c_"+tipo+"_"+filas.toString());
																									tr.setAttribute("style","");
																									tabla.appendChild(tr);
																									
																									td=document.createElement("td");
																									if (tipo=='s') td.setAttribute("colspan","4");
																									else td.setAttribute("colspan","6");
																									td.setAttribute("class","advertencia");
																									tr.appendChild(td);
																									td.innerHTML='* Campos Obligatorios';
																									
																									var tr=document.createElement("tr");
																									tr.setAttribute("id","tr_rol_i_"+tipo+"_"+filas.toString());
																									tr.setAttribute("style","");
																									tabla.appendChild(tr);
																									
																									td=document.createElement("td");
																									if (tipo=='s') td.setAttribute("colspan","4");
																									else td.setAttribute("colspan","6");
																									td.setAttribute("class","usuario");
																									tr.appendChild(td);
																									td.innerHTML='Usuario: '+base64_decode(info[1])+' - Fecha/Hora Sistema: '+info[2];
																								} else {
																									var tabla=document.getElementById("tb_permisos_"+tipo+"_"+filas.toString());
																									var tr=document.createElement("<tr id='tr_rol_b_"+tipo+"_"+filas.toString()+"' style=''>");
																									tabla.appendChild(tr);
																									
																									
																									if (tipo=='s') td=document.createElement("<td colspan='4' align='center'>");
																									else td=document.createElement("<td colspan='6' align='center'>");
																									tr.appendChild(td);
																									
																									campo_dojo=new dijit.form.Button({type:"submit",name:'aceptar'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),
																										label:"Aceptar"});
																									td.appendChild(campo_dojo.domNode);
																									
																									filas_d++;
																									
																									new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:"i_dojo_"+filas_d.toString(),position:"above, below",
																										label:"Guardar cambios y cerrar."});
																									
																									filas_d++;
																									
																									onclic=function anonymous() {dijit.byId('ventana').hide();};
																									campo_dojo=new dijit.form.Button({type:"button",name:'b_elim_'+tipo+'_'+filas,id:"i_dojo_"+filas_d.toString(),
																										onClick:onclic,label:"Cancelar"});
																									td.appendChild(campo_dojo.domNode);
																									
																									filas_d++;
																									
																									new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:"i_dojo_"+filas_d.toString(),position:"above, below",
																										label:"Cerrar sin guardar cambios."});
																									
																									filas_d++;
																									
																									var tr=document.createElement("<tr id='tr_rol_c_"+tipo+"_"+filas.toString()+"' style=''>");
																									tabla.appendChild(tr);
																									
																									if (tipo=='s') td=document.createElement("<td colspan='4' class='advertencia'>");
																									else td=document.createElement("<td colspan='6' class='advertencia'>");
																									tr.appendChild(td);
																									td.innerHTML='* Campos Obligatorios';
																									
																									var tr=document.createElement("<tr id='tr_rol_i_"+tipo+"_"+filas.toString()+"' style=''>");
																									tabla.appendChild(tr);
																									
																									if (tipo=='s') td=document.createElement("<td colspan='4' class='advertencia'>");
																									else td=document.createElement("<td colspan='6' class='usuario'>");
																									tr.appendChild(td);
																									td.innerHTML='Usuario: '+base64_decode(info[1])+' - Fecha/Hora Sistema: '+info[2];
																								}
																								
																								document.getElementById("filas_dojo").value=filas_d;
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio+='action='+base64_encode('consultarModulos')+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function permisos_rol(campo) {
	if (campo.value!='') {
		var peticion=false,datos=new Array(),datos_a=new Array(),id=new Array(),envio='',fragment_url='../../Controlador/Control.php',modulo= new Array(),
		fl_lis= new Array(),fl_add= new Array(),fl_mod= new Array(),fl_ina= new Array();
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									datos=peticion.responseText.split('##');
																									
																									for (i=0;i<datos.length;i++) {
																										datos_a=datos[i].split('@@');
																										modulo[i]=datos_a[1];
																										fl_lis[i]=datos_a[2];
																										fl_add[i]=datos_a[3];
																										fl_mod[i]=datos_a[4];
																										fl_ina[i]=datos_a[5];
																									}
																									
																									id=campo.name.split('_');
																									
																									for (i=0;i<parseFloat(document.getElementById("filas_mod_"+id[1]+"_"+id[2]).value);i++) {
																										if (array_search(document.getElementById("modulo_"+id[1]+"_"+id[2]+"_"+i).value,modulo)===false) {
																											dijit.byId(document.getElementById("n_lis_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																											document.getElementById("t_lis_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																											dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																											document.getElementById("t_add_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																											dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																											document.getElementById("t_mod_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																											dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																											document.getElementById("t_ina_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											
																										} else {
																											if (fl_lis[array_search(document.getElementById("modulo_"+id[1]+"_"+id[2]+"_"+i).value,modulo)]=='f') {
																												dijit.byId(document.getElementById("n_lis_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												document.getElementById("t_lis_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																												document.getElementById("t_add_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																												document.getElementById("t_mod_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',true);
																												document.getElementById("t_ina_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											} else {
																												dijit.byId(document.getElementById("n_lis_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',true);
																												document.getElementById("t_lis_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												if (fl_add[array_search(document.getElementById("modulo_"+id[1]+"_"+id[2]+"_"+i).value,modulo)]=='f')
																													dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												else dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',true);
																												dijit.byId(document.getElementById("n_add_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',false);
																												document.getElementById("t_add_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												if (fl_mod[array_search(document.getElementById("modulo_"+id[1]+"_"+id[2]+"_"+i).value,modulo)]=='f')
																													dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												else dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',true);
																												dijit.byId(document.getElementById("n_mod_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',false);
																												document.getElementById("t_mod_"+id[1]+"_"+id[2]+"_"+i).value='f';
																												if (fl_ina[array_search(document.getElementById("modulo_"+id[1]+"_"+id[2]+"_"+i).value,modulo)]=='f') 
																													dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',false);
																												else dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('checked',true);
																												dijit.byId(document.getElementById("n_ina_"+id[1]+"_"+id[2]+"_"+i).value).set('disabled',false);
																												document.getElementById("t_ina_"+id[1]+"_"+id[2]+"_"+i).value='f';
																											}
																										}
																										document.getElementById("accion_pe_"+id[1]+"_"+id[2]+"_"+i).value='N';
																										document.getElementById("datos_ant_pe_"+id[1]+"_"+id[2]+"_"+i).value=base64_encode('');
																									}
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio+='action='+base64_encode('consultarRolesPermisos')+'&list_t_rol='+base64_encode(campo.value)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function renovarPassword() {
	var peticion=false,envio='',fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','','');
			} else {
				mensaje_dj('INFORMACI&Oacute;N','La contrase&ntilde;a se renovo satisfactoriamente.','OK','info','','');
			}
		}
	};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio+='ventana='+base64_encode('vRenovarClave')+'&usuario='+base64_encode(document.getElementById('list_usuario').value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}