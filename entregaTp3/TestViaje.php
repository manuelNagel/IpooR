<?php
include "Viaje.php";
include "ResponsableV.php";
include "Pasajero.php";
include "PasajeroVIP.php";
include "PasajeroEspecial.php";
include "TipoNecesidad.php";

//funcion para precarga de una coleccion con objetos
/**
 * @return object
 */
function preCarga(){
    $val = new TipoNecesidad(true,true,false,false,false);
    $coleccionPasajeros= array( 
                    new Pasajero("Manuel",10,15000),
                    new PasajeroEspecial("Lucia",11,15001,new TipoNecesidad(true,true,false,false,false)),
                    new PasajeroVIP("Juani",13,11487,14423432,301),
                    new PasajeroEspecial("Franciso",15,11492,new TipoNecesidad(true,false,false,false,false)),
                    new PasajeroVIP("Luz",8,11132,35809143,299)
   
                        );
    $responsableV= new ResponsableV(1,13,"Gustavo","McNiles");
    $ViajeDefault = new Viaje(4290,"Chile",35,$coleccionPasajeros,$responsableV,1000,10000);
    return $ViajeDefault;
}


function crearVuelo(){

    echo "Ingrese el codigo del vuelo: ";
    $codigo = trim(fgets(STDIN));
    echo "Luego, ingrese el destino del vuelo: ";
    $destino = trim(fgets(STDIN));
    echo "Ingrese la cantidad maxima de pasajeros del vuelo: ";
    $maximo = trim(fgets(STDIN));
    $responsable= crearResponsable();
    echo "Ingrese el costo del viaje: ";
    $costo = trim(fgets(STDIN));
    $arrPasajeros = crearArrPasajeros($maximo);
    $AbonoPasajeros = calcularAbono($arrPasajeros,$costo);
    $vuelo = new Viaje($codigo, $destino, $maximo, $arrPasajeros,$responsable,$costo,$AbonoPasajeros);
    return $vuelo;
}
/**
 * Modulo para crear al responsable del vuelo
 * @return object
 */
function crearResponsable(){
    echo "\nIngrese por favor el numero del responsable: ";
    $numR = trim(fgets(STDIN));
    echo "\nIngrese el numero de licencia del responsable: ";
    $numL = trim(fgets(STDIN));
    echo "\nIngrese el nombre del responsable";
    $nom = trim(fgets(STDIN));
    echo  "\nIngrese el apellido del responsable";
    $apel= trim(fgets(STDIN));
    return new ResponsableV($numR,$numL,$nom,$apel);
}
/**
 * Modulo para creacion arreglo pasajeros
 * @param int $maximo
 * @return array
 */

 function crearArrPasajeros($maximo){
     $cantidadPasajeros=validacionMaxPasajeros($maximo);
     $numPasajero=0;
     $arregloPasajeros = array() ;
     do{
        echo "\nIngrese el nombre del pasajero número ". ($numPasajero+1) . " : ";
        $nombre = trim(fgets(STDIN));
        $nroTicket = validacionRepetidosTickets($arregloPasajeros,$numPasajero);
        $nroAsiento = validacionRepetidosAsiento($arregloPasajeros,$numPasajero);
        $tipoPas=-1;
        $cond=false;
        do{
            if($cond){
                echo "Intente de nuevo, valor incorrecto";
            }
        echo"\nQue tipo de pasajero es : \n1.Estandar\n2.VIP\n3.Especial";
        $tipoPas = trim(fgets(STDIN));
        $cond=true;
        }while(!($tipoPas>0&&$tipoPas<4));
        
        switch($tipoPas){
            case 1: array_push($arregloPasajeros,new Pasajero($nombre,$nroAsiento,$nroTicket));break;
            case 2: $VFrec = validacionRepetidosViajeroFrecuente();
                    echo "Ingrese las millas acumuladas del pasajero";
                    $millas= trim(fgets(STDIN));
                    array_push($arregloPasajeros,new PasajeroVIP($nombre,$nroAsiento,$nroTicket,$VFrec,$millas));;break;
            case 3: array_push($arregloPasajeros,new PasajeroEspecial($nombre,$nroTicket,$nroAsiento,crearTipoNecesidad())) ;break;
            default:echo "error tipo pasajero";break;
        }
        //Asignamos los datos al numero ingresado por parametro

        $arregloPasajeros[$numPasajero]= new Pasajero($nombre,$nroAsiento,$nroTicket);
        $numPasajero++;
     }while($numPasajero<$cantidadPasajeros);
    
     return $arregloPasajeros;
 }

 /**
  * Funcion para crear el tipoNecesidad apra pasajero especial
  *@return object
  */
 function crearTipoNecesidad(){
    echo "Necesita silla de ruedas? : 1.Si 2.No";
    $silla = trim(fgets(STDIN))==1?true:false;
    echo "Necesita ayuda en el embarque?: 1.Si 2.No";
    $embarque = trim(fgets(STDIN))==1?true:false;
    echo "Necesita ayuda en el desembarque? 1.Si 2.No";
    $desembarque = trim(fgets(STDIN))==1? true:false;
    echo "Necesita un menu especial? 1.Si 2.No";
    $menuEsp = trim(fgets(STDIN))==1? true:false;
    echo "Tiene alguna restricción alimenticia? 1.Si 2.No";
    $restAl= trim(fgets(STDIN)) ==1 ?true:false;
    return New TipoNecesidad($silla,$embarque,$desembarque,$menuEsp,$restAl);
 }
 
 /**
  * Calcula el abono total de los pasajeros
  *@param array $arr
  *@param int $costo
  *@return int $abono
  */
 function calcularAbono($arr,$costo){
    $abono=0;
    for($i=0;$i<count($arr);$i++){
        $abono+=$arr[$i]->darPorcentajeIncremento()*$costo;
    }
    return $abono;
 }

