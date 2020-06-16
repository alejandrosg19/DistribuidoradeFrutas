<?php
    class AdministradorDAO{
        private $idAdministrador;
        private $nombre;
        private $correo;
        private $clave;
        private $estado;

        public function AdministradorDAO($idAdministrador = "", $nombre = "", $correo = "", $clave = "", $estado = ""){
            $this -> idAdministrador = $idAdministrador;
            $this -> nombre = $nombre;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> estado = $estado;
        }

        public function autenticar(){
            return "select idAdministrador 
                    from administrador
                    where correo = '" . $this -> correo ."' and clave = '" . md5($this -> clave) . "'";
        }

        public function traerInfo(){
            return "select idAdministrador, nombre, correo
                    from administrador
                    where idAdministrador = '". $this -> idAdministrador ."'";
        }
    }
?>