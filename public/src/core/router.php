<?php

use src\core\contollers\Router;
use src\core\models\Favorite;
use src\core\models\Items;
use src\core\models\Orders;
use src\core\models\Users;
use src\exceptions\notFoundPage;
use src\exceptions\notFoundUrl;

try{
    Router::myGet('/', 'home');
    Router::myGet('/catalog', 'catalog');
    Router::myGet('/category', 'category');
    Router::myGet('/contacts', 'contacts');
    Router::myGet('/cart', 'cart');
    Router::myGet('/delivery', 'delivery');
    Router::myGet('/sales', 'sales');
    Router::myGet('/login', 'login');
    Router::myGet('/registration', 'registration');
    Router::myGet('/admin', 'admin');
    Router::myGet('/admin/items', 'admin');
    Router::myGet('/admin/item', 'admin-item');
    Router::myGet('/favorite', 'favorite');
    Router::myGet('/profile', 'profile');
    
    Router::myPost('/addCategory', Items::class, 'addCategory');

    Router::myPost('/addItem', Items::class, 'addItem');
    Router::myPost('/deleteItem', Items::class, 'deleteItem');
    Router::myPost('/updateItem', Items::class, 'updateItem');
    Router::myPost('/upload', Items::class, 'upload');
    
    Router::myPost('/reg', Users::class, 'registration');
    Router::myPost('/auth', Users::class, 'auth');
    Router::myPost('/quit', Users::class, 'quit');

    Router::myPost('/order', Orders::class, 'order');
    Router::myPost('/changeStatus', Orders::class, 'changeStatus');
    Router::myPost('/addFavorite', Favorite::class, 'addFavorite');
    Router::myPost('/deleteFavorite', Favorite::class, 'deleteFavorite');
    
    Router::getContent();
}
catch (notFoundPage $error){
    $error -> fileNotFound();
}
catch (notFoundUrl $e){
    $e -> notFoundUrl();
}

