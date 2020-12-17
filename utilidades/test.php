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

function mediaSalario($listaSalarios)
{
	$media = 0;
	foreach ($listaSalarios as $salario) {
		$media += $salario["SALARIO"];
	}
	return $media / count($listaSalarios);
}

function filtraPorCampoMenor($valorCampo, $nombreCampo, $arraySinFiltrar)
{
	$resultadoFiltrado = array();
	foreach ($arraySinFiltrar as $fila) {
		if ($fila[$nombreCampo] < $valorCampo) {
			$resultadoFiltrado[] = $fila;
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
// $filtros = array("ESPECIALIDAD" => "LENGUA");
// $resultados = ejecutarConsulta("select * from PROFESORES");

// print_r(filtrarResultados($resultados, $filtros));
// // echo aplicarFiltros(array("ESPECIALIDAD" => "LENGUA"));

// print_r($resultados);
// $listaProfesores = ejecutarConsulta("select DNI, ESPECIALIDAD from PROFESORES");
//$especialidad = $_POST["especialidad"];
// $filtro = array("ESPECIALIDAD" => "INFORMÁTICA");
// $dniProfesoresEspecialidad = filtrarResultadosUnBucle($listaProfesores, $filtro);
// $listaPersonal = ejecutarConsulta("select APELLIDOS, SALARIO, DNI
// 																			from PERSONAL");
//print_r($listaPersonal[0]);
//print_r($dniProfesoresEspecialidad[0]["DNI"]);

// $listaNombresSalariosPorEspecialidad = filtrarResultadosDosBucles(
// 	$listaPersonal,
// 	$dniProfesoresEspecialidad,
// 	"DNI"
// );
// // 
//print_r($listaNombresSalariosPorEspecialidad);
