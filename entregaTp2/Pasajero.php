<?php
 class Pasajero{
     //propiedades(php)/atributos
     private $nombre;
     private $apellido;
     private $documento;
     private $telefono;

     //constructor
    public function __construct($nom,$apel,$doc,$tel)
    {
        $this->nombre=$nom;
        $this->apellido=$apel;
        $this->documento=$doc;
        $this->telefono=$tel;
        
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
    public function getApellido(){
        return $this->apellido;
    }
    /**
     * @return int
     */
    public function getDocumento(){
        return $this->documento;
    }
    /**
     * @return int
     */
    public function getTelefono(){
        return $this->telefono;
    }
    //metodos modificadores
    /**
     * @param string $nom
     */
    public function setNombre($nom){
        $this->nombre=$nom;
    }
    /**
     * @param string $srName
     */
    public function setApellido($srName){
        $this->apellido=$srName;
    }
    /**
     * @param int $doc
     */
    public function setDocumento($doc){
        $this->documento=$doc;
    }
    /**
     * @param int $tel
     */
    public function setTelefono($tel){
        $this->telefono=$tel;
    }
    //metodos

    //__toString
    public function __toString()
    {
        return "\nNombre: ".$this->getNombre()."   Apellido: ".$this->getApellido()."\nNúmero de documento: ".$this->getDocumento()."\n Número de telefono: "
        .$this->getTelefono();
        
    }
 }
?>