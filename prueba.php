<?php

$semana = ["lunes", "martes", "miercoles", "jueves", "viernes", "sabado"];

$empleado_especialidad = [];
$empleados = [];
$clientes = [];
$agendamiento_cita = [];
$esactivo = false;

function registrar_datos(array &$empleados, array &$clientes, array &$agendamiento_cita)
{
    $empleados = [
        ["cedula" => 1001, "nombre" => "Ana", "especialidad" => ["manicurista", "esteticista(limpiadora facial)", "masajista"]],
        ["cedula" => 1002, "nombre" => "Juan", "especialidad" => ["masoterapeuta", "fisioterapeuta"]],
        ["cedula" => 1003, "nombre" => "Sofia", "especialidad" => ["esteticista(limpiadora facial)", "cosmetóloga"]],
        ["cedula" => 1004, "nombre" => "Pedro", "especialidad" => ["pedicurista", "masajista"]],
        ["cedula" => 1005, "nombre" => "Camila", "especialidad" => ["manicurista", "masoterapeuta"]],
        ["cedula" => 1006, "nombre" => "Carlos", "especialidad" => ["esteticista(limpiadora facial)", "masajista", "cosmetóloga"]],
        ["cedula" => 1007, "nombre" => "Laura", "especialidad" => ["pedicurista", "esteticista(limpiadora facial)"]],
        ["cedula" => 1008, "nombre" => "Daniel", "especialidad" => ["masoterapeuta", "masajista", "esteticista corporal"]]
    ];

    $clientes = [
        ["codigo" => 1, "nombre" => "Maria"],
        ["codigo" => 2, "nombre" => "Luis"],
        ["codigo" => 3, "nombre" => "Valentina"],
        ["codigo" => 4, "nombre" => "Andres"],
        ["codigo" => 5, "nombre" => "Isabella"],
        ["codigo" => 6, "nombre" => "Miguel"],
        ["codigo" => 7, "nombre" => "Daniela"],
        ["codigo" => 8, "nombre" => "Jorge"]
    ];

    $agendamiento_cita = [
        ["codigo_empleado" => [1001, 1002, 1004], "codigo_cliente" => 1, "especialidad" => ["manicurista", "masoterapeuta", "pedicurista"], "hora" => ["08:00", "09:00", "11:00"], "dia" => ["lunes", "lunes", "martes"], "precio" => [35000, 100000, 40000]],
        ["codigo_empleado" => [1003, 1006], "codigo_cliente" => 2, "especialidad" => ["esteticista(limpiadora facial)", "masajista"], "hora" => ["10:00", "14:00"], "dia" => ["lunes", "miercoles"], "precio" => [80000, 90000]],
        ["codigo_empleado" => [1005], "codigo_cliente" => 3, "especialidad" => ["manicurista"], "hora" => ["09:00"], "dia" => ["martes"], "precio" => [35000]],
        ["codigo_empleado" => [1008, 1002], "codigo_cliente" => 4, "especialidad" => ["esteticista corporal", "masoterapeuta"], "hora" => ["08:00", "10:00"], "dia" => ["miercoles", "miercoles"], "precio" => [60000, 100000]],
        ["codigo_empleado" => [1007, 1003, 1006], "codigo_cliente" => 5, "especialidad" => ["pedicurista", "cosmetóloga", "esteticista(limpiadora facial)"], "hora" => ["09:00", "11:00", "15:00"], "dia" => ["jueves", "jueves", "viernes"], "precio" => [40000, 120000, 80000]],
        ["codigo_empleado" => [1004, 1001], "codigo_cliente" => 6, "especialidad" => ["masajista", "esteticista(limpiadora facial)"], "hora" => ["08:00", "10:00"], "dia" => ["viernes", "viernes"], "precio" => [90000, 80000]],
        ["codigo_empleado" => [1005, 1008], "codigo_cliente" => 7, "especialidad" => ["masoterapeuta", "masajista"], "hora" => ["09:00", "11:00"], "dia" => ["sabado", "sabado"], "precio" => [100000, 90000]],
        ["codigo_empleado" => [1007], "codigo_cliente" => 8, "especialidad" => ["esteticista(limpiadora facial)"], "hora" => ["14:00"], "dia" => ["lunes"], "precio" => [80000]]
    ];
}


