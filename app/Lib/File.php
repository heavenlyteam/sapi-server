<?php

namespace app\Lib;


class File
{
    public $path;
    private $file;
    public $tmpPath;
    public $size;
    public $supportedFileTypes = ['image'];

    /**
     * File constructor.
     * @param $file
     * @param $typeValidation
     */
    public function __construct($file, $typeValidation)
    {
        $file = $_FILES[$file];
        if (!in_array($typeValidation, $this->supportedFileTypes)) return new \Exception('Unsupported format');
        $this->file = $file;
        $this->tmpPath = $file['tmp_name'];
        return $this;
    }

    public function extension($dot = false) {
        if($dot) return '.' . pathinfo($this->file['name'], PATHINFO_EXTENSION);
        return pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    /**
     * @param string $type
     * @return bool|\Exception
     */
    public function isValid(string $type)
    {
        if (!in_array($this, $this->supportedFileTypes)) return new \Exception('Unsupported format');
        if ($type === 'image' && getimagesize($this->file['tmp_name'])) {
            return true;
        } else {
            return false;
        }
    }

    public function sizeValidation($maxSize)
    {
        if ($this->file['size'] > $maxSize) return false;
        return true;
    }

    public function saveAs(string $name, string $destination)
    {
        try {
            if (move_uploaded_file($this->file['tmp_name'], $destination . $name)) {
                $this->path = $destination . $name;
                return true;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            return false;
        }
    }

    public function remove()
    {
        try {
            unlink($this->path);
            return true;
        } catch (\Exception $ex) {
            return false;
        }
    }

    public static function isExists($key)
    {
        try {
            if(isset($_FILES[$key])) {
                return true;
            }else {
                return false;
            }
        } catch(\Exception $ex) {
            return false;
        }
    }
}