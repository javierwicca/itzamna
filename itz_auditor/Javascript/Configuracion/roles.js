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

function inicio() {
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - ROLES';
	cargarPermisos ('1','rol',['i_dojo_0','i_dojo_0','i_dojo_1','','i_dojo_0'],['1','1','1','1','1'],["document.getElementById('list_rol').value"],
	"'&rol='+base64_encode(document.getElementById('list_rol').value)",['no'],['no'],['no'],['no'],'L');
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
			//alert(document.getElementById('list_rol').value);
			var chk=false;
			var valores=new Array();
			valores[0]='';
			valores[1]='';
			valores=value.split('##');
			if (valores[0]==document.getElementById('list_rol').value) {
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
	
	a_datos=datos.split('##');
	if (datos!='') {
		var alto=screen.height-370;
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='none';
		
	} else {
		if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='none';
		if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='none';
		if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		
		var alto=0;
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='';
	}
	
	var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_rol'});
	
	var columnas=[
								{ name: 'Sel.', field: 'cd_rol', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
								{ name: 'C&oacute;digo', field: 'rol', width: '10%',styles:"text-align: right;",formatter:"fmtNum"},
								{ name: 'Nombre', field: 'nombres', width: '25%',formatter:"fmtValue"}
							];
	
	// create a new grid:
	if (dijit.byId('grid_rol')) {
		
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
			
			var len_rol=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_rol) len_rol=usr[0].length;
			}
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[2]=='A') act++;
				else ina++;
				
				store.newItem({
					cd_rol: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					rol: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_rol,'0','STR_PAD_LEFT')+'##'+usr[2])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[1]+'##'+usr[2]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
			
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasRoles.php',clearOnClose:true});
		
		if (datos!='') {
			
			
			var len_rol=0;
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[0].length>len_rol) len_rol=usr[0].length;
			}
			
			for (i=0;i<a_datos.length;i++) {
				usr=a_datos[i].split('@@');
				if (usr[2]=='A') act++;
				else ina++;
				
				store.newItem({
					cd_rol: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+usr[1]+'##'+cd)),
					rol: str_replace("'", "\'", reempCaracEspDojo(str_pad(usr[0],len_rol,'0','STR_PAD_LEFT')+'##'+usr[2])),
					nombres: str_replace("'", "\'", reempCaracEspDojo(usr[1]+'##'+usr[2]))
				});
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
			
		}
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_rol",
			id: "grid_rol",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_rol"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_rol').style.height=alto+'px';
	dijit.byId('grid_rol').render();
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
	if (dijit.byId("b_mod_tooltip")) dijit.byId("b_mod_tooltip").attr('label','Modificar Rol: '+reemp_carac_esp_html(strtoupper(valores[1])));
	
	if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='';
	if (dijit.byId("b_ina_tooltip")) dijit.byId("b_ina_tooltip").attr('label','Inactivar Rol: '+reemp_carac_esp_html(strtoupper(valores[1])));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Rol: '+reemp_carac_esp_html(strtoupper(valores[1])));
	
	document.f_consulta.list_rol.value=valores[0];
}

function act_roles() {
	if (!valida(dijit.byId('i_dojo_0'), 'Por favor digite el nombre del rol.',false)) return false;
	
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	
	var peticion=false,envio='',fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	
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
	envio='ventana='+base64_encode('vRol')+'&accion='+base64_encode(document.getElementById('accion').value)+'&rol='+
	base64_encode(document.getElementById('codigo').value)+'&datos_ant='+reemp_carac_esp_js(document.getElementById('datos_ant').value);
	
	i=0;
	while (dijit.byId('i_dojo_'+i)) {
		if (dijit.byId('i_dojo_'+i).type!='checkbox') envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+i).value));
		else {
			if (dijit.byId('i_dojo_'+i).checked) envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js('t'));
			else envio+='&'+dijit.byId('i_dojo_'+i).name+'='+base64_encode(reemp_carac_esp_js('f'));
		}
		i++;
	}
	
	i=1;
	while (document.getElementById('accion_rp_'+i)) {
		envio+='&accion_rp[]='+base64_encode(document.getElementById('accion_rp_'+i).value)+'&datos_ant_rp[]='+document.getElementById('datos_ant_rp_'+i).value+
		'&modulo[]='+base64_encode(document.getElementById('modulo_'+i).value);
		i++;
	}
	
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function cambio_per(no_id) {
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
