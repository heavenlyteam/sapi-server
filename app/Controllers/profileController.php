<?php

namespace app\Controllers;


class profileController extends \BaseUserController {

    public function actionIndex() {
        echo json_encode([
            'status' => 'hui',
            'login' => $this->user->login
        ]);
    }

}