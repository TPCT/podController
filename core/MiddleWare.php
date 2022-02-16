<?php
namespace core;

abstract class MiddleWare{
    public abstract function Rules();
    public function load(){
        if ($this->Rules())
            return True;
        return False;
    }
}