function obtener_duracion($especialidad)
{
    if ($especialidad == "esteticista(limpiadora facial)") {
        return 2;
    }

    if ($especialidad == "masoterapeuta") {
        return 2;
    }

    if ($especialidad == "esteticista corporal") {
        return 2;
    }

    return 1;
}




function buscar_nombre_empleado(array &$empleados, $cedula)
{
    foreach ($empleados as $empleado) {
        if ($empleado["cedula"] == $cedula) {
            return $empleado["nombre"];
        }
    }

    return "";
}




function buscar_nombre_cliente(array &$clientes, $codigo)
{
    foreach ($clientes as $cliente) {
        if ($cliente["codigo"] == $codigo) {
            return $cliente["nombre"];
        }
    }

    return "";
}




function generar_total_empleado(array &$empleados, array &$agendamiento_cita)
{
    foreach ($empleados as $empleado) {

        $total = 0;

        foreach ($agendamiento_cita as $cita) {

            $empleados_cita = is_array($cita["codigo_empleado"])
                ? $cita["codigo_empleado"]
                : [$cita["codigo_empleado"]];

            foreach ($empleados_cita as $posicion => $codigo) {

                if ($empleado["cedula"] == $codigo) {
                    $total += $cita["precio"][$posicion];
                }
            }
        }

        echo "Empleado: " . $empleado["nombre"];
        echo " | Total generado: $" . $total . "\n";
    }
}



function agregar_empleado(
    int $p_cedula,
    array &$empleados,
    array $p_empleado_especialidad,
    string $p_nombre
) {
    $empleados[] = [
        "cedula" => $p_cedula,
        "nombre" => $p_nombre,
        "especialidad" => $p_empleado_especialidad
    ];
}




function agendar_cita(
    array &$agendamiento_cita,
    int $p_codigo_empleado,
    int $p_codigo_cliente,
    string $p_especialidad,
    string $p_dia,
    string $p_hora,
    int $p_precio
) {
    $agendamiento_cita[] = [
        "codigo_empleado" => $p_codigo_empleado,
        "codigo_cliente" => $p_codigo_cliente,
        "especialidad" => $p_especialidad,
        "dia" => $p_dia,
        "hora" => $p_hora,
        "precio" => $p_precio
    ];
}




function recorrer(array &$empleados, string $p_tipo_especialidad)
{
    echo "\nEmpleados especializados en esta especialidad:\n";

    $empleado_lista = [];
    $cont = 0;

    foreach ($empleados as $item) {

        foreach ($item["especialidad"] as $emple) {

            if ($p_tipo_especialidad == $emple) {

                $cont++;

                echo $cont . ". Nombre: " . $item["nombre"] . "\n";
                echo "   Cedula: " . $item["cedula"] . "\n";

                $empleado_lista[] = $item["cedula"];

                break;
            }
        }
    }

    return $empleado_lista;
}



function mejor_servicio_solicitado(array &$agendamiento_cita)
{
    $servicios = [];

    foreach ($agendamiento_cita as $cita) {

        $especialidades = is_array($cita["especialidad"])
            ? $cita["especialidad"]
            : [$cita["especialidad"]];

        foreach ($especialidades as $servicio) {

            if (isset($servicios[$servicio])) {
                $servicios[$servicio]++;
            } else {
                $servicios[$servicio] = 1;
            }
        }
    }

    $mayor = 0;
    $servicio_mayor = "";

    foreach ($servicios as $servicio => $cantidad) {

        if ($cantidad > $mayor) {
            $mayor = $cantidad;
            $servicio_mayor = $servicio;
        }
    }

    if ($servicio_mayor == "") {
        echo "No hay servicios solicitados\n";
        return;
    }

    echo "\nServicio más solicitado: " . $servicio_mayor . "\n";
    echo "Veces solicitado: " . $mayor . "\n";
}



