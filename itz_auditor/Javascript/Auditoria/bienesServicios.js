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
dojo.require("dijit.form.Textarea");
dojo.require("dojo.date.locale");

function inicio() {
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - BIENES Y SERVICIOS';
	//argarMenu('102','L');
	cargarPermisos ('102','bien o servicio',['i_dojo_0','i_dojo_0','','','i_dojo_0'],['1','1','0','1','1'],["document.getElementById('list_t_bien_servi').value"],
			"'&bien_servicio='+base64_encode(document.getElementById('list_t_bien_servi').value)",['no'],['no'],['no'],['no'],'L');
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
			if (valores[0]==document.getElementById('list_t_bien_servi').value) {
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
			
			var div='<div>'+salto_linea_html(number_format(vl_num,0,'',','))+'</div>';
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
			var div='<div style="text-transform: uppercase;">'+salto_linea_html(value)+'</div>';
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
	
	// create a new grid:
	if (dijit.byId('grid_bien_servicio')) {
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
			
			var len_bie=0;
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_bie) len_bie=usr[0].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				
				store.newItem({
					cd_bien_servicio: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					cons: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_bie,'0','STR_PAD_LEFT'))),
					bien_servicio: str_replace("'", "\'", reempCaracEspDojo(usr[1])),
					rete_fte_pj: str_replace("'", "\'", reempCaracEspDojo(usr[2])),
					rete_fte_pn: str_replace("'", "\'", reempCaracEspDojo(usr[3])),
					uvt: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					iva: str_replace("'", "\'", reempCaracEspDojo(usr[5])),
					consumo: str_replace("'", "\'", reempCaracEspDojo(usr[6]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasBienesServicios.php',clearOnClose:true});
		
		if (datos!='') {
			var len_bie=0;
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_bie) len_bie=usr[0].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				
				store.newItem({
					cd_bien_servicio: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					cons: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_bie,'0','STR_PAD_LEFT'))),
					bien_servicio: str_replace("'", "\'", reempCaracEspDojo(usr[1])),
					rete_fte_pj: str_replace("'", "\'", reempCaracEspDojo(usr[2])),
					rete_fte_pn: str_replace("'", "\'", reempCaracEspDojo(usr[3])),
					uvt: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					iva: str_replace("'", "\'", reempCaracEspDojo(usr[5])),
					consumo: str_replace("'", "\'", reempCaracEspDojo(usr[6]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_proveedor'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_bien_servicio', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Cons.', field: 'cons', width: '5%', styles:"text-align: center;",formatter:"fmtNum"},
									{ name: 'Bien o servicio', field: 'bien_servicio', width: '30%',formatter:"fmtValue"},
									{ name: '% Retefuente Persona Jur&iacute;dica', field: 'rete_fte_pj', width: '15%', styles:"text-align: center;"},
									{ name: '% Retefuente Persona Natural', field: 'rete_fte_pn', width: '15%', styles:"text-align: center;"},
									{ name: 'UVT', field: 'uvt', width: '10%', styles:"text-align: center;"},
									{ name: '% IVA', field: 'iva', width: '15%', styles:"text-align: center;"},
									{ name: '% Impuesto al consumo', field: 'consumo', width: '15%', styles:"text-align: center;"}
									];
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_bien_servicio",
			id: "grid_bien_servicio",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_bie"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_bien_servicio').style.height=alto+'px';
	dijit.byId('grid_bien_servicio').render();
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
	dijit.byId("b_mod_tooltip").attr('label','Modificar Bien/Servicio: '+reemp_carac_esp_html(valores[1]));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Pago: '+reemp_carac_esp_html(strtoupper(valor)));
	
	document.f_consulta.list_t_bien_servi.value=valores[0];
}

function act_bien_servicio() {
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor digite la descripci&oacute;n del bien o servicio.',false)) {
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_3'),'Por favor digite el porcentaje de retenci&oacute;n en la fuente para persona natural.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId('i_dojo_3').value)) {
		mensaje_dj('ERROR','El porcentaje de retenci&oacute;n en la fuente para persona natural no es numerico.','OK','ERROR','',
				dijit.byId('i_dojo_3'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_4'), 'Por favor digite el porcentaje de retenci&oacute;n en la fuente para persona jur&iacute;dica.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId('i_dojo_4').value)) {
		mensaje_dj('ERROR','El porcentaje de retenci&oacute;n en la fuente para persona jur&iacute;dica no es numerico.','OK','ERROR','',
				dijit.byId('i_dojo_4'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_5'), 'Por favor digite la cantidad de UVT para base.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId('i_dojo_5').value)) {
		mensaje_dj('ERROR','La cantidad de UVT para base no es numerico.','OK','ERROR','',dijit.byId('i_dojo_5'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_6'), 'Por favor digite porcentaje de IVA.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId('i_dojo_6').value)) {
		mensaje_dj('ERROR','El procentaje de IVA no es numerico.','OK','ERROR','',dijit.byId('i_dojo_6'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_7'), 'Por favor digite porcentaje de impuesto al consumo.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId('i_dojo_7').value)) {
		mensaje_dj('ERROR','El procentaje de impuesto al consumo no es numerico.','OK','ERROR','',dijit.byId('i_dojo_7'));
		return false;
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
	envio='ventana='+base64_encode('vBienOServicio')+'&accion='+base64_encode(document.getElementById('accion').value)+'&c_bien_servicio='+
	base64_encode(document.getElementById('c_bien_servicio').value)+'&datos_ant='+reemp_carac_esp_js(document.getElementById('datos_ant_bs').value);
	
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		i++;
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function cambio_det(valor) {
	cargarCombo(dijit.byId('list_t_bien_servicio').store,"../../Stores/comboBienServicios.php?where= and bs.bse_detallado in ("+valor+")");
}

function verifica_bien_serv(valor) {
	document.getElementById('adv_bs').innerHTML='';
	if (valor!='') {
		var peticion=false,datos=new Array(),datos_cd=new Array(),fragment_url='../../Controlador/Control.php',envio='',cn_pal=0;
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									datos=peticion.responseText.split('##');
																									
																									for (i=0;i<datos.length;i++) {
																										
																										datos_cd=datos[i].split('@@');
																										if (similar_text (valor.toLowerCase(),datos_cd[1].toLowerCase(),1)>75) {
																											document.getElementById('adv_bs').innerHTML=
																												'Ya existe un bien o servicio con un nombre igual o similar al digitado.';
																											break;
																										}
																									}
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarBienServicios')+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}