<?php

namespace middlewares;

use core\MiddleWare;
use helpers\Helper;

class AdminMiddleWare extends MiddleWare{
    public function Rules(){
        if (Helper::logged())
            return True;
        return False;
    }
}
