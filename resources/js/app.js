require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import getSelectedfilters from './form/form';

let queryString;
let cards;

const submitForm = (e) => {
  e.preventDefault();
  $('#cards').empty();
  const filters = getSelectedfilters();
  queryString = new PagedQueryString(filters, 1);
  $('.sidebar').toggleClass('open');
  getCards((page) => queryString.setLastPage(page));
}

const getCards = (setLastPage) => {
  sendRequest(queryString.currentQuery()).then((res)=> {
    if(setLastPage) setLastPage(res.data.lastPage);
    console.log(res);
    appendToDOM(res.data.cards);
  }).catch(e=>{
    console.log(e);
  });
}

const appendToDOM = (cards) => {
  const cardList = $('#cards');
  (function myLoop(i) {
    setTimeout(function() {
      cardList.append(createCardDiv(cards[i]));
      if (++i < cards.length) myLoop(i);
    }, 100)
  })(0);
}

const createCardDiv = (card) =>{
  const renderCardFront = () => {
    let frontCardImage = `<img data-card-info='${JSON.stringify(card)}' class="${!card.image_url ? "missing" : ""}"src="${card.image_url || '/img/mtg-back-sm.jpg'}" alt="${card.name} card">`;
    if(!card.image_url){
      frontCardImage += `<div class="missing-card"><p>${card.name}</p><p>Missing Image</p></div>`
    }
    return frontCardImage;
  }
  return `<div class="magic-card">
    <div class="magic-card-inner">
      <div class="magic-card-back">
        ${renderCardFront()}
      </div>
      <div class="magic-card-front">
        <img src="/img/mtg-back-sm.jpg" alt="card back">
      </div>
    </div>
  </div>`
}

$(document).ready(()=> {
  $('#submit').on('click', submitForm);

  $('.ui.dropdown').dropdown({
    clearable: true,
    forceSelection: false
  });

  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('body').addClass('active');

  let ready = true;

  $('.card-wrap').on('scroll', (e) => {
    const screenPos = e.target.scrollHeight - (e.target.scrollTop + e.target.offsetHeight);
    if(screenPos < 500 && queryString.getCurrPage() < queryString.getLastPage() && ready){
      queryString.nextPage();
      ready = false;
      getCards();
      setTimeout(() => {ready = true}, 1000);
    }
  });

  $('#cards').on('click', '.magic-card img', (e) => {
    console.log($(e.target).data('cardInfo'));
  })
})
