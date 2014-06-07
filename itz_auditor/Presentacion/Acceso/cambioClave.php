<html>
	<head>
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<script type="text/javascript">
			function validar(){
				
				if (!valida(document.getElementById('passwd_ant'), 'Por favor digite la anterior contrase&ntilde;a.',true)) return false;
				
				if (!valida(document.getElementById('passwd_nv'), 'Por favor digite la nueva contrase&ntilde;a.',true)) return false;
				
				if (!valida(document.getElementById('passwd_co'), 'Por favor confirme la contrase&ntilde;a.',true)) return false;
				
				if (document.getElementById('passwd_nv').value!=document.getElementById('passwd_co').value) {
					mensaje_dj('ERROR','La contrase&ntilde;a nueva no coincide con la de confirmaci&oacute;n','OK','ERROR','',document.getElementById('passwd_nv'));
					return false;
				}
				
				cargarDatos ();
				return false;
			}
			
			function cargarDatos () {
				var peticion=false,envio='',datos= new Array();
				peticion=object();
				fragment_url='../../Controlador/Control.php';
				peticion.open("POST", fragment_url, true);
				peticion.onreadystatechange = function(){ 
						if (peticion.readyState == 4) {
							if (peticion.responseText!='') {
								foco(document.getElementById('passwd_ant'));
								mensaje_dj('ERROR',peticion.responseText,'OK','ERROR','',document.getElementById('passwd_ant'));
							} else {
								cargarSesion ('Acceso/modulos.php',true,'../../',parent.document.getElementById(window.name).parentNode);
							}
						}
				}
				peticion.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				
				for (i=0;i<document.f_usuario.elements.length;i++) {
					if (document.f_usuario.elements[i].name!='') {
						if (envio!='') envio+='&';
						envio+=document.f_usuario.elements[i].name+'='+base64_encode(document.f_usuario.elements[i].value);
					}
				}
				
				envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value
				peticion.send(envio);
			}
			
			function inicio() {
				parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - CAMBIO CONTRASEÑA';
				foco(document.f_usuario.passwd_ant);
			}
			
			dojo.require("dijit.form.ValidationTextBox");
			dojo.require("dijit.form.Button");
		</script>
	</head>
	<body onload="inicio();" id="login_principal" class="claro">
		<center>
			<div style="vertical-align: middle;">
				<table width="100%" height="100%">
					<tr> 
						<td>
							<center>
								<form method="post" name="f_usuario" id="f_usuario" onsubmit="return validar();">
									<input name="fechaInicio" id="fechaInicio" type="hidden">
									<table style="text-align: left; width: 350px;" height="150px" border="0" cellpadding="2" cellspacing="2" 
									class='tabla_login'>
										<tbody>
											<tr>
												<td>Anterior Contrase&ntilde;a*</td>
												<td id="alineado_der">
													<input name="passwd_ant" id="passwd_ant" type="password" dojoType="dijit.form.ValidationTextBox" required="true" 
													promptMessage="Digite la anterior contrase&ntilde;a.">
													<input type="hidden" name="action" id="action" value="cambioClave">
												</td>
											</tr>
											<tr>
												<td>Nueva Contrase&ntilde;a*</td>
												<td id="alineado_der">
													<input name="passwd_nv" id="passwd_nv" type="password" dojoType="dijit.form.ValidationTextBox" required="true" 
													promptMessage="Digite la nueva contrase&ntilde;a." onkeyup="mostrarSeguridad(document.f_usuario.passwd_nv.value)">
												</td>
											</tr>
											<tr>
												<td>Confirmar Contrase&ntilde;a*</td>
												<td id="alineado_der">
													<input name="passwd_co" id="passwd_co" type="password" dojoType="dijit.form.ValidationTextBox" required="true" 
													promptMessage="Confirme la contrase&ntilde;a.">
												</td>
											</tr>
											<tr>
												<td colspan="2">
													<div id="seguridad"></div>
												</td>
											</tr>
											<tr>
												<td style="text-align: center;" colspan="2">
													<button name="cblogin" id="cblogin" value="Ingresar" type="submit" dojoType="dijit.form.Button">Aceptar
													</button>
													<span dojoType="dijit.Tooltip" connectId="cblogin" id="cblogin_tooltip">Cambiar clave.</span>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
							</center>
						</td>
					</tr>
					<tr>
				</table>
			</div>
		</center>
	</body>
</html>
