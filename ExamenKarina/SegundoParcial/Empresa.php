<?php
//asumo que consecionaria es el equivalente a empresa
class Empresa{
    private $denomination;
    private $address;
    private $colClientes;
    private $colVehiculos;
    private $colVentas;

    public function __construct($den,$add,$colC,$colVeh,$colVen){
        $this-> denomination = $den;
        $this-> address = $add;
        $this-> colClientes = $colC;
        $this-> colVehiculos = $colVeh;
        $this-> colVentas = $colVen;
    }
    // Getters

    /**
     * @return string
     */
    public function getDenomination() {
        return $this->denomination;
    }

    /**
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * @return Array
     */
    public function getColClientes() {
        return $this->colClientes;
    }

     /**
     * @return Array
     */
    public function getColVehiculos() {
        return $this->colVehiculos;
    }

     /**
     * @return Array
     */
    public function getColVentas() {
        return $this->colVentas;
    }

    // Setters

    public function setDenomination($denomination) {
        $this->denomination = $denomination;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setColClientes($colClientes) {
        $this->colClientes = $colClientes;
    }

    public function setColVehiculos($colVehiculos) {
        $this->colVehiculos = $colVehiculos;
    }

    public function setColVentas($colVentas) {
        $this->colVentas = $colVentas;
    }

    //metodos propios
    /**
     * metodo que devuelve un vehiculo si coincide con el codigo proveido, mal escrito como proveido en el enunciado
     * @param string $codigoVehiculo
     * @return Vehiculo || null
     */
    public function retornarVeículo($codigoVehículo){
        $colVehicles = $this->getColVehiculos();
        foreach($colVehicles as $vehicle){
            if($vehicle->getId() == $codigoVehículo){
                return $vehicle;
            }
        }
        return null;
    }

    /**
     * retorna el importe total de las ventas nacionales realizadas por la empresa
     * @return float|int
     */
    public function informarSumaVentasNacionales(){
        $colVentas = $this->getColVentas();
        $salesSum = 0;
        foreach($colVentas as $sale){
            $salesSum+= $sale->retornarTotalVentaNacional();
        }
        return $salesSum;
    }

    /**
     * retorna una coleccion de ventas de vehiculos importados,informa la venta si tiene vehiculo importado
     * @return array
     */
    
    public function informarVentasImportadas()
    {
        $colVentas = $this->getColVentas();
        $colVentasImpVehicles = array();

        foreach ($colVentas as $sale) {
            $importedVehicles = $sale->retornarVehiculoImportado();

            if (!empty($importedVehicles)) {
                $colVentasImpVehicles[] = $sale;
                echo $sale;
            }
        }

        return $colVentasImpVehicles;
    }

    /**
     * @param Array $colCodigosVehículos
     * @param Cliente $objCliente
     */
    public function registrarVenta($colCodigosVehículos,$objCliente){
        $precioFinal=0;
        $colVehicles=[];
        foreach($colCodigosVehículos as $id){
            $vehicle=$this->retornarVeículo($id);
            if($vehicle!==null){
             $colVehicles[]=$vehicle;
             $precioFinal+=$vehicle->darPrecioVenta();
            }
        }
        $ventas=$this->getColVentas();
        echo "introduzca la fecha del dia de hoy en formato dd/MM/YYYY\n";
            $fecha = trim(fgets(STDIN));
        if(!empty($ventas)){
            $id=count($ventas)+1;
            $venta = new Venta($id,$fecha,$objCliente,$colVehicles,$precioFinal);
            $venta->setColVehiculos($colVehicles);
            $ventas[]=$venta;
            $this->setColVentas($ventas);
            echo "\nOperacion Exitosa\n";
        }else{
            $venta = new Venta(1,$fecha,$objCliente,$colVehicles,$precioFinal);
            $venta->setColVehiculos($colVehicles);
            $this->setColVentas([$venta]);
            echo "\nOperacion Exitosa\n";
        }
    }

    /**
     * Metodo que retorna la lista de ventas asociada a un cliente
     * @param $tipo
     * @param $numDoc
     * @return Array 
     */
    public function retornarVentasXCliente($tipo,$numDoc){
        $ventas = $this->getColVentas();
        $colVentasClientes=[];
        echo "\n Ventas al cliente tipo: ";
        foreach($ventas as $venta){
            if($venta->getId()==$numDoc){
                $colVentasClientes[]=$venta;
                echo $venta;
            }
        }
        return $colVentasClientes;
    }



    //metodo to string
    public function __toString(){
        //variables
        $colClientes = $this->getColClientes();
        $colVentas = $this->getColVentas();
        $colVehicles = $this->getColVehiculos();

        $output = "\nDenominación: ".$this->getDenomination()."\nDirección: ".$this->getAddress()."\n Clientes:\n  " ;
        if(!empty($colClientes)){
            foreach($colClientes as $client){
                $output .= $client."\n  ";
            }
        }else{
            $output.="No tiene clientes\n";
        }
        
        $output.="\nVehiculos:\n  ";

        if(!empty($colVehicles)){
            foreach($colVehicles as $vehicles){
                $output .= $vehicles."\n  ";
            }
        }else{
            $output.="No tiene Vehiculos asociados\n";
        }
        
        $output.= "\nVentas:\n  ";
        
        if(!empty($colVentas)){
            foreach($colVentas as $sales){
                $output.=$sales."\n  ";
            }
        }else{
            $output.="No tiene ventas asociadas\n";
        }
        
        return $output;
    }
}
?>