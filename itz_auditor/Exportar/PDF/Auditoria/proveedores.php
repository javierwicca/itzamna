<?php
	setlocale(LC_CTYPE, 'es_ES');
	require_once('../html2pdf/html2pdf.class.php');
	ob_start();
	
?>
		<page style="font-size: 10pt; font-family:Times;" backtop="16.5mm">
			<page_header>
				<table cellpadding="0" cellspacing="0" style="width: 100%">
					<tr>
						<td style="text-align: left; width: 25%; font-size: 8pt;">
							Generado por:
						</td>
						<td style="text-align: center; width: 50%; font-size: 9pt;">
							Itzamn&aacute; Auditor
						</td>
						<td style="text-align: right; width: 25%; font-size:8pt;">
							<?php echo date('d/m/Y h:i:s A')?>
						</td>
					</tr>
					<tr>
						<td style="text-align: left; width: 25%; font-size: 8pt;">
							<?php echo ucwords(strtolower($nm_usr))?>
						</td>
						<td style="text-align: center; width: 50%; font-size: 9pt;">
							Proveedores
						</td>
						<td style="text-align: right; width: 25%; font-size:8pt;">
							P&aacute;gina<?php echo " "?>[[page_cu]]<?php echo " "?>de<?php echo " "?>[[page_nb]]
						</td>
					</tr>
				</table>
				<table cellpadding="0" cellspacing="0" style="width: 100%">
					<tr>
						<td style="text-align: center; width: 11%; font-weight: bold; border: solid 1px;">
							Identificaci&oacute;n
						</td>
						<td style="text-align: center; width: 27%; font-weight: bold; border-top: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
							Nombre
						</td>
						<td style="text-align: center; width: 25%; font-weight: bold; border-top: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
							Direcci&oacute;n
						</td>
						<td style="text-align: center; width: 10%; font-weight: bold; border-top: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
							Tel&eacute;fono
						</td>
						<td style="text-align: center; width: 7%; font-weight: bold; border-top: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
							Persona
						</td>
						<td style="text-align: center; width: 20%; font-weight: bold; border-top: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
							Tp. Documento
						</td>
					</tr>
				</table>
			</page_header>
			<table cellpadding="0" cellspacing="0" style="width: 100%">
				<?php
					$act=0;
					$ina=0;
					$filas=explode('##', $datos);
					for ($i=0;$i<count($filas);$i++) {
						$columnas=explode('@@', $filas[$i]);
				?>
						<tr>
							<td style="text-align: left; width: 11%; border-left: solid 1px; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml(mb_strtoupper($columnas[0]))?>
							</td>
							<td style="text-align: left; width: 27%; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml($columnas[15])?>
							</td>
							<td style="text-align: left; width: 25%; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml(mb_strtoupper($columnas[9]))?>
							</td>
							<td style="text-align: left; width: 10%; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml(mb_strtoupper($columnas[13]))?>
							</td>
							<td style="text-align: left; width: 7%; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml($columnas[16])?>
							</td>
							<td style="text-align: left; width: 20%; border-right: solid 1px; border-bottom: solid 1px;">
								<?php echo $this->NegocioFacade->reempCaracEspHtml(mb_strtoupper($columnas[17]))?>
							</td>
						</tr>
				<?php
					}
				?>
			</table>
			<div style="text-align: left; font-weight: bold;">
				<span>Activos: <?php echo $act?></span>&nbsp;&nbsp;<span style="color: red">Inactivos: <?php echo $ina?></span>
				&nbsp;&nbsp;<span style="color: blue;">TOTAL: <?php echo ($act+$ina)?></span>
			</div>
		</page>
<?php
	$content = ob_get_clean();
	
	$html2pdf = new HTML2PDF('L','letter', 'es',array(2,2,2,2));
	$html2pdf->pdf->SetTitle(utf8_encode('Itzamná Auditor'));
	$html2pdf->pdf->SetSubject(utf8_encode('Listado Proveedores'));
	$html2pdf->pdf->SetAuthor(utf8_encode('Itzamná SAS - '.ucwords(strtolower($nm_usr))));
	$html2pdf->pdf->SetKeywords(utf8_encode("Cuentas PUC"));
	$html2pdf->pdf->SetCreator(utf8_encode('Itzamná SAS - '.ucwords(strtolower($nm_usr))));
	
	$html2pdf->WriteHTML($content, isset($_GET['vuehtml']));
	$html2pdf->Output("Listado Proveedores.pdf",'D');
?>