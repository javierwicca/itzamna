<html>
	<head>
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<style type="text/css">
			@import "../../dojo/dojox/grid/enhanced/resources/claroEnhancedGrid.css";
		</style>
		<script type="text/javascript" src="../../Javascript/Auditoria/bienesServicios.js">
			
			
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
													<input name="action" id="action" value="consultarBienServicios" type="hidden">
													<input name="fechaInicio" id="fechaInicio" type="hidden">
													<input name="list_tipo" id="list_tipo" type="hidden">
													<input name="list_delimitado" id="list_delimitado" type="hidden">
													<input name="list_otro" id="list_otro" type="hidden">
													<input name="list_t_bien_servi" id="list_t_bien_servi" type="hidden">
													ARGUMENTOS
												</td>
											</tr>
											<tr>
												<td>
													<div id="argumentos" style="display: ;">
														<table cellpadding="2" cellspacing="2">
															<tbody>
																<tr>
																	<td class="texto_negrilla">Detallado</td>
																	<td id="texto_mayus">
																		<select name="list_s_detallado" id="list_s_detallado" dojoType="dijit.form.Select" onchange="cambio_det(this.value);">
																			<option value="'f'">NO</option>
																			<option value="'f','t'">SI</option>
																		</select>
																	</td>
																</tr>
																<tr>
																	<td class="texto_negrilla">Bien/Servicio</td>
																	<td id="texto_mayus">
																		<span dojoType="dojo.data.ItemFileReadStore" jsId="list_t_bien_servicio_store" 
																		url="../../Stores/comboBienServicios.php?where= and bs.bse_detallado='f'" urlPreventCache="false" clearOnClose="true" 
																		id="list_t_bien_servicio_store"></span>
																		<input dojoType="dijit.form.ComboBox" store="list_t_bien_servicio_store" searchAttr="name" highlightMatch="all"
																		queryExpr="*${0}*" style="width: 500px;" name="list_t_bien_servicio" id="list_t_bien_servicio" autoComplete="false" pageSize="20"
																		placeHolder="Seleccione el bien o servicio" promptMessage="Seleccione el bien o servicio." required="false" 
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
											..:: BIENES Y SERVICIOS ::..
										</div>
										<center id="botones">
										</center>
										<div id="grid_bie"></div>
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
