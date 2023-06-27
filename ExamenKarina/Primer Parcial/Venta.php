<?php
class Venta{
    private $id;
    private $date;
    private $Cliente;
    private $colVehiculos;
    private $finalPrice;

    public function __construct($id,$date,$client,$colV,$price){
        $this->id = $id;
        $this->date = $date;
        $this->Cliente = $client;
        $this->colVehiculos = $colV;
        $this->finalPrice = $price;
    }

    //metodos de acceso

    /**
     * @return number
     */
    public function getId(){
        $this->id;
    }
    
    /**
     * @return string
     */
    public function getDate(){
        $this->date;
    }
    
    /**
     * @return Cliente
     */
    public function getCliente(){
        $this->Cliente;
    }
    
    /**
     * @return Array
     */
    public function getColVehiculos(){
        $this->colVehiculos;
    }
    
    /**
     * @return number
     */
    public function getFinalPrice(){
        $this->finalPrice;
    }
    //metodos modificadores

    /**
     * @param number $var
     */
    public function setId($var){
        $this->id = $var;
    }
    
    /**
     * @param string $var
     */
    public function setDate($var){
        $this->date = $var;
    }
    
    /**
     * @param Cliente $var
     */
    public function setCliente($objectVar){
        $this->Cliente = $var;
    }
    
    /**
     * @param Array  $var
     */
    public function setColVehiculos($arrVar){
        $this->colVehiculos = $arrVar;
    }
    
    /**
     * @param number $var
     */
    public function setFinalPrice($var){
        $this->finalPrice = $var;
    }

    //metodos propios
    public function incorporarVehiculo($objVehiculo){
        if($objVehiculo->getActivo()){
            $arrVehicles=array_push($this->getColVehiculos(),$objVehiculo);
            $this->setColVehiculos($arrVehicles);
            /*manera que confia en el ingreso del usuario para el ingreso del precio final
            *$precioFinal=$this->getFinalPrice()+ $objVehiculo->darPrecioVenta();
            */
            //manera que no confia en ingreso de usuario
            $precioFinal=0;
            foreach($arrVehicles as $vehicle){
                $totalPrice += $vehicle->darPrecioVenta();
            }
            $this->setFinalPrice($totalPrice);
        }
    }
    //toString

    public function __toString(){
        $output = "\nVenta nro: " . $this->getId() . "\nCliente: " . $this->getCliente() . "\nVehiculos comprados:\n";
        foreach ($this->getColVehiculos() as $vehiculo) {
            $output .= $vehiculo->__toString() . "\n";
        }
        $output.= "\nPrecio Final: ".$this->getFinalPrice();
        
        return $output;
    }
}
?>

