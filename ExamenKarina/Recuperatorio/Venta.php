<?php
class Venta{
    private $id;
    private $date;
    private $Cliente;
    private $colVehiculos=[];
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
     * @return float|int
     */
    public function getId(){
        return $this->id;
    }
    
    /**
     * @return string
     */
    public function getDate(){
        return $this->date;
    }
    
    /**
     * @return Cliente
     */
    public function getCliente(){
        return $this->Cliente;
    }
    
    /**
     * @return Array
     */
    public function getColVehiculos(){
        return $this->colVehiculos;
    }
    
    /**
     * @return float|int
     */
    public function getFinalPrice(){
        return $this->finalPrice;
    }
    //metodos modificadores

    /**
     * @param int $var
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
     * @param Cliente $objectVar
     */
    public function setCliente($objectVar){
        $this->Cliente = $objectVar;
    }
    
    /**
     * @param Array  $var
     */
    public function setColVehiculos($arrVar){
        $this->colVehiculos = $arrVar;
    }
    
    /**
     * @param int $var
     */
    public function setFinalPrice($var){
        $this->finalPrice = $var;
    }

    //metodos propios
    /**
     * metodo para incorporar vehiculo
     */
    public function incorporarVehiculo($objVehiculo){
        if($this->getCliente()->getDischargeCondition()){
            if($objVehiculo->getActivo()){
                $arrVehicles=$this->getColVehiculos();
                $arrVehicles[]=$objVehiculo;
                $this->setColVehiculos($arrVehicles);
                
                $totalPrice=$this->getFinalPrice()+ $objVehiculo->darPrecioVenta();
                $this->setFinalPrice($totalPrice);
            }
        }else{
            echo "No se puede incorporar el vehiculo debido a que el cliente esta dado de baja\n";
        }
    }

    public function registrarInformacionVenta($info){
        foreach($info as $attr=>$attr_value){
            switch($attr){
                case "id":$this->setId($attr_value);break;
                case "date":$this->setDate($attr_value);break;
                case "Cliente":$this->setCliente($attr_value);break;
                case "colVehiculos":$this->setColVehiculos($attr_value) ;break;
                case "finalPrice": $this->setFinalPrice($attr_value) ;break;
                default:;break;
            }
        }
        
    }

    /**
     * metodo que retorna la sumatoria total del precio de venta de los vehiculos nacionales 
     * @return int|float
     */
    public function retornarTotalVentaNacional(){
        $arrVehicles = $this->getColVehiculos();
        $totalPrice=0;
        if($arrVehicles!==null){
            foreach ($arrVehicles as $vehicle){
                if($vehicle instanceof VehiculoNacional){
                    $totalPrice += $vehicle->darPrecioVenta();
                }
            }
        }
        return $totalPrice;
    }

    /**
     * metodo que retorna los vehiculos importados
     */
    public function retornarVehiculoImportado(){
        $arrVehicles = $this->getColVehiculos();
        $output = array();
        if($arrVehicles!==null){
            foreach($arrVehicles as $vehicle){
                if($vehicle instanceof VehiculoImportado){
                    array_push($output,$vehicle);
                }
            }
        }
        return $output;
    }
    //toString

    public function __toString()
    {
        $output = " Venta nro: " . $this->getId() . "\n";
        $output .= "Cliente: " . $this->getCliente() . "\n";
        $output .= "Vehiculos comprados:\n";
        $arrVehicles=$this->getColVehiculos();
        if(!(empty($arrVehicles)||$arrVehicles==null)){
            foreach ($arrVehicles as $vehicle) {
                $output .= $vehicle. "\n";
            }
        }else{
            $output.="No hay vehiculos asociados\n";
        }
        
        $output .= "Precio Final: " . $this->getFinalPrice() . "\n";

        return $output;
    }
}
?>

