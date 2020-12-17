<?php
$tabla3 = "";

require "../utilidades/test.php";

//Apartado 3
$lista_especialidadesDNI = ejecutarConsulta("select ESPECIALIDAD, DNI
																		from PROFESORES");
$lista_especialidades = ejecutarConsulta("select ESPECIALIDAD
																		from PROFESORES");
$listaSalarios = ejecutarConsulta("select SALARIO, FUNCION, APELLIDOS, DNI
																		from PERSONAL");
$filtro = array("FUNCION" => "PROFESOR");
$listaSalariosProfesores = filtrarResultadosUnBucle($listaSalarios, $filtro);
$listaEspecialidadDniSalario = filtrarResultadosDosBucles(
	$listaSalariosProfesores,
	$lista_especialidadesDNI,
	"DNI"
);
print_r($listaSalariosProfesores);
echo pintaTabla($listaEspecialidadDniSalario);
// $mediaSalariosEspecialidad = mediaSalariosEspecialidad($listaEspecialidadDniSalario, $lista_especialidades);
// $tabla3 = "<table><tr><th>Especialidad</th><th>Salario medio</th></tr>";
// foreach ($mediaSalariosEspecialidad as $key => $value) {
// 	$tabla3 .= "<tr><td>$key</td><td>$value</td></tr>";
// }
// $tabla3 .= "</table>";
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