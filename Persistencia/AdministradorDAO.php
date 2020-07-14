<?php
    class AdministradorDAO{
        private $idAdministrador;
        private $nombre;
        private $correo;
        private $clave;
        private $estado;
        private $foto;

        public function AdministradorDAO($idAdministrador = "", $nombre = "", $correo = "", $clave = "", $estado = "", $foto =""){
            $this -> idAdministrador = $idAdministrador;
            $this -> nombre = $nombre;
            $this -> correo = $correo;
            $this -> clave = $clave;
            $this -> estado = $estado;
            $this -> foto = $foto;
        }

        public function getFoto(){
            return $this -> foto;
        }

        public function autenticar(){
            return "select idAdministrador 
                    from administrador
                    where correo = '" . $this -> correo ."' and clave = '" . md5($this -> clave) . "'";
        }

        public function validarCorreo(){
            return "select idAdministrador
                    from administrador
                    where correo = '" . $this -> correo . "'";
        }

        public function registrarAdm($codigoAtivacion){
            return "insert into administrador (nombre,correo,clave,estado,codigoActivacion)
            values('".$this -> nombre."','".$this -> correo."','".md5($this -> clave)."','0','".md5($codigoAtivacion)."')";
        }

        public function traerInfo(){
            return "select idAdministrador, nombre, correo, estado, foto
                    from administrador
                    where idAdministrador = '". $this -> idAdministrador ."'";
        }

        public function traerInfoCorreo(){
            return "select idAdministrador, nombre, correo, estado, foto
                    from administrador
                    where correo = '". $this -> correo ."'";
        }

        public function actualizarInfo(){
            return "update administrador set nombre = '".$this -> nombre ."', correo = '". $this -> correo ."', foto = '".$this -> foto."'
                    where idAdministrador = '". $this -> idAdministrador ."'";
        }

        public function cantidadPaginasFiltro($filtro){
            return "select count(idAdministrador) 
                    from administrador
                    where idAdministrador like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'";
        }

        public function listarFiltro($filtro,$cantidad,$pagina){
            return "select idAdministrador, nombre, correo, estado
                    from administrador
                    where idAdministrador like '%".$filtro."%' or nombre like '".$filtro."%' or correo like '".$filtro."%'
                    limit " . (($pagina-1) * $cantidad) . ", " . $cantidad;
        }

        public function actualizarEstado(){
            return "update administrador set estado = '". $this -> estado ."' where idAdministrador = '". $this -> idAdministrador. "'";
        }
    }
