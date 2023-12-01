let tattoosBtn = document.querySelector('.dropbtn');
let dropContainer = document.querySelector('.dropdown-content');

//------------- Dropdown imagens-------------

if (tattoosBtn) {
  tattoosBtn.onclick = function () {
    dropContainer.classList.toggle('show');
  }
  window.addEventListener('click', function(e){   
    if (tattoosBtn.contains(e.target)){
      // Clicked in box
    } else{
      dropContainer.classList.remove('show');
    }
  });
}


//------------- Faz aparecer o butão up-------------
const upBtn = document.querySelector('.up')
if (upBtn) {
  window.onscroll = function () {
    let y = window.pageYOffset;
    if (y >= 800) {
      upBtn.classList.add('apear');
    } else {
      upBtn.classList.remove('apear');
    }
  }
}

