<?php

 class Viaje {
    //propiedades/atributos
    private $codigo;
    private $destino;
    private $pasajerosMax;
    private $pasajeros;
    private $Responsable;

    //Constructor
    public function __construct($cod,$dest,$pasM,$pas,$res)
    {
        $this->codigo = $cod;
        $this->destino= $dest;
        $this->pasajerosMax = $pasM;
        $this->pasajeros = $pas;
        $this->responsable = $res;
        
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
     * @param  object $Res
     */
    public function setResponsable($res){
        $this->responsable=$res;
    }
    //Metodo toString

    public function __toString(){
        $cad = "";
        for($numPasajero = 0; $numPasajero < count($this -> pasajeros); $numPasajero++ ){
            $cad = $cad."Pasajero nro " . ($numPasajero+1) . "\nNombre: " . $this->pasajeros[$numPasajero]->getNombre(). " " . $this->pasajeros[$numPasajero]->getApellido(). ".\nDNI: " . $this->pasajeros[$numPasajero]->getDni()."\n
            Telefono: ".$this->pasajeros[$numPasajero]->getTelefono()."\n";
        }
        return "\nVuelo " . $this->getCodigo() . ".\nDestino: " . $this->getDestino() . "\nCantidad maxima de pasajeros: " . $this->getMaxPasajeros() . "\nResponsable: ".$this->responsable->__toString()."\nPasajeros:\n" . $cad;
    }

}

    
?>