<?php
include_once "Viaje.php";
include_once "Empresa.php";
include_once "Pasajero.php";
include_once "Responsable.php";

//MENU
$emp = new Empresa();
$viaje = new Viaje();
$responsable = new Responsable();
$pas = new Pasajero();

$seguir = true;

while ($seguir) {
    echo("\n*****************  MENU  *****************\n1. Crear empresa.\n2. Modificar empresa.\n3. Eliminar empresa.\n4. Crear Responsable.\n5. Modificar Responsable.\n6. Eliminar Responsable.\n7. Crear Viaje.\n8. Modificar Viaje.\n9. Eliminar Viaje.\n10. Crear Pasajero.\n11. Modificar Pasajero.\n12. Eliminar Pasajero.\n13. Mostrar Empresa.\n14. Mostrar Responsable.\n15. Mostrar Viaje.\n16.Salir.");

    echo("\nIngrese su operacion: ");
    $opciones = trim(fgets(STDIN));
    switch ($opciones) {
        case 1: {
            //CREACION DE EMPRESA
            crearEmpresa();
            break;
        }
        case 2:{
            //MODIFICACION DE EMPRESA
            modificarEmpresa();
            break;
        }
        case 3: {
            //ELIMINACION DE EMPRESA
            do{
                
                echo "\nDesea eliminar la empresa con los responsables asociados? Si:1 No:2";
                $condicionEliminar= trim(fgets(STDIN));
                if($condicionEliminar!=1&&$condicionEliminar!=2){
                    echo"\nValor incorrecto, intene nuevamente";
                }
            }while($condicionEliminar!=1&&$condicionEliminar!=2);
            
            eliminarEmpresaCompletaConAsociadosONo($condicionEliminar);
            break;
        }
        case 4: {
            //CREACION DE RESPONSABLE
            crearResponsable();
            break;
        }
        case 5: {
            //MODIFICACION DE RESPONSABLE
            modificarResponsable();
            break;
        }
        case 6: {
            //ELIMINACION DE RESPONSABLE
            eliminarResponsable();
            break;
        }
        case 7: {
            //CREACION DE VIAJE
            if (verifEmp() && verifResp()) {
                crearViaje();
            } else {
                echo("\nEl viaje no se puede crear porque no existe la empresa o el responsable.");
            }
            break;
        }
        case 8: {
            //MODIFICACION DE VIAJE
            modificarViaje();
            break;
        }
        case 9: {
            //ELIMINACION DE VIAJE
            
            do{
                echo "\nDesea eliminar a un viaje con pasajeros? Si:1 No:2";
                $cond=trim(fgets(STDIN));
                if($cond!=1||$cond!=2){
                    echo "\nNumero incorrecto";
                }

            }while($cond!=1&&$cond!=2);
            eliminarViajeCompleto();
            if($cond==1){

            }else if($cond==2){
            eliminarViajeUnicamente();
            }

            break;
        }
        case 10: {
            //CREACION DE PASAJERO
            if (verifVia()) {
                crearPasajero();
            } else {
                echo("\nEl pasajero no se pudo cargar porque no existe un viaje.");
            }
            break;
        }
        case 11: {
            //MODIFICACION DE PASAJERO
            modificarPasajero();
            break;
        }
        case 12: {
            //ELIMINACION DE PASAJERO
            eliminarPasajero();
            break;
        }
        case 13:{
            //MOSTRAR EMPRESA
            mostrarEmpresa();
            break;
        }
        case 14: {
            //MOSTRAR RESPONSABLE
            mostrarResponsable();
            break;
        }
        case 15: {
            //MOSTRAR VIAJE
            mostrarViaje();
            break;
        }
        case 16:{
            //SALIR DEL MENU
            echo("\nGracias por usar el servicio.");
            $seguir = false;
            break;
        }
        default: {
            echo("\nLa opcion ingresada no es correcta, intente de nuevo.");
            break;
        }
    }
}

function verifEmp()
{
    $emp = new Empresa();
    $emp = $emp->listar();
    if ($emp==null) {
        return false;
    } else {
        return true;
    }
}

