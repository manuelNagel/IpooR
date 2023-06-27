<?php
include_once "BaseDatos.php";
include_once "Responsable.php";
include_once "Empresa.php";
include_once "Pasajero.php";

class Viaje{

    private $idviaje;
    private $vdestino;
    private $vcantmaxpasajeros;
    private $colpasajeros;
    private $vimporte;
    private $idempresa; // OBJETO EMPRESA
    private $rnumeroempleado; // OBJETO RESPONSABLE
    private $mensajeoperacion;

    public function __construct(){
        $this->idviaje=0;
        $this->vdestino="";
        $this->vcantmaxpasajeros="";
        $this->colpasajeros= [];
        $this->vimporte="";
        $this->rnumeroempleado="";
        $this->idempresa="";
    }

    public function cargar($pIdViaje,$pdestino, $pcantidad, $pimporte, $presp, $pidE){
        $this->setID($pIdViaje);
        $this->setDestino($pdestino);
        $this->setCantidad($pcantidad);
        $this->setImporte($pimporte);
        $this->setResponsable($presp);
        $this->setIdEmpresa($pidE);
    }

    public function getID(){
        return $this->idviaje;
    }

    public function getDestino(){
        return $this->vdestino;
    }

    public function getCantidad(){
        return $this->vcantmaxpasajeros;
    }

    public function getColeccion(){
        return $this->colpasajeros;
    }

    public function getImporte(){
        return $this->vimporte;
    }

    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    public function getResponsable(){
        return $this->rnumeroempleado;
    }

    public function getIdEmpresa(){
        return $this->idempresa;
    }

    public function setID($pid){
        $this->idviaje = $pid;
    }

    public function setDestino($pdest){
        $this->vdestino = $pdest;
    }

    public function setCantidad($pcant){
        $this->vcantmaxpasajeros = $pcant;
    }

    public function setColeccion($pcol){
        $this->colpasajeros = $pcol;
    }

    public function setImporte($pimp){
        $this->vimporte = $pimp;
    }

    public function setmensajeoperacion($pmensaje){
        $this->mensajeoperacion = $pmensaje;
    }

    public function setResponsable($presp){
        $this->rnumeroempleado = $presp;
    }

    public function setIdEmpresa($pid){
        $this->idempresa = $pid;
    }



/**
	 * Recupera los datos de un viaje por su id de viaje
	 * @param int $id
	 * @return true
	 */		
    public function Buscar($id){
		$base=new BaseDatos();
		$consultaViajes="SELECT * FROM viaje WHERE idviaje=" . $id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViajes)){
				if($row2=$base->Registro()){					
				    $this->setID($id);
                    $this->setDestino($row2['vdestino']);
					$this->setCantidad($row2['vcantmaxpasajeros']);
					$this->setImporte($row2['vimporte']);
                    $this->setIdEmpresa($this->buscarEmpresa($row2['idempresa']));
                    $this->setResponsable($this->buscarResp($row2['rnumeroempleado']));
                    
					$resp= true;
				}						
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());	 	
		 }		
		 return $resp;
	}	



    public function listar($condicion=""){
	    $arregloviajes = null;
		$base=new BaseDatos();
		$consultaViajes="Select * from viaje ";
		if ($condicion!=""){
		    $consultaViajes=$consultaViajes.'where '.$condicion;
		}
		$consultaViajes.=" order by idviaje";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViajes)){		
				$arregloviajes= array();
                
				while($row2 = $base->Registro()){
					
					$idviaje=$row2['idviaje'];
					$destino=$row2['vdestino'];
					$cantidad=$row2['vcantmaxpasajeros'];
                    $importe=$row2['vimporte'];
                    $empresa=$this->buscarEmpresa($row2['idempresa']);
                    $responsable=$this->buscarResp($row2['rnumeroempleado']);
				
					$pViaje=new Viaje();
					$pViaje->cargar($idviaje, $destino, $cantidad, $importe, $responsable, $empresa);
                    
					array_push($arregloviajes,$pViaje);	
				}							
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());		 	
		 }	
		 return $arregloviajes;
	}	



    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO viaje(vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte) 
				VALUES ('".$this->getDestino()."',".$this->getCantidad()."," . $this->getIdEmpresa()->getID(). ",".$this->getResponsable()->getNumeroE(). ",". $this->getImporte(). ")";
                if($base->Iniciar()){
			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setID($id);
			    $resp=  true;
			}	else {
				$this->setmensajeoperacion($base->getError());	
			}
		} else {
				$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}



    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE viaje SET vdestino='".$this->getDestino()."',vimporte=".$this->getImporte().",vcantmaxpasajeros=".$this->getCantidad().",idempresa=".$this->getIdEmpresa()->getID().",rnumeroempleado=".$this->getResponsable()->getNumeroE()." WHERE idviaje=". $this->getID();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
			}
		}else{
				$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}


    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getID();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
					$this->setmensajeoperacion($base->getError());
				}
		}else{
				$this->setmensajeoperacion($base->getError());			
		}
		return $resp; 
	}



    public function __toString(){
        $pas = new Pasajero();
        $cadena = "";
        $colpasajeros = $pas->listar('idviaje=' . $this->getID());
        foreach($colpasajeros as $p){
            $cadena .= "\n" . $p;
        }
        return "\nID Viaje: " . $this->getID() . ".\nEmpresa: " . $this->getIdEmpresa(). ".\nDestino: " . $this->getDestino() . ".\nCantidad Maxima: " . $this->getCantidad() . ".\nImporte: " . $this->getImporte().".\nResponsable: " . $this->getResponsable() . ".\nPasajeros: \n" . $cadena;
    }

    private function buscarEmpresa($id){
        $emp = new Empresa();
        $arrEmp = $emp->listar('idempresa=' . $id);
        return $arrEmp[0];
    }

    private function buscarResp ($numeroEmp){
        $resp = new Responsable();
        $arrResp = $resp->listar('rnumeroempleado='.$numeroEmp);
        return $arrResp[0];
    }
}
?>