<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_devoluciones  extends CI_Controller {

        function __construct()  
        {
            parent::__construct();      
             $this->load->model('m_prestamos');     
             $this->load->library('form_validation');
        }
	
        function index()
        {                      
            $datos['arrLibros']=$this->m_prestamos->librosConPrestamo();
            $this->load->view('v_librosprestados',$datos);          
        }               
       
         
       function prestadosDe()
       {           
           if (!isset($_POST['submit_verprestados']))
                  $this->index ();
           else
           {
                
                  $this->setValidRules();

            
                 if ($this->form_validation->run() == FALSE)
                           $this->index();
                 else    
                  {
                     $_SESSION['idlibro']=$_POST['idlibro'];
                     $_SESSION['username']=$_POST['username'];
                     
                    //        $this->session->set_userdata('idlibro',$_POST['idlibro']);         
                      //        $this->session->set_userdata('username',$_POST['username']);              
                          
                      //      $datos['arrPrestamos']=$this->m_prestamos->prestadosDe( $this->session->userdata('idlibro'));   
                    
                    $datos['arrPrestamos']=$this->m_prestamos->prestadosDe( $_SESSION['idlibro']);                           
                    $this->load->view('v_prestamosdelibro',$datos);          
                            
                         
                  }
           }
       }
       
       
       function devolver($idprestamo)
       {
           if (!  $this->session->userdata('arrParaDevolver'))
                    $this->session->set_userdata('arrParaDevolver',array());
           
           $arrParaDevolver=$this->session->userdata('arrParaDevolver');
           if (!in_array($idprestamo,$arrParaDevolver))
                   $arrParaDevolver[]=$idprestamo;
           
           $this->session->set_userdata('arrParaDevolver',$arrParaDevolver);                
          
           $datos['arrPrestamos']=$this->m_prestamos->prestadosDe($this->session->userdata('idlibro'));                              
           $this->load->view('v_prestamosdelibro',$datos);           
       }
       
       
       
       function grabarDevoluciones()
       {
           //Borrar de la BD prestamos del array de sesion
           $cantidadDevoluciones=$this->m_prestamos->grabarDevoluciones();
           
           //Eliminar el array de sesión
           $this->session->unset_userdata('arrParaDevolver');
           
           //Parte 2
           $datos['arrPrestamos']=$this->m_prestamos->prestadosDe($this->session->userdata('idlibro'));         
           $datos['mensajeRtdo']="Se han realizado $cantidadDevoluciones devoluciones";
           $this->load->view('v_prestamosdelibro',$datos);       
       }
         


        function setValidRules()
        {

                $this->form_validation->set_rules('username', 'Usuario', 'required|min_length[3]');
                $this->form_validation->set_rules('idlibro', 'Libro', 'required');
                $this->form_validation->set_message('required', 'El campo %s es obligatorio');
                $this->form_validation->set_message('min_length', '%s:Minimo de %d caracteres');         
        }


}
