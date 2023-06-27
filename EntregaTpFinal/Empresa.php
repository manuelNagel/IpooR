<?php
include_once "BaseDatos.php";

class Empresa {

    private $idempresa;
    private $enombre;
    private $edireccion;
	private $mensajeoperacion;

    public function __construct() {
        $this->idempresa = 0;
        $this->enombre = "";
        $this->edireccion = "";
    }

    public function cargar ($pID,$pNombre, $pDireccion) {
		$this->setIdempresa($pID);
        $this->setNombre($pNombre);
        $this->setDireccion($pDireccion);
    }


    public function getID(){
        return $this->idempresa;
    }

    public function getNombre(){
        return $this->enombre;
    }

    public function getDireccion(){
        return $this->edireccion;
    }

	public function getMensajeOperacion(){
		return $this->mensajeoperacion;
	}

    
    public function setIdEmpresa($pID){
        $this->idempresa = $pID;
    }

    public function setNombre($pNombre){
        $this->enombre = $pNombre;
    }

    public function setDireccion($pDireccion){
        $this->edireccion = $pDireccion;
    }

	public function setmensajeoperacion($pmensajeoperacion){
		$this->mensajeoperacion=$pmensajeoperacion;
	}

    /**
	 * Recupera los datos de una empresa por su id
	 * @param int $id
	 * @return true
	 */		
    public function Buscar($id){
		$base=new BaseDatos();
		$consultaPersona="Select * from empresa where idempresa=".$id;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPersona)){
				if($row2=$base->Registro()){					
				    $this->setIdEmpresa($id);
					$this->setNombre($row2['enombre']);
					$this->setDireccion($row2['edireccion']);
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
	    $arregloempresa = null;
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa ";
		if ($condicion!=""){
		    $consultaEmpresa=$consultaEmpresa.' where '.$condicion;
		}
		$consultaEmpresa.=" order by enombre ";
		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){				
				$arregloempresa= array();
				while($row2=$base->Registro()){
					
					$id=$row2['idempresa'];
					$nombre=$row2['enombre'];
					$direccion=$row2['edireccion'];
				
					$empre=new Empresa();
					$empre->cargar($id,$nombre,$direccion);
					array_push($arregloempresa,$empre);
	
				}							
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());		 	
		 }	
		 return $arregloempresa;
	}	


    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO empresa(enombre, edireccion) 
				VALUES ('".$this->getNombre()."','".$this->getDireccion()."')";
		
		if($base->Iniciar()){

			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setIdEmpresa($id);
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
		$consultaModifica="UPDATE empresa SET enombre='".$this->getNombre()."',edireccion='".$this->getDireccion()."' WHERE idempresa=". $this->getID();
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
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getID();
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
        return "\nID EMPRESA: " . $this->getID(). ".\nNOMBRE: " . $this->getNombre() . ".\nDIRECCION: " . $this->getDireccion() . ".\n";
    }
}
?>