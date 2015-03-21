<?php
class IndexAction extends Action {
	
    public function index(){
    	
    	if(!session('?users'))
    	{
    		$this->display("Login/nologin");
    	}else{
    		$this->display("index");
    	}	
    	
    }
    
    
}