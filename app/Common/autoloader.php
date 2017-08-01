<?php


function __autoload($class)
{
    $parts = explode('\\', $class);
    try {
        if(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR . end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Controllers'. DIRECTORY_SEPARATOR . end($parts) . '.php';
        } elseif(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Models'. DIRECTORY_SEPARATOR. end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR .  'Models'. DIRECTORY_SEPARATOR. end($parts) . '.php';
        } elseif(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Base'. DIRECTORY_SEPARATOR. end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR .  'Base'. DIRECTORY_SEPARATOR. end($parts) . '.php';
        } elseif(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Common'. DIRECTORY_SEPARATOR. end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR .  'Common'. DIRECTORY_SEPARATOR. end($parts) . '.php';
        } elseif(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Components'. DIRECTORY_SEPARATOR. end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR .  'Components'. DIRECTORY_SEPARATOR. end($parts) . '.php';
        }elseif(is_file($_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR . 'Lib'. DIRECTORY_SEPARATOR. end($parts) . '.php')) {
            require $_SERVER['DOCUMENT_ROOT']. DIRECTORY_SEPARATOR .'app'. DIRECTORY_SEPARATOR .  'Lib'. DIRECTORY_SEPARATOR. end($parts) . '.php';
        }
    } catch (Exception $ex) {
        echo json_encode([
            'status' => false,
        ]);
    }
}