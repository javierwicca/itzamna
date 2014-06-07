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
dojo.require("dijit.form.CheckBox");
dojo.require("dojo.date.locale");
dojo.require("dijit.Tree");
dojo.require("dijit._tree.dndSource");
dojo.require("dojo.dnd.common");
dojo.require("dojo.dnd.Source");

function inicio() {
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - PLAN ÚNICO DE CUENTAS';
	cargarPermisos ('105','cuenta PUC',['i_dojo_0','i_dojo_2','','','i_dojo_0'],['1','1','0','1','1'],["document.getElementById('list_t_cliente').value",
	"document.getElementById('list_t_cuenta_puc').value"],"'&cliente='+base64_encode(document.getElementById('list_t_cliente').value)+'&cuenta_puc='+base64_encode"+
	"(document.getElementById('list_t_cuenta_puc').value)",['105-modificar'],['<td id="td_con" style="display: ;"><input type="button" name="b_sub" id="b_sub" value="" '+
	'class="b_sub" onclick="abrirVentana(\'vSubirMasivoCuentaPuc\',\'S\',\'Seleccionar Cliente y Archivo\',\'\',\'105\',\'archivo\');"></td>'],['b_sub'],
	['Subir masivamente'],'L');
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
			if (valores[0]==document.getElementById('list_t_cliente').value&&valores[1]==document.getElementById('list_t_cuenta_puc').value) {
				if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='';
				if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='';
				if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
				chk=true;
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
		var alto=screen.height-370,len_bie=0;
		
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
	if (dijit.byId('grid_cuenta_puc')) {
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
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				
				store.newItem({
					cd_cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					cliente: str_replace("'", "\'", reempCaracEspDojo(usr[6])),
					cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[1])),
					nombre: str_replace("'", "\'", reempCaracEspDojo(usr[2])),
					ecuacion_patrimonial: str_replace("'", "\'", reempCaracEspDojo(usr[7])),
					nv_detalle: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					naturaleza: str_replace("'", "\'", reempCaracEspDojo(usr[8]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasCuentaPuc.php',clearOnClose:true});
		if (datos!='') {
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				
				store.newItem({
					cd_cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					cliente: str_replace("'", "\'", reempCaracEspDojo(usr[6])),
					cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[1])),
					nombre: str_replace("'", "\'", reempCaracEspDojo(usr[2])),
					ecuacion_patrimonial: str_replace("'", "\'", reempCaracEspDojo(usr[7])),
					nv_detalle: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					naturaleza: str_replace("'", "\'", reempCaracEspDojo(usr[8]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_proveedor'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_cuenta_puc', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Cliente', field: 'cliente', width: '25%', formatter:"fmtValue"},
									{ name: 'Cuenta PUC', field: 'cuenta_puc', width: '10%',formatter:"fmtValue"},
									{ name: 'Nombre', field: 'nombre', width: '30%', formatter:"fmtValue"},
									{ name: 'Ecuaci&oacute;n Patrimonial', field: 'ecuacion_patrimonial', width: '13%', formatter:"fmtValue"},
									{ name: 'Nivel Detalle', field: 'nv_detalle', width: '8%', styles:"text-align: center;"},
									{ name: 'Naturaleza', field: 'naturaleza', width: '10%', formatter:"fmtValue"}
									];
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_cuenta_puc",
			id: "grid_cuenta_puc",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_cta"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_cuenta_puc').style.height=alto+'px';
	dijit.byId('grid_cuenta_puc').render();
	
	
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
	dijit.byId("b_mod_tooltip").attr('label','Modificar Cuenta PUC: '+reemp_carac_esp_html(valores[1])+' - Cliente: '+reemp_carac_esp_html(valores[0]));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Cuenta PUC: '+reemp_carac_esp_html(valores[1])+' - Cliente: '+
			reemp_carac_esp_html(valores[0]));
	
	document.f_consulta.list_t_cliente.value=valores[0];
	document.f_consulta.list_t_cuenta_puc.value=valores[1];
}

function act_cuenta_puc() {
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor seleccione el cliente.',false)) return false;
	
	if (!valida(document.getElementById('i_dojo_1'),'Por favor digite la cuenta PUC.',false)) return false;
	
	if (document.getElementById('i_dojo_1').getAttribute("aria-invalid")=='true') {
		foco(document.getElementById('i_dojo_1'));
		mensaje_dj('ERROR','La cuenta PUC no es valida.','OK','ERROR','',document.getElementById('i_dojo_1'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_2'),'Por favor digite el nombre de la cuenta PUC.',false)) return false;
	
	if (!valida(document.getElementById('i_dojo_4'),'Por favor digite el nivel de detalle.',false)) return false;
	
	if (document.getElementById('i_dojo_4').getAttribute("aria-invalid")=='true') {
		foco(document.getElementById('i_dojo_4'));
		mensaje_dj('ERROR','El nivel de detalle no es valido.','OK','ERROR','',document.getElementById('i_dojo_4'));
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
	envio='ventana='+base64_encode('vCuentaPuc')+'&accion='+base64_encode(document.getElementById('accion').value)+'&datos_ant='+
	reemp_carac_esp_js(document.getElementById('datos_ant').value);
	
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		if (dijit.byId('i_dojo_'+i).name=='cta_puc'||dijit.byId('i_dojo_'+i).name=='nivel_det')
			envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(document.getElementById('i_dojo_'+i).value));
		else
			envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		i++;
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function cambio_arc() {
	var arc=new Array(),disp='none';
	
	arc=document.getElementById('archivo').value.split('.');
	if (arc[arc.length-1].toLowerCase()=='csv'||arc[arc.length-1].toLowerCase()=='txt') disp='';
	document.getElementById('tr_del_campo').style.display=disp;
	document.getElementById('tr_del_texto').style.display=disp;
}

function siguiente() {
	var arc=new Array(), perm=['xls','xlsx','ods','slk','xml','csv','txt','gnumeric'];
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor seleccione el cliente.',false)) return false;
	
	if (!valida(document.getElementById('archivo'), 'Por favor selecccione el archivo.',false)) return false;
	arc=document.getElementById('archivo').value.split('.');
	
	if (array_search(arc[arc.length-1].toLowerCase(),perm)===false){
		foco(document.getElementById('archivo'));
		mensaje_dj('ERROR','El tipo de archivo no es valido.','OK','ERROR','',document.getElementById('archivo'));
		return false;
	}
	
	if (arc[arc.length-1].toLowerCase()=='csv'||arc[arc.length-1].toLowerCase()=='txt') {
		if (!valida(dijit.byId('i_dojo_6'), 'Por favor selecccione el delimitador de campo.',false)) return false;
	}
	
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	var peticion=false,envio='',envio1='';
	peticion=object();
	fragment_url='../../Controlador/SubirMasivo.php';
	
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function() { 
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
				envio1='&cliente='+base64_encode(dijit.byId('i_dojo_0').value)+'&encabezados='+base64_encode(dijit.byId('i_dojo_5').checked.toString())+'&archivo='+
				base64_encode(document.getElementById('archivo').files[0].name);
				if (arc[arc.length-1].toLowerCase()=='csv'||arc[arc.length-1].toLowerCase()=='txt') envio1+='&delimitador_campo='+base64_encode(dijit.byId('i_dojo_6').value)+
				'&delimitador_texto='+base64_encode(dijit.byId('i_dojo_7').value);
				abrirVentana('vSubirMasivoCuentaPuc1','S','Subir Informaci&oacute;n Archivo',envio1,'105','i_dojo_1');
				
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Cache-Control','no-cache');
	peticion.setRequestHeader('X-Requested-With','XMLHttpRequest');
	envio=base64_encode(document.getElementById('archivo').files[0].name)+'##'+base64_encode('vCuentaPuc')+'##'+base64_encode(dijit.byId('i_dojo_0').value)+'##'+
	base64_encode(parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value);
	if (arc[arc.length-1].toLowerCase()=='csv'||arc[arc.length-1].toLowerCase()=='txt') envio+='##'+base64_encode(dijit.byId('i_dojo_6').value)+'##'+
	base64_encode(dijit.byId('i_dojo_7').value);
	peticion.setRequestHeader('X-File-Name',envio);
	peticion.send(document.getElementById('archivo').files[0]);
}

function subirMasivo() {
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	
	var columnas=new Array(),peticion=false,envio='';
	columnas=c3.getAllNodes();
	
	for (i=0;i<columnas.length;i++) columnas[i]=columnas[i].id;
	
	fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				var msg=new Array();
				msg=peticion.responseText.split('##');
				if (msg[0]!='advertencia') {
					foco(dijit.byId('i_dojo_0'));
					mensaje_dj('ERROR',str_replace('##', '',peticion.responseText),'OK','ERROR','',dijit.byId('i_dojo_0'));
					document.getElementById('barra_proc').style.display='none';
					document.getElementById('datos').style.display='';
					document.getElementById('barra_proc').style.display='none';
					document.getElementById('datos').style.display='';
				} else {
					dijit.byId('ventana').hide();
					consultar();
					mensaje_dj('ADVERTENCIA',msg[1],'OK','WARNING','',dijit.byId('i_dojo_0'));
				}
			} else {
				dijit.byId('ventana').hide();
				consultar();
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vCuentaPuc1')+'&accion='+base64_encode('S')+'&columnas='+base64_encode(columnas.join(','))+'&archivo='+
	base64_encode(document.getElementById('archivo').value)+'&encabezados='+base64_encode(dijit.byId('i_dojo_5').checked.toString())+'&cliente='+
	base64_encode(dijit.byId('i_dojo_0').value)+'&delimitador_campo='+base64_encode(document.getElementById('delimitador_campo').value)+'&delimitador_texto='+
	base64_encode(document.getElementById('delimitador_texto').value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}
