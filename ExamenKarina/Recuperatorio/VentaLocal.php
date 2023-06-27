<?php
include_once 'Venta.php';
class VentaLocal extends Venta{
    private $dayOfWithdrawal;
    private $timeOfWithdrawal;

    public function __construct($id,$date,$client,$colV,$price,$day,$time){
        parent::__construct($id,$date,$client,$colV,$price);
        $this->dayOfWithdrawal = $day;
        $this->timeOfWithdrawal = $time;
    }

    //metodos oobservadores

    /**
     * @return string
     */
    public function getDayOfWithdrawal(){
        return $this->dayOfWithdrawal;
    }

    /**
     * @return string
     */
    public function getTimeOfWithdrawal(){
        return $this->timeOfWithdrawal;
    }

    //metodos modificadores

    /**
     * @param string $day
     */
    public function setDayOfWithdrawal($day){
        $this->dayOfWithdrawal = $day;
    }

    /**
     * @param string $hour
     */
    public function setTimeOfWithdrawal($hour){
        $this->timeOfWithdrawal = $hour;
    }

    //metodos propios
    public function registrarInformacionVenta($info){
        parent::registrarInformacionVenta($info);
        foreach($info as $attr=>$attr_value){
            switch($attr){
                case "dayOfWithdrawal":$this->setDayOfWithdrawal($attr_value);break;
                case "timeOfWithdrawal":$this->setTimeOfWithdrawal($attr_value);break;
                default:;break;
            }
        }
    }
    //__toString()
    public function __toString()
    {
        return parent :: __toString()."\nDia de retiro:".$this->getDayOfWithdrawal()."\nHora de retiro: ".$this->getTimeOfWithdrawal();
    }
}

?>