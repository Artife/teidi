<?php
session_start();
include '../parts/conex.php';
ini_set('error_reporting', E_ALL);
//Solo permitir acceso a estos roles
$acceso_roles = array('admin', 'Desarrollador');

//Archivo estandar de configuracion de la pagina
include_once '../parts/consultas_mysql.php';
include_once '../parts/configuracion.php';  
	
	//Seleccionamos todo de alimentos
	/*
	$query = "SELECT * FROM `alimento`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
		
		$total_sistema = 0;
		$otros_usuarios = 0;
		$todos_alimentos_menos_de_100 = 0;
		while($row = $result->fetch_assoc()) {
			$id_alimento			= $row["id_alimento"];			
			$id_alimento_completo	= $row["id_alimento_completo"];			
			if ($row['id_usuario'] == ''){ $id_usuario = 0; }else{ $id_usuario = $row['id_usuario'];  }
			$nombre				= $row["nombre"];
			$kcal_100g			= $row["kcal_100g"];
			$hidratos			= $row["hidratos"];
			$proteinas			= $row["proteinas"];
			$grasa				= $row["grasa"];			
			$grupo				= $row["grupo"];			
			$proteinas_porc		= $row["proteinas_porc"];			
			$hidratos_porc		= $row["hidratos_porc"];
			$grasa_porc			= $row["grasa_porc"];		

			$suma = $hidratos+$proteinas+$grasa;
			if ($suma <100) {
				if($hidratos > $proteinas AND $hidratos > $grasa) { $hidratos = 100-($hidratos + $grasa);}
				if($proteinas > $hidratos AND $proteinas > $grasa) { $proteinas = 100-($hidratos + $grasa);}
				if($grasa > $hidratos AND $grasa > $proteinas) { $grasa = 100-($hidratos + $proteinas);}
			}	
			//Insertamos en la tabla nueva de alimentos
			$query_inser = 'INSERT into gx_alimentos (id_alimento, id_alimento_completo, id_usuario, nombre, kcal_100g, hidratos, proteinas, grasa, id_grupo, proteinas_porc, hidratos_porc, grasa_porc) 
			values ("'.$id_alimento.'", "'.$id_alimento_completo.'", "'.$id_usuario.'", "'.$nombre.'", "'.$kcal_100g.'", "'.$hidratos.'", "'.$proteinas.'", "'.$grasa.'", "'.$grupo.'", "'.$proteinas_porc.'", "'.$hidratos_porc.'", "'.$grasa_porc.'")';
			// Listo
			$result_inser = mysqli_query($_SESSION["conexion"], $query_inser) or die(mysqli_error($_SESSION["conexion"]));	
			
			//Mostrar todos los alimentos que no den 100
			
			if ($suma <100) {
				echo "ID->".$id_alimento;
				echo "<br>";
				echo "Usuario->".$id_usuario;
				echo "<br>";
				echo "Nombre->".$nombre;
				echo "<br>";
				echo "Suma->".$suma;
				echo "<br>";
				echo "<br>";
				if($id_usuario == 0){ $total_sistema++;  }else{ $otros_usuarios++; }
				$todos_alimentos_menos_de_100++; 
			} 
		}	
		
		echo "<br>";
		echo "<br>";
		echo "Total sistema->".$total_sistema;
		echo "<br>";
		echo "Total otros usuarios->".$otros_usuarios;
		echo "<br>";
		echo "Total alimentos menores a 100->".$todos_alimentos_menos_de_100;
		
	// print_r($receta);
	 */
