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
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - AUDITORIA PAGOS';
	cargarPermisos ('104','pago',['i_dojo_45','i_dojo_45','','','i_dojo_0'],['1','1','0','0','0'],["document.getElementById('list_pago').value"],
			"'&pago='+base64_encode(document.getElementById('list_pago').value)",['no'],['no'],['no'],['no'],'L');
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
			if (value==document.getElementById('list_pago').value) {
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
			
			var div='<div>'+salto_linea_html(number_format(value,0,'',','))+'</div>';
			return div;
		},
		fmtValue: function(value, idx){
			var div='<div style="text-transform: uppercase;">'+salto_linea_html(value)+'</div>';
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
		var alto=0;
		
		if (document.getElementById('td_mod')) document.getElementById('td_mod').style.display='none';
		if (document.getElementById('td_ina')) document.getElementById('td_ina').style.display='none';
		if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='none';
		if (document.getElementById('td_exp')) document.getElementById('td_exp').style.display='none';
		
		if (document.getElementById('i_totales')) document.getElementById('i_totales').style.display='none';
		if (document.getElementById('nhd')) document.getElementById('nhd').style.display='';
	}
	
	// create a new grid:
	if (dijit.byId('grid_pago')) {
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
			
			for (ig=0;ig<a_datos.length;ig++) {
				
				usr=a_datos[ig].split('@@');
				
				store.newItem({
					cd_pago: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+cd)),
					nombres_p: str_replace("'", "\'", reempCaracEspDojo(usr[11])),
					nombres_c: str_replace("'", "\'", reempCaracEspDojo(usr[12])),
					banco: str_replace("'", "\'", reempCaracEspDojo(usr[13])),
					cta: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					tp_cta: str_replace("'", "\'", reempCaracEspDojo(usr[14]))
				});
				
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
	} else {
		store=new dojo.data.ItemFileWriteStore({url: '../../Stores/consultasPagos.php',clearOnClose:true});
		
		if (datos!='') {
			for (ig=0;ig<a_datos.length;ig++) {
				
				usr=a_datos[ig].split('@@');
				
				store.newItem({
					cd_pago: str_replace("'", "\'", reempCaracEspDojo(usr[0]+'##'+cd)),
					nombres_p: str_replace("'", "\'", reempCaracEspDojo(usr[11])),
					nombres_c: str_replace("'", "\'", reempCaracEspDojo(usr[12])),
					banco: str_replace("'", "\'", reempCaracEspDojo(usr[13])),
					cta: str_replace("'", "\'", reempCaracEspDojo(usr[4])),
					tp_cta: str_replace("'", "\'", reempCaracEspDojo(usr[14]))
				});
				
			}
			
			if (document.getElementById('i_activo')) document.getElementById('i_activo').innerHTML='Activos: '+act;
			if (document.getElementById('i_inactivo')) document.getElementById('i_inactivo').innerHTML='Inactivos: '+ina;
			if (document.getElementById('i_total')) document.getElementById('i_total').innerHTML='TOTAL: '+count(a_datos);
		}
		
		var objeto=new dojox.grid.formatterScopeObj({jsId:'objeto_pago'});
		
		var columnas=[
									{ name: 'Sel.', field: 'cd_pago', width: '4%',styles:"text-align: center;",formatter:"fmtRadioButton"},
									{ name: 'Cliente', field: 'nombres_c', width: '25%',formatter:"fmtValue"},
									{ name: 'Proveedor', field: 'nombres_p', width: '25%',formatter:"fmtValue"},
									{ name: 'Banco', field: 'banco', width: '25%',formatter:"fmtValue"},
									{ name: 'N&uacute;mero Cta.', field: 'cta', width: '15%',formatter:"fmtValue"},
									{ name: 'Tipo Cta.', field: 'tp_cta', width: '10%',formatter:"fmtValue"}
									];
		
		var grid = new dojox.grid.EnhancedGrid({
			jsid: "grid_pago",
			id: "grid_pago",
			formatterScope: objeto,
			store: store,
			rowSelector: '20px',
			structure: columnas,
			height:"0px",
			selectable: true,
			plugins: {dnd: true}
		},dojo.byId("grid_pag"));
		
		// append the new grid to the div "":
		grid.startup();
	}
	
	document.getElementById('grid_pago').style.height=alto+'px';
	dijit.byId('grid_pago').render();
	
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
	
	for (ic=0;ic<document.f_consulta.elements.length;ic++) {
		if (document.f_consulta.elements[ic].name!='') {
			if (envio!='') envio+='&';
			envio+=document.f_consulta.elements[ic].name+'='+base64_encode(reemp_carac_esp_js(document.f_consulta.elements[ic].value));
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
	dijit.byId("b_mod_tooltip").attr('label','Modificar Pago: '+reemp_carac_esp_html(valores[0]));
	
	if (document.getElementById('td_inf')) document.getElementById('td_inf').style.display='';
	if (dijit.byId("b_inf_tooltip")) dijit.byId("b_inf_tooltip").attr('label','Informaci&oacute;n Pago: '+reemp_carac_esp_html(strtoupper(valores[0])));
	document.f_consulta.list_pago.value=valores[0];
}

function datos_proveedor(valor) {
	var peticion=false,datos=new Array(),suc=new Array(),ciu_suc=new Array(),fragment_url='../../Controlador/Control.php',envio='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								datos=peticion.responseText.split('@@');
																								document.getElementById('accion_p').value='M';
																								document.getElementById('datos_ant_p').value=base64_encode("prv_identificacion="+datos[0]+"; prv_tipo_sociedad="+
																								datos[1]+"; prv_autorretenedor="+datos[2]+"; prv_gc="+datos[3]+"; prv_sucursal="+datos[4]+"; prv_dir_sucursal="+
																								datos[5]+"; prv_representante="+datos[6]+"; prv_estado="+datos[8]+"; prv_tipo_regimen="+datos[7]+
																								"; prv_retenedor_iva="+datos[18]+"; prv_profesion_liberal="+datos[19]+"; prv_ley_1429="+datos[20]);
																								dijit.byId('i_dojo_38').set('value',datos[1]);
																								dijit.byId('i_dojo_39').set('value',datos[7]);
																								dijit.byId('i_dojo_40').set('value',datos[2]);
																								dijit.byId('i_dojo_41').set('value',datos[18]);
																								dijit.byId('i_dojo_42').set('value',datos[3]);
																								dijit.byId('i_dojo_46').set('value',datos[19]);
																								dijit.byId('i_dojo_48').set('value',datos[20]);
																								
																								suc=arSqlArJavascript(datos[5]);
																								ciu_suc=arSqlArJavascript(datos[4]);
																								
																								for (ip=0;ip<suc.length;ip++) {
																									
																									if (!document.getElementById('tr_dir_suc_'+(ip+1).toString())) add_suc();
																									
																									document.getElementById('v_suc_'+(ip+1).toString()).value='S';
																									document.getElementById('tr_dir_suc_'+(ip+1).toString()).style.display='';
																									document.getElementById('tr_lug_suc_'+(ip+1).toString()).style.display='';
																									dijit.byId(document.getElementById('n_dir_suc_'+(ip+1).toString()).value).set('value',suc[ip]);
																									dijit.byId(document.getElementById('n_pais_suc_'+(ip+1).toString()).value).set('value',substr(ciu_suc[ip],0,3));
																									cargarCiudad(dijit.byId(document.getElementById('n_dep_suc_'+(ip+1).toString()).value).store,'D',
																											substr(ciu_suc[ip],0,3));
																									dijit.byId(document.getElementById('n_dep_suc_'+(ip+1).toString()).value).set('value',substr(ciu_suc[ip],0,5));
																									cargarCiudad(dijit.byId(document.getElementById('n_ciu_suc_'+(ip+1).toString()).value).store,'C',
																											substr(ciu_suc[ip],0,5));
																									dijit.byId(document.getElementById('n_ciu_suc_'+(ip+1).toString()).value).set('value',ciu_suc[ip]);
																								}
																								
																								var id_dojo=0;
																								id_dojo=parseInt(document.getElementById("dojo_r").value);
																								if (datos[6]!='') dijit.byId('i_dojo_'+(id_dojo).toString()).set('value',number_format(datos[6],0,'',','));
																								else dijit.byId('i_dojo_'+(id_dojo).toString()).set('value','');
																								
																								calcula_valor();
																								
																							} else {
																								document.getElementById('accion_p').value='A';
																								document.getElementById('datos_ant_p').value=base64_encode("");
																								dijit.byId('i_dojo_38').set('value','');
																								dijit.byId('i_dojo_39').set('value','');
																								dijit.byId('i_dojo_40').set('value','');
																								dijit.byId('i_dojo_41').set('value','');
																								dijit.byId('i_dojo_42').set('value','');
																								dijit.byId('i_dojo_46').set('value','');
																								dijit.byId('i_dojo_48').set('value','');
																								
																								ip=0;
																								while (document.getElementById('tr_dir_suc_'+(ip+1).toString())) {
																									dijit.byId(document.getElementById('n_dir_suc_'+(ip+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_pais_suc_'+(ip+1).toString()).value).set('value','COL');
																									cargarCiudad(dijit.byId(document.getElementById('n_dep_suc_'+(ip+1).toString()).value).store,'D',
																											'COL');
																									dijit.byId(document.getElementById('n_dep_suc_'+(ip+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_ciu_suc_'+(ip+1).toString()).value).set('value','');
																									ip++;
																								}
																								datos_rep('');
																							}
																							datos_ciiu_directorio(valor);
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarProveedores')+'&list_t_proveedor='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
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
																									document.getElementById('tarifa_ci_ci_'+(icd+1).toString()).value=datos_cd[4];
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
																									dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('name','reteica_ci_'+
																									datos_cd[2]);
																									
																									if (datos_cd[3]=='t') {
																										dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',true);
																									} else {
																										dijit.byId(document.getElementById('n_pri_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																									}
																									
																									if (datos_cd[2]==dijit.byId(document.getElementById('n_ciudad_pago').value).value) {
																										dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('disabled',false);
																										if (datos_cd[3]=='t') {
																											dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('checked',true);
																										} else {
																											dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																										}
																									} else {
																										dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																										dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																									}
																									document.getElementById('td_v_ciiu_ci_'+(icd+1).toString()).innerHTML=datos_cd[5];
																								}
																								
																								if (datos_co.length==0) {
																									icd=0;
																									while (document.getElementById('tr_ciiu_ci_'+(icd+1).toString())) {
																										document.getElementById('accion_ci_ci_'+(icd+1).toString()).value='A';
																										document.getElementById('datos_ant_ci_ci_'+(icd+1).toString()).value=base64_encode('');
																										document.getElementById('tarifa_ci_ci_'+(icd+1).toString()).value='';
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
																										dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																										dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('checked',false);
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
																									document.getElementById('tarifa_ci_ci_'+(icd+1).toString()).value='';
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
																									dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_cre_ci_ci_'+(icd+1).toString()).value).set('checked',false);
																									document.getElementById('td_v_ciiu_ci_'+(icd+1).toString()).innerHTML='';
																									icd++;
																								}
																							}
																							datos_doc_proveedores(valor);
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarCiiuDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function datos_doc_proveedores(valor) {
	
	var peticion=false,datos=new Array(),datos_cd=new Array(),a_fecha=new Array(),fragment_url='../../Controlador/Control.php',envio='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								datos=peticion.responseText.split('##');
																								
																								for (idp=0;idp<datos.length;idp++) {
																									datos_cd=datos[idp].split('@@');
																									if (!document.getElementById('tr_doc_pr_'+(idp+1).toString())) add_doc_pr();
																									
																									document.getElementById('v_doc_pr_'+(idp+1).toString()).value='S';
																									document.getElementById('tr_doc_pr_'+(idp+1).toString()).style.display='';
																									document.getElementById('accion_do_'+(idp+1).toString()).value='M';
																									document.getElementById('datos_ant_do_'+(idp+1).toString()).value=base64_encode('dpr_identificacion='+datos_cd[0]+
																									'; dpr_tipo_documento='+datos_cd[1]+'; dpr_fecha_doc='+datos_cd[2]+'; dpr_num_documento'+datos_cd[3]+
																									'; dpr_detalle='+datos_cd[4]);
																									dijit.byId(document.getElementById('n_tp_do_'+(idp+1).toString()).value).set('value',datos_cd[1]);
																									a_fecha=datos_cd[2].split('-');
																									fecha=new Date(a_fecha[0],a_fecha[1]-1,a_fecha[2]);
																									dijit.byId(document.getElementById('n_fc_doc_'+(idp+1).toString()).value).set('value',fecha);
																									dijit.byId(document.getElementById('n_fc_doc_'+(idp+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_tp_do_'+(idp+1).toString()).value).set('disabled',true);
																									dijit.byId(document.getElementById('n_num_doc_'+(idp+1).toString()).value).set('value',datos_cd[3]);
																									dijit.byId(document.getElementById('n_det_doc_'+(idp+1).toString()).value).set('value',datos_cd[4]);
																									dijit.byId(document.getElementById('n_eli_doc_'+(idp+1).toString()).value).set('disabled',true);
																								}
																								
																							} else {
																								idp=0;
																								while (document.getElementById('tr_doc_pr_'+(idp+1).toString())) {
																									document.getElementById('accion_do_'+(idp+1).toString()).value='A';
																									document.getElementById('');
																									dijit.byId(document.getElementById('n_tp_do_'+(idp+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_fc_doc_'+(idp+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_fc_doc_'+(idp+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_tp_do_'+(idp+1).toString()).value).set('disabled',false);
																									dijit.byId(document.getElementById('n_num_doc_'+(idp+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_det_doc_'+(idp+1).toString()).value).set('value','');
																									dijit.byId(document.getElementById('n_eli_doc_'+(idp+1).toString()).value).set('disabled',false);
																									idp++;
																								}
																								
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarDocProveedores')+'&list_t_proveedor='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function consulta_cli(valor) {
	
	var peticion=false,datos=new Array(),datos_cd=new Array(),a_fecha=new Array(),fragment_url='../../Controlador/Control.php',envio='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								datos=peticion.responseText.split('@@');
																								document.getElementById('tp_persona_cli').value=datos[19];
																								document.getElementById('tp_regimen_cli').value=datos[7];
																								document.getElementById('tp_autoret_cli').value=datos[2];
																								document.getElementById('tp_reteiva_cli').value=datos[18];
																								document.getElementById('tp_gc_cli').value=datos[3];
																								document.getElementById('tp_rete_todos_cli').value=datos[21];
																								document.getElementById('ciudad_dom_cli').value=datos[20];
																								document.getElementById('ciudad_suc_cli').value=datos[4];
																								calcula_valor();
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarClientes')+'&list_t_cliente='+base64_encode(valor)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
}

function cambio_ciiu(no_id) {
	
	var peticion=false,datos=new Array(),datos_cd=new Array(),a_fecha=new Array(),fragment_url='../../Controlador/Control.php',envio='';
	peticion=object();
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
																						if (peticion.readyState == 4) {
																							if (peticion.responseText!='') {
																								datos=peticion.responseText.split('@@');
																								document.getElementById('tarifa_ci_ci_'+no_id).value=datos[3];
																								cambio_ci();
																								calcula_valor();
																							}
																						}
																					};
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='action='+base64_encode('consultarCiiu')+'&list_t_ciiu='+base64_encode(dijit.byId(document.getElementById('n_nom_ci_ci_'+no_id).value).value)+
	'&list_t_lugar='+base64_encode(dijit.byId(document.getElementById('n_lug_ci_ci_'+no_id).value).value)+'&fechaInicio='+
	parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
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
			if (!dijit.byId(document.getElementById('n_cd_ci_'+i).value).disabled) consulta_ciiu_ciudad(dijit.byId(document.getElementById('n_cd_ci_'+i).value).value);
		}
		i++;
	}
}

function cambio_bien_serv(no_id) {
	if (dijit.byId(document.getElementById('n_bien_'+no_id).value).value!='') {
		dijit.byId(document.getElementById('n_dr_'+no_id).value).set('disabled',false);
		var peticion=false,datos=new Array(),datos_cd=new Array(),a_fecha=new Array(),fragment_url='../../Controlador/Control.php',envio='';
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									datos=peticion.responseText.split('@@');
																									document.getElementById('t_retej_'+no_id).value=datos[2];
																									document.getElementById('t_reten_'+no_id).value=datos[3];
																									document.getElementById('t_uvt_'+no_id).value=datos[4];
																									document.getElementById('t_iva_'+no_id).value=datos[5];
																									document.getElementById('t_consumo_'+no_id).value=datos[6];
																									document.getElementById('accion_bs_'+no_id).value='M';
																									document.getElementById('datos_ant_bs_'+no_id).value=base64_encode("bse_consecutivo="+datos[0]+
																									"; bse_bien_servicio="+datos[1]+"; bse_pr_retefuentej="+datos[2]+"; bse_pr_retefuenten="+datos[3]+
																									"; bse_vl_uvt="+datos[4]+"; bse_pr_iva="+datos[5]+"; bse_pr_consumo="+datos[6]+"; bse_detallado="+datos[7]);
																									document.getElementById('c_bien_serv_'+no_id).value=datos[0];
																									dijit.byId(document.getElementById('n_bien_serv_'+no_id).value).set('value',datos[1]);
																									dijit.byId(document.getElementById('n_detallado_'+no_id).value).set('value',datos[7]);
																									dijit.byId(document.getElementById('n_pr_retej_'+no_id).value).set('value',datos[2]);
																									dijit.byId(document.getElementById('n_pr_reten_'+no_id).value).set('value',datos[3]);
																									dijit.byId(document.getElementById('n_uvt_'+no_id).value).set('value',datos[4]);
																									dijit.byId(document.getElementById('n_pr_iva_'+no_id).value).set('value',datos[5]);
																									dijit.byId(document.getElementById('n_pr_com_'+no_id).value).set('value',datos[6]);
																									calcula_valor();
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarBienServicios')+'&list_t_bien_serv='+base64_encode(dijit.byId(document.getElementById('n_bien_'+no_id).value).value)+
		'&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	} else {
		dijit.byId(document.getElementById('n_dr_'+no_id).value).set('disabled',true);
	}
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

function datos_cedula(valor) {
	if (valor!='') {
		var peticion=false,a_fecha=new Array(),fecha,datos=new Array(),suc=new Array(),fragment_url='../../Controlador/Control.php',envio='';
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
																									"; dir_correo="+datos[9]+"; dir_ciudad_direccion="+datos[10]+"; dir_barrio="+datos[11]+"; dir_fecha_nac="+
																									datos[12]+"; dir_lugar_nac="+datos[13]+"; dir_estado="+datos[14]);
																									
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
																								datos_proveedor(valor);
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		envio='action='+base64_encode('consultarDirectorio')+'&list_t_identificacion='+base64_encode(valor)+'&fechaInicio='+
		parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
		peticion.send(envio);
	}
}

function datos_rep(valor) {
	var peticion=false,a_fecha=new Array(),fecha,id_dojo=0,fragment_url='../../Controlador/Control.php',envio='';
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

function cambio_persona(valor) {
	if (valor=='J') {
		document.getElementById('tr_apellidos').style.display='none';
		document.getElementById('t_rep').style.display='';
		document.getElementById('d_rep').style.display='none';
		document.getElementById('fc_nac').innerHTML='Fecha de Creaci&oacute;n';
		document.getElementById('lu_nac').innerHTML='Lugar de Creaci&oacute;n';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n*';
		dijit.byId('i_dojo_3').set('required', true);
		dijit.byId('i_dojo_10').set('value','');
	} else {
		document.getElementById('tr_apellidos').style.display='';
		document.getElementById('t_rep').style.display='none';
		document.getElementById('d_rep').style.display='';
		document.getElementById('fc_nac').innerHTML='Fecha de Nacimiento';
		document.getElementById('lu_nac').innerHTML='Lugar de Nacimiento';
		document.getElementById('id_dv').innerHTML='Digito Verificaci&oacute;n';
		dijit.byId('i_dojo_3').set('required', false);
		
	}
	calcula_valor();
}

function cambio_prof() {
	if (dijit.byId('i_dojo_39').value=='COMUN'&&dijit.byId('i_dojo_5').value=='N') {
		document.getElementById('td_prof_lib_1').style.display='';
		document.getElementById('td_prof_lib_2').style.display='';
	} else {
		document.getElementById('td_prof_lib_1').style.display='none';
		document.getElementById('td_prof_lib_2').style.display='none';
		dijit.byId('i_dojo_46').set('value', 'f');
		
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
		dijit.byId('i_dojo_'+(id_dojo+1).toString()).set('required', true);
		dijit.byId('i_dojo_'+(id_dojo+8).toString()).set('value','');
	} else {
		document.getElementById('tr_apellidos_r').style.display='';
		document.getElementById('fc_nac_r').innerHTML='Fecha de Nacimiento';
		document.getElementById('lu_nac_r').innerHTML='Lugar de Nacimiento';
		document.getElementById('id_dv_r').innerHTML='Digito Verificaci&oacute;n';
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
		
		var store_p=new dojo.data.ItemFileReadStore({jsId:'pais_sucursal_'+filas+'_store',id:'pais_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=P',
			urlPreventCache:false,clearOnClose:true});
		var store_d=new dojo.data.ItemFileReadStore({jsId:'depto_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=D&codigo=COL',
			urlPreventCache:false,clearOnClose:true});
		var store_c=new dojo.data.ItemFileReadStore({jsId:'ciudad_sucursal_'+filas+'_store',url:'../../Stores/comboLugares.php?tipo=C',
			urlPreventCache:false,clearOnClose:true});
		
		onchan=function anonymous() {cargarCiudad(store_d,'D',arguments[0]);};
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pais_suc_"+filas);
		campo.setAttribute("id","n_pais_suc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'i_dojo_'+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.FilteringSelect({name:'pais_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione pais de sucursal",promptMessage:"Seleccione el pais de la sucursal.",required:true,store:store_p,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",
			onChange:onchan,value:'COL'});
		td.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td.appendChild(span);
		span.innerHTML='&nbsp;';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_dep_suc_"+filas);
		campo.setAttribute("id","n_dep_suc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'i_dojo_'+filas_d);
		td.appendChild(campo);
		
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
		
		onchan=function anonymous() {calcula_valor();};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione ciudad de sucursal",promptMessage:"Seleccione la ciudad de la sucursal.",required:true,store:store_c,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
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
		
		campo=document.createElement("<input name='n_pais_suc_"+filas+"' id='n_pais_suc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
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
		campo=document.createElement("<input name='n_dep_suc_"+filas+"' id='n_dep_suc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
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
		
		onchan=function anonymous() {calcula_valor();};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_sucursal_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
		placeHolder:"Seleccione ciudad de sucursal",promptMessage:"Seleccione la ciudad de la sucursal.",required:true,store:store_c,searchAttr:"name",
		highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function eli_suc(no_id) {
	document.getElementById("v_suc_"+no_id).value='N';
	document.getElementById("tr_dir_suc_"+no_id).style.display='none';
	document.getElementById("tr_lug_suc_"+no_id).style.display='none';
	calcula_valor();
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
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_ci_"+filas);
		campo.setAttribute("id","n_eli_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_ciiu(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
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
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);};
		
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
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);consulta_ciiu('td_v_ciiu_',filas,this.value,'COL');};
		
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
		campo.setAttribute("name","tarifa_ci_ci_"+filas);
		campo.setAttribute("id","tarifa_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
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
		
		onchan=function anonymous() {cargarCombo(store_c,'../../Stores/comboCIIU.php?lugar='+arguments[0]+'&where=');cambio_ciiu(filas);
		cambio_rb(this,dijit.byId('i_dojo_'+fd3.toString()));cambio_ri(this,dijit.byId('i_dojo_'+fd3.toString()));cambio_ci();};
		
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
		campo.setAttribute("name","n_cd_ci_"+filas);
		campo.setAttribute("id","n_cd_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);cambio_ciiu(filas);};
		
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
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);cambio_ciiu(filas);};
		
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
		
		campo_dojo=new dijit.form.RadioButton({name:"principal_ci_ci", id:"i_dojo_"+filas_d,onClick:onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_cre_ci_ci_"+filas);
		campo.setAttribute("id","n_cre_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var onclic=function anonymous() {sel_ri(this);};
		
		campo_dojo=new dijit.form.RadioButton({name:"reteica_ci_", id:"i_dojo_"+filas_d,onClick:onclic,disabled:true});
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
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_ci_ci_"+filas);
		campo.setAttribute("id","n_eli_ci_ci_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_ciiu_ci(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		filas_d++;
		
		tr=document.createElement("tr");
		tr.setAttribute("id","tr_v_ciiu_ci_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","info");
		td.setAttribute("colspan","6");
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
		
		onchan=function anonymous() {cargarCombo(store_c,'../../Stores/comboCIIU.php?lugar='+arguments[0]+'&where=');cambio_ciiu(filas);
		cambio_rb(this,dijit.byId('i_dojo_'+fd3.toString()));cambio_ri(this,dijit.byId('i_dojo_'+fd3.toString()));};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'ciudad_ciiu_ci_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione ciudad",promptMessage:"Seleccione la ciudad de actividad econ&oacute;mica.",required:true,store:store_l,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_cd_ci_"+filas+"' id='n_cd_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		filas_d++;
		
		var fd1=filas_d+1;
		var fd3=filas_d+2;
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd1.toString()).set('value',this.value);cambio_ciiu(filas);
		consulta_ciiu('td_v_ciiu_ci_',filas,this.value,dijit.byId('i_dojo_'+fd5.toString()).value);};
		
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
		
		onchan=function anonymous() {dijit.byId('i_dojo_'+fd.toString()).set('value',this.value);cambio_ciiu(filas);
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
		
		campo=document.createElement("<input name='n_cre_ci_ci_"+filas+"' id='n_cre_ci_ci_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var onclic=function anonymous() {sel_ri(this);};
		
		campo_dojo=new dijit.form.RadioButton({name:"reteica_ci_", id:"i_dojo_"+filas_d,onClick:onclic,disabled:true});
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
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para ciiu."});
		
		tr=document.createElement("<tr id='tr_v_ciiu_ci_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='info' colspan='6' id='td_v_ciiu_ci_"+filas.toString()+"'>");
		tr.appendChild(td);
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function cambio_rb(valor,campo) {
	campo.set('name','principal_ci_'+valor.value);
	if (!valor.disabled) campo.set('checked',false);
}

function sel_rb(campo) {
	ir=1;
	while (document.getElementById('n_pri_ci_ci_'+ir)) {
		if (document.getElementById('v_ciiu_ci_'+ir).value=='S') {
			if (campo.id!=dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).id&&
			campo.name==dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).name) {
				dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).set('checked',false);
				dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',false);
			} else {
				if (dijit.byId(document.getElementById('n_lug_ci_ci_'+ir).value).value==dijit.byId(document.getElementById('n_ciudad_pago').value).value&&
				campo.name==dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).name) 
					dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',true);
				else if (dijit.byId(document.getElementById('n_lug_ci_ci_'+ir).value).value!=dijit.byId(document.getElementById('n_ciudad_pago').value).value&&
						campo.name==dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).name) 
					dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',false);
			}
		}
		ir++;
	}
	calcula_valor();
}

function cambio_ri(valor,campo) {
	campo.set('name','reteica_ci_'+valor.value);
	if (!valor.disabled) campo.set('checked',false);
}

function cambio_ci() {
	ir=1;
	while (document.getElementById('n_cre_ci_ci_'+ir)) {
		if (document.getElementById('v_ciiu_ci_'+ir).value=='S') {
			if (dijit.byId(document.getElementById('n_lug_ci_ci_'+ir).value).value==dijit.byId(document.getElementById('n_ciudad_pago').value).value) {
				dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('disabled',false);
				if (dijit.byId(document.getElementById('n_pri_ci_ci_'+ir).value).checked) dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',true);
				else dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',false);
			} else {
				dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('disabled',true);
				dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',false);
			}
		}
		ir++;
	}
}

function sel_ri(campo) {
	ir=1;
	while (document.getElementById('n_cre_ci_ci_'+ir)) {
		if (document.getElementById('v_ciiu_ci_'+ir).value=='S') {
			if (campo.id!=dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).id&&
			campo.name==dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).name) dijit.byId(document.getElementById('n_cre_ci_ci_'+ir).value).set('checked',
					false);
		}
		ir++;
	}
	calcula_valor();
}

function eli_ciiu_ci(no_id) {
	document.getElementById("v_ciiu_ci_"+no_id).value='N';
	document.getElementById("tr_ciiu_ci_"+no_id).style.display='none';
	calcula_valor();
	document.getElementById("tr_v_ciiu_ci_"+no_id).style.display='none';
}

function consulta_ciiu(nm_id,no_id,ciiu,lugar) {
	if (ciiu!=''&&lugar!='') {
		var peticion=false,a_fecha=new Array(),fecha,fragment_url='../../Controlador/Control.php',envio='';
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									datos=peticion.responseText.split('@@');
																									document.getElementById(nm_id+no_id).innerHTML=datos[4];
																									if (lugar=='COL'&&!dijit.byId(document.getElementById('n_cd_ci_'+no_id).value).disabled) consulta_ciiu_ciudad(ciiu);
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

function cambio_doc_pagos(no_id) {
	if (dijit.byId(document.getElementById('n_tp_do_pa_'+no_id).value).value!=''&&dijit.byId(document.getElementById('n_num_doc_pa_'+no_id).value).value!=''&&
			dijit.byId('i_dojo_2').value!='') {
		var peticion=false,a_fecha=new Array(),fecha,fragment_url='../../Controlador/Control.php',envio='';
		peticion=object();
		peticion.open("POST", fragment_url, true);
		peticion.onreadystatechange = function(){ 
																							if (peticion.readyState == 4) {
																								if (peticion.responseText!='') {
																									mensaje_dj('ADVERTENCIA','El documento digitado ya se encuentra en un pago de este proveedor','OK','advertencia',
																									'',document.getElementById(dijit.byId(document.getElementById('n_num_doc_pa_'+no_id).value)))
																								}
																							}
																						};
		peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		
		var where='';
		where="and p.dpa_tipo_documento='"+dijit.byId(document.getElementById('n_tp_do_pa_'+no_id).value).value+"' and p.dpa_num_documento='"+
		dijit.byId(document.getElementById('n_num_doc_pa_'+no_id).value).value+"' and p.dpa_pago in (select p1.pag_consecutivo from iau_pagos p1 where "+
		"p1.pag_proveedor="+str_replace(',', '', dijit.byId('i_dojo_2').value)+")";
		if (document.getElementById("no_pago").value!='') where+=" and p.dpa_pago<>"+document.getElementById("no_pago").value;
		
		envio='action='+base64_encode('consultarDocPagos')+'&where='+base64_encode(where)+'&fechaInicio='+
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
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_doc_"+filas.toString());
		campo.setAttribute("id","n_eli_doc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
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
		
		campo=document.createElement("<input name='n_eli_doc_"+filas+"' id='n_eli_doc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
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

function eli_doc_pr(no_id) {
	document.getElementById("v_doc_pr_"+no_id).value='N';
	document.getElementById("tr_doc_pr_"+no_id).style.display='none';
}

function add_doc_pa() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_doc_pa").value);
	filas++;
	document.getElementById("filas_doc_pa").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("t_doc_pa");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_doc_pa_"+filas.toString());
		tr.setAttribute("style","");
		tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_do_pa_"+filas);
		campo.setAttribute("id","accion_do_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","A");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_do_pa_"+filas);
		campo.setAttribute("id","datos_ant_do_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_cons_do_pa_"+filas);
		campo.setAttribute("id","t_cons_do_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_doc_pa_"+filas);
		campo.setAttribute("id","v_doc_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_tp_do_pa_"+filas);
		campo.setAttribute("id","n_tp_do_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'tipo_doc_pa_'+filas+'_store',url:'../../Stores/comboParametros.php?parametro=TDCPA&where=',
			urlPreventCache:false,clearOnClose:true});
		
		var onchan=function anonymous() {cambio_doc_pagos(filas);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'tipo_doc_pa_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione tipo de documento",promptMessage:"Seleccione el tipo de documento.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_num_doc_pa_"+filas);
		campo.setAttribute("id","n_num_doc_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 14em;", name:"num_doc_pa_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el n&uacute;mero de documento.", required:false, tooltipPosition:"above, below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_det_doc_pa_"+filas);
		campo.setAttribute("id","n_det_doc_pa_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"50", style:"width: 30em;", name:"det_doc_pa_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el detalle de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_doc_pa();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para documentos."});
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_eli_doc_"+filas.toString());
		campo.setAttribute("id","n_eli_doc_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_doc_pa(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para documentos."});
		filas_d++;
	} else {
		var tabla=document.getElementById("t_doc_pa");
		var tr=document.createElement("<tr id='tr_doc_pa_"+filas.toString()+"' style=''>");
		tabla.appendChild(tr);
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_do_pa_"+filas+"' id='accion_do_pa_"+filas.toString()+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_do_pa_"+filas+"' id='datos_ant_do_pa_"+filas.toString()+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_cons_do_pa_"+filas+"' id='t_cons_do_pa_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_doc_pa_"+filas+"' id='v_doc_pa_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_tp_do_pa_"+filas+"' id='n_tp_do_pa_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'tipo_doc_pa_'+filas+'_store',url:'../../Stores/comboParametros.php?parametro=TDCPA&where=',
			urlPreventCache:false,clearOnClose:true});
		
		var onchan=function anonymous() {cambio_doc_pagos(filas);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'tipo_doc_pa_'+filas,id:'i_dojo_'+filas_d,style:"width: 220px;",
			placeHolder:"Seleccione tipo de documento",promptMessage:"Seleccione el tipo de documento.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below",onChange:onchan});
		
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_num_doc_pa_"+filas+"' id='n_num_doc_pa_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 14em;", name:"num_doc_pa_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el n&uacute;mero de documento.", required:false, tooltipPosition:"above, below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_det_doc_pa_"+filas+"' id='n_det_doc_pa_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"50", style:"width: 30em;", name:"det_doc_pa_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el detalle de documento.", required:false, tooltipPosition:"above, below"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_doc_pa();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para documentos."});
		
		filas_d++;
		
		campo=document.createElement("<input name='n_eli_doc_"+filas+"' id='n_eli_doc_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		onclic=function anonymous() {eli_doc_pa(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para documentos."});
		filas_d++;
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function eli_doc_pa(no_id) {
	document.getElementById("v_doc_pa_"+no_id).value='N';
	document.getElementById("tr_doc_pa_"+no_id).style.display='none';
}

function add_det_pago() {
	var filas=0,filas_d;
	filas=parseInt(document.getElementById("filas_det_pago").value);
	filas++;
	document.getElementById("filas_det_pago").value=filas;
	
	filas_d=parseInt(document.getElementById("filas_dojo").value);
	
	if (navigator.appName!='Microsoft Internet Explorer') {
		var tabla=document.getElementById("ta_det_pago");
		var tr=document.createElement("tr");
		tr.setAttribute("id","tr_det_pago_"+filas.toString());
		tr.setAttribute("style","");
		tabla.insertBefore(tr, document.getElementById("tr_net_pago"));
		//tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_der");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_cd_"+filas);
		campo.setAttribute("id","n_cd_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		var fd2=filas_d;
		
		var onchan=function anonymous() {dijit.byId('i_dojo_'+fd1).set('value',this.value);};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"cd_bien_serv_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo del bien o servicio.", required:true, tooltipPosition:"above, below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","texto_mayus");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var campo=document.createElement("input");
		campo.setAttribute("name","accion_dp_"+filas);
		campo.setAttribute("id","accion_dp_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","A");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_dp_"+filas);
		campo.setAttribute("id","datos_ant_dp_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",base64_encode(""));
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_cons_dp_"+filas);
		campo.setAttribute("id","t_cons_dp_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_retej_"+filas);
		campo.setAttribute("id","t_retej_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_reten_"+filas);
		campo.setAttribute("id","t_reten_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_uvt_"+filas);
		campo.setAttribute("id","t_uvt_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_iva_"+filas);
		campo.setAttribute("id","t_iva_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_consumo_"+filas);
		campo.setAttribute("id","t_consumo_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_info_"+filas);
		campo.setAttribute("id","t_info_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value",'');
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","v_doc_dp_"+filas);
		campo.setAttribute("id","v_doc_dp_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","S");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","t_bien_serv_"+filas);
		campo.setAttribute("id","t_bien_serv_"+filas.toString());
		campo.setAttribute("type","hidden");
		td.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_bien_"+filas);
		campo.setAttribute("id","n_bien_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'bien_serv_'+filas+'_store',url:"../../Stores/comboBienServicios.php?where= and bs.bse_detallado='f'",
			urlPreventCache:false,clearOnClose:true});
		
		oncha=function anonymous() {cambio_bien_serv(filas.toString());dijit.byId('i_dojo_'+fd2).set('value',this.value);};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'bien_serv_'+filas,id:'i_dojo_'+filas_d,style:"width: 400px;",onChange:oncha,
			placeHolder:"Seleccione bien o servicio",promptMessage:"Seleccione el bien o servicio.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		td.appendChild(campo_dojo.domNode);
		
		var table1=document.createElement("table");
		var tbody1=document.createElement("tbody");
		table1.appendChild(tbody1);
		
		var tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		var td1=document.createElement("td");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='Bien o servicio*';
		
		td1=document.createElement("td");
		td1.setAttribute("class","texto_mayus");
		tr1.appendChild(td1);
		
		filas_d++;
		var fd3=filas_d;
		
		campo=document.createElement("input");
		campo.setAttribute("name","accion_bs_"+filas);
		campo.setAttribute("id","accion_bs_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","");
		td1.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","datos_ant_bs_"+filas);
		campo.setAttribute("id","datos_ant_bs_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","");
		td1.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_bien_serv_"+filas);
		campo.setAttribute("id","n_bien_serv_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo=document.createElement("input");
		campo.setAttribute("name","c_bien_serv_"+filas);
		campo.setAttribute("id","c_bien_serv_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","");
		td1.appendChild(campo);
		
		onchan=function anonymous() {verifica_bien_serv(this.value);};
		
		campo_dojo=new dijit.form.Textarea({name:"t_bien_serv_"+filas, id:"i_dojo_"+filas_d, required:true, onChange:onchan});
		td1.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),position:"above, below",
			label:"Digite la descripci&oacute;n del bien o servicio."});
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='Detallado*';
		
		td1=document.createElement("td");
		td1.setAttribute("class","texto_mayus");
		tr1.appendChild(td1);
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_detallado_"+filas);
		campo.setAttribute("id","n_detallado_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.Select({name:"s_detallado_"+filas, id:"i_dojo_"+filas_d, required:true,
			options: [{ label: "NO", value: "f"},{ label: "SI", value: "t"}]});
		td1.appendChild(campo_dojo.domNode);
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("class","titulo");
		td1.setAttribute("style","font-size: 10pt;");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='RETENCI&Oacute;N EN LA FUENTE';
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("align","center");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='% Persona jur&iacute;dica';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pr_retej_"+filas);
		campo.setAttribute("id","n_pr_retej_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"t_pr_retej_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el porcentaje de retenci&oacute;n en la fuente para persona jur&iacute;dica.", required:true, tooltipPosition:"above, below"});
		td1.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='&nbsp;% Persona natural';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pr_reten_"+filas);
		campo.setAttribute("id","n_pr_reten_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"t_pr_reten_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el porcentaje de retenci&oacute;n en la fuente para persona natural.", required:true, tooltipPosition:"above, below"});
		td1.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='&nbsp;UVT';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_uvt_"+filas);
		campo.setAttribute("id","n_uvt_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"t_uvt_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite la cantidad de UVT para base de calculo de retenci&oacute;n en la fuente.", required:true, tooltipPosition:"above, below"});
		td1.appendChild(campo_dojo.domNode);
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("class","titulo");
		td1.setAttribute("style","font-size: 10pt;");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='OTROS IMPUESTOS';
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("align","center");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='% IVA';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pr_iva_"+filas);
		campo.setAttribute("id","n_pr_iva_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"t_pr_iva_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el porcentaje de IVA.", required:true, tooltipPosition:"above, below"});
		td1.appendChild(campo_dojo.domNode);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='&nbsp;% Impuesto al consumo';
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_pr_com_"+filas);
		campo.setAttribute("id","n_pr_com_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td1.appendChild(campo);
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"t_pr_com_"+filas, id:"i_dojo_"+filas_d,
			promptMessage:"Digite el porcentaje Impuesto al consumo.", required:true, tooltipPosition:"above, below"});
		td1.appendChild(campo_dojo.domNode);
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("align","center");
		tr1.appendChild(td1);
		
		filas_d++;
		var onclic=function anonymous() {if (act_bien_serv(filas.toString())==false) return false;};
		campo_dojo=new dijit.form.Button({type:"submit",name:"submit",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"Aceptar"});
		td1.appendChild(campo_dojo.domNode);
		
		filas_d++;
		campo_dojo=new dijit.form.Button({type:"submit",name:"cancel",id:"i_dojo_"+filas_d.toString(),label:"Cancelar"});
		td1.appendChild(campo_dojo.domNode);
		
		tr1=document.createElement("tr");
		tbody1.appendChild(tr1);
		
		td1=document.createElement("td");
		td1.setAttribute("colspan","2");
		td1.setAttribute("class","advertencia");
		tr1.appendChild(td1);
		
		span=document.createElement("span");
		td1.appendChild(span);
		span.innerHTML='* Campos Obligatorios';
		
		filas_d++;
		var drop_dw=new dijit.TooltipDialog({id:"i_dojo_"+filas_d,content:table1});
		
		var onclic=function anonymous() {foco(dijit.byId('i_dojo_'+fd3));cambio_bien_serv(filas.toString());};
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_dr_"+filas);
		campo.setAttribute("id","n_dr_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		campo_dojo=new dijit.form.DropDownButton({id:"i_dojo_"+filas_d,label:"Mod.",dropDown:drop_dw,onClick:onclic,disabled:true});
		td.appendChild(campo_dojo.domNode);
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_der");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		filas_d++;
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_bt_det_"+filas);
		campo.setAttribute("id","n_bt_det_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		onclic=function anonymous() {cambio_det(filas.toString());};
		campo_dojo=new dijit.form.CheckBox({name:"c_det_gen",id:"i_dojo_"+filas_d.toString(),onClick:onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("class","alineado_der");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		campo=document.createElement("input");
		campo.setAttribute("name","n_vl_det_"+filas);
		campo.setAttribute("id","n_vl_det_"+filas.toString());
		campo.setAttribute("type","hidden");
		campo.setAttribute("value","i_dojo_"+filas_d);
		td.appendChild(campo);
		
		var fd=filas_d;
		
		var onkey=function anonymous() {formatNumber(document.getElementById('i_dojo_'+fd),',','');};
		var onchan=function anonymous() {calcula_valor();};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 15em;", name:"vl_det_pago_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el valor del bien o servicio.", required:true, tooltipPosition:"above, below",onKeyUp: onkey,onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("td");
		td.setAttribute("align","center");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_det_pago();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para detalle pago."});
		
		filas_d++;
		
		onclic=function anonymous() {eli_det_pago(filas.toString());};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para detalle pago."});
		filas_d++;
		
		tr=document.createElement("tr");
		tr.setAttribute("id","tr_info_pago_"+filas.toString());
		tr.setAttribute("style","");
		tabla.insertBefore(tr, document.getElementById("tr_net_pago"));
		//tabla.appendChild(tr);
		
		td=document.createElement("td");
		td.setAttribute("colspan","5");
		td.setAttribute("class","info");
		td.setAttribute("id","td_info_pago_"+filas.toString());
		tr.appendChild(td);
	} else {
		var tabla=document.getElementById("ta_det_pago");
		var tr=document.createElement("tr");
		tr.setAttribute("<id='tr_det_pago_"+filas.toString()+"' style=''>");
		tabla.insertBefore(tr, document.getElementById("tr_net_pago"));
		//tabla.appendChild(tr);
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_cd_"+filas+"' id='n_cd_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var fd1=filas_d+1;
		var fd2=filas_d;
		
		var onchan=function anonymous() {dijit.byId('i_dojo_'+fd1).set('value',this.value);};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"5", style:"width: 5em;", name:"cd_bien_serv_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el c&oacute;digo del bien o servicio.", required:true, tooltipPosition:"above, below",onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='texto_mayus' align='center>");
		tr.appendChild(td);
		
		var campo=document.createElement("<input name='accion_dp_"+filas+"' id='accion_dp_"+filas.toString()+"' type='hidden' value='A'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='datos_ant_dp_"+filas+"' id='datos_ant_dp_"+filas.toString()+"' type='hidden' value='"+base64_encode("")+"'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_cons_dp_"+filas+"' id='t_cons_dp_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_retej_"+filas+"' id='t_retej_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_reten_"+filas+"' id='t_reten_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_uvt_"+filas+"' id='t_uvt_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_iva_"+filas+"' id='t_iva_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_consumo_"+filas+"' id='t_consumo_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_info_"+filas+"' id='t_info_"+filas.toString()+"' type='hidden' value=''>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='v_doc_dp_"+filas+"' id='v_doc_dp_"+filas.toString()+"' type='hidden' value='S'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='t_bien_serv_"+filas+"' id='t_bien_serv_"+filas.toString()+"' type='hidden'>");
		td.appendChild(campo);
		
		campo=document.createElement("<input name='n_bien_"+filas+"' id='n_bien_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var store_d=new dojo.data.ItemFileReadStore({jsId:'bien_serv_'+filas+'_store',url:"../../Stores/comboBienServicios.php?where= and bs.bse_detallado='f'",
			urlPreventCache:false,clearOnClose:true});
		
		oncha=function anonymous() {cambio_bien_serv(filas.toString());};
		
		campo_dojo=new dijit.form.FilteringSelect({name:'bien_serv_'+filas,id:'i_dojo_'+filas_d,style:"width: 430px;",onChange:oncha,
			placeHolder:"Seleccione bien o servicio",promptMessage:"Seleccione el bien o servicio.",required:true,store:store_d,searchAttr:"name",
			highlightMatch:"all",queryExpr:"*${0}*",autoComplete:false,pageSize:"20",tooltipPosition:"above,below"});
		
		td.appendChild(campo_dojo.domNode);
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		filas_d++;
		
		campo=document.createElement("<input name='n_bt_det_"+filas+"' id='n_bt_det_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		onclic=function anonymous() {cambio_det(filas.toString());};
		campo_dojo=new dijit.form.CheckBox({name:"c_det_gen",id:"i_dojo_"+filas_d.toString(),onClick:onclic});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td class='alineado_der' align='center'>");
		tr.appendChild(td);
		
		campo=document.createElement("<input name='n_vl_det_"+filas+"' id='n_vl_det_"+filas.toString()+"' type='hidden' value='i_dojo_"+filas_d+"'>");
		td.appendChild(campo);
		
		var fd=filas_d;
		
		var onkey=function anonymous() {formatNumber(document.getElementById('i_dojo_'+fd),',','');};
		var onchan=function anonymous() {calcula_valor();};
		
		campo_dojo=new dijit.form.ValidationTextBox({maxLength:"15", style:"width: 15em;", name:"fc_doc_"+filas, id:"i_dojo_"+filas_d,
		promptMessage:"Digite el valor del bien o servicio.", required:true, tooltipPosition:"above, below",onKeyUp: onkey,onChange:onchan});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		td=document.createElement("<td align='center'>");
		tr.appendChild(td);
		
		var onclic=function anonymous() {add_det_pago();};
		campo_dojo=new dijit.form.Button({type:"button",name:"b_add",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"+"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Adicionar una fila para detalle pago."});
		
		filas_d++;
		
		campo_dojo=new dijit.form.Button({type:"button",name:"b_elim",id:"i_dojo_"+filas_d.toString(),onClick:onclic,label:"-"});
		td.appendChild(campo_dojo.domNode);
		
		filas_d++;
		
		campo_dojo=new dijit.Tooltip({connectId:'i_dojo_'+(filas_d-1).toString(),id:'i_dojo_'+filas_d.toString(),
		position:"above, below",label:"Eliminar una fila para detalle pago."});
		filas_d++;
		
		tr=document.createElement("<tr id='tr_info_pago_"+filas.toString()+"' style=''>");
		tabla.insertBefore(tr, document.getElementById("tr_net_pago"));
		//tabla.appendChild(tr);
		
		td=document.createElement("<td colspan='5' class='info' id='td_info_pago_"+filas.toString()+"'>");
		tr.appendChild(td);
	}
	document.getElementById("filas_dojo").value=filas_d;
}

function eli_det_pago(no_id) {
	document.getElementById("v_doc_dp_"+no_id).value='N';
	document.getElementById("tr_det_pago_"+no_id).style.display='none';
	document.getElementById("tr_info_pago_"+no_id).style.display='none';
	calcula_valor();
}

function cambio_det(no_id) {
	if (dijit.byId(document.getElementById('n_bt_det_'+no_id).value).checked) {
		cargarCombo(dijit.byId(document.getElementById('n_bien_'+no_id).value).store,"../../Stores/comboBienServicios.php?where=");
	} else {
		if (document.getElementById('t_bien_serv_'+no_id).value=='') {
			cargarCombo(dijit.byId(document.getElementById('n_bien_'+no_id).value).store,"../../Stores/comboBienServicios.php?where= and bs.bse_detallado='f'");
		} else {
			cargarCombo(dijit.byId(document.getElementById('n_bien_'+no_id).value).store,"../../Stores/comboBienServicios.php?where= and (bs.bse_detallado='f' "+
			"or bs.bse_consecutivo="+document.getElementById('t_bien_serv_'+no_id).value+")");
		}
	}
}

function calcula_valor() {
	var vl_neto=0,vl_base=0,vl_iva=0,vl_t_iva=0,pr_iva=0,vl_consumo=0,vl_t_consumo=0,pr_consumo=0,vl_total=0,vl_retef=0,pr_retef=0,vl_t_retef=0,info='',vl_uvt=0,
	cn_uvt=0,vl_reteica=0,pr_reteica=0,vl_t_reteica=0,id_dojo=0,fl_ica=false,suc=new Array(),vl_t_rete=0,vl_t_reteiva=0,vl_cliente=0;
	iv=1;
	
	while (document.getElementById('n_bien_'+iv)) {
		
		if (document.getElementById('v_doc_dp_'+iv).value=='S') {
			
			if (str_replace(',', '', dijit.byId(document.getElementById('n_vl_det_'+iv).value).value)!=''&&
			dijit.byId(document.getElementById('n_bien_'+iv).value).value!='') {
				
				vl_base=parseInt(str_replace(',', '', dijit.byId(document.getElementById('n_vl_det_'+iv).value).value));
				info='Valor Base: $'+number_format(vl_base,0,'',',');
				
				vl_neto+=parseInt(str_replace(',', '', dijit.byId(document.getElementById('n_vl_det_'+iv).value).value));
				if (dijit.byId('i_dojo_5').value=='N'&&dijit.byId('i_dojo_39').value=='SIMPL') {
					info+='; Persona natural con r&eacute;gimen simplificado, no se hace calculo de IVA';
				} else {
					pr_iva=parseFloat(document.getElementById('t_iva_'+iv).value)/100;
					vl_iva=parseInt(pr_iva*vl_base);
					vl_t_iva+=vl_iva;
					if (vl_iva==0) info+='; Bien o servicio sin IVA';
					else info+='; T&aacute;rifa IVA: '+document.getElementById('t_iva_'+iv).value+'%; Valor IVA: $'+number_format(vl_iva,0,'',',');
				}
				
				pr_consumo=parseFloat(document.getElementById('t_consumo_'+iv).value)/100;
				vl_consumo=parseInt(pr_consumo*vl_base);
				vl_t_consumo+=vl_consumo;
				if (vl_consumo==0) info+='; Bien o servicio sin impuesto al consumo';
				else info+='; T&aacute;rifa impuesto al consumo: '+document.getElementById('t_consumo_'+iv).value+'%; Valor impuesto al consumo: $'+
				number_format(vl_consumo,0,'',',');
				
				vl_total+=vl_base+vl_iva+vl_consumo;
				
				info+='; Valor Total: $'+number_format(vl_base+vl_iva+vl_consumo,0,'',',');
				
				if (dijit.byId('i_dojo_45').value==''&&dijit.byId('i_dojo_2').value=='') {
					info+='; No se ha seleccionado cliente ni proveedor, no se hacen c&aacute;lculos de retenciones';
				} else if (dijit.byId('i_dojo_45').value=='') {
					info+='; No se ha seleccionado cliente, no se hacen c&aacute;lculos de retenciones';
				} else if (dijit.byId('i_dojo_2').value=='') {
					info+='; No se ha seleccionado proveedor, no se hacen c&aacute;lculos de retenciones';
				} else if (dijit.byId('i_dojo_39').value=='') {
					info+='; No se ha seleccionado el tipo de r&eacute;gimen del proveedor, no se hacen c&aacute;lculos de retenciones';
				} else {
					if (document.getElementById('tp_regimen_cli').value=='SIMPL') {
						info+='; El cliente es r&eacute;gimen del simplificado, no se hacen c&aacute;lculo de retenciones';
					} else if (dijit.byId('i_dojo_40').value=='t') {
						info+='; El proveedor es autorretenedor, no se hacen c&aacute;lculo de retenciones';
					} else if (dijit.byId('i_dojo_48').value=='t') {
						info+='; El proveedor esta cobijado por la 1429 de 2009, no se hacen c&aacute;lculo de retenciones';
					} else {
						vl_uvt=parseInt(document.getElementById('t_uvt').value);
						cn_uvt=parseInt(document.getElementById('t_uvt_'+iv).value);
						
						if (vl_base<vl_uvt*cn_uvt&&document.getElementById('tp_rete_todos_cli').value=='f') {
							info+='; La base es menor a '+cn_uvt+' UVT, no se hace c&aacute;lculo de retenci&oacute;n en la fuente';
						} else {
							if (vl_base<vl_uvt*cn_uvt&&document.getElementById('tp_rete_todos_cli').value=='t') {
								info+='; La base es menor a '+cn_uvt+' UVT, sin embargo por politicas de la empresa se hace c&aacute;lculo de retenci&oacute;n en la fuente';
							}
							
							if (dijit.byId('i_dojo_5').value=='N') {
								pr_retef=parseFloat(document.getElementById('t_reten_'+iv).value)/100;
								info+='; Persona natural t&aacute;rifa retenci&oacute;n en la fuente: '+document.getElementById('t_reten_'+iv).value;
								
							} else {
								pr_retef=parseFloat(document.getElementById('t_retej_'+iv).value)/100;
								info+='; Persona jur&iacute;dica t&aacute;rifa retenci&oacute;n en la fuente: '+document.getElementById('t_retej_'+iv).value;
							}
							
							vl_retef=parseInt(pr_retef*vl_base);
							
							info+='%; Valor retenci&oacute;n en la fuente: $'+number_format(vl_retef,0,'',',');
							vl_t_retef+=vl_retef;
							vl_t_rete+=vl_retef;
						}
						
						id_dojo=parseInt(document.getElementById('filas_dojo_pa').value);
						
						if (dijit.byId('i_dojo_39').value!='SIMPL'&&dijit.byId('i_dojo_46').value!='t') {
							info+='; El proveedor no es r&eacute;gimen simplificado ni de profesi&oacute;n liberal, no se hace c&aacute;lculo de retenci&oacute;n de ICA';
						} else if (dijit.byId('i_dojo_'+(id_dojo+7)).value=='') {
							info+='; No se ha seleccionado lugar de pago, no se hace c&aacute;lculo de retenci&oacute;n de ICA';
						} else {
							if (document.getElementById('ciudad_dom_cli').value==dijit.byId('i_dojo_'+(id_dojo+7)).value) {
								fl_ica=true;
							} else {
								if (document.getElementById('ciudad_suc_cli').value!='') {
									suc=arSqlArJavascript(document.getElementById('ciudad_suc_cli').value);
									for (j=0;j<count(suc);j++) {
										if (suc[j]==dijit.byId('i_dojo_'+(id_dojo+7)).value) fl_ica=true;
									}
								}
							}
							
							if (!fl_ica) {
								info+='; Lugar de pago no coincide con lugar de domicilio del cliente ni con ninguna de sus sucursales, no se hace c&aacute;lculo de '+
								'retenci&oacute;n de ICA';
							} else {
								jv=1;
								fl_ica=false;
								
								while (document.getElementById('v_ciiu_ci_'+jv)) {
									if (document.getElementById('v_ciiu_ci_'+jv).value=='S') {
										if (dijit.byId(document.getElementById('n_lug_ci_ci_'+jv).value).value==dijit.byId('i_dojo_'+(id_dojo+7)).value&&
										dijit.byId(document.getElementById('n_cre_ci_ci_'+jv).value).checked) {
											pr_reteica=parseFloat(document.getElementById('tarifa_ci_ci_'+jv).value);
											fl_ica=true;
											break
										}
									}
									jv++;
								}
								
								if (!fl_ica) {
									info+='; Lugar de pago no posee tabla de retenciones de ICA o no se selecciono "Calcula ReteICA", no se hace c&aacute;lculo de retenci&oacute;n'+
									' de ICA';
								} else {
									info+='; T&aacute;rifa retenci&oacute;n de ICA: '+round((pr_reteica*1000),2)+' por mil';
									
									vl_reteica=parseInt(pr_reteica*vl_base);
									
									info+='; Valor retenci&oacute;n de ICA: $'+number_format(vl_reteica,0,'',',');
									vl_t_reteica+=vl_reteica;
									vl_t_rete+=vl_reteica;
								}
							}
							
						}
						
						if (dijit.byId('i_dojo_42').value=='t') {
							info+='; El proveedor es gran contribuyente, no se hace c&aacute;lculo de retenci&oacute;n de IVA';
						} else if (document.getElementById('tp_gc_cli').value=='f') {
							info+='; El cliente no es gran contribuyente, no se hace c&aacute;lculo de retenci&oacute;n de IVA';
						} else {
							info+='; T&aacute;rifa retenci&oacute;n de IVA: 15% sobre el valor del IVA';
							vl_reteiva=parseInt(0.15*vl_iva);
							
							info+='; Valor retenci&oacute;n de IVA: $'+number_format(vl_reteiva,0,'',',');
							vl_t_reteiva+=vl_reteiva;
							vl_t_rete+=vl_reteiva;
						}
						
					}
				}
				
				info+='.';
				
				document.getElementById('td_info_pago_'+iv).innerHTML=info;
				document.getElementById('t_info_'+iv).value=info;
			}
		}
		iv++;
	}
	
	if (dijit.byId(document.getElementById('n_vl_pago').value).value!='') 
			vl_cliente=parseInt(str_replace(',', '', dijit.byId(document.getElementById('n_vl_pago').value).value));
	else vl_cliente=0;
	
	document.getElementById('td_neto_pago').innerHTML=number_format(vl_neto,0,'',',');
	document.getElementById('td_iva').innerHTML=number_format(vl_t_iva,0,'',',');
	document.getElementById('vl_imp_iva').value=vl_t_iva;
	document.getElementById('td_consumo').innerHTML=number_format(vl_t_consumo,0,'',',');
	document.getElementById('vl_imp_consumo').value=vl_t_consumo;
	document.getElementById('td_total_pago').innerHTML=number_format(vl_total,0,'',',');
	document.getElementById('td_retefuente').innerHTML=number_format(vl_t_retef,0,'',',');
	document.getElementById('vl_imp_retefuente').value=vl_t_retef;
	document.getElementById('td_reteica').innerHTML=number_format(vl_t_reteica,0,'',',');
	document.getElementById('vl_imp_reteica').value=vl_t_reteica;
	document.getElementById('td_reteiva').innerHTML=number_format(vl_t_reteiva,0,'',',');
	document.getElementById('vl_imp_reteiva').value=vl_t_reteiva;
	document.getElementById('td_total_rete').innerHTML=number_format(vl_t_rete,0,'',',');
	document.getElementById('td_total_aud').innerHTML=number_format(vl_total-vl_t_rete,0,'',',');
	document.getElementById('td_total_dif').innerHTML=number_format((vl_total-vl_t_rete)-vl_cliente,0,'',',');
	document.getElementById('t_total_dif').value=(vl_total-vl_t_rete)-vl_cliente;
}

function act_pago() {
	if (!valida(dijit.byId('i_dojo_45'), 'Por favor seleccione el cliente.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
		return false;
	}
	
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
	
	iap=1;
	while (document.getElementById('n_dir_suc_'+iap)) {
		if (document.getElementById('v_suc_'+iap).value=='S') {
			if (!valida(dijit.byId(document.getElementById('n_dir_suc_'+iap).value), 'Por favor digite la direcci&oacute;n de la sucursal.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_37'));
				return false;
			}
			if (!valida(dijit.byId(document.getElementById('n_ciu_suc_'+iap).value), 'Por favor digite la ciudad de la sucursal.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_37'));
				return false;
			}
		}
		iap++;
	}
	
	id_dojo_r=parseInt(document.getElementById("dojo_r").value);
	
	if (dijit.byId('i_dojo_'+id_dojo_r.toString()).value!='') {
	
		if (dijit.byId('i_dojo_'+(id_dojo_r+3).toString()).value=='J') {
			if (!valida(document.getElementById('i_dojo_'+(id_dojo_r+1).toString()), 'Por favor digite el digito de verificaci&oacute;n del representante legal.',false)){
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r-1).toString()));
				return false;
			}
		}
		
		if (document.getElementById('i_dojo_'+(id_dojo_r+1).toString()).getAttribute("aria-invalid")=='true') {
			dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_1'));
			foco(document.getElementById('i_dojo_'+(id_dojo_r+1).toString()));
			mensaje_dj('ERROR','El digito de verificaci&oacute;n no es valido.','OK','ERROR','',document.getElementById('i_dojo_'+(id_dojo_r+1).toString()));
			return false;
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
	
	iap=1;
	fl_pri=false;
	vl_pri=0;
	while (document.getElementById('n_cd_ci_'+iap)) {
		if (document.getElementById('v_ciiu_'+iap).value=='S') {
			vl_pri++;
			if (!valida(dijit.byId(document.getElementById('n_nom_ci_'+iap).value), 'Por favor seleccione la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
				return false;
			}
			
			if (dijit.byId(document.getElementById('n_pri_ci_'+iap).value).checked) fl_pri=true;
			jap=1;
			while (document.getElementById('n_cd_ci_'+jap)) {
				if (document.getElementById('v_ciiu_'+jap).value=='S') {
					if (dijit.byId(document.getElementById('n_nom_ci_'+iap).value).id!=dijit.byId(document.getElementById('n_nom_ci_'+jap).value).id) {
						if (dijit.byId(document.getElementById('n_nom_ci_'+iap).value).value==dijit.byId(document.getElementById('n_nom_ci_'+jap).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
							foco(dijit.byId(document.getElementById('n_nom_ci_'+jap)));
							mensaje_dj('ERROR','Se encuentra repetida la actividad econ&oacute;mica.','OK','ERROR','',dijit.byId(document.getElementById('n_nom_ci_'+jap)));
							return false;
						}
					}
				}
				jap++;
			}
		}
		iap++;
	}
	
	if (vl_pri>0&&!fl_pri) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+(id_dojo_r+34).toString()));
		foco(dijit.byId(document.getElementById('n_pri_ci_1')));
		mensaje_dj('ERROR','No se escogio la actividad econ&oacute;mica principal.','OK','ERROR','',dijit.byId(document.getElementById('n_pri_ci_1')));
		return false;
	}
	
	iap=1;
	while (document.getElementById('n_cd_ci_ci_'+iap)) {
		if (document.getElementById('v_ciiu_ci_'+iap).value=='S') {
			if (!valida(dijit.byId(document.getElementById('n_lug_ci_ci_'+iap).value), 'Por favor seleccione el lugar de la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
				return false;
			}
			
			if (!valida(dijit.byId(document.getElementById('n_nom_ci_ci_'+iap).value), 'Por favor seleccione la actividad econ&oacute;mica.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
				return false;
			}
			
			jap=1;
			while (document.getElementById('n_cd_ci_ci_'+jap)) {
				if (document.getElementById('v_ciiu_ci_'+jap).value=='S') {
					if (dijit.byId(document.getElementById('n_lug_ci_ci_'+iap).value).id!=dijit.byId(document.getElementById('n_lug_ci_ci_'+jap).value).id) {
						if (dijit.byId(document.getElementById('n_lug_ci_ci_'+iap).value).value==dijit.byId(document.getElementById('n_lug_ci_ci_'+jap).value).value&&
								dijit.byId(document.getElementById('n_nom_ci_ci_'+iap).value).value==dijit.byId(document.getElementById('n_nom_ci_ci_'+jap).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+document.getElementById('filas_dojo_ci_ci').value));
							foco(dijit.byId(document.getElementById('n_lug_ci_ci_'+iap)));
							mensaje_dj('ERROR','El lugar y la actividad econ&oacute;mica se encuentran repetidas.','OK','ERROR','',
									dijit.byId(document.getElementById('n_lug_ci_ci_'+iap)));
							return false;
						}
					}
				}
				jap++;
			}
		}
		iap++;
	}
	
	id_dojo_r=parseInt(document.getElementById("filas_dojo_do").value);
	
	iap=1;
	while (document.getElementById('n_tp_do_'+iap)) {
		if (document.getElementById('v_doc_pr_'+iap).value=='S') {
			
			if (!valida(dijit.byId(document.getElementById('n_tp_do_'+iap).value), 'Por favor seleccione el tipo de documento.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				return false;
			}
			
			if (!valida(document.getElementById(document.getElementById('n_fc_doc_'+iap).value), 'Por favor seleccione la fecha de documento.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				return false;
			}
			
			if (document.getElementById(document.getElementById('n_fc_doc_'+iap).value).getAttribute("aria-invalid")=='true') {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				foco(document.getElementById(document.getElementById('n_fc_doc_'+iap).value));
				mensaje_dj('ERROR','La fecha de documento no es valida.','OK','ERROR','',document.getElementById(document.getElementById('n_fc_doc_'+iap).value));
				return false;
			}
			jap=1;
			while (document.getElementById('n_tp_do_'+jap)) {
				if (document.getElementById('v_doc_pr_'+jap).value=='S') {
					if (dijit.byId(document.getElementById('n_tp_do_'+iap).value).id!=dijit.byId(document.getElementById('n_tp_do_'+jap).value).id) {
						if (dijit.byId(document.getElementById('n_tp_do_'+iap).value).value==dijit.byId(document.getElementById('n_tp_do_'+jap).value).value&&
								document.getElementById(document.getElementById('n_fc_doc_'+iap).value).value==
									document.getElementById(document.getElementById('n_fc_doc_'+jap).value).value) {
							dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
							foco(dijit.byId(document.getElementById('n_tp_do_'+jap)));
							mensaje_dj('ERROR','Se encuentra repetida el tipo de documento con la misma fecha.','OK','ERROR','',
									dijit.byId(document.getElementById('n_tp_do_'+jap)));
							return false;
						}
					}
				}
				jap++;
			}
		}
		iap++;
	}
	
	id_dojo_r=parseInt(document.getElementById("filas_dojo_pa").value);
	
	if (!valida(document.getElementById(document.getElementById('n_fc_pago').value), 'Por favor seleccione la fecha de pago.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId(dijit.byId('i_dojo_'+id_dojo_r.toString())));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_ciudad_pago').value), 'Por favor seleccione la ciudad de generaci&oacute;n del cobro.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId(dijit.byId('i_dojo_'+id_dojo_r.toString())));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_vl_pago').value), 'Por favor el valor del pago generado por el cliente.',false)) {
		dijit.byId('i_dojo_0').selectChild(dijit.byId(dijit.byId('i_dojo_'+id_dojo_r.toString())));
		return false;
	}
	
	iap=1;
	while (document.getElementById('v_doc_dp_'+iap)) {
		if (document.getElementById('v_doc_dp_'+iap).value=='S') {
			if (!valida(dijit.byId(document.getElementById('n_bien_'+iap).value), 'Por favor seleccione el bien o servicio.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId(dijit.byId('i_dojo_'+id_dojo_r.toString())));
				return false;
			}
			
			if (!valida(dijit.byId(document.getElementById('n_vl_det_'+iap).value), 'Por favor digite el valor del bien o servicio.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId(dijit.byId('i_dojo_'+id_dojo_r.toString())));
				return false;
			}
			
		}
		iap++;
	}
	
	id_dojo_r=parseInt(document.getElementById("filas_dojo_do_pa").value);
	
	iap=1;
	while (document.getElementById('n_tp_do_da_'+iap)) {
		if (document.getElementById('v_doc_pa_'+iap).value=='S') {
			
			if (!valida(dijit.byId(document.getElementById('n_tp_do_da_'+iap).value), 'Por favor seleccione el tipo de documento.',false)) {
				dijit.byId('i_dojo_0').selectChild(dijit.byId('i_dojo_'+id_dojo_r.toString()));
				return false;
			}
			
		}
		i++;
	}
	
	document.getElementById('barra_proc').style.display='';
	document.getElementById('datos').style.display='none';
	
	var peticion=false,envio='',fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function() {
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				foco(dijit.byId('i_dojo_2'));
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId('i_dojo_2'));
				document.getElementById('barra_proc').style.display='none';
				document.getElementById('datos').style.display='';
			} else {
				
				dijit.byId('ventana').hide();
				consultar();
				if (document.getElementById('t_total_dif').value!='0') mensaje_dj('INFORMACI&Oacute;N','Existe una diferencia de $'+
						number_format(document.getElementById('t_total_dif').value,0,'',','),'OK','INFO','','');
			}
			return false;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vPago')+'&accion_d='+base64_encode(document.getElementById('accion_d').value)+'&accion_p='+
	base64_encode(document.getElementById('accion_p').value)+'&accion_r='+base64_encode(document.getElementById('accion_r').value)+'&accion_pg='+
	base64_encode(document.getElementById('accion_pg').value)+'&no_pago='+
	base64_encode(document.getElementById('no_pago').value)+'&datos_ant_d='+
	reemp_carac_esp_js(document.getElementById('datos_ant_d').value)+'&datos_ant_p='+
	reemp_carac_esp_js(document.getElementById('datos_ant_p').value)+'&datos_ant_r='+
	reemp_carac_esp_js(document.getElementById('datos_ant_r').value)+'&datos_ant_pg='+
	reemp_carac_esp_js(document.getElementById('datos_ant_pg').value)+'&filas_suc='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_suc').value))+'&filas_ciiu='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_ciiu').value))+'&filas_doc_pr='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_doc_pr').value))+'&filas_doc_pa='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_doc_pa').value))+'&filas_ciiu_ci='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_ciiu_ci').value))+'&filas_det_pago='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_det_pago').value))+'&filas_imp_s='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_imp_s').value))+'&filas_imp_r='+
	base64_encode(reemp_carac_esp_js(document.getElementById('filas_imp_r').value))+'&cd_principal='+
	base64_encode(reemp_carac_esp_js(document.getElementById('cd_principal').value));
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_suc').value);iap++){
		envio+='&v_suc_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_suc_'+iap).value))
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_ciiu').value);iap++){
		envio+='&v_ciiu_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_ciiu_'+iap).value))+'&datos_ant_ci_'+iap+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_ci_'+iap).value)+'&accion_ci_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_ci_'+iap).value))
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_doc_pr').value);iap++){
		envio+='&v_doc_pr_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_doc_pr_'+iap).value))+'&datos_ant_do_'+iap+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_do_'+iap).value)+'&accion_do_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_do_'+iap).value))
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_doc_pa').value);iap++){
		envio+='&v_doc_pa_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_doc_pa_'+iap).value))+'&datos_ant_do_pa_'+iap+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_do_pa_'+iap).value)+'&accion_do_pa_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_do_pa_'+iap).value))+'&t_cons_do_pa_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('t_cons_do_pa_'+iap).value))
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_det_pago').value);iap++){
		envio+='&v_doc_dp_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_doc_dp_'+iap).value))+'&datos_ant_dp_'+iap+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_dp_'+iap).value)+'&accion_dp_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_dp_'+iap).value))+'&t_info_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('t_info_'+iap).value))+'&t_cons_dp_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('t_cons_dp_'+iap).value))
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_imp_s').value);iap++){
		envio+='&datos_ant_is_'+iap+'='+reemp_carac_esp_js(document.getElementById('datos_ant_is_'+iap).value)+'&accion_is_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_is_'+iap).value))+'&cd_imp_s_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('cd_imp_'+document.getElementById('n_imp_s_'+iap).value).value))+'&vl_imp_s_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('vl_imp_'+document.getElementById('n_imp_s_'+iap).value).value));
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_imp_r').value);iap++){
		envio+='&datos_ant_ir_'+iap+'='+reemp_carac_esp_js(document.getElementById('datos_ant_ir_'+iap).value)+'&accion_ir_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_ir_'+iap).value))+'&cd_imp_r_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('cd_imp_'+document.getElementById('n_imp_r_'+iap).value).value))+'&vl_imp_r_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('vl_imp_'+document.getElementById('n_imp_r_'+iap).value).value));
	}
	
	for (iap=1;iap<=parseInt(document.getElementById('filas_ciiu_ci').value);iap++){
		envio+='&v_ciiu_ci_'+iap+'='+base64_encode(reemp_carac_esp_js(document.getElementById('v_ciiu_ci_'+iap).value))+'&datos_ant_ci_ci_'+iap+'='+
		reemp_carac_esp_js(document.getElementById('datos_ant_ci_ci_'+iap).value)+'&accion_ci_ci_'+iap+'='+
		base64_encode(reemp_carac_esp_js(document.getElementById('accion_ci_ci_'+iap).value));
		if (dijit.byId(document.getElementById('n_pri_ci_ci_'+iap).value).checked) envio+='&cd_principal_ci_'+iap+'='+base64_encode(reemp_carac_esp_js('t'));
		else envio+='&cd_principal_ci_'+iap+'='+base64_encode(reemp_carac_esp_js('f'));
	}
	
	iap=0;
	while (dijit.byId('i_dojo_'+iap)) {
		if (dijit.byId('i_dojo_'+iap).name=='digito_v'||dijit.byId('i_dojo_'+iap).name=='digito_v_r')
			envio+='&'+dijit.byId('i_dojo_'+iap).name+'='+base64_encode(reemp_carac_esp_js(document.getElementById('i_dojo_'+iap).value));
		else
			envio+='&'+dijit.byId('i_dojo_'+iap).name+'='+base64_encode(reemp_carac_esp_js(dijit.byId('i_dojo_'+iap).value));
		iap++;
	}
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return false;
}

