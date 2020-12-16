<?php

$error = "";
$texto = "";
$tabla1 = "";
$tabla2 = "";
$tabla3 = "";

require "../utilidades/funciones.php";


if (isset($_POST["submit_form"])) {
	if ($_POST["especialidad"] == "") {
		$error = "campo vacío";
	} else {
		//Apartado 1
		$listaProfesores = dniProfesores();
		$especialidad = $_POST["especialidad"];
		$dniProfesoresEspecialidad = profesoresEspecialidad($listaProfesores, $especialidad);
		$listaPersonal = nombreSalarioPersonal();
		$listaNombresSalariosPorEspecialidad = nombreSalarioProfesoresDeUnaEspecialidad(
			$listaPersonal,
			$dniProfesoresEspecialidad
		);
		usort($listaNombresSalariosPorEspecialidad, function ($a, $b) {
			return $b["SALARIO"] <=> $a["SALARIO"];
		});
		$tabla1 = pintaTabla($listaNombresSalariosPorEspecialidad);
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<h1>Nombre especialidad</h1>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<input type="text" placeholder="Especialidad" name="especialidad">
		<br>
		<input type="submit" name="submit_form" value="Enviar">
		<?php if ($error != "") : ?>
			<h2><?php echo $error; ?></h2>
		<?php endif; ?>
	</form>
	<?php if ($tabla1 != "")
		echo "<br><h1>Tabla apartado uno:</h1>";
	echo $tabla1; ?>

</body>

</html>