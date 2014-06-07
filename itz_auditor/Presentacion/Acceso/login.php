<html>
	<head id="cabeza">
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<script type="text/javascript">
			function validar(){
				if (!valida(document.getElementById('usr'), 'Por Favor Digite el Usuario.',true)) return false;
				
				if (!valida(document.getElementById('passwd'), 'Por Favor Digite la Contrase&ntilde;a.',true)) return false;
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
								datos=explode('##',peticion.responseText)
								foco(document.getElementById(datos[2]));
								if (datos[3]=='detener') mensaje_dj(datos[0],datos[1],'OK',datos[0],'',document.getElementById(datos[2]));
								else mensaje_dj(datos[0],datos[1],'OK',datos[0],'Acceso/cambioClave.php',document.getElementById(datos[2]));
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
				envio+='&fechaInicio='+parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.getElementById('fechaInicio').value;
				peticion.send(envio);
			}
			
			function inicio() {
				parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - ACCESO';
				foco(document.f_usuario.usr);
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
									<table style="text-align: left; width: 300px;" height="150px" border="0" cellpadding="2" cellspacing="2" 
									class='tabla_login'>
										<tbody>
											<tr>
												<td valign="bottom">Usuario:</td>
												<td valign="bottom" id="alineado_der">
													<input name="usr" id="usr" value="" dojoType="dijit.form.ValidationTextBox" required="true" 
													promptMessage="Digite el usuario.">
												</td>
											</tr>
											<tr>
												<td>Contrase&ntilde;a:</td>
												<td id="alineado_der">
													<input name="passwd" id="passwd" type="password" dojoType="dijit.form.ValidationTextBox" required="true" 
													promptMessage="Digite la contrase&ntilde;a.">
													<input type="hidden" name="action" id="action" value="acceso">
												</td>
											</tr>
											<tr>
												<td style="text-align: center;" colspan="2">
													<button name="cblogin" id="cblogin" value="Ingresar" type="submit" dojoType="dijit.form.Button" 
													style="color: black;">Aceptar
													</button>
													<span dojoType="dijit.Tooltip" connectId="cblogin" id="cblogin_tooltip">Ingresar.</span>
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
