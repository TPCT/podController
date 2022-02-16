<?php

namespace controllers;

use core\Controller;
use core\Request;
use core\Response;
use middlewares\AdminMiddleWare;
use models\DeleteSettingModel;
use models\FetchersModel;
use models\SaveSettingModel;

class AdminDashboardController extends Controller{
    public function __construct(){
        $this->setLayout('main');
        $this->response = new Response();
        $this->request = new Request();
        $this->setMiddleWare(new AdminMiddleWare());
    }
    
    public function index(): array|bool|string|null{
        return $this->render("dashboard");
    }

    public function fetchCountries(): bool|string
    {
        $fetchersModel = new FetchersModel();
        $countries = $fetchersModel->fetchCountries();
        return $this->response->returnJson(['status' => 1, 'data' => $countries]);
    }

    public function fetchObstructions(): bool|string
    {
        $fetchersModel = new FetchersModel();
        $obstructions = $fetchersModel->fetchObstructions();
        return $this->response->returnJson(['status' => 1, 'data' => $obstructions]);
    }

    public function saveSetting(): bool|string{
        $reply = ['status' => 1];
        $saveSettingsModel = new SaveSettingModel();
        $saveSettingsModel->loadData($this->request->body());
        $reply['validate'] = $saveSettingsModel->validate();
        $reply['body'] = $this->request->body();
        if (!($saveSettingsModel->validate() && $saveSettingsModel->save()))
            $reply['status'] = 0;
        return $this->response->returnJson($reply);
    }

    public function fetchSettings(): bool|string{
        $reply = ['status' => 1, 'data' => []];
        $fetchersModel = new FetchersModel();
        $fetchersModel->loadData($this->request->body());
        $settings = $fetchersModel->fetchSettings();
        $reply['data'] = $settings;
        return $this->response->returnJson($reply);
    }

    public function deleteSetting(): bool|string{
        $reply = ['status' => 1];
        $deleteSettingsModel = new DeleteSettingModel();
        $deleteSettingsModel->loadData($this->request->body());
        $reply['validate'] = $deleteSettingsModel->validate();
        $reply['body'] = $this->request->body();
        if (!($deleteSettingsModel->validate() && $deleteSettingsModel->delete()))
            $reply['status'] = 0;
        return $this->response->returnJson($reply);
    }
}