<?php
    class ClienteDAO{
        private $idCliente;
        private $nombre;
        private $correo;
        private $clave;
        private $estado;

        public function ClienteDAO($idCliente = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
            $this -> idCliente = $idCliente;
            $this -> nombre = $nombre;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> estado = $estado;
        }

        public function consultar(){
            return "select * 
                    from cliente";
        }

        public function validarCorreo(){
            return "select idCliente
                    from cliente
                    where correo = '" . $this -> correo . "'";
        }

        public function registrarCliente($codigoAtivacion){
            return "insert into cliente values('','".$this -> nombre."','".$this -> correo."','".md5($this -> clave)."','0','".md5($codigoAtivacion)."')";
        }

    }
?>