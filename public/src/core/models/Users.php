<?php

namespace src\core\models;

use src\core\services\Connect;

class Users
{

    public static function registration()
    {
        $db = Connect::getConnect();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_ver = $_POST['password_ver'];
        $pass_hash = password_hash($password, PASSWORD_DEFAULT);
        $checkReg = $db->query("SELECT `email` FROM `users` WHERE `email`='$email'");
        if($password === $password_ver){
            if (mysqli_num_rows($checkReg) === 0) {
                $reg = $db->query("INSERT INTO `users`(`email`,`password`) VALUES ('$email','$pass_hash')");
                $message = 'Зарегестрирован';
                if (!$reg) {
                    $message = 'Ошибка при регистрации';
                }
                header("Location: /?message=$message");
            } else {
                $message = 'Такой пользователь уже есть';
                header("Location: /?message=$message");
            }
        }
        else{
            $message = 'Пароли не совпадают';
            header("Location: /registration?message=$message");
        }
    }

    public static function auth()
    {
        $db = Connect::getConnect();
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = $db->query("SELECT `id`, `email`, `password`, `role` FROM `users` WHERE `users`.`email` = '$email'");
        if (mysqli_num_rows($sql) === 0) {
            $message = 'Такой пользователь не найден';
            header("Location: /?message=$message");
        } else {
            $user = mysqli_fetch_assoc($sql);
            if ($email === $user['email'] && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $message = 'Дарова, ' . $user['email'];
                header("Location: /login?message=$message");
            }
            else{
                $message = 'Неправильный логин или пароль';
                header("Location: /login?message=$message");
            }
        }
    }

    public static function quit(){
        unset($_SESSION['user']);
        $message = 'Вышел из аккаунта';
        header("Location: /?message=$message");
    }
}