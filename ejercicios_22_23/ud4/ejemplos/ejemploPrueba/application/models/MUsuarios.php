<?php
/**
 * 
 */
class MUsuarios extends CI_Model
{
	function usuarioInsertar($data){
		$this->db->insert("usuarios",$data);
	}

	function loginUsuario($usuario){
		$data["usuario"] = $usuario;
		return $this->db->get_where("usuarios",$data);
	}

    function getUsuarios($usuario){
		$data["usuario"] = $usuario;
		return $this->db->get_where("usuarios",$data);
	}

    function numUsuarios(){
		return $this->db->count_all('usuarios');
	}

}
?>