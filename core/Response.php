<?php
namespace core;

class Response{
    public function setStatusCode(int $code){
        \http_response_code($code);
    }
    public function setResponseHeaders(array $headers){
        foreach($headers as $header)
            \header($header);
    }

    public function returnJson(mixed $data){
        \header("content-type: application/json");
        return \json_encode($data);
    }
}