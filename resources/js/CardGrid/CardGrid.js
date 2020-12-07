import sendRequest from '../service/api';
import buildDOMCard from '../helper/buildDOMCard';

export default class CardGrid{
  constructor(queryBuilder, cardDisplaySection){
    this.cards = [];
    this.ready = true;
    this.cardDisplaySection = cardDisplaySection;
    this.queryBuilder = queryBuilder;
    this.grid = $('#cards');
    this.grid.on('click', '.magic-card-back', (e) => {
      const cardInfo = $(e.target).closest('.magic-card').data('cardInfo');
      console.log(cardInfo)
      this.cardDisplaySection.addCard(JSON.parse(decodeURIComponent(cardInfo)));
      this.cardDisplaySection.open();
    });
    this.wrap = $('.card-wrap');
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
      this.grid.append(buildDOMCard(card));
    }
    this.animate(cards.length);
  }

  animate(num){
    let self = this;
    (function myLoop(i) {
      setTimeout(function() {
        self.wrap.find('.magic-card').not('.here').first().addClass('here');
        if (++i < num) myLoop(i);
      }, 100)
    })(0);
  }

  getCards(){
    sendRequest(this.queryBuilder.currentQuery()).then((res)=> {
        this.queryBuilder.setLastPage(res.data.lastPage);
        this.append(res.data.cards);
    }).catch((e)=>{
      console.log(e);
    });
  }
}