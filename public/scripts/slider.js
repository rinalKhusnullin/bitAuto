var swiper = new Swiper(".swiper", {
    spaceBetween: 5,
    loop: true,

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    pagination: {
      el: ".swiper-pagination",
    },
      
    mousewheel: false,
    keyboard: true,
})