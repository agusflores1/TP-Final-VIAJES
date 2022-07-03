<?php
require_once('Empresa.php');
require_once('Responsable.php');
require_once('Viaje.php');
require_once('Pasajero.php');

//MENU PRINCIPAL
do{
    echo "--MENU-- 
    1) Menu Empresa
    2) Menu Responsable
    3) Menu Viaje (Menu Pasajeros)
    4) Salir
    =================================\n";
    $opcionMenu=trim(fgets(STDIN));
    switch($opcionMenu) 
    {
    case 1:
     menuEmpresa();
     break;
    case 2:
    menuResponsable();
    break;
    case 3: 
    menuViaje();
    break;
    }
    }while($opcionMenu!=4);

//


function menuResponsable()
{ do{ echo 
    "->==MENU RESPONSABLE==
    1)Crear responsable.
    2)Modificar responsable.
    3)Eliminar responsable.
    4)Mostrar responsable.
    5)Salir \n";
    $opcionResponsable=trim(fgets(STDIN));
    switch($opcionResponsable)
    {
    case 1: //crear responsable
        echo "ingrese el nombre del responsable: \n";
        $nombre =  trim(fgets(STDIN));
        echo "ingrese el apellido del responsable: \n";
        $apellido =  trim(fgets(STDIN));
        echo "ingrese el numero de licencia del responsable: \n";
        $numLincencia=  trim(fgets(STDIN));
        if(is_numeric($numLincencia))
        {
        $objResponsable = new ResponsableV();
        $objResponsable->cargar($nombre,$apellido,$numLincencia,0);
        $resp = $objResponsable->insertar();
        if($resp){
        echo "El responsable se inserto a la Base de Datos correctamente!"."\n";}
        else{echo "No se pudo insertar el responsable\n";
            $objResponsable = null;}
        }
        else{echo "ERROR Debe Ingresar un Numero! Vuelva a Intentarlo.\n";}
        break;
    case 2: //Modificar segun ID
        $objResponsable = new ResponsableV();
        echo "Ingrese numero de Empleado a modificar:\n";
        $numEmpleado=trim(fgets(STDIN));  
        if(is_numeric($numEmpleado))
        { if($objResponsable->buscar($numEmpleado)) //Si encuentra el responsable, lo modifica
          {modificarResponsable($numEmpleado);}
          else{echo "El Responsable no existe!\n";}
        }
        else{echo "Debe ingresar un numero!\n";}
       
        break;
       
    case 3: //Eliminar 
        echo "Id de responsable que desea eliminar:\n";
        $numEmpleado =  trim(fgets(STDIN));
        if(is_numeric($numEmpleado))
        { $objResponsable = new ResponsableV();
        if($objResponsable->Buscar($numEmpleado))
        {$objResponsable->eliminar();
        echo "Eliminado con exito\n";}
        else
        {echo "no se encontro responsable";}
        }
        else
        {echo "Debe ingresar un NUMERO.\n";}
       
        break;

     case 4: //Muestra los datos del responsable segun ID
        $objResponsable = new ResponsableV();
        echo "Id de responsable que desea buscar:\n";
        $numEmpleado =  trim(fgets(STDIN));
        if(is_numeric($numEmpleado))
        {if($objResponsable->Buscar($numEmpleado))
        {echo $objResponsable->__toString();}
        else{echo "No se encontro el responsable\n";}
        }
        else{echo "Debe Ingresar un NUMERO\n";}
        break;
        
    } 
}while($opcionResponsable != 5);
}

