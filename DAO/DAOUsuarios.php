<?php

require_once 'DAOGeneral.php';
require_once 'models/usuarios.php';
require_once 'controller/response.php';

class DAOUsuarios extends DAOGeneral{
    
    public function insertar(IModel $obj){
        if($obj instanceof Usuarios){
            return parent::insertar($obj);
        } else{
            Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function actualizar(IModel $obj) {
        if($obj instanceof Usuarios){
            return parent::actualizar($obj);
        } else {
            return Response::responseErrorInstancia($obj, $this->_obtenerInstanciaModelo());
        }
    }

    public function consultar($id) {
        if(!empty($id)){
            return parent::consultar($id);
        } else {
            return Response::responseErrorLlave();
        }
    }

    public function eliminar($id) {
        if(!empty($id)){
            return parent::eliminar($id);
        } else {
            return Response::responseErrorLlave();
        }
    }

    public function mapeoDatosRegistro(array $data){
        $obj = $this->_obtenerInstanciaModelo();
        $contrasena = $this->hashContrasena($data['contrasena']);
        if(isset($data['id'])){
            $obj->setId($data['id']);
        }
        $obj->setUsuario($data['nombreUsuario']);
        $obj->setContrasena($contrasena);
        return $obj;
    }

    public function mapeoDatos(array $data){
        $obj = $this->_obtenerInstanciaModelo();
        if(isset($data['id'])){
            $obj->setId($data['id']);
        }
        $obj->setUsuario($data['nombreUsuario']);
        $obj->setContrasena($data['contrasena']);
        return $obj;
    }

    protected function _obtenerInstanciaModelo(){
        return new Usuarios();
    }

    public function validarUsuario($usuario){
        $query = $this->connect()->prepare("SELECT usuario FROM usuarios WHERE usuario = ?");
        if(!$query->execute([$usuario])){
            $msg = "Erro en la consulta " . $this->connect()->errorInfo();
            $response = Response::responseErrorGeneral($msg);
        } elseif($query->rowCount() >= 1) {
            $msg = "Nombre de usuario ya registrado.";
            $response = Response::responseErrorGeneral($msg);
        }
        return $response;
    }

    protected function hashContrasena($contrasena){
        $hash = password_hash($contrasena, PASSWORD_DEFAULT);
        return $hash;
    }

    public function consultarUsuario(Usuarios $obj){
        $usuario = $obj->getUsuario();
        $contrasena = $obj->getContrasena();
        $validacionUsuario = $this->consultaNombreUsuario($usuario);
        
        if($validacionUsuario && password_verify($contrasena, $validacionUsuario['contrasena'])){
            $this->inicioSesion($validacionUsuario);
            $msg = "¡Bienvenido!";
            $response = Response::responseRespuestaGeneral($msg);
        } else {
            $msg = "Nombre de usuario o contraseña invalidos.";
            $response = Response::responseRespuestaErrorGeneral($msg);
        }
        return $response;
    }

    public function consultaNombreUsuario($usuario){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE usuario = ?');
        $query->execute([$usuario]);
        return $query->fetch();
    }

    public function inicioSesion($validacion){
        session_start();
        $_SESSION['user_id'] = $validacion['id'];
        $_SESSION['username'] = $validacion['usuario'];
    }
}

?>