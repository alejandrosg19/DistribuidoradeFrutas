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
    public function setidCliente($idCliente){
        $this -> idCliente = $idCliente;
    }

    public function setEstado($estado){
        $this -> estado = $estado;
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

    public function listarTodosClientes(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> listarTodosClientes());
        $listaClientes = array();
        while(($resultado = $this -> conexion -> extraer())!=null){
            $newCliente = new Cliente($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4]);
            array_push($listaClientes,$newCliente);
        }
        $this -> conexion -> cerrar();
        return $listaClientes;
    }

    public function cantidadPaginas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> cantidadPaginas());
        return $this -> conexion -> extraer();
    }

    public function listarClientes($Cantidad, $Pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> listarClientes($Cantidad,$Pagina));
        $arrayClientes = array();
        while(($resultado = $this -> conexion -> extraer()) != null){
            $newCliente = new Cliente($resultado[0],$resultado[1],$resultado[2],$resultado[3],$resultado[4]);
            array_push($arrayClientes,$newCliente);
        }
        $this -> conexion -> cerrar();
        return $arrayClientes;
    }

    public function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }

    public function cantidadPaginasFiltro($filtro){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> cantidadPaginasFiltro($filtro));
        return $this -> conexion -> extraer();
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> clienteDAO -> listarFiltro($filtro,$cantidad,$pagina));
        $arrayClientes = array();
        while(($clienteActual = $this -> conexion -> extraer())!=null){
            $newCliente = new Cliente($clienteActual[0],$clienteActual[1],$clienteActual[2],"",$clienteActual[3]);
            array_push($arrayClientes,$newCliente);
        }
        $this -> conexion -> cerrar(); 
        return $arrayClientes;
    }
}
?>