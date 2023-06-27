<?php
include_once "BaseDatos.php";
include_once "Viaje.php";

class Pasajero {

    private $pdocumento;
    private $pnombre;
    private $papellido;
    private $ptelefono;
	private $idviaje;
    private $mensajeoperacion;

    public function __construct(){
        $this->pdocumento="";
        $this->pnombre="";
        $this->papellido="";
        $this->ptelefono="";
		$this->idviaje="";
    }

    public function cargar ($pdoc, $pnom, $pape, $ptel, $pid){
        $this->setDocumento($pdoc);
        $this->setNombre($pnom);
        $this->setApellido($pape);
        $this->setTelefono($ptel);
		$this->setIdViaje($pid);
    }

    public function getDocumento(){
        return $this->pdocumento;
    }

    public function getNombre(){
        return $this->pnombre;
    }

    public function getApellido(){
        return $this->papellido;
    }

    public function getTelefono(){
        return $this->ptelefono;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }

	public function getIdViaje(){
		return $this->idviaje;
	}

    public function setDocumento($pdoc){
        $this->pdocumento = $pdoc;
    }

    public function setNombre($pnom){
        $this->pnombre = $pnom;
    }

    public function setApellido($pape){
        $this->papellido = $pape;
    }

    public function setTelefono($ptel){
        $this->ptelefono = $ptel;
    }

    public function setmensajeoperacion($pMensaje){
        $this->mensajeoperacion = $pMensaje;
    }

	public function setIdViaje($pid){
		$this->idviaje = $pid;
	}


    /**
	 * Recupera los datos de una pasajero por dni
	 * @param int $dni
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
    public function Buscar($dni){
		$base=new BaseDatos();
		$consultaPasajero="Select * from pasajero where pdocumento='".$dni."'";
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row2=$base->Registro()){					
				    $this->setDocumento($dni);
					$this->setNombre($row2['pnombre']);
					$this->setApellido($row2['papellido']);
					$this->setTelefono($row2['ptelefono']);
					$this->setIdViaje($this->buscarViaje($row2['idviaje']));
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
	    $arreglopasajeros = null;
		$base=new BaseDatos();
		$consultaPasajeros="Select * from pasajero ";
		if ($condicion!=""){
		    $consultaPasajeros=$consultaPasajeros.' where '.$condicion;
		}
		$consultaPasajeros.=" order by papellido ";
		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajeros)){				
				$arreglopasajeros= array();
				while($row2=$base->Registro()){
					
					$dni=$row2['pdocumento'];
					$nombre=$row2['pnombre'];
					$apellido=$row2['papellido'];
                    $telefono=$row2['ptelefono'];
					$id = $this->buscarViaje($row2['idviaje']);
				
					$pasaje=new Pasajero();
					$pasaje->cargar($dni,$nombre,$apellido, $telefono, $id);
					array_push($arreglopasajeros,$pasaje);	
				}							
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());		 	
		 }	
		 return $arreglopasajeros;
	}	



    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		
		$consultaInsertar="INSERT INTO pasajero(pdocumento, pnombre, papellido, ptelefono, idviaje) 
				VALUES (".$this->getDocumento().",'".$this->getNombre()."','".$this->getApellido()."',".$this->getTelefono()."," . $this->getIdViaje()->getID() . ")";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaInsertar)){
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
		
		$consultaModifica="UPDATE pasajero SET pnombre='".$this->getNombre()."',papellido='".$this->getApellido()."',ptelefono=".$this->getTelefono().",idviaje=".$this->getIdViaje()->getID() ." WHERE pdocumento=". $this->getDocumento();
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
				$consultaBorra="DELETE FROM pasajero WHERE pdocumento='".$this->getDocumento()."'";
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
        return "\nNombre y apellido: " . $this->getNombre() . " " . $this->getApellido() . ".\nDocumento: " . $this->getDocumento() . ".\nTelefono: " . $this->getTelefono() . ".\nID Viaje: " . $this->getIdViaje()->getID() . ".\n";
    }

	private function buscarViaje($id){
		$viaje = new Viaje();
        $arr = $viaje->listar('idviaje='.$id);
        return $arr[0];
	}
}