<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct(){
		parent::__construct();            
		$this->load->model('musuarios');
		$this->load->model('malumnos');
	}

	public function index()
	{
		//TITULO
		$nu=$this->musuarios->numUsuarios();
		$na=$this->malumnos->numAlumnos();
		$data['mensaje']= $na." alumnos y ".$nu ." usuarios";
		
		//ENLACES A AUTORES para ver sus libros
		$resultado= $this->malumnos->getAlumnos(0, $na); 
			
		$data['arrayautores'] = $resultado->result_array();
		
		$this->load->view('saludo',$data);
	}
}
