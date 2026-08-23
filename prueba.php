<?php

$empleado_especialidad=[];
$empleados=[];
$clientes=[["codigo"=>"","nombre"=>""]];
$agendamiento_cita=[["codigo_empleado"=>"","codigo_cliente"=>"","especialidad"=>"","hora"=>"","dia"=>""]];
function agregarempleado(array &$empleados,array $p_empleado_especialidad,string $p_nombre){

	$empleados[] = ["nombre" => $p_nombre, "especialidad" => $p_empleado_especialidad];

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
				$empleados["nombre"]=$especialidad;
				if($nombre=="x"){
					break;
				}else{
					print("aqui va el registro \n ");
					while (true){
						
						echo "digite la especialidad del empleado \n 1.manicurista \n 2.esteticista(limpiadora facial) \n 3.pedicurista \n 4.masajista \n 5. masoterapeuta \n 6. Esteticista corporal \n 7.cosmetóloga \n ";
						$especialidad=readline();
						$empleado_especialidad[]=$especialidad;
						echo "desea agregar otra especialidad";
						$especialidad=readline();
						if($especialidad=="no"){
							agregarempleado($empleados,$empleado_especialidad,$nombre);
							
							$especialidad=[];
							print_r($empleados);
							break;

						}
						
					}
				}
			}
			break;
		case 2:
			break;
		case 3:
			break;
		case 4:
		
			
	}
	if ($opcion==8){
		break;
		
	}
}
