<html>
	<head>
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<style type="text/css">
			@import "../../dojo/dojox/grid/enhanced/resources/claroEnhancedGrid.css";
			@import "../../dojo/dojo/resources/dojo.css";
			@import "../../dojo/dojo/resources/dnd.css";
			@import "../../dojo/dojo/resources/dndDefault.css";
		</style>
		<script type="text/javascript" src="../../Javascript/Auditoria/cuentaPuc.js">
		</script>
	</head>
	<body class="claro" onload="inicio();">
		<center>
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td class="fila_info">
						<table width="100%">
							<tr>
								<td valign="top" width="2%" id="td_menu">
								</td>
								<td valign="top">
									<form action="" name="f_consulta" method="post" onsubmit="return consultar();">
										<table class="tabla_login" align="center">
											<tr>
												<td id="tit_tabla" onclick="Effect.toggle('argumentos','slide'); return false;">
													<span dojoType="dijit.Tooltip" connectId="tit_tabla" id="tit_tabla_tooltip">
														Oculte o muestre argumentos<br>
														dando click aqu&iacute;.
													</span>
													<input name="action" id="action" value="consultarCuentaPuc" type="hidden">
													<input name="fechaInicio" id="fechaInicio" type="hidden">
													<input name="list_t_cuenta_puc" id="list_t_cuenta_puc" type="hidden">
													<input name="list_tipo" id="list_tipo" type="hidden">
													<input name="list_delimitado" id="list_delimitado" type="hidden">
													<input name="list_otro" id="list_otro" type="hidden">
													<input name="list_t_cliente" id="list_t_cliente" type="hidden">
													ARGUMENTOS
												</td>
											</tr>
											<tr>
												<td>
													<div id="argumentos" style="display: ;">
														<table cellpadding="2" cellspacing="2">
															<tbody>
																<tr>
																	<td class="texto_negrilla">Cuenta PUC</td>
																	<td id="texto_mayus">
																		<input maxlength="20" style="width: 8em;" name="list_t_cta_puc" id="list_t_cta_puc" dojoType="dijit.form.NumberTextBox" 
																		promptMessage="Digite la cuenta PUC." constraints="{places:0,min:0,max:99999999999999999999}">
																	</td>
																</tr>
																<tr>
																	<td class="texto_negrilla">Nombre Cuenta</td>
																	<td id="texto_mayus">
																		<input type="text" maxlength="70" style="width: 30em;" name="list_t_nombre_puc" id="list_t_nombre_puc" 
																		dojoType="dijit.form.ValidationTextBox" promptMessage="Digite el nombre de la cuenta." trim="true" uppercase="true" required="true" 
																		tooltipPosition="above, below" required="false">
																	</td>
																</tr>
																<tr>
																	<td><div class="texto_negrilla">Cliente</div></td>
																	<td id="texto_mayus">
																		<span dojoType="dojo.data.ItemFileReadStore" jsId="list_t_nm_cliente_store" url="../../Stores/comboClientes.php" 
																		urlPreventCache="false" clearOnClose="true" id="list_t_nm_cliente_store"></span>
																		<input dojoType="dijit.form.ComboBox" store="list_t_nm_cliente_store" searchAttr="name" highlightMatch="all"
																		queryExpr="*${0}*" style="width: 390px;" name="list_t_nm_cliente" id="list_t_nm_cliente" autoComplete="false" pageSize="20"
																		placeHolder="Seleccione el nombre del cliente" promptMessage="Seleccione el nombre del cliente" required="false" 
																		tooltipPosition="above,below">
																	</td>
																</tr>
																<tr>
																	<td colspan="2" align="center">
																		<button type="submit" name="list_s_consultar" id="list_s_consultar" dojoType="dijit.form.Button" class="texto_negrilla">
																			Consultar
																		</button>
																		<span dojoType="dijit.Tooltip" connectId="list_s_consultar" id="list_s_consultar_tooltip"
																		position="above, below">
																			Consultar de acuerdo a los argumentos.
																		</span>
																	</td>
																</tr>
															</tbody>
														</table>
													</div>
												</td>
											</tr>
										</table>
										<br>
										<div class="titulo">
											..:: PLAN &Uacute;NICO DE CUENTAS ::..
										</div>
										<center id="botones">
										</center>
										<div id="grid_cta"></div>
										<div id="nhd" class="advertencia" style="display: none;">NO EXISTEN DATOS COINCIDENTES PARA LA CONSULTA REALIZADA</div>
										<div style="text-align: left; font-weight: bold; display: none;" id="i_totales">
											<span style="color: blue;" id="i_total">TOTAL:</span>
										</div>
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td id="td_pie_pagina">
					</td>
				</tr>
			</table>
		</center>
	</body>
</html>
