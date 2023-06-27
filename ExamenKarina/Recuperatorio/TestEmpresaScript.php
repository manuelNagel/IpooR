<?php
  include_once 'VehiculoNacional.php';
  include_once 'VehiculoImportado.php';
  include_once 'Venta.php';
  include_once 'Empresa.php';
  include_once 'Venta.php';
  include_once 'Cliente.php';
  include_once 'VentaLocal.php';
  include_once 'VentaOnline.php';

  //script
  //variables
  $arrInfoOnLine=array( "address" => "argentino roca 416","recipientId"=>"42735572", "contactNumber" => "02995579157");
  $arrInfoLocal=array("dayOfWithdrawal"=>"10","timeOfWithdrawal"=>"13:00");

  //punto 1
  //Clientes | punto 1
  $objCliente1 = new Cliente("Manuel","Nagel",false,"VIP","1");
  $objCliente2 = new Cliente("Juan","Sabio",false,"Comun","2");

  //punto 2
   //Vehiculos | punto 2
   $objVehiculo11 = new VehiculoNacional(11,50000,2020,"Volkswagen Polo POLO TRENDLINE",0.85,true,0.90);
   $objVehiculo12 = new VehiculoNacional(12,10000,2021,"RAM 1500 Laramie",0.70,true,0.90);
   $objVehiculo13 = new VehiculoNacional(13,10000,2022,"Jeep Renegade 1.8 Sport",0.55,false);
   //decidi hacerlo por porcentaje por lo que 6244400 representa el 49,95 % del precio ingresado al vehiculo importado
   $objVehiculo14 = new VehiculoImportado(14,12499900,2020,"Ferrari",1,true,"Italia",1.4995);
  
   //punto 3
   $empresa = new Empresa("Alta Gama","Av Argenetina 123",array($objCliente1,$objCliente2),array($objVehiculo11,$objVehiculo12,$objVehiculo13,$objVehiculo14),array());
    //para cumplir con el punto 9 instanciamos en otra variable nuevamente la variable empresa del punto 3
    $empresaPunto3 = clone $empresa;

    //punto 4
    echo"\npunto 5\n";
    $empresa->registrarVenta([11,12,13,14],$objCliente2,"on-line",$arrInfoOnLine);

    //punt 5
    echo "\npunto 5\n";
    $empresa->registrarVenta([0,14],$objCliente2,'local',$arrInfoLocal);

    //punto 6
    echo "\npunto 6\n";
    $empresa->registrarVenta([2,14],$objCliente2,'local',$arrInfoLocal);

    //punto 7 
    echo "\nPunto 7\n";
    $ventasOnline=$empresa->retornarVentasOnline();
    if(!empty($ventasOnline)){
        foreach($ventasOnline as $venta){
            echo $venta;
        }
    }else{
        echo "no hay ventas online en la empresa\n";
    }
    
    //punto 8
    echo "El importe de ventas locales es: ".$empresa->retornarImporteVentasEnLocal();

    //punto 9
    
    echo "\n\n\nEmpresa con valores instanciada en el putno 3: \n\n\n".$empresaPunto3;
    echo "\n\n\nEmpresa con valores modificados por script: \n\n\n".$empresa;
?>