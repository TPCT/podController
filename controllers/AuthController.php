<?php

namespace controllers;

use core\Application;
use core\Controller;
use core\Request;
use core\Response;
use helpers\Helper;
use models\AuthModel;
use models\RegisterModel;

class AuthController extends Controller{
    public function __construct(){
        $this->setLayout('auth');
        $this->response = new Response();
        $this->request = new Request();
    }
    
    public function login(){
        $redirect = $this->redirect();
        if ($redirect)
            return $redirect;

        if ($this->request->isPost()){
            $reply = ['status' => 0, 'redirect' => Null];
            $authModel = new AuthModel();
            $body = Application::APP()->request->body();
            $authModel->loadData($body);
            if ($reply['status'] = ($authModel->validate() && $authModel->login())){
                $reply['redirect'] = "/admin/dashboard";
            }
            return $this->response->returnJson($reply);
        }
        
        
        return $this->render('login');
    }
    

    public function logout(){
        Application::APP()->redirection->redirect("/", true);
    }

    private function redirect(){
        if (Helper::logged())
            return Application::APP()->redirection->redirect("/admin/dashboard");
        return False;
    }
}