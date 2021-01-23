<?php

function ejecutarConsulta($consulta)
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

function filtrarResultadosUnBucle($resultados, $filtros)
{
	$array_filtrada = array();
	foreach ($resultados as $resultado) {
		if (aplicarFiltros($resultado, $filtros)) {
			$array_filtrada[] = $resultado;
		}
	}
	return $array_filtrada;
}

function filtrarResultadosDosBucles($resultados, $arrayFiltro, $nombreFiltro)
{
	$array_filtrada = array();
	foreach ($arrayFiltro as $filtro) {
		foreach ($resultados as $resultado) {
			if ($resultado[$nombreFiltro] == $filtro[$nombreFiltro]) {
				$array_filtrada[] = $resultado;
			}
		}
	}
	return $array_filtrada;
}


function aplicarFiltros($filaResultado, $filtros)
{
	foreach ($filtros as $filtro => $valor) {
		if ($filaResultado[$filtro] != $valor) {
			return false;
		}
	}
	return true;
}

function mediaCampo($input, $campo)
{
	$media = 0;
	foreach ($input as $fila) {
		$media += $fila[$campo];
	}
	return $media / count($input);
}

function filtraPorCondicion($condicion, $valorCampo, $nombreCampo, $arraySinFiltrar)
{
	$resultadoFiltrado = array();

	if ($condicion == "<") {
		foreach ($arraySinFiltrar as $fila) {
			if ($fila[$nombreCampo] < $valorCampo) {
				$resultadoFiltrado[] = $fila;
			}
		}
	} elseif ($condicion == ">") {
		foreach ($arraySinFiltrar as $fila) {
			if ($fila[$nombreCampo] > $valorCampo) {
				$resultadoFiltrado[] = $fila;
			}
		}
	} else {
		foreach ($arraySinFiltrar as $fila) {
			if ($fila[$nombreCampo] == $valorCampo) {
				$resultadoFiltrado[] = $fila;
			}
		}
	}
	return $resultadoFiltrado;
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

function filtrarCampos($inputArray, $arrayCamposMostrar)
{
	$outputArray = array();
	foreach ($inputArray as $fila) {
		$filaFiltrada = array();
		foreach ($arrayCamposMostrar as $campo) {
			$filaFiltrada[$campo] = $fila[$campo];
		}
		$outputArray[] = $filaFiltrada;
	}
	return $outputArray;
}

function agregaCampo($input, $campoAgregar, $campoUnion)
{
	$arrayFinal = array();
	foreach ($campoAgregar as $fila) {
		foreach ($input as $filaInicial) {
			if ($filaInicial[$campoUnion] == $fila[$campoUnion]) {
				$arrayFinal[] = array_merge($filaInicial, $fila);
			}
		}
	}
	return $arrayFinal;
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


