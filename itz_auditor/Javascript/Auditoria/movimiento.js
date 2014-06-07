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
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - MOVIMIENTOS CONTABLES';
	cargarPermisos ('106','movimiento',['','','','','i_dojo_0'],['0','0','1','1','1'],["document.getElementById('list_t_cliente').value",
	"document.getElementById('list_t_numero_comprobante').value","document.getElementById('list_t_codigo_comprobante').value",
	"document.getElementById('list_t_anio_mes').value"],"'&cliente='+base64_encode(document.getElementById('list_t_cliente').value)+'&no_comprobante='+base64_encode"+
	"(document.getElementById('list_t_numero_comprobante').value)+'&cd_comprobante='+base64_encode(document.getElementById('list_t_codigo_comprobante').value)+'&anio_mes"+
	"='+base64_encode(document.getElementById('list_t_anio_mes').value)",['106-adicionar'],['<td id="td_con" style="display: ;"><input type="button" name="b_sub" id="'+
	'b_sub" value="" class="b_sub" onclick="abrirVentana(\'vSubirMasivoMovimiento\',\'S\',\'Seleccionar Cliente y Archivo\',\'\',\'106\',\'archivo\');"></td>'],['b_sub'],
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
			if (valores[0]==document.getElementById('list_t_cliente').value&&valores[1]==document.getElementById('list_t_numero_documento').value&&
			valores[2]==document.getElementById('list_t_codigo_documento').value&&valores[3]==document.getElementById('list_t_anio_mes')&&valores[4]==
			document.getElementById('list_t_consecutivo')) {
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
				color='red';
			} else {
				color='black';
			}
			
			vl_num=retorna_num(valores[0]);
			
			var div='<div style="color: '+color+';">'+salto_linea_html(number_format(vl_num,0,'',','))+'</div>';
			return div;
		},
		fmtNum1: function(value, idx){
			valores=value.split('##');
			if (valores[1]=='A') {
				color='red';
			} else {
				color='black';
			}
			
			vl_num=retorna_num(valores[0]);
			
			var div='<div style="color: '+color+';">'+salto_linea_html(vl_num)+'</div>';
			return div;
		},
		fmtValue: function(value, idx){
			var valores=new Array();
			var color='';
			valores=value.split('##');
			if (valores[1]=='A') {
				color='red';
			} else {
				color='black';
			}
			var div='<div style="text-transform: uppercase; color: '+color+';">'+salto_linea_html(valores[0])+'</div>';
			return div;
		},
		fmtFec: function(value, idx){
			var valores=new Array();
			var color='';
			valores=value.split('##');
			if (valores[1]=='A') {
				color='red';
			} else {
				color='black';
			}
			var div='<div style="text-transform: uppercase; color: '+color+';">'+salto_linea_html(formatCf(valores[0]))+'</div>';
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
	var anu=0,cor=0,db=0,cr=0;
	if (dijit.byId('grid_movimiento')) {
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
			
			var len_doc=0,len_val=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[1].length>len_doc) len_doc=usr[1].length;
				if (usr[10].length>len_val) len_val=usr[10].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[14]=='A') anu++;
				else cor++;
				
				if (usr[12]=='D') db+=parseFloat(usr[13]);
				else cr+=parseFloat(usr[13]);
				
				store.newItem({
					cd_movimiento: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+usr[2]+'##'+usr[5]+'##'+usr[6]+'##'+cd)),
					cliente: str_replace("'", "\'", reempCaracEspDojo(usr[17]+'##'+usr[14])),
					nm_documento: str_replace("'", "\'", reempCaracEspDojo(usr[21]+'##'+usr[14])),
					no_documento: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[1],len_doc,'0','STR_PAD_LEFT')+'##'+usr[14])),
					cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[20]+'##'+usr[14])),
					fc_movimiento: str_replace("'", "\'", reempCaracEspDojo(usr[4]+'##'+usr[14])),
					tercero: str_replace("'", "\'", reempCaracEspDojo(usr[8]+'##'+usr[14])),
					segundo_tercero: str_replace("'", "\'", reempCaracEspDojo(usr[9]+'##'+usr[14])),
					cencos: str_replace("'", "\'", reempCaracEspDojo(usr[10]+'##'+usr[14])),
					detalle: str_replace("'", "\'", reempCaracEspDojo(usr[11]+'##'+usr[14])),
					valor: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[13],len_val,'0','STR_PAD_LEFT')+'##'+usr[14])),
					naturaleza: str_replace("'", "\'", reempCaracEspDojo(usr[18]+'##'+usr[14])),
					usuario_empresa: str_replace("'", "\'", reempCaracEspDojo(usr[15]+'##'+usr[14])),
					fc_empresa: str_replace("'", "\'", reempCaracEspDojo(usr[16]+'##'+usr[14]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Correctos: '+cor;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Anulados: '+anu;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
			if (document.getElementById('i_valores')) document.getElementById('i_valores').innerHTML='Total D&eacute;bitos: '+number_format(db,2)+
			'&nbsp;&nbsp;Total Cr&eacute;ditos: '+number_format(cr,2)+'&nbsp;&nbsp;Diferencia: '+number_format(db-cr,2);
		} else {
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasMovimiento.php',clearOnClose:true});
		if (datos!='') {
			var len_doc=0,len_val=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[1].length>len_doc) len_doc=usr[1].length;
				if (usr[10].length>len_val) len_val=usr[10].length;
			}
			
			for (i=0;i<count(a_datos);i++) {
				usr=explode('@@',a_datos[i]);
				if (usr[14]=='A') anu++;
				else cor++;
				
				if (usr[12]=='D') db+=parseFloat(usr[13]);
				else cr+=parseFloat(usr[13]);
				
				store.newItem({
					cd_movimiento: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+usr[2]+'##'+usr[5]+'##'+usr[6]+'##'+cd)),
					cliente: str_replace("'", "\'", reempCaracEspDojo(usr[17]+'##'+usr[14])),
					nm_documento: str_replace("'", "\'", reempCaracEspDojo(usr[21]+'##'+usr[14])),
					no_documento: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[1],len_doc,'0','STR_PAD_LEFT')+'##'+usr[14])),
					cuenta_puc: str_replace("'", "\'", reempCaracEspDojo(usr[20]+'##'+usr[14])),
					fc_movimiento: str_replace("'", "\'", reempCaracEspDojo(usr[4]+'##'+usr[14])),
					tercero: str_replace("'", "\'", reempCaracEspDojo(usr[8]+'##'+usr[14])),
					segundo_tercero: str_replace("'", "\'", reempCaracEspDojo(usr[9]+'##'+usr[14])),
					cencos: str_replace("'", "\'", reempCaracEspDojo(usr[10]+'##'+usr[14])),
					detalle: str_replace("'", "\'", reempCaracEspDojo(usr[11]+'##'+usr[14])),
					valor: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[13],len_val,'0','STR_PAD_LEFT')+'##'+usr[14])),
					naturaleza: str_replace("'", "\'", reempCaracEspDojo(usr[18]+'##'+usr[14])),
					usuario_empresa: str_replace("'", "\'", reempCaracEspDojo(usr[15]+'##'+usr[14])),
					fc_empresa: str_replace("'", "\'", reempCaracEspDojo(usr[16]+'##'+usr[14]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Correctos: '+cor;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Anulados: '+anu;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
			if (document.getElementById('i_valores')) document.getElementById('i_valores').innerHTML='Total D&eacute;bitos: '+number_format(db,2)+
			'&nbsp;&nbsp;Total Cr&eacute;ditos: '+number_format(cr,2)+'&nbsp;&nbsp;Diferencia: '+number_format(db-cr,2);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_proveedor'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_movimiento', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Cliente', field: 'cliente', width: '11%', formatter:"fmtValue"},
									{ name: 'Comprobante', field: 'nm_documento', width: '10%', formatter:"fmtValue"},
									{ name: 'N&ordm; Doc.', field: 'no_documento',width: '5%', styles:"text-align: center;", formatter:"fmtNum1"},
									{ name: 'Cuenta PUC', field: 'cuenta_puc', width: '9%', formatter:"fmtValue"},
									{ name: 'Fecha Movimiento', field: 'fc_movimiento', width: '6%', styles:"text-align: center;", formatter:"fmtFec"},
									{ name: 'Tercero', field: 'tercero', width: '6%', formatter:"fmtValue"},
									{ name: '2&ordm; Tercero', field: 'segundo_tercero', width: '6%', formatter:"fmtValue"},
									{ name: 'Centro Costo', field: 'cencos', width: '9%', formatter:"fmtValue"},
									{ name: 'Detalle', field: 'detalle', width: '10%', formatter:"fmtValue"},
									{ name: 'Valor', field: 'valor', width: '6%', styles:"text-align: right;",formatter:"fmtNum"},
									{ name: 'D&eacute;bito/<br>Cr&eacute;dito', field: 'naturaleza', width: '6%', formatter:"fmtValue"},
									{ name: 'Usuario Empresa', field: 'usuario_empresa', width: '6%', styles:"text-align: right;", formatter:"fmtValue"},
									{ name: 'Fecha Empresa', field: 'fc_empresa', width: '6%', styles:"text-align: center;", formatter:"fmtFec"}
									];
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_movimiento",
			id: "grid_movimiento",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_mov"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_movimiento').style.height=alto+'px';
	dijit.byId('grid_movimiento').render();
	dijit.byId('ventana').hide();
	if (dijit.byId('ventana')) dijit.byId('ventana').destroy();
	if (dijit.byId('indeterminateBar1')) dijit.byId('indeterminateBar1').destroy();
}

