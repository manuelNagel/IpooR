<?php
include "Viaje.php";

//funcion para precarga de una coleccion con objetos
/**
 * @return object
 */
function preCarga(){
    
    $coleccionPasajeros = array(
        array(
            "documento" => "42735572",
            "nombre" => "Manu",
            "apellido" => "Nagel"
        ),
        array(
            "documento" => "54988232",
            "nombre" => "Ana",
            "apellido" => "Rodriguez"
        ),
        array(
            "documento" => "23467345",
            "nombre" => "Luis",
            "apellido" => "García"
        )
    );
    return new Viaje(4290,"Chile",5,$coleccionPasajeros);
}

//funcion que crea viaje
/**
 * @return object
 */
function crearViaje(){
    echo "\nIngrese el codigo del viaje: ";
    $codigo=trim(fgets(STDIN));
    echo "Ingrese el destino del viaje: ";
    $destino = trim(fgets(STDIN));
    echo "Ingrese la cantidad maxima de pasajeros: ";
    $maxPas= trim(fgets(STDIN));
    $colPas= crearColPas($maxPas);
    return new Viaje($codigo,$destino,$maxPas,$colPas);
}

//funcion para crear pasajeros
/**
 * @param int $maxPas
 * @return array
 */
function crearColPas($maxPas){
    $cantPas=validacionMaxPasajeros($maxPas);
    $arrPasajeros=array();
    for($i=0;$i<$cantPas;$i++){
        $documento = validacionRepetidos($arrPasajeros,$i);
        echo "\nIngrese el nombre del pasajero número ". ($i+1) . " : ";
        $nombre = trim(fgets(STDIN));
        echo "\nIngrese el apellido del pasajero número " .($i+1) . " : ";
        $apellido = trim(fgets(STDIN));
        
        //Asignamos los datos al numero ingresado por parametro
        $arregloPasajeros[$i]= array("documento"=>$documento,"nombre"=>$nombre,"apellido"=>$apellido);
    }
    return $arregloPasajeros;
}

/**
 * Modulo que verifica que el pasajero no este repetido
 * @param array $aPas
 * @param int $iteracion
 * @return int
 */
function validacionRepetidos($aPas,$iteracion){
    
    $cond=true;
    if($iteracion==0){
        echo "\nIngrese el documento del pasajero número 1: ";
            
        return trim(fgets(STDIN));
    }
    while($cond){
        echo "\nIngrese el documento del pasajero número " . ($iteracion+1) . " : ";
            $doc = trim(fgets(STDIN));
            $cond2=true;
            foreach ($aPas as $value) {
                $valores= $pasajero["documento"];
                if($doc==$valores){
                    echo "\neste pasajero ya existe.";
                    $cond2=false;
                    break;
                }
              }
              if($cond2==true){
                return $doc;
              }
              
    
    }
}
 /**
  * Modulo que valida sque el valor sea correcto
  *@param int $max
  *@return int
  */
function validacionMaxPasajeros($maxPas){
    $cond=true;
     do{
        echo "\nIngrese la cantidad de pasajeros: ";
        $cantPas = trim(fgets(STDIN));
        if($cantPas<=$maxPas && $cantPas>0){
            $cond = false;
        }else{
            echo "\n la cantidad de pasajeros ingresados es mayor a la que se puede.";
        }
     }while($cond);
     return $cantPas;
}

/**
 * Modulo que agrega un nuevo apsajero al viaje
 * @param Viaje $viaje
 */
function agregarPasajero($viaje){
    $pasajeros= $viaje->getPasajeros();
    $cond=true;
    echo "\nCuantos Pasajeros desea ingresar?";
    $cantPas= trim(fgets(STDIN));
    if($cantPas+count($viaje->getPasajeros())<$viaje->getMaxPasajeros()){
        if($cantPas>1){
            $col = crearColPas($viaje->getMaxPasajeros());
            $viaje->setPasajeros(array_merge($pasajeros,$col));
        }else{
            echo "\ningrese el documento del pasajero";
            do{
                $doc=trim(fgets(STDIN));
                if(in_array(array("documento",$doc),$pasajeros)){
                    echo "\ningrese el numero de pasajero de nuevo, el documento ingresado ya se encuentra";
                    $doc=trim(fgets(STDIN));
                }else{
                    $cond=false;
                }
            }while($cond);
            echo "\ningrese el nombre del pasajero";
            $nombre=trim(fgets(STDIN));
            echo "\ningrese el apellido del pasajero";
            $apellido = trim(fgets(STDIN));
            $viaje->agregarPasajero(array("documento"=>$doc,"nombre"=>$nombre,"apellido"=>$apellido));
        }
    }else{
        echo "\nno se puede agregar esa cantidad de pasajeros";
        
    }
}
/**
 * Modulo para editar el arreglo de pasajeros
 * @param Viaje $viaje
 */
