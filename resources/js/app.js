require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import CardForm from './CardForm/CardForm';


const getCards = (queryBuilder, setLastPage) => {
  console.log(queryBuilder.currentQuery());
  sendRequest(queryBuilder.currentQuery()).then((res)=> {
    if(res.data.cards.length){
      appendToDOM(res.data.cards);
    } else {
      $('.card-display').append('<div id="no-cards">NO CARDS WERE FOUND</div>');
    }
  }).catch(e=>{
    console.log(e);
  });
}

const appendToDOM = (cards) => {
  const cardList = $('#cards');
  cards.forEach((card)=>{
    cardList.append(createCardDiv(card));
  });
  // (function myLoop(i) {
  //   setTimeout(function() {
  //     cardList.append(createCardDiv(cards[i]));
  //     if (++i < cards.length) myLoop(i);
  //   }, 100)
  // })(0);
}

const createCardDiv = (card) =>{

  const renderCardFront = () => {
    let frontCardImage = `<img data-card-info=${encodeURIComponent(JSON.stringify(card))} class="${!card.image_url ? "missing" : ""}"src="${card.image_url || '/img/mtg-back-sm.jpg'}" alt="${card.name} card">`;
    if(!card.image_url){
      frontCardImage += `<div class="missing-card"><p>${card.name}</p><p>Missing Image</p></div>`
    }
    return frontCardImage;
  }
  return `<div class="magic-card" key="${card.id}">
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
  let queryBuilder = new PagedQueryString();
  const cardForm = new CardForm(queryBuilder);
  let infiniteLoadReady = true;
  let selectedCard = null;

  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('.card-wrap').on('scroll', (e) => {
    const screenPos = e.target.scrollHeight - (e.target.scrollTop + e.target.offsetHeight);
    if(screenPos < 600 && queryBuilder.getCurrPage() < queryBuilder.getLastPage() && infiniteLoadReady){
      queryBuilder.nextPage();
      infiniteLoadReady = false;
      getCards(queryBuilder);
      setTimeout(() => {infiniteLoadReady = true}, 2000);
    }
  });

  $('#cards').on('click', '.magic-card img', (e) => {
    console.log(JSON.parse(decodeURIComponent($(e.target).data('cardInfo'))));
  });

  $('body').addClass('active');
});

const setDisplayCard = (e) => {

}
