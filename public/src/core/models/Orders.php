<?php

namespace src\core\models;

use src\core\services\Connect;

class Orders
{

    public static function order()
    {

        $db = Connect::getConnect();
        
        if (!$db) {
            die("Ошибка подключения к базе данных");
        }
        $order = $_POST['order'];
        $phone = $_POST['phone'];
        $user_id = $_SESSION['user']['id'];
        $query = "INSERT INTO `orders` (`id`, `item_id`, `status`, `phone`, `user_id`) VALUES (NULL, '$order', 'Новый', '$phone');";

        $query = $db->query($query);
        header('Location: /');
    }

    public static function getOrders()
    {
        $db = Connect::getConnect();

        if (!$db) {
            die("Ошибка подключения к базе данных");
        }

        $orders = $db->query("SELECT * FROM `orders`");
        $orderList = [];
        while ($order = mysqli_fetch_assoc($orders)) {
            $orderList[] = $order;
        };  
        return $orderList;
    }

        public static function getHistory($id)
    {
        $db = Connect::getConnect();

        if (!$db) {
            die("Ошибка подключения к базе данных");
        }

        $orders = $db->query("SELECT * FROM `orders` Where `user_id` = '$id'");
        $orderList = [];
        while ($order = mysqli_fetch_assoc($orders)) {
            $orderList[] = $order;
        };  
        return $orderList;
    }

    public static function changeStatus()
    {
        $db = Connect::getConnect();

        if (!$db) {
            die("Ошибка подключения к базе данных");
        }

        $status = $_POST['status'];
        $orderId = $_POST['order_id'];

        $sql = "UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = '$orderId';";

        $db->query($sql);

        header('Location: /admin');

    }

    public static function StringInArray($string)
    {
        $cleanStr = trim($string, '{}');
        $pairs = explode(',', $cleanStr);

        $array = [];

        foreach ($pairs as $pair) {
            list($key, $value) = array_map('trim', explode(':', $pair));
            $array[(int)$key] = (int)$value;
        }
        return $array;
    }
}