//->AGREGAR LOS DATOS DE LA TABLA ALIMENTOS_COMPLETO A GX_ALIMENTOS	
	/*
	//Seleccionamos todo de alimentos de la tabla completos	
	$query = "SELECT * FROM `alimento_completo`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));			
		
		$total_sistema = 0;
		$otros_usuarios = 0;
		$todos_alimentos_menos_de_100 = 0;
		while($row = $result->fetch_assoc()) {
			$id_alimento_completo		= $row["id_alimento_completo"];						
			$nombre_ing			= $row["nombre_ing"];
			$nombre_alias		= $row["nombre"];			
			$grupo				= $row["grupo"];
			$subgrupo			= $row["subgrupo"];
			$pc_porcentaje		= $row["pc_porcentaje"];
			$cal_kcal			= $row["cal_kcal"];
			$agua_g				= $row["agua_g"];			
			$hc_g				= $row["hc_g"];			
			$fibra_g			= $row["fibra_g"];
			$prot_g				= $row["prot_g"];
			$grasa_g			= $row["grasa_g"];
			$col_mg				= $row["col_mg"];
			$satur_g			= $row["satur_g"];
			$mono_g				= $row["mono_g"];
			$poli_g				= $row["poli_g"];
			$vit_a				= $row["vit_a"];
			$carotenos			= $row["carotenos"];
			$vit_b1				= $row["vit_b1"];
			$vit_b2				= $row["vit_b2"];
			//No tiene
			// $niacina			= $row["niacina"];
			$niacina			= 0;
			$ac_panto			= $row["ac_panto"];
			$vit_b6				= $row["vit_b6"];
			$biotina			= $row["biotina"];
			$folico				= $row["folico"];
			$b12				= $row["b12"];
			$vit_c				= $row["vit_c"];
			$vit_d				= $row["vit_d"];
			$tocoferol			= $row["tocoferol"];
			$vit_e				= $row["vit_e"];
			$vit_k				= $row["vit_k"];
			$oxalico			= $row["oxalico"];
			$purinas			= $row["purinas"];
			$sodio_mg			= $row["sodio_mg"];
			$potasio_mg			= $row["potasio_mg"];
			$magnesio_mg		= $row["magnesio_mg"];
			$calcio_mg			= $row["calcio_mg"];
			$fosf_mg			= $row["fosf_mg"];
			$hierro_mg			= $row["hierro_mg"];
			$cloro_mg			= $row["cloro_mg"];
			$cinc_mg			= $row["cinc_mg"];
			$cobre_mg			= $row["cobre_mg"];
			$manganeso_mg		= $row["manganeso_mg"];
			$cromo_mg			= $row["cromo_mg"];
			$cobalto_mg			= $row["cobalto_mg"];
			$molibde_mg			= $row["molibde_mg"];
			$yodo_mg			= $row["yodo_mg"];
			$fluor_mg			= $row["fluor_mg"];
			$butirico_c4_0			= $row["butirico_c4_0"];
			$caproico_c6_0			= $row["caproico_c6_0"];
			$caprilico_c8_0			= $row["caprilico_c8_0"];
			$caprico_c10_0			= $row["caprico_c10_0"];
			$laurico_c12_0			= $row["laurico_c12_0"];
			$miristico_c14_0		= $row["miristico_c14_0"];
			$c15_0					= $row["c15_0"];
			$c15_00					= $row["c15_00"];
			$palmitico_c16_0		= $row["palmitico_c16_0"];
			$c17_0					= $row["c17_0"];
			$c17_00					= $row["c17_00"];
			$estearico_c18_0		= $row["estearico_c18_0"];
			$araquidi_c20_0			= $row["araquidi_c20_0"];
			$behenico_c22_0			= $row["behenico_c22_0"];
			$miristol_c14_1			= $row["miristol_c14_1"];
			$palmitole_c16_1		= $row["palmitole_c16_1"];
			$oleico_c18_1			= $row["oleico_c18_1"];
			$eicoseno_c20_1			= $row["eicoseno_c20_1"];
			$c22_1					= $row["c22_1"];
			$linoleico_c18_2		= $row["linoleico_c18_2"];
			$linoleni_c18_3			= $row["linoleni_c18_3"];
			$c18_4					= $row["c18_4"];
			$ara_ico_c20_4			= $row["ara_ico_c20_4"];
			$c20_5					= $row["c20_5"];
			$c22_5					= $row["c22_5"];
			$c22_6					= $row["c22_6"];
			$otrosatur0				= $row["otrosatur0"];
			$otroinsat0				= $row["otroinsat0"];
			$omega3_0				= $row["omega3_0"];
			$etanol0				= $row["etanol0"];
			
			//Hacemos un update a la tabla 
			echo $query_comple = 'UPDATE gx_alimentos SET 
			nombre_ing="'.$nombre_ing.'",
			nombre_alias="'.$nombre_alias.'",
			grupo="'.$grupo.'",			
			pc_porcentaje="'.$pc_porcentaje.'",
			cal_kcal="'.$cal_kcal.'",
			agua_g="'.$agua_g.'",
			hc_g="'.$hc_g.'",
			fibra_g="'.$fibra_g.'",
			prot_g="'.$prot_g.'",
			grasa_g="'.$grasa_g.'",
			col_mg="'.$col_mg.'",
			satur_g="'.$satur_g.'",
			mono_g="'.$mono_g.'",
			poli_g="'.$poli_g.'",
			vit_a="'.$vit_a.'",
			carotenos="'.$carotenos.'",
			vit_b1="'.$vit_b1.'",
			vit_b2="'.$vit_b2.'",
			niacina="'.$niacina.'",
			ac_panto="'.$ac_panto.'",
			vit_b6="'.$vit_b6.'",
			biotina="'.$biotina.'",
			folico="'.$folico.'",
			b12="'.$b12.'",
			vit_c="'.$vit_c.'",
			vit_d="'.$vit_d.'",
			tocoferol="'.$tocoferol.'",
			vit_e="'.$vit_e.'",
			vit_k="'.$vit_k.'",
			oxalico="'.$oxalico.'",
			purinas="'.$purinas.'",
			sodio_mg="'.$sodio_mg.'",
			potasio_mg="'.$potasio_mg.'",
			magnesio_mg="'.$magnesio_mg.'",
			calcio_mg="'.$calcio_mg.'",
			fosf_mg="'.$fosf_mg.'",
			hierro_mg="'.$hierro_mg.'",
			cloro_mg="'.$cloro_mg.'",
			cinc_mg="'.$cinc_mg.'",
			cobre_mg="'.$cobre_mg.'",
			manganeso_mg="'.$manganeso_mg.'",
			cromo_mg="'.$cromo_mg.'",
			cobalto_mg="'.$cobalto_mg.'",
			molibde_mg="'.$molibde_mg.'",
			yodo_mg="'.$yodo_mg.'",
			fluor_mg="'.$fluor_mg.'",
			butirico_c4_0="'.$butirico_c4_0.'",
			caproico_c6_0="'.$caproico_c6_0.'",
			caprilico_c8_0="'.$caprilico_c8_0.'",
			caprilico_c8_0="'.$caprilico_c8_0.'",
			caprico_c10_0="'.$caprico_c10_0.'",
			laurico_c12_0="'.$laurico_c12_0.'",
			miristico_c14_0="'.$miristico_c14_0.'",
			c15_0="'.$c15_0.'",
			c15_00="'.$c15_00.'",
			palmitico_c16_0="'.$palmitico_c16_0.'",
			c17_0="'.$c17_0.'",
			c17_00="'.$c17_00.'",
			estearico_c18_0="'.$estearico_c18_0.'",
			araquidi_c20_0="'.$araquidi_c20_0.'",
			behenico_c22_0="'.$behenico_c22_0.'",
			miristol_c14_1="'.$miristol_c14_1.'",
			palmitole_c16_1="'.$palmitole_c16_1.'",
			oleico_c18_1="'.$oleico_c18_1.'",
			eicoseno_c20_1="'.$eicoseno_c20_1.'",
			c22_1="'.$c22_1.'",
			linoleico_c18_2="'.$linoleico_c18_2.'",
			linoleni_c18_3="'.$linoleni_c18_3.'",
			c18_4="'.$c18_4.'",
			ara_ico_c20_4="'.$ara_ico_c20_4.'",
			c20_5="'.$c20_5.'",
			c22_5="'.$c22_5.'",
			c22_6="'.$c22_6.'",
			otrosatur0="'.$otrosatur0.'",
			otroinsat0="'.$otroinsat0.'",
			omega3_0="'.$omega3_0.'",
			etanol0="'.$etanol0.'"
			WHERE id_alimento_completo="'.$id_alimento_completo.'"';
			$result_completo = mysqli_query($_SESSION["conexion"], $query_comple) or die(mysqli_error($connection));		
			
			echo "<br>";	
				
		} 
	*/
