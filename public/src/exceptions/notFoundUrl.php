<?php

namespace src\exceptions;

class notFoundUrl extends \Exception{

    public function notFoundUrl(){
        print_r("Неизвестный URL");
    }
}