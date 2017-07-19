<?php

namespace app\Controllers;

class authController extends BaseGuestController {

    public function actionLogin()
    {
        if(!$this->request->post('login') || !$this->request->post('password')) {
            echo json_encode([
                'status' => false,
                'description' => 'miss required params',
            ]);
            return false;
        }
        $query = $this->app->store
            ->select(['login', 'password'])
            ->from('users')
            ->where('id', '=', '1')
            ->where('login', '=', 'lorem')
            ->getQuery();

        echo $query;
        return true;
    }
}