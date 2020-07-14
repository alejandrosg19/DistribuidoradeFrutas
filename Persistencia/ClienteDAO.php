<?php
    class ClienteDAO{
        private $idCliente;
        private $nombre;
        private $correo;
        private $clave;
        private $estado;
        private $foto;

        public function ClienteDAO($idCliente = "", $nombre = "", $correo = "", $clave = "", $estado = "", $foto =""){
            $this -> idCliente = $idCliente;
            $this -> nombre = $nombre;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> estado = $estado;
            $this -> foto = $foto;
        }

        public function validarCorreo(){
            return "select idCliente
                    from cliente
                    where correo = '" . $this -> correo . "'";
        }

        public function registrarCliente($codigoAtivacion){
            return "insert into cliente (nombre,correo,clave,estado,codigoActivacion)
            values('".$this -> nombre."','".$this -> correo."','".md5($this -> clave)."','0','".md5($codigoAtivacion)."')";
        }

        public function autenticar(){
            return "select idCliente 
                    from cliente
                    where correo = '" . $this -> correo ."' and clave = '" . md5($this -> clave) . "'";
        }

        public function traerInfo(){
            return "select idCliente, nombre, correo, estado, foto
                    from cliente
                    where idCliente = '". $this -> idCliente ."'";
        }
        public function traerInfoCorreo(){
            return "select idCliente, nombre, correo, estado, foto
                    from cliente
                    where correo = '". $this -> correo ."'";
        }

        public function actualizarInfo(){
            return "update cliente set nombre = '".$this -> nombre ."', correo = '". $this -> correo ."', foto = '".$this -> foto."'
                    where idCliente = '". $this -> idCliente ."'";
        }


        public function actualizarEstado(){
            return "update cliente set estado = '". $this -> estado ."' where idCliente = '". $this -> idCliente. "'";
        }

        public function cantidadPaginasFiltro($filtro){
            return "select count(idCliente) 
                    from cliente
                    where idCliente like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'";
        }

        public function listarFiltro($filtro,$cantidad,$pagina){
            return "select idCliente, nombre, correo, estado
                    from cliente
                    where idCliente like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'
                    limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
        }
    }
?>