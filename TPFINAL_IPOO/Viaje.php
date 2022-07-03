<?php
include_once("BaseDatos.php");
class Viaje{
    private $idViaje;
    private $vDestino;
    private $vCantidadMax;
    private $arrayObjPasajero;
    private $objEmpresa;
    private $objResponsable;
    private $vImporte;    
    private $tipoAsiento;
    private $idaVuelta;    
    private $mensajeError;

    /**************************************/
    /**************** SET *****************/
    /**************************************/


    public function setIdViaje($idViaje){
        $this->idViaje = $idViaje;
    }

 
    public function setVDestino($vDestino){
        $this->vDestino = $vDestino;
    }

    public function setVCantidadMax($vCantidadMax){
        $this->vCantidadMax = $vCantidadMax;
    }


    public function setArrayObjPasajero($arrayObjPasajero){
        $this->arrayObjPasajero = $arrayObjPasajero;
    }


    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }

 
    public function setObjResponsable($objResponsable){
        $this->objResponsable = $objResponsable;
    }

    public function setVImporte($vImporte){
        $this->vImporte = $vImporte;
    }
 
    public function setTipoAsiento($tipoAsiento){
        $this->tipoAsiento = $tipoAsiento;
    }


    public function setIdaVuelta($idaVuelta){
        $this->idaVuelta = $idaVuelta;
    }
    
   
    public function setMensajeError($mensajeError){
        $this->mensajeError = $mensajeError;
    }

    /**************************************/
    /**************** GET *****************/
    /**************************************/

 
    public function getIdViaje(){
        return $this->idViaje;
    }

    public function getVDestino(){
        return $this->vDestino;
    }


    public function getVCantidadMax(){
        return $this->vCantidadMax;
    }


    public function getArrayObjPasajero(){
        return $this->arrayObjPasajero;
    }


    public function getObjEmpresa(){
        return $this->objEmpresa;
    }


    public function getObjResponsable(){
        return $this->objResponsable;
    }


    public function getVImporte(){
        return $this->vImporte;
    }


    public function getTipoAsiento(){
        return $this->tipoAsiento;
    }


    public function getIdaVuelta(){
        return $this->idaVuelta;
    }

    

    public function getMensajeError(){
        return $this->mensajeError;
    }


   
    /************** FUNCIONES *************/

    /**
     * Este modulo asigna los valores a los atributos cuando se crea una instancia de la clase
    */
    public function __construct(){
        $this->idViaje = "";
        $this->vDestino = "";
        $this->vCantidadMax = "";
        $this->arrayObjPasajero = [];
        $this->objEmpresa = "";
        $this->objResponsable = "";
        $this->vImporte = "";
        $this->tipoAsiento = "";
        $this->idaVuelta = "";
    }

    public function cargar($idViaje, $vDestino, $vCantidadMax, $objEmpresa, $objResponsable, $vImporte, $tipoAsiento, $idaVuelta){		
        $this->setIdViaje($idViaje);
        $this->setVDestino($vDestino);
        $this->setVCantidadMax($vCantidadMax);
        $this->setObjEmpresa($objEmpresa);
        $this->setObjResponsable($objResponsable);
        $this->setVImporte($vImporte);
        $this->setTipoAsiento($tipoAsiento);
        $this->setIdaVuelta($idaVuelta);
    }
    
    /**
     * Este modulo inserta en la BD el viaje
    */
    public function insertar(){
        $baseDatos = new BaseDatos();
        $resp = null;
        $consulta = "INSERT INTO viaje (vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
                    VALUES ('".$this->getVDestino()."',".$this->getVCantidadMax().",".$this->getObjEmpresa()->getIdentificacion().",".$this->getObjResponsable()->getNumEmpleado().",".$this->getVImporte().",'".$this->getTipoAsiento()."','".$this->getIdaVuelta()."')";
      if($baseDatos->iniciar()){
            if($id= $baseDatos->devuelveIDInsercion($consulta)){
               $this->setIdViaje($id);
                $resp = true;
            }else{
                $resp = false;
                $this->setMensajeError($baseDatos->getERROR());
            }
        }else{
            $resp = false;
            $this->setMensajeError($baseDatos->getERROR());
        }
        return $resp;
    }

    /**
     * Este modulo modifica un viaje de la BD.
    */
    public function modificar(){
        $baseDatos = new BaseDatos();
        $resp = null;
        $consulta = "UPDATE viaje 
                    SET idViaje = ".$this->getIdViaje().",
                    vdestino = '".$this->getVDestino()."', 
                    vcantmaxpasajeros = ".$this->getVCantidadMax().", 
                    idempresa = ".$this->getObjEmpresa()->getIdentificacion().", 
                    rnumeroempleado = ".$this->getObjResponsable()->getNumEmpleado().", 
                    vimporte = ".$this->getVImporte().",
                    tipoAsiento = '".$this->getTipoAsiento()."',
                    idayvuelta = '".$this->getIdaVuelta()."' WHERE idviaje = ".$this->getIdViaje();
        if($baseDatos->iniciar()){
            if($baseDatos->ejecutar($consulta)){
                $resp = true;
            }else{
                $resp = false;
                $this->setMensajeError($baseDatos->getERROR());
            }
        }else{
            $resp = false;
            $this->setMensajeError($baseDatos->getERROR());
        }
        return $resp;
    }

    /**
     * Este elimina un viaje de la BD.
    */
    public function eliminar(){
        $baseDatos = new BaseDatos();
        $resp = null;
        $consulta = "DELETE FROM viaje WHERE idviaje = ".$this->getIdViaje();
        if($baseDatos->iniciar()){
            if($baseDatos->ejecutar($consulta)){
                $resp = true;
            }else{
                $resp = false;
                $this->setMensajeError($baseDatos->getERROR());
            }
        }else{
            $resp = false;
            $this->setMensajeError($baseDatos->getERROR());
        }
        return $resp;
    }
