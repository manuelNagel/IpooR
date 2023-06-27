<?php
    include_once 'VehiculoNacional.php';
    include_once 'VehiculoImportado.php';
    include_once 'Venta.php';
    include_once 'Empresa.php';
    include_once 'Venta.php';
    include_once 'Cliente.php';

    //instancias para prueba
    //Clientes | punto 1
    $objCliente1 = new Cliente("Manuel","Nagel",false,"VIP","1");
    $objCliente2 = new Cliente("Juan","Sabio",false,"Comun","2");
    //Vehiculos | punto 2
    $objVehiculo11 = new VehiculoNacional(11,50000,2020,"Volkswagen Polo POLO TRENDLINE",0.85,true,0.90);
    $objVehiculo12 = new VehiculoNacional(12,10000,2021,"RAM 1500 Laramie",0.70,true,0.90);
    $objVehiculo13 = new VehiculoNacional(13,10000,2022,"Jeep Renegade 1.8 Sport",0.55,false);
    //decidi hacerlo por porcentaje por lo que 6244400 representa el 49,95 % del precio ingresado al vehiculo importado
    $objVehiculo14 = new VehiculoImportado(14,12499900,2020,"Ferrari",1,true,"Italia",1.4995);

    //Empresa | punto 3
    $empresa = new Empresa("Alta Gama","Av Argenetina 123",array($objCliente1,$objCliente2),array($objVehiculo11,$objVehiculo12,$objVehiculo13,$objVehiculo14),array());
    //para cumplir con el punto 9 instanciamos en otra variable nuevamente la variable empresa del punto 3
    $empresaPunto3 = clone $empresa;
    //Continuamos
    //punto 4
    $empresa->registrarVenta(array(11,12,13,14),$objCliente2);
    echo "Visualizacion del punto 5: \n";
    echo $empresa;
    //punto 5
    $empresa->registrarVenta(array(0,14),$objCliente2);
    echo"Visualizacion del punto 5: \n";
    echo $empresa;
    //punto 6
    $empresa->registrarVenta(array(2,14),$objCliente2);
    //punto 7
    $colVentas=$empresa->informarVentasImportadas();
    echo "A continuacion las ventas del punto 7 \n";
    foreach($colVentas as $sale){
        echo $sale;
    }
    //punto 8 
    echo "\nSuma total de ventas nacionales: ". $empresa->informarSumaVentasNacionales();

    //punto 9
    echo $empresaPunto3;


?>