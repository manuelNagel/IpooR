<?php
class Viaje{
    //propiedades 
    private $codigo;
    private $destino;
    private $maxPasajeros;
    private $pasajeros;

    //constructor
public function __construct($cod,$des,$maxP,$pas)
{
    $this->codigo=$cod;
    $this->destino=$des;
    $this->maxPasajeros=$maxP;
    $this->pasajeros=$pas;
}
//metodos observadores
/**
 * @return int
 */
public function getCodigo(){
    return $this->codigo;
}
/**
 * @return string
 */
public function getDestino(){
    return $this->destino;
}
/**
 * @return int
 */
public function getMaxPasajeros(){
    return $this->maxPasajeros;
}
/**
 * @return array
 */
public function getPasajeros(){
    return $this->pasajeros;
}
// Modificadores
/**
 * @param int $cod
 */
public function setCodigo($cod){
    $this->codigo=$cod;
}
/**
 * @param  string $dest
 */
public function setDestino($dest){
    $this->destino=$dest;
}
/**
 * @param int $maxP
 */
public function setMaxPasajeros($maxP){
    $this->maxPasajeros=$maxP;
}
/**
 * @param array $pas
 */
public function setPasajeros($pas){
    $this->pasajeros=$pas;
}

//metodo propio
/**
 * @param array $pas
 * agrega un pasajero 
 */
public function agregarPasajero($pas){
    $pasajeros= gettype($this -> getPasajeros())=="array" ?  $this -> getPasajeros() : array();
    $pasajeros[]=$pas;
    $pasajeros=array_merge($this->getPasajeros(),$pasajeros);
    $this->setPasajeros($pasajeros);
}
/**
 *  @param string $doc
 * @return array;
 * */ 
public function getPasajeroEspecifico($doc){
    $pasajeros=$this->getPasajeros();
    $cond=false;
    for($i=0;$i<$pasajeros.count();$i++){
        $pasajero=$pasajeros[$i];
        $cond=$pasajero["documento"]==$doc;
        if($cond){
            return $pasajero;
        }
    }
    return array("nombre"=>"vacio",
                 "apellido"=>"vacio",
                 "documento"=>"0");

}

/**
 * mismo metodo que arriba pero con for each
 */
public function getPasajeroEspecificoForEach($doc){
    $pasajeros = $this->getPasajeros();
    
    foreach ($pasajeros as $pasajero) {
        if ($pasajero["documento"] == $doc) {
            return $pasajero;
        }
    }
    
    return array(
        "nombre" => "vacio",
        "apellido" => "vacio",
        "documento" => "0"
    );
}

//to string
public function __toString(){
    return "\nCodigo: ".$this->getCodigo()."\nDestino: ".$this->getDestino()."\nPasajeros Maximos: ".$this->getMaxPasajeros()."\nPasajeros: ".print_r($this->getPasajeros(),true);
}


}

?>