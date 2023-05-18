<?php
    class Calculadora{
        //propiedades
        private $valor1;
        private $valor2;

        public function __construct($valor1,$valor2){
            $this->valor1=$valor1;
            $this->valor2=$valor2;
        }

        //observadores
        public function getValor1(){
            return $this->valor1;
        }

        public function getValor2(){
            return $this->valor2;
        }

        //seteadores
        public function setValor1($valor){
            $this->valor1 = $valor;
        }

        public function setValor2($valor){
            $this->valor2 = $valor;
        }

        //metodos propios

        //multiplica dos valores
        public function multiplicar(){
            return $this->getValor1() * $this->getValor2();
        }

        public function sumar(){
            return $this->getValor1() + $this->getValor2();
        }
        
        public function restar(){
            return $this->getValor1() - $this->getValor2();
        }

        public function dividir(){
            if($this->getValor2() !=0){
                return $this->getValor1()/$this->getValor2();
            }else{
                echo("\nNo se puede dividir por cero");
                return null;
            }
        }

        public function __toString(){
            return "El primer valor es: ".$this->getValor1()."\nEl segundo valor es: ".$this->getValor2();
            
        }

    }
?>