function verifResp()
{
    $res = new Responsable();
    $res = $res->listar();
    if ($res==null) {
        return false;
    } else {
        return true;
    }
}

function verifVia()
{
    $via = new Viaje();
    $via = $via->listar();
    if ($via==null) {
        return false;
    } else {
        return true;
    }
}

function crearEmpresa()
{
    $emp = new Empresa();
    echo("\nIngrese el nombre de la empresa: ");
    $nombEmp = trim(fgets(STDIN));
    echo("\nIngrese la direccion de la empresa: ");
    $direEmp = trim(fgets(STDIN));
    
    $emp->cargar(0, $nombEmp, $direEmp);
    $respuesta = $emp->insertar();
    
    if ($respuesta == true) {
        echo("\nLa empresa fue ingresada correctamente a la base.");
    } else {
        echo("\n" . $emp->getmensajeoperacion());
    }
    return $respuesta;
}

function modificarEmpresa()
{
    echo("\nSe modificara el nombre y la direccion de la empresa a: 'Oversoft.inc' y a 'ayacucho 1453' respectivamente a la empresa con id 1.");
    $nuevoNomb = "La empresa unida";
    $nuevaDirec = "ayacucho 1453";
    $emp = new Empresa();
    $emp->buscar(1);
    $emp->setNombre($nuevoNomb);
    $emp->setDireccion($nuevaDirec);
    $respuesta = $emp->modificar();
    if ($respuesta == true) {
        echo("\nLa modificacion fue realizada correctamente.");
    } else {
        echo $emp->getmensajeoperacion();
    }
}

function mostrarEmpresa()
{
    $emp = new Empresa();
    echo("\nIngrese el id de la empresa a mostrar: ");
    $id = trim(fgets(STDIN));
    $colEmpresas = $emp->listar('idempresa=' . $id);
    foreach ($colEmpresas as $em) {
        echo $em;
        echo " ----------- ";
    };
}

function crearResponsable()
{
    $responsable = new Responsable();
    echo("\nIngrese el numero de licencia del responable: ");
    $lic = trim(fgets(STDIN));
    echo("\nIngrese el nombre del responsable: ");
    $nomb = trim(fgets(STDIN));
    echo("\nIngrese el apellido del responsable: ");
    $apellido = trim(fgets(STDIN));

    $responsable->cargar(0, $lic, $nomb, $apellido);
    $respuesta = $responsable->insertar();

    if ($respuesta == true) {
        echo("\nEl responsable se ingreso de manera correcta.");
    } else {
        echo $responsable->getmensajeoperacion();
    }
    return $respuesta;
}

function modificarResponsable()
{
    $resp = new Responsable();
    $resp->buscar(1);
    echo("\nSe modificara el nombre y apellido del responsable a 'tobias selva' y su licencia a 909, al empleado con numero 1.");
    $resp->setNombre("Franquito");
    $resp->setApellido("Hanneman");
    $resp->setNumeroL(909);
    $respuesta = $resp->modificar();
    if ($respuesta == true) {
        echo("\nLa modificacion fue realizada correctamente.");
    } else {
        echo $resp->getmensajeoperacion();
    }
}

function eliminarResponsable($id=0)
{
    if($id==0){
        echo("\nPor favor ingrese el numero de empleado del responsable a eliminar: ");
        $pNro = trim(fgets(STDIN));
    }else{
        $pNro = $id;
    }
   
    $responsable = new Responsable();
    $responsable->buscar($pNro);
    $respuesta = $responsable->eliminar();
    if ($respuesta==true) {
        echo("\nLa eliminacion fue realizada correctamente.");
    } else {
        echo $responsable->getmensajeoperacion();
    }
}

function mostrarResponsable()
{
    $responsable = new Responsable();
    echo("\nIngrese el numero de empleado del responsable a mostrar: ");
    $id = trim(fgets(STDIN));
    $colResponsable = $responsable->listar('rnumeroempleado=' . $id);
    foreach ($colResponsable as $res) {
        echo $res;
        echo " ----------- ";
    };
}

