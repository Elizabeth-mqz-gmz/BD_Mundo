<?php
	$connection = mysqli_connect("localhost","root","","mundo");//conexion a la base de datos
	if (!$connection){//verificar que se encontro-abrio
		echo mysqli_connect_error();//conect error
		echo mysqli_connect_errno();//numero de error
		exit ();
	}
	$searchBy = $_POST["cityOrCountry"];
	$str = $_POST["str"];
	$pal = $str;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Proyecto bases de datos</title>
		<link href="proyecto.css" rel="stylesheet" />
	</head>
	<body>
		<?php
		if($searchBy == "city"){
			$search = "SELECT * FROM ciudades WHERE Ciudad=\"".$str."\";";
			$results = mysqli_query($connection,$search);
			while ($array = mysqli_fetch_array($results)){
				$str = $array[0];
				echo "Nombre de la ciudad:".$array[1]."<br />";
				echo "Distrito de la ciudad:".$array[2]."<br />";
				echo "Poblacion de la ciudad:".$array[3]."<br />";
			}
			$search = "SELECT * FROM paises WHERE ID_Pais=\"".$str."\";";
			$results = mysqli_query($connection,$search);
			while($array = mysqli_fetch_array($results)){
				$str = $array[1];
			}
		}
		$search = "SELECT * FROM paises WHERE Pais=\"".$str."\";";
		$results = mysqli_query($connection,$search);
		while ($array = mysqli_fetch_array($results)){
			echo "<img src=\"".$array[16]."\"><br />";
			echo "Nombre: ".$array[1]."<br />";
			echo "Codigo:".$array[0]."<br />";
			echo "Region: ".$array[3]."<br />";
			echo "Area: ".$array[4]."<br />";
			echo "Independencia: ".$array[5]."<br />";
			echo "Poblacion: ".$array[6]."<br />";
			echo "Expectativa de vida: ".$array[7]."<br />";
			echo "PIB actual: ".$array[8]."<br />";
			echo "PIB antiguo: ".$array[9]."<br />";
			echo "Nombre local: ".$array[10]."<br />";
			echo "Gobernante: ".$array[12]."<br />";
			echo "Codigo de 2 letras: ".$array[13]."<br />";
			echo "Comida tipica: ".$array[14]."<br />";
			echo "Religion predominante: ".$array[15]."<br />";
			$clave_pais = $array[0];
			$str = $array[2];
			$str2 = $array[11];
		}
		$search = "SELECT * FROM continentes WHERE ID_continente=\"".$str."\";";
		$results = mysqli_query($connection,$search);
		while ($array = mysqli_fetch_array($results)){
			echo "Continente: ".$array[1]."<br />";
		}
		$search = "SELECT * FROM gobiernos WHERE ID_gobierno=\"".$str2."\";";
		$results = mysqli_query($connection,$search);
		while ($array = mysqli_fetch_array($results)){
			echo "Tipo de Gobierno: ".$array[1]."<br />";
		}
		$idioms = "SELECT * FROM idiom_pais JOIN idiomas ON idiom_pais.ID_idiom=idiomas.ID_idiom WHERE ID_pais = '".$clave_pais."'";
		$resp2 = mysqli_query($connection,$idioms);
		while($row2 = mysqli_fetch_assoc($resp2)){
			if( $row2["Oficial"] == "T")
			echo $row2["Idioma"]." Idioma oficial<br/>";
			else
			echo $row2["Idioma"]."Otro idioma <br/>";
		}
		if($searchBy == "country"){
			$ciudades = "SELECT * FROM ciudades JOIN paises ON ciudades.ID_pais = paises.ID_pais WHERE ciudades.ID_pais= '".$clave_pais."'";
			$resp3 = mysqli_query($connection,$ciudades);
			while($row3 = mysqli_fetch_array($resp3)){
				echo "Ciudad: ".$row3["Ciudad"]."<br/>";
				echo "Distrito: ".$row3["Distrito"]."<br/>";
				echo "Población : ".$row3["Poblacion_cd"]."<br/><br/>";
			}
		}
		mysqli_close($connection);
		?>
	</body>
</html>