//-> AGREGAR LOS SUPER GRUPOS A LA TABLA DE ALIMENTOS NUEVOS
	/*
	//Consultamos la tabla alimento_supergrupo
	$query = "SELECT * FROM `alimento_supergrupo`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($connection));			
	$i = 0;
	$id_supergrupos_show = '';
	$superg = array();
	while($row = $result->fetch_assoc()) {		
		$superg_id		= $row["supergrupo"];	
		
		if($superg_id == 'ARROZ'){ $supergrupo_id = 0; }
		if($superg_id == 'CARNE'){ $supergrupo_id = 1; }
		if($superg_id == 'CEREALES'){ $supergrupo_id = 2; }
		if($superg_id == 'FRUTA'){ $supergrupo_id = 3; }
		if($superg_id == 'HUEVOS'){ $supergrupo_id = 4; }
		if($superg_id == 'LACTEOS'){ $supergrupo_id = 5; }
		if($superg_id == 'LEGUMBRES'){ $supergrupo_id = 6; }
		if($superg_id == 'PASTA'){ $supergrupo_id = 7; }
		if($superg_id == 'PATATAS'){ $supergrupo_id = 8; }
		if($superg_id == 'PESCADO'){ $supergrupo_id = 9; }
		if($superg_id == 'PROTEINAS'){ $supergrupo_id = 10; }
		if($superg_id == 'VERDURAS Y HORTALIZAS'){ $supergrupo_id = 11; }
		
		//Consultamos otra vez para concatenar los ids
		$query_2 = "SELECT * FROM `gx_alimentos` WHERE id_alimento = '".$row["id_alimento"]."'";
		$result_2 = mysqli_query($_SESSION["conexion"], $query_2) or die(mysqli_error($connection));	
		while($row_2 = $result_2->fetch_assoc()) {
			$id_supergrupos = $row_2["id_supergrupos"];
		}
		
		//Actualizamos si existe	
		if(empty($id_supergrupos)){
			$id_supergrupos_show = ','.$supergrupo_id.',';
		}else{
			$id_supergrupos_show = $id_supergrupos.$supergrupo_id.',';
		}
		echo $query_actu = "UPDATE `gx_alimentos` SET `id_supergrupos` = '".$id_supergrupos_show."' WHERE id_alimento = '".$row["id_alimento"]."'";
		echo "<br>";
		$result_actu = mysqli_query($_SESSION["conexion"], $query_actu) or die(mysqli_error($_SESSION["conexion"]));	
		$id_supergrupos = '';
		$i++;	
	}	
	*/