function ver_citas_por_dia(
    array &$empleados,
    array &$clientes,
    array $agendamiento_cita,
    string $p_dia
) {
    echo "\nCitas del día: " . $p_dia . "\n";

    $cont = 0;

    foreach ($agendamiento_cita as $cita) {

        $dias = is_array($cita["dia"])
            ? $cita["dia"]
            : [$cita["dia"]];

        foreach ($dias as $posicion => $dia) {

            if ($dia == $p_dia) {

                $cont++;

                $nombre_cliente = buscar_nombre_cliente(
                    $clientes,
                    $cita["codigo_cliente"]
                );

                $empleados_cita = is_array($cita["codigo_empleado"])
                    ? $cita["codigo_empleado"]
                    : [$cita["codigo_empleado"]];

                $cedula_emp = $empleados_cita[$posicion] ?? $empleados_cita[0];

                $nombre_empleado = buscar_nombre_empleado(
                    $empleados,
                    $cedula_emp
                );

                $especialidades_cita = is_array($cita["especialidad"])
                    ? $cita["especialidad"]
                    : [$cita["especialidad"]];

                $esp = $especialidades_cita[$posicion] ?? $especialidades_cita[0];

                $horas_cita = is_array($cita["hora"])
                    ? $cita["hora"]
                    : [$cita["hora"]];

                $hor = $horas_cita[$posicion] ?? $horas_cita[0];

                $duracion = obtener_duracion($esp);

                echo "\nCliente: " . $nombre_cliente;
                echo "\nEmpleado: " . $nombre_empleado;
                echo "\nEspecialidad: " . $esp;
                echo "\nHora: " . $hor;
                echo "\nDuración: " . $duracion . " hora(s)\n";
            }
        }
    }

    if ($cont == 0) {
        echo "\nNo hay citas agendadas para este día.\n";
    }
}



function tiene_conflicto(
    array &$agendamiento_cita,
    $empleado,
    $dia,
    $hora,
    $duracion,
    $posicion_ignorar = -1
) {
    $inicio_nueva = strtotime($hora);
    $fin_nueva = $inicio_nueva + ($duracion * 3600);

    foreach ($agendamiento_cita as $i => $cita) {

        if ($i == $posicion_ignorar) {
            continue;
        }

        $empleados_cita = is_array($cita["codigo_empleado"])
            ? $cita["codigo_empleado"]
            : [$cita["codigo_empleado"]];

        $dias_cita = is_array($cita["dia"])
            ? $cita["dia"]
            : [$cita["dia"]];

        $horas_cita = is_array($cita["hora"])
            ? $cita["hora"]
            : [$cita["hora"]];

        $especialidades_cita = is_array($cita["especialidad"])
            ? $cita["especialidad"]
            : [$cita["especialidad"]];

        foreach ($empleados_cita as $posicion => $codigo) {

            if ($codigo != $empleado) {
                continue;
            }

            if (($dias_cita[$posicion] ?? "") != $dia) {
                continue;
            }

            $hora_existente = $horas_cita[$posicion] ?? "";

            if ($hora_existente == "") {
                continue;
            }

            $especialidad_existente =
                $especialidades_cita[$posicion] ?? "";

            $duracion_existente =
                obtener_duracion($especialidad_existente);

            $inicio_existente = strtotime($hora_existente);

            $fin_existente =
                $inicio_existente + ($duracion_existente * 3600);



            if (
                $inicio_nueva < $fin_existente &&
                $inicio_existente < $fin_nueva
            ) {
                return true;
            }
        }
    }

    return false;
}



