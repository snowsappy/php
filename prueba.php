<?php
$semana = ["lunes","martes","miercoles","jueves","viernes","sabado"];
$lista_Empleados=[];
$empleado_especialidad=[];
$empleados=[];
$clientes=[["codigo"=>"","nombre"=>""]];
$agendamiento_cita=[["codigo_empleado"=>"","codigo_cliente"=>"","especialidad"=>"","hora"=>"","dia"=>""]];
$esactivo=false;
function registrar_datos(array &$empleados ,array &$clientes ,array &$agendamiento_cita){
    
    $empleados=[
        ["cedula"=>1001,"nombre"=>"Ana","especialidad"=>["manicurista","esteticista(limpiadora facial)","masajista"],"precio"=>[30000,45000,50000]],
        ["cedula"=>1002,"nombre"=>"Juan","especialidad"=>["masoterapeuta","fisioterapeuta"],"precio"=>[60000,70000]],
        ["cedula"=>1003,"nombre"=>"Sofia","especialidad"=>["esteticista(limpiadora facial)","cosmetóloga"],"precio"=>[45000,65000]],
        ["cedula"=>1004,"nombre"=>"Pedro","especialidad"=>["pedicurista","masajista"],"precio"=>[40000,50000]],
        ["cedula"=>1005,"nombre"=>"Camila","especialidad"=>["manicurista","masoterapeuta"],"precio"=>[30000,60000]],
        ["cedula"=>1006,"nombre"=>"Carlos","especialidad"=>["esteticista(limpiadora facial)","masajista","cosmetóloga"],"precio"=>[45000,50000,65000]],
        ["cedula"=>1007,"nombre"=>"Laura","especialidad"=>["pedicurista","esteticista(limpiadora facial)"],"precio"=>[40000,45000]],
        ["cedula"=>1008,"nombre"=>"Daniel","especialidad"=>["masoterapeuta","masajista","fisioterapeuta"],"precio"=>[60000,50000,70000]]
    ];

    $clientes=[
        ["codigo"=>1,"nombre"=>"Maria"],
        ["codigo"=>2,"nombre"=>"Luis"],
        ["codigo"=>3,"nombre"=>"Valentina"],
        ["codigo"=>4,"nombre"=>"Andres"],
        ["codigo"=>5,"nombre"=>"Isabella"],
        ["codigo"=>6,"nombre"=>"Miguel"],
        ["codigo"=>7,"nombre"=>"Daniela"],
        ["codigo"=>8,"nombre"=>"Jorge"],
        ["codigo"=>9,"nombre"=>"Carolina"],
        ["codigo"=>10,"nombre"=>"Santiago"]
    ];

    $agendamiento_cita=[
        ["codigo_empleado"=>[1001,1002,1004],"codigo_cliente"=>1,"especialidad"=>["manicurista","masoterapeuta","pedicurista"],"hora"=>["08:00","09:00","11:00"],"dia"=>["lunes","lunes","martes"]],
        ["codigo_empleado"=>[1003,1006],"codigo_cliente"=>2,"especialidad"=>["esteticista(limpiadora facial)","masajista"],"hora"=>["10:00","14:00"],"dia"=>["lunes","miercoles"]],
        ["codigo_empleado"=>[1005],"codigo_cliente"=>3,"especialidad"=>["manicurista"],"hora"=>["09:00"],"dia"=>["martes"]],
        ["codigo_empleado"=>[1008,1002],"codigo_cliente"=>4,"especialidad"=>["fisioterapeuta","masoterapeuta"],"hora"=>["08:00","10:00"],"dia"=>["miercoles","miercoles"]],
        ["codigo_empleado"=>[1007,1003,1006],"codigo_cliente"=>5,"especialidad"=>["pedicurista","cosmetóloga","esteticista(limpiadora facial)"],"hora"=>["09:00","11:00","15:00"],"dia"=>["jueves","jueves","viernes"]],
        ["codigo_empleado"=>[1004,1001],"codigo_cliente"=>6,"especialidad"=>["masajista","esteticista(limpiadora facial)"],"hora"=>["08:00","10:00"],"dia"=>["viernes","viernes"]],
        ["codigo_empleado"=>[1005,1008],"codigo_cliente"=>7,"especialidad"=>["masoterapeuta","masajista"],"hora"=>["09:00","11:00"],"dia"=>["sabado","sabado"]],
        ["codigo_empleado"=>[1007],"codigo_cliente"=>8,"especialidad"=>["esteticista(limpiadora facial)"],"hora"=>["14:00"],"dia"=>["lunes"]],
        ["codigo_empleado"=>[1003,1004],"codigo_cliente"=>9,"especialidad"=>["cosmetóloga","pedicurista"],"hora"=>["10:00","12:00"],"dia"=>["martes","martes"]],
        ["codigo_empleado"=>[1006,1002,1008],"codigo_cliente"=>10,"especialidad"=>["cosmetóloga","fisioterapeuta","masoterapeuta"],"hora"=>["08:00","10:00","14:00"],"dia"=>["miercoles","jueves","jueves"]]
    ];
}

