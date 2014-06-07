<html>
	<head>
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<style type="text/css">
			@import "../../dojo/dojox/grid/enhanced/resources/claroEnhancedGrid.css";
			@import "../../dojo/dojo/resources/dojo.css";
			@import "../../dojo/dojo/resources/dnd.css";
			@import "../../dojo/dojo/resources/dndDefault.css";
		</style>
		<script type="text/javascript" src="../../Javascript/Auditoria/saldos.js">
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
													<input name="action" id="action" value="consultarMovimiento" type="hidden">
													<input name="fechaInicio" id="fechaInicio" type="hidden">
													<input name="list_t_cliente" id="list_t_cliente" type="hidden">
													<input name="list_t_numero_comprobante" id="list_t_numero_comprobante" type="hidden">
													<input name="list_t_codigo_comprobante" id="list_t_codigo_comprobante" type="hidden">
													<input name="list_t_anio_mes" id="list_t_anio_mes" type="hidden">
													<input name="list_t_consecutivo" id="list_t_consecutivo" type="hidden">
													<input name="list_tipo" id="list_tipo" type="hidden">
													<input name="list_delimitado" id="list_delimitado" type="hidden">
													<input name="list_otro" id="list_otro" type="hidden">
													ARGUMENTOS
												</td>
											</tr>
											<tr>
												<td>
													<div id="argumentos" style="display: ;">
														<table cellpadding="2" cellspacing="2">
															<tbody>
																<tr>
																	<td class="texto_negrilla">Cliente</td>
																	<td id="texto_mayus">
																		<span dojoType="dojo.data.ItemFileReadStore" jsId="list_t_nm_cliente_store" url="../../Stores/comboClientes.php" 
																		urlPreventCache="false" clearOnClose="true" id="list_t_nm_cliente_store"></span>
																		<input dojoType="dijit.form.ComboBox" store="list_t_nm_cliente_store" searchAttr="name" highlightMatch="all"
																		queryExpr="*${0}*" style="width: 390px;" name="list_t_nm_cliente" id="list_t_nm_cliente" autoComplete="false" pageSize="20"
																		placeHolder="Seleccione el nombre del cliente" promptMessage="Seleccione el nombre del cliente" required="false" 
																		tooltipPosition="above,below" onchange="cambio_cliente(this.value);">
																	</td>
																</tr>
																<tr>
																	<td colspan="2">
																		<input name="filas_cta_puc" id="filas_cta_puc" value="1" type="hidden">
																		<table>
																			<tbody id="ta_cta_puc">
																				<tr id="tr_cta_puc_1">
																					<td class="texto_negrilla">Cuenta PUC</td>
																					<td class="texto_mayus">
																						<select name="list_s_cond_cp" id="list_s_cond_cp" dojoType="dijit.form.Select" required="false" 
																						onchange="cambio_cond('cta_puc',this.value);">
																							<option value="IGUAL">IGUAL</option>
																							<option value="DIFERENTE">DIFERENTE</option>
																							<option value="EMPIEZA CON">EMPIEZA CON</option>
																							<option value="TERMINA EN">TERMINA EN</option>
																							<option value="CONTIENE">CONTIENE</option>
																							<option value="ENTRE">ENTRE</option>
																							<option value="VARIAS">VARIAS</option>
																						</select>
																					</td>
																					<td class="texto_mayus">
																						<input maxlength="20" style="width: 8em;" name="list_t_cta_puc[]" id="list_t_cta_puc_1" dojoType="dijit.form.ValidationTextBox" 
																						promptMessage="Digite la cuenta PUC.">
																					</td>
																					<td id="s_cta_puc_e" style="display: none;" class="texto_mayus">
																						<span style="font-weight: bold;">Y</span>
																						<input maxlength="20" style="width: 8em;" name="list_t_cta_puc_f" id="list_t_cta_puc_f" 
																						dojoType="dijit.form.ValidationTextBox" promptMessage="Digite la cuenta PUC.">
																					</td>
																					<td id="s_cta_puc_v" align="center" style="display: none;">
																						<button type="button" name="b_add_cta_puc" id="b_add_cta_puc" onclick="crear_det('cta_puc')"
																						dojoType="dijit.form.Button">+</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td colspan="2">
																		<input name="filas_fc_mov" id="filas_fc_mov" value="1" type="hidden">
																		<table>
																			<tbody id="ta_fc_mov">
																				<tr id="tr_fc_mov_1">
																					<td class="texto_negrilla">Fecha</td>
																					<td class="texto_mayus">
																						<select name="list_s_cond_fm" id="list_s_cond_fm" dojoType="dijit.form.Select" required="false" 
																						onchange="cambio_cond('fc_mov',this.value);">
																							<option value="IGUAL">IGUAL</option>
																							<option value="DIFERENTE">DIFERENTE</option>
																							<option value="MAYOR O IGUAL A">MAYOR O IGUAL A</option>
																							<option value="MAYOR A">MAYOR A</option>
																							<option value="MENOR O IGUAL A">MENOR O IGUAL A</option>
																							<option value="MENOR A">MENOR A</option>
																							<option value="ENTRE">ENTRE</option>
																							<option value="VARIAS">VARIAS</option>
																						</select>
																					</td>
																					<td class="alineado_cen">
																						<input maxlength="10" style="width: 8em;" name="list_t_fc_mov[]" id="list_t_fc_mov_1" dojoType="dijit.form.DateTextBox" 
																						promptMessage="Seleccione la fecha de movimiento.">
																					</td>
																					<td id="s_fc_mov_e" style="display: none;" class="alineado_cen">
																						<span style="font-weight: bold;">Y</span>
																						<input maxlength="10" style="width: 8em;" name="list_t_fc_mov_f" id="list_t_fc_mov_f" 
																						dojoType="dijit.form.DateTextBox" promptMessage="Seleccione la fecha de movimiento">
																					</td>
																					<td id="s_fc_mov_v" align="center" style="display: none;">
																						<button type="button" name="b_add_fc_mov" id="b_add_fc_mov" onclick="crear_det('fc_mov')"
																						dojoType="dijit.form.Button">+</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr>
																	<td colspan="2">
																		<input name="filas_vl_mov" id="filas_vl_mov" value="1" type="hidden">
																		<table>
																			<tbody id="ta_vl_mov">
																				<tr id="tr_vl_mov_1">
																					<td class="texto_negrilla">Valor</td>
																					<td class="texto_mayus">
																						<select name="list_s_cond_vm" id="list_s_cond_vm" dojoType="dijit.form.Select" required="false" 
																						onchange="cambio_cond('vl_mov',this.value);">
																							<option value="IGUAL">IGUAL</option>
																							<option value="DIFERENTE">DIFERENTE</option>
																							<option value="MAYOR O IGUAL A">MAYOR O IGUAL A</option>
																							<option value="MAYOR A">MAYOR A</option>
																							<option value="MENOR O IGUAL A">MENOR O IGUAL A</option>
																							<option value="MENOR A">MENOR A</option>
																							<option value="ENTRE">ENTRE</option>
																							<option value="VARIAS">VARIAS</option>
																						</select>
																					</td>
																					<td class="alineado_der">
																						<input style="width: 15em;" name="list_t_vl_mov[]" id="list_t_vl_mov_1" dojoType="dijit.form.ValidationTextBox" 
																						promptMessage="Digite el valor del movimiento." onkeyup="formatNumber(document.getElementById('list_t_vl_mov_1'),',','');">
																					</td>
																					<td id="s_vl_mov_e" style="display: none;" class="texto_mayus">
																						<span style="font-weight: bold;">Y</span>
																						<input style="width: 15em;" name="list_t_vl_mov_f" id="list_t_vl_mov_f" dojoType="dijit.form.ValidationTextBox" 
																						promptMessage="Seleccione la fecha de movimiento" onkeyup="formatNumber(document.getElementById('list_t_vl_mov_f'),',','');">
																					</td>
																					<td id="s_vl_mov_v" align="center" style="display: none;">
																						<button type="button" name="b_add_vl_mov" id="b_add_vl_mov" onclick="crear_det('vl_mov')"
																						dojoType="dijit.form.Button">+</button>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</td>
																</tr>
																<tr id="tr_comprobante" style="display: none;">
																	<td class="texto_negrilla">Comprobante</td>
																	<td id="texto_mayus">
																		<span dojoType="dojo.data.ItemFileReadStore" jsId="list_t_comprobante_store" url="" 
																		urlPreventCache="false" clearOnClose="true" id="list_t_comprobante_store"></span>
																		<input dojoType="dijit.form.ComboBox" store="list_t_comprobante_store" searchAttr="name" highlightMatch="all"
																		queryExpr="*${0}*" style="width: 390px;" name="list_t_comprobante" id="list_t_comprobante" autoComplete="false" pageSize="20"
																		placeHolder="Seleccione el comprobante" promptMessage="Seleccione el comprobante." required="false" tooltipPosition="above,below">
																	</td>
																</tr>
																<tr>
																	<td class="texto_negrilla">Estado</td>
																	<td>
																		<select name="list_s_estado" id="list_s_estado" dojoType="dijit.form.Select" required="false">
																			<option value="'C','A'">TODOS</option>
																			<option value="'C'">CORRECTOS</option>
																			<option value="'A'">ANULADOS</option>
																		</select>
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
											..:: SALDOS CONTABLES ::..
										</div>
										<center id="botones">
										</center>
										<div id="grid_sal"></div>
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
