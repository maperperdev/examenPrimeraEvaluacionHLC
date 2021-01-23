<?php
$tabla3 = "";

require "../utilidades/funciones.php";

//Apartado 3
$listaPersonal = ejecutarConsulta("select * from PERSONAL");
$filtro = array("FUNCION" => "PROFESOR");
$listaDNIProfesores = filtrarCampos(filtrarResultadosUnBucle($listaPersonal, $filtro), array("DNI", "SALARIO"));
$listaProfesores = ejecutarConsulta("select * from PROFESORES");
$salariosEspecialidad =
	filtrarCampos(
		agregaCampo($listaProfesores, $listaDNIProfesores, "DNI"),
		array("ESPECIALIDAD", "SALARIO")
	);
$mediaInformatica = mediaCampo(filtrarResultadosUnBucle($salariosEspecialidad, array("ESPECIALIDAD" => "INFORMÁTICA")), "SALARIO");
$mediaMatematicas = mediaCampo(filtrarResultadosUnBucle($salariosEspecialidad, array("ESPECIALIDAD" => "MATEMÁTICAS")), "SALARIO");
$mediaLengua = mediaCampo(filtrarResultadosUnBucle($salariosEspecialidad, array("ESPECIALIDAD" => "LENGUA")), "SALARIO");

$arrayTabla = array(
	array("ESPECIALIDAD" => "INFORMÁTICA", "SALARIO" => $mediaInformatica),
	array("ESPECIALIDAD" => "MATEMÁTICAS", "SALARIO" => $mediaMatematicas),
	array("ESPECIALIDAD" => "LENGUA", "SALARIO" => $mediaLengua)
);

$tabla3 = pintaTabla($arrayTabla);
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1>Tabla apartado tres</h1>
	<?php echo $tabla3 ?>
</body>

</html>