function detectar_conflicto_actual(
    array &$empleados,
    array &$clientes,
    array &$agendamiento_cita
) {
    foreach ($agendamiento_cita as $i => $cita1) {

        $empleados1 = is_array($cita1["codigo_empleado"])
            ? $cita1["codigo_empleado"]
            : [$cita1["codigo_empleado"]];

        $dias1 = is_array($cita1["dia"])
            ? $cita1["dia"]
            : [$cita1["dia"]];

        $horas1 = is_array($cita1["hora"])
            ? $cita1["hora"]
            : [$cita1["hora"]];

        $especialidades1 = is_array($cita1["especialidad"])
            ? $cita1["especialidad"]
            : [$cita1["especialidad"]];

        foreach ($empleados1 as $pos1 => $empleado1) {

            $dia1 = $dias1[$pos1] ?? "";
            $hora1 = $horas1[$pos1] ?? "";
            $esp1 = $especialidades1[$pos1] ?? "";

            $duracion1 = obtener_duracion($esp1);

            $inicio1 = strtotime($hora1);
            $fin1 = $inicio1 + ($duracion1 * 3600);

            foreach ($agendamiento_cita as $j => $cita2) {

                if ($i == $j) {
                    continue;
                }

                $empleados2 = is_array($cita2["codigo_empleado"])
                    ? $cita2["codigo_empleado"]
                    : [$cita2["codigo_empleado"]];

                $dias2 = is_array($cita2["dia"])
                    ? $cita2["dia"]
                    : [$cita2["dia"]];

                $horas2 = is_array($cita2["hora"])
                    ? $cita2["hora"]
                    : [$cita2["hora"]];

                $especialidades2 = is_array($cita2["especialidad"])
                    ? $cita2["especialidad"]
                    : [$cita2["especialidad"]];

                foreach ($empleados2 as $pos2 => $empleado2) {

                    if ($empleado1 != $empleado2) {
                        continue;
                    }

                    $dia2 = $dias2[$pos2] ?? "";
                    $hora2 = $horas2[$pos2] ?? "";
                    $esp2 = $especialidades2[$pos2] ?? "";

                    if ($dia1 != $dia2) {
                        continue;
                    }

                    $duracion2 = obtener_duracion($esp2);

                    $inicio2 = strtotime($hora2);
                    $fin2 = $inicio2 + ($duracion2 * 3600);

                    if (
                        $inicio1 < $fin2 &&
                        $inicio2 < $fin1
                    ) {
                        return [
                            "cita1" => $i,
                            "pos1" => $pos1,
                            "cita2" => $j,
                            "pos2" => $pos2
                        ];
                    }
                }
            }
        }
    }

    return null;
}




function reasignar_cita(
    array &$empleados,
    array &$agendamiento_cita,
    $posicion_cita,
    $posicion_servicio
) {
    $especialidades = is_array(
        $agendamiento_cita[$posicion_cita]["especialidad"]
    )
        ? $agendamiento_cita[$posicion_cita]["especialidad"]
        : [$agendamiento_cita[$posicion_cita]["especialidad"]];

    $dias = is_array(
        $agendamiento_cita[$posicion_cita]["dia"]
    )
        ? $agendamiento_cita[$posicion_cita]["dia"]
        : [$agendamiento_cita[$posicion_cita]["dia"]];

    $horas = is_array(
        $agendamiento_cita[$posicion_cita]["hora"]
    )
        ? $agendamiento_cita[$posicion_cita]["hora"]
        : [$agendamiento_cita[$posicion_cita]["hora"]];

    $especialidad = $especialidades[$posicion_servicio];
    $dia = $dias[$posicion_servicio];
    $hora = $horas[$posicion_servicio];

    $duracion = obtener_duracion($especialidad);

    echo "\nEspecialidad que se va a reasignar: " . $especialidad . "\n";
    echo "Día: " . $dia . "\n";
    echo "Hora: " . $hora . "\n";

    $disponibles = [];

    foreach ($empleados as $empleado) {

        $tiene_especialidad = false;

        foreach ($empleado["especialidad"] as $especialidad_empleado) {

            if ($especialidad_empleado == $especialidad) {
                $tiene_especialidad = true;
                break;
            }
        }

        if (!$tiene_especialidad) {
            continue;
        }

        $esta_ocupado = tiene_conflicto(
            $agendamiento_cita,
            $empleado["cedula"],
            $dia,
            $hora,
            $duracion,
            $posicion_cita
        );

        if (!$esta_ocupado) {
            $disponibles[] = $empleado["cedula"];
        }
    }

    if (empty($disponibles)) {
        echo "\nNo hay otros empleados disponibles para reasignar esta cita.\n";
        return false;
    }

    echo "\nEmpleados disponibles para reasignar:\n";

    foreach ($disponibles as $posicion => $cedula) {

        $nombre = buscar_nombre_empleado($empleados, $cedula);

        echo ($posicion + 1) . ". ";
        echo $nombre . " - Cedula: " . $cedula . "\n";
    }

    while (true) {

        $seleccion = trim(
            readline("Seleccione el nuevo empleado: ")
        );

        if ($seleccion == "") {
            echo "No puede dejar el campo vacío.\n";
            continue;
        }

        $indice = (int)$seleccion - 1;

        if (isset($disponibles[$indice])) {

            $nuevo_empleado = $disponibles[$indice];

            if (is_array(
                $agendamiento_cita[$posicion_cita]["codigo_empleado"]
            )) {

                $agendamiento_cita[$posicion_cita]["codigo_empleado"]
                    [$posicion_servicio] = $nuevo_empleado;

            } else {

                $agendamiento_cita[$posicion_cita]["codigo_empleado"]
                    = $nuevo_empleado;
            }

            $nombre_nuevo =
                buscar_nombre_empleado(
                    $empleados,
                    $nuevo_empleado
                );

            echo "\nCita reasignada correctamente.\n";
            echo "Nuevo empleado: " . $nombre_nuevo . "\n";

            return true;
        }

        echo "Opción inválida.\n";
    }
}




