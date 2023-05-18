<?php

require_once 'controller/error.php';

class App{
    function __construct(){

        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);

        if(empty($url[0])){
            $archivoController = 'controller/main.php';
            require_once $archivoController;
            $controller = new Main();
            $controller->loadModel('Main');
            return false;
        }

        $archivoController = 'controller/' . $url[0] . '.php';

        session_start();
        if(!isset($_SESSION['user_id']) && !isset($_SESSION['username'])){

            switch($url[0]){
                case 'main':
                    $url[0] = 'main';
                    break;
                case 'inicioSesion':
                    $url[0] = 'inicioSesion';
                    break;
                case 'registrarUsuario':
                    $url[0] = 'registrarUsuario';
                    break;
                case 'AccionesInicioSesion':
                    $url[0] = 'AccionesInicioSesion';
                    break;
                case 'detallesProductos':
                    $url[0] = 'detallesProductos';
                    break;
                default:
                    if(!file_exists($archivoController)){
                        $controller = new Errores();
                    } else{
                        echo '<script>';
                        echo 'alert("Debe iniciar sesion primero.");';
                        echo 'window.location.replace("' . constant('URL') . 'inicioSesion")';
                        echo '</script>';
                    }
            }
        }

        if(file_exists($archivoController)){
            require_once $archivoController;
            $controller = new $url[0];
            $controller->loadModel($url[0]);

            if(isset($url[1])){
                $controller->{$url[1]}();
            }
        } else {
            $controller = new Errores();
        }

    }
}

?>