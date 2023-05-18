<?php

class View{

    public $mensaje;

    function __construct() {
    }

    function render($nombre){
        require 'views/' . $nombre . '.php';
    }
}

?>