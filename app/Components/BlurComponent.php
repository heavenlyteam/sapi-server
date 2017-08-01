<?php

namespace app\Components;


use app\Base\BaseComponent;

class BlurComponent extends BaseComponent
{
    private static $name = 'Blur';
    public $file;

    public function init($fileName = null)
    {
        return true;
    }

    public function run()
    {
        return true;
    }

    /**
     * @param $imageFile
     * @param $newName
     * @param $blurPower
     * @return bool
     */
    public static function blur($imageFile, $newName, $blurPower)
    {
        $imageBlurFile = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'Components' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . self::$name . DIRECTORY_SEPARATOR . 'imageBlur';
        $result = exec($imageBlurFile . ' ' . $imageFile . ' ' . $newName . ' ' . $blurPower);
        if((bool)$result) {
            return true;
        }else {
            return $imageBlurFile . ' ' . $imageFile . ' ' . $newName . ' ' . $blurPower;
        }
    }
}