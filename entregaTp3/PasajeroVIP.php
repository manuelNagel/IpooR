<?php
include 'Pasajero.php';

class PasajeroVIP extends Pasajero{
    //Clase que representa un Pasajero Vip
    //Atributos
    private $numVFrecuente;
    private $millasAcum;

    public function __construct($doc,$nom,$ape,$numA,$numT,$numVF,$mil){
        //Constructor PasajeroVIP
        parent:: __construct($doc,$nom,$ape,$numA,$numT);
        $this->numVFrecuente = $numVF;
        $this->millasAcum = $mil;
    }

    //metodos observadores
    
    public function getNumVFrecuente(){
        return $this->numVFrecuente;
    }
    public function getMillasAcum(){
        return $this->millasAcum;
    }

    //metodos modificadores
    public function setNumVFrecuente($numV){
        $this->numVFrecuente = $numV;
    }

    public function setAcumMillas($mil){
        $this->millasAcum = $mil;
    }
    //metodos propios
    public function darPorcentajeIncremento() {
        $porc = parent::darPorcentajeIncremento()+0.25;
        if($this->getMillasAcum()>300){
            $porc=1.30;
        }
        return $porc;
    }
    //Metodo __toString

    public function __toString(){
        $cadena=parent::__toString();
        $cadena .= "\nNumero de viajero frecuente: ".$this->getNumVFrecuente()."\nAcumulacion de Millas: ".$this->getMillasAcum();
        return $cadena; 
    }

}
?>