function modificarResponsable($numEmpleado)
{   $objResponsable=new ResponsableV();
  do{
   // $objResponsable->buscar($numEmpleado);
    echo "->==MODIFICAR RESPONSABLE== \n
         Ingrese que dato desea cambiar: "."\n".
         "1. Modificar Nombre "."\n".
         "2. Modificar Apellido "."\n".
         "3. Modificar Numero de Licencia "."\n".
         "4. Ver datos "."\n".
         "5. Salir "."\n";
    $seleccion = trim(fgets(STDIN));
    $objResponsable->buscar($numEmpleado);//
    switch ($seleccion){
        case 1: 
            echo "Ingrese el nuevo nombre:\n "; 
            $nuevoNombre = trim(fgets(STDIN));
            $objResponsable->setNombre($nuevoNombre);
            $resp = $objResponsable->modificar();
            if($resp == true){
                echo "El nombre se ha cambiado correctamente!"."\n";
            }else{
                echo "El nombre no se pudo modificar \n";
            }
            break;

        case 2: 
            echo "Ingrese el nuevo apellido:\n"; 
            $nuevoApellido = trim(fgets(STDIN));
            $objResponsable->setApellido($nuevoApellido);
            $resp = $objResponsable->modificar();
            if($resp == true){
                echo "El apellido se ha cambiado correctamente!"."\n";
            }else{
                echo "El apellido no se pudo modificar\n";
            }
            break;

        case 3: 
            echo "Ingrese el nuevo numero de licencia:\n"; 
            $nuevoNumLicencia = trim(fgets(STDIN));
            if(is_numeric($nuevoNumLicencia))
            {$objResponsable->setNumLicencia($nuevoNumLicencia); //setea los datos
            $resp = $objResponsable->modificar(); //los modifica
            if($resp == true){
            echo "El numero de licencia se ha cambiado correctamente!"."\n";
            }else
            {echo "El numero de licencia no se pudo modificar";}
            }
            else{echo "Ingrese un numero valido.\n";}
            break;   
        case 4: 
            echo $objResponsable;
           break;
    }
    }while($seleccion != 5);
}
//

function menuEmpresa()
{ do{
    echo
    "->==MENU EMPRESA==
    1)Crear Empresa.
    2)Modificar Empresa.
    3)Eliminar Empresas.
    4)Mostrar Empresa.
    5)Mostrar Empresas.
    6)Salir \n";
    $opcionEmpresas=trim(fgets(STDIN));
    switch($opcionEmpresas){
    case 1:
            echo "Ingrese nombre de la empresa:\n";
            $nombreEmpresa=trim(fgets(STDIN));
            echo "Ingrese Direccion:\n";
            $direccionEmpresa=trim(fgets(STDIN));
            $objEmpresa = new Empresa();
            $objEmpresa->cargar(0,$nombreEmpresa,$direccionEmpresa);
            $resp = $objEmpresa->insertar();
            if($resp){
             echo "La empresa fue cargada correctamente!"."\n";
            }else{
                echo "No se pudo insertar error: \n"  ;
            }
            break;
    case 2:
        echo "Ingrese Numero Empresa a modificar:\n";
        $id=trim(fgets(STDIN));  
        if(is_numeric($id))
        { $objEmpresa=new Empresa();
        if($objEmpresa->buscar($id))
        {modificarEmpresa($id);}
        else
        {echo "No hay ninguna empresa registrada con ese ID. \n";}
        }
        else
        {echo "Debe ingresar un numero valido.\n";}
        break;

    case 3: //Eliminar Empresa
            $objEmpresa=new Empresa();
            echo "Id de empresa que desea eliminar:\n";
            $idEmpresa=trim(fgets(STDIN));
            if(is_numeric($idEmpresa))
            {if($objEmpresa->buscar($idEmpresa))
            {$objEmpresa->Eliminar();
            echo "Eliminada con exito!\n";}
            else
            {echo "No hay ninguna empresa registrada con ese ID \n";}
            }
            else
            {echo "Debe Ingresar un NUMERO valido.\n";}
            break;
    case 4:
         $objEmpresa=new Empresa();
         echo "Id de empresa que desea ver:\n";
        $idEmpresa=trim(fgets(STDIN));
        if(is_numeric($idEmpresa))
        { if($objEmpresa->buscar($idEmpresa))
            {echo $objEmpresa;}
            else
            {echo "No hay ninguna empresa registrada con ese ID \n";}
        }
        else{echo "Debe ingresar un NUMERO valido.\n";;}
       
        break;
    case 5:
        $objEmpresa=new Empresa();
       $empresas=$objEmpresa->listar("");
       foreach($empresas as $empresa)
      { echo "=====================================\n";
        echo $empresa;
        echo "====================================\n";}
        break;
} 
} while($opcionEmpresas!=6);
}

