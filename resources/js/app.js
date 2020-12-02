require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import CardForm from './CardForm/CardForm';
import CardGrid from './CardGrid/CardGrid';
import CardDisplaySection from './CardDisplaySection/CardDisplaySection';

$(document).ready(()=> {
  let queryBuilder = new PagedQueryString();
  const cardDisplaySection = new CardDisplaySection();
  const cardGrid = new CardGrid(queryBuilder, cardDisplaySection);
  const cardForm = new CardForm(queryBuilder, cardGrid, cardDisplaySection);
  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('body').addClass('active');
});
