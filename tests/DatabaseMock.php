<?php

class DatabaseMock {
    public function select($query, $params = []) {}
    public function insertar($query, $params = []) {}
    public function editar($query, $params = []) {}
    public function eliminar($query, $params = []) {}
    public function verificarPassword($idUsuario, $password) {}
    public function obtenerUsuarios() {}
}