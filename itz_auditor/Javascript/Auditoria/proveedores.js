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
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - PROVEEDORES';
	cargarPermisos ('103','proveedor',['i_dojo_2','i_dojo_3','i_dojo_33','','i_dojo_0'],['1','1','1','1','1'],["document.getElementById('list_proveedor').value"],
	"'&proveedor='+base64_encode(document.getElementById('list_proveedor').value)",['103-modificar'],['<td id="td_con" style="display: ;"><input type="button" name="'+
	'b_sub" id="b_sub" value="" class="b_sub" onclick="abrirVentana(\'vSubirMasivoProveedor\',\'S\',\'Subir Informaci&oacute;n Archivo\',\'\',\'105\',\'archivo\');">'+
	'</td>'],['b_sub'],['Subir masivamente'],'L');
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
			if (valores[0]==document.getElementById('list_proveedor').value) {
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
			var div='<div style="color: '+color+'; text-transform: uppercase;">'+salto_linea_html(valores[0])+'</div>';
			return div;
		}
	});
			
	a_datos=explode('##',datos);
	
	if (datos!='') {
		var alto=screen.height-370;
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='none';
		
	} else {
		var alto=0;
		
		if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='none';
		if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='none';
		if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='none';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='';
	}
	
	var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_proveedor'});
	
	var columnas=[
								{ name: 'Sel.', field: 'cd_proveedor', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
								{ name: 'Identificaci&oacute;n', field: 'identificacion', width: '10%',styles:"text-align: right;",formatter:"fmtNum"},
								{ name: 'Nombre', field: 'nombres', width: '25%',formatter:"fmtValue"},
								{ name: 'Direcci&oacute;n', field: 'direccion', width: '15%',formatter:"fmtValue"},
								{ name: 'Tel&eacute;fono', field: 'telefono', width: '10%',formatter:"fmtValue"},
								{ name: 'Persona', field: 'persona', width: '10%',formatter:"fmtValue"},
								{ name: 'Tp. Documento', field: 'tp_documento', width: '25%',formatter:"fmtValue"}
								];
	// create a new grid:
	if (dijit.byId('grid_proveedor')) {
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
			
			var len_pro=0;
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[0].length>len_pro) len_pro=usr[0].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[8]=='A') act++;
				else ina++;
				
				store.newItem({
					cd_proveedor: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[15]+'##'+cd)),
					identificacion: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_pro,'0','STR_PAD_LEFT')+'##'+usr[8])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[15]+'##'+usr[8])),
					direccion: str_replace("'", "\'", reempCaracEspDojo(usr[9]+'##'+usr[8])),
					telefono: str_replace("'", "\'", reempCaracEspDojo(usr[13]+'##'+usr[8])),
					persona: str_replace("'", "\'", reempCaracEspDojo(usr[16]+'##'+usr[8])),
					tp_documento: str_replace("'", "\'", reempCaracEspDojo(usr[17]+'##'+usr[8]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasProveedores.php',clearOnClose:true});
		if (datos!='') {
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[0].length>len_pro) len_pro=usr[0].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[8]=='A') act++;
				else ina++;
				
				store.newItem({
					cd_proveedor: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[15]+'##'+cd)),
					identificacion: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_pro,'0','STR_PAD_LEFT')+'##'+usr[8])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[15]+'##'+usr[8])),
					direccion: str_replace("'", "\'", reempCaracEspDojo(usr[9]+'##'+usr[8])),
					telefono: str_replace("'", "\'", reempCaracEspDojo(usr[13]+'##'+usr[8])),
					persona: str_replace("'", "\'", reempCaracEspDojo(usr[16]+'##'+usr[8])),
					tp_documento: str_replace("'", "\'", reempCaracEspDojo(usr[17]+'##'+usr[8]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_proveedor'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_proveedor', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Identificaci&oacute;n', field: 'identificacion', width: '10%',styles:"text-align: right;",formatter:"fmtNum"},
									{ name: 'Nombre', field: 'nombres', width: '25%',formatter:"fmtValue"},
									{ name: 'Direcci&oacute;n', field: 'direccion', width: '15%',formatter:"fmtValue"},
									{ name: 'Tel&eacute;fono', field: 'telefono', width: '10%',formatter:"fmtValue"},
									{ name: 'Persona', field: 'persona', width: '10%',formatter:"fmtValue"},
									{ name: 'Tp. Documento', field: 'tp_documento', width: '25%',formatter:"fmtValue"}
									];
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_proveedor",
			id: "grid_proveedor",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_pro"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	document.getElementById('grid_proveedor').style.height=alto+'px';
	dijit.byId('grid_proveedor').render();
}