function resolver_conflictos(
    array &$empleados,
    array &$clientes,
    array &$agendamiento_cita
) {
    echo "\n====================================\n";
    echo "      DETECCIÓN DE CONFLICTOS\n";
    echo "====================================\n";

    while (true) {

        $conflicto = detectar_conflicto_actual(
            $empleados,
            $clientes,
            $agendamiento_cita
        );

        if ($conflicto == null) {

            echo "\nNo existen conflictos de horarios.\n";
            break;
        }

        $i = $conflicto["cita1"];
        $pos1 = $conflicto["pos1"];

        $j = $conflicto["cita2"];
        $pos2 = $conflicto["pos2"];

        $empleados1 = is_array(
            $agendamiento_cita[$i]["codigo_empleado"]
        )
            ? $agendamiento_cita[$i]["codigo_empleado"]
            : [$agendamiento_cita[$i]["codigo_empleado"]];

        $empleados2 = is_array(
            $agendamiento_cita[$j]["codigo_empleado"]
        )
            ? $agendamiento_cita[$j]["codigo_empleado"]
            : [$agendamiento_cita[$j]["codigo_empleado"]];

        $dias1 = is_array(
            $agendamiento_cita[$i]["dia"]
        )
            ? $agendamiento_cita[$i]["dia"]
            : [$agendamiento_cita[$i]["dia"]];

        $dias2 = is_array(
            $agendamiento_cita[$j]["dia"]
        )
            ? $agendamiento_cita[$j]["dia"]
            : [$agendamiento_cita[$j]["dia"]];

        $horas1 = is_array(
            $agendamiento_cita[$i]["hora"]
        )
            ? $agendamiento_cita[$i]["hora"]
            : [$agendamiento_cita[$i]["hora"]];

        $horas2 = is_array(
            $agendamiento_cita[$j]["hora"]
        )
            ? $agendamiento_cita[$j]["hora"]
            : [$agendamiento_cita[$j]["hora"]];

        $esp1 = is_array(
            $agendamiento_cita[$i]["especialidad"]
        )
            ? $agendamiento_cita[$i]["especialidad"]
            : [$agendamiento_cita[$i]["especialidad"]];

        $esp2 = is_array(
            $agendamiento_cita[$j]["especialidad"]
        )
            ? $agendamiento_cita[$j]["especialidad"]
            : [$agendamiento_cita[$j]["especialidad"]];

        $cliente1 = buscar_nombre_cliente(
            $clientes,
            $agendamiento_cita[$i]["codigo_cliente"]
        );

        $cliente2 = buscar_nombre_cliente(
            $clientes,
            $agendamiento_cita[$j]["codigo_cliente"]
        );

        $nombre_empleado =
            buscar_nombre_empleado(
                $empleados,
                $empleados1[$pos1]
            );

        echo "\n------------------------------------\n";
        echo "CONFLICTO ENCONTRADO\n";
        echo "------------------------------------\n";

        echo "\nEmpleado: " . $nombre_empleado;

        echo "\n\nCita 1:";
        echo "\nCliente: " . $cliente1;
        echo "\nServicio: " . $esp1[$pos1];
        echo "\nDía: " . $dias1[$pos1];
        echo "\nHora: " . $horas1[$pos1];
        echo "\nDuración: " .
            obtener_duracion($esp1[$pos1]) .
            " hora(s)\n";

        echo "\nCita 2:";
        echo "\nCliente: " . $cliente2;
        echo "\nServicio: " . $esp2[$pos2];
        echo "\nDía: " . $dias2[$pos2];
        echo "\nHora: " . $horas2[$pos2];
        echo "\nDuración: " .
            obtener_duracion($esp2[$pos2]) .
            " hora(s)\n";

        $respuesta = strtolower(
            trim(
                readline("\n¿Desea reasignar una cita? (si/no): ")
            )
        );

        if ($respuesta == "no") {
            echo "\nEl conflicto no fue resuelto.\n";
            break;
        }

        if ($respuesta == "si") {

            echo "\n¿Cuál cita desea reasignar?\n";
            echo "1. Cita de " . $cliente1 . "\n";
            echo "2. Cita de " . $cliente2 . "\n";

            $seleccion = trim(
                readline("Seleccione: ")
            );

            if ($seleccion == "1") {

                reasignar_cita(
                    $empleados,
                    $agendamiento_cita,
                    $i,
                    $pos1
                );

            } elseif ($seleccion == "2") {

                reasignar_cita(
                    $empleados,
                    $agendamiento_cita,
                    $j,
                    $pos2
                );

            } else {
                echo "\nOpción inválida.\n";
            }

        } else {

            echo "\nDebe escribir si o no.\n";
        }
    }
}



