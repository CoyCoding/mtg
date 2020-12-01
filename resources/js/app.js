require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import CardForm from './CardForm/CardForm';
import CardGrid from './CardGrid/CardGrid';




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

$(document).ready(()=> {
  let queryBuilder = new PagedQueryString();
  const cardGrid = new CardGrid(queryBuilder);
  const cardForm = new CardForm(queryBuilder, cardGrid);
  let infiniteLoadReady = true;
  let selectedCard = null;

  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('body').addClass('active');
});

const setDisplayCard = (e) => {

}
