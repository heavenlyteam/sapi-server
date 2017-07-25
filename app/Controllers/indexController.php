<?php

namespace app\Controllers;

use app\Models\User;

class indexController extends BaseGuestController
{
    public function actionIndex()
    {
        $users = (new User($this->app))->findAll([]);

        return [
            'status' => true,
            'v' => '0.1',
            'requestType' => $this->app->request->type(),
            'lorem' => $this->app->request->post('lorem'),
            'users' => $users
        ];
    }

    public function actionLogin() {
        return false;
    }

}