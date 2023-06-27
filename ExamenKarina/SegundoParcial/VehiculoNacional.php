<?php
include_once 'Vehiculo.php';
class VehiculoNacional extends Vehiculo{
    private $discount;
    
    public function __construct($id,$cost,$fab,$desc,$anIn,$act,$dis=0.85){
        parent :: __construct($id,$cost,$fab,$desc,$anIn,$act);
        $this->discount = $dis;
        
    }

    //metodo observador
    
    /**
     * @return float|int
     */
    public function getDiscount(){
        return $this->discount;
    }

    //metodo modificador

    /**
     * @param float|int
     */
    public function setDiscount($dis){
        $this->discount = $dis;
    }

    //metodos propios

    /**
     * calcula el precio de venta con descuento por vehiculo nacional
     * @return float|int
     */
    public function darPrecioVenta(){
        return parent::darPrecioVenta() * $this->getDiscount();
    }
    

    //__toString()
    public function __toString(){
        return parent :: __toString()."\nDescuento: ".$this->getDiscount();
    }
}
?>