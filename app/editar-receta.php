<?php
session_start();
include 'parts/conex.php';
$pagina = 'Nueva Receta';
$migas = array('Lista Recetas');
$migas_url = array('lista-recetas');

//Solo permitir acceso a estos roles
$acceso_roles = array('Normal', 'Demo', 'Formacion', 'admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once 'parts/configuracion.php';
include 'parts/consultas_mysql.php';
include_once 'parts/ayuda.php';


//creamos la receta en la tabla temporal
$id  = extraer_numeros($_GET['id']);

//Consultamos la receta origial
$receta = obtener_receta($id);	
	
//obtener receta temporal
$receta_temporal = tabla_temporal_obtener_receta($id);


$borra_una_vez = 0;
foreach ($_POST as $key => $input_arr) 
{ 
	if($borra_una_vez == 0){ borrar_ingredientes_tabla_temporal($id);  }
	if (substr($key, 0, 7) == 'indice_' && !empty($input_arr)){					
		//consultamos si existe en la tabla temporal
		$existe_alimento_temporal = obtener_ingredientes_tabla_temporal_x_alimento($id, substr($key, 7));		
		crear_ingredientes_tabla_temporal ($id, substr($key, 7), $input_arr);
	}
	$borra_una_vez++;	
}

// echo $_POST['temp_nombre'];
if(!empty($_POST['temp_nombre'])){
	$temp_nombre 							=  $_POST['temp_nombre'];
	$temp_descripcion 						=  $_POST['temp_descripcion'];	
	$temp_peso_minimo 						=  $_POST['temp_peso_minimo'];
	$temp_peso_maximo 						=  $_POST['temp_peso_maximo'];
	
	$lista_ingesta_1 = '';
	$lista_ingesta_2 = '';
	$lista_ingesta_3 = '';
	$lista_ingesta_4 = '';
	$lista_ingesta_5 = '';
	$lista_ingesta_6 = '';
	$lista_ingesta_7 = '';
	$lista_ingesta_8 = '';
	$lista_ingesta_9 = '';
	$lista_ingesta_10 = '';

	if(!empty($_POST['temp_incluir_desayuno'])) { $temp_incluir_desayuno 					= $_POST['temp_incluir_desayuno']; $lista_ingesta_1 = ' ingesta_7,';}
	if(!empty($_POST['temp_incluir_media_manana'])) { $temp_incluir_media_manana			= $_POST['temp_incluir_media_manana']; $lista_ingesta_2 = ' ingesta_8,'; }
	if(!empty($_POST['temp_incluir_plato_comida'])) { $temp_incluir_plato_comida 			= $_POST['temp_incluir_plato_comida']; $lista_ingesta_3 = ' ingesta_9,'; }
	if(!empty($_POST['temp_incluir_plato_comida_principal'])) { $temp_incluir_plato_comida_principal	= $_POST['temp_incluir_plato_comida_principal'];  $lista_ingesta_8 = ' ingesta_19,'; }
	if(!empty($_POST['temp_incluir_postre'])) { $temp_incluir_postre 						= $_POST['temp_incluir_postre']; $lista_ingesta_10 = ' ingesta_21,';}
	if(!empty($_POST['temp_incluir_merienda'])) { $temp_incluir_merienda 					= $_POST['temp_incluir_merienda'];  $lista_ingesta_4 = ' ingesta_10,'; }
	if(!empty($_POST['temp_incluir_plato_cena'])) { $temp_incluir_plato_cena 				= $_POST['temp_incluir_plato_cena']; $lista_ingesta_5 = ' ingesta_11,';  }
	if(!empty($_POST['temp_incluir_plato_cena_principal'])) { $temp_incluir_plato_cena_principal	= $_POST['temp_incluir_plato_cena_principal']; $lista_ingesta_9 = ' ingesta_20,';}
	if(!empty($_POST['temp_incluir_recena'])) { $temp_incluir_recena 						= $_POST['temp_incluir_recena']; $lista_ingesta_6 = ' ingesta_12,'; }
	if(!empty($_POST['temp_incluir_otros'])) { $temp_incluir_otros 						= $_POST['temp_incluir_otros']; $lista_ingesta_7 = ' ingesta_18,'; }

	$lista_ingestas_post  = $lista_ingesta_1.$lista_ingesta_2.$lista_ingesta_3.$lista_ingesta_4.$lista_ingesta_5.$lista_ingesta_6.$lista_ingesta_7.$lista_ingesta_8.$lista_ingesta_9.$lista_ingesta_10;

	
	actualizar_en_tabla_temporal($id, $temp_nombre, $temp_descripcion, $lista_ingestas_post, $temp_peso_minimo, $temp_peso_maximo);
}

if(!empty($receta_temporal)){
	//Actualizamos la tabla
	// echo "consultar";
	//Obtener ingredientes tabla temporal
	$ingredientes_temporal = obtener_ingredientes_tabla_temporal($id);

	//Obtener ingestas 
	$ingestas_temporal = obtener_ingestas_temporal($id);
	
	include 'parts/editar-receta/iniciar-variables.php';
	include 'parts/editar-receta/calculos.php';
	
	
}else{
	// echo "Insertamos";
	//Insertamos en la tabla
	//Obtener ingestas 
	$ingestas = obtener_ingestas($id);
	
	//Obtener ingredientes
	$ingredientes = obtener_ingredientes($id);
	
	//Nueva receta en temporal	
	tabla_temporal_insert_receta ($id);
	
	//Obtener ingredientes tabla temporal
	$ingredientes_temporal = obtener_ingredientes_tabla_temporal($id);

	//Obtener ingestas 
	$ingestas_temporal = obtener_ingestas_temporal($id);
	
	//Creamos los ingredientes y las cantidades en la nueva tabla temporal
	crear_ingredientes_nueva_receta_temporal_ingestas ($id);		
	
	
	include 'parts/editar-receta/iniciar-variables.php';
	include 'parts/editar-receta/calculos.php';	
	
	header('location:'.$url_app.'editar-receta/'.$id);
}



 
//Obtener receta temporal por seguda vez
$receta_temporal = tabla_temporal_obtener_receta($id);

?>
	<?php echo header_documento(); ?>
	<!-- TouchSpin -->	
	<link href="<?php echo $url_app; ?>css/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="<?php echo $url_app; ?>css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
	<?php include 'parts/header.php'; ?>
	<link href="<?php echo $url_app; ?>css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
	<link href="<?php echo $url_app; ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">	
	<style>
	.table-responsive {
		overflow-x: hidden;
	}	
	.margin_top_receta{
		margin-top: 10px;
	}
	.datos_informacion p {
		padding-top:6px;
	}
	.ibox-content {
		margin-left: 10px;
		margin-right: 10px;
	}
	#datos_obligatorios {
		min-height:634px; 
	}
	.note-editable {
		min-height:420px; 
	}
	.mini_bottom_confirmar {
		/* display:none; */
	}
	a.tooltips {
	  position: relative;
	  display: inline;
	}
	a.tooltips span {
	  position: absolute;
	  width:300px;
	  color: #FFFFFF;
	  background: #000000;
	  height: 30px;
	  line-height: 30px;
		padding-left: 10px;
		text-align: left;
	  visibility: hidden;
	  border-radius: 6px;
	}
	a.tooltips span:after {
	  content: '';
	  position: absolute;
	  top: 100%;
	  left: 55px;
	  margin-left: -8px;
	  width: 0; height: 0;
	  border-top: 8px solid #000000;
	  border-right: 8px solid transparent;
	  border-left: 8px solid transparent;
	}
	a:hover.tooltips span {
	  visibility: visible;
	  opacity: 0.8;
	  bottom: 30px;
	  left: 50%;
	  margin-left: -76px;
	  z-index: 999;
	}	
	</style> 
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <?php include_once 'parts/menu_izquierdo.php'; ?>
        </nav>
        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <?php include_once 'parts/menu_top.php'; ?>
        </div>
			<div class="row wrapper border-bottom white-bg page-heading">
			<?php echo migas_de_pan($pagina, $migas, $migas_url, ''); ?>                
            </div>
		<div class="wrapper wrapper-content">	
		<form id="formulario_editar_receta" action="" method="post">		
		<div class="row">
             <div class="col-lg-12">
				<div class="ibox float-e-margins">											
					<div class="row">
						<div class="col-md-8">
							<div class="ibox-content" id="datos_obligatorios">
								<h1>Datos obligatorios</h1>	
								<input type="hidden" name="id_receta_editada" value="<?php echo $id; ?>">
								<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre de la receta" required="" value="<?php if(!empty($receta_temporal['nombre'])){ echo $receta_temporal['nombre']; } ?>">								
								<input type="hidden" class="form-control" name="descripcion" id="descripcion" placeholder="Título" required="" value="<?php if(!empty($receta_temporal['descripcion'])){ echo str_replace('\r\n','<br>',$receta_temporal['descripcion']); } ?>">
								<br/>
								<div class="ibox-content no-padding">
									<div id="summernote" class="summernote">
										<?php if(!empty($receta_temporal['descripcion'])){ echo str_replace('\r\n','<br>',$receta_temporal['descripcion']); } ?>
									</div>										
								</div>	
									<div class="row" style="position: absolute; margin-top: 0px; top: 20px; right: 45px;">
										<div class="col-md-12">								
											<div class="form-group text-center">
											<a href="<?php echo $url_app; ?>lista-recetas" class="btn btn-w-m btn-atras">Atras</a>
											<?php  if ($receta['origen'] == 'i-Diet') { ?>
											<a id="duplicar_alimento_original" class="btn btn-w-m btn-guardar" title="La suma de Hidratos, Proteínas y Grasas debe dar 100">Duplicar</a>
											<?php }else{ ?>
											<button id="guardar_receta" type="submit" class="btn btn-w-m btn-guardar" title="La suma de Hidratos, Proteínas y Grasas debe dar 100">Guardar</button>
											<?php } ?>
											</div>
										</div>
									</div>
							</div>
						</div>		
						<div id="datos_informacion" class="col-md-4 datos_informacion">
							<div class="ibox-content">
								<h1>Datos Información</h1>								
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Kcal/100g</p></div>									
									<div class="col-md-4"><div class="input-group m-b"><input type="text" class="form-control" name="kcal_por_100g" id="kcal_por_100g" placeholder="Kcal/100g" readonly="" value="<?php echo $mostrar_kcal_100g; ?>"></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Hidratos</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Hidratos" class="form-control" id="hidratos_porc" name="hidratos_porc" value="<?php echo $mostrar_hidratos_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>									
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Proteínas</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Proteínas" class="form-control" id="proteinas_porc" name="proteinas_porc" value="<?php echo $mostrar_proteinas_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>								
								<div class="row margin_top_receta">
									<div class="col-md-2"><p>Grasa</p></div>
									<div class="col-md-4"><div class="input-group m-b"><input type="text" placeholder="Grasa" class="form-control"  id="grasas_porc" name="grasas_porc" value="<?php echo $mostrar_grasa_porc; ?>" readonly=""><span class="input-group-addon">%</span></div></div>
									<div class="col-md-6"></div>
								</div>
							</div>
							<!-- Tamaño del plato -->
							<div class="ibox-content">	
								<div class="row margin_top_receta">
									<div class="col-md-12">
										<div class="input-group m-b"><span class="input-group-addon">Tamaño del plato entre</span><input type="text" placeholder="Peso Minimo" class="form-control"  id="peso_minimo" name="peso_minimo" value="<?php if(!empty($receta_temporal['peso_minimo'])){ echo $receta_temporal['peso_minimo']; } ?>" required><span class="input-group-addon">y</span><input type="text" placeholder="Peso Maxímo" class="form-control" id="peso_maximo" name="peso_maximo" value="<?php if(!empty($receta_temporal['peso_maximo'])){ echo $receta_temporal['peso_maximo']; } ?>" required><span class="input-group-addon">gramos</span></div>
									</div>																			
								</div>	
							</div>	
							<!-- Ingestas -->
							<div class="ibox-content">								
								<h1>Ingestas</h1>
								<div class="row margin_top_receta">
									<div class="col-md-6">
										<div class="checkbox checkbox-success">													
											<?php $marcar_desayuno = ''; ?>
											<?php $cadena_1 = strpos($receta_temporal['ingestas'], 'ingesta_7'); ?>
											<?php if (is_numeric($cadena_1)) { $marcar_desayuno = 'checked=""';  }else{ $marcar_desayuno = '';} ?>
                                            <input id="desayuno" name="incluir_desayuno" type="checkbox" <?php echo $marcar_desayuno; ?> value="7">
                                            <label for="desayuno">
                                                Desayuno
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_media_manana = ''; ?>
											<?php $cadena_2 = strpos($receta_temporal['ingestas'], 'ingesta_8'); ?>
											<?php if (is_numeric($cadena_2)) { $marcar_media_manana = 'checked=""';  }else{ $marcar_media_manana = '';} ?>
                                            <input id="media_manana"  name="incluir_media_manana"  type="checkbox" <?php echo $marcar_media_manana; ?> value="8">
                                            <label for="media_manana">
                                                Media mañana
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">																						
											<?php $marcar_plato_comida = ''; ?>
											<?php $cadena_3 = strpos($receta_temporal['ingestas'], 'ingesta_9'); ?>
											<?php if (is_numeric($cadena_3)) { $marcar_plato_comida = 'checked=""';  }else{ $marcar_plato_comida = '';} ?>
                                            <input id="plato_comida" name="incluir_plato_comida" type="checkbox" <?php echo $marcar_plato_comida; ?> value="9">
                                            <label for="plato_comida">
                                                1ª plato Comida
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $plato_comida_principal = ''; ?>
											<?php $cadena_4 = strpos($receta_temporal['ingestas'], 'ingesta_10'); ?>
											<?php if (is_numeric($cadena_4)) { $plato_comida_principal = 'checked=""';  }else{ $plato_comida_principal = '';} ?>
                                            <input id="plato_comida_principal" name="incluir_plato_comida_principal" type="checkbox" <?php echo $plato_comida_principal; ?> value="19">
                                            <label for="plato_comida_principal">
                                                Plato principal comida
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_postre = ''; ?>
											<?php $cadena_5 = strpos($receta_temporal['ingestas'], 'ingesta_21'); ?>
											<?php if (is_numeric($cadena_5)) { $marcar_postre = 'checked=""';  }else{ $marcar_postre = '';} ?>
                                            <input id="postre" name="incluir_postre" type="checkbox" <?php echo $marcar_postre; ?> value="21">
                                            <label for="postre">
                                                Postre
                                            </label>
                                        </div>
									</div>
									<div class="col-md-6">
										<div class="checkbox checkbox-success">											
											<?php $marcar_merienda = ''; ?>
											<?php $cadena_6 = strpos($receta_temporal['ingestas'], 'ingesta_10'); ?>
											<?php if (is_numeric($cadena_6)) { $marcar_merienda = 'checked=""';  }else{ $marcar_merienda = '';} ?>
                                            <input id="merienda"  name="incluir_merienda" type="checkbox" <?php echo $marcar_merienda; ?> value="10">
                                            <label for="merienda">
                                                Merienda
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">											
											<?php $marcar_plato_cena = ''; ?>
											<?php $cadena_7 = strpos($receta_temporal['ingestas'], 'ingesta_11'); ?>
											<?php if (is_numeric($cadena_7)) { $marcar_plato_cena = 'checked=""';  }else{ $marcar_plato_cena = '';} ?>
                                            <input id="plato_cena" name="incluir_plato_cena" type="checkbox" <?php echo $marcar_plato_cena; ?> value="11">
                                            <label for="plato_cena">
                                                1ª plato Cena
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">											
											<?php $marcar_plato_cena_principal = ''; ?>
											<?php $cadena_8 = strpos($receta_temporal['ingestas'], 'ingesta_20'); ?>
											<?php if (is_numeric($cadena_8)) { $marcar_plato_cena_principal = 'checked=""';  }else{ $marcar_plato_cena_principal = '';} ?>
                                            <input id="plato_cena_principal" name="incluir_plato_cena_principal" type="checkbox" <?php echo $marcar_plato_cena_principal; ?> value="20">
                                            <label for="plato_cena_principal">
                                                Plato principal cena
                                            </label>
                                        </div>
										<div class="checkbox checkbox-success">
											<?php $marcar_recena = ''; ?>
											<?php $cadena_9 = strpos($receta_temporal['ingestas'], 'ingesta_12'); ?>
											<?php if (is_numeric($cadena_9)) { $marcar_recena = 'checked=""';  }else{ $marcar_recena = '';} ?>
                                            <input id="recena" name="incluir_recena" type="checkbox" <?php echo $marcar_recena; ?> value="12">
                                            <label for="recena">
                                                Recena
                                            </label>
                                        </div>																														
										<div class="checkbox checkbox-success">
											<?php $marcar_otros = ''; ?>
											<?php $cadena_10 = strpos($receta_temporal['ingestas'], 'ingesta_18'); ?>
											<?php if (is_numeric($cadena_10)) { $marcar_otros = 'checked=""';  }else{ $marcar_otros = '';} ?>
                                            <input id="otros" name="incluir_otros" type="checkbox" <?php echo $marcar_otros; ?> value="18">
                                            <label for="otros">
                                                Otros
                                            </label>
                                        </div>										 
									</div>					
								</div>	
							</div>	
						</div>
					</div>
					<!-- Fin primera parte-->
					<!-- Ingredientes -->
					<br/>
					<div class="ibox-content">						
						<div class="row margin_top_receta">
							<div class="col-md-6">
								<div class="row" style="float: right;">
									<div class="col-md-12">								
										<div class="form-group">
										<a id="boton_eliminar_alimento" href="#" class="btn btn-w-m btn-eliminar" disabled>Eliminar</a>
										<a id="agregar_temp" class="btn btn-w-m btn-primary" data-toggle="modal" data-target="#myModal" title="Añadir nuevo alimento">Añadir</a>
										</div>
									</div>
								</div>
								<h1>Ingredientes</h1>								
								<table id="example" class="table table-striped dataTables-example select-filter">
								<thead>
									<tr> 
										<th style="width: 30px;">											
										<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
											<input id="checkbox1" type="checkbox" class="marcar_todos">
											<label for="checkbox1"></label>
										</div>
										</th>
										<th>Alimento</th>										
										<th style="min-width:200px;">Cantidad </th>
										<th>Kcal/100g</th>											
									</tr>
								</thead>								
								<tbody>
									<?php $total_cantidad_mostrar = 0; ?>
									<?php for ($i = 0; $i <= count($ingredientes_temporal); $i++) { ?>
									<?php if(!empty($ingredientes_temporal[$i]['id_alimento'])){ ?>	
									<tr id="<?php echo $ingredientes_temporal[$i]['id_alimento'];  ?>">
										<td>
											<div class="checkbox checkbox-success">
												<input id="mostrar_ingrediente_<?php echo $ingredientes_temporal[$i]['id_alimento']; ?>" type="checkbox" name="ingrediente_agregado_<?php echo $ingredientes_temporal[$i]['id_alimento']; ?>" class="mostrar_ingrediente" value="<?php echo $i; ?>"><label for="mostrar_ingrediente_<?php echo $ingredientes_temporal[$i]['id_alimento']; ?>"></label>
											</div>
										</td>
										<td><a class="tooltips"><?php echo $ingredientes_temporal[$i]['alimento']; ?></a></td>	
										<td><?php echo $ingredientes_temporal[$i]['cantidad']; ?></td>
										<td><?php echo $ingredientes_temporal[$i]['kcal_100g']; ?></td>
									</tr>
									<?php $total_cantidad_mostrar = $total_cantidad_mostrar+$ingredientes_temporal[$i]['cantidad']; ?>
									<?php } ?>	
									<?php } ?>											
								</tbody>
								<tfoot>
									<tr>
										<th></th>
										<th></th>
										<th><?php echo $total_cantidad_mostrar; ?>g Total Cantidad</th>	
										<th><?php echo $mostrar_kcal_100g; ?> Kcal/100g</th>										
									</tr>
								</tfoot>
							</table>								
								<!-- llevar los ingredientes al insert -->
								<?php if(!empty($datos_alimento)) { ?>
								<?php for ($i = 0; $i <= count($datos_alimento); $i++) { ?>									
									<?php if(!empty($datos_alimento[$i]['id_alimento'])){ ?>
										<input type="hidden" id="insert_alimento_<?php echo $i; ?>"  name="insert_alimento_<?php echo $datos_alimento[$i]['id_alimento']; ?>" value="<?php echo $datos_alimento[$i]['cantidad']; ?>">										
									<?php } ?>
								<?php } ?>
								<?php } ?>	
								<input type="hidden" id="modificar_existentes"  name="modificar_existentes" value="">										
								<!-- llevar los ingredientes al insert -->
							</div>							
							<div class="col-md-6" style="padding-left:50px;">
								<!-- posible -->
								<h1>Información nutricional (100g)</h1>							
								<br />
								<div class="row">
									<div class="col-md-6" style="width: auto;">
										<strong style="color: #732f76;">General  </strong>
									</div>	
									<div class="col-md-6">								
									</div>
								</div>								
								<br />
								<div class="recargar-informacion-nutricional">								
								</div>	
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Agua (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="agua_g" value="<?php echo $total_agua_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Hidratos de carbono, Total (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="hc_g" value="<?php echo  $total_hc_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Fibra (g)	
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="fibra_g" value="<?php echo  $total_fibra_g; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Proteínas, total (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="prot_g" value="<?php echo  $total_prot_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Grasas, total (g) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="grasa_g" value="<?php echo  $total_grasa_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Colesterol (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="col_mg" value="<?php echo  $total_col_mg; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 AGS totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="satur_g" value="<?php echo  $total_satur_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 AGM totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="mono_g" value="<?php echo  $total_mono_g; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 AGP totales (g)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="poli_g" value="<?php echo  $total_poli_g; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-6" style="width: auto;">
										 <strong style="color: #732f76;">Vitaminas y otros </strong>  
									</div>	
									<div class="col-md-6">								
									</div>
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Vit A (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_a" value="<?php echo  $total_vit_a; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Carotenos (mg) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="carotenos" value="<?php echo  $total_carotenos; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Tiamina B1 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b1" value="<?php echo  $total_vit_b1; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Riboflavina B2 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b2" value="<?php echo  $total_vit_b2; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Niacina B3 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="niacina" value="<?php echo  $total_niacina; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Ac. Pantoténico B5 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="ac_panto" value="<?php echo  $total_ac_panto; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Piridoxina B6 (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_b6" value="<?php echo  $total_vit_b6; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Biotina (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="biotina" value="<?php echo  $total_biotina; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Ac. Fólico B9 (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="folico" value="<?php echo  $total_folico; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>	
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Cobalamina B12 (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="b12" value="<?php echo  $total_b12; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit C (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_c" value="<?php echo  $total_vit_c; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit D (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_d" value="<?php echo  $total_vit_d; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Tocoferol (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="tocoferol" value="<?php echo  $total_tocoferol; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit E (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_e" value="<?php echo  $total_vit_e; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Vit K (ug)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="vit_k" value="<?php echo  $total_vit_k; ?>" readonly required>								
											</div>
										</div>
									</div>	
								</div>
								<br />
								<div class="row">
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-2">
												 Oxálico (ug) 								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="oxalico" value="<?php echo  $total_oxalico; ?>" readonly required>								
											</div>
											<div class="col-md-2">
												 Purinas (mg)  								
											</div>
											<div class="col-md-2">
												<input type="text" placeholder="0" class="input-sm form-control" name="purinas" value="<?php echo  $total_purinas; ?>" readonly required>								
											</div>
											<div class="col-md-2">										
											</div>
											<div class="col-md-2">										
											</div>
										</div>
									</div>	
								</div>
						<!-- Minerales -->
						<br />
						<div class="row">
							<div class="col-md-6" style="width: auto;">
								 <strong style="color: #732f76;">Minerales </strong>  
							</div>	
							<div class="col-md-6">								
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Sodio (mg) 								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="sodio_mg" value="<?php echo  $total_sodio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Potasio (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="potasio_mg" value="<?php echo  $total_potasio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Magnesio (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="magnesio_mg" value="<?php echo  $total_magnesio_mg; ?>" readonly required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Calcio (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="calcio_mg" value="<?php echo  $total_calcio_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Fósforo (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="fosf_mg" value="<?php echo  $total_fosf_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Hierro (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="hierro_mg" value="<?php echo  $total_hierro_mg; ?>" readonly required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Cloro (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cloro_mg" value="<?php echo  $total_cloro_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Zinc (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cinc_mg" value="<?php echo  $total_cinc_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cobre (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobre_mg" value="<?php echo  $total_cobre_mg; ?>" readonly required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Manganeso (ug)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="manganeso_mg" value="<?php echo  $total_manganeso_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cromo (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="cromo_mg" value="<?php echo  $total_cromo_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Cobalto (mg)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="cobalto_mg" value="<?php echo  $total_cobalto_mg; ?>" readonly required>
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Molibde (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="molibde_mg" value="<?php echo  $total_molibde_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Yodo (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="yodo_mg" value="<?php echo  $total_yodo_mg; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Fluor (ug)
									</div>
									<div class="col-md-2">	
										<input type="text" placeholder="0" class="input-sm form-control" name="fluor_mg" value="<?php echo  $total_fluor_mg; ?>" readonly required>
									</div>
								</div>
							</div>	
						</div>
						<!-- Ácidos grasos -->
						<br />
						<div class="row">
							<div class="col-md-6" style="width: auto;">
								 <strong style="color: #732f76;">Ácidos grasos </strong>  
							</div>	
							<div class="col-md-6">								
							</div>
						</div>	
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										 Butírico C4:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="butirico_c4_0" value="<?php echo  $total_butirico_c4_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Caproico C6:0 (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caproico_c6_0" value="<?php echo  $total_caproico_c6_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										 Caprílico C8:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caprilico_c8_0" value="<?php echo  $total_caprilico_c8_0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Cáprico C10:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="caprico_c10_0" value="<?php echo  $total_caprico_c10_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Lárico C12:0 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="laurico_c12_0" value="<?php echo  $total_laurico_c12_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Mirístico C14:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristico_c14_0" value="<?php echo  $total_miristico_c14_0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C15:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_0" value="<?php echo  $total_c15_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C15:00 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c15_00" value="<?php echo  $total_c15_00; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Palmítico C16:0 (mg)								
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitico_c16_0" value="<?php echo  $total_palmitico_c16_0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C17:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_0" value="<?php echo  $total_c17_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C17:00 (mg)		
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c17_00" value="<?php echo  $total_c17_00; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Esteárico C18:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="estearico_c18_0" value="<?php echo  $total_estearico_c18_0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />	
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Araquídico C20:0 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="araquidi_c20_0" value="<?php echo  $total_araquidi_c20_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Behénico C22:0 (mg)	
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="behenico_c22_0" value="<?php echo  $total_behenico_c22_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Miristol C14:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="miristol_c14_1" value="<?php echo  $total_miristol_c14_1; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Palmitole C16:1 (mg)							
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="palmitole_c16_1" value="<?php echo  $total_palmitole_c16_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Oleico C18:1 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="oleico_c18_1" value="<?php echo  $total_oleico_c18_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Eicoseno C20:1 (mg)				
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="eicoseno_c20_1" value="<?php echo  $total_eicoseno_c20_1; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C22:1 (mg)						
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_1" value="<?php echo  $total_c22_1; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Linoleico C18:2 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleico_c18_2" value="<?php echo  $total_linoleico_c18_2; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Linolénico C18:3 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="linoleni_c18_3" value="<?php echo  $total_linoleni_c18_3; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C18:4 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c18_4" value="<?php echo  $total_c18_4; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Araquidónico C20:4 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="ara_ico_c20_4" value="<?php echo  $total_ara_ico_c20_4; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C20:5 (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c20_5" value="<?php echo  $total_c20_5; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										C22:5 (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_5" value="<?php echo  $total_c22_5; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										C22:6 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="c22_6" value="<?php echo  $total_c22_6; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Otros satura (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="otrosatur0" value="<?php echo $total_otrosatur0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>
						<br />	
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-2">
										Otros insatura (mg)					
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="otroinsat0" value="<?php echo $total_otroinsat0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Omega 3:0 (mg)
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="omega3_0" value="<?php echo $total_omega3_0; ?>" readonly required>								
									</div>
									<div class="col-md-2">
										Etanol (mg)			
									</div>
									<div class="col-md-2">
										<input type="text" placeholder="0" class="input-sm form-control" name="etanol0" value="<?php echo $total_etanol0; ?>" readonly required>								
									</div>
								</div>
							</div>	
						</div>						
								<!-- posible -->
							</div>
						</div>
					</div>	 
					<!-- Fin Ingredientes -->
					<br />					
				</div>
			</div>	
		</div>		
		<!-- Fin buscador -->    
		</form>		
		</div>
	
                <div class="footer">
                    <?php include_once 'parts/footer.php'; ?>
                </div>
            </div>
			<?php include_once 'parts/menu_derecho.php'; ?>
        </div>
        </div>      
    </div>	
	<!-- Modal Lista de alimentos -->	
	<div id="myModal" class="modal fade" role="dialog">	
	<form id="formulario_seleccionar_nuevo_ingrediente" action="<?php echo $url_app; ?>editar-receta/<?php echo $id; ?>" method="post">		
	  <div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">Selecciona el nuevo ingrediente</h4>
		  </div>
		  <div class="modal-body">
			<table id="tabla_agregar_alimento" class="table table-striped dataTables-example select-filter">
				<thead>
					<tr>
						<th style="width: 30px;">											
						<div class="checkbox checkbox-success" style="position: absolute;margin-top: -5px; margin-left: -3px;">
							<input id="checkbox2" type="checkbox" class="marcar_nuevos_alimentos">
							<label for="checkbox2"></label>
						</div>
						</th>
						<th>Nombre</th>
						<th style="min-width:150px;">Cantidad</th>
						<th>Kcal/100g</th>
						<th>%_Hidratos</th>
						<th>%_Proteínas</th>
						<th>%_Grasas</th>						
					</tr>
				</thead>
				<tbody>						
						<?php //Obtener el historial de pesos por clientes
							$listado_completo = listado_de_alimentos_completo ();
							// print_r($listado_completo);
							$cantidad_mostrar = 0; 
						?> 
						<?php // Si la lista temporal esta vacia hacemos esto > ?>
						<?php for ($i = 0; $i <= count($listado_completo); $i++) { ?>						
							<?php if(!empty($listado_completo[$i]['id_definitivo'])){ ?>							
							<?php 
								
								if(array_search($listado_completo[$i]['id_definitivo'], array_column($ingredientes_temporal, 'id_alimento')) !== False) {
									$en_indice = array_search($listado_completo[$i]['id_definitivo'], array_column($ingredientes_temporal, 'id_alimento'));
									$check_si = 'checked'; 
									$cantidad_mostrar = $ingredientes_temporal[$en_indice]['cantidad'];
								}else{
									$en_indice = '';
									$check_si = ''; 
									$cantidad_mostrar = 0; 
								}
								// $check_si = 'checked'; 
							?>
								<tr>
									<td>
										<div class="checkbox checkbox-success">		 
											<input id="<?php echo $listado_completo[$i]['id_definitivo']; ?>" type="checkbox" name="nuevo_ingrediente_<?php echo $listado_completo[$i]['id_definitivo']; ?>" class="marcar_ni" <?php echo $check_si; ?>><label for="<?php echo $listado_completo[$i]['id_definitivo']; ?>"></label>
										</div>
									</td>
									<td><?php echo $listado_completo[$i]['nombre']; ?></td>									
									<td><?php echo $cantidad_mostrar; ?></td>									
									<td><?php echo $listado_completo[$i]['kcal_100g']; ?></td>
									<td><?php echo $listado_completo[$i]['hidratos']; ?></td>
									<td><?php echo $listado_completo[$i]['proteinas']; ?></td>
									<td><?php echo $listado_completo[$i]['grasa']; ?></td>								
								</tr>
							<?php } ?>
						<?php } ?>	
					</tbody>
				</table>
					<?php for ($i = 0; $i <= count($listado_completo); $i++) { ?>
						<?php if(!empty($listado_completo[$i]['id_definitivo'])){ ?>
							<?php $cantidad_mostrar = '0'; ?>
							<?php if (!empty($ingredientes_temporal)) { ?>
								<?php if(array_search($listado_completo[$i]['id_definitivo'], array_column($ingredientes_temporal, 'id_alimento')) !== False) { ?>
									<?php $en_indice = array_search($listado_completo[$i]['id_definitivo'], array_column($ingredientes_temporal, 'id_alimento')); ?>
									<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $ingredientes_temporal[$en_indice]['cantidad']; ?>">
								<?php }else{ ?>
								<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $cantidad_mostrar; ?>">
								<?php } ?>
							<?php }else{ ?>	
								<input type="hidden" id="valor_<?php echo $i; ?>"  name="indice_<?php echo $listado_completo[$i]['id_definitivo']; ?>" value="<?php echo $cantidad_mostrar; ?>">
							<?php } ?>
						<?php } ?>
					<?php } ?>		
				<br><br><br>
				<div class="row">
				<div class="col-md-12">								
					<div class="form-group text-center">
					<p><strong>Nota:</strong> Para que los alimentos se incorporen a la receta deben estar seleccionados de color verde.</p>
					</div>
				</div>	
			  </div>		  
				<div class="row">
				<div class="col-md-12">								
					<div class="form-group text-center">
					<a href="#" data-dismiss="modal"  class="btn btn-w-m btn-atras">Atras</a>
					<button type="submit" class="btn btn-w-m btn-guardar">Guardar</button>
					</div>
				</div>	<br><br>
			  </div>		  
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			  </div>
			</div>
			<input type="hidden" id="temp_nombre"  name="temp_nombre" value="">	
			<input type="hidden" id="temp_descripcion"  name="temp_descripcion" value="">
			<input type="hidden" id="temp_incluir_desayuno"  name="temp_incluir_desayuno" value="">	
			<input type="hidden" id="temp_incluir_media_manana"  name="temp_incluir_media_manana" value="">	
			<input type="hidden" id="temp_incluir_plato_comida"  name="temp_incluir_plato_comida" value="">	
			<input type="hidden" id="temp_incluir_plato_comida_principal"  name="temp_incluir_plato_comida_principal" value="">	
			<input type="hidden" id="temp_incluir_postre"  name="temp_incluir_postre" value="">	
			<input type="hidden" id="temp_incluir_merienda"  name="temp_incluir_merienda" value="">	
			<input type="hidden" id="temp_incluir_plato_cena"  name="temp_incluir_plato_cena" value="">	
			<input type="hidden" id="temp_incluir_plato_cena_principal"  name="temp_incluir_plato_cena_principal" value="">
			<input type="hidden" id="temp_incluir_recena"  name="temp_incluir_recena" value="">
			<input type="hidden" id="temp_incluir_otros"  name="temp_incluir_otros" value="">
			<input type="hidden" id="temp_peso_minimo"  name="temp_peso_minimo" value="">
			<input type="hidden" id="temp_peso_maximo"  name="temp_peso_maximo" value="">
		</form>	
	</div>	
	</div>
	<!-- Fin nuevo alimento -->
	<?php include 'parts/jquery_footer.php'; ?>	
	<!-- TouchSpin -->
    <script src="<?php echo $url_app; ?>js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/datatables.min.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/dataTables/dataTables.cellEdit.js"></script>
	<script src="<?php echo $url_app; ?>js/plugins/summernote/summernote.min.js"></script>	    
	<script>
		var editor; // Usamos una variable global
		var table1;
		var table;
		//Llamamos los datos de la tabla en segundo plano para que carge mucho mas rapido
        $(document).ready(function(){
			$('#mensajes_footer').modal('show');						
			
			// Boton de guardado
			var habilitar_guardado = 'disabled';
			var total_porcentaje;
			var a =parseInt($("#hidratos_porc").val());
			var b =parseInt($("#proteinas_porc").val());	
			var c =parseInt($("#grasas_porc").val());
			var total_porcentaje = a + b + c;
			if(total_porcentaje == 100){
				$("#guardar_receta").prop('disabled', false);								
			}else{
				$("#guardar_receta").prop('disabled', true);							
			}
			
			 
			
			//->Tabla 1 
			//->Agregar Alimentos
			table_final = $('#example').DataTable();	
			table_final.MakeCellsEditable({
				"onUpdate": myCallbackFunction,
				"inputCss":'my-input-class',
				"columns": [2],
				"allowNulls": {
					"columns": [2],
					"errorClass": 'error'
				},
				"confirmationButton": { // could also be true
					"confirmCss": 'mini_bottom_confirmar',
					"cancelCss": 'mini_bottom_cancelar'
				},
				"inputTypes": [
					{
						"column": 2,
						"type": "text",
						"options": null
					}
				]
			});	
			//->Tabla 2 
			//->Agregar Alimentos	
			table = $('#tabla_agregar_alimento').DataTable(
				{
				fnCreatedRow: function (nRow, aData, iDataIndex) {
					$(nRow).attr('id', iDataIndex); // or whatever you choose to set as the id
				}
				});			
			table.MakeCellsEditable({
				"onUpdate": myCallbackFunction,
				"inputCss":'my-input-class',
				"columns": [2],
				"allowNulls": {
					"columns": [2],
					"errorClass": 'error'
				},
				"confirmationButton": { // could also be true
					"confirmCss": 'mini_bottom_confirmar',
					"cancelCss": 'mini_bottom_cancelar'
				},
				"inputTypes": [
					{
						"column": 2,
						"type": "text",
						"options": null
					}
				]
			});						
						
			$(".marcar_todos").on("click", function () {
				var marcado = $(this).is(':checked'); 
				
				if(marcado == true){				
					$('.mostrar_ingrediente').prop('checked',true);
					$(".mostrar_ingrediente").attr('value', '1');					
				}else{				
					$('.mostrar_ingrediente').prop('checked',false);
					$(".mostrar_ingrediente").attr('value', '0');				
				}
			});
			
			//Para marcar todos los alimentos a agregar
			$(".marcar_nuevos_alimentos").on("click", function () {
				var marcado = $(this).is(':checked'); 
				
				if(marcado == true){				
					$('.marcar_ni').prop('checked',true);
					$(".marcar_ni").attr('value', '1');					
				}else{				
					$('.marcar_ni').prop('checked',false);
					$(".marcar_ni").attr('value', '0');				
				}
			});
			
			//Agregar variables a temporal
			$("#agregar_temp").on("click", function () {
				pasar_a_temporal_variables(); 
			});
			$("#boton_eliminar_alimento").on("click", function () {
				// pasar_a_temporal_variables();
				console.log(indice_orgi);
				$("input[name = 'indice_"+indice_orgi+"']").attr('value', 0);				
				$("input[name = 'insert_alimento_"+indice_orgi+"']").attr('value', 0);
				$("input[name = 'nuevo_ingrediente_"+indice_orgi+"']").prop('checked',false);	
				$('#formulario_seleccionar_nuevo_ingrediente').attr('action', "<?php echo $url_app; ?>editar-receta/<?php echo $id; ?>");
				$("#formulario_seleccionar_nuevo_ingrediente" ).submit();	
			});
			
			//Esconder configuracion del html
			$('.note-toolbar .note-insert, .note-toolbar .note-table, .note-toolbar .note-style:first, .note-toolbar .note-para, .note-view, .note-fontname, .note-color').remove();
		
		});	
		
		$("#summernote").summernote();
		
		var indice_id = '';
		var indice_orgi = '';
		var tipo_tabla = '';
		var eliminar_alimento = '';
		
		$('#example').on( 'click', 'tr', function () {		  			
		    indice_orgi = ($(this).attr('id'));				
			tipo_tabla = 'editar_alimento';
			var total_marcados = $('.mostrar_ingrediente').filter(':checked').length
			if(total_marcados == 0){
				$('#boton_eliminar_alimento').attr('disabled', true); 
			}
			if(total_marcados == 1 ){
				$('#boton_eliminar_alimento').removeAttr("disabled");
			}
			if(total_marcados >= 2 ){
				$('#boton_eliminar_alimento').attr('disabled', true); 
			}
			console.log(indice_orgi);
		});
		$('#tabla_agregar_alimento').on( 'click', 'tr', function () {		  			
		    indice_id = ($(this).attr('id'));	
			tipo_tabla = 'agregar_alimento';			
		});			
		
		//Si edita un alimento ya agregado
		$('#example').on( 'click', 'tr .mini_bottom_confirmar', function () {		  			
		   
		});
		
		function myCallbackFunction (updatedCell, updatedRow, oldValue) {	
			if(tipo_tabla == 'editar_alimento'){
				pasar_a_temporal_variables();				
				$("input[name = 'indice_"+indice_orgi+"']").attr('value', updatedCell.data());		
  			    $('#formulario_seleccionar_nuevo_ingrediente').attr('action', "<?php echo $url_app; ?>editar-receta/<?php echo $id; ?>");
				$("#formulario_seleccionar_nuevo_ingrediente" ).submit();						
			}else{
				$("#valor_"+indice_id).attr('value', updatedCell.data());		
			}
		}	
		
		//Pasar todas las variables a temporal
		function pasar_a_temporal_variables () {	
				var temp_nombre = $('#nombre').val();
				var temp_descripcion_encode = $('.note-editable').html();				
				var temp_descripcion = (encode_var(temp_descripcion_encode));
				var temp_peso_minimo = $('#peso_minimo').val();
				var temp_peso_maximo = $('#peso_maximo').val();
				
				//checkboxes
				if ($('#desayuno').is(':checked')) {
					var temp_incluir_desayuno = $('#desayuno').val();
				}else{
					var temp_incluir_desayuno = '';
				}	
				if ($('#media_manana').is(':checked')) {
					var temp_incluir_media_manana = $('#media_manana').val();
				}else{
					var temp_incluir_media_manana = '';
				}		
				if ($('#plato_comida').is(':checked')) {
					var temp_incluir_plato_comida = $('#plato_comida').val();
				}else{
					var temp_incluir_plato_comida = '';
				}	
				if ($('#plato_comida_principal').is(':checked')) {	
					var temp_incluir_plato_comida_principal = $('#plato_comida_principal').val();
				}else{
					var temp_incluir_plato_comida_principal = '';
				}	
				if ($('#postre').is(':checked')) {	
					var temp_incluir_postre = $('#postre').val();
				}else{
					var temp_incluir_postre = '';
				}	
				if ($('#merienda').is(':checked')) {	
					var temp_incluir_merienda = $('#merienda').val();
				}else{
					var temp_incluir_merienda = '';
				}	
				if ($('#plato_cena').is(':checked')) {	
					var	temp_incluir_plato_cena = $('#plato_cena').val();
				}else{
					var temp_incluir_plato_cena = '';
				}	
				if ($('#plato_cena_principal').is(':checked')) {	
					var temp_incluir_plato_cena_principal = $('#plato_cena_principal').val();
				}else{
					var temp_incluir_plato_cena_principal = '';
				}	
				if ($('#recena').is(':checked')) {	
					var temp_incluir_recena = $('#recena').val();
				}else{
					var temp_incluir_recena = '';
				}	
				if ($('#otros').is(':checked')) {	
					var temp_incluir_otros = $('#otros').val();
				}else{
					var temp_incluir_otros = '';
				}	
				
				//Si no estan vacios
				if(temp_nombre != ''){
					$("#temp_nombre").attr('value', temp_nombre);					
				}
				if(temp_descripcion != ''){
					$("#temp_descripcion").attr('value', decode_var(temp_descripcion));							
				}
				if(temp_peso_minimo != ''){
					$("#temp_peso_minimo").attr('value', temp_peso_minimo);	
					console.log(temp_peso_minimo);	
				}
				if(temp_peso_maximo != ''){
					$("#temp_peso_maximo").attr('value', temp_peso_maximo);						
				}
				if(temp_incluir_desayuno != ''){
					$("#temp_incluir_desayuno").attr('value', temp_incluir_desayuno);		
				}
				if(temp_incluir_media_manana != ''){
					$("#temp_incluir_media_manana").attr('value', temp_incluir_media_manana);		
				}
				if(temp_incluir_plato_comida != ''){
					$("#temp_incluir_plato_comida").attr('value', temp_incluir_plato_comida);		
				}
				if(temp_incluir_plato_comida_principal != ''){
					$("#temp_incluir_plato_comida_principal").attr('value', temp_incluir_plato_comida_principal);		
				}
				if(temp_incluir_postre != ''){
					$("#temp_incluir_postre").attr('value', temp_incluir_postre);		
				}
				if(temp_incluir_merienda != ''){
					$("#temp_incluir_merienda").attr('value', temp_incluir_merienda);		
				}
				if(temp_incluir_plato_cena != ''){
					$("#temp_incluir_plato_cena").attr('value', temp_incluir_plato_cena);		
				}
				if(temp_incluir_plato_cena_principal != ''){
					$("#temp_incluir_plato_cena_principal").attr('value', temp_incluir_plato_cena_principal);		
				}
				if(temp_incluir_recena != ''){
					$("#temp_incluir_recena").attr('value', temp_incluir_recena);		
				}
				if(temp_incluir_otros != ''){
					$("#temp_incluir_otros").attr('value', temp_incluir_otros);		
				}
		}
		function encode_var (str) {
			var buf = [];
			
			for (var i=str.length-1;i>=0;i--) {
				buf.unshift(['&#', str[i].charCodeAt(), ';'].join(''));
			}
			
			return buf.join('');
		}
		function decode_var (str) {
			return str.replace(/&#(\d+);/g, function(match, dec) {
				return String.fromCharCode(dec);
			});
		}
		
		//Boton para duplicar receta
		$("#duplicar_alimento_original").on("click", function () {
            $('#formulario_editar_receta').attr('action',  "<?php echo $url_app; ?>guardar-nueva-receta");					
			$("#formulario_editar_receta" ).submit();
        });
		//Boton para editar receta
		$("#guardar_receta").on("click", function () {
            $('#formulario_editar_receta').attr('action', "<?php echo $url_app; ?>guardar-nueva-receta");			
			$("#formulario_editar_receta" ).submit();
        });
    </script>	
	<?php $conn->close(); ?>
</body>
</html>


