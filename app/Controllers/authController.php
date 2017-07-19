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
        $tokenHash = md5($this->app->config->hashSalt() . time());
        $accessToken = $this->app->store->insert('token', [
            'user_id' => $User->id,
            'token' => $tokenHash
        ])->exec()->all();

        if($accessToken) {


            $accessTokenRecord = $this->app->store->select(['token'])->from('token')
                ->where('token', '=', $tokenHash)->exec()->one();

            echo json_encode([
                'status' => true,
                'token' => $accessTokenRecord->token,
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
                'desc' => 'request not post'
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

        $User = $this->app->store->select(['id', 'login', 'password', 'name'])->from('user')
            ->where('login', '=', $this->request->post('login'))
            ->where('password', '=', $passwordHash)->exec()->one();

        if(empty((array)$User)) {
            $User = $this->app->store->insert('user', [
                'login' => $this->request->post('login'),
                'password' => md5($this->app->config->hashSalt() . $this->request->post('password')),
            ])->exec()->one();
        }
        if(!$User) {
            $this->actionLogin();
            return false;
        }else {
            echo json_encode([
                'desc' => 'user not created',
                'status' => false,
            ]);
            return false;
        }

    }

}