function crearViaje()
{
    $viaje = new Viaje();
    $colResponsables= new Responsable();
    echo("\nIngrese el destino del viaje: ");
    $dest = trim(fgets(STDIN));
    if ($viaje->listar("vdestino='".$dest. "'") == null) {
        echo("\nIngrese la cantidad max. de pasajeros: ");
        $max = trim(fgets(STDIN));
        echo("\nIngrese el id de la empresa: ");
        $idEmp = trim(fgets(STDIN));
        $empresa = buscarEmpresaAux($idEmp);
        echo("\nIngrese el numero del empleado a asignar: ");
        $colResponsables=$colResponsables->listar();
        foreach($colResponsables as $responsable){
            echo "\n".$responsable;
        }
        $numEmp = trim(fgets(STDIN));
        $empleado = buscarRespAux($numEmp);
        echo("\nIngrese el importe del viaje: ");
        $import = trim(fgets(STDIN));
    
        $viaje->cargar(0, $dest, $max, $import, $empleado, $empresa);
        $respuesta = $viaje->insertar();
    
        if ($respuesta == true) {
            echo("\nEl viaje fue ingresada correctamente a la base.");
        } else {
            echo("\n" . $viaje->getmensajeoperacion());
        }
    } else {
        echo ("\nEl viaje no fue creado debido a que ya existe un viaje a ese destino.");
        $respuesta=false;
    }
    return $respuesta;
}

function buscarRespAux($id)
{
    $respon = new Responsable();
    $nuevoResponsable = $respon->listar('rnumeroempleado=' . $id);
    return $nuevoResponsable[0];
}

function buscarEmpresaAux($id)
{
    $emp = new Empresa();
    $nuevaEmpresa = $emp->listar('idempresa='. $id);
    return $nuevaEmpresa[0];
}

function modificarViaje()
{
    echo("\nSe modificara el destino y el importe del viaje a 'mdq' y 10000 respectivamente al viaje con id 1.");
    $via = new Viaje();
    $via->buscar(1);
    $via->setDestino("Salta");
    $via->setImporte(10001);
    $respuesta = $via->modificar();
    if ($respuesta == true) {
        echo("\nLa modificacion fue realizada correctamente.");
    } else {
        echo $via->getmensajeoperacion();
    }
}

function eliminarViajeUnicamente()
{
    $pas = new Pasajero();
    echo("\nIngrese el id del viaje a eliminar: ");
    $pId = trim(fgets(STDIN));
    if ($pas->listar('idviaje='.$pId) == null) {
        $viaje = new Viaje();
        $viaje->buscar($pId);
        $respuesta = $viaje->eliminar();
        if ($respuesta==true) {
            echo("\nLa eliminacion fue realizada correctamente.");
        } else {
            echo $viaje->getmensajeoperacion();
        }
    } else {
        echo ("\nEl viaje no se puede eliminar debido a que tiene pasajeros.");
    }
}

function eliminarViajeCompleto($idViaje=0){
$pas = new Pasajero();
if($idViaje==0){
    echo("\nIngrese el id del viaje a eliminar: ");
    $pId = trim(fgets(STDIN));
}else{
    //Para eliminar con id precargado
    $pId=$idViaje;
}

$colPas = $pas->listar('idviaje='.$pId);
if ($colPas == null) {
    $viaje = new Viaje();
    $viaje->buscar($pId);
    $respuesta = $viaje->eliminar();
    if ($respuesta==true) {
        echo("\nLa eliminacion fue realizada correctamente.");
    } else {
        echo $viaje->getmensajeoperacion();
    }
} else {
   $i=0;
   $cond2 = true;
    do{
        $pasajero = new Pasajero();
        $pasajero->buscar($colPas[$i]->getDocumento());
    
        $respuesta = $pasajero->eliminar();
        if ($respuesta==true) {
            echo("\nLa eliminacion fue realizada correctamente.");
        } else {
            echo "Error con eliminacion pasajero";
            echo $pasajero->getmensajeoperacion();
            $cond2=false;
        }
        $i++;
    }while(count($colPas)>$i||$cond2);
    
    $cond=$pas->listar('idviaje='.$pId);
    
    if(($cond==0||$cond==null) && $pas->listar('idviaje='.$pId)!=null){
        $viaje = new Viaje();
        $viaje->buscar($pId);
        $respuesta = $viaje->eliminar();
        if ($respuesta==true) {
            echo("\nLa eliminacion fue realizada correctamente.");
        } else {
            echo $viaje->getmensajeoperacion();
        }

    }else{
        echo "no se pudo ejecutar correctamente el eliminado.";
    }
}
}

