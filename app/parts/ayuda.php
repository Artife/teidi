<?php

function header_documento (){
	$html = '';
	$html .= '<!DOCTYPE html>';
	$html .= '<html lang="es-ES">';
	$html .= '<head>';
	
	return $html;
}

function salida_nombre ($nombre){
	if($_SESSION['tipo_conexion'] == 'localhost'){
		if($_SESSION['ubicacion_local'] == 'oficina'){
			$nombre = $nombre;
		}else{
			$nombre = $nombre;
		}
	}else{
		$nombre = utf8_encode($nombre);
	}
	
	return $nombre;
}

function entrada_nombre ($nombre){
	if($_SESSION['tipo_conexion'] == 'localhost'){
		if($_SESSION['ubicacion_local'] == 'oficina'){
			$nombre = $nombre;
		}else{
			$nombre = $nombre;
		}
	}else{
		$nombre = utf8_decode($nombre);
	}
	
	return $nombre;
}

function png_a_jpg($archivo) 
{ 
	$imagen = 'x';
    if ( is_file($archivo) ) 
    { 
        $imagen = imagecreatefrompng($archivo); 
        $archivo=str_replace(".png", ".jpg", $archivo); 
        $imagen = imagejpeg($imagen,$archivo,100); 
    } 
    
	return 	$imagen;
} 


function  migas_de_pan ($pagina, $migas, $migas_url, $botones){
 
 $html ='';
 if(isset($botones)){
  $html .='<div class="col-lg-8">';
 }else{
  $html .='<div class="col-lg-12">';
 }
  $html .='<h2>'.$pagina.'</h2>';
  $html .='<ol class="breadcrumb">';
  $html .='<li>';
   $html .='<a href="#">Home</a>';
  $html .='</li>';
  if(count($migas) != 1){
   foreach ($migas as &$miga) {
   $html .='<li>';
    $html .='<a href="#">'.$miga.'</a>';
   $html .='</li>';
   }
  }
  $html .='<li class="active">';
   $html .='<strong>'.$pagina.'</strong>';
  $html .='</li>';
  $html .='</ol>';
 $html .='</div>';
 
 return $html;
}

function modal_boton_enviar ($idmodal, $titulo, $descripcion, $descripcion_larga, $text_boton){
 
 $html =''; 
 $html .='<div class="modal inmodal" id="'.$idmodal.'" tabindex="-1" role="dialog" aria-hidden="true">';
  $html .='<div class="modal-dialog">';
   $html .='<div class="modal-content animated bounceInTop">';
                $html .='<div class="modal-header">';
                    $html .='<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';                        
                        $html .='<h4 class="modal-title">'.$titulo.'</h4>';
                            $html .='<small class="font-bold">'.$descripcion.'</small>';
                $html .='</div>';
                $html .='<div class="modal-body">';
     $html .='<p class="text-center">'.$descripcion_larga.'</p>';
     $html .='<div class="text-center">';
      if($text_boton != ''){
       $html .='<button id="btn_'.$idmodal.'" type="submit" class="btn btn-primary">'.$text_boton.'</button>';
      }
     $html .='</div>';
                $html .='</div>';
                $html .='<div class="modal-footer">';
     $html .='<button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>';
    $html .='</div>';
   $html .='</div>';
  $html .='</div>';
 $html .='</div>';
 
 return $html;
}

$spain_provincias = array('Alava','Albacete','Alicante','Almería','Asturias','Avila','Badajoz','Barcelona','Burgos','Cáceres',
'Cádiz','Cantabria','Castellón','Ciudad Real','Córdoba','La Coruña','Cuenca','Gerona','Granada','Guadalajara',
'Guipúzcoa','Huelva','Huesca','Islas Baleares','Jaén','León','Lérida','Lugo','Madrid','Málaga','Murcia','Navarra',
'Orense','Palencia','Las Palmas','Pontevedra','La Rioja','Salamanca','Segovia','Sevilla','Soria','Tarragona',
'Santa Cruz de Tenerife','Teruel','Toledo','Valencia','Valladolid','Vizcaya','Zamora','Zaragoza');

$spain_comunidades = array("Andalucía", "Aragón", "Canarias", "Cantabria", "Castilla y León", "Castilla-La Mancha", "Cataluña", "Ceuta", "Comunidad Valenciana", "Comunidad de Madrid", "Extremadura", "Galicia", "Islas Baleares", "La Rioja", "Melilla", "Navarra", "País Vasco", "Principado de Asturias", "Región de Murcia");

function generar_contrasena($length = 8) {
 $pass = "";
 $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
 $max = count($characters) - 1;
 for ($i = 0; $i < $length; $i++) {
  $rand = mt_rand(0, $max);
  $pass .= $characters[$rand];
 }
 return $pass;
}

function crear_checkbox (){ 
 $html ="<input type='checkbox' class='i-checks marcar' name='".$name."' value='".$value."'>";
 $html ="hola"; 
 return $html;
}

function opciones_dieta ($gramos){
 $html ='';
 $html .='<div class="ibox-tools">';
 $html .='<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">'.$gramos.' <i class="fa fa-plus-circle" aria-hidden="true"></i></a>';
 $html .='<ul class="dropdown-menu dropdown-user">';
 $html .='<li><a id="btn_copiar" href="#">Copiar</a></li>';
 $html .='<li><a id="btn_pegar" href="#">Pegar</a></li>';
 $html .='<li><a id="btn_aplicar_a_todo" href="#">Aplicar a toda la dieta</a></li>'; 
 $html .='<li><a id="btn_bloquear_desbloquear" href="#">Bloquear/Desbloquear</a></li>';
 $html .='<li><a id="btn_ver_informacion" href="#">Ver información del plato</a></li>';
 $html .='<li><a id="btn_buscar_plato_equivalente" href="#">Buscar plato equivalente</a></li>';
 $html .='<li><a id="btn_marcar_como_libre" href="#">Marcar como libre</a></li>';
 $html .='<li><a id="btn_modificar_peso_comida" href="#">Modificar peso de comida</a></li>';
 $html .='</li>';
 $html .='</div>';
 
 return $html;
} 
function contar_texto ($texto){ 
 $texto = wordwrap($texto, 17, "<br />",1);
 return $texto; 
}

function chunk_split_unicode($str, $l = 76, $e = "\r\n") {
    $tmp = array_chunk(
        preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY), $l);
    $str = "";
    foreach ($tmp as $t) {
        $str .= join("", $t) . $e;
    }
    return $str;
}  


function limpiar_dni ($dni) { 
 $devolver_dni = strtoupper($dni);
 $devolver_dni = str_replace(' ', '', $devolver_dni);
 return $devolver_dni;
}
function limpiar_nombres ($nombre) { 
 // $devolver_nombre = ucwords(strtolower($nombre)); 
 $devolver_nombre = $nombre;
 return $devolver_nombre;
}


function contar_valores_duplicados($array)
{
	$contar=array();
 
	foreach($array as $value)
	{
		if(isset($contar[$value]))
		{
			// si ya existe, le añadimos uno
			$contar[$value]+=1;
		}else{
			// si no existe lo añadimos al array
			$contar[$value]=1;
		}
	}
	return $contar;
}


function crear_textos_amigables($texto) {
 // Tranformamos todo a minusculas
 $texto = strtolower($texto);

 //Rememplazamos caracteres especiales latinos
 $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
 $repl = array('a', 'e', 'i', 'o', 'u', 'n');
 $texto = str_replace ($find, $repl, $texto);

 // Añaadimos los guiones
 $find = array(' ', '&', '\r\n', '\n', '+'); 
 $texto = str_replace ($find, '-', $texto);

 // Eliminamos y Reemplazamos demás caracteres especiales
 $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
 $repl = array('', '-', '');
 $texto = preg_replace ($find, $repl, $texto);

 return $texto;

}

function gx_mostrar_observaciones($texto) {
 // Tranformamos todo a minusculas
 $texto = strtolower($texto);

 //Rememplazamos caracteres especiales latinos
 $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
 $repl = array('a', 'e', 'i', 'o', 'u', 'n');
 $texto = str_replace ($find, $repl, $texto);

 // Añaadimos los guiones
 $find = array(' ', '&', '\r\n', '\n', '+'); 
 $texto = str_replace ($find, '-', $texto);

 // Eliminamos y Reemplazamos demás caracteres especiales
 $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
 $repl = array('', '-', '');
 $texto = preg_replace ($find, $repl, $texto);

 return $texto;

}

function flecha_prev ($semana, $fin){
 
 $html = '';
 if($semana == 1){
  $html = $semana;
 }else{
  $html = '<a href="#contenedor_slider" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>'.$semana;
 }
 return $html;
}
function flecha_next ($semana, $fin){
 
 $html = '';
 if($semana == $fin){
  $html = $fin;
 }else{
  $html = $fin.'<a href="#contenedor_slider" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>';
 }
 return $html;
}

function flecha_prev_2 ($semana, $fin){
 
 $html = '';
   

  if($semana == 0){
   $html = 'Media <a href="#contenedor_slider_2" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>'.$semana;
  }else{
   $html = 'Día <a href="#contenedor_slider_2" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>'.$semana;
  }  
  return $html;
}
function flecha_next_2 ($semana, $fin){
 
 $html = '';
 if($semana == $fin){
  $html = $fin; 
 }else{
  $html = $fin.'<a href="#contenedor_slider_2" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>';
 }
 return $html;
}

function extraer_numeros($string){
	
	//buscamos el /
	$pos = strpos($string, '/');

	//cortamos a partir del /
	$int = substr($string, ($pos+1));
	

	return $int;
}

function solo_numero($string){
	
	//sacamos solo los numeros de la cadena
	$resultado = intval(preg_replace('/[^0-9]+/', '', $string), 10); 
	

	return $resultado;
}

function texto_acentos($texto){
	if($_SESSION['tipo_conexion'] == 'localhost'){	
		$texto =  utf8_encode($texto);	
	}else{
		$texto =  utf8_decode($texto);
	}	
	
	return $texto;
	
}


