<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ClienteDAO.php";
class Cliente{
    private $idCliente;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;
    private $conexion;
    private $clienteDAO;

    public function Cliente($idCliente = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
        $this -> idCliente = $idCliente;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> clienteDAO = new ClienteDAO($this -> idCliente, $this -> nombre, $this -> correo, $this -> clave, $this -> estado);
    }

    public function getidCliente(){
        return $this -> idCliente;
    }

    public function getNombre(){
        $this -> nombre;
    }

    public function getCorreo(){
        $this -> correo;
    }

    public function getClave(){
        $this -> clave;
    }

    public function getEstado(){
        $this -> estado;
    }

    public function validarCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> validarCorreo());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            return true;
        }else{
            return false;
        }
    }

    public function registrarCliente(){
        $this -> conexion -> abrir();
        $codigoActivacion  = rand(100,1000);
        $this -> conexion -> ejecutar($this -> clienteDAO -> registrarCliente(md5($codigoActivacion)));
        $this -> conexion -> cerrar();
    }
}
?>