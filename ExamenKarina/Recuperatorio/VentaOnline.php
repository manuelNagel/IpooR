<?php
include_once 'Venta.php';
class VentaOnline extends Venta{
private $address;
private $recipientId;
private $contactNumber;

public function __construct($id,$date,$client,$colV,$price,$addr,$repId,$contNum){
    parent :: __construct($id,$date,$client,$colV,$price);
    $this->address = $addr;
    $this->recipientId = $repId;
    $this->contactNumber = $contNum;
}

//metodos observadores

/**
 * @return string
 */
public function getAddress(){
    return $this->address;
}

/**
 * @return int
 */
public function getRecipientId(){
    return $this->recipientId;
}

/**
 * @return int
 */
public function getContactNumber(){
    return $this->contactNumber;
}

//metodos modificadores

/**
 * @param string $addr
 */
public function setAddress($addr){
    $this->address = $addr;
}

/**
 * @param int $id
 */
public function setRecipientId($id)
{
    $this->recipientId = $id;
}

/**
 * @param int $contN
 */
public function setContactNumber($contN){
    $this->contactNumber = $contN;
}
//metodos propios

/**
 * metodo para retornar el total de venta nacional con sobrecargo por venta online
 */
public function retornarTotalVentaNacional(){
return parent::retornarTotalVentaNacional()*1.15;
}

/**
 * metodo para incorporar vehiculo online
 */
public function incorporarVehiculo($objVehiculo){
parent :: incorporarVehiculo($objVehiculo);
$this->setFinalPrice($this->getFinalPrice()*1.15);
}

public function registrarInformacionVenta($info){
    parent::registrarInformacionVenta($info);
    foreach($info as $attr=>$attr_value){
        switch($attr){
            case "address":$this->setAddress($attr_value);break;
            case "recipientId":$this->setRecipientId(gettype($attr_value)==='string'?intval($attr_value):$attr_value);break;
            case "contactNumber":$this->setContactNumber(gettype($attr_value) ==='string'?intval($attr_value):$attr_value);break;
            default:;break;
        }
    }
}
// __toString()

public function __toString()
{
    return parent::__toString()."\nDirección: ".$this->getAddress()."\nDNI de persona recibidora: ".$this->getRecipientId()."\nNumero de contacto: ".$this->getContactNumber();
}
}
?>