function plato_libre(){
	$plato_libre = '';
	$plato_libre['preparacion'] = "-";
	$plato_libre['id_plato'] = 00;
	$plato_libre['fijo'] = 0;
	$plato_libre['peso'] = 0;
	$plato_libre['kcal'] = 0;
	$plato_libre['hidratos'] = 0;
	$plato_libre['grasa'] = 0;
	$plato_libre['proteinas'] = 0;
	$plato_libre['nombre'] = 'Libre';
	$plato_libre['pc_porcentaje'] = 0;
	$plato_libre['agua_g'] = 0;
	$plato_libre['cal_kcal'] = 0;
	$plato_libre['prot_g'] = 0;
	$plato_libre['hc_g'] = 0;
	$plato_libre['grasa_g'] = 0;
	$plato_libre['satur_g'] = 0;
	$plato_libre['mono_g'] = 0;
	$plato_libre['poli_g'] = 0;
	$plato_libre['col_mg'] = 0;
	$plato_libre['fibra_g'] = 0;
	$plato_libre['sodio_mg'] = 0;
	$plato_libre['potasio_mg'] = 0;
	$plato_libre['magnesio_mg'] = 0;
	$plato_libre['calcio_mg'] = 0;
	$plato_libre['fosf_mg'] = 0;
	$plato_libre['hierro_mg'] = 0;
	$plato_libre['cloro_mg'] = 0;
	$plato_libre['cinc_mg'] = 0;
	$plato_libre['cobre_mg'] = 0;
	$plato_libre['manganeso_mg'] = 0;
	$plato_libre['cromo_mg'] = 0;
	$plato_libre['cobalto_mg'] = 0;
	$plato_libre['molibde_mg'] = 0;
	$plato_libre['yodo_mg'] = 0;
	$plato_libre['fluor_mg'] = 0;
	$plato_libre['butirico_c4_0'] = 0;
	$plato_libre['caproico_c6_0'] = 0;
	$plato_libre['caprilico_c8_0'] = 0;
	$plato_libre['caprico_c10_0'] = 0;
	$plato_libre['laurico_c12_0'] = 0;
	$plato_libre['miristico_c14_0'] = 0;
	$plato_libre['c15_0'] = 0;
	$plato_libre['c15_00'] = 0;
	$plato_libre['palmitico_c16_0'] = 0;
	$plato_libre['c17_0'] = 0;
	$plato_libre['c17_00'] = 0;
	$plato_libre['estearico_c18_0'] = 0;
	$plato_libre['araquidi_c20_0'] = 0;
	$plato_libre['behenico_c22_0'] = 0;
	$plato_libre['miristol_c14_1'] = 0;
	$plato_libre['palmitole_c16_1'] = 0;
	$plato_libre['oleico_c18_1'] = 0;
	$plato_libre['eicoseno_c20_1'] = 0;
	$plato_libre['c22_1'] = 0;
	$plato_libre['linoleico_c18_2'] = 0;
	$plato_libre['linoleni_c18_3'] = 0;
	$plato_libre['c18_4'] = 0;
	$plato_libre['ara_ico_c20_4'] = 0;
	$plato_libre['c20_5'] = 0;
	$plato_libre['c22_5'] = 0;
	$plato_libre['c22_6'] = 0;
	$plato_libre['otrosatur0'] = 0;
	$plato_libre['otroinsat0'] = 0;
	$plato_libre['omega3_0'] = 0;
	$plato_libre['etanol0'] = 0;
	$plato_libre['vit_a'] = 0;
	$plato_libre['carotenos'] = 0;
	$plato_libre['tocoferol'] = 0;
	$plato_libre['vit_d'] = 0;
	$plato_libre['vit_b1'] = 0;
	$plato_libre['vit_b2'] = 0;
	$plato_libre['vit_b6'] = 0;
	$plato_libre['niacina'] = 0;
	$plato_libre['ac_panto'] = 0;
	$plato_libre['biotina'] = 0;
	$plato_libre['folico'] = 0;
	$plato_libre['b12'] = 0;
	$plato_libre['vit_c'] = 0;
	$plato_libre['purinas'] = 0;
	$plato_libre['vit_k'] = 0;
	$plato_libre['vit_e'] = 0;
	$plato_libre['oxalico'] = 0;

	return $plato_libre;
}


