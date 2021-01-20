<?php

//       Datos a tener en cuenta:
//           - No utilizar join ni filtros en las consultas sql.
//           - No utilizar en las consultas las funciones avg, sum o count.
//           - Las tablas a consultar son Profesores y Personal.
// 					- La aplicación tendrá un menú desde donde gestionar las distintas opciones.

/**EJERCICIO 1 */
// • Listado de profesores pertenecientes a una determinada 
//especialidad ordenado descendentemente por el campo salario. 
//La especialidad será introducida por el usuario a través de un pequeño
// formulario convenientemente validado.
// function dniProfesores()
// {
// 	try {
// 		$conexion = new PDO('mysql:host=localhost:3306;dbname=PRUEBASCLASE', 'usuario', 'usuario');
// 		$statement = $conexion->prepare("select DNI, ESPECIALIDAD 
// 																		from PROFESORES");
// 		$statement->execute();
// 		$resultados =  $statement->fetchAll(PDO::FETCH_ASSOC);
// 	} catch (PDOException $e) {
// 		$resultados  = null;
// 	}
// 	return $resultados;
// }

function consultaSelect($consulta)
{
	try {
		$conexion = new PDO('mysql:host=localhost:3306;dbname=PRUEBASCLASE', 'usuario', 'usuario');
		$statement = $conexion->prepare($consulta);
		$statement->execute();
		$resultados =  $statement->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$resultados  = null;
	}
	return $resultados;
}

function profesoresEspecialidad($listaProfesores, $especialidad)
{
	$profesoresEspecialidad = array();
	foreach ($listaProfesores as $profesor) {
		if ($profesor["ESPECIALIDAD"] == $especialidad) {
			$profesoresEspecialidad[] = $profesor["DNI"];
		}
	}
	return $profesoresEspecialidad;
}


function nombreSalarioProfesoresDeUnaEspecialidad($listaPersonal, $dniProfesoresEspecialidad)
{
	$listaNombreSalarioProfesoresDeUnaEspecialidad = array();
	foreach ($dniProfesoresEspecialidad as $dni) {
		foreach ($listaPersonal as $persona) {
			if ($dni == $persona["DNI"]) {
				$listaNombreSalarioProfesoresDeUnaEspecialidad[] = array(
					"APELLIDOS" => $persona["APELLIDOS"],
					"SALARIO" => $persona["SALARIO"]
				);
			}
		}
	}
	return $listaNombreSalarioProfesoresDeUnaEspecialidad;
}

function pintaTabla($resultados)
{
	$arrayCampos = array_keys($resultados[0]);
	$tabla = "<table><tr>";

	foreach ($arrayCampos as $campo) {
		$tabla .= "<th>$campo</th>";
	}
	$tabla .= "</tr>";

	foreach ($resultados as $resultado) {
		$tabla .= "<tr>";
		foreach ($resultado as $campo) {
			$tabla .= "<td>$campo</td>";
		}
		$tabla .= "</tr>";
	}
	$tabla .= "</table>";
	return $tabla;
}


// /**EJERCICIO 2 */

function salarioFuncion($funcion, $listaSalarios)
{
	$listaSalarioProfesores = array();

	foreach ($listaSalarios as $salarioFuncion) {
		if ($salarioFuncion["FUNCION"] == $funcion) {
			$listaSalarioProfesores[] = $salarioFuncion;
		}
	}
	return $listaSalarioProfesores;
}

function mediaSalario($listaSalarios)
{
	$media = 0;
	foreach ($listaSalarios as $salario) {
		$media += $salario["SALARIO"];
	}
	return $media / count($listaSalarios);
}

function personalSalarioMenorMediaProfesores($mediaSalarioProfesores, $listaSalarios)
{
	$personalSalarioInferiorMediaProfesores = array();
	foreach ($listaSalarios as $salario) {
		if ($salario["SALARIO"] < $mediaSalarioProfesores) {
			$personalSalarioInferiorMediaProfesores[] = array("Nombre" => $salario["APELLIDOS"]);
		}
	}
	return $personalSalarioInferiorMediaProfesores;
}


//  Ejercicio 3
// Generar y visualizar un array asociativo con la siguiente estructura: 
// especialidad-> salario_medio. 

function listaEspecialidadDniSalario($lista_especialidadesDNI, $listaSalarioProfesores)
{
	$listaEspecialidadDniSalario = array();
	foreach ($lista_especialidadesDNI as $especialidadDNI) {
		foreach ($listaSalarioProfesores as $salarioProfesor) {
			if ($especialidadDNI["DNI"] == $salarioProfesor["DNI"]) {
				$listaEspecialidadDniSalario[] = array(
					"SALARIO" => $salarioProfesor["DNI"],
					"ESPECIALIDAD" => $especialidadDNI["ESPECIALIDAD"]
				);
			}
		}
	}
	return $listaEspecialidadDniSalario;
}

function mediaSalariosEspecialidad($listaSalariosProfesores, $lista_especialidades)
{
	$mediaSalariosEspecialidad = array();
	foreach ($lista_especialidades as $especialidad) {
		$numeroProfesoresPorEspecialidad = 0;
		foreach ($listaSalariosProfesores as $profesor) {
			if (!isset($mediaSalariosEspecialidad[$especialidad])) {
				$mediaSalariosEspecialidad[$especialidad] = $profesor["SALARIO"];
				$numeroProfesoresPorEspecialidad++;
			} else if ($especialidad == $profesor["ESPECIALIDAD"]) {
				$mediaSalariosEspecialidad[$especialidad] += $profesor["SALARIO"];
				$numeroProfesoresPorEspecialidad++;
			}
		}
		$mediaSalariosEspecialidad[$especialidad] = $mediaSalariosEspecialidad[$especialidad]
			/ $numeroProfesoresPorEspecialidad;
	}
	return $mediaSalariosEspecialidad;
}

function filtarRepetidos($lista)
{
	$clave = key($lista[0]);
	$arrayFiltrada = array();
	foreach ($lista as $elemento) {
		if (!in_array($elemento[$clave], $arrayFiltrada)) {
			$arrayFiltrada[] = $elemento[$clave];
		}
	}		
		return $arrayFiltrada;
}