function modificarEmpresa($id)
{    $objEmpresa=new Empresa(); 
    do{
    echo    "->==MENU MODIFICAR==\n
            Ingrese que dato desea cambiar: "."\n".
             "1. Modificar Nombre "."\n".
             "2. Modificar Direccion "."\n".
             "3. Ver datos "."\n".
             "4. Salir "."\n";
        $seleccion = trim(fgets(STDIN));
        $objEmpresa->buscar($id);
        switch ($seleccion){
            case 1: 
                echo "Ingrese el nuevo nombre para la empresa:\n"; 
                $nuevoNombre = trim(fgets(STDIN));
                $objEmpresa->setNombre($nuevoNombre);
                $resp = $objEmpresa->modificar();
                if($resp == true){
                    echo "El nombre de la empresa se ha cambiado correctamente!"."\n";
                }else{
                    echo "El nombre de la empresa no se pudo modificar por el siguiente error: ".$resp;
                }
                break;
            case 2: 
                echo "Ingrese la nueva direccion:\n"; 
                $nuevaDireccion = trim(fgets(STDIN));
                $objEmpresa->setDireccion($nuevaDireccion);
                $resp = $objEmpresa->modificar();
                if($resp == true){
                    echo "La direccion se ha cambiado correctamente!"."\n";
                }else{
                    echo "La direccion no se pudo modificar\n";
                }
                break;
            case 3: 
                echo $objEmpresa;
                break;
            }
        }while($seleccion != 4);

}

function menuViaje()
{ 
do{
    echo
    "->==MENU VIAJE==
   1)Crear Viaje.
   2)Modificar Viaje.
   3)Eliminar Viaje.
   4)Mostrar Viaje.
   5)Mostrar Viajes.
   6)Salir \n
   =================================\n"; 
   $opcionViaje=trim(fgets(STDIN));
   switch($opcionViaje){
       case 1:
        do{
               echo "Ingrese Destino:\n";
               $destino=strtoupper(trim(fgets(STDIN)));
               //comparar que ningun viaje vaya a ese destino
               $existe=compararViajes($destino);
               if($existe==false)
               {
               echo "Ingrese Cantidad Maxima de Pasajeros:\n";
               $cantMaxPasajeros=trim(fgets(STDIN));
               if(!is_numeric($cantMaxPasajeros))
               { echo "Debe ingresar un NUMERO, vuelva a intentalo\n";
                 $existe=true;
                break;
               }
               $idEmpresa=obtenerEmpresa();
               $objResponsable=obtenerResponsable();
               echo "Ingrese importe del viaje:\n";
               $importe=trim(fgets(STDIN));
               echo "Ingrese Tipo de Asiento:\n";
               $tipoAsiento=strtoupper(trim(fgets(STDIN)));//valida que sea cama o semicama
            if($tipoAsiento=="CAMA" || $tipoAsiento=="SEMICAMA")
               {
               echo "Ingrese tipo viaje:\n";//validar que sea IDA o IDA Y VUELTA
               $tipoViaje=strtoupper(trim(fgets(STDIN)));
            if($tipoViaje=="IDA" || $tipoViaje=="IDA Y VUELTA")
               {
               $objViaje = new Viaje();
               $objViaje->cargar(0,$destino,$cantMaxPasajeros,$idEmpresa,$objResponsable,$importe,$tipoAsiento,$tipoViaje); 
               $resp = $objViaje->insertar();
               if($resp){echo "Viaje fue cargada correctamente!"."\n";}
               else{echo "No se pudo insertar error: \n";} 
               } 
            else{echo "OPCION INVALIDA, vuelva a cargar su viaje(opciones validas: Ida o Ida y vuelta)\n";
                  $existe=true;} 
               }
            else
            {echo "OPCION INVALIDA, vuelva a cargar su viaje(opciones validas: Cama o Semicama)\n";
                $existe=true;}

            } } while($existe);
               break;
        case 2:
              echo "Ingrese Numero Viaje a modificar\n";
              $id=trim(fgets(STDIN));  
              $objViaje=new Viaje();
              if($objViaje->buscar($id))
              { modificarViaje($id);}
              else{echo "No se encontro ningun viaje\n";}
              break;
         
        case 3: //Eliminar 
               $objViaje = new Viaje();
               echo "Id de viaje que desea eliminar:\n";
               $idViaje=trim(fgets(STDIN));
               if($objViaje->buscar($idViaje))
               {//si el viaje tiene pasajeros debe eliminarlos primero;
                $objViaje->pasajerosViaje(); //busca los pasajeros que tengan ese id de viaje
                $arrayPasajeros = $objViaje->getArrayObjPasajero(); //los pone en un array
                if(count($arrayPasajeros)>0) //si tiene pasajeros
                {echo "Si elimina el viaje eliminara sus pasajeros, desea continuar? (s/n) \n";
                $eliminar=strtoupper(trim(fgets(STDIN)));
                if($eliminar=="S")
                { foreach($objViaje->getArrayObjPasajero() as $objPasajero)
                  {$objPasajero->eliminar();}
                  echo "Viaje Borrado";
                } 
                else
                {echo "Cancelado";
                break;}
                }
                
                $objViaje->eliminar();
               echo "Eliminado con exito! \n";
             }
             else{echo "No se encontro ningun viaje con ese ID:\n";}
            
            break;
            case 4:
               $objViaje=new Viaje();
               echo "Id de Viaje que desea ver:\n";
               $id=trim(fgets(STDIN));
               if($objViaje->buscar($id))
               {echo $objViaje;
                echo "PASAJEROS: \n";
                stringPasajeros($objViaje);}
               else
               {echo "No hay ningun viaje registrado con ese ID \n";}
             break;

             case 5:
                $objViaje=new Viaje();
                $arrayViajes=$objViaje->listar("");
                foreach($arrayViajes as $viaje)
                {  echo "=================================\n";
                   echo $viaje;
                   echo "PASAJEROS\n";
                   stringPasajeros($viaje);
                   echo "=================================\n";}
              break;
    }}while($opcionViaje !=6 );
}


