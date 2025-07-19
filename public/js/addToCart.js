document.addEventListener("DOMContentLoaded", () => {
  // Функция для обновления данных в локальном хранилище и вывода в консоль
  function updateLocalStorage(productId, quantity) {
    let cart = JSON.parse(localStorage.getItem("cart")) || {};

    if (quantity > 0) {
      cart[productId] = quantity;
    } else {
      delete cart[productId];
    }

    localStorage.setItem("cart", JSON.stringify(cart));
    console.log("Текущая корзина:", cart);
  }

  // Функция для отображения или скрытия счетчика
  function toggleCounter(counter, show) {
    counter.style.display = show ? "flex" : "none";
  }

  // Добавление обработчика на кнопки "Добавить в корзину"
  document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
    button.addEventListener("click", () => {
      const productId = button.getAttribute("data-product-id");
      const counterContainer = document.querySelector(`.counter[data-product-id="${productId}"]`);

      // Установка начального количества
      let quantity = 1;
      toggleCounter(counterContainer, true);
      counterContainer.querySelector(".number").textContent = quantity;

      // Обновляем локальное хранилище
      updateLocalStorage(productId, quantity);
      console.log(`Товар с ID ${productId} добавлен в корзину с количеством ${quantity}`);
    });
  });

  // Добавление обработчиков на кнопки "+" и "-" для изменения количества товара
  document.querySelectorAll(".counter").forEach((counter) => {
    const productId = counter.getAttribute("data-product-id");
    const numberElement = counter.querySelector(".number");
    let quantity = parseInt(numberElement.textContent);

    counter.querySelector(".plus").addEventListener("click", () => {
      quantity += 1;
      numberElement.textContent = quantity;
      updateLocalStorage(productId, quantity);
      console.log(`Количество товара с ID ${productId} увеличено до ${quantity}`);
    });

    counter.querySelector(".minus").addEventListener("click", () => {
      if (quantity > 1) {
        quantity -= 1;
        numberElement.textContent = quantity;
        updateLocalStorage(productId, quantity);
        console.log(`Количество товара с ID ${productId} уменьшено до ${quantity}`);
      } else {
        quantity = 0;
        toggleCounter(counter, false);
        updateLocalStorage(productId, quantity);
        console.log(`Товар с ID ${productId} удален из корзины`);
      }
    });
  });
});

console.log('loaded');