function generar_comisiones(
    array &$empleados,
    array &$agendamiento_cita
) {
    $mayor_facturacion = 0;
    $empleado_mayor = "";

 

    foreach ($empleados as $empleado) {

        $total = 0;

        foreach ($agendamiento_cita as $cita) {

            $empleados_cita = is_array(
                $cita["codigo_empleado"]
            )
                ? $cita["codigo_empleado"]
                : [$cita["codigo_empleado"]];

            foreach ($empleados_cita as $posicion => $codigo) {

                if ($empleado["cedula"] == $codigo) {

                    $total += $cita["precio"][$posicion];
                }
            }
        }

        if ($total > $mayor_facturacion) {

            $mayor_facturacion = $total;
            $empleado_mayor = $empleado["nombre"];
        }
    }



    foreach ($empleados as $empleado) {

        $total = 0;
        $cantidad_citas = 0;

        foreach ($agendamiento_cita as $cita) {

            $empleados_cita = is_array(
                $cita["codigo_empleado"]
            )
                ? $cita["codigo_empleado"]
                : [$cita["codigo_empleado"]];

            foreach ($empleados_cita as $posicion => $codigo) {

                if ($empleado["cedula"] == $codigo) {

                    $total += $cita["precio"][$posicion];

                    $cantidad_citas++;
                }
            }
        }


      

        if ($cantidad_citas >= 6) {
            $porcentaje = 0.12;
        } else {
            $porcentaje = 0.08;
        }

        $comision = $total * $porcentaje;


    

        $bono = 0;

        if ($empleado["nombre"] == $empleado_mayor) {
            $bono = 50000;
        }

        $total_recibir = $comision + $bono;


        echo "\n====================================\n";
        echo "Empleado: " . $empleado["nombre"] . "\n";
        echo "Citas atendidas: " . $cantidad_citas . "\n";
        echo "Total facturado: $" . $total . "\n";
        echo "Porcentaje: " . ($porcentaje * 100) . "%\n";
        echo "Comisión: $" . $comision . "\n";
        echo "Bono: $" . $bono . "\n";
        echo "Total a recibir: $" . $total_recibir . "\n";
    }

    echo "\n====================================\n";
    echo "Empleado con mayor facturación: ";
    echo $empleado_mayor . "\n";

    echo "Facturación mayor: $";
    echo $mayor_facturacion . "\n";
}



