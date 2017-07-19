<?php

namespace app\Controllers;


class profileController extends \BaseUserController {

    public function actionIndex() {
        return [
            'status' => 'hui',
            'login' => $this->user->login
        ];
    }

}