    function openPopup() {
      document.getElementById('overlay').classList.remove('hidden');
    }

    function closePopup() {
      document.getElementById('overlay').classList.add('hidden');
    }

    document.querySelectorAll('.card, .card-wide').forEach(card => {
    card.addEventListener('click', function () {
        const itemId = this.getAttribute('data-id');
        const item = itemsData.find(i => i.id == itemId);

        if (item) {
          const popupHTML = `
          <section class="main-info">
            <button class="popup_close-button" onclick="closePopup()">
              <img src="/img/cross.png" alt="Закрыть">
            </button>
            <div class="img-container">
            <img src="${item.image}" alt="" />
          </div>
          <div class="info">
            <h1>
              ${item.name}
            </h1>
            <p>
              ${item.description}
            </p>
            <div class="info-buttons">
              <button class="green-button add-to-cart-btn" data-product-id="${item.id}">
                ${item.price} ₽
              </button>
              <div class="counterContainer counter" style="display: none;" data-product-id="${item.id}">
                <button class="minus">-</button>
                <div class="number">1</div>
                <button class="plus">+</button>
              </div>

              <a href="/favorite" class="green-button-img"><img src="svg/star.svg" alt="" /></a>
              <p style="margin-top: 10px; margin-left: 20px;">${item.weight} гр.</p>
            </div>
            <p>Состав: <br>
              ${item.compound} <br>
              Энергетическая ценность на 100 гр: ${item.kkal} Ккал <br>
              Основные питательные вещества:<br>
              белки ${item.protein}, жиры ${item.fat}, углеводы ${item.carbo}
            </p>
          </div>              
            </div>
          </section>`;

          document.getElementById('popup-content').innerHTML = popupHTML;

          openPopup();
        }
      });
    });

     document.getElementById('overlay').addEventListener('click', function(event) {
    if (event.target === this) {
      closePopup();
    }
  });
