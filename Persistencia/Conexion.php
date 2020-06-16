<?php
class Conexion{

    private $mysqli;
    private $result;

    public function abrir(){
        $this -> mysqli = new mysqli("localhost","root","","dbfruteria");
        $this -> mysqli -> set_charset("utf8");
    }

    public function ejecutar($query){
        $this -> result = $this -> mysqli ->query($query); 
    }

    public function extraer(){
        return $this -> result -> ferch_row();
    }
    
    public function cerrar(){
        $this -> mysqli -> close();
    }
    
    function numFilas(){
        if($this -> result != null){
            return $this -> result -> num_rows; 
        }else{
            return null;
        }
    }


}
?>
