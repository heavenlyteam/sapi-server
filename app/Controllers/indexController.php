<?php

namespace app\Controllers;

class indexController extends BaseGuestController
{
    public function actionIndex()
    {
        echo json_encode([
            'status' => true,
            'v' => '0.1',
            'requestType' => $this->app->request->type(),
            'lorem' => $this->app->request->post('lorem')
        ]);
    }

    public function actionLogin() {

    }

}