function consultar() {
	document.getElementById('argumentos').style.display='none';
	var peticion=false,envio='',datos= new Array(),datos_i= new Array();
	peticion=object();
	fragment_url='../../Controlador/Control.php';
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
	dijit.byId("b_mod_tooltip").attr('label','Modificar Proveedor: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='';
	dijit.byId("b_ina_tooltip").attr('label','Modificar Proveedor: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Proveedor: '+reemp_carac_esp_html(strtoupper(valores[1])));
	
	document.f_consulta.list_proveedor.value=valores[0];
}

function ver_proveedor() {
	var peticion=false;
	peticion=object();
	var fragment_url='../../Controlador/Control.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								foco(dijit.byId('i_dojo_2'));
																								mensaje_dj('ERROR','Proveedor Digitado Ya Existe.','OK','ERROR','',dijit.byId('i_dojo_2'));
																								dijit.byId('i_dojo_2').set('value','');
																							} else {
																								datos_cedula(dijit.byId('i_dojo_2').value);
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarProveedores')+'&list_t_proveedor='+base64_encode(dijit.byId('i_dojo_2').value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function datos_cedula(valor) {
	if (valor!='') {
		var peticion=false,a_fecha=new Array(),fecha;
		peticion=object();
		var fragment_url='../../Controlador/Control.php';
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
																									
																									dijit.byId('i_dojo_3').set('value',datos[3]);
																									dijit.byId('i_dojo_4').set('value',datos[1]);
																									dijit.byId('i_dojo_5').set('value',datos[4]);
																									
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
																									datos_ciiu_directorio(valor);
																									
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
																									dijit.byId('i_dojo_3').set('value',calculaDV(valor));
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function datos_rep(valor) {
	var peticion=false,a_fecha=new Array(),fecha;
	var id_dojo=0;
	id_dojo=parseInt(document.getElementById("dojo_r").value);
	if (valor!='') {
		document.getElementById('td_doc_r').innerHTML='*';
		document.getElementById('td_per_r').innerHTML='*';
		document.getElementById('td_exp_r').innerHTML='*';
		document.getElementById('td_nom_r').innerHTML='*';
		document.getElementById('td_ape_r').innerHTML='*';
		dijit.byId('i_dojo_'+(id_dojo+2).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+3).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+4).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+5).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+6).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+7).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('required', true);
		peticion=object();
		var fragment_url='../../Controlador/Control.php';
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									
																									datos=peticion.responseText.split('@@');
																									document.getElementById('accion_r').value='M';
																									document.getElementById('datos_ant_r').value=base64_encode("dir_identificacion="+datos[0]+"; dir_tipo_documento="+
																									datos[1]+"; dir_lugar_documento="+datos[2]+"; dir_digito_v="+datos[3]+" dir_tipo_persona="+datos[4]+
																									"; dir_apellidos="+datos[5]+"; dir_nombres="+datos[6]+"; dir_direccion="+datos[7]+"; dir_telefono="+datos[8]+
																									"; dir_correo="+datos[9]+"; dir_ciudad_direccion="+datos[10]+"; dir_barrio="+datos[11]+"; dir_fecha_nac="+
																									datos[12]+"; dir_lugar_nac="+datos[13]+"; dir_estado="+datos[14]);
																									
																									dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('value',datos[3]);
																									dijit.byId('i_dojo_'+(id_dojo+2).toString()).set('value',datos[1]);
																									dijit.byId('i_dojo_'+(id_dojo+3).toString()).set('value',datos[4]);
																									
																									if (datos[2]!='NULL'&&datos[2]!='') {
																										dijit.byId('i_dojo_'+(id_dojo+4).toString()).set('value',datos[2].substr(0,3));
																										cargarCiudad(depto_documento_r_store,'D',datos[2].substr(0,3));
																										dijit.byId('i_dojo_'+(id_dojo+5).toString()).set('value',datos[2].substr(0,5));
																										cargarCiudad(ciudad_documento_r_store,'C',datos[2].substr(0,5));
																										dijit.byId('i_dojo_'+(id_dojo+6).toString()).set('value',datos[2]);
																									}
																									
																									dijit.byId('i_dojo_'+(id_dojo+7).toString()).set('value',datos[6]);
																									dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('value',datos[5]);
																									dijit.byId('i_dojo_'+(id_dojo+9).toString()).set('value',datos[9]);
																									a_fecha=datos[12].split('-');
																									fecha=new Date(a_fecha[0],a_fecha[1]-1,a_fecha[2]);
																									dijit.byId('i_dojo_'+(id_dojo+10).toString()).set('value',fecha);
																									
																									dijit.byId('i_dojo_'+(id_dojo+11).toString()).set('value',datos[13].substr(0,3));
																									cargarCiudad(depto_nac_r_store,'D',datos[13].substr(0,3));
																									dijit.byId('i_dojo_'+(id_dojo+12).toString()).set('value',datos[13].substr(0,5));
																									cargarCiudad(ciudad_nac_r_store,'C',datos[13].substr(0,5));
																									dijit.byId('i_dojo_'+(id_dojo+13).toString()).set('value',datos[13]);
																									
																									dijit.byId('i_dojo_'+(id_dojo+14).toString()).set('value',datos[15]);
																									
																									if (datos[22]!='NULL'&&datos[22]!='') {
																										dijit.byId('i_dojo_'+(id_dojo+15).toString()).set('value',datos[22].substr(0,3));
																										cargarCiudad(depto_domicilio_r_store,'D',datos[22].substr(0,3));
																										dijit.byId('i_dojo_'+(id_dojo+16).toString()).set('value',datos[22].substr(0,5));
																										cargarCiudad(ciudad_domicilio_r_store,'C',datos[22].substr(0,5));
																										dijit.byId('i_dojo_'+(id_dojo+17).toString()).set('value',datos[22]);
																									}
																									
																									dijit.byId('i_dojo_'+(id_dojo+18).toString()).set('value',datos[16]);
																									
																									if (datos[23]!='NULL'&&datos[23]!='') {
																										dijit.byId('i_dojo_'+(id_dojo+19).toString()).set('value',datos[23].substr(0,3));
																										cargarCiudad(depto_correspondencia_r_store,'D',datos[23].substr(0,3));
																										dijit.byId('i_dojo_'+(id_dojo+20).toString()).set('value',datos[23].substr(0,5));
																										cargarCiudad(ciudad_correspondencia_r_store,'C',datos[23].substr(0,5));
																										dijit.byId('i_dojo_'+(id_dojo+21).toString()).set('value',datos[23]);
																									}
																									
																									dijit.byId('i_dojo_'+(id_dojo+22).toString()).set('value',datos[17]);
																									
																									if (datos[24]!='NULL'&&datos[24]!='') {
																										dijit.byId('i_dojo_'+(id_dojo+23).toString()).set('value',datos[24].substr(0,3));
																										cargarCiudad(depto_contacto_r_store,'D',datos[24].substr(0,3));
																										dijit.byId('i_dojo_'+(id_dojo+24).toString()).set('value',datos[24].substr(0,5));
																										cargarCiudad(ciudad_contacto_r_store,'C',datos[24].substr(0,5));
																										dijit.byId('i_dojo_'+(id_dojo+25).toString()).set('value',datos[24]);
																									}
																									
																									dijit.byId('i_dojo_'+(id_dojo+26).toString()).set('value',datos[18]);
																									dijit.byId('i_dojo_'+(id_dojo+27).toString()).set('value',datos[19]);
																									dijit.byId('i_dojo_'+(id_dojo+28).toString()).set('value',datos[20]);
																									dijit.byId('i_dojo_'+(id_dojo+29).toString()).set('value',datos[21]);
																									
																								} else {
																									document.getElementById('accion_r').value='A';
																									document.getElementById('datos_ant_r').value=base64_encode('');
																									dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+2).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+3).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+4).toString()).set('value','COL');
																									cargarCiudad(depto_documento_r_store,'D','COL');
																									dijit.byId('i_dojo_'+(id_dojo+5).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+6).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+7).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+9).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+10).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+11).toString()).set('value','COL');
																									cargarCiudad(depto_nac_r_store,'D','COL');
																									dijit.byId('i_dojo_'+(id_dojo+12).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+13).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+14).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+15).toString()).set('value','COL');
																									cargarCiudad(depto_domicilio_r_store,'D','COL');
																									dijit.byId('i_dojo_'+(id_dojo+16).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+17).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+18).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+19).toString()).set('value','COL');
																									cargarCiudad(depto_correspondencia_r_store,'D','COL');
																									dijit.byId('i_dojo_'+(id_dojo+20).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+21).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+22).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+23).toString()).set('value','COL');
																									cargarCiudad(depto_contacto_r_store,'D','COL');
																									dijit.byId('i_dojo_'+(id_dojo+24).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+25).toString()).set('value','');
																									
																									dijit.byId('i_dojo_'+(id_dojo+26).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+27).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+28).toString()).set('value','');
																									dijit.byId('i_dojo_'+(id_dojo+29).toString()).set('value','');
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	} else {
		document.getElementById('accion_r').value="";
		document.getElementById('datos_ant_r').value=base64_encode('');
		document.getElementById('td_doc_r').innerHTML='';
		document.getElementById('td_per_r').innerHTML='';
		document.getElementById('td_exp_r').innerHTML='';
		document.getElementById('td_nom_r').innerHTML='';
		document.getElementById('td_ape_r').innerHTML='';
		dijit.byId('i_dojo_'+(id_dojo+2).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+3).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+4).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+5).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+6).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+7).toString()).set('required', false);
		dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('required', false);
		document.getElementById('accion_r').value='I';
		dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+2).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+3).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+4).toString()).set('value','COL');
		cargarCiudad(depto_documento_r_store,'D','COL');
		dijit.byId('i_dojo_'+(id_dojo+5).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+6).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+7).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+9).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+10).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+11).toString()).set('value','COL');
		cargarCiudad(depto_nac_r_store,'D','COL');
		dijit.byId('i_dojo_'+(id_dojo+12).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+13).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+14).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+15).toString()).set('value','COL');
		cargarCiudad(depto_domicilio_r_store,'D','COL');
		dijit.byId('i_dojo_'+(id_dojo+16).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+17).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+18).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+19).toString()).set('value','COL');
		cargarCiudad(depto_correspondencia_r_store,'D','COL');
		dijit.byId('i_dojo_'+(id_dojo+20).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+21).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+22).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+23).toString()).set('value','COL');
		cargarCiudad(depto_contacto_r_store,'D','COL');
		dijit.byId('i_dojo_'+(id_dojo+24).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+25).toString()).set('value','');
		
		dijit.byId('i_dojo_'+(id_dojo+26).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+27).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+28).toString()).set('value','');
		dijit.byId('i_dojo_'+(id_dojo+29).toString()).set('value','');
	}
}