/**
 * Modulo que verifica que el nroTicket del  pasajero no este repetido
 * @param array $aPas
 * @param int $iteracion
 * @return int
 */
function validacionRepetidosTickets($aPas,$iteracion){

$cond=true;
if($iteracion==0){
    echo "\nIngrese el nro del ticket del pasajero número " . ($iteracion+1) . " : ";
    $nroTicket = trim(fgets(STDIN));
    return $nroTicket;
}
while($cond){
    echo "\nIngrese el nro del ticket del pasajero número " . ($iteracion+1) . " : ";
        $nroTicket = trim(fgets(STDIN));
        $cond2=true;
        foreach ($aPas as $value) {
            $valores= $value->getNroTicket();
            if($nroTicket==$valores){
                echo "este numero ya pertenece a otro cliente.";
                $cond2=false;
                break;
            }
          }
          if($cond2==true){
            return $nroTicket;
          }

}
}
/**
 * Modulo que verifica que el nro de asiento del pasajero no este repetido
 * @param array $aPas
 * @param int $iteracion
 * @return int
 */
function validacionRepetidosViajeroFrecuente($aPas,$iteracion){
    $cond=true;
    if($iteracion==0){
        echo "\nIngrese el nro de viajero frecuente del pasajero número " . ($iteracion+1) . " : ";
        $VFrec = trim(fgets(STDIN));
        return $nroAsiento;
    }
    while($cond){
        echo "\nIngrese el nro de viajero frecuente  del pasajero número " . ($iteracion+1) . " : ";
            $VFrec = trim(fgets(STDIN));
            $cond2=true;
            foreach ($aPas as $value) {
                $valores= $value->getNumVFrecuente();
                if($VFrec==$valores){
                    echo "Este numero es de otro pasajero en el viaje.";
                    $cond2=false;
                    break;
                }
              }
              if($cond2==true){
                return $VFrec;
              }
    
    }
}
/**
 * Modulo que verifica que el nro de asiento del pasajero no este repetido
 * @param array $aPas
 * @param int $iteracion
 * @return int
 */
