let menu = document.querySelector('#menu-btn');
let navbar = document.querySelector('.header .navbar');

// Toggle the menu icon and navbar visibility with animation
menu.onclick = () => {
   menu.classList.toggle('fa-times');
   navbar.classList.toggle('active');

   // Animation for menu button rotation
   menu.style.transition = 'transform 0.3s ease';
   if (menu.classList.contains('fa-times')) {
      menu.style.transform = 'rotate(90deg)';
   } else {
      menu.style.transform = 'rotate(0deg)';
   }

   // Navbar slide-in effect
   navbar.style.transition = 'transform 0.5s ease';
   navbar.style.transform = navbar.classList.contains('active') ? 'translateX(0)' : 'translateX(-100%)';
};

// Reset menu icon and navbar on scroll with smooth hide
window.onscroll = () => {
   menu.classList.remove('fa-times');
   navbar.classList.remove('active');
   menu.style.transform = 'rotate(0deg)';
   navbar.style.transform = 'translateX(-100%)';
};

// Swiper for the home slider with a fade effect
var homeSwiper = new Swiper(".home-slider", {
   loop: true,
   effect: "fade",
   fadeEffect: { crossFade: true },
   navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
   },
   autoplay: {
      delay: 3000,
      disableOnInteraction: false,
   }
});

// Swiper for reviews with dynamic breakpoints and auto-height
var reviewsSwiper = new Swiper(".reviews-slider", {
   grabCursor: true,
   loop: true,
   autoHeight: true,
   spaceBetween: 20,
   breakpoints: {
      0: { slidesPerView: 1 },
      700: { slidesPerView: 2 },
      1000: { slidesPerView: 3 },
   },
   pagination: {
      el: ".swiper-pagination",
      clickable: true,
   }
});

// Load More button with smooth show/hide transition for boxes
let loadMoreBtn = document.querySelector('.packages .load-more .btn');
let currentItem = 3;

loadMoreBtn.onclick = () => {
   let boxes = [...document.querySelectorAll('.packages .box-container .box')];
   
   for (let i = currentItem; i < currentItem + 3; i++) {
      if (boxes[i]) {
         boxes[i].style.display = 'inline-block';
         boxes[i].style.opacity = '0';
         boxes[i].style.transition = 'opacity 0.5s ease';
         setTimeout(() => {
            boxes[i].style.opacity = '1';
         }, 50);
      }
   }

   currentItem += 3;

   // Hide load more button when all items are displayed
   if (currentItem >= boxes.length) {
      loadMoreBtn.style.transition = 'opacity 0.5s ease';
      loadMoreBtn.style.opacity = '0';
      setTimeout(() => {
         loadMoreBtn.style.display = 'none';
      }, 500);
   }
};
