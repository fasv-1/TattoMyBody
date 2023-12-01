// ------------- Noticias Api-------------
let placeNews = document.querySelector('#noticias');

// let base = 'http://tattoomybody.pt/app/api/news_api.php';
let base = 'http://192.168.1.94:8080//app/api/news_api.php';


let url = base;
let options = {
  method: 'GET',
};

//------------- Faz o fetch do conteudo e cria os elementos dinamicamente-------------

if (placeNews) {
  fetch(url, options)
    .then(response => response.json())
    .then(json => newNoticias(json.news));

  function newNoticias(item) {
    for (let j = 0; j < 6; j++) {
      const element = document.createElement('div');
      element.classList = 'news';
      element.innerHTML += '<div class="titulo"><a href="news.php?token=' + item[j].token_news + '"><h2>' + item[j].title + '</h2></a></div><div class="imagem"><img src="/app/tattooers/news_images/' + item[j].image + '" alt="noticia"></div><a href="news.php?token=' + item[j].token_news + '"><div class="corpo"><p>' + item[j].date + '</p><br><p>' + item[j].body + '</p></div></a>';
      placeNews.append(element)
    }
  }
}
