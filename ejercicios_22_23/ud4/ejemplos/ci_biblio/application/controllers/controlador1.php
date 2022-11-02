<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controlador1 extends CI_Controller {

	
	public function index()
	{
		echo "<h1>url de inicio de CodeIgniter</h1>";
	}
        
       
        public function metodoprueba()
        {
            echo "<h1>Dentro de método de prueba</h1>";
        }
       
        
       
        public function metodoprueba2($param='2')
        {
            echo "<h1>Dentro de método de prueba 2</h1>";
            echo "<p>Recibido:$param</p>";
        }
     
        
        
        public function cargarvista()
        {
            $ahora=time();
            $mes=date('m',$ahora);   
                   
              
            /*
            if ($mes ==7  || $mes==8  || $mes==12)
                 $this->load->view('cabecera1');
            else
                $this->load->view('cabecera2');
            
            $this->load->view('vpie.php');
              */        
            
            
            
             if ($mes ==7  || $mes==8  || $mes==12)
                 $datos['titulo']="Mes festivo";
             else
                 $datos['titulo']="Mes lectivo";
             $this->load->view('cabecera',$datos);
            $this->load->view('vista1');
            $this->load->view('vpie.php');
            
        }
        
        
        public function cargarvistacondatos()
        {
            $datos['autor']="Juan Perez";
            $datos['libros']=array("libro1","libro2","libro55","libro79");
            
            $this->load->view('vista2',$datos);
            
            
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */