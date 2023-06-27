<?php

class Cliente {
    //atributos
    private $name;
    private $surName;
    private $dischargeCondition;
    private $typeOfClient;
    private $id;

    //Constructor
    public function __construct($name,$surN,$dis,$typ,$id){
        $this->name = $name;
        $this->surName = $surN;
        $this->dischargeCondition = $dis;
        $this->typeOfClient = $typ;
        $this->id = $id;
    }
    //metodos observadores

    /**
     * @return string;
     */
    public function getName(){
        return $this->name; 
    }
    
    /**
     * @return string
     */
    public function getSurName(){
        return $this->surName; 
    }
    
    /**
     * @return bool
     */
    public function getDischargeCondition(){
        return $this->dischargeCondition; 
    }
    
    /**
     * @return string
     */
    public function getTypeOfClient(){
        return $this->typeOfClient; 
    }
    
    /**
     * @return string
     */
    public function getId(){
        return $this->id; 
    }

    //Metodos modificadores

    /**
     * @param string $var 
     */
    public function setName ($var){
        $this->name = $var;
    }
    
    /**
     * @param string var 
     */
    public function setSurName ($var){
        $this->surName = $var;
    }
    
    /**
     * @param bool var 
     */
    public function set ($var){
        $this->dischargeCondition = $var;
    } 
    
    /**
     * @param string var 
     */
    public function setTypeOfClient ($var){
        $this->typeOfClient = $var;
    } 
    
    /**
     * @param string var 
     */
    public function setId ($var){
        $this->id = $var;
    } 
    
    


    //To String
    public function __toString(){
        return "\nCliente : ".$this->getName()." ".$this->getSurName()."\nDocumento: ".$this->getId()."\nCondicion de baja: ".
                $this->getDischargeCondition()."\nTipo de Cliente: ".$this->getTypeOfClient();
    }


}
?>