<br><br>
<?php if (!empty($datos_clinica['logo'])) { ?>
<p class="medio"><img src="<?php echo $url_app; ?>img/clinicas/<?php echo $datos_clinica['logo']; ?>" style="width:500px"></p>
<?php } ?>
<?php if (!empty($datos_clinica['nombre'])) { ?>
<h1 class="medio gris"><?php echo $datos_clinica['nombre']; ?></h1>
<?php } ?>
<?php if (!empty($datos_clinica['direccion'])) { ?>
<h2 class="medio gris"><?php echo $datos_clinica['direccion'];  ?></h2>
<?php } ?>
<?php if (!empty($datos_clinica['telefono'])) { ?>
<h3 class="medio gris"><?php echo $datos_clinica['telefono']; ?></h3>
<?php } ?>
<br><br>
<h1 class="medio tc_azul tt30">ESTUDIO <br> PERSONALIZADO</h1>
<h1 class="medio tc_azul"><?php echo $cliente['nombre']; ?> <?php $cliente['apellidos']; ?></h1>