function consultar() {
	
	if (dijit.byId('ventana')) dijit.byId('ventana').destroy();
	if (dijit.byId('indeterminateBar1')) dijit.byId('indeterminateBar1').destroy();
	
	var dialog=new dijit.Dialog({id:"ventana",title:'Realizando consulta', style:"width: auto;"});
	dialog.setContent('Procesando informaci&oacute;n, por favor espere.<div style="width:400px" indeterminate="true" id="indeterminateBar1" dojoType="'+
			'dijit.ProgressBar"></div>');
	dialog.startup();
	dialog.show();
	
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
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Comprobante: '+reemp_carac_esp_html(valores[1])+' - Cliente: '+
			reemp_carac_esp_html(valores[0]));
	
	document.f_consulta.list_t_cliente.value=valores[0];
	document.f_consulta.list_t_numero_comprobante.value=valores[1];
	document.f_consulta.list_t_codigo_comprobante.value=valores[2];
	document.f_consulta.list_t_anio_mes.value=valores[3];
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
	//document.getElementById('tr_del_texto').style.display=disp;
}

function siguiente() {
	var arc=new Array(), perm=['xls','xlsx','ods','slk','xml','csv','txt','gnumeric'];
	
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor seleccione el cliente.',false)) return false;
	
	if (!valida(document.getElementById('i_dojo_9'), 'Por favor seleccione el a&ntilde;o.',false)) return false;
	
	if (document.getElementById('i_dojo_9').getAttribute("aria-invalid")=='true') {
		foco(document.getElementById('i_dojo_9'));
		mensaje_dj('ERROR','El a&ntilde;o no es valido.','OK','ERROR','',document.getElementById('i_dojo_9'));
		return false;
	}
	
	if (!valida(dijit.byId('i_dojo_10'), 'Por favor seleccione el mes.',false)) return false;
	
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
				base64_encode(document.getElementById('archivo').files[0].name)+'&formato_fecha='+base64_encode(dijit.byId('i_dojo_8').value)+'&anio='+
				base64_encode(dijit.byId('i_dojo_9').value)+'&mes='+base64_encode(dijit.byId('i_dojo_10').value);
				if (arc[arc.length-1].toLowerCase()=='csv'||arc[arc.length-1].toLowerCase()=='txt') envio1+='&delimitador_campo='+base64_encode(dijit.byId('i_dojo_6').value)+
				'&delimitador_texto='+base64_encode(dijit.byId('i_dojo_7').value);
				abrirVentana('vSubirMasivoMovimiento1','S','Subir Informaci&oacute;n Archivo',envio1,'106','');
				
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Cache-Control','no-cache');
	peticion.setRequestHeader('X-Requested-With','XMLHttpRequest');
	envio=base64_encode(document.getElementById('archivo').files[0].name)+'##'+base64_encode('vMovimiento')+'##'+base64_encode(dijit.byId('i_dojo_0').value)+'##'+
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
					//consultar();
					mensaje_dj('ADVERTENCIA',msg[1],'OK','WARNING','',dijit.byId('i_dojo_0'));
				}
			} else {
				dijit.byId('ventana').hide();
				//consultar();
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vMovimiento')+'&accion='+base64_encode('S')+'&columnas='+base64_encode(columnas.join(','))+'&archivo='+
	base64_encode(document.getElementById('archivo').value)+'&encabezados='+base64_encode(document.getElementById('encabezados').value)+'&cliente='+
	base64_encode(document.getElementById('cliente').value)+'&delimitador_campo='+base64_encode(document.getElementById('delimitador_campo').value)+'&delimitador_texto='+
	base64_encode(document.getElementById('delimitador_texto').value)+'&delimitador_campo='+base64_encode(document.getElementById('delimitador_campo').value)+
	'&formato_fecha='+base64_encode(document.getElementById('formato_fecha').value)+'&anio='+base64_encode(document.getElementById('anio').value)+'&mes='+
	base64_encode(document.getElementById('mes').value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function cambio_cond(tipo,valor) {
	var disp_e='none',disp_v='none';
	switch (valor) {
		case 'ENTRE':
			disp_e='';
			break;
			
		case 'VARIAS':
			disp_v='';
			break;
	}
	document.getElementById('s_'+tipo+'_e').style.display=disp_e;
	document.getElementById('s_'+tipo+'_v').style.display=disp_v;
	
	for (i_c=2;i_c<=document.getElementById('filas_'+tipo).value;i_c++) {
		if (document.getElementById('tr_cta_puc_'+i_c)) document.getElementById('tr_cta_puc_'+i_c).style.display=disp_v;
	}
}

function crear_det(tipo) {
	
	var filas=0,campo_dojo;
	tabla=document.getElementById('ta_'+tipo);
	filas=parseInt(document.getElementById('filas_'+tipo).value)+1;
	document.getElementById('filas_'+tipo).value=filas.toString();
	
	var tr=document.createElement("tr");
	tr.setAttribute("id","tr_"+tipo+"_"+filas.toString());
	tabla.appendChild(tr);
	
	var td=document.createElement("td");
	tr.appendChild(td);
	
	var td=document.createElement("td");
	tr.appendChild(td);
	
	switch (tipo) {
		case 'cta_puc':
			
			var td=document.createElement("td");
			tr.appendChild(td);
			
			td.setAttribute("id","texto_mayus");
			campo_dojo=new dijit.form.ValidationTextBox({type:"text",style:"width: 8em;",maxLength:"20",name:"list_t_cta_puc[]",
				id:"list_t_cta_puc_"+filas.toString()});
			td.appendChild(campo_dojo.domNode);
			foco(campo_dojo);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: none;");
			td.setAttribute("id","s_"+tipo+"_e_"+filas.toString());
			tr.appendChild(td);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: ;");
			td.setAttribute("id","s_"+tipo+"_v_"+filas.toString());
			tr.appendChild(td);
			
			oncli=function anonymous() {crear_det(tipo);};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_add_"+tipo+"_"+filas.toString(),id:"b_add_"+tipo+"_"+filas.toString(),label:'+',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			oncli=function anonymous() {eliminar_fila('ta_'+tipo,"tr_"+tipo+"_"+filas.toString());};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_elim_"+tipo+"_"+filas.toString(),id:"b_elim_"+tipo+"_"+filas.toString(),label:'-',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			break;
			
		case 'fc_mov':
			
			var td=document.createElement("td");
			tr.appendChild(td);
			
			td.setAttribute("id","texto_mayus");
			campo_dojo=new dijit.form.DateTextBox({type:"text",style:"width: 8em;",maxLength:"10",name:"list_t_fc_mov[]",
				id:"list_t_fc_mov_"+filas.toString()});
			td.appendChild(campo_dojo.domNode);
			foco(campo_dojo);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: none;");
			td.setAttribute("id","s_"+tipo+"_e_"+filas.toString());
			tr.appendChild(td);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: ;");
			td.setAttribute("id","s_"+tipo+"_v_"+filas.toString());
			tr.appendChild(td);
			
			oncli=function anonymous() {crear_det(tipo);};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_add_"+tipo+"_"+filas.toString(),id:"b_add_"+tipo+"_"+filas.toString(),label:'+',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			oncli=function anonymous() {eliminar_fila('ta_'+tipo,"tr_"+tipo+"_"+filas.toString());};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_elim_"+tipo+"_"+filas.toString(),id:"b_elim_"+tipo+"_"+filas.toString(),label:'-',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			break;
			
		case 'vl_mov':
			
			var td=document.createElement("td");
			tr.appendChild(td);
			
			td.setAttribute("id","texto_mayus");
			
			var fd=filas.toString();
			
			var onkey=function anonymous() {formatNumber(document.getElementById('list_t_vl_mov_'+fd),',','');};
			campo_dojo=new dijit.form.ValidationTextBox({type:"text",style:"width: 15em;",name:"list_t_vl_mov[]",id:"list_t_vl_mov_"+filas.toString(),onKeyUp: onkey});
			td.appendChild(campo_dojo.domNode);
			foco(campo_dojo);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: none;");
			td.setAttribute("id","s_"+tipo+"_e_"+filas.toString());
			tr.appendChild(td);
			
			var td=document.createElement("td");
			td.setAttribute("align","center");
			td.setAttribute("style","display: ;");
			td.setAttribute("id","s_"+tipo+"_v_"+filas.toString());
			tr.appendChild(td);
			
			oncli=function anonymous() {crear_det(tipo);};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_add_"+tipo+"_"+filas.toString(),id:"b_add_"+tipo+"_"+filas.toString(),label:'+',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			oncli=function anonymous() {eliminar_fila('ta_'+tipo,"tr_"+tipo+"_"+filas.toString());};
			campo_dojo=new dijit.form.Button({type:"button",name:"b_elim_"+tipo+"_"+filas.toString(),id:"b_elim_"+tipo+"_"+filas.toString(),label:'-',onClick:oncli});
			td.appendChild(campo_dojo.domNode);
			
			break;
	}
}

function cambio_dp(){
	var columnas=new Array(),color=new Array()
	color[0]='#e5f2ff';
	color[1]='#fff2d9';
	columnas=c3.getAllNodes();
	
	for (i=0;i<columnas.length;i++) {
		if (i<=10) document.getElementById(columnas[i].id).style.background=color[i%2];
	}
}

function cambio_cliente(valor) {
	if (valor=='') {
		document.getElementById('tr_comprobante').style.display='none';
	} else {
		document.getElementById('tr_comprobante').style.display='';
		cargarCombo(list_t_comprobante_store,"../../Stores/comboComprobantes.php?where= and trim(d.dir_nombres||' '||case when d.dir_apellidos is null then '' else "+
		"d.dir_apellidos end) ilike '%"+valor+"%'");
	}
}