require('./bootstrap');
import PagedQueryString from './PagedQueryString/PagedQueryString';
import sendRequest from './service/api';
import getSelectedfilters from './form/form';

const getCards = (queryBuilder, setLastPage) => {
  sendRequest(queryBuilder.currentQuery()).then((res)=> {
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
  let infiniteLoadReady = true;
  let selectedCard = null;
  $('#submit').on('click', {queryBuilder}, submitForm);

  $('.ui.dropdown').dropdown({
    clearable: true,
    forceSelection: false
  });

  $('.open-btn').on('click',()=>{
    $('.open-btn').toggleClass('open');
    $('.sidebar').toggleClass('open');
  })

  $('body').addClass('active');

  $('.color-wrap').click(() =>{
    $(event.currentTarget).prop('selected',true)
    $(event.currentTarget).toggleClass('active');
  });

  $('.radio').click(() =>{
    $('.radio-wrap.active').toggleClass('active');
    $(event.currentTarget).closest('.radio-wrap').toggleClass('active');
  });

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
    setDisplayCard($(e.target).data('cardInfo'));
  });

  $('.ui.search.name')
    .search({
      apiSettings: {
        url: 'api/byname?name={query}',
        type: 'customType'
      },
      onResultsAdd: function(res){
        return $(res).each((i,ele) => $(ele).append('test'));
      },
      fields: {
        results: 'items',
        title: 'name',
        image: 'img',
        url: 'html_url'
      },
      minCharacters: 3
  });
});

const submitForm = (e) => {
  e.preventDefault();
  // empty previous displayed cards
  $('#cards').empty();

  // get query string
  const filters = getSelectedfilters();
  console.log(e.data)
  const queryBuilder = e.data.queryBuilder;
  queryBuilder.buildQuery(filters);

  //close sidebar
  $('.sidebar').toggleClass('open');

  //api call for new list
  getCards(queryBuilder, (page) => queryBuilder.setLastPage(page));
}

const setDisplayCard = (e) => {

}
