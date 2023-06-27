<?php
include_once 'Vehiculo.php';

class VehiculoImportado extends Vehiculo{
    private $origin;
    private $importTax;

    public function __construct($id,$cost,$fab,$desc,$anIn,$act,$origin,$impT=1){
        parent :: __construct($id,$cost,$fab,$desc,$anIn,$act);
        $this->origin = $origin;
        $this->importTax = $impT;
    }

    //metodos observadores

    /**
     * @return string
     */
    public function getOrigin(){
        return $this->origin;
    }

    /**
     * @return float|int
     */
    public function getImportTax(){
        return $this->importTax;
    }

    //metodos modificadores

    /**
     * @param string $org
     */
    public function setOrigin($org){
        $this->origin = $org;
    }

    /**
     * @param float|int $impT
     */
    public function setImportTax($impT){
        $this->importTax = $impT;
    }
    //metodo propio

    public function darPrecioVenta(){
        return parent::darPrecioVenta()*$this->getImportTax();
    }
    //__toString

    public function __toString(){
        $cad = parent:: __toString();
        $cad.= "\nPaís de Origen: ".$this->getOrigin()."\nImpuesto de Importacion: ".$this->getImportTax();
        return $cad;
    }

}
?>