function stringPasajeros($objViaje)
{ $arrayPasajeros=[];
    $objViaje->pasajerosViaje(); //busca los pasajeros que tengan ese id de viaje y los setea 
    $arrayPasajeros = $objViaje->getArrayObjPasajero(); //los pone en un array
    foreach($arrayPasajeros as $pasajero)
    {echo "=================================\n";
    echo $pasajero;
    echo "=================================\n";}
}
/**
 * Este modulo pide que el usuario elija un responsable o la crea en la BD segun lo que decida y devuelve el objeto
 * @return object
 */
function obtenerResponsable()
{
    $objResponsable = new ResponsableV();
  do{ echo "Ingrese el numero de empleado del responsable, ingrese (C) para cargar nuevo: "."\n".stringResponsable($objResponsable);
    $responsable = trim(fgets(STDIN));
    if($responsable == "C"){
        echo "ingrese el nombre del responsable:\n";
        $nombreResp =  trim(fgets(STDIN));
        echo "ingrese el apellido del responsable:\n";
        $apellidoResp =  trim(fgets(STDIN));
        echo "ingrese el numero de licencia del responsable:\n";
        $numLincenciaResp =  trim(fgets(STDIN));
        //si es un numero 
        if(is_numeric($numLincenciaResp))
        {$objResponsable = new ResponsableV();
        $objResponsable->cargar($nombreResp,$apellidoResp,$numLincenciaResp,0);
        $resp=$objResponsable->insertar();
        }
        else
        {echo "Debe ingresar un numero, vuelva a intentarlo\n";}
        }
        else
        {if(is_numeric($responsable))
            {$resp = $objResponsable->buscar($responsable);}
        else{echo "Debe ingresarr un numero\n";
            $resp=false;}
           
        }
     
    }while(!$resp);
    return $objResponsable;
}

function stringEmpresas($objEmpresa)
{
$empresas=$objEmpresa->listar("");
foreach ($empresas as $empresa)
{   echo "=================================\n";
    echo $empresa;
    echo "=================================\n";}

}

function stringResponsable($objResponsable)
{
$responsables=$objResponsable->listar("");
foreach ($responsables as $responsable)
{echo $responsable;
    echo "=================================\n";}

}

function obtenerEmpresa(){
   
   do{ $objEmpresa = new Empresa();
    echo "Ingrese el codigo de alguna de las empresas, ingrese (C) para cargar nuevo: \n".stringEmpresas($objEmpresa);
    $empresaElegida =strtoupper(trim(fgets(STDIN)));
    if($empresaElegida == "C")
    {   echo "Ingrese nombre de la empresa:\n";
        $nombreEmpresa=trim(fgets(STDIN));
        echo "Ingrese Direccion\n";
        $direccionEmpresa=trim(fgets(STDIN));
        $objEmpresa = new Empresa();
        $objEmpresa->cargar(0,$nombreEmpresa,$direccionEmpresa);
        $resp = $objEmpresa->insertar();
        if($resp) 
        { echo "La empresa fue cargada correctamente!"."\n";}
        else{echo "No se pudo insertar. \n";}
    }
    else
    { if(is_numeric($empresaElegida))
        { $resp = $objEmpresa->buscar($empresaElegida);}
      else{echo "Debe Ingresar un numero valido\n";
          $resp=false;}
        
    }

   }while(!$resp);
   return $objEmpresa;
}

