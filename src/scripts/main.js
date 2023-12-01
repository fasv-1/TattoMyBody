
let elHambutton = document.querySelector('.toggle svg');
let elNavMenu = document.querySelector('.nav-items ul');
let elNavBar = document.querySelector('#navbar');
let logo = document.querySelector('.users');

//abre e fecha o menu em modo mobile
function openMenu() {
  elNavMenu.classList.toggle('menuOpen');
  elHambutton.classList.toggle('closeMenu');
  logo.classList.toggle('menuOpen');
}

if (elHambutton) {
  elHambutton.onclick = function () {
    openMenu();

  };
}

//adiciona o efeito a navbar
if (elNavBar) {
  window.onscroll = function () {
    let y = window.pageYOffset;
    if (y >= 200) {
      elNavBar.classList.add('transp');
    } else {
      elNavBar.classList.remove('transp');
    }
  }
}
//################################################################
//--------------------------Slide-show---------------------------
//################################################################
const slides = document.querySelector('.slider');
const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
const dots = document.querySelector('.dots');

if (slides, dots, next, prev) {
  let index = 0;
  prev.onclick = function () {
    prevSlide();
    changeDot();
    resertTimer();
  }


  next.onclick = function () {
    nextSlide();
    changeDot();
    resertTimer();
  }


  //--create controll dots--

  function dotactive() {
    for (let i = 0; i < slides.children.length; i++) {
      const div = document.createElement('div');
      div.setAttribute('onclick', 'indicateSlide(this)');
      div.id = i;
      if (i == 0) {
        div.className = 'active';
      }
      dots.appendChild(div);
    }
  }
  dotactive();


  //--change site by clicking the dots
  function indicateSlide(element) {
    index = element.id;
    changeSlide();
    changeDot();
    resertTimer();
  }


  function changeDot() {
    for (let i = 0; i < dots.children.length; i++) {
      dots.children[i].classList.remove('active');
    }
    dots.children[index].classList.add('active');
  }


  //--prev slide--
  function prevSlide() {
    if (index == 0) {
      index == slides.children.length - 1;
    } else {
      index--;
    }
    changeSlide();
  }

  //--next slide--
  function nextSlide() {
    if (index == slides.children.length - 1) {
      index = 0
    } else {
      index++;
    }
    changeSlide();
  }

  //--change slide--

  function changeSlide() {
    for (let i = 0; i < slides.children.length; i++) {
      slides.children[i].classList.remove('active')
    }
    slides.children[index].classList.add('active');
  }


  //--reset the time when its clicked each button
  function resertTimer() {
    clearInterval(timer);
    timer = setInterval(autoPlay, 5000);
  }

  //sets autoplay with the set interval 
  function autoPlay() {
    nextSlide();
    changeDot();
  }

  let timer = setInterval(autoPlay, 5000);
}

//################################################################
//--------------------------cartões dos tatuadores----------------
//################################################################

const tattooerCard = document.querySelector('.tattooercard');

if (tattooerCard) {
  tattooerCard.onclick = function () {
    tattooerCard.classList.toggle('expanded');
  }
};


//------------------- Api que envia o nome dos países ---------------------

let countrySelect = document.querySelector('#country');

let baseApi = 'https://restcountries.eu/rest/v2/all';

let urlApi = baseApi;
let optionsApi = {
  method: 'GET',
};

//------------- Faz o fetch do conteudo e cria os elementos dinamicamente-------------

if (countrySelect) {
  fetch(urlApi, optionsApi)
    .then(response => response.json())
    .then(json => newcity(json));

  function newcity(data) {
    var ordered = [];
    data.forEach(function (item) {
      ordered.push(item.name);
    });
    ordered.forEach(function (item) {
      let html = '<option value="' + item + '">' + item + '</option>';
      countrySelect.innerHTML += html;
    });
  }
}

//------------------- Seleciona apenas uma escolha ---------------------
let checkTattoo = document.querySelector('#chektatuador');
let checkUtil = document.querySelector('#chekutilizador');

if (checkTattoo & checkUtil) {
  checkTattoo.onchange = function () {
    checkUtil.checked = true;
  }
  checkUtil.onchange = function () {
    checkTattoo.checked = false;
  }
}

