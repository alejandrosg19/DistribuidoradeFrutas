<?php

class LogDAO{
    private $idLog;
    private $accion;
    private $datos;
    private $fecha;
    private $hora;
    private $actor;
    private $idUsuario;

    public function LogDAO($idLog = "", $accion = "", $datos = "", $fecha = "", $hora = "", $actor = "",$idUsuario=""){
        $this -> idLog = $idLog;
        $this -> accion = $accion;
        $this -> datos = $datos;
        $this -> fecha = $fecha;
        $this -> hora = $hora;
        $this -> actor = $actor;
        $this -> idUsuario = $idUsuario;
    }

    public function insertarLog(){
        return "insert into log (idLog,accion,datos,fecha,hora,actor,idUsuario) 
            values('','".$this -> accion."','".$this -> datos."','".$this -> fecha."','".$this -> hora."','".$this -> actor."','".$this -> idUsuario."')";
    }

    public function cantidadPaginas(){
        return "select count(idLog) from log";
    }

    public function listarLog($cantidad,$pagina){
        return "select idLog, accion, datos, fecha, hora, actor, idUsuario
                from log order by idLog DESC
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function traerInfo(){
        return "select idLog, accion, datos, fecha, hora, actor, idUsuario
                from log 
                where idLog = '".$this -> idLog."'";
    }

    public function ultimaSesion($actor,$id){
        return "select fecha, hora
                from log
                where actor = '".$actor."' and idUsuario = '".$id."'";
                
    }

}
?>