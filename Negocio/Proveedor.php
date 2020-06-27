<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/ProveedorDAO.php";

class Proveedor{
    private $idProveedor;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;
    private $conexion;
    private $proveedorDAO;

    public function Proveedor($idProveedor = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
        $this -> idProveedor = $idProveedor;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> proveedorDAO = new ProveedorDAO($this -> idProveedor, $this -> nombre, $this -> correo, $this -> clave, $this -> estado);
    }

    public function getIdProveedor(){
        return $this -> idProveedor;
    }
     
    public function getNombre(){
        return $this -> nombre;
    }

    public function getCorreo(){
        return $this -> correo;
    }

    public function getClave(){
        return $this -> Clave;
    }

    public function getEstado(){
        return $this -> estado;
    }

    public function validarCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> validarCorreo());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            return true;
        }else{
            return false;
        }
    }

    public function registrarProveedor(){
        $this -> conexion -> abrir();
        $codigoActivacion  = rand(100,1000);
        $this -> conexion -> ejecutar($this -> proveedorDAO -> registrarProveedor($codigoActivacion));
        $this -> conexion -> cerrar();
    }

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> autenticar());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            $result = $this -> conexion -> extraer();
            $this -> idProveedor = $result[0];
            return true;
        }else{
            return false;
        }    
    }

    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> traerInfo());
        $datos = $this -> conexion -> extraer();
        $this -> nombre = $datos[1];
        $this -> correo = $datos[2];
        $this -> conexion -> cerrar();
    }

    public function actualizarInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> actualizarInfo());
        $this -> conexion -> cerrar();
    }

    public function listarProveedor(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> proveedorDAO -> listarProveedor());
        $listaProveedor = array();
        while(($resultado = $this -> conexion -> extraer())!=null){
            $newProveedor = new Proveedor($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4]);
            array_push($listaProveedor,$newProveedor);
        }
        $this -> conexion -> cerrar();
        return $listaProveedor;
    }
}
?>