<?php
include  'Pasajero.php';


class PasajeroEspecial extends Pasajero{
    private $TipoNecesidad;

    public function __construct($nom,$numA,$numT,$tip){
        parent::__construct($nom,$numA,$numT);
        $this->TipoNecesidad = $tip;
    }

    //metodo Observador
    public function getTipoNecesidad(){
        return $this->TipoNecesidad;
    }

    //metodo modificador
    public function setTipoNecesidad($tip){
        $this->TipoNecesidad = $tip;
    }
    //metodos propios
    
    /**
     * Metodo que retorna el porcentaje de incremento
     * @return int
     */
    public function darPorcentajeIncremento(){
        $porc= parent::darPorcentajeIncremento();
        $tipoN=$this->getTipoNecesidad;
        $cond = $tipoN->HayNecesidad();
        if(cond){
            $cont=0;
            $cont += $tipoN->getSillaRuedas() ? 1 : 0;
            $cont += $tipoN->getAsistenciaEmbarque() ? 1 : 0;
            $cont += $tipoN->getAsistenciaDesembarque() ? 1 : 0;
            $cont += $tipoN->getComidaEsp() ? 1 : 0;
            $cont += $tipoN->getRestAlim() ? 1 : 0;
            
            if($cont>1){
                $porc=1.30;
            } elseif($cont==1){
                $porc=1.15;
            }
            
        }
        return $porc;
    }

    //metodo __toString()
    public function __toString(){
        $cad = parent:: __toString();
        $cad.= $this->getTipoNecesidad();
        return $cad;
    }
}
?>