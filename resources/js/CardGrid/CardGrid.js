import sendRequest from '../service/api';

export default class CardGrid{
  constructor(queryBuilder){
    this.cards = [];
    this.ready = true;
    this.grid = $('#cards');
    this.grid.on('click', '.magic-card img', (e) => {
      console.log(JSON.parse(decodeURIComponent($(e.target).data('cardInfo'))));
    });
    this.wrap = $('.card-wrap');
    this.queryBuilder = queryBuilder;
    this.wrap.on('scroll', (e) => {
      const screenPos = e.target.scrollHeight - (e.target.scrollTop + e.target.offsetHeight);
      if(screenPos < 600 && queryBuilder.getCurrPage() < queryBuilder.getLastPage() && this.ready){
        queryBuilder.nextPage();
        this.ready = false;
        this.getCards();
        setTimeout(() => {this.ready = true}, 2000);
      }
    });
  }

  append(cards){
    //
    for(const card of cards){
      this.grid.append(createDOMCard(card));
    }
    this.animate(cards.length);
  }

  animate(num){
    let self = this;
    (function myLoop(i) {
      setTimeout(function() {
        console.log()
        self.wrap.find('.magic-card').not('.here').first().addClass('here');
        if (++i < num) myLoop(i);
      }, 100)
    })(0);
  }

  getCards(){
    sendRequest(this.queryBuilder.currentQuery()).then((res)=> {
        this.queryBuilder.setLastPage(res.data.lastPage);
        console.log(res.data.cards);
        this.append(res.data.cards);
    }).catch((e)=>{
      console.log(e);
    });
  }
}

const createDOMCard = (card) =>{

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