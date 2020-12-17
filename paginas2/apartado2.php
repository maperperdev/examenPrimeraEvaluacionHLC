<?php

$tabla2 = "";
require "../utilidades/test.php";


//Apartado 2
$listaSalarios = ejecutarConsulta("select SALARIO, FUNCION, APELLIDOS, DNI
																		from PERSONAL");
$filtro = array("FUNCION" => "PROFESOR");
$listaSalariosProfesores = filtrarResultadosUnBucle($listaSalarios, $filtro);
$mediaSalarioProfesores = mediaSalario($listaSalariosProfesores);
$personalSalarioInferiorProfesores = filtraPorCampoMenor(
	$mediaSalarioProfesores,
	"SALARIO",
	$listaSalarios
);

$listaDni = array();
foreach ($personalSalarioInferiorProfesores as $personal) {
	$listaDni[] = array("DNI" => $personal["DNI"]);
}
$tabla2 = pintaTabla($listaDni);

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