function generarEstadisticas($num_comidas, $platos_comida, $comida_postre, $plato_cena, $cena_postre){

	//Iniciamos las variables
	$media_hidratos 	= 0;
    $media_proteinas	= 0;
    $media_grasas 		= 0;
    $media_calorias 	= 0;
 
	//agregamos el numero de comidas por dias
	$platos_porDia = $num_comidas;


	//tambien hace un ciclo de la semana
	$semana = 0;

	$platos_porDia;
	//Incrementamos los platos por dias segun lo que halla seleccionado el cliente	
    if ($platos_comida == 2){
		$platos_porDia++;
	}
    if ($comida_postre == 'si'){
		 $platos_porDia++;
	}
    if ($plato_cena == 2){
		$platos_porDia++;
	}
    if ($cena_postre == 'si'){
		$platos_porDia++;
	}
 
	//Creamos las matrices 
    crearMatrices();

 
 /*
    for ($i = 0; $i < $_SESSION["num_dias"]; $i++)

    {

  //echo " 14".$i." " .time();

        $semana = floor($i/7);



  //echo " desayunos ";

  $media_grasas += $_SESSION["desayunos"][$i]->grasa;

        $media_hidratos += $_SESSION["desayunos"][$i]->hidratos;

        $media_proteinas += $_SESSION["desayunos"][$i]->proteinas;

  

  $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["desayunos"][$i]->pc_porcentaje*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_agua_g"][$i] += $_SESSION["desayunos"][$i]->agua_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cal_kcal"][$i] += $_SESSION["desayunos"][$i]->cal_kcal*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_prot_g"][$i] += $_SESSION["desayunos"][$i]->prot_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_hc_g"][$i] += $_SESSION["desayunos"][$i]->hc_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_grasa_g"][$i] += $_SESSION["desayunos"][$i]->grasa_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_satur_g"][$i] += $_SESSION["desayunos"][$i]->satur_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_mono_g"][$i] += $_SESSION["desayunos"][$i]->mono_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_poli_g"][$i] += $_SESSION["desayunos"][$i]->poli_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_col_mg"][$i] += $_SESSION["desayunos"][$i]->col_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_fibra_g"][$i] += $_SESSION["desayunos"][$i]->fibra_g*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_sodio_mg"][$i] += $_SESSION["desayunos"][$i]->sodio_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_potasio_mg"][$i] += $_SESSION["desayunos"][$i]->potasio_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_magnesio_mg"][$i] += $_SESSION["desayunos"][$i]->magnesio_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_calcio_mg"][$i] += $_SESSION["desayunos"][$i]->calcio_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_fosf_mg"][$i] += $_SESSION["desayunos"][$i]->fosf_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_hierro_mg"][$i] += $_SESSION["desayunos"][$i]->hierro_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cloro_mg"][$i] += $_SESSION["desayunos"][$i]->cloro_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cinc_mg"][$i] += $_SESSION["desayunos"][$i]->cinc_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cobre_mg"][$i] += $_SESSION["desayunos"][$i]->cobre_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_manganeso_mg"][$i] += $_SESSION["desayunos"][$i]->manganeso_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cromo_mg"][$i] += $_SESSION["desayunos"][$i]->cromo_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_cobalto_mg"][$i] += $_SESSION["desayunos"][$i]->cobalto_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_molibde_mg"][$i] += $_SESSION["desayunos"][$i]->molibde_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_yodo_mg"][$i] += $_SESSION["desayunos"][$i]->yodo_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_fluor_mg"][$i] += $_SESSION["desayunos"][$i]->fluor_mg*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["desayunos"][$i]->butirico_c4_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["desayunos"][$i]->caproico_c6_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["desayunos"][$i]->caprilico_c8_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["desayunos"][$i]->caprico_c10_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["desayunos"][$i]->laurico_c12_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["desayunos"][$i]->miristico_c14_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c15_0"][$i] += $_SESSION["desayunos"][$i]->c15_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c15_00"][$i] += $_SESSION["desayunos"][$i]->c15_00*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["desayunos"][$i]->palmitico_c16_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c17_0"][$i] += $_SESSION["desayunos"][$i]->c17_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c17_00"][$i] += $_SESSION["desayunos"][$i]->c17_00*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["desayunos"][$i]->estearico_c18_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["desayunos"][$i]->araquidi_c20_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["desayunos"][$i]->behenico_c22_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["desayunos"][$i]->miristol_c14_1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["desayunos"][$i]->palmitole_c16_1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["desayunos"][$i]->oleico_c18_1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["desayunos"][$i]->eicoseno_c20_1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c22_1"][$i] += $_SESSION["desayunos"][$i]->c22_1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["desayunos"][$i]->linoleico_c18_2*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["desayunos"][$i]->linoleni_c18_3*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c18_4"][$i] += $_SESSION["desayunos"][$i]->c18_4*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["desayunos"][$i]->ara_ico_c20_4*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c20_5"][$i] += $_SESSION["desayunos"][$i]->c20_5*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c22_5"][$i] += $_SESSION["desayunos"][$i]->c22_5*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_c22_6"][$i] += $_SESSION["desayunos"][$i]->c22_6*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_otrosatur0"][$i] += $_SESSION["desayunos"][$i]->otrosatur0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_otroinsat0"][$i] += $_SESSION["desayunos"][$i]->otroinsat0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_omega3_0"][$i] += $_SESSION["desayunos"][$i]->omega3_0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_etanol0"][$i] += $_SESSION["desayunos"][$i]->etanol0*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_a"][$i] += $_SESSION["desayunos"][$i]->vit_a*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_carotenos"][$i] += $_SESSION["desayunos"][$i]->carotenos*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_tocoferol"][$i] += $_SESSION["desayunos"][$i]->tocoferol*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_d"][$i] += $_SESSION["desayunos"][$i]->vit_d*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_b1"][$i] += $_SESSION["desayunos"][$i]->vit_b1*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_b2"][$i] += $_SESSION["desayunos"][$i]->vit_b2*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_b6"][$i] += $_SESSION["desayunos"][$i]->vit_b6*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_niacina"][$i] += $_SESSION["desayunos"][$i]->niacina*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_ac_panto"][$i] += $_SESSION["desayunos"][$i]->ac_panto*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_biotina"][$i] += $_SESSION["desayunos"][$i]->biotina*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_folico"][$i] += $_SESSION["desayunos"][$i]->folico*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_b12"][$i] += $_SESSION["desayunos"][$i]->b12*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_c"][$i] += $_SESSION["desayunos"][$i]->vit_c*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_purinas"][$i] += $_SESSION["desayunos"][$i]->purinas*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_k"][$i] += $_SESSION["desayunos"][$i]->vit_k*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_vit_e"][$i] += $_SESSION["desayunos"][$i]->vit_e*$_SESSION["desayunos"][$i]->peso/100;

  $_SESSION["media_oxalico"][$i] += $_SESSION["desayunos"][$i]->oxalico*$_SESSION["desayunos"][$i]->peso/100;



        rellenaMatrices($_SESSION["desayunos"][$i]->id_plato, $i, $semana);



  //echo " mediamananas ";

        if ($_SESSION["kcalorias_mediamanana"] != 0)

        {

         $media_grasas += $_SESSION["mediamananas"][$i]->grasa;

         $media_hidratos += $_SESSION["mediamananas"][$i]->hidratos;

         $media_proteinas += $_SESSION["mediamananas"][$i]->proteinas;



   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["mediamananas"][$i]->pc_porcentaje*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["mediamananas"][$i]->agua_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["mediamananas"][$i]->cal_kcal*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["mediamananas"][$i]->prot_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["mediamananas"][$i]->hc_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["mediamananas"][$i]->grasa_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["mediamananas"][$i]->satur_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["mediamananas"][$i]->mono_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["mediamananas"][$i]->poli_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["mediamananas"][$i]->col_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["mediamananas"][$i]->fibra_g*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["mediamananas"][$i]->sodio_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["mediamananas"][$i]->potasio_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["mediamananas"][$i]->magnesio_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["mediamananas"][$i]->calcio_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["mediamananas"][$i]->fosf_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["mediamananas"][$i]->hierro_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["mediamananas"][$i]->cloro_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["mediamananas"][$i]->cinc_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["mediamananas"][$i]->cobre_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["mediamananas"][$i]->manganeso_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["mediamananas"][$i]->cromo_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["mediamananas"][$i]->cobalto_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["mediamananas"][$i]->molibde_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["mediamananas"][$i]->yodo_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["mediamananas"][$i]->fluor_mg*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["mediamananas"][$i]->butirico_c4_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["mediamananas"][$i]->caproico_c6_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["mediamananas"][$i]->caprilico_c8_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["mediamananas"][$i]->caprico_c10_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["mediamananas"][$i]->laurico_c12_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["mediamananas"][$i]->miristico_c14_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["mediamananas"][$i]->c15_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["mediamananas"][$i]->c15_00*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["mediamananas"][$i]->palmitico_c16_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["mediamananas"][$i]->c17_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["mediamananas"][$i]->c17_00*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["mediamananas"][$i]->estearico_c18_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["mediamananas"][$i]->araquidi_c20_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["mediamananas"][$i]->behenico_c22_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["mediamananas"][$i]->miristol_c14_1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["mediamananas"][$i]->palmitole_c16_1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["mediamananas"][$i]->oleico_c18_1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["mediamananas"][$i]->eicoseno_c20_1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["mediamananas"][$i]->c22_1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["mediamananas"][$i]->linoleico_c18_2*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["mediamananas"][$i]->linoleni_c18_3*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["mediamananas"][$i]->c18_4*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["mediamananas"][$i]->ara_ico_c20_4*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["mediamananas"][$i]->c20_5*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["mediamananas"][$i]->c22_5*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["mediamananas"][$i]->c22_6*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["mediamananas"][$i]->otrosatur0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["mediamananas"][$i]->otroinsat0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["mediamananas"][$i]->omega3_0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["mediamananas"][$i]->etanol0*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["mediamananas"][$i]->vit_a*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["mediamananas"][$i]->carotenos*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["mediamananas"][$i]->tocoferol*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["mediamananas"][$i]->vit_d*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["mediamananas"][$i]->vit_b1*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["mediamananas"][$i]->vit_b2*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["mediamananas"][$i]->vit_b6*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["mediamananas"][$i]->niacina*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["mediamananas"][$i]->ac_panto*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["mediamananas"][$i]->biotina*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["mediamananas"][$i]->folico*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["mediamananas"][$i]->b12*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["mediamananas"][$i]->vit_c*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["mediamananas"][$i]->purinas*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["mediamananas"][$i]->vit_k*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["mediamananas"][$i]->vit_e*$_SESSION["mediamananas"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["mediamananas"][$i]->oxalico*$_SESSION["mediamananas"][$i]->peso/100;



         rellenaMatrices($_SESSION["mediamananas"][$i]->id_plato, $i, $semana);

        }

  

  //echo " comidas1 ";

        if ($_SESSION["kcalorias_comida1"] != 0)

        {

         $media_grasas += $_SESSION["comidas1"][$i]->grasa;

         $media_hidratos += $_SESSION["comidas1"][$i]->hidratos;

         $media_proteinas += $_SESSION["comidas1"][$i]->proteinas;

   

   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["comidas1"][$i]->pc_porcentaje*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["comidas1"][$i]->agua_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["comidas1"][$i]->cal_kcal*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["comidas1"][$i]->prot_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["comidas1"][$i]->hc_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["comidas1"][$i]->grasa_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["comidas1"][$i]->satur_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["comidas1"][$i]->mono_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["comidas1"][$i]->poli_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["comidas1"][$i]->col_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["comidas1"][$i]->fibra_g*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["comidas1"][$i]->sodio_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["comidas1"][$i]->potasio_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["comidas1"][$i]->magnesio_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["comidas1"][$i]->calcio_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["comidas1"][$i]->fosf_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["comidas1"][$i]->hierro_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["comidas1"][$i]->cloro_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["comidas1"][$i]->cinc_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["comidas1"][$i]->cobre_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["comidas1"][$i]->manganeso_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["comidas1"][$i]->cromo_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["comidas1"][$i]->cobalto_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["comidas1"][$i]->molibde_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["comidas1"][$i]->yodo_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["comidas1"][$i]->fluor_mg*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["comidas1"][$i]->butirico_c4_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["comidas1"][$i]->caproico_c6_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["comidas1"][$i]->caprilico_c8_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["comidas1"][$i]->caprico_c10_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["comidas1"][$i]->laurico_c12_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["comidas1"][$i]->miristico_c14_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["comidas1"][$i]->c15_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["comidas1"][$i]->c15_00*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["comidas1"][$i]->palmitico_c16_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["comidas1"][$i]->c17_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["comidas1"][$i]->c17_00*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["comidas1"][$i]->estearico_c18_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["comidas1"][$i]->araquidi_c20_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["comidas1"][$i]->behenico_c22_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["comidas1"][$i]->miristol_c14_1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["comidas1"][$i]->palmitole_c16_1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["comidas1"][$i]->oleico_c18_1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["comidas1"][$i]->eicoseno_c20_1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["comidas1"][$i]->c22_1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["comidas1"][$i]->linoleico_c18_2*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["comidas1"][$i]->linoleni_c18_3*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["comidas1"][$i]->c18_4*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["comidas1"][$i]->ara_ico_c20_4*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["comidas1"][$i]->c20_5*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["comidas1"][$i]->c22_5*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["comidas1"][$i]->c22_6*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["comidas1"][$i]->otrosatur0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["comidas1"][$i]->otroinsat0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["comidas1"][$i]->omega3_0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["comidas1"][$i]->etanol0*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["comidas1"][$i]->vit_a*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["comidas1"][$i]->carotenos*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["comidas1"][$i]->tocoferol*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["comidas1"][$i]->vit_d*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["comidas1"][$i]->vit_b1*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["comidas1"][$i]->vit_b2*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["comidas1"][$i]->vit_b6*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["comidas1"][$i]->niacina*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["comidas1"][$i]->ac_panto*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["comidas1"][$i]->biotina*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["comidas1"][$i]->folico*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["comidas1"][$i]->b12*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["comidas1"][$i]->vit_c*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["comidas1"][$i]->purinas*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["comidas1"][$i]->vit_k*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["comidas1"][$i]->vit_e*$_SESSION["comidas1"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["comidas1"][$i]->oxalico*$_SESSION["comidas1"][$i]->peso/100;



         rellenaMatrices($_SESSION["comidas1"][$i]->id_plato, $i, $semana);

        }



  //echo " comidas ";

        $media_grasas += $_SESSION["comidas"][$i]->grasa;

        $media_hidratos += $_SESSION["comidas"][$i]->hidratos;

        $media_proteinas += $_SESSION["comidas"][$i]->proteinas;

  

  $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["comidas"][$i]->pc_porcentaje*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_agua_g"][$i] += $_SESSION["comidas"][$i]->agua_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cal_kcal"][$i] += $_SESSION["comidas"][$i]->cal_kcal*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_prot_g"][$i] += $_SESSION["comidas"][$i]->prot_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_hc_g"][$i] += $_SESSION["comidas"][$i]->hc_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_grasa_g"][$i] += $_SESSION["comidas"][$i]->grasa_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_satur_g"][$i] += $_SESSION["comidas"][$i]->satur_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_mono_g"][$i] += $_SESSION["comidas"][$i]->mono_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_poli_g"][$i] += $_SESSION["comidas"][$i]->poli_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_col_mg"][$i] += $_SESSION["comidas"][$i]->col_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_fibra_g"][$i] += $_SESSION["comidas"][$i]->fibra_g*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_sodio_mg"][$i] += $_SESSION["comidas"][$i]->sodio_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_potasio_mg"][$i] += $_SESSION["comidas"][$i]->potasio_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_magnesio_mg"][$i] += $_SESSION["comidas"][$i]->magnesio_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_calcio_mg"][$i] += $_SESSION["comidas"][$i]->calcio_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_fosf_mg"][$i] += $_SESSION["comidas"][$i]->fosf_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_hierro_mg"][$i] += $_SESSION["comidas"][$i]->hierro_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cloro_mg"][$i] += $_SESSION["comidas"][$i]->cloro_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cinc_mg"][$i] += $_SESSION["comidas"][$i]->cinc_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cobre_mg"][$i] += $_SESSION["comidas"][$i]->cobre_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_manganeso_mg"][$i] += $_SESSION["comidas"][$i]->manganeso_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cromo_mg"][$i] += $_SESSION["comidas"][$i]->cromo_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_cobalto_mg"][$i] += $_SESSION["comidas"][$i]->cobalto_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_molibde_mg"][$i] += $_SESSION["comidas"][$i]->molibde_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_yodo_mg"][$i] += $_SESSION["comidas"][$i]->yodo_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_fluor_mg"][$i] += $_SESSION["comidas"][$i]->fluor_mg*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["comidas"][$i]->butirico_c4_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["comidas"][$i]->caproico_c6_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["comidas"][$i]->caprilico_c8_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["comidas"][$i]->caprico_c10_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["comidas"][$i]->laurico_c12_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["comidas"][$i]->miristico_c14_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c15_0"][$i] += $_SESSION["comidas"][$i]->c15_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c15_00"][$i] += $_SESSION["comidas"][$i]->c15_00*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["comidas"][$i]->palmitico_c16_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c17_0"][$i] += $_SESSION["comidas"][$i]->c17_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c17_00"][$i] += $_SESSION["comidas"][$i]->c17_00*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["comidas"][$i]->estearico_c18_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["comidas"][$i]->araquidi_c20_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["comidas"][$i]->behenico_c22_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["comidas"][$i]->miristol_c14_1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["comidas"][$i]->palmitole_c16_1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["comidas"][$i]->oleico_c18_1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["comidas"][$i]->eicoseno_c20_1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c22_1"][$i] += $_SESSION["comidas"][$i]->c22_1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["comidas"][$i]->linoleico_c18_2*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["comidas"][$i]->linoleni_c18_3*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c18_4"][$i] += $_SESSION["comidas"][$i]->c18_4*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["comidas"][$i]->ara_ico_c20_4*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c20_5"][$i] += $_SESSION["comidas"][$i]->c20_5*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c22_5"][$i] += $_SESSION["comidas"][$i]->c22_5*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_c22_6"][$i] += $_SESSION["comidas"][$i]->c22_6*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_otrosatur0"][$i] += $_SESSION["comidas"][$i]->otrosatur0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_otroinsat0"][$i] += $_SESSION["comidas"][$i]->otroinsat0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_omega3_0"][$i] += $_SESSION["comidas"][$i]->omega3_0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_etanol0"][$i] += $_SESSION["comidas"][$i]->etanol0*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_a"][$i] += $_SESSION["comidas"][$i]->vit_a*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_carotenos"][$i] += $_SESSION["comidas"][$i]->carotenos*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_tocoferol"][$i] += $_SESSION["comidas"][$i]->tocoferol*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_d"][$i] += $_SESSION["comidas"][$i]->vit_d*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_b1"][$i] += $_SESSION["comidas"][$i]->vit_b1*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_b2"][$i] += $_SESSION["comidas"][$i]->vit_b2*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_b6"][$i] += $_SESSION["comidas"][$i]->vit_b6*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_niacina"][$i] += $_SESSION["comidas"][$i]->niacina*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_ac_panto"][$i] += $_SESSION["comidas"][$i]->ac_panto*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_biotina"][$i] += $_SESSION["comidas"][$i]->biotina*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_folico"][$i] += $_SESSION["comidas"][$i]->folico*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_b12"][$i] += $_SESSION["comidas"][$i]->b12*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_c"][$i] += $_SESSION["comidas"][$i]->vit_c*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_purinas"][$i] += $_SESSION["comidas"][$i]->purinas*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_k"][$i] += $_SESSION["comidas"][$i]->vit_k*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_vit_e"][$i] += $_SESSION["comidas"][$i]->vit_e*$_SESSION["comidas"][$i]->peso/100;

  $_SESSION["media_oxalico"][$i] += $_SESSION["comidas"][$i]->oxalico*$_SESSION["comidas"][$i]->peso/100;

  

        rellenaMatrices($_SESSION["comidas"][$i]->id_plato, $i, $semana);



  //echo " postres_comida ";

        if ($_SESSION["kcalorias_comida_postre"] != 0)

        {

         $media_grasas += $_SESSION["postres_comida"][$i]->grasa;

         $media_hidratos += $_SESSION["postres_comida"][$i]->hidratos;

         $media_proteinas += $_SESSION["postres_comida"][$i]->proteinas;



   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["postres_comida"][$i]->pc_porcentaje*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["postres_comida"][$i]->agua_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["postres_comida"][$i]->cal_kcal*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["postres_comida"][$i]->prot_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["postres_comida"][$i]->hc_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["postres_comida"][$i]->grasa_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["postres_comida"][$i]->satur_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["postres_comida"][$i]->mono_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["postres_comida"][$i]->poli_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["postres_comida"][$i]->col_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["postres_comida"][$i]->fibra_g*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["postres_comida"][$i]->sodio_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["postres_comida"][$i]->potasio_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["postres_comida"][$i]->magnesio_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["postres_comida"][$i]->calcio_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["postres_comida"][$i]->fosf_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["postres_comida"][$i]->hierro_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["postres_comida"][$i]->cloro_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["postres_comida"][$i]->cinc_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["postres_comida"][$i]->cobre_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["postres_comida"][$i]->manganeso_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["postres_comida"][$i]->cromo_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["postres_comida"][$i]->cobalto_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["postres_comida"][$i]->molibde_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["postres_comida"][$i]->yodo_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["postres_comida"][$i]->fluor_mg*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["postres_comida"][$i]->butirico_c4_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["postres_comida"][$i]->caproico_c6_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["postres_comida"][$i]->caprilico_c8_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["postres_comida"][$i]->caprico_c10_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["postres_comida"][$i]->laurico_c12_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["postres_comida"][$i]->miristico_c14_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["postres_comida"][$i]->c15_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["postres_comida"][$i]->c15_00*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["postres_comida"][$i]->palmitico_c16_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["postres_comida"][$i]->c17_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["postres_comida"][$i]->c17_00*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["postres_comida"][$i]->estearico_c18_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["postres_comida"][$i]->araquidi_c20_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["postres_comida"][$i]->behenico_c22_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["postres_comida"][$i]->miristol_c14_1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["postres_comida"][$i]->palmitole_c16_1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["postres_comida"][$i]->oleico_c18_1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["postres_comida"][$i]->eicoseno_c20_1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["postres_comida"][$i]->c22_1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["postres_comida"][$i]->linoleico_c18_2*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["postres_comida"][$i]->linoleni_c18_3*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["postres_comida"][$i]->c18_4*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["postres_comida"][$i]->ara_ico_c20_4*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["postres_comida"][$i]->c20_5*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["postres_comida"][$i]->c22_5*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["postres_comida"][$i]->c22_6*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["postres_comida"][$i]->otrosatur0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["postres_comida"][$i]->otroinsat0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["postres_comida"][$i]->omega3_0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["postres_comida"][$i]->etanol0*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["postres_comida"][$i]->vit_a*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["postres_comida"][$i]->carotenos*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["postres_comida"][$i]->tocoferol*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["postres_comida"][$i]->vit_d*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["postres_comida"][$i]->vit_b1*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["postres_comida"][$i]->vit_b2*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["postres_comida"][$i]->vit_b6*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["postres_comida"][$i]->niacina*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["postres_comida"][$i]->ac_panto*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["postres_comida"][$i]->biotina*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["postres_comida"][$i]->folico*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["postres_comida"][$i]->b12*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["postres_comida"][$i]->vit_c*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["postres_comida"][$i]->purinas*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["postres_comida"][$i]->vit_k*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["postres_comida"][$i]->vit_e*$_SESSION["postres_comida"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["postres_comida"][$i]->oxalico*$_SESSION["postres_comida"][$i]->peso/100;



         rellenaMatrices($_SESSION["postres_comida"][$i]->id_plato, $i, $semana);

        }



  //echo " meriendas ";

        if ($_SESSION["kcalorias_merienda"] != 0)

        {

         $media_grasas += $_SESSION["meriendas"][$i]->grasa;

         $media_hidratos += $_SESSION["meriendas"][$i]->hidratos;

         $media_proteinas += $_SESSION["meriendas"][$i]->proteinas;

   

   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["meriendas"][$i]->pc_porcentaje*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["meriendas"][$i]->agua_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["meriendas"][$i]->cal_kcal*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["meriendas"][$i]->prot_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["meriendas"][$i]->hc_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["meriendas"][$i]->grasa_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["meriendas"][$i]->satur_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["meriendas"][$i]->mono_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["meriendas"][$i]->poli_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["meriendas"][$i]->col_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["meriendas"][$i]->fibra_g*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["meriendas"][$i]->sodio_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["meriendas"][$i]->potasio_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["meriendas"][$i]->magnesio_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["meriendas"][$i]->calcio_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["meriendas"][$i]->fosf_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["meriendas"][$i]->hierro_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["meriendas"][$i]->cloro_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["meriendas"][$i]->cinc_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["meriendas"][$i]->cobre_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["meriendas"][$i]->manganeso_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["meriendas"][$i]->cromo_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["meriendas"][$i]->cobalto_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["meriendas"][$i]->molibde_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["meriendas"][$i]->yodo_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["meriendas"][$i]->fluor_mg*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["meriendas"][$i]->butirico_c4_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["meriendas"][$i]->caproico_c6_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["meriendas"][$i]->caprilico_c8_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["meriendas"][$i]->caprico_c10_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["meriendas"][$i]->laurico_c12_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["meriendas"][$i]->miristico_c14_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["meriendas"][$i]->c15_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["meriendas"][$i]->c15_00*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["meriendas"][$i]->palmitico_c16_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["meriendas"][$i]->c17_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["meriendas"][$i]->c17_00*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["meriendas"][$i]->estearico_c18_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["meriendas"][$i]->araquidi_c20_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["meriendas"][$i]->behenico_c22_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["meriendas"][$i]->miristol_c14_1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["meriendas"][$i]->palmitole_c16_1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["meriendas"][$i]->oleico_c18_1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["meriendas"][$i]->eicoseno_c20_1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["meriendas"][$i]->c22_1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["meriendas"][$i]->linoleico_c18_2*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["meriendas"][$i]->linoleni_c18_3*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["meriendas"][$i]->c18_4*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["meriendas"][$i]->ara_ico_c20_4*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["meriendas"][$i]->c20_5*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["meriendas"][$i]->c22_5*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["meriendas"][$i]->c22_6*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["meriendas"][$i]->otrosatur0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["meriendas"][$i]->otroinsat0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["meriendas"][$i]->omega3_0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["meriendas"][$i]->etanol0*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["meriendas"][$i]->vit_a*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["meriendas"][$i]->carotenos*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["meriendas"][$i]->tocoferol*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["meriendas"][$i]->vit_d*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["meriendas"][$i]->vit_b1*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["meriendas"][$i]->vit_b2*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["meriendas"][$i]->vit_b6*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["meriendas"][$i]->niacina*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["meriendas"][$i]->ac_panto*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["meriendas"][$i]->biotina*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["meriendas"][$i]->folico*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["meriendas"][$i]->b12*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["meriendas"][$i]->vit_c*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["meriendas"][$i]->purinas*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["meriendas"][$i]->vit_k*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["meriendas"][$i]->vit_e*$_SESSION["meriendas"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["meriendas"][$i]->oxalico*$_SESSION["meriendas"][$i]->peso/100;



         rellenaMatrices($_SESSION["meriendas"][$i]->id_plato, $i, $semana);

        }



  //echo " cenas1 ";

        if ($_SESSION["kcalorias_cena1"] != 0)

        {

         $media_grasas += $_SESSION["cenas1"][$i]->grasa;

         $media_hidratos += $_SESSION["cenas1"][$i]->hidratos;

         $media_proteinas += $_SESSION["cenas1"][$i]->proteinas;



   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["cenas1"][$i]->pc_porcentaje*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["cenas1"][$i]->agua_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["cenas1"][$i]->cal_kcal*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["cenas1"][$i]->prot_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["cenas1"][$i]->hc_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["cenas1"][$i]->grasa_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["cenas1"][$i]->satur_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["cenas1"][$i]->mono_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["cenas1"][$i]->poli_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["cenas1"][$i]->col_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["cenas1"][$i]->fibra_g*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["cenas1"][$i]->sodio_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["cenas1"][$i]->potasio_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["cenas1"][$i]->magnesio_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["cenas1"][$i]->calcio_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["cenas1"][$i]->fosf_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["cenas1"][$i]->hierro_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["cenas1"][$i]->cloro_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["cenas1"][$i]->cinc_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["cenas1"][$i]->cobre_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["cenas1"][$i]->manganeso_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["cenas1"][$i]->cromo_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["cenas1"][$i]->cobalto_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["cenas1"][$i]->molibde_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["cenas1"][$i]->yodo_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["cenas1"][$i]->fluor_mg*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["cenas1"][$i]->butirico_c4_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["cenas1"][$i]->caproico_c6_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["cenas1"][$i]->caprilico_c8_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["cenas1"][$i]->caprico_c10_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["cenas1"][$i]->laurico_c12_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["cenas1"][$i]->miristico_c14_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["cenas1"][$i]->c15_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["cenas1"][$i]->c15_00*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["cenas1"][$i]->palmitico_c16_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["cenas1"][$i]->c17_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["cenas1"][$i]->c17_00*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["cenas1"][$i]->estearico_c18_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["cenas1"][$i]->araquidi_c20_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["cenas1"][$i]->behenico_c22_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["cenas1"][$i]->miristol_c14_1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["cenas1"][$i]->palmitole_c16_1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["cenas1"][$i]->oleico_c18_1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["cenas1"][$i]->eicoseno_c20_1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["cenas1"][$i]->c22_1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["cenas1"][$i]->linoleico_c18_2*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["cenas1"][$i]->linoleni_c18_3*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["cenas1"][$i]->c18_4*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["cenas1"][$i]->ara_ico_c20_4*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["cenas1"][$i]->c20_5*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["cenas1"][$i]->c22_5*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["cenas1"][$i]->c22_6*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["cenas1"][$i]->otrosatur0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["cenas1"][$i]->otroinsat0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["cenas1"][$i]->omega3_0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["cenas1"][$i]->etanol0*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["cenas1"][$i]->vit_a*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["cenas1"][$i]->carotenos*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["cenas1"][$i]->tocoferol*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["cenas1"][$i]->vit_d*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["cenas1"][$i]->vit_b1*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["cenas1"][$i]->vit_b2*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["cenas1"][$i]->vit_b6*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["cenas1"][$i]->niacina*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["cenas1"][$i]->ac_panto*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["cenas1"][$i]->biotina*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["cenas1"][$i]->folico*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["cenas1"][$i]->b12*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["cenas1"][$i]->vit_c*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["cenas1"][$i]->purinas*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["cenas1"][$i]->vit_k*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["cenas1"][$i]->vit_e*$_SESSION["cenas1"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["cenas1"][$i]->oxalico*$_SESSION["cenas1"][$i]->peso/100;



         rellenaMatrices($_SESSION["cenas1"][$i]->id_plato, $i, $semana);

        }



  //echo " cenas ";

        $media_grasas += $_SESSION["cenas"][$i]->grasa;

        $media_hidratos += $_SESSION["cenas"][$i]->hidratos;

        $media_proteinas += $_SESSION["cenas"][$i]->proteinas;



  $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["cenas"][$i]->pc_porcentaje*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_agua_g"][$i] += $_SESSION["cenas"][$i]->agua_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cal_kcal"][$i] += $_SESSION["cenas"][$i]->cal_kcal*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_prot_g"][$i] += $_SESSION["cenas"][$i]->prot_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_hc_g"][$i] += $_SESSION["cenas"][$i]->hc_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_grasa_g"][$i] += $_SESSION["cenas"][$i]->grasa_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_satur_g"][$i] += $_SESSION["cenas"][$i]->satur_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_mono_g"][$i] += $_SESSION["cenas"][$i]->mono_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_poli_g"][$i] += $_SESSION["cenas"][$i]->poli_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_col_mg"][$i] += $_SESSION["cenas"][$i]->col_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_fibra_g"][$i] += $_SESSION["cenas"][$i]->fibra_g*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_sodio_mg"][$i] += $_SESSION["cenas"][$i]->sodio_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_potasio_mg"][$i] += $_SESSION["cenas"][$i]->potasio_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_magnesio_mg"][$i] += $_SESSION["cenas"][$i]->magnesio_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_calcio_mg"][$i] += $_SESSION["cenas"][$i]->calcio_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_fosf_mg"][$i] += $_SESSION["cenas"][$i]->fosf_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_hierro_mg"][$i] += $_SESSION["cenas"][$i]->hierro_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cloro_mg"][$i] += $_SESSION["cenas"][$i]->cloro_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cinc_mg"][$i] += $_SESSION["cenas"][$i]->cinc_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cobre_mg"][$i] += $_SESSION["cenas"][$i]->cobre_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_manganeso_mg"][$i] += $_SESSION["cenas"][$i]->manganeso_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cromo_mg"][$i] += $_SESSION["cenas"][$i]->cromo_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_cobalto_mg"][$i] += $_SESSION["cenas"][$i]->cobalto_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_molibde_mg"][$i] += $_SESSION["cenas"][$i]->molibde_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_yodo_mg"][$i] += $_SESSION["cenas"][$i]->yodo_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_fluor_mg"][$i] += $_SESSION["cenas"][$i]->fluor_mg*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["cenas"][$i]->butirico_c4_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["cenas"][$i]->caproico_c6_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["cenas"][$i]->caprilico_c8_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["cenas"][$i]->caprico_c10_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["cenas"][$i]->laurico_c12_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["cenas"][$i]->miristico_c14_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c15_0"][$i] += $_SESSION["cenas"][$i]->c15_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c15_00"][$i] += $_SESSION["cenas"][$i]->c15_00*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["cenas"][$i]->palmitico_c16_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c17_0"][$i] += $_SESSION["cenas"][$i]->c17_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c17_00"][$i] += $_SESSION["cenas"][$i]->c17_00*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["cenas"][$i]->estearico_c18_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["cenas"][$i]->araquidi_c20_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["cenas"][$i]->behenico_c22_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["cenas"][$i]->miristol_c14_1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["cenas"][$i]->palmitole_c16_1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["cenas"][$i]->oleico_c18_1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["cenas"][$i]->eicoseno_c20_1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c22_1"][$i] += $_SESSION["cenas"][$i]->c22_1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["cenas"][$i]->linoleico_c18_2*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["cenas"][$i]->linoleni_c18_3*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c18_4"][$i] += $_SESSION["cenas"][$i]->c18_4*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["cenas"][$i]->ara_ico_c20_4*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c20_5"][$i] += $_SESSION["cenas"][$i]->c20_5*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c22_5"][$i] += $_SESSION["cenas"][$i]->c22_5*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_c22_6"][$i] += $_SESSION["cenas"][$i]->c22_6*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_otrosatur0"][$i] += $_SESSION["cenas"][$i]->otrosatur0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_otroinsat0"][$i] += $_SESSION["cenas"][$i]->otroinsat0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_omega3_0"][$i] += $_SESSION["cenas"][$i]->omega3_0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_etanol0"][$i] += $_SESSION["cenas"][$i]->etanol0*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_a"][$i] += $_SESSION["cenas"][$i]->vit_a*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_carotenos"][$i] += $_SESSION["cenas"][$i]->carotenos*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_tocoferol"][$i] += $_SESSION["cenas"][$i]->tocoferol*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_d"][$i] += $_SESSION["cenas"][$i]->vit_d*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_b1"][$i] += $_SESSION["cenas"][$i]->vit_b1*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_b2"][$i] += $_SESSION["cenas"][$i]->vit_b2*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_b6"][$i] += $_SESSION["cenas"][$i]->vit_b6*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_niacina"][$i] += $_SESSION["cenas"][$i]->niacina*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_ac_panto"][$i] += $_SESSION["cenas"][$i]->ac_panto*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_biotina"][$i] += $_SESSION["cenas"][$i]->biotina*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_folico"][$i] += $_SESSION["cenas"][$i]->folico*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_b12"][$i] += $_SESSION["cenas"][$i]->b12*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_c"][$i] += $_SESSION["cenas"][$i]->vit_c*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_purinas"][$i] += $_SESSION["cenas"][$i]->purinas*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_k"][$i] += $_SESSION["cenas"][$i]->vit_k*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_vit_e"][$i] += $_SESSION["cenas"][$i]->vit_e*$_SESSION["cenas"][$i]->peso/100;

  $_SESSION["media_oxalico"][$i] += $_SESSION["cenas"][$i]->oxalico*$_SESSION["cenas"][$i]->peso/100;



  rellenaMatrices($_SESSION["cenas"][$i]->id_plato, $i, $semana);



  //echo " postres_cena ";

        if ($_SESSION["kcalorias_cena_postre"] != 0)

        {

         $media_grasas += $_SESSION["postres_cena"][$i]->grasa;

         $media_hidratos += $_SESSION["postres_cena"][$i]->hidratos;

         $media_proteinas += $_SESSION["postres_cena"][$i]->proteinas;



   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["postres_cena"][$i]->pc_porcentaje*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["postres_cena"][$i]->agua_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["postres_cena"][$i]->cal_kcal*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["postres_cena"][$i]->prot_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["postres_cena"][$i]->hc_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["postres_cena"][$i]->grasa_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["postres_cena"][$i]->satur_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["postres_cena"][$i]->mono_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["postres_cena"][$i]->poli_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["postres_cena"][$i]->col_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["postres_cena"][$i]->fibra_g*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["postres_cena"][$i]->sodio_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["postres_cena"][$i]->potasio_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["postres_cena"][$i]->magnesio_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["postres_cena"][$i]->calcio_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["postres_cena"][$i]->fosf_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["postres_cena"][$i]->hierro_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["postres_cena"][$i]->cloro_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["postres_cena"][$i]->cinc_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["postres_cena"][$i]->cobre_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["postres_cena"][$i]->manganeso_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["postres_cena"][$i]->cromo_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["postres_cena"][$i]->cobalto_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["postres_cena"][$i]->molibde_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["postres_cena"][$i]->yodo_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["postres_cena"][$i]->fluor_mg*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["postres_cena"][$i]->butirico_c4_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["postres_cena"][$i]->caproico_c6_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["postres_cena"][$i]->caprilico_c8_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["postres_cena"][$i]->caprico_c10_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["postres_cena"][$i]->laurico_c12_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["postres_cena"][$i]->miristico_c14_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["postres_cena"][$i]->c15_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["postres_cena"][$i]->c15_00*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["postres_cena"][$i]->palmitico_c16_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["postres_cena"][$i]->c17_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["postres_cena"][$i]->c17_00*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["postres_cena"][$i]->estearico_c18_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["postres_cena"][$i]->araquidi_c20_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["postres_cena"][$i]->behenico_c22_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["postres_cena"][$i]->miristol_c14_1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["postres_cena"][$i]->palmitole_c16_1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["postres_cena"][$i]->oleico_c18_1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["postres_cena"][$i]->eicoseno_c20_1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["postres_cena"][$i]->c22_1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["postres_cena"][$i]->linoleico_c18_2*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["postres_cena"][$i]->linoleni_c18_3*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["postres_cena"][$i]->c18_4*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["postres_cena"][$i]->ara_ico_c20_4*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["postres_cena"][$i]->c20_5*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["postres_cena"][$i]->c22_5*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["postres_cena"][$i]->c22_6*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["postres_cena"][$i]->otrosatur0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["postres_cena"][$i]->otroinsat0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["postres_cena"][$i]->omega3_0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["postres_cena"][$i]->etanol0*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["postres_cena"][$i]->vit_a*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["postres_cena"][$i]->carotenos*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["postres_cena"][$i]->tocoferol*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["postres_cena"][$i]->vit_d*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["postres_cena"][$i]->vit_b1*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["postres_cena"][$i]->vit_b2*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["postres_cena"][$i]->vit_b6*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["postres_cena"][$i]->niacina*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["postres_cena"][$i]->ac_panto*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["postres_cena"][$i]->biotina*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["postres_cena"][$i]->folico*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["postres_cena"][$i]->b12*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["postres_cena"][$i]->vit_c*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["postres_cena"][$i]->purinas*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["postres_cena"][$i]->vit_k*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["postres_cena"][$i]->vit_e*$_SESSION["postres_cena"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["postres_cena"][$i]->oxalico*$_SESSION["postres_cena"][$i]->peso/100;



         rellenaMatrices($_SESSION["postres_cena"][$i]->id_plato, $i, $semana);

        }



  //echo " recenas ";

        if ($_SESSION["kcalorias_recena"] != 0)

        {

         $media_grasas += $_SESSION["recenas"][$i]->grasa;

         $media_hidratos += $_SESSION["recenas"][$i]->hidratos;

         $media_proteinas += $_SESSION["recenas"][$i]->proteinas;



   $_SESSION["media_pc_porcentaje"][$i] += $_SESSION["recenas"][$i]->pc_porcentaje*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_agua_g"][$i] += $_SESSION["recenas"][$i]->agua_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cal_kcal"][$i] += $_SESSION["recenas"][$i]->cal_kcal*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_prot_g"][$i] += $_SESSION["recenas"][$i]->prot_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_hc_g"][$i] += $_SESSION["recenas"][$i]->hc_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_grasa_g"][$i] += $_SESSION["recenas"][$i]->grasa_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_satur_g"][$i] += $_SESSION["recenas"][$i]->satur_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_mono_g"][$i] += $_SESSION["recenas"][$i]->mono_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_poli_g"][$i] += $_SESSION["recenas"][$i]->poli_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_col_mg"][$i] += $_SESSION["recenas"][$i]->col_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_fibra_g"][$i] += $_SESSION["recenas"][$i]->fibra_g*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_sodio_mg"][$i] += $_SESSION["recenas"][$i]->sodio_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_potasio_mg"][$i] += $_SESSION["recenas"][$i]->potasio_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_magnesio_mg"][$i] += $_SESSION["recenas"][$i]->magnesio_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_calcio_mg"][$i] += $_SESSION["recenas"][$i]->calcio_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_fosf_mg"][$i] += $_SESSION["recenas"][$i]->fosf_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_hierro_mg"][$i] += $_SESSION["recenas"][$i]->hierro_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cloro_mg"][$i] += $_SESSION["recenas"][$i]->cloro_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cinc_mg"][$i] += $_SESSION["recenas"][$i]->cinc_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cobre_mg"][$i] += $_SESSION["recenas"][$i]->cobre_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_manganeso_mg"][$i] += $_SESSION["recenas"][$i]->manganeso_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cromo_mg"][$i] += $_SESSION["recenas"][$i]->cromo_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_cobalto_mg"][$i] += $_SESSION["recenas"][$i]->cobalto_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_molibde_mg"][$i] += $_SESSION["recenas"][$i]->molibde_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_yodo_mg"][$i] += $_SESSION["recenas"][$i]->yodo_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_fluor_mg"][$i] += $_SESSION["recenas"][$i]->fluor_mg*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_butirico_c4_0"][$i] += $_SESSION["recenas"][$i]->butirico_c4_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_caproico_c6_0"][$i] += $_SESSION["recenas"][$i]->caproico_c6_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_caprilico_c8_0"][$i] += $_SESSION["recenas"][$i]->caprilico_c8_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_caprico_c10_0"][$i] += $_SESSION["recenas"][$i]->caprico_c10_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_laurico_c12_0"][$i] += $_SESSION["recenas"][$i]->laurico_c12_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_miristico_c14_0"][$i] += $_SESSION["recenas"][$i]->miristico_c14_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c15_0"][$i] += $_SESSION["recenas"][$i]->c15_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c15_00"][$i] += $_SESSION["recenas"][$i]->c15_00*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_palmitico_c16_0"][$i] += $_SESSION["recenas"][$i]->palmitico_c16_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c17_0"][$i] += $_SESSION["recenas"][$i]->c17_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c17_00"][$i] += $_SESSION["recenas"][$i]->c17_00*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_estearico_c18_0"][$i] += $_SESSION["recenas"][$i]->estearico_c18_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_araquidi_c20_0"][$i] += $_SESSION["recenas"][$i]->araquidi_c20_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_behenico_c22_0"][$i] += $_SESSION["recenas"][$i]->behenico_c22_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_miristol_c14_1"][$i] += $_SESSION["recenas"][$i]->miristol_c14_1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_palmitole_c16_1"][$i] += $_SESSION["recenas"][$i]->palmitole_c16_1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_oleico_c18_1"][$i] += $_SESSION["recenas"][$i]->oleico_c18_1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_eicoseno_c20_1"][$i] += $_SESSION["recenas"][$i]->eicoseno_c20_1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c22_1"][$i] += $_SESSION["recenas"][$i]->c22_1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_linoleico_c18_2"][$i] += $_SESSION["recenas"][$i]->linoleico_c18_2*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_linoleni_c18_3"][$i] += $_SESSION["recenas"][$i]->linoleni_c18_3*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c18_4"][$i] += $_SESSION["recenas"][$i]->c18_4*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_ara_ico_c20_4"][$i] += $_SESSION["recenas"][$i]->ara_ico_c20_4*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c20_5"][$i] += $_SESSION["recenas"][$i]->c20_5*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c22_5"][$i] += $_SESSION["recenas"][$i]->c22_5*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_c22_6"][$i] += $_SESSION["recenas"][$i]->c22_6*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_otrosatur0"][$i] += $_SESSION["recenas"][$i]->otrosatur0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_otroinsat0"][$i] += $_SESSION["recenas"][$i]->otroinsat0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_omega3_0"][$i] += $_SESSION["recenas"][$i]->omega3_0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_etanol0"][$i] += $_SESSION["recenas"][$i]->etanol0*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_a"][$i] += $_SESSION["recenas"][$i]->vit_a*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_carotenos"][$i] += $_SESSION["recenas"][$i]->carotenos*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_tocoferol"][$i] += $_SESSION["recenas"][$i]->tocoferol*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_d"][$i] += $_SESSION["recenas"][$i]->vit_d*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_b1"][$i] += $_SESSION["recenas"][$i]->vit_b1*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_b2"][$i] += $_SESSION["recenas"][$i]->vit_b2*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_b6"][$i] += $_SESSION["recenas"][$i]->vit_b6*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_niacina"][$i] += $_SESSION["recenas"][$i]->niacina*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_ac_panto"][$i] += $_SESSION["recenas"][$i]->ac_panto*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_biotina"][$i] += $_SESSION["recenas"][$i]->biotina*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_folico"][$i] += $_SESSION["recenas"][$i]->folico*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_b12"][$i] += $_SESSION["recenas"][$i]->b12*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_c"][$i] += $_SESSION["recenas"][$i]->vit_c*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_purinas"][$i] += $_SESSION["recenas"][$i]->purinas*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_k"][$i] += $_SESSION["recenas"][$i]->vit_k*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_vit_e"][$i] += $_SESSION["recenas"][$i]->vit_e*$_SESSION["recenas"][$i]->peso/100;

   $_SESSION["media_oxalico"][$i] += $_SESSION["recenas"][$i]->oxalico*$_SESSION["recenas"][$i]->peso/100;

   

         rellenaMatrices($_SESSION["recenas"][$i]->id_plato, $i, $semana);

        }



        $media_calorias += $_SESSION["suma_kcal"][$i];

  

  $j = $_SESSION["num_dias"];

  $_SESSION["media_pc_porcentaje"][$j] += $_SESSION["media_pc_porcentaje"][$i];

  $_SESSION["media_agua_g"][$j] += $_SESSION["media_agua_g"][$i];

  $_SESSION["media_cal_kcal"][$j] += $_SESSION["media_cal_kcal"][$i];

  $_SESSION["media_prot_g"][$j] += $_SESSION["media_prot_g"][$i];

  $_SESSION["media_hc_g"][$j] += $_SESSION["media_hc_g"][$i];

  $_SESSION["media_grasa_g"][$j] += $_SESSION["media_grasa_g"][$i];

  $_SESSION["media_satur_g"][$j] += $_SESSION["media_satur_g"][$i];

  $_SESSION["media_mono_g"][$j] += $_SESSION["media_mono_g"][$i];

  $_SESSION["media_poli_g"][$j] += $_SESSION["media_poli_g"][$i];

  $_SESSION["media_col_mg"][$j] += $_SESSION["media_col_mg"][$i];

  $_SESSION["media_fibra_g"][$j] += $_SESSION["media_fibra_g"][$i];

  $_SESSION["media_sodio_mg"][$j] += $_SESSION["media_sodio_mg"][$i];

  $_SESSION["media_potasio_mg"][$j] += $_SESSION["media_potasio_mg"][$i];

  $_SESSION["media_magnesio_mg"][$j] += $_SESSION["media_magnesio_mg"][$i];

  $_SESSION["media_calcio_mg"][$j] += $_SESSION["media_calcio_mg"][$i];

  $_SESSION["media_fosf_mg"][$j] += $_SESSION["media_fosf_mg"][$i];

  $_SESSION["media_hierro_mg"][$j] += $_SESSION["media_hierro_mg"][$i];

  $_SESSION["media_cloro_mg"][$j] += $_SESSION["media_cloro_mg"][$i];

  $_SESSION["media_cinc_mg"][$j] += $_SESSION["media_cinc_mg"][$i];

  $_SESSION["media_cobre_mg"][$j] += $_SESSION["media_cobre_mg"][$i];

  $_SESSION["media_manganeso_mg"][$j] += $_SESSION["media_manganeso_mg"][$i];

  $_SESSION["media_cromo_mg"][$j] += $_SESSION["media_cromo_mg"][$i];

  $_SESSION["media_cobalto_mg"][$j] += $_SESSION["media_cobalto_mg"][$i];

  $_SESSION["media_molibde_mg"][$j] += $_SESSION["media_molibde_mg"][$i];

  $_SESSION["media_yodo_mg"][$j] += $_SESSION["media_yodo_mg"][$i];

  $_SESSION["media_fluor_mg"][$j] += $_SESSION["media_fluor_mg"][$i];

  $_SESSION["media_butirico_c4_0"][$j] += $_SESSION["media_butirico_c4_0"][$i];

  $_SESSION["media_caproico_c6_0"][$j] += $_SESSION["media_caproico_c6_0"][$i];

  $_SESSION["media_caprilico_c8_0"][$j] += $_SESSION["media_caprilico_c8_0"][$i];

  $_SESSION["media_caprico_c10_0"][$j] += $_SESSION["media_caprico_c10_0"][$i];

  $_SESSION["media_laurico_c12_0"][$j] += $_SESSION["media_laurico_c12_0"][$i];

  $_SESSION["media_miristico_c14_0"][$j] += $_SESSION["media_miristico_c14_0"][$i];

  $_SESSION["media_c15_0"][$j] += $_SESSION["media_c15_0"][$i];

  $_SESSION["media_c15_00"][$j] += $_SESSION["media_c15_00"][$i];

  $_SESSION["media_palmitico_c16_0"][$j] += $_SESSION["media_palmitico_c16_0"][$i];

  $_SESSION["media_c17_0"][$j] += $_SESSION["media_c17_0"][$i];

  $_SESSION["media_c17_00"][$j] += $_SESSION["media_c17_00"][$i];

  $_SESSION["media_estearico_c18_0"][$j] += $_SESSION["media_estearico_c18_0"][$i];

  $_SESSION["media_araquidi_c20_0"][$j] += $_SESSION["media_araquidi_c20_0"][$i];

  $_SESSION["media_behenico_c22_0"][$j] += $_SESSION["media_behenico_c22_0"][$i];

  $_SESSION["media_miristol_c14_1"][$j] += $_SESSION["media_miristol_c14_1"][$i];

  $_SESSION["media_palmitole_c16_1"][$j] += $_SESSION["media_palmitole_c16_1"][$i];

  $_SESSION["media_oleico_c18_1"][$j] += $_SESSION["media_oleico_c18_1"][$i];

  $_SESSION["media_eicoseno_c20_1"][$j] += $_SESSION["media_eicoseno_c20_1"][$i];

  $_SESSION["media_c22_1"][$j] += $_SESSION["media_c22_1"][$i];

  $_SESSION["media_linoleico_c18_2"][$j] += $_SESSION["media_linoleico_c18_2"][$i];

  $_SESSION["media_linoleni_c18_3"][$j] += $_SESSION["media_linoleni_c18_3"][$i];

  $_SESSION["media_c18_4"][$j] += $_SESSION["media_c18_4"][$i];

  $_SESSION["media_ara_ico_c20_4"][$j] += $_SESSION["media_ara_ico_c20_4"][$i];

  $_SESSION["media_c20_5"][$j] += $_SESSION["media_c20_5"][$i];

  $_SESSION["media_c22_5"][$j] += $_SESSION["media_c22_5"][$i];

  $_SESSION["media_c22_6"][$j] += $_SESSION["media_c22_6"][$i];

  $_SESSION["media_otrosatur0"][$j] += $_SESSION["media_otrosatur0"][$i];

  $_SESSION["media_otroinsat0"][$j] += $_SESSION["media_otroinsat0"][$i];

  $_SESSION["media_omega3_0"][$j] += $_SESSION["media_omega3_0"][$i];

  $_SESSION["media_etanol0"][$j] += $_SESSION["media_etanol0"][$i];

  $_SESSION["media_vit_a"][$j] += $_SESSION["media_vit_a"][$i];

  $_SESSION["media_carotenos"][$j] += $_SESSION["media_carotenos"][$i];

  $_SESSION["media_tocoferol"][$j] += $_SESSION["media_tocoferol"][$i];

  $_SESSION["media_vit_d"][$j] += $_SESSION["media_vit_d"][$i];

  $_SESSION["media_vit_b1"][$j] += $_SESSION["media_vit_b1"][$i];

  $_SESSION["media_vit_b2"][$j] += $_SESSION["media_vit_b2"][$i];

  $_SESSION["media_vit_b6"][$j] += $_SESSION["media_vit_b6"][$i];

  $_SESSION["media_niacina"][$j] += $_SESSION["media_niacina"][$i];

  $_SESSION["media_ac_panto"][$j] += $_SESSION["media_ac_panto"][$i];

  $_SESSION["media_biotina"][$j] += $_SESSION["media_biotina"][$i];

  $_SESSION["media_folico"][$j] += $_SESSION["media_folico"][$i];

  $_SESSION["media_b12"][$j] += $_SESSION["media_b12"][$i];

  $_SESSION["media_vit_c"][$j] += $_SESSION["media_vit_c"][$i];

  $_SESSION["media_purinas"][$j] += $_SESSION["media_purinas"][$i];

  $_SESSION["media_vit_k"][$j] += $_SESSION["media_vit_k"][$i];

  $_SESSION["media_vit_e"][$j] += $_SESSION["media_vit_e"][$i];

  $_SESSION["media_oxalico"][$j] += $_SESSION["media_oxalico"][$i];

    }



    // Calculamos las estadisticas con Comidas y Cenas

    $media_proteinas = round($media_proteinas / ($_SESSION["num_dias"] * $platos_porDia), 1);

    $media_hidratos = round($media_hidratos / ($_SESSION["num_dias"] * $platos_porDia), 1);

    $media_grasas = round($media_grasas / ($_SESSION["num_dias"] * $platos_porDia), 1);

    $media_calorias = round($media_calorias / $_SESSION["num_dias"], 1);





    $acierto_grasas = (100 - abs($media_grasas - $_SESSION["porcentaje_grasas"]));

    $acierto_proteinas = (100 - abs($media_proteinas - $_SESSION["porcentaje_proteinas"]));

    $acierto_hidratos = (100 - abs($media_hidratos - $_SESSION["porcentaje_hidratos"]));

    $acierto_calorias = round(100 - ((abs($media_calorias - $_SESSION["kcalorias"]) / $_SESSION["kcalorias"] ) * 100), 1);



 



 $_SESSION["labelAciertoProteinas"] = $media_proteinas . "% (". $acierto_proteinas . "% acierto)";

    $_SESSION["labelAciertoHidratos"] = $media_hidratos . "% (". $acierto_hidratos . "% acierto)"; 

    $_SESSION["labelAciertoGrasas"] = $media_grasas . "% (". $acierto_grasas . "% acierto)";

    $_SESSION["labelAciertoCalorias"] = $media_calorias . " (". $acierto_calorias . "% acierto)";

    $_SESSION["labelAciertoGeneral"] = round( ($acierto_calorias + $acierto_grasas + $acierto_hidratos + $acierto_proteinas) / 4) . " %";

    


 

 $_SESSION["media_pc_porcentaje"][$_SESSION["num_dias"]] = $_SESSION["media_pc_porcentaje"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_agua_g"][$_SESSION["num_dias"]] = $_SESSION["media_agua_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cal_kcal"][$_SESSION["num_dias"]] = $_SESSION["media_cal_kcal"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_prot_g"][$_SESSION["num_dias"]] = $_SESSION["media_prot_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_hc_g"][$_SESSION["num_dias"]] = $_SESSION["media_hc_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_grasa_g"][$_SESSION["num_dias"]] = $_SESSION["media_grasa_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_satur_g"][$_SESSION["num_dias"]] = $_SESSION["media_satur_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_mono_g"][$_SESSION["num_dias"]] = $_SESSION["media_mono_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_poli_g"][$_SESSION["num_dias"]] = $_SESSION["media_poli_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_col_mg"][$_SESSION["num_dias"]] = $_SESSION["media_col_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_fibra_g"][$_SESSION["num_dias"]] = $_SESSION["media_fibra_g"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_sodio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_sodio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_potasio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_potasio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_magnesio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_magnesio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_calcio_mg"][$_SESSION["num_dias"]] = $_SESSION["media_calcio_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_fosf_mg"][$_SESSION["num_dias"]] = $_SESSION["media_fosf_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_hierro_mg"][$_SESSION["num_dias"]] = $_SESSION["media_hierro_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cloro_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cloro_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cinc_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cinc_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cobre_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cobre_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_manganeso_mg"][$_SESSION["num_dias"]] = $_SESSION["media_manganeso_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cromo_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cromo_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_cobalto_mg"][$_SESSION["num_dias"]] = $_SESSION["media_cobalto_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_molibde_mg"][$_SESSION["num_dias"]] = $_SESSION["media_molibde_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_yodo_mg"][$_SESSION["num_dias"]] = $_SESSION["media_yodo_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_fluor_mg"][$_SESSION["num_dias"]] = $_SESSION["media_fluor_mg"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_butirico_c4_0"][$_SESSION["num_dias"]] = $_SESSION["media_butirico_c4_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_caproico_c6_0"][$_SESSION["num_dias"]] = $_SESSION["media_caproico_c6_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_caprilico_c8_0"][$_SESSION["num_dias"]] = $_SESSION["media_caprilico_c8_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_caprico_c10_0"][$_SESSION["num_dias"]] = $_SESSION["media_caprico_c10_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_laurico_c12_0"][$_SESSION["num_dias"]] = $_SESSION["media_laurico_c12_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_miristico_c14_0"][$_SESSION["num_dias"]] = $_SESSION["media_miristico_c14_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c15_0"][$_SESSION["num_dias"]] = $_SESSION["media_c15_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c15_00"][$_SESSION["num_dias"]] = $_SESSION["media_c15_00"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_palmitico_c16_0"][$_SESSION["num_dias"]] = $_SESSION["media_palmitico_c16_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c17_0"][$_SESSION["num_dias"]] = $_SESSION["media_c17_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c17_00"][$_SESSION["num_dias"]] = $_SESSION["media_c17_00"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_estearico_c18_0"][$_SESSION["num_dias"]] = $_SESSION["media_estearico_c18_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_araquidi_c20_0"][$_SESSION["num_dias"]] = $_SESSION["media_araquidi_c20_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_behenico_c22_0"][$_SESSION["num_dias"]] = $_SESSION["media_behenico_c22_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_miristol_c14_1"][$_SESSION["num_dias"]] = $_SESSION["media_miristol_c14_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_palmitole_c16_1"][$_SESSION["num_dias"]] = $_SESSION["media_palmitole_c16_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_oleico_c18_1"][$_SESSION["num_dias"]] = $_SESSION["media_oleico_c18_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_eicoseno_c20_1"][$_SESSION["num_dias"]] = $_SESSION["media_eicoseno_c20_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c22_1"][$_SESSION["num_dias"]] = $_SESSION["media_c22_1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_linoleico_c18_2"][$_SESSION["num_dias"]] = $_SESSION["media_linoleico_c18_2"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_linoleni_c18_3"][$_SESSION["num_dias"]] = $_SESSION["media_linoleni_c18_3"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c18_4"][$_SESSION["num_dias"]] = $_SESSION["media_c18_4"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_ara_ico_c20_4"][$_SESSION["num_dias"]] = $_SESSION["media_ara_ico_c20_4"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c20_5"][$_SESSION["num_dias"]] = $_SESSION["media_c20_5"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c22_5"][$_SESSION["num_dias"]] = $_SESSION["media_c22_5"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_c22_6"][$_SESSION["num_dias"]] = $_SESSION["media_c22_6"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_otrosatur0"][$_SESSION["num_dias"]] = $_SESSION["media_otrosatur0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_otroinsat0"][$_SESSION["num_dias"]] = $_SESSION["media_otroinsat0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_omega3_0"][$_SESSION["num_dias"]] = $_SESSION["media_omega3_0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_etanol0"][$_SESSION["num_dias"]] = $_SESSION["media_etanol0"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_a"][$_SESSION["num_dias"]] = $_SESSION["media_vit_a"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_carotenos"][$_SESSION["num_dias"]] = $_SESSION["media_carotenos"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_tocoferol"][$_SESSION["num_dias"]] = $_SESSION["media_tocoferol"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_d"][$_SESSION["num_dias"]] = $_SESSION["media_vit_d"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_b1"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b1"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_b2"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b2"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_b6"][$_SESSION["num_dias"]] = $_SESSION["media_vit_b6"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_niacina"][$_SESSION["num_dias"]] = $_SESSION["media_niacina"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_ac_panto"][$_SESSION["num_dias"]] = $_SESSION["media_ac_panto"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_biotina"][$_SESSION["num_dias"]] = $_SESSION["media_biotina"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_folico"][$_SESSION["num_dias"]] = $_SESSION["media_folico"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_b12"][$_SESSION["num_dias"]] = $_SESSION["media_b12"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_c"][$_SESSION["num_dias"]] = $_SESSION["media_vit_c"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_purinas"][$_SESSION["num_dias"]] = $_SESSION["media_purinas"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_k"][$_SESSION["num_dias"]] = $_SESSION["media_vit_k"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_vit_e"][$_SESSION["num_dias"]] = $_SESSION["media_vit_e"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 $_SESSION["media_oxalico"][$_SESSION["num_dias"]] = $_SESSION["media_oxalico"][$_SESSION["num_dias"]]/$_SESSION["num_dias"];

 

 calculaPiramide();

 */

}