function validacionRepetidosAsiento($aPas,$iteracion){

    $cond=true;
    if($iteracion==0){
        echo "\nIngrese el nro del asiento del pasajero número " . ($iteracion+1) . " : ";
        $nroAsiento = trim(fgets(STDIN));
        return $nroAsiento;
    }
    while($cond){
        echo "\nIngrese el nro del ticket del pasajero número " . ($iteracion+1) . " : ";
            $nroAsiento = trim(fgets(STDIN));
            $cond2=true;
            foreach ($aPas as $value) {
                $valores= $value->getNumAsientos();
                if($nroAsiento==$valores){
                    echo "Este asiento ya existe.";
                    $cond2=false;
                    break;
                }
              }
              if($cond2==true){
                return $nroAsiento;
              }
    
    }
}

    

 /**
  * Modulo que valida sque el valor sea correcto
  *@param int $max
  *@return int
  */
 function validacionMaxPasajeros($max){
     $cond=true;
     do{
        echo "\nIngrese la cantidad de pasajeros: ";
        $cantPas = trim(fgets(STDIN));
        if($cantPas<=$max && $cantPas>0){
            $cond = false;
        }else{
            echo "\n la cantidad de pasajeros es incorrecta.";
        }
     }while($cond==true);
     return $cantPas;

 }
/**
 * Modulo que agrega un nuevo pasajero al vuelo
 * @param VueloFeliz $vuelo
 */
function agregarPasajero($vuelo)
{
    if ($vuelo->hayPasajesDisponibles()) {
        $arregloPasajeros = $vuelo->getPasajeros();
        $numPasajero = count($arregloPasajeros);
    //introduccion datos
    $nroTicket = validacionRepetidosTickets($arregloPasajeros,$numPasajero);
    $nroAsiento = validacionRepetidosAsiento($arregloPasajeros,$numPasajero);
    $tipoPas=-1;
    $cond=false;
    do{
        if($cond){
            echo "Intente de nuevo, valor incorrecto";
        }
    echo"\nQue tipo de pasajero es : \n1.Estandar\n2.VIP\n3.Especial";
    $tipoPas = trim(fgets(STDIN));
    $cond=true;
    }while(!($tipoPas>0&&$tipoPas<4));
    
    switch($tipoPas){
        case 1: array_push($arregloPasajeros,new Pasajero($nombre,$nroAsiento,$nroTicket));break;
        case 2: $VFrec = validacionRepetidosViajeroFrecuente();
                echo "Ingrese las millas acumuladas del pasajero";
                $millas= trim(fgets(STDIN));
                array_push($arregloPasajeros,new PasajeroVIP($nombre,$nroAsiento,$nroTicket,$VFrec,$millas));;break;
        case 3: array_push($arregloPasajeros,new PasajeroEspecial($nombre,$nroTicket,$nroAsiento,crearTipoNecesidad())) ;break;
        default:echo "error tipo pasajero";break;

    }
    //seteamos pasajeros en el objeto
    $vuelo->setPasajeros($arreglosPasajeros);
}
}

/**
 * Modulo que valida el ingreso de un nuevo pasajero
 * @param VueloFeliz $vuelo
 * @return boolean
 */
function validacionVueloCompleto($vuelo){
    if(!$vuelo->hayPasajesDisponibles()){
        echo "\nEl vuelo esta lleno";
        $val = false;
    } else {
        $val = true;
    }
    return $val;
}

/**
 * Modulo para editar el arreglo de pasajeros
 * @param VueloFeliz $vuelo
 */
function editarPasajero($vuelo)
{
    $pasNuevo = $vuelo->getPasajeros();
    $num = valNumMod($vuelo);
    //Pedimos los datos del nuevo pasajero
    echo "\nIngrese el nombre del nuevo pasajero: ";
    $nombre = trim(fgets(STDIN));
    echo "Ingrese el Nro de ticket del pasajero";
    $nroTicket = trim(fgets(STDIN));
    echo "Ingrese el Nro de Asiento del pasajero: ";
    $numAsiento = trim(fgets(STDIN));
    $tipo = get_class($pasNuevo);

    switch($tipo){
        case "Pasajero": $pasNuevo[$num-1]=new Pasajero($nombre,$numAsiento,$nroTicket);break;
        case "PasajeroVIP": echo "Ingrese el numero de viajero frecuente";
                            $VFrec=trim(fgets(STDIN));
                            echo "Ingrese las millas acumuladas";
                            $millas= trim(fgets(STDIN));
                            $pasNuevo[$num-1]=new PasajeroVIP($nombre,$numAsiento,$nroTicket,$VFrec,$millas);break;
        case "PasajeroEspecial":$pasNuevo[$num-1]=new PasajeroVIP($nombre,$numAsiento,$nroTicket,crearTipoNecesidad());break;
        default: echo "error en pasajero mal definido";
    }
    //Devolvemos el arreglo a la clase para que lo modifique
    $vuelo->setPasajeros($pasNuevo);
}

