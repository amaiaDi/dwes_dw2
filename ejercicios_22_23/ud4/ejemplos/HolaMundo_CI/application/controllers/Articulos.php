<?php
class Articulos extends CI_Controller{

	// function index(){
	//     $this->load->view('articulo');
    // }	
    public function index()
	{
		$this->load->view('articulos');
	}

    function saludar(){
        echo "Buenos dias";
    }

    function verparametro($param)
    {
        echo "Recibido:". $param;
    }

}
?>