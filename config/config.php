<?php

define('URL', 'http://localhost/TIENDA_MASCOTAS/');

define('HOST', 'localhost');
define('DB', 'tienda_mascotas');
define('USER', 'root');
define('PASSWORD', '');
define('CHARSET', 'utf8mb4');

function printR($var){
    echo '<pre>';
    die(print_r($var));
    echo '</pre>';
}

?>