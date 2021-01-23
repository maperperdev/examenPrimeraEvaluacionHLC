<?php

$tabla2 = "";
require "../utilidades/funciones.php";


//Apartado 2
$listaSalarios = ejecutarConsulta("select SALARIO, FUNCION, APELLIDOS, DNI from PERSONAL");
$filtro = array("FUNCION" => "PROFESOR");
$listaSalariosProfesores = filtrarResultadosUnBucle($listaSalarios, $filtro);
$mediaSalariosProfesores = mediaCampo($listaSalariosProfesores, "SALARIO");
$listadoSalariosInferiorProfesores = filtraPorCondicion("<", $mediaSalariosProfesores, "SALARIO", $listaSalarios);
$tabla2 = pintaTabla(filtrarCampos($listadoSalariosInferiorProfesores, array("APELLIDOS")));
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1>Tabla apartado dos</h1>
	<?php echo $tabla2 ?>
</body>

</html>