function eliminarEmpresaCompletaConAsociadosONo($cond){
    $Viaje = new Viaje();
    echo("\nIngrese el id de la empresa a eliminar: ");
    $pID = trim(fgets(STDIN));
    $emp = new Empresa();
    $emp->buscar($pID);
    $colViaje=$Viaje->listar('idempresa='.$pID);
    $colResponsables=array();
    foreach ($colViaje as $viaje){
        $responsable = $viaje->getResponsable();
        if (!in_array($responsable, $colResponsables)) {
         $colResponsables[] = $responsable;
        }
        eliminarViajeCompleto($viaje->getId());
    }
    if($cond==1){
        foreach($colResponsables as $responsable){
            eliminarResponsable($responsable->getNumeroE());
        }
    }
    
    $respuesta = $emp->eliminar();
    if ($respuesta==true) {
        echo("\nLa eliminacion fue realizada correctamente.");
    } else {
        echo $emp->getmensajeoperacion();
    }

}

function mostrarViaje()
{
    $viaje = new Viaje();
    echo("\nIngrese el id del viaje a mostrar: ");
    $id = trim(fgets(STDIN));
    $colViajes = $viaje->listar('idviaje=' . $id);
    foreach ($colViajes as $via) {
        echo $via;
        echo " ----------- ";
    };
}

function crearPasajero()
{
    $pasajero = new Pasajero();
    echo("\nIngrese el documento del pasajero: ");
    $pDni = trim(fgets(STDIN));
    echo("\nIngrese el nombre: ");
    $pNom = trim(fgets(STDIN));
    echo("\nIngrese el apellido del pasajero: ");
    $pApe = trim(fgets(STDIN));
    echo("\nIngrese el telefono: ");
    $pTel = trim(fgets(STDIN));
    echo("\nIngrese el id del viaje: ");
    $pId = trim(fgets(STDIN));
    $pViaje = buscarViajeAux($pId);

    
    $pasajero->cargar($pDni, $pNom, $pApe, $pTel, $pViaje);
    $respuesta = $pasajero->insertar();

    if ($respuesta == true) {
        echo("\nEl pasajero fue ingresada correctamente a la base.");
    } else {
        echo("\n" . $pasajero->getmensajeoperacion());
    }
    return $respuesta;
}

function buscarViajeAux($id)
{
    $viajeFinal = new Viaje();
    $viajeFinal = $viajeFinal->listar('idviaje='. $id)[0];
    
    return $viajeFinal;
}

function modificarPasajero()
{
    echo("\nSe va a modificar el nombre y el telefono del pasajero a 'Lucia' y 155579157 con documento 42735572");
    $pas = new Pasajero();
    $pas->buscar(42735572);
    $pas->setNombre("Tomas");
    $pas->setTelefono(155579163);
    $respuesta = $pas->modificar();
    if ($respuesta == true) {
        echo("\nLa modificacion fue realizada correctamente.");
    } else {
        echo $pas->getmensajeoperacion();
    }
}

function eliminarPasajero()
{
    echo("\nIngrese el documento del pasajero: ");
    $pDni = trim(fgets(STDIN));
    $pasajero = new Pasajero();
    $pasajero->buscar($pDni);
    
    $respuesta = $pasajero->eliminar();
    if ($respuesta==true) {
        echo("\nLa eliminacion fue realizada correctamente.");
    } else {
        echo $pasajero->getmensajeoperacion();
    }
}
?>