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

        $passwordHash = md5($this->app->config->hashSalt() . $this->request->post('password'));

        $User = $this->app->store->select(['id', 'login'])->from('user')
            ->where('login', '=', $this->request->post('login'))
            ->where('password', '=', $passwordHash)->exec()->one();

        if(!$User) {
            echo json_encode([
                'status' => false,
            ]);
            return false;
        }

        $accessToken = $this->app->store->insert('token', [
            'user_id' => $User->id,
            'token' => md5($this->app->config->hashSalt() . time())
        ])->exec()->one();

        if($accessToken) {
            echo json_encode([
                'status' => true,
                'token' => $accessToken->token,
            ]);
            return false;
        }else {
            echo json_encode([
                'status' => false,
            ]);
            return false;
        }
    }

    public function actionJoin() {
        if(!$this->request->isPost()) {
            echo json_encode([
                'status' => false,
            ]);
            return false;
        }

        if(!$this->request->post('login') || !$this->request->post('password')) {
            echo json_encode([
                'status' => false,
                'description' => 'miss required params',
            ]);
            return false;
        }

        $passwordHash = md5($this->app->config->hashSalt() . $this->request->post('password'));

        $User = $this->app->store->select(['id', 'login'])->from('user')
            ->where('login', '=', $this->request->post('login'))
            ->where('password', '=', $passwordHash)->exec()->one();

        if(!$User) {
            $this->actionLogin();
            return false;
        }else {
            echo json_encode([
                'status' => false,
            ]);
            return false;
        }

    }

}