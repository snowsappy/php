<?php
$lista_Empleados=[];
$empleado_especialidad=[];
$empleados=[];
$clientes=[["codigo"=>"","nombre"=>""]];
$agendamiento_cita=[["codigo_empleado"=>"","codigo_cliente"=>"","especialidad"=>"","hora"=>"","dia"=>""]];
function agregar_empleado(int $p_cedula,array &$empleados,array $p_empleado_especialidad,string $p_nombre){

	$empleados[] = ["cedula"=>$p_cedula,"nombre" => $p_nombre, "especialidad" => $p_empleado_especialidad];

}
function agendar_cita (array &$agendamiento_cita,int $p_codigo_empleado,int $p_codigo_cliente,string $p_especialidad,string $p_dia,string $p_hora){

	$agendamiento_cita[]=["codigo_empleado"=>$p_codigo_empleado,"codigo_cliente"=>$p_codigo_cliente,"servicios"=>$p_especialidad,"dia"=>$p_hora,"hora"=>$p_dia];

}
function recorrer (array $empleados ,string $p_tipo_especialidad){
       echo "empleados especializados en esta especialidad \n ";
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
		print_r($empleado_lista);
	}	return $empleado_lista;

}

while (true){

	$opcion=readline("bienvenido a ADSO SPA\n 1. Registrar empleado \n 2. Registrar cita \n 3. Total facturado por empleado \n 4. Servicio más solicitado \n 5. Agenda de un día 
	\n 6. deteccion de conflictos \n 7. Liquidacion de comisiones \n 8. Salir ");
	switch($opcion){
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
				$cliente=readline("digite el nombre de cliente que desea registrar:(x para salir) ");
				if ($cliente=="x" || trim($cliente) == ''){
					break;
				}else{
					$cedula=readline("digite la cedula del cliente a registrar: ");
					while (true){
						$tipo_especialidad=readline("\n especialidades disponibles \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5. masoterapeuta \n 6.steticista corporal  \n 7.cosmetóloga \ 8.salir \n> ");
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
						
                                                }
						if ($tipo_especialidad==8){
							
							break;

						}
							while (true){
								$seleccionar_empleado=readline(" \n ingrese el empleado a asignar de la lista: \n ");
								$conversion=$seleccionar_empleado - 1;
								$buscar = $lista_empleado[$conversion];

						
						
								if ($buscar == false) {
    						
						
    									echo "\n ese empleado no pertenece a la especialidad seleccionada\n";
								}
							}
						
						
						
						
							
					
						        
						}
						$dia=readline("ingrese el dia de la semana en que desea la cita: ");
						if ($dia=="domingo"){
							echo "ese dia no esta disponible";
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
				}
			}
			
			break;
		case 3:
			break;
		case 4:
	
	
	}
	if ($opcion==8){
		break;
		
	}

}

