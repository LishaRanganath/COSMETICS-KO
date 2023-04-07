let menu=document.querySelector('#menu-btn');
let navbar=document.querySelector('.header .navbar');

menu.onclick= () =>{
  menu.classList.toggle('fas-times');
  navbar.classList.toggle('active');
}

window.onscroll = () =>{
  menu.classList.remove('fas-times');
  navbar.classList.remove('active');
}
let slide=document.querySelectorAll('.home .slide');
let index=0;

function next(){
  slide[index].classList.remove('active');
  index=(index+1)%slide.length;
  slide[index].classList.add('active');
}
function prev(){
  slide[index].classList.remove('active');
  index=(index-1+slide.length)%slide.length;
  slide[index].classList.add('active');
}