function generar_total_empleado(array &$empleados,array &$agendamiento_cita){
    
    foreach($empleados as $empleado){
        $total=0;
        foreach($agendamiento_cita as $cita){
            if(isset($cita["codigo_empleado"]) && is_array($cita["codigo_empleado"])){
                foreach($cita["codigo_empleado"] as $posicion=>$codigo){
                    if($empleado["cedula"]==$codigo){
                        $especialidad=$cita["especialidad"][$posicion];
                        $posicion_especialidad=array_search($especialidad,$empleado["especialidad"]);
                        if($posicion_especialidad!==false && isset($empleado["precio"][$posicion_especialidad])){
                            $total=$total+$empleado["precio"][$posicion_especialidad];
                        }
                    }
                }
            }
        }
        echo "Empleado: ".$empleado["nombre"]." | Total generado: $".$total."\n";
    }
}

function agregar_empleado(int $p_cedula, array &$empleados, array $p_empleado_especialidad, string $p_nombre, array $p_precios = []){
    $empleados[] = ["cedula"=>$p_cedula,"nombre" => $p_nombre, "especialidad" => $p_empleado_especialidad, "precio" => $p_precios];
}

function agendar_cita(array &$agendamiento_cita, int $p_codigo_empleado, int $p_codigo_cliente, string $p_especialidad, string $p_dia, string $p_hora){
    $agendamiento_cita[]=["codigo_empleado"=>[$p_codigo_empleado],"codigo_cliente"=>$p_codigo_cliente,"especialidad"=>[$p_especialidad],"dia"=>[$p_dia],"hora"=>[$p_hora]
    ];
}

function recorrer(array &$empleados, string $p_tipo_especialidad){
    echo "Empleados especializados en esta especialidad: \n";
    $empleado_lista=[];
    $cont=0;
    foreach ($empleados as $item){
        $lista=$item["especialidad"];
        foreach ($lista as $emple){
            if ($p_tipo_especialidad==$emple){
                $cont=$cont+1;
                echo $cont ." \n  nombre: " .$item["nombre"] ."\n";
                $empleado_lista[]= $item["cedula"];
            }   
        }
    }
    return $empleado_lista;
}

function ver_citas_por_dia(array &$empleados, array &$clientes,array $agendamiento_cita, string $p_dia){
    
    echo "\ncitas del dia: " .$p_dia."\n";
    $cont=0;
    foreach($agendamiento_cita as $cita){
        if(isset($cita["dia"])) {
            foreach($cita["dia"] as $posicion=>$dia){
                if($dia==$p_dia){
                    $cont++;
                    
                    
                    $nombre_cliente = "";
                    foreach($clientes as $cliente){
                        if($cliente["codigo"] == $cita["codigo_cliente"]){
                            $nombre_cliente = $cliente["nombre"];
                            break;
                        }
                    }
                    $nombre_empleado = "";
                    foreach($empleados as $empleado){
                        if($empleado["cedula"] == $cita["codigo_empleado"][$posicion]){
                            $nombre_empleado = $empleado["nombre"];
                            break;
                        }
                    }
                    
                    
                    echo "\ncliente: " .$nombre_cliente;
                    echo "\nempleado: " .$nombre_empleado;
                    echo "\nespecialidad: " .$cita["especialidad"][$posicion];
                    echo "\nhora: " .$cita["hora"][$posicion]."\n";
                }
            }
        }
    }
    if($cont==0){
        echo "\nno hay citas agendadas para este dia.\n";
    }
}

