let menu = document.querySelector('#menu-btn');    //biến dùng thẻ div 
let navbar = document.querySelector('.header .navbar'); // dùng dùng menu navbar

menu.onclick = () => {
    // nhấn vào thẻ (có id='menu-btn') thì chuyển sang class khác
    // active thì dùng hiện hay ẩn
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
};

window.onscroll = () => {
    //sự kiện khi cuộn trang
    //loại bỏ các class khi cuộn -> ẩn thanh điều hương
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
};

// swiper

var swiper = new Swiper(".reviews-slider", {
  grabCursor:true,
  loop:true,
  autoHeight:true,
  spaceBetween: 20,
  breakpoints: {
     0: {
       slidesPerView: 1,
     },
     700: {
       slidesPerView: 2,
     },
     1000: {
       slidesPerView: 3,
     },
  },
});

let loadMoreBtn = document.querySelector('.packages .load-more .btn');
let currentItem = 3;

loadMoreBtn.onclick = () =>{
  let boxes = [...document.querySelectorAll('.packages .box-container .box')];
  for (var i = currentItem; i < currentItem + 3; i++){
     boxes[i].style.display = 'inline-block';
  };
  currentItem += 3;
  if(currentItem >= boxes.length){
     loadMoreBtn.style.display = 'none';
  }
}