function datos_ciiu_directorio(valor) {
	
	var peticion=false,datos=new Array(),datos_cd=new Array(),suc=new Array(),ciu_suc=new Array(),datos_cc=new Array(),datos_co=new Array(),c=0,o=0,
	fragment_url='../../Controlador/Control.php',envio='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								datos=peticion.responseText.split('##');
																								
																								for (icd=0;icd<datos.length;icd++) {
																									datos_cd=datos[icd].split('@@');
																									
																									
																									if (datos_cd[2]=='COL'){
																										datos_cc[c]=datos[icd];
																										c++;
																									} else {
																										datos_co[o]=datos[icd];
																										o++;
																									}
																								}
																								
																								for (icd=0;icd<datos_cc.length;icd++) {
																									datos_cd=datos_cc[icd].split('@@');
																										
																									if (!document.getElementById('tr_ciiu_'+(icd+1).toString())) add_ciiu();
																									
																									document.getElementById('v_ciiu_'+(icd+1).toString()).value='S';
																									document.getElementById('tr_ciiu_'+(icd+1).toString()).style.display='';
																									document.getElementById('accion_ci_'+(icd+1).toString()).value='M';
																									document.getElementById('datos_ant_ci_'+(icd+1).toString()).value=base64_encode('cdi_identificacion='+
																									datos_cd[0]+'; cdi_ciiu='+datos_cd[1]+'; cdi_lugar='+datos_cd[2]+'; cdi_principal='+datos_cd[3]);
																									dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('value',datos_cd[1]);
																									dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('value',datos_cd[1]);
																									dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('disabled',true);
																									if (datos_cd[3]=='t') {
																										dijit.byId(document.getElementById('n_pri_ci_'+(icd+1).toString()).value).set('checked',true);
																										document.getElementById('cd_principal').value=datos_cd[1];
																									} else {
																										dijit.byId(document.getElementById('n_pri_ci_'+(icd+1).toString()).value).set('checked',false);
																									}
																									dijit.byId(document.getElementById('n_eli_ci_'+(icd+1).toString()).value).set('disabled',true);
																									document.getElementById('td_v_ciiu_'+(icd+1).toString()).innerHTML=datos_cd[5];
																								}
																								
																								if (datos_cc.length==0) {
																									icd=0;
																									while (document.getElementById('tr_ciiu_'+(icd+1).toString())) {
																										document.getElementById('accion_ci_'+(icd+1).toString()).value='A';
																										document.getElementById('datos_ant_ci_'+(icd+1).toString()).value=base64_encode('');
																										dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('value','');
																										dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('value','');
																										dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('disabled',false);
																										document.getElementById('cd_principal').value='';
																										dijit.byId(document.getElementById('n_pri_ci_'+(icd+1).toString()).value).set('checked',false);
																										dijit.byId(document.getElementById('n_eli_ci_'+(icd+1).toString()).value).set('disabled',false);
																										document.getElementById('td_v_ciiu_'+(icd+1).toString()).innerHTML='';
																									}
																								}
																								
																								for (icd=0;icd<datos_co.length;icd++) {
																									datos_cd=datos_co[icd].split('@@');
																									
																									if (!document.getElementById('tr_ciiu_ci_'+(icd+1).toString())) add_ciiu_ci();
																									
																									document.getElementById('v_ciiu_ci_'+(icd+1).toString()).value='S';
																									document.getElementById('tr_ciiu_ci_'+(icd+1).toString()).style.display='';
																									document.getElementById('accion_ci_ci_'+(icd+1).toString()).value='M';
																									document.getElementById('datos_ant_ci_ci_'+(icd+1).toString()).value=base64_encode('cdi_identificacion='+
																									datos_cd[0]+'; cdi_ciiu='+datos_cd[1]+'; cdi_lugar='+datos_cd[2]+'; cdi_principal='+datos_cd[3]);
																									
																									dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('value',datos_cd[2]);
																									dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																									cargarCombo(dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).store,
																											'../../Stores/comboCIIU.php?lugar='+datos_cd[2]+'&where=');
																									dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('value',datos_cd[1]);
																									dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('value',datos_cd[1]);
																									dijit.byId(document.getElementById('n_eli_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('name','principal_ci_'+
																									datos_cd[2]);
																									
																									if (datos_cd[3]=='t') {
																										dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',true);
																									} else {
																										dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																									}
																									
																									document.getElementById('td_v_ciiu_ci_'+(icd+1).toString()).innerHTML=datos_cd[5];
																								}
																								
																								if (datos_co.length==0) {
																									icd=0;
																									while (document.getElementById('tr_ciiu_ci_'+(icd+1).toString())) {
																										document.getElementById('accion_ci_ci_'+(icd+1).toString()).value='A';
																										document.getElementById('datos_ant_ci_ci_'+(icd+1).toString()).value=base64_encode('');
																										dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('value','');
																										dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('value','');
																										dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('value','');
																										dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_eli_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																										document.getElementById('td_v_ciiu_ci_'+(icd+1).toString()).innerHTML='';
																										icd++;
																									}
																								}
																							} else {
																								icd=0;
																								while (document.getElementById('tr_ciiu_'+(icd+1).toString())) {
																									document.getElementById('accion_ci_'+(icd+1).toString()).value='A';
																									document.getElementById('datos_ant_ci_'+(icd+1).toString()).value=base64_encode('');
																									dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_cd_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_nom_ci_'+(icd+1).toString()).value).set('disabled',false);
																									document.getElementById('cd_principal').value='';
																									dijit.byId(document.getElementById('n_pri_ci_'+(icd+1).toString()).value).set('checked',false);
																									dijit.byId(document.getElementById('n_eli_ci_'+(icd+1).toString()).value).set('disabled',false);
																									document.getElementById('td_v_ciiu_'+(icd+1).toString()).innerHTML='';
																									icd++;
																								}
																									
																								icd=0;
																								while (document.getElementById('tr_ciiu_ci_'+(icd+1).toString())) {
																									document.getElementById('accion_ci_ci_'+(icd+1).toString()).value='A';
																									document.getElementById('datos_ant_ci_ci_'+(icd+1).toString()).value=base64_encode('');
																									dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_lug_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_eli_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_cd_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_nom_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																									document.getElementById('td_v_ciiu_ci_'+(icd+1).toString()).innerHTML='';
																									icd++;
																								}
																							}
																							//datos_doc_proveedores(valor);
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarCiiuDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function cambio_persona(valor) {
	if (valor=='J') {
		document.getElementById('tr_apellidos').style.display='none';
		document.getElementById('t_rep').style.display='';
		document.getElementById('d_rep').style.display='none';
		document.getElementById('fc_nac').innerHTML='Fecha de Creaci&oacute;n';
		document.getElementById('lu_nac').innerHTML='Lugar de Creaci&oacute;n';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n*';
		document.getElementById('td_nm').innerHTML='Raz&oacute;n Social*';
		dijit.byId('i_dojo_3').set('required', true);
		dijit.byId('i_dojo_10').set('value','');
	} else {
		document.getElementById('tr_apellidos').style.display='';
		document.getElementById('t_rep').style.display='none';
		document.getElementById('d_rep').style.display='';
		document.getElementById('fc_nac').innerHTML='Fecha de Nacimiento';
		document.getElementById('lu_nac').innerHTML='Lugar de Nacimiento';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n';
		document.getElementById('td_nm').innerHTML='Nombre*';
		dijit.byId('i_dojo_3').set('required', false);
		
	}
}