function act_bien_serv(no_id) {
	
	id_dojo_r=parseInt(document.getElementById("filas_dojo_do_pa").value);
	
	if (!valida(dijit.byId(document.getElementById('n_bien_serv_'+no_id).value), 'Por favor digite la descripci&oacute;n del bien o servicio.',false)) {
		foco(dijit.byId(document.getElementById('n_bien_serv_'+no_id).value));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_pr_reten_'+no_id).value), 
			'Por favor digite el porcentaje de retenci&oacute;n en la fuente para persona natural.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId(document.getElementById('n_pr_reten_'+no_id).value).value)) {
		mensaje_dj('ERROR','El porcentaje de retenci&oacute;n en la fuente para persona natural no es numerico.','OK','ERROR','',
				dijit.byId(document.getElementById('n_pr_reten_'+no_id).value));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_pr_retej_'+no_id).value), 
			'Por favor digite el porcentaje de retenci&oacute;n en la fuente para persona jur&iacute;dica.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId(document.getElementById('n_pr_retej_'+no_id).value).value)) {
		mensaje_dj('ERROR','El porcentaje de retenci&oacute;n en la fuente para persona jur&iacute;dica no es numerico.','OK','ERROR','',
				dijit.byId(document.getElementById('n_pr_retej_'+no_id).value));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_uvt_'+no_id).value), 
			'Por favor digite la cantidad de UVT para base.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId(document.getElementById('n_uvt_'+no_id).value).value)) {
		mensaje_dj('ERROR','La cantidad de UVT para base no es numerico.','OK','ERROR','',dijit.byId(document.getElementById('n_uvt_'+no_id).value));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_pr_iva_'+no_id).value), 
			'Por favor digite porcentaje de IVA.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId(document.getElementById('n_pr_iva_'+no_id).value).value)) {
		mensaje_dj('ERROR','El procentaje de IVA no es numerico.','OK','ERROR','',dijit.byId(document.getElementById('n_pr_iva_'+no_id).value));
		return false;
	}
	
	if (!valida(dijit.byId(document.getElementById('n_pr_com_'+no_id).value), 
			'Por favor digite porcentaje de impuesto al consumo.',false)) {
		return false;
	}
	
	if (isNaN(dijit.byId(document.getElementById('n_pr_com_'+no_id).value).value)) {
		mensaje_dj('ERROR','El procentaje de impuesto al consumo no es numerico.','OK','ERROR','',dijit.byId(document.getElementById('n_pr_com_'+no_id).value));
		return false;
	}
	
	var peticion=false,envio='',fragment_url='../../Controlador/AdicionarModificar.php';
	peticion=object();
	
	peticion.open("POST", fragment_url, true);
	peticion.onreadystatechange = function(){ 
		if (peticion.readyState == 4) {
			if (peticion.responseText!='') {
				foco(dijit.byId(document.getElementById('n_bien_serv_'+no_id).value));
				mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',dijit.byId(document.getElementById('n_bien_serv_'+no_id).value));
			} else {
				
				i=1;
				while (document.getElementById('v_doc_dp_'+i)) {
					if (document.getElementById('v_doc_dp_'+i).value=='S') {
						dijit.byId(document.getElementById('n_bien_'+i).value).store.url='../../Stores/comboBienServicios.php?where';
						dijit.byId(document.getElementById('n_bien_'+i).value).store.close();
					}
					i++;
				}
				
				if (no_id=='0') {
					dijit.byId(document.getElementById('n_bien_serv_'+no_id).value).set('value','');
					dijit.byId(document.getElementById('n_pr_reten_'+no_id).value).set('value','');
					dijit.byId(document.getElementById('n_pr_retej_'+no_id).value).set('value','');
					dijit.byId(document.getElementById('n_uvt_'+no_id).value).set('value','');
					dijit.byId(document.getElementById('n_pr_iva_'+no_id).value).set('value','');
					dijit.byId(document.getElementById('n_pr_com_'+no_id).value).set('value','');
				} else {
					document.getElementById('t_retej_'+no_id).value=dijit.byId(document.getElementById('n_pr_retej_'+no_id).value).value;
					document.getElementById('t_reten_'+no_id).value=dijit.byId(document.getElementById('n_pr_reten_'+no_id).value).value;
					document.getElementById('t_uvt_'+no_id).value=dijit.byId(document.getElementById('n_uvt_'+no_id).value).value;
					document.getElementById('t_iva_'+no_id).value=dijit.byId(document.getElementById('n_pr_iva_'+no_id).value).value;
					document.getElementById('t_consumo_'+no_id).value=dijit.byId(document.getElementById('n_pr_com_'+no_id).value).value;
					calcula_valor();
				}
			}
			return true;
		}
	}
	
	peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	envio='ventana='+base64_encode('vBienServicio')+'&accion='+base64_encode(document.getElementById('accion_bs_'+no_id).value)+'&datos_ant='+
	reemp_carac_esp_js(document.getElementById('datos_ant_bs_'+no_id).value)+'&c_bien_servicio='+base64_encode(reemp_carac_esp_js(document.getElementById('c_bien_serv_'+
	no_id).value))+'&bien_servicio='+base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_bien_serv_'+no_id).value).value))+'&pr_retefuenten='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_pr_reten_'+no_id).value).value))+'&pr_retefuentej='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_pr_retej_'+no_id).value).value))+'&vl_uvt='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_uvt_'+no_id).value).value))+'&pr_iva='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_pr_iva_'+no_id).value).value))+'&pr_consumo='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_pr_com_'+no_id).value).value))+'&detallado='+
	base64_encode(reemp_carac_esp_js(dijit.byId(document.getElementById('n_detallado_'+no_id).value).value));
	
	envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
	peticion.send(envio);
	return true;
}
