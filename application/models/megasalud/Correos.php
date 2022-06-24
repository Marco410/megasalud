<?php

class Correos extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
    
    function request_pass($token){
        
        $img_path = base_url('assets/images/correos').'/';
        
        $html = "
        
             <a href=https://www.megasalud.com.mx/app/reset_password/".$token."  ><img src='". $img_path ."contra1.png'  width='525px'' height='150px'   />
           </a>
           <img src='". $img_path ."contra2.png'  width='525px'' height='150px'  />
            ";
        
        return $html;
    }
    
    

}