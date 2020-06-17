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
        return $this -> nombre;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> clave;
    }

    public function getEstado(){
        return $this -> estado;
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

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> autenticar());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            $result = $this -> conexion -> extraer();
            $this -> idCliente = $result[0];
            return true;
        }else{
            return false;
        }   
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> traerInfo());
        $datos = $this -> conexion -> extraer();
        $this -> nombre = $datos[1];
        $this -> correo = $datos[2];
        $this -> conexion -> cerrar();
    }

    public function actualizarInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> actualizarInfo());
        $this -> conexion -> cerrar();
    }
}
?>