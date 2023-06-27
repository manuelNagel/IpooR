<?php
class BaseDatos {
    private $HOSTNAME;
    private $BASEDATOS;
    private $USUARIO;
    private $CLAVE;
    private $CONEXION;
    private $QUERY;
    private $RESULT;
    private $ERROR;

    public function __construct(){
        $this->HOSTNAME = "127.0.0.1";
        $this->BASEDATOS = "bdviajes";
        $this->USUARIO = "root";
        $this->CLAVE = "Stroppierdoor13";
        $this->RESULT = 0;
        $this->QUERY = "";
        $this->ERROR = "";
    }

    public function getError(){
        return "\n".$this->ERROR;
    }

    public function Iniciar(){
        $resp = false;
        $conexion = new mysqli($this->HOSTNAME, $this->USUARIO, $this->CLAVE, $this->BASEDATOS);

        if (!$conexion->connect_errno) {
            $this->CONEXION = $conexion;
            unset($this->QUERY);
            unset($this->ERROR);
            $resp = true;
        } else {
            $this->ERROR = $conexion->connect_errno . ": " . $conexion->connect_error;
        }

        return $resp;
    }

    public function Ejecutar($consulta){
        $resp = false;
        unset($this->ERROR);
        $this->QUERY = $consulta;

        if ($this->RESULT = $this->CONEXION->query($consulta)) {
            $resp = true;
        } else {
            $this->ERROR = $this->CONEXION->errno . ": " . $this->CONEXION->error;
        }

        return $resp;
    }

    public function Registro() {
        $resp = null;

        if ($this->RESULT) {
            unset($this->ERROR);
            if ($temp = $this->RESULT->fetch_assoc()) {
                $resp = $temp;
            } else {
                $this->RESULT->free_result();
            }
        } else {
            $this->ERROR = $this->CONEXION->errno . ": " . $this->CONEXION->error;
        }

        return $resp;
    }

    public function devuelveIDInsercion($consulta){
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;

        if ($this->RESULT = $this->CONEXION->query($consulta)) {
            $id = $this->CONEXION->insert_id;
            $resp = $id;
        } else {
            $this->ERROR = $this->CONEXION->errno . ": " . $this->CONEXION->error;
        }

        return $resp;
    }
}
?>