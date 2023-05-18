<?php

    class ResponsableV{
        //atributos/propiedades(php)
        private $numEmpleado;
        private $numLicencia;
        private $nombre;
        private $apellido;
        //constructor
        public function __construct($nEmp,$nLic,$nom,$srName){
            $this->numEmpleado=$nEmp;
            $this->numLicencia=$nLic;
            $this->nombre=$nom;
            $this->apellido=$srName;
        }
        //observadores
        /**
         * @return int
         */
        public function getNumEmpleado(){
            return $this->numEmpleado;
        }
        /**
         * @return int
         */
        public function getNumLicencia(){
            return $this->numLicencia;
        }
        /**
         * @return string
         */
        public function getNombre(){
            return $this ->nombre;
        }
        /**
         * @return string
         */
        public function getApellido(){
            return $this->apellido;
        }
        //metodos modificadores
        /**
         * @param int $numE
         */
        public function setNumEmpleado($numE){
            $this->numEmpleado=$numE;

        }
        /**
         * @param int $numL
         */
        public function setNumLicencia($numL){
            $this->numLicencia=$numL;
        }
        /**
         * @param string $nom
         */
        public function setNombre($nom){
            $this->nombre->$nom;
        }
        public function setApellido($apell){
            $this->apellido=$apell;
        }
        //metodo __toString
        public function __toString()
        {
            return "\nNombre y apellido del responsable: ".$this->getNombre()." ".$this->getApellido()."\nNúmero de licencia: ".$this->getNumLicencia()
            ."\nNúmero de Empleado: ".$this->getNumEmpleado;
        }
    }

?>