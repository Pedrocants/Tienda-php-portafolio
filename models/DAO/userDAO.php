<?php
interface userDAO{
    public function save($usuario, $db);
    public function login($email, $pass, $db);
    public function updateUser($id, $db);
}
?>