<?php

$tabla2 = "";
require "../utilidades/funciones.php";


//Apartado 2
$listaSalarios = consultaSelect("select SALARIO, FUNCION, APELLIDOS, DNI from PERSONAL");
$listaSalariosProfesores = salarioFuncion("PROFESOR", $listaSalarios);
$mediaSalarioProfesores = mediaSalario($listaSalariosProfesores);
$personalSalarioInferiorProfesores = personalSalarioMenorMediaProfesores($mediaSalarioProfesores, $listaSalarios);
$tabla2 = pintaTabla($personalSalarioInferiorProfesores);

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