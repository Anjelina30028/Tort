document.addEventListener("DOMContentLoaded", () => {
  // Функция для открытия попапа
  function openPopup() {
    document.getElementById("overlay").classList.remove("hidden");
    console.log("Попап открыт");
  }

  // Функция для закрытия попапа
  function closePopup() {
    document.getElementById("overlay").classList.add("hidden");
    console.log("Попап закрыт");
  }

  // Загрузка корзины из localStorage
  function getCart() {
    return JSON.parse(localStorage.getItem("cart")) || {};
  }

function updateCartCount() {
   console.log("updateCartCount() вызвана");
  const cart = getCart(); // Получаем объект вроде { "4": 3 }
  let totalCount = 0;

  for (const productId in cart) {
    if (cart.hasOwnProperty(productId)) {
      totalCount += parseInt(cart[productId], 10);
    }
  }

  const cartCountElement = document.getElementById("cart-count");
  if (cartCountElement) {
    cartCountElement.textContent = totalCount;
  }
}

  // Функция для отображения кнопки и счетчика товара
  function updateCartUI(productId, cart) {
    const addToCartButton = document.querySelector(`.add-to-cart-btn[data-product-id="${productId}"]`);
    const counterContainer = document.querySelector(`.counterContainer[data-product-id="${productId}"]`);
    const numberElement = counterContainer ? counterContainer.querySelector(".number") : null;

    if (cart[productId]) {
      // Если товар в корзине, скрываем кнопку и показываем счетчик
      if (addToCartButton) addToCartButton.style.display = "none";
      if (counterContainer) {
        counterContainer.style.display = "flex";
        if (numberElement) numberElement.textContent = cart[productId];
      }
    } else {
      // Если товара нет в корзине, показываем кнопку и скрываем счетчик
      if (addToCartButton) addToCartButton.style.display = "block";
      if (counterContainer) counterContainer.style.display = "none";
    }
  }

  // Обработчик для всех карточек
  document.querySelectorAll(".card, .card-wide").forEach((card) => {
    card.addEventListener("click", function () {
      const itemId = this.getAttribute("data-id");
      const item = itemsData.find((i) => i.id == itemId);
      
      if (item) {
        const popupHTML = `
        <section class="main-info">
          <button class="popup_close-button">
            <img src="/img/cross.png" alt="Закрыть">
          </button>
          <div class="img-container">
            <img src="${item.image_path}" alt="" />
          </div>
          <div class="info">
            <h1>${item.name}</h1>
            <p>${item.description}</p>
            <div class="info-buttons">
              <a href="/cart"  class="green-button add-to-cart-btn">${item.price} ₽</a>
              <div class="counterContainer counter" style="display: none;" data-product-id="${item.id}">
                <button class="minus">-</button>
                <div class="number">1</div>
                <button class="plus">+</button>
              </div>
              <form action="/addFavorite" method="post" class="form-for-favorite">
                <input type="hidden" name="id" value="${item.id}">
                <button class="green-button-img"><img  src="svg/star.svg" alt="" id="star" /></button>
             </form>
              <p style="margin-top: 10px; margin-left: 20px;">${item.weight} гр.</p>
            </div>
            <p>Состав: <br>${item.compound}<br>
               Энергетическая ценность на 100 гр: ${item.kkal} Ккал <br>
               Основные питательные вещества:<br>
               белки ${item.protein}, жиры ${item.fat}, углеводы ${item.carbo}
            </p>
          </div>              
        </section>`;

        document.getElementById("popup-content").innerHTML = popupHTML;

        // Обновляем UI в попапе сразу после загрузки
        const cart = getCart();
        updateCartUI(item.id, cart);
        updateCartCount()
        addCartEventListeners(item.id); // Инициализируем события для этого конкретного товара
        openPopup();

        // Добавляем обработчик для кнопки закрытия попапа
        const closeButton = document.querySelector(".popup_close-button");
        if (closeButton) {
          closeButton.addEventListener("click", closePopup);
        }
      }
    });
  });

  // Закрытие попапа при клике на overlay
  document.getElementById("overlay").addEventListener("click", function (event) {
    if (event.target === this) {
      closePopup();
    }
  });

  // Функция для добавления товара в корзину
  function addToCart(productId) {
    let cart = getCart();

    if (cart[productId]) {
      cart[productId]++;
    } else {
      cart[productId] = 1;
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    console.log(`Товар ${productId} добавлен в корзину. Текущая корзина:`, cart);

    // Обновляем интерфейс
    updateCartUI(productId, cart);
    updateCartCount();
  }

  // Функция для уменьшения количества товара в корзине
  function decreaseQuantity(productId) {
    let cart = getCart();

    if (cart[productId] > 1) {
      cart[productId]--;
    } else {
      delete cart[productId];
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    console.log(`Товар ${productId} уменьшен. Текущая корзина:`, cart);

    // Обновляем интерфейс
    updateCartUI(productId, cart);
    updateCartCount();
  }

  // Функция для увеличения количества товара в корзине
  function increaseQuantity(productId) {
    let cart = getCart();
    cart[productId]++;
    localStorage.setItem("cart", JSON.stringify(cart));
    console.log(`Товар ${productId} увеличен. Текущая корзина:`, cart);

    // Обновляем интерфейс
    updateCartUI(productId, cart);
    updateCartCount();
  }

  // Добавление обработчиков событий для кнопки добавления в корзину
  function addCartEventListeners(productId) {
    const addToCartButton = document.querySelector(`.add-to-cart-btn[data-product-id="${productId}"]`);
    const counterContainer = document.querySelector(`.counterContainer[data-product-id="${productId}"]`);
    const numberElement = counterContainer ? counterContainer.querySelector(".number") : null;

    // Проверяем, что элементы существуют
    if (addToCartButton) {
      addToCartButton.addEventListener("click", () => {
        addToCart(productId);
      });
    }

    // Проверяем, что счетчик существует
    if (counterContainer) {
      counterContainer.querySelector(".plus").addEventListener("click", () => {
        increaseQuantity(productId);
      });

      counterContainer.querySelector(".minus").addEventListener("click", () => {
        decreaseQuantity(productId);
      });
    }
  }

  // Загрузка корзины и инициализация интерфейса для всех товаров
  const cart = getCart();
  itemsData.forEach((item) => {
    updateCartUI(item.id, cart); // Обновляем UI при загрузке страницы
  });
     updateCartCount()
  });