function cambio_prof() {
	if (dijit.byId('i_dojo_39').value=='COMUN'&&dijit.byId('i_dojo_5').value=='N') {
		document.getElementById('td_prof_lib_1').style.display='';
		document.getElementById('td_prof_lib_2').style.display='';
	} else {
		document.getElementById('td_prof_lib_1').style.display='none';
		document.getElementById('td_prof_lib_2').style.display='none';
		dijit.byId('i_dojo_45').set('value', 'f');
		
	}
}

function cambio_persona_r(valor) {
	var id_dojo=0;
	id_dojo=parseInt(document.getElementById("dojo_r").value);
	if (valor=='J') {
		document.getElementById('tr_apellidos_r').style.display='none';
		document.getElementById('fc_nac_r').innerHTML='Fecha de Creaci&oacute;n';
		document.getElementById('lu_nac_r').innerHTML='Lugar de Creaci&oacute;n';
		document.getElementById('id_dv_r').innerHTML='Digito Verificaci&oacute;n*';
		document.getElementById('td_nm_r').innerHTML='Raz&oacute;n Social*';
		dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('value','');
	} else {
		document.getElementById('tr_apellidos_r').style.display='';
		document.getElementById('fc_nac_r').innerHTML='Fecha de Nacimiento';
		document.getElementById('lu_nac_r').innerHTML='Lugar de Nacimiento';
		document.getElementById('id_dv_r').innerHTML='Digito Verificaci&oacute;n';
		document.getElementById('td_nm_r').innerHTML='Nombre*';
		dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('required', false);
	}
}

