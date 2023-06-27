<?php
class Concesionaria{
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
     * metodo que devuelve un vehiculo si coincide con el codigo proveido
     * @param string $codigoVehiculo
     * @return Vehiculo || null
     */
    public function retornarVeículo($codigoVehículo){
        $colVehicles = $this->getColVehiculos();
        foreach($colVehicles as $vehicle){
            if($vehicle->getId() === $codigoVehículo){
                return $vehicle;
            }
        }
        return null;
    }

    /**
     * @param Array $colCodigosVehículos
     * @param Cliente $objCliente
     */
    public function registrarVenta($colCodigosVehículos,$objCliente){
        $colVehicles=[];
        $precioFinal=0;
        foreach($colCodigosVehículos as $id){
            $vehicle=$this->retornarVeículo($id);
            $colVehicles=array_push($colVehicles,$vehicle);
            if($colVehicles.count()>0){
                $precioFinal+=$vehicle->darPrecioVenta();
            }
        }
        $ventas=$this->getColVentas();
        echo "introduzca la fecha del dia de hoy en formato dd/MM/YYYY";
            $fecha = trim(fgets(STDIN));
        if($ventas.Count()>0){
            $id=$ventas.Count()+1;
            $ventas = array_push($ventas,new Venta($id,$fecha,$objCliente,$colVehicles,$precioFinal));
            echo "Operacion Exitosa";
        }else{
            $this->setColVentas(array(new Venta(1,$fecha,$objCliente,$colVehicles,$precioFinal)));
            echo "Operacion Exitosa";
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
                $colVentasClientes=array_push($colVentasClientes,$venta);
                echo $venta;
            }
        }
        return $colVentasClientes;
    }



    //metodo to string
    public function __toString(){
        $output = "\nDenominación: ".$this->getDenomination()."\nDirección: ".$this->getAddress()."\n Clientes:\n  " ;
        foreach($this->getColClientes as $client){
            $output .= $cliente->__toString()."\n  ";
        }
        $output.="\nVehiculos:\n  ";
        foreach($this->getColVehiculos as $vehicles){
            $output .= $vehicles->__toString()."\n  ";
        }
        $output.= "\nVentas:\n  ";
        foreach($this->getColVentas() as $sales){
            $output.=$sales->__toString()."\n  ";
        }
    }
}
?>