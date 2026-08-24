<?php

$empleado_especialidad=[];
$empleados=[];
$clientes=[["codigo"=>"","nombre"=>""]];
$agendamiento_cita=[["codigo_empleado"=>"","codigo_cliente"=>"","especialidad"=>"","hora"=>"","dia"=>""]];
function agregarempleado(int $p_cedula,array &$empleados,array $p_empleado_especialidad,string $p_nombre){

	$empleados[] = ["cedula"=>$p_cedula,"nombre" => $p_nombre, "especialidad" => $p_empleado_especialidad];

}

function recorrer (array $empleados ,string $p_tipo_especialidad){
       echo "empleados especializados en esta especialidad";
       foreach ($empleados as $item){
			$lista=$item["especialidad"];
			foreach ($lista as $emple){

				if ($p_tipo_especialidad==$emple){
					echo " \n nombre: " .$item["nombre"] ."\n";
					$p=array_column($empleados,"cedula");
					$posicion=array_search($emple,$empleados);
			}      }
	}		
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
							agregarempleado($cedula,$empleados,$empleado_especialidad,$nombre);
							
							$especialidad=[];
							print_r($empleados);
							break;

						}
						
					}
				}
			}
			break;
		case 2:
			while (true){
				echo "REGISTRO DE CITAS";
				$cliente=readline("digite el nombre de cliente que desea registrar:(x para salir) ");
				if ($cliente=="x" || trim($cliente) == ''){
					break;
				}else{
					$cedula=readline("digite la cedula del cliente a registrar: ");
					while (true){
						$tipo_especialidad=readline("\n especialidades disponibles \n 1. \n 2. \n 3. \n 4. \n 5. \n 6. \n 7. \n ");
						switch($tipo_especialidad){
                                                        case 1:
                                                                $tipo_especialidad="manicurista";
                                                                recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 2:
                                                                $tipo_especialidad="esteticista(limpiadora facial)";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 3:

                                                                $tipo_especialidad="pedicurista";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 4:
                                                                $tipo_especialidad="masajista";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 5:
                                                                $tipo_especialidad="masoterapeuta";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 6:
                                                                $tipo_especialidad="Esteticista corporal";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
                                                        case 7:
                                                                $tipo_especialidad="cosmetóloga";
								recorrer($empleados,$tipo_especialidad);
                                                                break;
						
                                                }
						$opcion==readline("desea agendar otro servicio? :")
						if($opcion=="si"){
					
						}else if($opcion=="no"){
							break;
						}else{
						        
							}
					}
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

