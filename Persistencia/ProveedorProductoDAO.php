<?php
class ProveedorProductoDAO{
    private $idProveedorProducto;
    private $idProducto;
    private $idProveedor;
    private $cantidad;
    private $precio;
    private $fecha;

    public function ProveedorProductoDAO($idProveedorProducto="",$idProducto="",$idProveedor="",$cantidad="",$precio="",$fecha=""){
        $this -> idProveedorProducto = $idProveedorProducto;
        $this -> idProducto = $idProducto;
        $this -> idProveedor = $idProveedor;
        $this -> cantidad = $cantidad;
        $this -> precio = $precio;
        $this -> fecha = $fecha;
    }

    public function insertar(){
        return "insert into proveedorproducto(idProveedorProducto,idProducto,idProveedor,cantidad,precio,fecha)
                values('".$this -> idProveedorProducto."','".$this -> idProducto."','".$this -> idProveedor."','".$this -> cantidad."','".$this -> precio."','".$this -> fecha."')";
    }

    public function cantidadPaginasFiltro($filtro){
        return "select count(idProveedorProducto) 
                from proveedorproducto
                where idProveedorProducto like '%".$filtro."%' or idProducto like '%".$filtro."%' or idProveedor like '".$filtro."%' or fecha like '".$filtro."%'";
    }

    public function listarFiltro($filtro,$cantidad,$pagina){
        return "select idProveedorProducto,idProducto,idProveedor,cantidad,precio,fecha
                from proveedorproducto
                where idProveedorProducto like '%".$filtro."%' or idProducto like '%".$filtro."%' or idProveedor like '".$filtro."%' or fecha like '".$filtro."%'
                order by idProveedorProducto DESC
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function cantidadPaginasFiltroProve($filtro){
        return "select count(idProveedorProducto) 
                from proveedorproducto
                where (idProveedorProducto like '%".$filtro."%' or idProducto like '%".$filtro."%' or idProveedor like '".$filtro."%' or fecha like '".$filtro."%')
                and idProveedor = '".$this -> idProveedor."'";
    }

    public function listarFiltroProve($filtro,$cantidad,$pagina){
        return "select idProveedorProducto,idProducto,idProveedor,cantidad,precio,fecha
                from proveedorproducto
                where (idProveedorProducto like '%".$filtro."%' or idProducto like '%".$filtro."%' or idProveedor like '".$filtro."%' or fecha like '".$filtro."%')
                and idProveedor = '".$this -> idProveedor."'
                order by idProveedorProducto DESC
                limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
    }

    public function traerInfo(){
        return "select idProveedorProducto,idProducto,idProveedor,cantidad,precio,fecha
                from proveedorproducto
                where idProveedorProducto = '".$this -> idProveedorProducto."'";
    }

    
}
?>