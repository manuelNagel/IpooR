<?php
 class Pasajero{
     //propiedades/atributos
     private $nombre;
     private $numAsientos;
     private $nroTicket;

     //constructor
    public function __construct($nom,$numA,$numT)
    {
        $this->nombre=$nom;
        $this->numAsientos=$numA;
        $this->nroTicket=$numT;
        
    }
    //metodos observadores
    /**
     * @return string
     */
    public function getNombre(){
        return $this->nombre;
    }
    /**
     * @return string
     */
    public function getNroTicket(){
        return $this->nroTicket;
    }
    /**
     * @return int
     */
    public function getNumAsientos(){
        return $this->numAsientos;
    }
    //metodos modificadores
    /**
     * @param string $nom
     */
    public function setNombre($nom){
        $this->nombre=$nom;
    }
    /**
     * @param string $num
     */
    public function setNroTicket($num){
        $this->nroTicket=$num;
    }
    /**
     * @param int $doc
     */
    public function setNumAsientos($num){
        $this->numAsientos=$num;
    }
   
    //metodos
    public function darPorcentajeIncremento(){
        return 1.10;
    }

    //__toString
    public function __toString()
    {
        return "\nNombre: ".$this->getNombre()."\nNumero Asiento: ".$this->getNumAsientos()."\nNúmero de Ticket: ".$this->getNroTicket();
        
    }
 }
?>