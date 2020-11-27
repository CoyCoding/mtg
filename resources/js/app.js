require('./bootstrap');
import buildQueryString from './buildQueryString/buildQueryString';
import sendRequest from './service/api';
import getSelectedfilters from './form/form';

let cards;
let currentQuery;
let currPage = 0;
let lastPage = Infinity;

const clearDom = (element) => {
  element.html('');
}

const submitForm = (e) => {
  e.preventDefault();
  $('#cards').empty();
  const filters = getSelectedfilters(currPage);
  currentQuery = buildQueryString(filters);
  if(filters['page'] === lastPage) return;

  sendRequest(currentQuery).then((res)=> {
    currPage = res.data.current_page;
    lastPage = res.data.last_page;
    appendToDOM(res.data.data);
  }).catch(e=>{
    console.log(e);
  });
}

const appendToDOM = (cards) => {
  const cardList = $('#cards');
  (function myLoop(i) {
    setTimeout(function() {
      cardList.append(createCardDiv(cards[i]));
      if (++i < cards.length-1) myLoop(i);
    }, 100)
  })(0);
}

const createCardDiv = (card) =>(
  `<div class="magic-card">
            <div class="magic-card-inner">
              <div class="magic-card-back">
                <img src="${card.image_url}" alt="${card.name} card">
              </div>
              <div class="magic-card-front">
                <img src="/img/mtg-back-sm.jpg" alt="card back">
              </div>
            </div>
          </div>`)

document.onreadystatechange = function () {
   if (document.readyState == "complete") {
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

     $('.card-wrap').on('scroll', (e) => {
       console.log(e.target.scrollTop, e.target.offsetHeight, e.target.scrollHeight, e.target.scrollTop + e.target.offsetHeight)
     });
  }
}