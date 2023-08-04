<?php

function app_controllers_autoload($class_path) {
    include 'controllers/' . $class_path . '.php';
}

spl_autoload_register('app_controllers_autoload');
?>