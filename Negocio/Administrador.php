<?php
require_once "Persistencia/Conexion.php";
require_once "Persistencia/AdministradorDAO.php";

class Administrador{
    private $idAdministrador;
    private $nombre;
    private $correo;
    private $clave;
    private $estado;
    private $foto;
    private $conexion;
    private $AdministradorDAO;

    public function Administrador($idAdministrador = "", $nombre = "", $correo = "", $clave = "", $estado = "",$foto = ""){
        $this -> idAdministrador = $idAdministrador;
        $this -> nombre = $nombre;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> estado = $estado;
        $this -> foto = $foto;
        $this -> conexion = new Conexion();
        $this -> AdministradorDAO = new AdministradorDAO($this -> idAdministrador, $this -> nombre, $this -> correo, $this -> clave,$this ->  estado, $this -> foto);
    }

    public function getIdAdministrador(){
        return $this -> idAdministrador;
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

    public function getFoto(){
        return $this -> foto;
    }

    public function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> autenticar());
        $this -> conexion -> cerrar();
        if($this -> conexion -> numFilas()!=null){
            $result = $this -> conexion -> extraer();
            $this -> idAdministrador = $result[0];
            return true;
        }else{
            return false;
        }    
    }
    
    public function traerInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> traerInfo());
        $datos = $this -> conexion -> extraer();
        $this -> nombre = $datos[1];
        $this -> correo = $datos[2];
        $this -> estado = $datos[3];
        $this -> foto = $datos[4];
        $this -> conexion -> cerrar();
    }

    public function actualizarInfo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> actualizarInfo());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginasFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> cantidadPaginasFiltro($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> listarFiltro($filtro,$cantidad,$pagina));
        $arrayAdm = array();
        while(($admActual = $this -> conexion -> extraer())!=null){
            $newAdm = new Administrador($admActual[0],$admActual[1],$admActual[2],"",$admActual[3]);
            array_push($arrayAdm,$newAdm);
        }
        $this -> conexion -> cerrar(); 
        return $arrayAdm;
    }

    public function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> AdministradorDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }
}
?>