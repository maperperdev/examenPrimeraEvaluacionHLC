<?php
$tabla3 = "";

require "../utilidades/funciones.php";

//Apartado 3
$lista_especialidadesDNI = obtenerEspecialidadesDNI();
$lista_especialidades = obtenerEspecialidades();
$listaSalarios = salarioPersonal();
$listaSalariosProfesores = salarioFuncion("PROFESOR", $listaSalarios);
$listaEspecialidadDniSalario = listaEpecialidadDniSalario($lista_especialidadesDNI, $listaSalariosProfesores);
$mediaSalariosEspecialidad = mediaSalariosEspecialidad($listaEspecialidadDniSalario, $lista_especialidades);
$tabla3 = "<table><tr><th>Especialidad</th><th>Salario medio</th></tr>";
foreach ($mediaSalariosEspecialidad as $key => $value) {
	$tabla3 .= "<tr><td>$key</td><td>$value</td></tr>";
}
$tabla3 .= "</table>";
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