function crearMatrices(){
 
 //$num_grupos = count($_SESSION["dictGruposAlimentos"]);
 
 //Creamos un array por cada grupo y por cada semana
 $grupo_dia = [];
 $grupo_semana = [];
 
 /*

 $_SESSION["grupo_dia"] = [];
 $_SESSION["grupo_semana"] = [];
 */


 //no entiendo para hace este recorrido para asignarle 0 a todo
 /*
 for ($i = 0; $i < $num_grupos; $i++)

 {

  for ($j = 0; $j < $_SESSION["num_dias"]; $j++)

  {

   $_SESSION["grupo_dia"][$i][$j] = 0;

  }

  for ($k = 0; $k < $_SESSION["num_semanas"]; $k++)

  {

   $_SESSION["grupo_semana"][$i][$k] = 0;

  }

 }
 
 

 $_SESSION["media_pc_porcentaje"] = [];

 $_SESSION["media_agua_g"] = [];

 $_SESSION["media_cal_kcal"] = [];

 $_SESSION["media_prot_g"] = [];

 $_SESSION["media_hc_g"] = [];

 $_SESSION["media_grasa_g"] = [];

 $_SESSION["media_satur_g"] = [];

 $_SESSION["media_mono_g"] = [];

 $_SESSION["media_poli_g"] = [];

 $_SESSION["media_col_mg"] = [];

 $_SESSION["media_fibra_g"] = [];

 $_SESSION["media_sodio_mg"] = [];

 $_SESSION["media_potasio_mg"] = [];

 $_SESSION["media_magnesio_mg"] = [];

 $_SESSION["media_calcio_mg"] = [];

 $_SESSION["media_fosf_mg"] = [];

 $_SESSION["media_hierro_mg"] = [];

 $_SESSION["media_cloro_mg"] = [];

 $_SESSION["media_cinc_mg"] = [];

 $_SESSION["media_cobre_mg"] = [];

 $_SESSION["media_manganeso_mg"] = [];

 $_SESSION["media_cromo_mg"] = [];

 $_SESSION["media_cobalto_mg"] = [];

 $_SESSION["media_molibde_mg"] = [];

 $_SESSION["media_yodo_mg"] = [];

 $_SESSION["media_fluor_mg"] = [];

 $_SESSION["media_butirico_c4_0"] = [];

 $_SESSION["media_caproico_c6_0"] = [];

 $_SESSION["media_caprilico_c8_0"] = [];

 $_SESSION["media_caprico_c10_0"] = [];

 $_SESSION["media_laurico_c12_0"] = [];

 $_SESSION["media_miristico_c14_0"] = [];

 $_SESSION["media_c15_0"] = [];

 $_SESSION["media_c15_00"] = [];

 $_SESSION["media_palmitico_c16_0"] = [];

 $_SESSION["media_c17_0"] = [];

 $_SESSION["media_c17_00"] = [];

 $_SESSION["media_estearico_c18_0"] = [];

 $_SESSION["media_araquidi_c20_0"] = [];

 $_SESSION["media_behenico_c22_0"] = [];

 $_SESSION["media_miristol_c14_1"] = [];

 $_SESSION["media_palmitole_c16_1"] = [];

 $_SESSION["media_oleico_c18_1"] = [];

 $_SESSION["media_eicoseno_c20_1"] = [];

 $_SESSION["media_c22_1"] = [];

 $_SESSION["media_linoleico_c18_2"] = [];

 $_SESSION["media_linoleni_c18_3"] = [];

 $_SESSION["media_c18_4"] = [];

 $_SESSION["media_ara_ico_c20_4"] = [];

 $_SESSION["media_c20_5"] = [];

 $_SESSION["media_c22_5"] = [];

 $_SESSION["media_c22_6"] = [];

 $_SESSION["media_otrosatur0"] = [];

 $_SESSION["media_otroinsat0"] = [];

 $_SESSION["media_omega3_0"] = [];

 $_SESSION["media_etanol0"] = [];

 $_SESSION["media_vit_a"] = [];

 $_SESSION["media_carotenos"] = [];

 $_SESSION["media_tocoferol"] = [];

 $_SESSION["media_vit_d"] = [];

 $_SESSION["media_vit_b1"] = [];

 $_SESSION["media_vit_b2"] = [];

 $_SESSION["media_vit_b6"] = [];

 $_SESSION["media_niacina"] = [];

 $_SESSION["media_ac_panto"] = [];

 $_SESSION["media_biotina"] = [];

 $_SESSION["media_folico"] = [];

 $_SESSION["media_b12"] = [];

 $_SESSION["media_vit_c"] = [];

 $_SESSION["media_purinas"] = [];

 $_SESSION["media_vit_k"] = [];

 $_SESSION["media_vit_e"] = [];

 $_SESSION["media_oxalico"] = [];

 

 for ($j = 0; $j < ($_SESSION["num_dias"]+1); $j++)

 {

  $_SESSION["media_pc_porcentaje"][$j] = 0;

  $_SESSION["media_agua_g"][$j] = 0;

  $_SESSION["media_cal_kcal"][$j] = 0;

  $_SESSION["media_prot_g"][$j] = 0;

  $_SESSION["media_hc_g"][$j] = 0;

  $_SESSION["media_grasa_g"][$j] = 0;

  $_SESSION["media_satur_g"][$j] = 0;

  $_SESSION["media_mono_g"][$j] = 0;

  $_SESSION["media_poli_g"][$j] = 0;

  $_SESSION["media_col_mg"][$j] = 0;

  $_SESSION["media_fibra_g"][$j] = 0;

  $_SESSION["media_sodio_mg"][$j] = 0;

  $_SESSION["media_potasio_mg"][$j] = 0;

  $_SESSION["media_magnesio_mg"][$j] = 0;

  $_SESSION["media_calcio_mg"][$j] = 0;

  $_SESSION["media_fosf_mg"][$j] = 0;

  $_SESSION["media_hierro_mg"][$j] = 0;

  $_SESSION["media_cloro_mg"][$j] = 0;

  $_SESSION["media_cinc_mg"][$j] = 0;

  $_SESSION["media_cobre_mg"][$j] = 0;

  $_SESSION["media_manganeso_mg"][$j] = 0;

  $_SESSION["media_cromo_mg"][$j] = 0;

  $_SESSION["media_cobalto_mg"][$j] = 0;

  $_SESSION["media_molibde_mg"][$j] = 0;

  $_SESSION["media_yodo_mg"][$j] = 0;

  $_SESSION["media_fluor_mg"][$j] = 0;

  $_SESSION["media_butirico_c4_0"][$j] = 0;

  $_SESSION["media_caproico_c6_0"][$j] = 0;

  $_SESSION["media_caprilico_c8_0"][$j] = 0;

  $_SESSION["media_caprico_c10_0"][$j] = 0;

  $_SESSION["media_laurico_c12_0"][$j] = 0;

  $_SESSION["media_miristico_c14_0"][$j] = 0;

  $_SESSION["media_c15_0"][$j] = 0;

  $_SESSION["media_c15_00"][$j] = 0;

  $_SESSION["media_palmitico_c16_0"][$j] = 0;

  $_SESSION["media_c17_0"][$j] = 0;

  $_SESSION["media_c17_00"][$j] = 0;

  $_SESSION["media_estearico_c18_0"][$j] = 0;

  $_SESSION["media_araquidi_c20_0"][$j] = 0;

  $_SESSION["media_behenico_c22_0"][$j] = 0;

  $_SESSION["media_miristol_c14_1"][$j] = 0;

  $_SESSION["media_palmitole_c16_1"][$j] = 0;

  $_SESSION["media_oleico_c18_1"][$j] = 0;

  $_SESSION["media_eicoseno_c20_1"][$j] = 0;

  $_SESSION["media_c22_1"][$j] = 0;

  $_SESSION["media_linoleico_c18_2"][$j] = 0;

  $_SESSION["media_linoleni_c18_3"][$j] = 0;

  $_SESSION["media_c18_4"][$j] = 0;

  $_SESSION["media_ara_ico_c20_4"][$j] = 0;

  $_SESSION["media_c20_5"][$j] = 0;

  $_SESSION["media_c22_5"][$j] = 0;

  $_SESSION["media_c22_6"][$j] = 0;

  $_SESSION["media_otrosatur0"][$j] = 0;

  $_SESSION["media_otroinsat0"][$j] = 0;

  $_SESSION["media_omega3_0"][$j] = 0;

  $_SESSION["media_etanol0"][$j] = 0;

  $_SESSION["media_vit_a"][$j] = 0;

  $_SESSION["media_carotenos"][$j] = 0;

  $_SESSION["media_tocoferol"][$j] = 0;

  $_SESSION["media_vit_d"][$j] = 0;

  $_SESSION["media_vit_b1"][$j] = 0;

  $_SESSION["media_vit_b2"][$j] = 0;

  $_SESSION["media_vit_b6"][$j] = 0;

  $_SESSION["media_niacina"][$j] = 0;

  $_SESSION["media_ac_panto"][$j] = 0;

  $_SESSION["media_biotina"][$j] = 0;

  $_SESSION["media_folico"][$j] = 0;

  $_SESSION["media_b12"][$j] = 0;

  $_SESSION["media_vit_c"][$j] = 0;

  $_SESSION["media_purinas"][$j] = 0;

  $_SESSION["media_vit_k"][$j] = 0;

  $_SESSION["media_vit_e"][$j] = 0;

  $_SESSION["media_oxalico"][$j] = 0;

 }
 */
}


