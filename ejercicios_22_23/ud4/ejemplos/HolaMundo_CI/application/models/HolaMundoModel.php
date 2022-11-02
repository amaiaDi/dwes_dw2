<?php
class HolaMundoModel extends CI_Model{
    public function obtenerLista(){
        return array(
            "Esta", "Es", "una", 
            "lista", "obtenida",
            "desde", "el",
            "Modelo");
    }
}
?>