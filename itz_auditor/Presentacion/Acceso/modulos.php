<html>
	<head>
		<script type="text/javascript" src="../../Javascript/itz_script.js"></script>
		<script type="text/javascript">
			function inicio() {
				parent.document.getElementById(window.name).parentNode.parentNode.parentNode.parentNode.title='ITZAMNNÁ AUDITOR - INICIO';
				cargarMenu('-1','L');
			}
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
			dojo.require("dojo.date.locale");
		</script>
	</head>
	<body class="claro" onload="inicio();">
		<center>
			<input name="fechaInicio" id="fechaInicio" type="hidden">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr> 
						<td class="fila_info" id="td_menu">
						</td>
					</tr>
					<tr>
						<td id="td_pie_pagina">
						</td>
					</tr>
				</tbody>
			</table>
		</center>
	</body>
</html>
