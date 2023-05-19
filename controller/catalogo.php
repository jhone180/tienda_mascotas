<?php



class Catalogo extends Controller{

    public function __construct(){
        parent::__construct();
        $this->view->render('catalogo/index');
    }

}

?>