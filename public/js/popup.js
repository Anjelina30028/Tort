document.addEventListener("DOMContentLoaded", () => {
  const openButtons = document.querySelectorAll(".open-popup");
  const closeButtons = document.querySelectorAll(".close-popup");
  const orderButtons = document.querySelectorAll(".order-popup");

  // Открытие попапа
  openButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      const popupId = e.target.getAttribute("data-target");
      const popup = document.getElementById(popupId);
      popup.style.display = "flex";

      const order = document.getElementById('order') 
      
      console.log(localStorage.getItem("cart").split(',')) 
      order.value = localStorage.getItem("cart")

      // Создание и отображение затемняющего фона
      const overlay = document.createElement("div");
      overlay.classList.add("popup__overlay");
      document.body.appendChild(overlay);

      // Закрытие попапа при клике на затемнение
      overlay.addEventListener("click", () => {
        popup.style.display = "none";
        overlay.remove();
      });
    });
  });

  // Закрытие попапа
  closeButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const popup = button.closest(".tip__popup");
      popup.style.display = "none";
      const overlay = document.querySelector(".popup__overlay");
      if (overlay) overlay.remove();
    });
  });
});
