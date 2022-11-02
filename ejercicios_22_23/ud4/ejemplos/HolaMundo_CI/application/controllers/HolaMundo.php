<?php
class HolaMundo extends CI_controller{

    function __construct()  
    {
        parent::__construct();      
        $this->load->model('HolaMundoModel');    
    }

    public function listar(){
        # Cargar el modelo a $this
        //$this->load->model('HolaMundoModel');
        # Ahora el modelo está en $this como una propiedad

        # Todo esto le pasaremos a la vista
        $datos = array();

        # Ponemos el título...
        $datos["titulo"] = "¡Título desde el controlador!";

        # Cargar la lista
        $datos["lista"] = $this->HolaMundoModel->obtenerLista();

        # Renderizar y pasar datos.
        # Tip: no es necesario pasar la extensión del archivo de la vista (sería hola.php)
        $this->load->view("hola", $datos);
        //$this->load->view("usuarios/perfil", $datos);
    }
    public function index()
	{
		$this->load->view('hola');
	}
}
?>