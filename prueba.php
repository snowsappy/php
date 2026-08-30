<?php
$semana = ["lunes","martes","miercoles","jueves","viernes","sabado"];
$lista_Empleados=[];
$empleado_especialidad=[];
$empleados=[];
$clientes=[["codigo"=>"","nombre"=>""]];
$agendamiento_cita=[["codigo_empleado"=>"","codigo_cliente"=>"","especialidad"=>"","hora"=>"","dia"=>""]];
function registrar_datos(){
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

function generar_total_empleado(){

 foreach($empleados as $empleado){
    $total=0;

    foreach($agendamiento_cita as $cita){

        foreach($cita["codigo_empleado"] as $posicion=>$codigo){

            if($empleado["cedula"]==$codigo){

                $especialidad=$cita["especialidad"][$posicion];

                $posicion_especialidad=array_search($especialidad,$empleado["especialidad"]);

                if($posicion_especialidad!==false){
                    $total=$total+$empleado["precio"][$posicion_especialidad];
                }
            }
        }
    }

    echo "Empleado: ".$empleado["nombre"]." | Total generado: $".$total."\n";
 }

}
function agregar_empleado(int $p_cedula,array &$empleados,array $p_empleado_especialidad,string $p_nombre){

	$empleados[] = ["cedula"=>$p_cedula,"nombre" => $p_nombre, "especialidad" => $p_empleado_especialidad];

}
function agendar_cita (array &$agendamiento_cita,int $p_codigo_empleado,int $p_codigo_cliente,string $p_especialidad,string $p_dia,string $p_hora){

	$agendamiento_cita[]=["codigo_empleado"=>$p_codigo_empleado,"codigo_cliente"=>$p_codigo_cliente,"servicios"=>$p_especialidad,"dia"=>$p_hora,"hora"=>$p_dia];

}
function recorrer (array $empleados ,string $p_tipo_especialidad){
       echo "empleados especializados en esta especialidad: \n ";
       $empleado_lista=[];
       $cont=0;
       foreach ($empleados as $item){
			$lista=$item["especialidad"];
			foreach ($lista as $emple){
 				$cont=$cont+1;
				if ($p_tipo_especialidad==$emple){
					echo $cont ." \n  nombre: " .$item["nombre"] ."\n";
					$p=array_column($empleados,"cedula");
					$posicion=array_search($emple,$empleados);
					$empleado_lista[]= $item["cedula"];
            
			}      }
	}

	
			return $empleado_lista;
		

}
function ver_citas_por_dia(array $agendamiento_cita,string $p_dia){
    echo "\n citas del dia: ".$p_dia."\n";
    $cont=0;

    foreach($agendamiento_cita as $cita){

        foreach($cita["dia"] as $posicion=>$dia){

            if($dia==$p_dia){

                $cont++;

                echo "\ncita ".$cont;
                echo "\ncliente: ".$cita["codigo_cliente"];
                echo "\nempleado: ".$cita["codigo_empleado"][$posicion];
                echo "\nespecialidad: ".$cita["especialidad"][$posicion];
                echo "\nhora: ".$cita["hora"][$posicion]."\n";
            }
        }
    }

    if($cont==0){
        echo "\nno hay citas agendadas para este dia.\n";
    }
}
while (true){

	$opcion=readline("bienvenido a ADSO SPA\n 1. Registrar empleado \n 2. Registrar cita \n 3. Total facturado por empleado \n 4. Servicio más solicitado \n 5. Agenda de un día 
	\n 6. deteccion de conflictos \n 7. Liquidacion de comisiones \n 8. Salir ");
	switch($opcion){
		case "dp":
		   registrar_datos();
		  
		   break;
		case 1:
			while (true){
				$especialidad=[];
				echo "bienvenido al registro de empleado empleado";
		   		$nombre=readline("ingrese el nombre del empleado a registrar(x para salir): ");
				
				if($nombre=="x" ){
					break;
				}else{
					$cedula=readline("ingrese la cedula del empleado a registrar: ");
					print("aqui va el registro \n ");
					while (true){
						
						echo "digite la especialidad del empleado \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5. masoterapeuta \n 6. Esteticista corporal \n 7.cosmetóloga \n ";
						$especialidad=readline();
						switch($especialidad){
							case 1:
								$especialidad="manicurista";
								break;
							case 2:
								$especialidad="esteticista(limpiadora facial)";
								break;
							case 3:
								$especialidad="pedicurista";
								break;
							case 4:
								$especialidad="masajista";
								break;
							case 5:
								$especialidad="masoterapeuta";
								break;
							case 6:
								$especialidad="Esteticista corporal";
								break;
							case 7:
								$especialidad="cosmetóloga";
								break;
						}
						
						$empleado_especialidad[]=$especialidad;
					        
						echo "desea agregar otra especialidad";
						$especialidad=readline();
						if($especialidad=="no"){
							agregar_empleado($cedula,$empleados,$empleado_especialidad,$nombre);
							$empleado_especialidad=[];
							print_r($empleados);
							break;
				        }	
						}
				}
			}
			break;
		case 2:
			while (true){
				echo "REGISTRO DE CITAS \n";
				$emple_temporal=[];
				$servicio_temporal=[];
				$hora_temporal=[];
				$cliente=readline("\n digite el nombre de cliente que desea registrar(x para salir): ");
				if ($cliente=="x" || trim($cliente) == ''){
					break;
				}else{
					$cedula=readline("\n digite la cedula del cliente a registrar: \n");
					while (true){
						$tipo_especialidad=readline("\n servicios disponibles \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5. masoterapeuta \n 6.steticista corporal  \n 7.cosmetóloga \ 8.salir \n> ");
						switch($tipo_especialidad){
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
							default:
								
								echo "opcion invalida";
						
                                                }
						if ($tipo_especialidad==8 && !$es_empleado_asignado==false){
							
							break;

						}else{
							echo "seleccione un empleado";
							}
							while (true){
								if (!empty($lista_empleado)){
									$seleccionado_empleado=readline(" \n ingrese el empleado a asignar de la lista: \n ");
									$conversion=$seleccionado_empleado -1;
									
									if(in_array($lista_empleado[$conversion] ?? "opcion invalida" ,$lista_empleado )){
								        
										$conversion=$seleccionado_empleado - 1;
										$es_empleado =$lista_empleado[$conversion];
										echo " \n empleado seleccionado".$conversion;
									
										if ($es_empleado == false){

                                                                        		echo "\n ese empleado no pertenece a la especialidad seleccionada\n";

										}else{ break; }
						                	}else{
										echo "opcion invalida";
									
									      }
								
									
								}else{
									echo " \n no hay emplados asignados a este servicio \n";
									break;
								}
								
							}

						        
						}
						while(true){
							$dia=readline("ingrese el dia de la semana en que desea la cita: ");
							if (in_array($dia,$semana)){
								break;
								
							}elseif ($dia=="domingo"){
								echo "los domingos no trabajamos";
							}else{
								echo "dia inexistente";
							}
						}
						while (true){
							$hora=readline("ingrese la hora de la cita en formato(HH:MM): ");
							if ($hora <="07:00" && $hora >="18:00"){
								echo "cita invalida";
							}else{
								break;
							}
						}
						$servicio_temporal[]=$tipo_especialidad;
						$emple_temporal[]=$buscar;
						$dia_temporal[]=$dia;
						$hora_temporal[]=$hora;
						
					}
				 agendar_cita($agendamiento_cita,$cliente,$emple_temporal,$servicio_temporal,$dia_temporal,$hora_temporal);
				 print_r($agendamiento_cita);
				}
           case 5:
		while(true){
			$dia=readline("\n ingrese el dia para ver las citas(x para salir): \n");
			ver_citas_por_dia($agendamiento_cita,$dia);
			if($dia=="x"){
		
			
				break;
			}else if(in_array($dia,$semana)){

				ver_citas_por_dia($agendamiento_cita,$dia);
			
			}
			
			
		
		}
		break;
	if ($opcion==8){
		break;
		
	}

}

