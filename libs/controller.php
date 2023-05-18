<?php

class Controller{

    protected $view;
    protected $model;

    function __construct() {
        $this->view = new View();
    }

    function loadFunction(){
        print_r($_GET);
        die();
        if(isset($_GET['_accion'])){
            print_r('entro la accion');
            die();
        }
    }

    function loadModel($model){
        $url = 'models/' . $model . 'model.php';

        if(file_exists($url)){
            require $url;
            $modelName = $model . 'Model';
            $this->model = new $modelName;
        }
    }
}

?>