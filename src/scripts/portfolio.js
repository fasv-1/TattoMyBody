let elPerfil = document.querySelector('#perfil-cont');
let elImgCont = document.querySelector('#img-cont');
let elNewsCont = document.querySelector('#news-cont');
let elContactCont = document.querySelector('#contacts-cont');
let tp = document.querySelector('.tattooer-perfil');
let ti = document.querySelector('.tattooer-images');
let tn = document.querySelector('.tattooer-news');
let tc = document.querySelector('.tattooer-contacts');

if (elPerfil) {
  elPerfil.onclick = function () {
    elPerfil.classList.add('selected');
    elImgCont.classList.remove('selected');
    elNewsCont.classList.remove('selected');
    elContactCont.classList.remove('selected');
    tp.classList.add('appear');
    ti.classList.remove('appear');
    tn.classList.remove('appear');
    tc.classList.remove('appear');
  }
}

if (elImgCont) {
  elImgCont.onclick = function () {
    elPerfil.classList.remove('selected');
    elImgCont.classList.add('selected');
    elNewsCont.classList.remove('selected');
    elContactCont.classList.remove('selected');
    tp.classList.remove('appear');
    ti.classList.add('appear');
    tn.classList.remove('appear');
    tc.classList.remove('appear');
  }
}
if (elNewsCont) {
  elNewsCont.onclick = function () {
    elPerfil.classList.remove('selected');
    elImgCont.classList.remove('selected');
    elNewsCont.classList.add('selected');
    elContactCont.classList.remove('selected');
    tp.classList.remove('appear');
    ti.classList.remove('appear');
    tn.classList.add('appear');
    tc.classList.remove('appear');
  }
}
if (elContactCont) {
  elContactCont.onclick = function () {
    elPerfil.classList.remove('selected');
    elImgCont.classList.remove('selected');
    elNewsCont.classList.remove('selected');
    elContactCont.classList.add('selected');
    tp.classList.remove('appear');
    ti.classList.remove('appear');
    tn.classList.remove('appear');
    tc.classList.add('appear');
  }
}
