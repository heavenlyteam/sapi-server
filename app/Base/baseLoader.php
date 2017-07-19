<?php

function __autoload($class)
{
    $parts = explode('\\', $class);
    try {
        require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Base'. DIRECTORY_SEPARATOR . end($parts) . '.php';;
    } catch (Exception $ex) {
        echo json_encode([
            'status' => false,
        ]);
    }
}