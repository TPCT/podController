<?php
namespace core;

abstract class Controller{
    private ?string $Layout = Null;
    private array $Middlewares = [];
    protected Request $request;
    protected Response $response;

    public function setMiddleWare(MiddleWare $middleware){
        $this->Middlewares[] = $middleware;
    }

    public function middlewares(){
        return $this->Middlewares;
    }

    public function layout(){
        return $this->Layout;
    }

    public function setLayout($layout){
        $this->Layout = $layout;
    }

    public function render($view, $params = []){
        return Application::APP()->router->renderView($view, $params);
    }
}