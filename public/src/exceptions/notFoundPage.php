<?php

namespace src\exceptions;

class notFoundPage extends \Exception{

    public function fileNotFound(){
        print_r("Страница не найдена");
    }

}