<?php
include_once "BaseDatos.php";

class Responsable{

    private $rnumeroempleado;
    private $rnumerolicencia;
    private $rnombre;
    private $rapellido;
    private $mensajeoperacion;

    public function __construct(){
        $this->rnumeroempleado = 0;
        $this->rnumerolicencia ="";
        $this->rnombre="";
        $this->rapellido="";
    }

    public function cargar ($pnumE,$pnumL, $pnomb, $pape){
		$this->setNumeroE($pnumE);
        $this->setNumeroL($pnumL);
        $this->setNombre($pnomb);
        $this->setApellido($pape);
    }

    public function getNumeroE(){
        return $this->rnumeroempleado;
    }

    public function getNumeroL(){
        return $this->rnumerolicencia;
    }

    public function getNombre(){
        return $this->rnombre;
    }

    public function getApellido(){
        return $this->rapellido;
    }

    public function getMensajeOperacion(){
        return $this->mensajeoperacion;
    }

    public function setNumeroE($pnum){
        $this->rnumeroempleado = $pnum;
    }

    public function setNumeroL($pnum){
        $this->rnumerolicencia = $pnum;
    }

    public function setNombre($pnom){
        $this->rnombre = $pnom;
    }

    public function setApellido($pape){
        $this->rapellido = $pape;
    }

    public function setmensajeoperacion($pmensaje){
        $this->mensajeoperacion = $pmensaje;
    }



    /**
	 * Recupera los datos de un responsable por su numero de empleado
	 * @param int $numE
	 * @return true
	 */		
    public function Buscar($numE){
		$base=new BaseDatos();
		$consultaResp="Select * from responsable where rnumeroempleado=" . $numE;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResp)){
				if($row2=$base->Registro()){					
				    $this->setNumeroE($numE);
                    $this->setNumeroL($row2['rnumerolicencia']);
					$this->setNombre($row2['rnombre']);
					$this->setApellido($row2['rapellido']);
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
	    $arregloresp = null;
		$base=new BaseDatos();
		$consultaResp="Select * from responsable ";
		if ($condicion!=""){
		    $consultaResp=$consultaResp.' where '.$condicion;
		}
		$consultaResp.=" order by rapellido ";
		
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResp)){				
				$arregloresp= array();
				while($row2=$base->Registro()){
					
					$numeroE=$row2['rnumeroempleado'];
					$numeroL=$row2['rnumerolicencia'];
					$nombre=$row2['rnombre'];
                    $apellido=$row2['rapellido'];
				
					$pResponsable=new Responsable();
					$pResponsable->cargar($numeroE,$numeroL,$nombre, $apellido);
					array_push($arregloresp,$pResponsable);	
				}							
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());		 	
		 }	
		 return $arregloresp;
	}	



    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
				VALUES (".$this->getNumeroL().",'".$this->getNombre()."','".$this->getApellido()."')";
		if($base->Iniciar()){
			if($id = $base->devuelveIDInsercion($consultaInsertar)){
                $this->setNumeroE($id);
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
		$consultaModifica="UPDATE responsable SET rnumerolicencia=".$this->getNumeroL().",rnombre='".$this->getNombre()."',rapellido='".$this->getApellido()."' WHERE rnumeroempleado=". $this->getNumeroE();
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
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNumeroE();
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
        return "\nNombre y apellido: " . $this->getNombre() . " " . $this->getApellido() . ".\nNumero de empleado: " . $this->getNumeroE() . ".\nNumero de licencia: " . $this->getNumeroL() . ".\n";
    }
}
?>