//-> Modificar el titulo de los grupos	
	
	 
	//Consultamos la tabla de alimentos
	$query = "SELECT * FROM `gx_alimentos`";
	$result = mysqli_query($_SESSION["conexion"], $query) or die(mysqli_error($_SESSION["conexion"]));			
	$i = 0;
	while($row = $result->fetch_assoc()) {		
		$id_grupo		= $row["id_grupo"];	
		$id_alimento	= $row["id_alimento"];		
		
		//consultamos los grupos de las los alimentos por id_alimento
		$query_2 = "SELECT * FROM `grupos_alimentos` WHERE id_grupo = '".$id_grupo."'";
		$result_2 = mysqli_query($_SESSION["conexion"], $query_2) or die(mysqli_error($_SESSION["conexion"]));	
		while($row_2 = $result_2->fetch_assoc()) {
			$grupo		= $row_2["grupo"];	
			if($grupo == '') {$grupo = 'OTROS'; }
			echo $query_actu = "UPDATE `gx_alimentos` SET `grupo` = '".$grupo."' WHERE id_alimento = '".$row["id_alimento"]."'";
			echo "<br>";
			$result_actu = mysqli_query($_SESSION["conexion"], $query_actu) or die(mysqli_error($_SESSION["conexion"]));	
		}
	}	
	
?>