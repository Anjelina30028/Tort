<?php

namespace src\core\contollers;
use Mockery\Undefined;
use src\core\services\Connect;
use src\exceptions\notFoundPage;
use src\exceptions\notFoundUrl;
class Router
{
    public static $listPages = [];


    public static function myGet($url, $namePage)
    {
        self::$listPages[] =
            [
                'url' => $url,
                'namePage' => $namePage
            ];
    }

    public static function myPost($url, $class, $method)
    {
        self::$listPages[] =
            [
                'url' => $url,
                'class' => $class,
                'method' => $method
            ];
    }

    public static function getContent()
    {

        $rout = $_GET['rout'] ?? "";
        if (!in_array('/' . $rout, array_column(self::$listPages, 'url'))) {
            throw new notFoundUrl();
        }
        foreach (self::$listPages as $val) {
            if ($val['url'] === '/' . $rout) {
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    switch ($val['url']) {
                        case '/addItem':
                        case '/deleteItem':
                        case '/updateItem':
                        case '/upload':
                        case '/reg':
                        case '/addCategory':   
                        case '/auth':
                        case '/quit':
                        case '/order':
                        case '/addFavorite':
                        case '/deleteFavorite':
                        case '/changeStatus':
                            $class = new $val['class'];
                            $method = $val['method'];
                            $class->$method();
                            break;
                    }
                } else {
                    if (!file_exists(__DIR__ . '/../views/pages/' . $val['namePage'] . '.php')) {
                        throw new notFoundPage();
                    }
                    require_once __DIR__ . '/../views/pages/' . $val['namePage'] . '.php';
                    die();
                }
            }
        }

    }
}