function compararViajes($destino)
{
$objViaje=new Viaje();
$viajes=$objViaje->listar("");
$resp=false;
$i=0;
while(!$resp && $i<count($viajes))
{ 
 $destinoComparar=$viajes[$i]->getVDestino();
 if($destinoComparar==$destino)
 {echo "Ya hay un viaje a ese destino\n";
 $resp=true;
 }
 $i++;
 
}
return $resp;
}

function modificarViaje($id)
{$objViaje=new Viaje();
 do{
    echo "->==MODIFICAR VIAJE:==\n
         Ingrese que dato desea cambiar: "."\n".
         "1. Modificar destino "."\n".
         "2. Modificar cantidad maxima de pasajeros "."\n".
         "3. Modificar importe del viaje "."\n".
         "4. Modificar el tipo de asiento del viaje "."\n".
         "5. Modificar si es de ida o vuelta "."\n".
         "6. Modificar Pasajeros "."\n".
         "7. Ver datos "."\n".
         "8. Salir "."\n";
    $seleccion = trim(fgets(STDIN));
    $objViaje->buscar($id);
    switch ($seleccion){
        case 1: 
            echo "ingrese el nuevo destino:\n";
            $nuevoDestino = trim(fgets(STDIN));
            $objViaje->setVDestino($nuevoDestino);
            $resp = $objViaje->modificar();
            if($resp){
                echo "El destino se ha cambiado correctamente!"."\n";
            }else{
                echo "El destino no se ha podido cambiar \n";
            }
            break;

        case 2: 
            echo "ingrese la nueva capacidad del viaje:\n";
            $nuevaCapacidad = trim(fgets(STDIN));
            $objViaje->setVCantidadMax($nuevaCapacidad);
            $resp = $objViaje->modificar();
            if($resp){
                echo "La capacidad se ha cambiado correctamente!"."\n";
            }else{
                echo "La capacidad maxima no se ha podido cambiar";
            }
            break;

        case 3: 
            echo "ingrese el nuevo importe del viaje:\n";
            $nuevoImporte = trim(fgets(STDIN));
            $objViaje->setVImporte($nuevoImporte);
            $resp = $objViaje->modificar();
            if($resp){
                echo "El importe se ha cambiado correctamente!"."\n";
            }else{
                echo "El importe no se ha podido cambiar";
            }
            break;

        case 4: 
            echo "Ingrese el nuevo tipo de asiento del viaje (cama O semicama): \n";
            $nuevoTipAsiento = trim(fgets(STDIN));
            $objViaje->setTipoAsiento($nuevoTipAsiento);
            $resp = $objViaje->modificar();
            if($resp){
                echo "El tipo de asiento se ha cambiado correctamente!"."\n";
            }else{
                echo "El tipo de asiento no se ha podido cambiar";
            }
        break;

        case 5: 
            echo "Ingrese el nuevo tipo de viaje(ida O ida y vuelta):\n";
            $nuevoTipViaje = trim(fgets(STDIN));
            $objViaje->setIdaVuelta($nuevoTipViaje);
            $resp = $objViaje->modificar();
            if($resp){
                echo "El tipo de viaje se ha cambiado correctamente!"."\n";
            }else{
                echo "El tipo de viaje no se ha podido cambiar";
            }
            break;
        break;

        case 6://menuPasajeros  
            do{
                echo
                "->==MENU PASAJERO==
               1)Crear Pasajero.
               2)Modificar Pasajero.
               3)Eliminar Pasajero.
               4)Mostrar Pasajero.
               5)Mostrar Pasajeros.
               6)Salir \n
               =================================\n"; 
               $opcion=trim(fgets(STDIN));
               switch($opcion){
                   case 1:
                    if($objViaje->hayPasajesDisponible())
                    {echo "ingrese el nombre del pasajero:\n";
                    $nombrePasajero =  trim(fgets(STDIN));
                    echo "ingrese el apellido del pasajero:\n";
                    $apellidoPasajero =  trim(fgets(STDIN));
                    echo "ingrese el DNI del pasajero:\n";
                    $dniPasajero =  trim(fgets(STDIN));
                    echo "ingrese el telefono del pasajero:\n";
                    $telefonoPasajero =  trim(fgets(STDIN));
                    echo "\n";
                    $objPasajero = new Pasajero();
                    $resp = $objPasajero->buscar($dniPasajero);
                    if($resp){
                       echo "Este pasajero ya fue registrado en otro viaje\n";
                    }else{
                        $objPasajero->cargar($nombrePasajero,$apellidoPasajero,$dniPasajero,$telefonoPasajero,$objViaje); //falta
                        $resp = $objPasajero->insertar();
                        if($resp){
                            echo "El pasajero se inserto correctamente!"."\n";
                        }else{
                            echo "No se pudo insertar el pasajero.\n";
                        }}
                         
                        }
                        else
                        {echo "No hay asientos disponibles!\n";}
                        break;
                   case 2:
                        $objPasajero = new Pasajero();
                        echo "Ingrese DNI a modificar:\n";
                        $dni=trim(fgets(STDIN));  
                       if($objPasajero->buscar($dni))
                       { modificarPasajero($dni);}
                       else{echo "No hay ningun pasajero registrado \n";}
                         
                          break;
                    case 3: //Eliminar 
                        echo "ingrese el DNI del pasajero que desea eliminar:\n";
                        $dni = trim(fgets(STDIN));
                        $objPasajero = new Pasajero();
                        $resp = $objPasajero->buscar($dni);
                        if($resp){
                            $resp = $objPasajero->eliminar($dni);
                            if($resp){
                                echo "El pasajero se elimino correctamente!"."\n";
                            }else{
                                echo "No se pudo elimiar el pasajero \n";
                            }
                        }else{
                            echo "El DNI del pasajero ingresado no existe!"."\n";
                        }
            
                    break;
                        
                    case 4:
                    echo "ingrese el DNI del pasajero que desea buscar:\n";
                    $dni = trim(fgets(STDIN));
                    $objPasajero = new Pasajero();
                    $resp = $objPasajero->buscar($dni);
                    if($resp){
                        echo "Los datos datos del pasajero ".$dni." son:"."\n";
                        echo $objPasajero;
                    }else{
                        echo "El pasajero ingresado no existe!"."\n";
                    }
                   break;

                        case 5:
                    $objPasajero = new Pasajero();
                    $pasajeros = $objPasajero->listar("");
                    foreach($pasajeros as $pasajero)
                    {echo "=================================\n";
                    echo $pasajero;
                    echo "=================================\n";}
                    break;
                        
                }}while($opcion !=6 );
        break;

        case 7: 
            echo $objViaje;
        break;
            
    }
    }while($seleccion != 8);
}