function editarPasajero($viaje)
{
    $pasNuevo = $viaje->getPasajeros();
    $num = valNumMod($viaje);
    //Pedimos los datos del nuevo pasajero
    echo "\nIngrese el nombre del nuevo pasajero: ";
    $nombre = trim(fgets(STDIN));
    echo "\ningrese el apellido del pasajero: ";
    $apellido = trim(fgets(STDIN));
    echo "\ningrese el documento del pasajero: ";
    $documento = trim(fgets(STDIN));

    //Asignamos los datos del nro ingresado por parametro
   $pasNuevo[$num-1]= array("documento"=>$documento,"nombre"=>$nombre,"apellido"=>$apellido);

    //Devolvemos el arreglo a la clase para que lo modifique
    $viaje->setPasajeros($pasNuevo);
}

/**
 * Modulo que valida que el numero ingresado se encuentre dentro del maximo de pasajeros y retorna el numero correcto
 * @param Viaje $viaje
 * @return int
 */
function valNumMod($viaje)
{
    
    $cond = true;
    do{
        echo "\nPor favor ingrese el número: ";
        $num = trim(fgets(STDIN));
        if ($num <= count($viaje->getPasajeros()) && $num > 0) {
            $cond = false;
        } else {
            echo "\nEl número ingresado no existe entre los pasajeros, intente de nuevo.";
        }
    }while($cond==true);
    return $num;
}

/**
 * Modulo que valida que la nueva cantidad maxima de pasajeros sea correcta
 * @param Viaje $viaje
 * @return int
 */
function valNuevoMax($viaje){
    $cond = true;
    do {
        echo "\nIngrese la nueva cantidad maxima de pasajeros del viaje: ";
            $nuevoMax = trim(fgets(STDIN));
        if ($nuevoMax >= count($viaje->getPasajeros())) {
            $cond = false;
        } else {
            echo "\nEl numero ingresado no es correcto.";
             }
    }while($cond==true);

    return $nuevoMax;
}

    //Main

    $cond =true;
    //menu
    //menu
do {
    echo "\nBienvenido, por favor Elija una opción\n";
    echo "1. Crear Viaje Nuevo\n";
    echo "2. Utilizar valores precargados\n";
    echo "3. Agregar un pasajero.\n";
    echo "4. Modificar un pasajero del viaje.\n";
    echo "5. Mostrar datos del viaje.\n";
    echo "6. Modificar el destino.\n";
    echo "7. Modificar la cantidad maxima de pasajeros.\n";
    echo "8. Salir.\n Opciones: ";

    $opcion = trim(fgets(STDIN));
    echo "eligio opción ".$opcion;

    switch ($opcion) {
        case 1: {
            $viaje = crearViaje();
            break;
        }
        case 2: {
            $viaje = preCarga();
            break;
        }
        case 3: {
            agregarPasajero($viaje);
            
            break;
        }
        case 4: {
            editarPasajero($viaje);
            break;
        }
        case 5: {
            echo $viaje;
            break;
        }
        case 6: {
            echo "\nIngrese el nuevo destino del viaje: ";
            $nuevoDest = trim(fgets(STDIN));
            $viaje->setDestino($nuevoDest);break;
        }
        case 7: {
            $nuevoMax = valNuevoMax($viaje);
            $viaje->setMaxPasajeros($nuevoMax);break;
        }
        case 8:{
            echo "Hasta Luego!";
            $cond=false;
            break;
        }
        default: {
            echo "\nLa opcion ingresada no existe";
            break;
        }
    }

    }while($cond);
    




?>