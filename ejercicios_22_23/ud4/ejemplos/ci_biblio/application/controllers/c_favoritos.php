<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_favoritos extends CI_Controller {

	function __construct()  
        {
            parent::__construct();
            $this->load->model('m_favoritos');
	}

	
        function index()
        {   
            $this->verlogin();
            
        }
        
        
   
        function verlogin($str_login_error="")
        {
            $datos['str_login_error']=$str_login_error;
            
            $this->load->view('v_favoritos_cabecera');
            $this->load->view('v_login',$datos);
            $this->load->view('v_favoritos_pie');
        }
        
        function usuario_password_ok($usuario,$password)
        {
            //El password debe ser el usuario invertido
            
            $usuario_alreves="";
            for ( $i=strlen($usuario)-1; $i>=0; $i--){
                $usuario_alreves.=$usuario[$i];
            }
            if ($usuario_alreves==$password)
                return true;
            return false;
            
        }
        
        
        function login(){
            
            if (!isset($_POST['submitlogin'])){
                redirect('c_autores');
            }
            else
            {
                $usuario=$_POST['usuario'];
                $password=$_POST['password'];
                if (!$this->usuario_password_ok($usuario,$password))
                {
                    //login mal
                    $this->verlogin("Combinación usuario/password erronea");
                }
                else
                {
                    $_SESSION['usuario']=$usuario;        
                    $_SESSION['librosfavoritos']=array();
                    
                    $datos['todoslibros']=$this->m_favoritos->todoslibros();//Devuelve array de objetos con (idlibro,titulo, autor)
                    $this->load->view('v_favoritos_cabecera');
                    $this->load->view('v_favoritos',$datos);
                    $this->load->view('v_favoritoselegidos');
                    $this->load->view('v_favoritos_pie');
                    
                }                
            }
        } 
            
        function agregar_favorito(){
            
                if (!isset ($_POST['submitlibrofav'])  ||  (!isset($_SESSION['usuario']))){
                    $this->verlogin();
                }
                else{
                    
                    $idlibro=$_POST['idlibro'];    
                    if ( in_array($idlibro, $_SESSION['librosfavoritos']))
                    {
                        $datos['rtdo_aniadir_favorito']="Ya has añadido $idlibro como favorito";
                    }
                    else
                    {
                        $_SESSION['librosfavoritos'][]=$idlibro;
                        $datos['rtdo_aniadir_favorito']="$idlibro añadido";
                    }
                    
                    $datos['todoslibros']=$this->m_favoritos->todoslibros();//Devuelve array de objetos con (idlibro,titulo, autor)
                    $this->load->view('v_favoritos_cabecera');
                    $this->load->view('v_favoritos',$datos);
                    $this->load->view('v_favoritoselegidos',$datos);
                    $this->load->view('v_favoritos_pie');
                    
                    
                    
                }
        }
            
        
       
}

