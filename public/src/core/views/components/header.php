<header onload="updateCartCount()">
    <a href="/"><img src="/svg/Logo.svg" alt="" /></a>
    <nav>
        <a href="/catalog">Каталог</a>
        <a href="/sales">Акции</a>
        <a href="/delivery">Доставка и оплата</a>
        <a href="/contacts">Контакты</a>
        <?if(isset($_SESSION['user'])):?>
            <a href="/profile">Профиль</a>
        <?endif;?>
        <?if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin'):?>
            <a href="/admin">Админ. панель</a>
        <?endif;?>
    </nav>
    <div class="header-icons">
        <a href="/favorite"><img src="/svg/star.svg" alt="" /></a>
        <a href="/cart" id="cartCount"  name="cartCount"><img src="/svg/shopping bag.svg" alt="" /> 
        <span id="cart-count">0</span></a>
         <?if(isset($_SESSION['user'])):?>
            <form action="/quit" method="post">
                <button><img src="/svg/logout.svg" alt="" /></button>
            </form>
            <?else:?>
            <a href="/login"><img src="/svg/person.svg" alt="" /></a>
            <?endif;?>
    </div>  
</header>