function modificarPasajero($dni)
{ $objPasajero=new Pasajero();
    do{
    echo "->==MODIFICAR PASAJERO==
         Ingrese que dato desea cambiar: "."\n".
         "1. Modificar Nombre "."\n".
         "2. Modificar Apellido "."\n".
         "3. Modificar Telefono "."\n".
         "4. Ver datos "."\n".
         "5. Salir "."\n
         =================================\n";
    $seleccion = trim(fgets(STDIN));
    $objPasajero->buscar($dni);
    switch ($seleccion){
        case 1: 
            echo "Ingrese el nuevo nombre:\n"; 
            $nuevoNombre = trim(fgets(STDIN));
            $objPasajero->setNombre($nuevoNombre);
            $resp = $objPasajero->modificar();
            if($resp == true){
                echo "El nombre se ha cambiado correctamente!"."\n";
            }else{
                echo "El nombre no se pudo modificar ";
            }
            break;

        case 2: 
            echo "Ingrese el nuevo apellido:\n"; 
            $nuevoApellido = trim(fgets(STDIN));
            $objPasajero->setApellido($nuevoApellido);
            $resp = $objPasajero->modificar();
            if($resp == true){
                echo "El apellido se ha cambiado correctamente!"."\n";
            }else{
                echo "El apellido no se pudo modificar";
            }
            break;

        case 3: //verificar q sea un numero
            echo "Ingrese el nuevo numero de telefono:\n"; 
            $telefonoNuevo = trim(fgets(STDIN));
            $objPasajero->setTelefono($telefonoNuevo);
            $resp = $objPasajero->modificar();
            if($resp == true){
                echo "El numero de telelefono se ha cambiado correctamente!"."\n";
            }else{
                echo "El numero de telefono no se pudo modificar ";
            }
            break;
            
        case 4: 
          echo $objPasajero;

        break;
    }
    }while($seleccion != 5);
}