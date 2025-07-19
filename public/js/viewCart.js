document.addEventListener("DOMContentLoaded", function () {
  if (Array.isArray(cartData)) {
    console.log("cartData is an array:", cartData);
  } else {
    console.error("cartData is not an array", cartData);
  }

  // Функция для получения данных корзины из локального хранилища
  function loadCartFromLocalStorage() {
    const savedCart = JSON.parse(localStorage.getItem("cart")) || {}; // Используем 'cart' вместо 'cartItems'
    console.log("Данные корзины из локального хранилища:", savedCart);
    return savedCart;
  }

  // Функция для сохранения данных корзины в локальное хранилище
  function saveCartToLocalStorage(cartItems) {
    localStorage.setItem("cart", JSON.stringify(cartItems)); // Сохраняем как 'cart'
    console.log("Данные корзины сохранены в локальное хранилище:", cartItems);
  }

  // Получаем корзину из локального хранилища
  const cartItems = loadCartFromLocalStorage();

  // Функция для отображения товаров в корзине
  function renderCart() {
    const cartContainer = document.querySelector("#cart-container");
    cartContainer.innerHTML = ""; // Очистить корзину перед рендером

    let totalPrice = 0; // Переменная для общей цены

    // Проходим по каждому товару в корзине
    Object.keys(cartItems).forEach((productId) => {
      const product = cartData.find((item) => item.id == productId); // Находим товар по id
      if (product) {
        const quantity = cartItems[productId]; // Количество товара
        totalPrice += product.price * quantity; // Добавляем цену товара в общую цену

        const cartPosition = document.createElement("div");
        cartPosition.classList.add("cart-position");

        cartPosition.innerHTML = `
          <div class="img-container">
          <img src="${product.image_path}" alt="${product.name}" />
          </div>
          <div class="cart-position-text">
            <h2>${product.name}</h2>
            <p>${product.card_description}</p>
            <p>${product.description}</p>
            <p>${product.price} ₽</p>
            <p>${quantity} шт</p>
          </div>
          <div class="cart-position-price">
            <img class="delete-item" src="svg/delete.svg" alt="Delete" />

            <p>${product.price * quantity} ₽</p>
            <div class="counter">
              <button class="minus" data-product-id="${productId}">-</button>
              <div class="number">${quantity}</div>
              <button class="plus" data-product-id="${productId}">+</button>
            </div>
          </div>
        `;
        cartContainer.appendChild(cartPosition);
      }
    });

    // Обновляем общую цену в корзине
    const totalPriceElement = document.querySelector("#total-price");
    if (totalPriceElement) {
      totalPriceElement.innerHTML = `К оформлению <br>${totalPrice} ₽`;
    }

    // После рендера корзины, сохраняем изменения в локальном хранилище
    saveCartToLocalStorage(cartItems);
    addEventListeners();
  }

  // Функция для добавления слушателей событий
  function addEventListeners() {
    const minusButtons = document.querySelectorAll(".minus");
    const plusButtons = document.querySelectorAll(".plus");
    const deleteButtons = document.querySelectorAll(".delete-item");

    minusButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const productId = this.getAttribute("data-product-id");
        if (cartItems[productId] > 1) {
          cartItems[productId]--;
        } else {
          delete cartItems[productId]; // Удаляем товар, если количество стало 0
        }
        renderCart(); // Перерисовать корзину
      });
    });

    plusButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const productId = this.getAttribute("data-product-id");
        cartItems[productId] = (cartItems[productId] || 0) + 1;
        renderCart(); // Перерисовать корзину
      });
    });

    deleteButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const productId = this.closest(".cart-position")
          .querySelector(".plus")
          .getAttribute("data-product-id");
        delete cartItems[productId]; // Удалить товар из корзины
        renderCart(); // Перерисовать корзину
      });
    });
  }

  // Инициализация корзины при загрузке страницы
  renderCart();
});
