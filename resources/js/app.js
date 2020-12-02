require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import CardForm from './CardForm/CardForm';
import CardGrid from './CardGrid/CardGrid';
import CardDisplaySection from './CardDisplaySection/CardDisplaySection';



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
  const cardDisplaySection = new CardDisplaySection();
  const cardGrid = new CardGrid(queryBuilder, cardDisplaySection);
  const cardForm = new CardForm(queryBuilder, cardGrid);

  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('body').addClass('active');
});

const setDisplayCard = (e) => {

}