function detalle_comida_dieta($id_plato, $nombre, $fijo, $peso, $kcal_teoricas, $kcal, $hidratos, $grasa, $proteinas, $agua_g, $cal_kcal, $prot_g, $hc_g, $grasa_g, $satur_g, $mono_g, $poli_g, $col_mg, $fibra_g, $sodio_mg, $potasio_mg, $magnesio_mg, $calcio_mg, $fosf_mg, $hierro_mg, $cloro_mg, $cinc_mg, $cobre_mg, $manganeso_mg, $cromo_mg, $cobalto_mg, $molibde_mg, $yodo_mg, $fluor_mg, $butirico_c4_0, $caproico_c6_0, $caprilico_c8_0, $caprico_c10_0, $laurico_c12_0, $miristico_c14_0, $c15_0, $c15_00, $palmitico_c16_0, $c17_0, $c17_00, $estearico_c18_0, $araquidi_c20_0, $behenico_c22_0, $miristol_c14_1, $palmitole_c16_1, $oleico_c18_1, $eicoseno_c20_1, $c22_1, $linoleico_c18_2, $linoleni_c18_3, $c18_4, $ara_ico_c20_4, $c20_5, $c22_5, $c22_6, $otrosatur0, $otroinsat0, $omega3_0, $etanol0, $vit_a, $carotenos, $tocoferol, $vit_d, $vit_b1, $vit_b2, $vit_b6, $niacina, $ac_panto, $biotina, $folico, $b12, $vit_c, $purinas, $vit_k, $vit_e, $oxalico){

	if (!class_exists('Comida')) {
		class Comida {
		 
		//datos basicos
		public $id_plato;
		public $nombre;
		public $fijo;
		public $peso;
		public $kcal_teoricas;
		public $kcal;
		public $hidratos;
		public $grasa;
		public $proteinas;

		//datos avanzados de los platos 
		public $pc_porcentaje;
		public $agua_g;
		public $cal_kcal;
		public $prot_g;
		public $hc_g;
		public $grasa_g;
		public $satur_g;
		public $mono_g;
		public $poli_g;
		public $col_mg;
		public $fibra_g;
		public $sodio_mg;
		public $potasio_mg;
		public $magnesio_mg;
		public $calcio_mg;
		public $fosf_mg;
		public $hierro_mg;
		public $cloro_mg;
		public $cinc_mg;
		public $cobre_mg;
		public $manganeso_mg;
		public $cromo_mg;
		public $cobalto_mg;
		public $molibde_mg;
		public $yodo_mg;
		public $fluor_mg;
		public $butirico_c4_0;
		public $caproico_c6_0;
		public $caprilico_c8_0;
		public $caprico_c10_0;
		public $laurico_c12_0;
		public $miristico_c14_0;
		public $c15_0;
		public $c15_00;
		public $palmitico_c16_0;
		public $c17_0;
		public $c17_00;
		public $estearico_c18_0;
		public $araquidi_c20_0;
		public $behenico_c22_0;
		public $miristol_c14_1;
		public $palmitole_c16_1;
		public $oleico_c18_1;
		public $eicoseno_c20_1;
		public $c22_1;
		public $linoleico_c18_2;
		public $linoleni_c18_3;
		public $c18_4;
		public $ara_ico_c20_4;
		public $c20_5;
		public $c22_5;
		public $c22_6;
		public $otrosatur0;
		public $otroinsat0;
		public $omega3_0;
		public $etanol0;
		public $vit_a;
		public $carotenos;
		public $tocoferol;
		public $vit_d;
		public $vit_b1;
		public $vit_b2;
		public $vit_b6;
		public $niacina;
		public $ac_panto;
		public $biotina;
		public $folico;
		public $b12;
		public $vit_c;
		public $purinas;
		public $vit_k;
		public $vit_e;
		public $oxalico;
		
		}
	}
	$detalle = '';
	$detalle['id_plato'] = $id_plato;
	$detalle['nombre'] = $nombre;
	$detalle['fijo'] = $fijo;
	$detalle['peso'] = $peso;
	$detalle['kcal_teoricas'] = $kcal_teoricas;
	$detalle['kcal'] = $kcal;
	$detalle['hidratos'] = $hidratos;
	$detalle['grasa'] = $grasa;
	$detalle['proteinas'] = $proteinas;
	$detalle['agua_g'] = $agua_g;
	$detalle['cal_kcal'] = $cal_kcal;
	$detalle['prot_g'] = $prot_g;
	$detalle['hc_g'] = $hc_g;
	$detalle['grasa_g'] = $grasa_g;
	$detalle['satur_g'] = $satur_g;
	$detalle['mono_g'] = $mono_g;	
	$detalle['poli_g'] = $poli_g;
	$detalle['col_mg'] = $col_mg;
	$detalle['fibra_g'] = $fibra_g;
	$detalle['sodio_mg'] = $sodio_mg;
	$detalle['potasio_mg'] = $potasio_mg;
	$detalle['magnesio_mg'] = $magnesio_mg;
	$detalle['calcio_mg'] = $calcio_mg;
	$detalle['fosf_mg'] = $fosf_mg;
	$detalle['hierro_mg'] = $hierro_mg;
	$detalle['cloro_mg'] = $cloro_mg;
	$detalle['cinc_mg'] = $cinc_mg;
	$detalle['cobre_mg'] = $cobre_mg;
	$detalle['manganeso_mg'] = $manganeso_mg;
	$detalle['cromo_mg'] = $cromo_mg;
	$detalle['cobalto_mg'] = $cobalto_mg;
	$detalle['molibde_mg'] = $molibde_mg;
	$detalle['yodo_mg'] = $yodo_mg;
	$detalle['fluor_mg'] = $fluor_mg;
	$detalle['butirico_c4_0'] = $butirico_c4_0;
	$detalle['caproico_c6_0'] = $caproico_c6_0;
	$detalle['caprilico_c8_0'] = $caprilico_c8_0;
	$detalle['caprico_c10_0'] = $caprico_c10_0;
	$detalle['laurico_c12_0'] = $laurico_c12_0;
	$detalle['miristico_c14_0'] = $miristico_c14_0;
	$detalle['c15_0'] = $c15_0;
	$detalle['c15_00'] = $c15_00;
	$detalle['palmitico_c16_0'] = $palmitico_c16_0;
	$detalle['c17_0'] = $c17_0;
	$detalle['c17_00'] = $c17_00;
	$detalle['estearico_c18_0'] = $estearico_c18_0;
	$detalle['araquidi_c20_0'] = $araquidi_c20_0;
	$detalle['behenico_c22_0'] = $behenico_c22_0;
	$detalle['miristol_c14_1'] = $miristol_c14_1;
	$detalle['palmitole_c16_1'] = $palmitole_c16_1;
	$detalle['oleico_c18_1'] = $oleico_c18_1;
	$detalle['eicoseno_c20_1'] = $eicoseno_c20_1;
	$detalle['c22_1'] = $c22_1;
	$detalle['linoleico_c18_2'] = $linoleico_c18_2;
	$detalle['linoleni_c18_3'] = $linoleni_c18_3;
	$detalle['c18_4'] = $c18_4;
	$detalle['ara_ico_c20_4'] = $ara_ico_c20_4;
	$detalle['c20_5'] = $c20_5;
	$detalle['c22_5'] = $c22_5;
	$detalle['c22_6'] = $c22_6;
	$detalle['otrosatur0'] = $otrosatur0;
	$detalle['otroinsat0'] = $otroinsat0;
	$detalle['omega3_0'] = $omega3_0;
	$detalle['etanol0'] = $etanol0;
	$detalle['vit_a'] = $vit_a;
	$detalle['carotenos'] = $carotenos;
	$detalle['tocoferol'] = $tocoferol;
	$detalle['vit_d'] = $vit_d;
	$detalle['vit_b1'] = $vit_b1;
	$detalle['vit_b2'] = $vit_b2;
	$detalle['vit_b6'] = $vit_b6;
	$detalle['niacina'] = $niacina;
	$detalle['ac_panto'] = $ac_panto;
	$detalle['folico'] = $folico;
	$detalle['vit_c'] = $vit_c;
	$detalle['purinas'] = $purinas;
	$detalle['b12'] = $b12;
	$detalle['vit_k'] = $vit_k;
	$detalle['vit_e'] = $vit_e;
	$detalle['oxalico'] = $oxalico;
	$detalle['b12'] = $b12;
	
	return $detalle;
	
}


?>
