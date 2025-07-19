<?php

namespace src\core\models;

use src\core\services\Connect;

use function PHPSTORM_META\type;

class Favorite
{
    public static function addFavorite()
    {
        $id = $_POST['id'];
        $user = $_SESSION['user']['id'];
        if (empty($user)) {
            header('Location: /login?message=Для добавления в избранное необходимо авторизоваться');
        }
        $db = Connect::getConnect();

        $sql = "SELECT * FROM `favorite` WHERE `user_id` = '$user'";
        $query =  $db->query($sql);
        $query = mysqli_fetch_assoc($query);

        if (empty($query)) {
            $sql = "INSERT INTO `favorite` (`id`, `item_id`, `user_id`) VALUES (NULL, '$id', '$user')";
        } else {
            $query = explode(",", $query['item_id']);
            $query = array_unique($query);
            $query = implode(",", $query);
            $item_id = $query . "," . $id;
            $sql = "UPDATE `favorite` SET `item_id` = '$item_id' WHERE `user_id` = '$user'";
        };

        $query = $db->query($sql);
        header('Location: /favorite');
    }

    public static function getFavorite($id)
    {
        $db = Connect::getConnect();
        $sql = "SELECT * FROM `favorite` WHERE `user_id` = '$id'";
        $query = $db->query($sql);
        $query = mysqli_fetch_array($query);
        $query = explode(",", $query[1]);
        $query = array_unique($query);
        $itemList = [];
        foreach ($query as $item) {
            $item = Items::getItem($item);
            $itemList[] = $item;
        }
        return $itemList;
    }

    public static function deleteFavorite()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $user = $_SESSION['user']['id'];

        $sql = "SELECT * FROM `favorite` WHERE `user_id` = '$user'";
        $query =  $db->query($sql);
        $query = mysqli_fetch_assoc($query);
        $array = array_filter(explode(',', $query['item_id']));
        $array = array_diff($array, [(string)$id ]);
        $array = implode(',', $array);

        $sql = "UPDATE `favorite` SET `item_id` = '$array' WHERE `user_id` = '$user'";
        $query = $db->query($sql);
        header('Location: /favorite');
         
    }
}
