<?php

namespace app\Controllers;

use app\Base\BaseGuestController;

class authController extends BaseGuestController {

    public function actionLogin()
    {
        if(!$this->request->post('login') || !$this->request->post('password')) {
            return [
                'status' => false,
                'description' => 'miss required params',
            ];
        }

        $passwordHash = md5($this->app->config->hashSalt() . $this->request->post('password'));

        $User = $this->app->store->select(['id', 'login'])->from('user')
            ->where('login', '=', $this->request->post('login'))
            ->where('password', '=', $passwordHash)->exec()->one();

        if(!$User) {
            return [
                'status' => false,
            ];
        }
        $tokenHash = md5($this->app->config->hashSalt() . time());
        $accessToken = $this->app->store->insert('token', [
            'user_id' => $User->id,
            'token' => $tokenHash
        ])->exec()->all();

        if($accessToken) {
            $accessTokenRecord = $this->app->store->select(['token'])->from('token')
                ->where('token', '=', $tokenHash)->exec()->one();
            return [
                'status' => true,
                'token' => $accessTokenRecord->token,
            ];
        }else {
            return [
                'status' => false,
            ];
        }
    }

    public function actionJoin() {
        if(!$this->request->isPost()) {
            return [
                'status' => false,
                'desc' => 'request not post'
            ];
        }

        if(!$this->request->post('login') || !$this->request->post('password')) {
            return [
                'status' => false,
                'description' => 'miss required params',
            ];
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
            return [
                'desc' => 'user not created',
                'status' => false,
            ];
        }

    }

}