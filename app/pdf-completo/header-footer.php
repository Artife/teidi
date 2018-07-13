<page_header>		
	<table class="page_footer">
		<tr>
			<td style="width: 50%; text-align: left">
				<img class="top" src="<?php echo $url_app; ?>img/clinicas/<?php echo $datos_clinica['logo']; ?>"> 
			</td>
			<td style="width: 50%; text-align: right">
				 <p id="nombre_clinica" class="top_derecho"><?php echo $datos_clinica['nombre']; ?></p>
			</td>
		</tr>
	</table>		
	<div class="raya"></div>	
</page_header>
<page_footer>
	<div class="raya"></div>
	<table class="page_footer">
		<tr>
			<td style="width: 50%; text-align: left">
				<p id="footer_paciente"> i-Diet <?php echo date('Y'); ?> - Paciente: <?php echo $cliente['nombre'].' '.$cliente['apellidos']; ?></p>
			</td>
			<td style="width: 50%; text-align: right">
				<p id="footer_pagina"> P&aacute;gina [[page_cu]]/[[page_nb]]</p>
			</td>
		</tr>
	</table>
</page_footer>
