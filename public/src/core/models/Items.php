<?php

namespace src\core\models;

use src\core\services\Connect;

class Items
{
    // public static function getItems($limit = null, $offset = null)
    // {
    //     $db = Connect::getConnect();
    //     if (!$limit) {
    //         $limit = 500;
    //     }
    //     if (!$offset) {
    //         $offset = 0;
    //     }
    //     $items = $db->query("SELECT * FROM `items` LEFT JOIN `images` ON `items`.`id` = `images`.`item_id` LEFT JOIN `categories` ON `items`.`category` = `categories`.`category_id` LIMIT $offset,$limit");
    //     $itemList = [];

    //     while ($item = mysqli_fetch_assoc($items)) {
    //         $itemList[] = $item;
    //     }
    //     return $itemList;
    // }

    public static function getItems($limit = null, $offset = null)
{
    $db = Connect::getConnect();
    if (!$db) {
        die("Ошибка подключения к базе данных");
    }

    // Установка значений по умолчанию
    $limit = $limit ?? 500;
    $offset = $offset ?? 0;

    // Базовый запрос
    $query = "SELECT `items`.*, `images`.`image_path`, `categories`.`category_name` 
              FROM `items` 
              LEFT JOIN `images` ON `items`.`id` = `images`.`item_id` 
              LEFT JOIN `categories` ON `items`.`category` = `categories`.`category_id`";

    // Добавление поиска, если есть параметр
    if (isset($_GET['search']) && trim($_GET['search']) !== '') {
        $search = trim($_GET['search']);
        $searchEscaped = mysqli_real_escape_string($db, $search);
        
        // Разбиваем поисковый запрос на отдельные слова
        $keywords = explode(' ', $searchEscaped);
        
        $whereConditions = [];
        foreach ($keywords as $keyword) {
            if (!empty($keyword)) {
                $whereConditions[] = "(`items`.`name` LIKE '%$keyword%' 
                                    OR `items`.`description` LIKE '%$keyword%' 
                                    OR `items`.`compound` LIKE '%$keyword%'
                                    OR `categories`.`category_name` LIKE '%$keyword%')";
            }
        }
        
        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(' AND ', $whereConditions);
        }
    }

    // Добавляем сортировку и лимит
    $query .= " ORDER BY `items`.`id` DESC LIMIT $offset, $limit";

    $result = $db->query($query);
    if (!$result) {
        die("Ошибка SQL: " . mysqli_error($db));
    }

    $itemList = [];
    while ($item = mysqli_fetch_assoc($result)) {
        $itemList[] = $item;
    }

    return $itemList;
}

    public static function getPopularItems($limit = null, $offset = null)
    {
        $db = Connect::getConnect();
        if (!$limit) {
            $limit = 500;
        }
        if (!$offset) {
            $offset = 0;
        }
        $items = $db->query("SELECT * FROM `items` LEFT JOIN `images` ON `items`.`id` = `images`.`item_id` LEFT JOIN `categories` ON `items`.`category` = `categories`.`category_id` WHERE `items`.`is_popular` = 1 LIMIT $offset,$limit");
        $itemList = [];

        while ($item = mysqli_fetch_assoc($items)) {
            $itemList[] = $item;
        }
        return $itemList;
    }

    public static function getItem($id = Null)
    {
        $db = Connect::getConnect();
        if (!$id) {
            $id = $_GET['id'];
        }
        $query = $db->query("SELECT * FROM `items` LEFT JOIN `images` ON  `items`.`id` = `images`.`item_id` LEFT JOIN `categories` ON `items`.`category` = `categories`.`category_id` WHERE `items`.`id`='$id'");
        $item = mysqli_fetch_assoc($query);
        return $item;

    }
    public static function getCategory()
    {
        $db = Connect::getConnect();
        $category = $_GET['category'];
        $items = $db->query("SELECT * FROM `items` LEFT JOIN `images` ON `items`.`id` = `images`.`item_id` LEFT JOIN `categories` ON `items`.`category` = `categories`.`category_id` WHERE `category_name`='$category'");
        $itemList = [];
        while ($item = mysqli_fetch_assoc($items)) {
            $itemList[] = $item;
        }
        return $itemList;
    }

    public static function getCategories()
    {
        $db = Connect::getConnect();
        $items = $db->query("SELECT * FROM `categories`");
        $itemList = [];
        while ($item = mysqli_fetch_assoc($items)) {
            $itemList[] = $item;
        }
        return $itemList;
    }

    public static function addItem()
    {
        $db = Connect::getConnect();
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $item = $db->query("INSERT INTO `items`(`name`, `price`, `category`) VALUES ('$name', '$price', '$category')");
        $item_id = mysqli_insert_id($db);
        $image = $db->query("INSERT INTO `images`(`item_id`) VALUES ('$item_id')");
        if ($item && $image) {
            $message = "Товар успешно добавлен";
            header("Location: /admin?message={$message}");
            die();
        } else {
            $message = "Ошибка при добавлении товара";
            header("Location: /admin?message={$message}");
            die();
        }

    }

    public static function deleteItem()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $item = Items::getItem($id);
        if (!empty($item['image_path'])) {
            if (unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $item['image_path'])) {
                $imgDelState = $item['image_path'] . ' удалено';
            } else {
                $imgDelState = 'deletent';
            }
        } else {
            $imgDelState = $item['name'] . ' не имеет картинок';
        }
        $query = $db->query("DELETE FROM `items` WHERE `items`.`id` = '$id'");
        $count = mysqli_affected_rows($db);
        if($query){
            $image = $db->query("DELETE FROM `images` WHERE `images`.`item_id` = '$id'");
        }
        if ($count === 0) {
            $message = "Ошибка при удалении, " . $imgDelState;
            header("Location: /admin/item?id=$id&message=$message");
            die();
        } else {
            $message = "Товар успешно удален, " . $imgDelState;
            header("Location: /admin?message=$message");
            die();
        }
    }

    public static function updateitem()
    {
        $db = Connect::getConnect();
        $id = $_POST['id'];
        $name = !empty($_POST['name']) ? $_POST['name'] : null;
        $description = !empty($_POST['description']) ? $_POST['description'] : null;
        $card_description = !empty($_POST['card_description']) ? $_POST['card_description'] : null;
        $price = !empty($_POST['price']) ? $_POST['price'] : 0;
        $category = !empty($_POST['category']) ? $_POST['category'] : null;
        $compound = !empty($_POST['compound']) ? $_POST['compound'] : null;
        $kkal = !empty($_POST['kkal']) ? $_POST['kkal'] : 0;
        $protein = !empty($_POST['protein']) ? $_POST['protein'] : 0;
        $fat = !empty($_POST['fat']) ? $_POST['fat'] : 0;
        $carbo = !empty($_POST['carbo']) ? $_POST['carbo'] : 0;
        $weight = !empty($_POST['weight']) ? $_POST['weight'] : 0;
        $is_popular = isset($_POST['is_popular']) ? 1 : 0;

        $message = '';

        if ($is_popular) {
            $popularCount = $db->query("SELECT COUNT(*) AS `count` FROM `items` WHERE `is_popular` = 1");
            $popularCount = mysqli_fetch_assoc($popularCount);
            $popularCount = $popularCount['count'];

            if ($popularCount >= 4) {
                $message .= 'Сейчас в популярном 4 или больше товара. Этот товар не будет в нем отображаться, <br>';
            }
        }

        $update = $db->query("UPDATE `items` SET 
        `name`='$name',
        `description`='$description',
        `card_description`='$card_description',
        `price`='$price',
        `category`='$category',
        `compound`='$compound',
        `kkal`='$kkal',
        `protein`='$protein',
        `fat`='$fat',
        `carbo`='$carbo',
        `weight`='$weight',
        `is_popular`='$is_popular'
        WHERE `items`.`id` = '$id'");


        self::uploadImage();

        if (mysqli_affected_rows($db) === 0) {
            $message .= "Ошибка при изменении данных товара";
            header("Location: /admin/item?id=$id&message=$message");
            die();
        } else {
            $message .= "Данные товара успешно изменены";
            header("Location: /admin/item?id=$id&message=$message");
            die();
        }
    }


    public static function uploadImage()
    {
        if (!empty($_FILES['image']['name'])) {
            $file = 'img/' . date('Ymdhis') . basename($_FILES['image']['name']);
            $uploadStatus = true;
            $id = $_POST['id'];
            $fileType = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    
            // Проверка на допустимые типы файлов
            if ($fileType != 'jpg' && $fileType != 'gif' && $fileType != 'png' && $fileType != 'jpeg') {
                $uploadStatus = false;
                $message = 'Недопустимый тип файла';
                return;
            }
    
            // Проверка на максимальный размер файла
            if ($_FILES['image']['size'] > 5242880 * 4) {
                $uploadStatus = false;
                $message = 'Слишком большой размер файла';
                return;
            }
    
            // Получение текущего изображения из базы данных
            $item = Items::getItem($id);
    
            // Проверка, есть ли изображение в базе данных
            if (!empty($item['image_path'])) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $item['image_path'];
    
                // Если файл существует на сервере, удаляем его
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // Загружаем новый файл, если все проверки прошли
            if ($uploadStatus) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                    // Обновление пути изображения в базе данных
                    $db = Connect::getConnect();
                    $db->query("UPDATE `images` SET `image_path`='$file' WHERE `images`.`item_id`='$id'");
                } else {
                    $message = 'Не удалось загрузить файл';
                }
            }
        }
        else{
            return;  // Если нет файла, ничего не делаем
        }
    }
    
    public static function addCategory()
{
    $db = Connect::getConnect();
    
    // Проверяем, что название категории передано и не пустое
    if (empty($_POST['category_name'])) {
        $message = "Название категории не может быть пустым";
        header("Location: /admin?message={$message}");
        die();
    }

    $categoryName = trim($_POST['category_name']);
    
    // Экранируем специальные символы для безопасности
    $categoryName = mysqli_real_escape_string($db, $categoryName);
    
    // Проверяем, не существует ли уже такая категория
    $checkQuery = $db->query("SELECT * FROM `categories` WHERE `category_name` = '$categoryName'");
    if (mysqli_num_rows($checkQuery) > 0) {
        $message = "Категория '$categoryName' уже существует";
        header("Location: /admin?message={$message}");
        die();
    }
    
    // Добавляем новую категорию
    $query = $db->query("INSERT INTO `categories` (`category_name`) VALUES ('$categoryName')");
    
    if ($query) {
        $message = "Категория '$categoryName' успешно добавлена";
        header("Location: /admin?message={$message}");
        die();
    } else {
        $message = "Ошибка при добавлении категории: " . mysqli_error($db);
        header("Location: /admin?message={$message}");
        die();
    }
}
    


}