function add_suc() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_suc").value);
	filas++;
	document.getElementById("filas_suc").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("t_sucursales");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_dir_suc_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		var td=document.createElement("td");
		td.setAttribute("class","texto_negrilla");
		tr.appendChild(td);
		td.innerHTML='Direcci&oacute;n*';
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","n_dir_suc_"+filas);
		campo.setAttribute("id","n_dir_suc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'i_dojo_'+filas_d);
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_suc_"+filas);
		campo.setAttribute("id","v_suc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({name:'dir_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 600px;",
			promptMessage:"Digite la direcci&oacute;n de la sucursal.",required:true,tooltipPosition:"above,below",trim:true,uppercase:true,maxLength:"100"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		var onclic=function anonymous() {add_suc();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+filas_d.toString(),id:'i_dojo_'+(filas_d+1).toString(),
		position:"above, below",label:"Adicionar una fila para sucursal."});
		
		filas_d+=2;
		
		onclic=function anonymous() {eli_suc(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+filas_d.toString(),id:'i_dojo_'+(filas_d+1).toString(),
		position:"above, below",label:"Eliminar una fila para sucursal."});
		
		filas_d+=2;
		
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_lug_suc_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","texto_negrilla");
		tr.appendChild(td);
		td.innerHTML='Lugar*';
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		tr.appendChild(td);
		
		var store_p=new dojo.data.ItemFileReadStore({jsId:'pais_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=P',
			urlPreventCache:false,clearOnClose:true});
		var store_d=new dojo.data.ItemFileReadStore({jsId:'depto_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=D&codigo=COL',
			urlPreventCache:false,clearOnClose:true});
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciudad_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=C',
			urlPreventCache:false,clearOnClose:true});
		
		onchan=function anonymous() {cargarCiudad(store_d,'D',arguments[0]);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'pais_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione pais de sucursal",promptMessage:"Seleccione el pais de la sucursal.",required:true,store:store_p,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",
			onChange:onchan,value:'COL'});
		td.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='&nbsp;';
		
		filas_d++;
		
		onchan=function anonymous() {cargarCiudad(store_c,'C',arguments[0]);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'depto_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione depto. de sucursal",promptMessage:"Seleccione el departamento de la sucursal.",required:true,store:store_d,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='&nbsp;';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_ciu_suc_"+filas);
		campo.setAttribute("id","n_ciu_suc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'i_dojo_'+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione ciudad de sucursal",promptMessage:"Seleccione la ciudad de la sucursal.",required:true,store:store_c,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
	} else {
		var tabla=document.getElementById("t_sucursales");
		var tr=document.createElement("<tr id='tr_dir_suc_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		var td=document.createElement("<td class='texto_negrilla'>");
		tr.appendChild(td);
		td.innerHTML='Direcci&oacute;n*';
		
		td=document.createElement("<td class='texto_mayus'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='n_dir_suc_"+filas+"' id='n_dir_suc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var campo=document.createElement("<input name='v_suc_"+filas+"' id='v_suc_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({name:'dir_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 600px;",
			promptMessage:"Digite la direcci&oacute;n de la sucursal.",required:true,tooltipPosition:"above,below",trim:true,uppercase:true,maxLength:"100"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		var onclic=function anonymous() {add_suc();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+filas_d.toString(),id:'i_dojo_'+(filas_d+1).toString(),
		position:"above, below",label:"Adicionar una fila para sucursal."});
		
		filas_d+=2;
		
		onclic=function anonymous() {eli_suc(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+filas_d.toString(),id:'i_dojo_'+(filas_d+1).toString(),
		position:"above, below",label:"Eliminar una fila para sucursal."});
		
		filas_d+=2;
		
		var tr=document.createElement("<tr id='tr_lug_suc_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='texto_negrilla'>");
		tr.appendChild(td);
		td.innerHTML='Lugar*';
		
		td=document.createElement("<td class='texto_mayus'>");
		tr.appendChild(td);
		
		var store_p=new dojo.data.ItemFileReadStore({jsId:'pais_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=P',
			urlPreventCache:false,clearOnClose:true});
		var store_d=new dojo.data.ItemFileReadStore({jsId:'depto_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=D&codigo=COL',
			urlPreventCache:false,clearOnClose:true});
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciudad_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=C',
			urlPreventCache:false,clearOnClose:true});
		
		onchan=function anonymous() {cargarCiudad(store_d,'D',arguments[0]);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'pais_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione pais de sucursal",promptMessage:"Seleccione el pais de la sucursal.",required:true,store:store_p,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",
			onChange:onchan,value:'COL'});
		td.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='&nbsp;';
		
		filas_d++;
		
		onchan=function anonymous() {cargarCiudad(store_c,'C',arguments[0]);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'depto_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione depto. de sucursal",promptMessage:"Seleccione el departamento de la sucursal.",required:true,store:store_d,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='&nbsp;';
		
		filas_d++;
		
		campo=document.createElement("<input name='n_ciu_suc_"+filas+"' id='n_ciu_suc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione ciudad de sucursal",promptMessage:"Seleccione la ciudad de la sucursal.",required:true,store:store_c,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function eli_suc(no_id) {
	document.getElementById("v_suc_"+no_id).value='N';
	document.getElementById("tr_dir_suc_"+no_id).style.display='none';
	document.getElementById("tr_lug_suc_"+no_id).style.display='none';
}

function add_ciiu() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_ciiu").value);
	filas++;
	document.getElementById("filas_ciiu").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("t_ciiu");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_ciiu_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_der");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_ci_"+filas);
		campo.setAttribute("id","accion_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","A");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_ci_"+filas);
		campo.setAttribute("id","datos_ant_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_ciiu_"+filas);
		campo.setAttribute("id","v_ciiu_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_cd_ci_"+filas);
		campo.setAttribute("id","n_cd_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		var fd3=filas_d+2;
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"10", style:"width: 10em;", name:"cd_ciiu_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo CIIU.", required:true, tooltipPosition:"above, below",onChange: onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_nom_ci_"+filas);
		campo.setAttribute("id","n_nom_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciiu_'+filas+'_store',url:'../../Stores/comboCIIU.php?lugar=COL&where=',
			urlPreventCache:false,clearOnClose:true});
		
		var fd=filas_d-1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);consulta_ciiu('td_v_ciiu_',filas,this.value,'COL');};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciiu_'+filas,id:'i_dojo_'+filas_d,style:"width: 500px;",
			placeHolder:"Seleccione CIIU",promptMessage:"Seleccione actividad econ&oacute;mica.",required:true,store:store_c,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pri_ci_"+filas);
		campo.setAttribute("id","n_pri_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd2=filas_d-1;
		
		onclic=function anonymous() {if (this.checked) document.getElementById('cd_principal').value=dijit.byId('i_dojo_'+fd2.toString()).value};
		
		campo_dojo=new dijit.form.RadioButton({name:"principal", id:"i_dojo_"+filas_d, onClick: onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_ciiu();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para ciiu."});
		
		filas_d++;
		
		onclic=function anonymous() {eli_ciiu(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_ci_"+filas);
		campo.setAttribute("id","n_eli_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		filas_d++;
		
		tr=document.createElement("tr");
		tr.setAttribute("id","tr_v_ciiu_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","info");
		td.setAttribute("colspan","4");
		td.setAttribute("id","td_v_ciiu_"+filas.toString());
		tr.appendChild(td);
		
	} else {
		var tabla=document.getElementById("t_ciiu");
		var tr=document.createElement("<tr id='tr_ciiu_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_ci_"+filas+"' id='accion_ci_"+filas.toString()+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_ci_"+filas+"' id='datos_ant_ci_"+filas.toString()+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_ciiu_"+filas+"' id='v_ciiu_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_cd_ci_"+filas+"' id='n_cd_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);consulta_ciiu('td_v_ciiu_',filas,this.value,'COL');};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"10", style:"width: 10em;", name:"cd_ciiu_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo CIIU.", required:true, tooltipPosition:"above, below",
		onChange: onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_nom_ci_"+filas+"' id='n_nom_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciiu_'+filas+'_store',url:'../../Stores/comboCIIU.php?lugar=COL&where=',
			urlPreventCache:false,clearOnClose:true});
		
		var fd=filas_d-1;
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciiu_'+filas,id:'i_dojo_'+filas_d,style:"width: 500px;",
			placeHolder:"Seleccione CIIU",promptMessage:"Seleccione actividad econ&oacute;mica.",required:true,store:store_c,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_pri_ci_"+filas+"' id='n_pri_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		onclic=function anonymous() {if (this.checked) document.getElementById('cd_principal').value=this.value};
		
		campo_dojo=new dijit.form.RadioButton({name:"principal", id:"i_dojo_"+filas_d, onClick: onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_ciiu();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para ciiu."});
		
		filas_d++;
		
		campo=document.createElement("<input name='n_eli_ci_"+filas+"' id='n_eli_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_ciiu(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		filas_d++;
		
		tr=document.createElement("<tr id='tr_v_ciiu_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='info' colspan='4' id='td_v_ciiu_"+filas.toString()+"'>");
		tr.appendChild(td);
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function eli_ciiu(no_id) {
	document.getElementById("v_ciiu_"+no_id).value='N';
	document.getElementById("tr_ciiu_"+no_id).style.display='none';
	document.getElementById("tr_v_ciiu_"+no_id).style.display='none';
}

function add_ciiu_ci() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_ciiu_ci").value);
	filas++;
	document.getElementById("filas_ciiu_ci").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("t_ciiu_ci");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_ciiu_ci_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_ci_ci_"+filas);
		campo.setAttribute("id","accion_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","A");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_ci_ci_"+filas);
		campo.setAttribute("id","datos_ant_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_ciiu_ci_"+filas);
		campo.setAttribute("id","v_ciiu_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_lug_ci_ci_"+filas);
		campo.setAttribute("id","n_lug_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciiu_ci_'+filas+'_store',url:'../../Stores/comboCIIU.php?lugar=&where=',
			urlPreventCache:false,clearOnClose:true});
		var store_l=new dojo.data.ItemFileReadStore({jsId:'ciudad_ciiu_ci_'+filas+'_store',urlPreventCache:false,clearOnClose:true,
			url:'../../Stores/comboLugares.php?tipo=C&codigo=COL&where=and length(l.lug_codigo)=8'});
		
		var fd4=filas_d+2;
		var fd5=filas_d;
		var fd3=filas_d+3;
		
		onchan=function anonymous() {cargarCombo(store_c,'../../Stores/comboCIIU.php?lugar='+arguments[0]+'&where=');
		cambio_rb(this.value,dijit.byId('i_dojo_'+fd3.toString()));};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_ciiu_ci_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione ciudad",promptMessage:"Seleccione la ciudad de actividad econ&oacute;mica.",required:true,store:store_l,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_der");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_cd_ci_ci_"+filas);
		campo.setAttribute("id","n_cd_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"10", style:"width: 10em;", name:"cd_ciiu_ci_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo CIIU.", required:true, tooltipPosition:"above, below",
		onChange: onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_nom_ci_ci_"+filas);
		campo.setAttribute("id","n_nom_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd=filas_d-1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);
		consulta_ciiu('td_v_ciiu_ci_',filas,this.value,dijit.byId('i_dojo_'+fd5.toString()).value);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciiu_ci_'+filas,id:'i_dojo_'+filas_d,style:"width: 400px;",
			placeHolder:"Seleccione CIIU",promptMessage:"Seleccione actividad econ&oacute;mica.",required:true,store:store_c,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pri_ci_ci_"+filas);
		campo.setAttribute("id","n_pri_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var onclic=function anonymous() {sel_rb(this);};
		
		campo_dojo=new dijit.form.RadioButton({name:"principal_ci", id:"i_dojo_"+filas_d,onClick:onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_ciiu_ci();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para ciiu."});
		
		filas_d++;
		
		onclic=function anonymous() {eli_ciiu_ci(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;

		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_ci_ci_"+filas);
		campo.setAttribute("id","n_eli_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		filas_d++;
		
		tr=document.createElement("tr");
		tr.setAttribute("id","tr_v_ciiu_ci_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","info");
		td.setAttribute("colspan","4");
		td.setAttribute("id","td_v_ciiu_ci_"+filas.toString());
		tr.appendChild(td);
	} else {
		var tabla=document.getElementById("t_ciiu_ci");
		var tr=document.createElement("<tr id='tr_ciiu_ci_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_ci_ci_"+filas+"' id='accion_ci_ci_"+filas.toString()+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_ci_ci_"+filas+"' id='datos_ant_ci_ci_"+filas.toString()+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_ciiu_ci_"+filas+"' id='v_ciiu_ci_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_lug_ci_ci_"+filas+"' id='n_lug_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciiu_ci_'+filas+'_store',url:'../../Stores/comboCIIU.php?lugar=&where=',
			urlPreventCache:false,clearOnClose:true});
		var store_l=new dojo.data.ItemFileReadStore({jsId:'ciudad_ciiu_ci_'+filas+'_store',urlPreventCache:false,clearOnClose:true,
			url:'../../Stores/comboLugares.php?tipo=C&codigo=COL&where=and length(l.lug_codigo)=8'});
		
		var fd4=filas_d+2;
		var fd5=filas_d;
		var fd3=filas_d+3;
		
		onchan=function anonymous() {cargarCombo(store_c,'../../Stores/comboCIIU.php?lugar='+arguments[0]+'&where=');
		cambio_rb(this.value,dijit.byId('i_dojo_'+fd3.toString()));};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_ciiu_ci_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione ciudad",promptMessage:"Seleccione la ciudad de actividad econ&oacute;mica.",required:true,store:store_l,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		filas_d++;
		
		campo=document.createElement("<input name='n_cd_ci_"+filas+"' id='n_cd_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"10", style:"width: 10em;", name:"cd_ciiu_ci_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo CIIU.", required:true, tooltipPosition:"above, below",
		onChange: onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_nom_ci_ci_"+filas+"' id='n_nom_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var fd=filas_d-1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);
		consulta_ciiu('td_v_ciiu_ci_',filas,this.value,dijit.byId('i_dojo_'+fd5.toString()).value);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciiu_ci_'+filas,id:'i_dojo_'+filas_d,style:"width: 400px;",
			placeHolder:"Seleccione CIIU",promptMessage:"Seleccione actividad econ&oacute;mica.",required:true,store:store_c,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_pri_ci_ci_"+filas+"' id='n_pri_ci_ci_"+filas.toString()+" type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var onclic=function anonymous() {sel_rb(this);};
		
		campo_dojo=new dijit.form.RadioButton({name:"principal_ci", id:"i_dojo_"+filas_d,onClick:onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_ciiu_ci();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para ciiu."});
		
		filas_d++;
		
		campo=document.createElement("<input name='n_eli_ci_ci_"+filas+"' id='n_eli_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_ciiu_ci(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		
		tr=document.createElement("<tr id='tr_v_ciiu_ci_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='info' colspan='4' id='td_v_ciiu_ci_"+filas.toString()+"'>");
		tr.appendChild(td);
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function cambio_rb(valor,campo) {
	campo.set('name','principal_ci_'+valor);
	campo.set('checked',false);
}

function sel_rb(campo) {
	i=1;
	while (document.getElementById('n_pri_ci_ci_'+i)) {
		if (document.getElementById('v_ciiu_ci_'+i).value=='S') {
			if (campo.id!=dijit.byId(document.getElementById('n_pri_ci_ci_'+i).value).id&&
			campo.name==dijit.byId(document.getElementById('n_pri_ci_ci_'+i).value).name) dijit.byId(document.getElementById('n_pri_ci_ci_'+i).value).set('checked',
					false);
		}
		i++;
	}
}

function eli_ciiu_ci(no_id) {
	document.getElementById("v_ciiu_ci_"+no_id).value='N';
	document.getElementById("tr_ciiu_ci_"+no_id).style.display='none';
	document.getElementById("tr_v_ciiu_ci_"+no_id).style.display='none';
}

function consulta_ciiu(nm_id,no_id,ciiu,lugar) {
	if (ciiu!=''&&lugar!='') {
		var peticion=false,a_fecha=new Array(),fecha;
		peticion=object();
		var fragment_url='../../Controlador/Control.php';
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									datos=peticion.responseText.split('@@');
																									document.getElementById(nm_id+no_id).innerHTML=datos[4];
																									if (lugar=='COL') consulta_ciiu_ciudad(ciiu);
																								} else {
																									document.getElementById(nm_id+no_id).innerHTML='';
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarCiiu')+'&list_t_ciiu='+base64_encode(ciiu)+'&list_t_lugar='+base64_encode(lugar)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function add_doc_pr() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_doc_pr").value);
	filas++;
	document.getElementById("filas_doc_pr").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("t_doc_pr");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_doc_pr_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_do_"+filas);
		campo.setAttribute("id","accion_do_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","A");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_do_"+filas);
		campo.setAttribute("id","datos_ant_do_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_doc_pr_"+filas);
		campo.setAttribute("id","v_doc_pr_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_tp_do_"+filas);
		campo.setAttribute("id","n_tp_do_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'tipo_doc_pr_'+filas+'_store',url:'../../Stores/comboParametros.php?parametro=TDCPR&where=',
			urlPreventCache:false,clearOnClose:true});
		
		campo_dojo=new dijit.form.FilteringSelect({name:'tipo_doc_pr_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione tipo de documento",promptMessage:"Seleccione el tipo de documento.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_cen");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_fc_doc_"+filas);
		campo.setAttribute("id","n_fc_doc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.DateTextBox({maxLength:"10", style:"width: 8em;", name:"fc_doc_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite la fecha de documento<br>(dd/mm/aaaa).", required:true, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_num_doc_"+filas);
		campo.setAttribute("id","n_num_doc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 14em;", name:"num_doc_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el n&uacute;mero de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_det_doc_"+filas);
		campo.setAttribute("id","n_det_doc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"50", style:"width: 30em;", name:"det_doc_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el detalle de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_doc_pr();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para documentos."});
		
		filas_d++;
		
		onclic=function anonymous() {eli_doc_pr(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para documentos."});
		filas_d++;
	} else {
		var tabla=document.getElementById("t_doc_pr");
		var tr=document.createElement("<tr id='tr_doc_pr_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_do_"+filas+"' id='accion_do_"+filas.toString()+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_do_"+filas+"' id='datos_ant_do_"+filas.toString()+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_doc_pr_"+filas+"' id='v_doc_pr_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_tp_do_"+filas+"' id='n_tp_do_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'tipo_doc_pr_'+filas+'_store',url:'../../Stores/comboParametros.php?parametro=TDCPR&where=',
			urlPreventCache:false,clearOnClose:true});
		
		campo_dojo=new dijit.form.FilteringSelect({name:'tipo_doc_pr_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione tipo de documento",promptMessage:"Seleccione el tipo de documento.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='alineado_cen' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_fc_doc_"+filas+"' id='n_fc_doc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.DateTextBox({maxLength:"10", style:"width: 8em;", name:"fc_doc_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite la fecha de documento<br>(dd/mm/aaaa).", required:true, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_num_doc_"+filas+"' id='n_num_doc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 14em;", name:"num_doc_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el n&uacute;mero de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_det_doc_"+filas+"' id='n_det_doc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"50", style:"width: 30em;", name:"det_doc_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el detalle de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_doc_pr();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para documentos."});
		
		filas_d++;
		
		onclic=function anonymous() {eli_doc_pr(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para documentos."});
		filas_d++;
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function consulta_ciiu_ciudad(ciiu) {
	if (ciiu!=''&&dijit.byId('i_dojo_19').value!='') {
		var peticion=false,fl_ciiu=true,fl_crea=true;
		peticion=object();
		var fragment_url='../../Controlador/Control.php';
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
			if (peticion.readyState == 4) {
				if (peticion.responseText!='') {
					i=1;
					while (document.getElementById('n_cd_ci_ci_'+i)) {
						if (document.getElementById('v_ciiu_ci_'+i).value=='S') {
							if (dijit.byId('i_dojo_19').value==dijit.byId(document.getElementById('n_lug_ci_ci_'+i).value).value) {
								if (dijit.byId(document.getElementById('n_cd_ci_ci_'+i).value).value==ciiu) fl_ciiu=false
							}
						}
						i++;
					}
					
					if (fl_ciiu) {
						i=1;
						while (document.getElementById('n_cd_ci_ci_'+i)) {
							if (document.getElementById('v_ciiu_ci_'+i).value=='S') {
								if (dijit.byId('i_dojo_17').value==dijit.byId(document.getElementById('n_lug_ci_ci_'+i).value).value) {
									if (dijit.byId('i_dojo_'+document.getElementById('n_cd_ci_ci_'+i).value).value=='') {
										dijit.byId('i_dojo_'+document.getElementById('n_cd_ci_ci_'+i).value).set('value',ciiu);
										fl_crea=false;
									}
								}
							}
							i++;
						}
						
						if (fl_crea) {
							add_ciiu_ci();
							dijit.byId(document.getElementById('n_lug_ci_ci_'+document.getElementById("filas_ciiu_ci").value).value).set('value',dijit.byId('i_dojo_19').value);
							cargarCombo(dijit.byId(document.getElementById('n_nom_ci_ci_'+document.getElementById("filas_ciiu_ci").value).value).store,
									'../../Stores/comboCIIU.php?lugar='+dijit.byId('i_dojo_19').value+'&where=');
							dijit.byId(document.getElementById('n_cd_ci_ci_'+document.getElementById("filas_ciiu_ci").value).value).set('value',ciiu);
						}
						
					}
				}
			}
		};
		
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarCiiu')+'&list_t_ciiu='+base64_encode(ciiu)+'&list_t_lugar='+base64_encode(dijit.byId('i_dojo_19').value)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function cambio_ciudad_ciiu() {
	var i=1
	while (document.getElementById('n_cd_ci_'+i)) {
		if (document.getElementById('v_ciiu_'+i).value=='S') {
			consulta_ciiu_ciudad(dijit.byId(document.getElementById('n_cd_ci_'+i).value).value);
		}
		i++;
	}
}

function eli_doc_pr(no_id) {
	document.getElementById("v_doc_pr_"+no_id).value='N';
	document.getElementById("tr_doc_pr_"+no_id).style.display='none';
}

function act_proveedor() {
	if (!valida(dijit.byId('i_dojo_2'), 'Por favor digite el n&uacute;mero de identificaci&oacute;n del proveedor.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
	if (dijit.byId('i_dojo_5').value=='J') {
		if (!valida(document.getElementById('i_dojo_3'), 'Por favor digite el digito de verificaci&oacute;n del proveedor.',false)) {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
			return false;
		}
	}
	
	if (document.getElementById('i_dojo_3').getAttribute("aria-invalid")=='true') {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		foco(document.getElementById('i_dojo_3'));
		mensaje_dj('ERROR','El digito de verificaci&oacute;n no es valido.','OK','ERROR','',document.getElementById('i_dojo_3'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_4'), 'Por favor seleccione el tipo de documento del proveedor.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_8'), 'Por favor seleccione el lugar de expedici&oacute;n del documento del proveedor.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_9'), 'Por favor digite el nombre del proveedor.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
	if (dijit.byId('i_dojo_5').value!='J') {
		if (!valida(dijit.byId('i_dojo_10'), 'Por favor digite los apellidos del proveedor.',false)) {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
			return false;
		}
	}
	
	if (!validaCorreo(dijit.byId('i_dojo_11'))) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
	if (document.getElementById('i_dojo_12').getAttribute("aria-invalid")=='true') {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		foco(document.getElementById('i_dojo_12'));
		mensaje_dj('ERROR','La fecha de nacimiento no es valida.','OK','ERROR','',document.getElementById('i_dojo_12'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_39'), 'Por favor seleccione el tipo de r&eacute;gimen.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_37'));
		return false;
	}
	
	i=1;
	while (document.getElementById('n_dir_suc_'+i)) {
		if (document.getElementById('v_suc_'+i).value=='S') {
			if (!valida(dijit.byId(document.getElementById('n_dir_suc_'+i).value), 'Por favor digite la direcci&oacute;n de la sucursal.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_37'));
				return false;
			}
			if (!valida(dijit.byId(document.getElementById('n_ciu_suc_'+i).value), 'Por favor digite la direcci&oacute;n de la sucursal.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_37'));
				return false;
			}
		}
		i++;
	}
	
	id_dojo_r=parseInt(document.getElementById("dojo_r").value);
	
	if (dijit.byId('i_dojo_'+id_dojo_r.toString()).value!='') {
	
		if (dijit.byId('i_dojo_'+(id_dojo_r+3).toString()).value=='J') {
			if (!valida(document.getElementById('i_dojo_'+(id_dojo_r+1).toString()), 'Por favor digite el digito de verificaci&oacute;n del representante legal.',false)){
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
				return false;
			}
		}
		
		if (!valida(dijit.byId('i_dojo_'+(id_dojo_r+2).toString()), 'Por favor seleccione el tipo de documento del representante legal.',false)) {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
			return false;
		}
		
		if (!valida(dijit.byId('i_dojo_'+(id_dojo_r+6).toString()), 'Por favor seleccione el lugar de expedici&oacute;n del documento del representante legal.',false)){
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
			return false;
		}
		
		if (!valida(dijit.byId('i_dojo_'+(id_dojo_r+7).toString()), 'Por favor digite el nombre del representante legal.',false)) {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
			return false;
		}
		
		if (dijit.byId('i_dojo_'+(id_dojo_r+3).toString()).value!='J') {
			if (!valida(dijit.byId('i_dojo_'+(id_dojo_r+8).toString()), 'Por favor digite los apellidos del representante legal.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
				return false;
			}
		}
		
		if (!validaCorreo(dijit.byId('i_dojo_'+(id_dojo_r+9).toString()))) {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
			return false;
		}
		
		if (document.getElementById('i_dojo_'+(id_dojo_r+10).toString()).getAttribute("aria-invalid")=='true') {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
			foco(document.getElementById('i_dojo_'+(id_dojo_r+10).toString()));
			mensaje_dj('ERROR','La fecha de nacimiento no es valida.','OK','ERROR','',document.getElementById('i_dojo_'+(id_dojo_r+10).toString()));
			return false;
		}
	}
	
	i=1;
	fl_pri=false;
	vl_pri=0;
	while (document.getElementById('n_cd_ci_'+i)) {
		if (document.getElementById('v_ciiu_'+i).value=='S') {
			vl_pri++;
			if (!valida(dijit.byId(document.getElementById('n_nom_ci_'+i).value), 'Por favor seleccione la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
				return false;
			}
			
			if (dijit.byId(document.getElementById('n_pri_ci_'+i).value).checked) fl_pri=true;
			j=1;
			while (document.getElementById('n_cd_ci_'+j)) {
				if (document.getElementById('v_ciiu_'+j).value=='S') {
					if (dijit.byId(document.getElementById('n_nom_ci_'+i).value).id!=dijit.byId(document.getElementById('n_nom_ci_'+j).value).id) {
						if (dijit.byId(document.getElementById('n_nom_ci_'+i).value).value==dijit.byId(document.getElementById('n_nom_ci_'+j).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
							foco(dijit.byId(document.getElementById('n_nom_ci_'+j)));
							mensaje_dj('ERROR','Se encuentra repetida la actividad econ&oacute;mica.','OK','ERROR','',dijit.byId(document.getElementById('n_nom_ci_'+j)));
							return false;
						}
					}
				}
				j++;
			}
		}
		i++;
	}
	
	if (vl_pri>0&&!fl_pri) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
		foco(dijit.byId(document.getElementById('n_pri_ci_1')));
		mensaje_dj('ERROR','No se escogio la actividad econ&oacute;mica principal.','OK','ERROR','',dijit.byId(document.getElementById('n_pri_ci_1')));
		return false;
	}
	
	i=1;
	while (document.getElementById('n_cd_ci_ci_'+i)) {
		if (document.getElementById('v_ciiu_ci_'+i).value=='S') {
			if (!valida(dijit.byId(document.getElementById('n_lug_ci_ci_'+i).value), 'Por favor seleccione el lugar de la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
				return false;
			}
			
			if (!valida(dijit.byId(document.getElementById('n_nom_ci_ci_'+i).value), 'Por favor seleccione la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
				return false;
			}
			
			j=1;
			while (document.getElementById('n_cd_ci_ci_'+j)) {
				if (document.getElementById('v_ciiu_ci_'+j).value=='S') {
					if (dijit.byId(document.getElementById('n_lug_ci_ci_'+i).value).id!=dijit.byId(document.getElementById('n_lug_ci_ci_'+j).value).id) {
						if (dijit.byId(document.getElementById('n_lug_ci_ci_'+i).value).value==dijit.byId(document.getElementById('n_lug_ci_ci_'+j).value).value&&
								dijit.byId(document.getElementById('n_nom_ci_ci_'+i).value).value==dijit.byId(document.getElementById('n_nom_ci_ci_'+j).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
							foco(dijit.byId(document.getElementById('n_nom_ci_'+i)));
							mensaje_dj('ERROR','El lugar y la actividad econ&oacute;mica se encuentran repetidas.','OK','ERROR','',
									dijit.byId(document.getElementById('n_lug_ci_ci_'+i)));
							return false;
						}
					}
				}
				j++;
			}
		}
		i++;
	}
	
	id_dojo_r=parseInt(document.getElementById("filas_dojo_do").value);
	
	i=1;
	while (document.getElementById('n_tp_do_'+i)) {
		if (document.getElementById('v_doc_pr_'+i).value=='S') {
			
			if (!valida(dijit.byId(document.getElementById('n_tp_do_'+i).value), 'Por favor seleccione el tipo de documento.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				return false;
			}
			
			if (!valida(document.getElementById(document.getElementById('n_fc_doc_'+i).value), 'Por favor seleccione la fecha de documento.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				return false;
			}
			
			if (document.getElementById(document.getElementById('n_fc_doc_'+i).value).getAttribute("aria-invalid")=='true') {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				foco(document.getElementById(document.getElementById('n_fc_doc_'+i).value));
				mensaje_dj('ERROR','La fecha de documento no es valida.','OK','ERROR','',document.getElementById(document.getElementById('n_fc_doc_'+i).value));
				return false;
			}
			j=1;
			while (document.getElementById('n_tp_do_'+j)) {
				if (document.getElementById('v_doc_pr_'+j).value=='S') {
					if (dijit.byId(document.getElementById('n_tp_do_'+i).value).id!=dijit.byId(document.getElementById('n_tp_do_'+j).value).id) {
						if (dijit.byId(document.getElementById('n_tp_do_'+i).value).value==dijit.byId(document.getElementById('n_tp_do_'+j).value).value&&
								document.getElementById(document.getElementById('n_fc_doc_'+i).value).value==document.getElementById(document.getElementById('n_fc_doc_'+j).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
							foco(dijit.byId(document.getElementById('n_tp_do_'+j)));
							mensaje_dj('ERROR','Se encuentra repetida el tipo de documento con la misma fecha.','OK','ERROR','',
									dijit.byId(document.getElementById('n_tp_do_'+j)));
							return false;
						}
					}
				}
				j++;
			}
		}
		i++;
	}
	
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/AdicionarModificar.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				foco(dijit.byId('i_dojo_2'));
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId('i_dojo_2'));
				document.getElementById('barra_proc').style.display='none';
				document.getElementById('datos').style.display='';
			} else {
				dijit.byId('ventana').hide();
				consultar();
				
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vProveedor')+'&accion_d='+base64_encode(document.getElementById('accion_d').value)+'&accion_p='+
	base64_encode(document.getElementById('accion_p').value)+'&accion_r='+base64_encode(document.getElementById('accion_r').value)+'&datos_ant_d='+
	reemp_carac_esp_js(document.getElementById('datos_ant_d').value)+'&datos_ant_p='+
	reemp_carac_esp_js(document.getElementById('datos_ant_p').value)+'&datos_ant_r='+
	reemp_carac_esp_js(document.getElementById('datos_ant_r').value)+'&filas_suc='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_suc').value))+'&filas_ciiu='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_ciiu').value))+'&filas_doc_pr='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_doc_pr').value))+'&filas_ciiu_ci='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_ciiu_ci').value))+'&cd_principal='+
	base64_encode(reemp_carac_esp_js(document.getElementById('cd_principal').value));
	
	for (i=1;i<=parseInt(document.getElementById('filas_suc').value);i++){
		envio+='&v_suc_'+i+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_suc_'+i).value))
	}
	
	for (i=1;i<=parseInt(document.getElementById('filas_ciiu').value);i++){
		envio+='&v_ciiu_'+i+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_ciiu_'+i).value))+'&datos_ant_ci_'+i+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_ci_'+i).value)+'&accion_ci_'+i+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_ci_'+i).value))
	}
	
	for (i=1;i<=parseInt(document.getElementById('filas_doc_pr').value);i++){
		envio+='&v_doc_pr_'+i+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_doc_pr_'+i).value))+'&datos_ant_do_'+i+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_do_'+i).value)+'&accion_do_'+i+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_do_'+i).value))
	}
	
	for (i=1;i<=parseInt(document.getElementById('filas_ciiu_ci').value);i++){
		envio+='&v_ciiu_ci_'+i+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_ciiu_ci_'+i).value))+'&datos_ant_ci_ci_'+i+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_ci_ci_'+i).value)+'&accion_ci_ci_'+i+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_ci_ci_'+i).value));
		if (dijit.byId(document.getElementById('n_pri_ci_ci_'+i).value).checked) envio+='&cd_principal_ci_'+i+'='+base64_encode(reemp_carac_esp_js('t'));
		else envio+='&cd_principal_ci_'+i+'='+base64_encode(reemp_carac_esp_js('f'));
	}
	
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		if (dijit.byId('i_dojo_'+i).name=='digito_v'||dijit.byId('i_dojo_'+i).name=='digito_v_r')
			envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(document.getElementById('i_dojo_'+i).value));
		else
			envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		i++;
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function subirMasivo() {
	if (!valida(document.getElementById('archivo'), 'Por favor selecccione el archivo.',false)) return false;
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	var peticion=false,envio='';
	peticion=object();
	fragment_url='../../Controlador/SubirMasivo.php';
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				foco(dijit.byId('i_dojo_0'));
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId('i_dojo_0'));
				document.getElementById('barra_proc').style.display='none';
				document.getElementById('datos').style.display='';
				document.getElementById('barra_proc').style.display='none';
				document.getElementById('datos').style.display='';
			} else {
				dijit.byId('ventana').hide();
				consultar();
				
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Cache-Control','no-cache');
	peticion.setRequestHeader('X-Requested-With','XMLHttpRequest');
	peticion.setRequestHeader('X-File-Name',base64_encode(document.getElementById('archivo').files[0].name)+'##'+base64_encode('vProveedor')+'##'+
			base64_encode(dijit.byId('i_dojo_0').value)+'##'+
			base64_encode(parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value));
	peticion.send(document.getElementById('archivo').files[0]);
}