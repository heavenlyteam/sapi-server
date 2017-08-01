<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 8/1/17
 * Time: 20:20
 */

namespace app\Controllers;


use app\Components\BlurComponent;
use app\Lib\File;

class photoController extends BaseGuestController
{
    public function actionUpload()
    {
        if (!File::isExists('photo')) return [
            'status' => false,
            'description' => 'empty photo file',
        ];

        $file = new File('photo', 'image');
        if (!$file->isValid('image')) return [
            'status' => false,
            'description' => 'invalid file',
        ];

        if (!$file->saveAs(uniqid() . $file->extension(true), $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR)) return [
            'status' => false,
            'description' => 'can not file save',
        ];

        $blurFileName = uniqid() . $file->extension(true);
        $newBlurFileDest = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'media' . DIRECTORY_SEPARATOR . $blurFileName;

        $blurTimeStart = time();
        $blurLog = BlurComponent::blur($file->path, $newBlurFileDest, 500);
        $blurTimEnd = time();
        return [
            'status' => true,
            'blur' => $blurLog,
            'blur_runtime' => ($blurTimEnd - $blurTimeStart) . ' sec',
            'extension' => $file->extension(),
            'images' => [
                'blur' => 'http://media.hiddencloud.pro/' . $blurFileName,
                'origin' => 'http://media.hiddencloud.pro/' . $file->savedName,
            ]
        ];
    }
}