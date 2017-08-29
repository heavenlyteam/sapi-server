<?php

namespace app\Controllers;


use app\Base\BaseUserController;

class profileController extends BaseUserController {

    public function actionIndex() {

        return [
            'status' => 'hui',
            'login' => $this->user->login,
            'id' => $this->user->id,
        ];
    }

}