while (true){
    $opcion = readline("bienvenido a ADSO SPA\n 1. registrar empleado \n 2. registrar cita \n 3. total facturado por empleado \n 4. servicio más solicitado \n 5. agenda de un día \n 6. deteccion de conflictos \n 7. Liquidacion de comisiones \n 8. Salir \n> ");
    
    switch($opcion){
        
        case "dp":
            if($esactivo){
            echo "los datos ya se cargaron";
            break;
            }
            registrar_datos($empleados, $clientes, $agendamiento_cita);
            echo "datos cargados correctamente\n";
            $esactivo=true;
            break;
            
        case 1:
            while (true){
                $empleado_especialidad=[];
                echo "\nbienvenido al registro de empleado\n";
                $nombre=readline("ingrese el nombre del empleado a registrar (x para salir): ");
                
                if($nombre=="x"){
                    break;
                } else {
                    $cedula=(int)readline("ingrese la cedula del empleado a registrar: ");
                    print("Aqui va el registro \n");
                    
                    while (true){
                        echo "Digite la especialidad del empleado \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5.masoterapeuta \n 6.Esteticista corporal \n 7.cosmetóloga \n> ";
                        $opcio=readline();
                        
                        switch($opcion){
                            case 1: $especialidad_elegida="manicurista"; break 2;
                            case 2: $especialidad_elegida="esteticista(limpiadora facial)"; break 2;
                            case 3: $especialidad_elegida="pedicurista"; break 2;
                            
                            case 4: $especialidad_elegida="masajista"; break 2;
                            case 5: $especialidad_elegida="masoterapeuta"; break 2;
                            case 6: $especialidad_elegida="Esteticista corporal"; break 2;
                            case 7: $especialidad_elegida="cosmetóloga"; break 2;
                            
                        }
                        
                        if(!empty($especialidad_elegida)){
                            $empleado_especialidad[]=$especialidad_elegida;
                            $precio=(int)readline("Ingrese el precio para esta especialidad: $");
                            $empleado_precio[]=$precio;
                        }
                            
                        $mas=readline("¿Desea agregar otra especialidad? (si/no): ");
                        if($mas=="no"){
                            agregar_empleado($cedula, $empleados, $empleado_especialidad, $nombre, $empleado_precio ?? []);
                            print_r($empleados);
                            break;
                        }   
                    }
                }
            }
            break;
            
        case 2:
            while (true){
                echo "\nREGISTRO DE CITAS \n";
                $cliente=readline("Digite el nombre del cliente que desea registrar (x para salir): ");
                if ($cliente=="x" ){
                    break;
                } else {
                    $cedula_cliente=readline("Digite la cedula del cliente a registrar: ");
                    $es_empleado = null;
                    $lista_empleado = [];
                    
                    while (true){
                        $opcion=readline("\nServicios disponibles \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5.masoterapeuta \n 6.Esteticista corporal \n 7.cosmetóloga \n 8.Salir \n> ");
                        
                        switch($opcion){
                            case 1:
                                $tipo_especialidad="manicurista";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 2:
                                $tipo_especialidad="esteticista(limpiadora facial)";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 3:
                                $tipo_especialidad="pedicurista";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 4:
                                $tipo_especialidad="masajista";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 5:
                                $tipo_especialidad="masoterapeuta";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 6:
                                $tipo_especialidad="Esteticista corporal";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 7:
                                $tipo_especialidad="cosmetóloga";
                                $lista_empleado=recorrer($empleados,$tipo_especialidad);
                                break;
                            case 8:
                                break 3;
                            default:
                                echo "Opcion invalida\n";
                                continue;
                        }
                        
                        if (!empty($lista_empleado)){
                            $seleccionado_empleado=readline("ingrese el número del empleado a asignar de la lista: ");
                            $conversion=$seleccionado_empleado - 1;
                            
                            if(isset($lista_empleado[$conversion])){
                                $es_empleado =$lista_empleado[$conversion];
                                echo "\nempleado seleccionado cédula: ".$es_empleado."\n";
                                break;
                            } else {
                                echo "ipción inválida\n";
                            }
                        } else {
                            echo "\nno hay empleados asignados a este servicio\n";
                            break 2;
                        }
                    }
                    
                    while(true){
                        $dia=readline("ingrese el dia de la semana en que desea la cita: ");
                        if (in_array($dia,$semana)){
                            break;
                        } elseif ($dia=="domingo"){
                            echo "Los domingos no trabajamos\n";
                        } else {
                            echo "día inexistente\n";
                        }
                    }
                    
                    while (true){
                        $hora=readline("ingrese la hora de la cita en formato (HH:MM): ");
                        if ($hora < "07:00" || $hora > "18:00"){
                            echo "el spa esta cerrado ah esa hora\n";
                        } else {
                            break;
                        }
                    }
                    
                    agendar_cita($agendamiento_cita, $es_empleado, $cedula_cliente, $tipo_especialidad, $dia, $hora);
                    echo "cita agendada con éxito:\n";
                    print_r($agendamiento_cita);
                    break;
                }
            }
            break;
            
        case 3:
            generar_total_empleado($empleados);
            break;
            
        case 5:
            while(true){
                $dia=readline("\ningrese el dia para ver las citas (x para salir): ");
                if($dia=="x"){
                    break;
                } else if(in_array($dia,$semana)){
                    ver_citas_por_dia($agendamiento_cita,$dia);
                } else {
                    echo "fía inválido\n";
                }
            }
            break;
            
        case 8:
            echo "Saliendo del sistema...\n";
            break ;
    }
}
?>