/**busca un viaje por id */
    public function buscar($idViaje){
        $baseDatos = new BaseDatos();
		$consulta="SELECT * FROM viaje WHERE idviaje = ".$idViaje; /**busca un viaje por id */
		$resp = null;
		if($baseDatos->iniciar()){
			if($baseDatos->ejecutar($consulta)){
				if($viaje=$baseDatos->registro()){ //genera el registro y modifica los datos de el obj actual por los de la base de datos
                    $objReponsable = new ResponsableV();
                    $objEmpresa = new Empresa();
                    $objReponsable->buscar($viaje['rnumeroempleado']);		//busca en obj responsable con el id del responsable	
                    $objEmpresa->buscar($viaje['idempresa']);	//busca en obj empresa con su id

				    $this->setIdViaje($idViaje);
					$this->setVDestino($viaje['vdestino']);
					$this->setVCantidadMax($viaje['vcantmaxpasajeros']);
					$this->setObjEmpresa($objEmpresa);///setea ese obj y desde el insertar accede a su ID
					$this->setObjResponsable($objReponsable);//setea ese obj y desde el insertar accede a su ID
					$this->setVImporte($viaje['vimporte']);
					$this->setTipoAsiento($viaje['tipoAsiento']);
					$this->setIdaVuelta($viaje['idayvuelta']);
					$resp= true;
				}
		 	}else{
                $resp = false;
                $this->setMensajeError($baseDatos->getERROR());
			}
		 }else{
            $resp = false;
            $this->setMensajeError($baseDatos->getERROR());
		 }		
		 return $resp;
	}	

    public function listar($condicion){
	    $resp = [];
        $baseDatos = new BaseDatos();
		$consultaViaje="SELECT * FROM viaje ";
		if($condicion != ""){
		    $consultaViaje .=' where '.$condicion;
		}
		if($baseDatos->iniciar()){
			if($baseDatos->ejecutar($consultaViaje)){				
				while($viaje=$baseDatos->registro()){
                    $objViaje = new Viaje();
                    $objViaje->buscar($viaje['idviaje']);
					array_push($resp, $objViaje); //arma un array que cumpla la condicion 
				}
		 	}else {
                $this->setMensajeError($baseDatos->getERROR());
			}
		 }else{
            $this->setMensajeError($baseDatos->getERROR());
		 }	
		 return $resp;
	}	

    /**
     * Este modulo busca en la BD los pasajeros que coniciden con el viaje y lo setea en el array de la clase
    */
    public function pasajerosViaje(){
        $baseDatos = new BaseDatos();
        $resp = null;
        $consulta = "idViaje = ".$this->getIdViaje();
        if($baseDatos->iniciar()){
            $objPasajero = new Pasajero();
            $arrayObjPersona = $objPasajero->listar($consulta);
            if(is_array($arrayObjPersona)){
                $this->setArrayObjPasajero($arrayObjPersona);
                $resp = true;
            }else{
                $resp = false;
                $this->setMensajeError($baseDatos->getERROR());
            }
        }else{
            $resp = false;
            $this->setMensajeError($baseDatos->getERROR());
        }
        return $resp;
    }

    /**
     * funcion que retorna true si hay espacio para agregar un nuevo pasajero
    */
    public function hayPasajesDisponible(){
        $this->pasajerosViaje();
        $arrayObjPasajero = $this->getArrayObjPasajero();
        if(count($arrayObjPasajero) < $this->getVCantidadMax()){
            $verificacion = true;
        }else{
            $verificacion = false;
        }
        return $verificacion;
    }
    
    /**
     * Este modulo devuelve una cadena de caracteres mostrando el contenido de los atributos
     * @return string
    */
    public function __toString(){
        return ("El codigo del viaje es: ".$this->getIdViaje()."\n".
                "El destino del viaje es: ".$this->getVDestino()."\n"."\n".
                "La cantidad maxima de pasajeros es: ".$this->getVCantidadMax()."\n"."\n".
                "El importe del viaje es: ".$this->getVImporte()."\n".
                "El tipo de asiento del viaje es: ".$this->getTipoAsiento()."\n".
                "El viaje es de ida y vuelta: ".$this->getIdaVuelta()."\n").
                "Los datos de la empresa son: "."\n".$this->getObjEmpresa()."\n".
                "Los datos del responsable del viaje son: "."\n".$this->getObjResponsable()."\n";
    }

}

?>