/**
 * Modulo que valida que el numero ingresado se encuentre dentro del maximo de pasajeros y retorna el numero correcto
 * @param VueloFeliz $vuelo
 * @return int
 */
function valNumMod($vuelo)
{
    
    $cond = true;
    do{
        echo "\nPor favor ingrese el número: ";
        $num = trim(fgets(STDIN));
        if ($num <= count($vuelo->getPasajeros()) && $num > 0) {
            $cond = false;
        } else {
            echo "\nEl número ingresado no existe entre los pasajeros, intente de nuevo.";
        }
    }while($cond==true);
    return $num;
}

/**
 * Modulo que valida que la nueva cantidad maxima de pasajeros sea correcta
 * @param VueloFeliz $vuelo
 * @return int
 */
function valNuevoMax($vuelo){
    $cond = true;
    do {
        echo "\nIngrese la nueva cantidad maxima de pasajeros del vuelo: ";
            $nuevoMax = trim(fgets(STDIN));
        if ($nuevoMax >= count($vuelo->getPasajeros())) {
            $cond = false;
        } else {
            echo "\nEl numero ingresado no es correcto.";
             }
    }while($cond==true);

    return $nuevoMax;
}
/**
 * Modulo que crea un nuevo responsable y modifica al del vuelo
 * @param Viaje $vuelo
 */
function editarResponsable ($vuelo){
    echo "\nPor favor ingrese el nombre del nuevo responsable del vuelo: ";
    $nombre = trim(fgets(STDIN));
    echo "Luego, ingrese su apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Ahora ingrese el numero de licencia: ";
    $nroLic = trim(fgets(STDIN));
    echo "Y por ultimo, ingrese el numero de empleado: ";
    $nroEmp = trim(fgets(STDIN));
    $responsable = new ResponsableV($nroEmp, $nroLic, $nombre, $apellido);

    $vuelo->setResponsable($responsable);
}
/**
 * Main
 */


$cond = true;
//menu
do {
    echo "\nBienvenido, por favor Elija una opción\n";
    echo "1. Crear Vuelo Nuevo\n";
    echo "2. Utilizar valores precargados\n";
    echo "3. Agregar un pasajero.\n";
    echo "4. Modificar un pasajero del vuelo.\n";
    echo "5. Mostrar datos del vuelo.\n";
    echo "6. Modificar el responsable del vuelo\n";
    echo "7. Modificar el destino.\n";
    echo "8. Modificar la cantidad maxima de pasajeros.\n";
    echo "9. Salir.\n Opciones: ";
     
    $opcion = trim(fgets(STDIN));
    echo "eligio opción ".$opcion;

    switch ($opcion) {
        case 1: {
            $vuelo = crearVuelo();
            break;
        }
        case 2: {
            $vuelo = preCarga();
            break;
        }
        case 3: {
            agregarPasajero($vuelo);
            
            break;
        }
        case 4: {
            editarPasajero($vuelo);
            break;
        }
        case 5: {
            echo $vuelo;
            break;
        }
        case 6: {
            echo "\nGracias por usar la aplicación\n";
            $cond = false;
            break;
        }
        case 7: {
            echo "\nIngrese el nuevo destino del vuelo: ";
            $nuevoDest = trim(fgets(STDIN));
            $vuelo->setDestino($nuevoDest);break;
        }
        case 8: {
            $nuevoMax = valNuevoMax($vuelo);
            $vuelo->setMaxPasajeros($nuevoMax);break;
        }
        case 9:{
            echo "Hasta Luego!";
            $cond=false;
        }
        default: {
            echo "\nLa opcion ingresada no existe";
            break;
        }
    }
} while ($cond);

//desde ya muchas gracias por el tiempo qeu se tomaron en corregir. Saludos
?>