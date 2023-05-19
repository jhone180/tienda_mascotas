<?php

class detallesProductos extends Controller{

    public function __construct(){
        parent::__construct();
        $this->view->render('detalles/index');
    }

    
}
?>