while (true) {

    $opcion = trim(
        readline(
            "\n====================================\n" .
            "       BIENVENIDO AL SISTEMA\n" .
            "====================================\n" .
            "1. Registrar empleado\n" .
            "2. Registrar cita\n" .
            "3. Total facturado por empleado\n" .
            "4. Servicio más solicitado\n" .
            "5. Agenda de un día\n" .
            "6. Detección de conflictos\n" .
            "7. Liquidación de comisiones\n" .
            "8. Salir\n" .
            "> "
        )
    );


    if ($opcion == "") {

        echo "\nPor favor ingrese algo.\n";
        continue;
    }


    switch ($opcion) {


   

        case "dp":

            if ($esactivo) {

                echo "\nLos datos ya se cargaron.\n";
                break;
            }

            registrar_datos(
                $empleados,
                $clientes,
                $agendamiento_cita
            );

            echo "\nDatos cargados correctamente.\n";

            $esactivo = true;

            break;


    

        case "1":

            while (true) {

                $empleado_especialidad = [];

                echo "\n====================================\n";
                echo "       REGISTRO DE EMPLEADO\n";
                echo "====================================\n";

                $nombre = trim(
                    readline(
                        "Ingrese el nombre del empleado (x para salir): "
                    )
                );

                if ($nombre == "") {

                    echo "\nPor favor ingrese algo.\n";
                    continue;
                }

                if ($nombre == "x") {
                    break;
                }


                $cedula = (int)trim(
                    readline(
                        "Ingrese la cedula del empleado: "
                    )
                );

                if ($cedula == 0) {

                    echo "\nLa cedula no puede estar vacía.\n";
                    continue;
                }


                while (true) {

                    echo "\nDigite la especialidad:\n";
                    echo "1. Manicurista - 1 hora\n";
                    echo "2. Esteticista (limpiadora facial) - 2 horas\n";
                    echo "3. Pedicurista - 1 hora\n";
                    echo "4. Masajista - 1 hora\n";
                    echo "5. Masoterapeuta - 2 horas\n";
                    echo "6. Esteticista corporal - 2 horas\n";
                    echo "7. Cosmetóloga - 1 hora\n";

                    $opcion_esp = trim(
                        readline("> ")
                    );


                    switch ($opcion_esp) {

                        case "1":
                            $especialidad_elegida = "manicurista";
                            break;

                        case "2":
                            $especialidad_elegida =
                                "esteticista(limpiadora facial)";
                            break;

                        case "3":
                            $especialidad_elegida = "pedicurista";
                            break;

                        case "4":
                            $especialidad_elegida = "masajista";
                            break;

                        case "5":
                            $especialidad_elegida = "masoterapeuta";
                            break;

                        case "6":
                            $especialidad_elegida =
                                "esteticista corporal";
                            break;

                        case "7":
                            $especialidad_elegida = "cosmetóloga";
                            break;

                        default:

                            echo "\nOpción inválida.\n";
                            continue 2;
                    }


                    $empleado_especialidad[] =
                        $especialidad_elegida;


                    $mas = strtolower(
                        trim(
                            readline(
                                "¿Desea agregar otra especialidad? (si/no): "
                            )
                        )
                    );


                    if ($mas == "no") {

                        agregar_empleado(
                            $cedula,
                            $empleados,
                            $empleado_especialidad,
                            $nombre
                        );

                        echo "\nEmpleado registrado correctamente.\n";

                        break 2;
                    }

                    if ($mas != "si") {

                        echo "\nDebe escribir si o no.\n";
                    }
                }
            }

            break;


    

        case "2":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            while (true) {

                echo "\n====================================\n";
                echo "          REGISTRO DE CITA\n";
                echo "====================================\n";

                $cliente = trim(
                    readline(
                        "Digite el nombre del cliente (x para salir): "
                    )
                );

                if ($cliente == "x") {
                    break;
                }

                if ($cliente == "") {

                    echo "\nNo puede dejar datos vacíos.\n";
                    continue;
                }


                $cedula_cliente = trim(
                    readline(
                        "Digite el código del cliente: "
                    )
                );

                if ($cedula_cliente == "") {

                    echo "\nNo puede dejar datos vacíos.\n";
                    continue;
                }


                $opcion_servicio = trim(
                    readline(
                        "\nServicios disponibles\n" .
                        "1. Manicurista - $35.000 - 1 hora\n" .
                        "2. Esteticista (limpiadora facial) - $80.000 - 2 horas\n" .
                        "3. Pedicurista - $40.000 - 1 hora\n" .
                        "4. Masajista - $90.000 - 1 hora\n" .
                        "5. Masoterapeuta - $100.000 - 2 horas\n" .
                        "6. Esteticista corporal - $60.000 - 2 horas\n" .
                        "7. Cosmetóloga - $120.000 - 1 hora\n" .
                        "> "
                    )
                );


                switch ($opcion_servicio) {

                    case "1":
                        $tipo_especialidad = "manicurista";
                        $precio = 35000;
                        break;

                    case "2":
                        $tipo_especialidad =
                            "esteticista(limpiadora facial)";
                        $precio = 80000;
                        break;

                    case "3":
                        $tipo_especialidad = "pedicurista";
                        $precio = 40000;
                        break;

                    case "4":
                        $tipo_especialidad = "masajista";
                        $precio = 90000;
                        break;

                    case "5":
                        $tipo_especialidad = "masoterapeuta";
                        $precio = 100000;
                        break;

                    case "6":
                        $tipo_especialidad =
                            "esteticista corporal";
                        $precio = 60000;
                        break;

                    case "7":
                        $tipo_especialidad = "cosmetóloga";
                        $precio = 120000;
                        break;

                    default:

                        echo "\nOpción inválida.\n";
                        continue 2;
                }


                $lista_empleado =
                    recorrer(
                        $empleados,
                        $tipo_especialidad
                    );


                if (empty($lista_empleado)) {

                    echo "\nNo hay empleados para este servicio.\n";
                    continue;
                }


                while (true) {

                    $seleccionado_empleado = trim(
                        readline(
                            "Ingrese el número del empleado: "
                        )
                    );

                    $conversion =
                        (int)$seleccionado_empleado - 1;


                    if (isset($lista_empleado[$conversion])) {

                        $es_empleado =
                            $lista_empleado[$conversion];

                        echo "\nEmpleado seleccionado: ";
                        echo buscar_nombre_empleado(
                            $empleados,
                            $es_empleado
                        );
                        echo "\n";

                        break;
                    }

                    echo "\nOpción inválida.\n";
                }


                while (true) {

                    $dia = strtolower(
                        trim(
                            readline(
                                "Ingrese el día: "
                            )
                        )
                    );

                    if (in_array($dia, $semana)) {
                        break;
                    }

                    echo "\nDía inválido.\n";
                }


                $hora = trim(
                    readline(
                        "Ingrese la hora (HH:MM): "
                    )
                );


                $duracion =
                    obtener_duracion($tipo_especialidad);


            

                if (
                    tiene_conflicto(
                        $agendamiento_cita,
                        $es_empleado,
                        $dia,
                        $hora,
                        $duracion
                    )
                ) {

                    echo "\n====================================\n";
                    echo "ERROR: EL EMPLEADO YA TIENE UNA CITA\n";
                    echo "EN ESE RANGO DE HORARIO.\n";
                    echo "====================================\n";

                    continue;
                }


                agendar_cita(
                    $agendamiento_cita,
                    $es_empleado,
                    (int)$cedula_cliente,
                    $tipo_especialidad,
                    $dia,
                    $hora,
                    $precio
                );


                echo "\nCita registrada correctamente.\n";
                echo "Cliente: " . $cliente . "\n";
                echo "Empleado: " .
                    buscar_nombre_empleado(
                        $empleados,
                        $es_empleado
                    ) . "\n";

                echo "Servicio: " .
                    $tipo_especialidad . "\n";

                echo "Día: " . $dia . "\n";
                echo "Hora: " . $hora . "\n";
                echo "Precio: $" . $precio . "\n";

                break;
            }

            break;



        case "3":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            generar_total_empleado(
                $empleados,
                $agendamiento_cita
            );

            break;


     

        case "4":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            mejor_servicio_solicitado(
                $agendamiento_cita
            );

            break;


  

        case "5":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            while (true) {

                $dia = strtolower(
                    trim(
                        readline(
                            "\nIngrese el día para ver las citas (x para salir): "
                        )
                    )
                );

                if ($dia == "x") {
                    break;
                }

                if (in_array($dia, $semana)) {

                    ver_citas_por_dia(
                        $empleados,
                        $clientes,
                        $agendamiento_cita,
                        $dia
                    );

                } else {

                    echo "\nDía inválido.\n";
                }
            }

            break;


   

        case "6":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            resolver_conflictos(
                $empleados,
                $clientes,
                $agendamiento_cita
            );

            break;


      

        case "7":

            if (!$esactivo) {

                echo "\nPrimero debe cargar los datos escribiendo dp.\n";
                break;
            }

            generar_comisiones(
                $empleados,
                $agendamiento_cita
            );

            break;


      

        case "8":

            echo "\nSaliendo del sistema...\n";
            exit;


        

        default:

            echo "\nOpción inválida.\n";
            break;
    }
}
?>