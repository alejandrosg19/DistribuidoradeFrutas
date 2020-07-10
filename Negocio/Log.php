<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/LogDAO.php";

class Log{
    private $idLog;
    private $accion;
    private $datos;
    private $fecha;
    private $hora;
    private $actor;
    private $idUsuario;
    private $conexion;
    private $logDAO;

    public function Log($idLog = "", $accion = "", $datos = "", $fecha = "", $hora = "", $actor = "",$idUsuario=""){
        $this -> idLog = $idLog;
        $this -> accion = $accion;
        $this -> datos = $datos;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> actor = $actor;
        $this -> idUsuario = $idUsuario;
        $this -> conexion = new Conexion();
        $this -> logDAO = new LogDAO($this -> idLog, $this -> accion, $this -> datos, $this -> fecha, $this -> hora, $this -> actor,$this -> idUsuario);
    }

    public function getIdLog(){
        return $this -> idLog;
    }

    public function getAccion(){
        return $this -> accion;
    }

    public function getDatos(){
        return  $this -> datos;
    }

    public function getFecha(){
        return $this -> fecha;
    }

    public function getHora(){
        return $this -> hora;
    }

    public function getActor(){
        return $this -> actor;
    }

    public function getIdUsuario(){
        return $this -> idUsuario;
    }

    public function setActor($actor){
        $this -> actor = $actor;
    }
    public function insertarLog(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> logDAO -> insertarLog());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> logDAO -> cantidadPaginas());
        return $this -> conexion -> extraer();
    }

    public function listarLog($cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> logDAO -> listarLog($cantidad,$pagina));
        $arrayLog = array();
        while(($logActual = $this -> conexion -> extraer())!=null){
            $newLog = new Log($logActual[0],$logActual[1],$logActual[2],$logActual[3],$logActual[4],$logActual[5],$logActual[6]);
            array_push($arrayLog,$newLog);
        }
        $this -> conexion -> cerrar(); 
        return $arrayLog;
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> logDAO -> traerInfo());
        $this -> conexion -> cerrar();
        $resultado = $this -> conexion -> extraer();
        $this -> idLog = $resultado[0];
        $this -> accion = $resultado[1];
        $this -> datos = $resultado[2];
        $this -> fecha = $resultado[3];
        $this -> hora = $resultado[4];
        $this -> actor = $resultado[5];
        $this -> idUsuario = $resultado[6];
    }
    public function ultimaSesion($actor,$id){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> logDAO -> ultimaSesion($actor,$id));
        $arrayLog = array();
        while(($resultado = $this -> conexion -> extraer())!=null){
            $newLog = new Log("","","",$resultado[0],$resultado[1]);
            array_push($arrayLog,$newLog);
        }
        $this -> conexion -> cerrar();
        return $arrayLog;
    }
}
