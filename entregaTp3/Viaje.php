<?php

 class Viaje {
    //propiedades/atributos
    private $codigo;
    private $destino;
    private $pasajerosMax;
    private $pasajeros;
    private $Responsable;
    private $costoViaje;
    private $costoAbonadoXPasajeros;

    //Constructor
    public function __construct($cod,$dest,$pasM,$pas,$res,$cost,$costAb)
    {
        $this->codigo = $cod;
        $this->destino= $dest;
        $this->pasajerosMax = $pasM;
        $this->pasajeros = $pas;
        $this->responsable = $res;
        $this->costoViaje = $cost;
        $this->costoAbonadoXPasajeros=$costAb;
        
    }
    //Observadores
    /**
     * Metodo que devuelve el codigo del vuelo
     * @return string
     */
    public function getCodigo(){
        return $this->codigo;
    }

    /**
     * Metodo que retorna el destino del vuelo
     * @return string
     */
    public function getDestino(){
        return $this->destino;
    }

    /**
     * Metodo retorna el maximo de pasajeros
     * @return string
     */
    public function getMaxPasajeros(){
        return $this->pasajerosMax;
    }
    /**
     * Metodo retorna el costo del viaje
     * @return string
     */
    public function getCostoViaje(){
        return $this->costoViaje;
    }
    /**
     * Metodo retorna el costo abonado por pasajeros
     * @return string
     */
    public function getCostoAbonadoXPasajeros(){
        return $this->costoAbonadoXPasajeros;
    }
    /**
     * Metodo que retorna pasajeros
     * @return array
     */
    public function getPasajeros(){
        return $this->pasajeros;
    }
    /**
     * @return object
     */
    public function getResponsables(){
        return $this->responsables;
    }

    //Modificadores

    /**
     * Metodo que modifica el destino del vuelo
     * @param string $dest
     */
    public function setDestino($dest){
        $this->destino= $dest;
    }

        /**
     * Metodo que modifica el maximo de pasajeros del avion
     * @param int $pasM
     */
    public function setMaxPasajeros ($pasM){
        $this->maxPasajeros = $pasM;
    }

    /**
     * Metodo que modifica un pasajero en un asiento del avion
     * @param array $pas
     */
    public function setPasajeros($pas){
        $this->pasajeros = $pas;
    }
    /**
     * Metodo que modifica el costo del viaje
     * @param int $cost
     */
    public function setCostoViaje($cost){
        $this->costoViaje = $cost;
    }
    /**
     * Metodo que modifica el costo abonado por pasajeros
     * @param int $cost
     */
    public function setCostoAbonadoXPasajeros($cost){
        $this->costoAbonadoXPasajeros = $cost;
    }
    /**
     * @param  object $Res
     */
    public function setResponsable($res){
        $this->responsable=$res;
    }

    //Metodos propio

    /**
     * Metodo que verifica la venta de un pasaje y retorna el costo
     * @return int 
     */
    public function venderPasaje($objPasajero){
        if($this->hayPasajesDisponibles()){
            $costoViaje= $this->getCostoViaje()*$objPasajero->darPorcentajeIncremento();
            
            $this->setPasajeros(array_push($this->getPasajeros,$objPasajero));
            $this->setCostoAbonadoXPasajeros=$this->getCostoAbonadoXPasajeros+$costoViaje;
            
            echo "Se puede vender el pasaje correctamente, el precio es: ".$costoViaje;
            return $costoViaje;
        }else{
            echo "No hay suficiente espacio para el pasajero";
            return 0;
        }
    }

    public function hayPasajesDisponibles(){
        return $this->getMaxPasajeros()>count($this->getPasajeros);
    }
    //Metodo toString

    public function __toString(){
        $cad = "";
        for($numPasajero = 0; $numPasajero < count($this -> pasajeros); $numPasajero++ ){
            $cad .= "\n Pasajero nro " . ($numPasajero+1) .$this->getPasajeros[$numPasajero];
        }
        return "\nVuelo " . $this->getCodigo() . ".\nDestino: " . $this->getDestino() . "\nCantidad maxima de pasajeros: " . $this->getMaxPasajeros() . "\nResponsable: ".$this->responsable->__toString()."\nCosto de Viaje: ".$this->getCostoViaje()."\nCosto Abonado Por Pasajeros: ".$this->getCostoAbonadoXPasajeros()."\nPasajeros:\n" . $cad;
    }

}

    
?>