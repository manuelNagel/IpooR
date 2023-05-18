<?php
class TipoNecesidad{
private $sillaRuedas;
private $asistenciaEmbarque;
private $asistenciaDesembarque;
private $comidaEsp;
private $restAlim;

public function __construct($sil,$astEm,$astDes,$com,$rest){
    $this->sillaRuedas = $sil;
    $this->asistenciaEmbarque =$astEm;
    $this->asistenciaDesembarque = $astDes;
    $this->comidaEsp = $com;
    $this->restAlim = $rest;
}

//metodos observadores
    
public function getSillaRuedas(){
    return $this->sillaRuedas;
}
public function getAsistenciaEmbarque(){
    return $this->asistenciaEmbarque;
}

public function getAsistenciaDesembarque(){
    return $this->asistenciaDesembarque;
}

public function getComidaEsp(){
    return $this->comidaEsp;
}

 public function getRestAlim(){
    return $this->restAlim;
}
//metodos modificadores

public function setSillaRuedas($sil){
    $this->sillaRuedas = $sil;
}

public function setAsistenciaEmbarque($astEm){
    $this->asistenciaEmbarque = $astEm;
}


public function setAsistenciaDesembarque($astDes){
    $this->asistenciaDesembarque = $astDes;
}


public function setComidaEsp($com){
    $this->comidaEsp = $com;
}

public function setRestAlim($rest){
    $this->restAlim = $rest;
}
//metodo propio

/**
 * Metodo que devuelve Si hay algun tipo de necesidad especial
 * @return boolean
 *
 */
public function HayNecesidad(){
    return $this->getSillaRuedas()||$this->getAsistenciaEmbarque()||$this->getAsistenciaDesembarque()||$this->getComidaEsp()||$this->getRestAlim();
}

//tostring

public function __toString(){
    return "\nNecesidades:\n Silla de ruedas: ".$this->getSillaRuedas()."\n Asistencia de embarque: ".$this->getAsistenciaEmbarque()."\n Asistencia de desembarque: ".$this->getAsistenciaDesembarque()."\n Comida especial: ".$this->getComidaEsp()."\n Restricción Alimentaria: ".$this->getRestAlim();
}
}

?>