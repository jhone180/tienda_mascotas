<?php

require_once 'models/IModel.php';

interface IDataBase{

    public function insertar(IModel $obj);

    public function actualizar(IModel $obj);

    public function consultar($id);

    public function eliminar($id);

}

?>