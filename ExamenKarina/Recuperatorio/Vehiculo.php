<?php
class Vehiculo{
    private $id;
    private $cost;
    private $fabricationYear;
    private $description;
    private $anualPercIncrement;
    private $activo;

    public function __construct($id,$cost,$fab,$desc,$anIn,$act){
        $this->id = $id;
        $this->cost = $cost;
        $this->fabricationYear = $fab;
        $this->description = $desc;
        $this->anualPercIncrement = $anIn;
        $this->activo = $act;
    }
    //metodos de acceso

    /**
     * @return float|int
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * @return float|int
     */
    public function getCost(){
        return $this->cost;
    }
    
    /**
     * @return float|int
     */
    public function getFabricationYear(){
        return $this->fabricationYear;
    }
    
    /**
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }
    
    /**
     * @return float|int
     */
    public function getAnualPercIncrement(){
        return $this->anualPercIncrement;
    }

    /**
     * @return boolean
     */
    public function getActivo(){
        return $this->activo;
    }
    
    //metodos modificadores

    /**
     * @param float|int $var
     */
    public function setId($var){
        $this->id = $var;
    }
    
    /**
     * @param float|int $var
     */
    public function setCost($var){
        $this->cost = $var;
    }
    
    /**
     * @param float|int $var
     */
    public function setFabricationYear($var){
        $this->fabricationYear = $var;
    }
    
    /**
     * @param string $var
     */
    public function setDescription($var){
        $this->description = $var;
    }
    
    /**
     * @param float|int $var
     */
    public function setAnualPercIncrement($var){
        $this->anualPercIncrement = $var;
    }

    /**
     * @param boolean $var
     */
    public function setActivo($var){
        $this->activo = $var;
    }

    //metodos propios de la clase
    public function darPrecioVenta(){
        $valor=0;
        if($this->getActivo()){
            $valor = $this->getCost()+($this->getCost()*($this->getAnualPercIncrement()*(2023-$this->getFabricationYear())));
        }
        return $valor;
    }

    //metodo to string
    public function __toString(){
        return "Vehículo: ".$this->getId()."\nCosto: ".$this->getCost().
        "\nAño de Fabricación: ".$this->getFabricationYear()."\nDescripción: ".$this->getDescription()
        ."\nIncremento porcentual anual: ".$this->getAnualPercIncrement()."\nEsta disp. para la venta?: ".($this->getActivo()?"Si":"No");
    }
}
?>