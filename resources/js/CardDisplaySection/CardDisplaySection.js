import sendRequest from '../service/api';
import buildDOMCard from '../helper/buildDOMCard';
import buildDOMCardInfo from '../helper/buildDOMCardInfo';

class CardDisplaySection {
  constructor(card){
    this.flipcard = card ? card.flipcard : null;
    this.card = this.card;
    this.display = $('.fixed-card-display');
    this.cardBack = this.display.find('.magic-card-front > img');
    this.cardFace = this.display.find('.magic-card-back > img');
    this.background = null;
  }

  addCard(card){
    // remove old Back to replace possible Flip cards
    this.removeImg(this.cardBack);
    this.shrinkCardText();
    // reflip card over
    this.display.find('.magic-card').removeClass('flip');

    // set front card image or no image

    //if there is already a card timeout for animations
    if(this.card){
      setTimeout(() => {
        this.appendNewImages(card);
        this.display.find('.magic-card').addClass('flip');
        this.replaceCardText(card);
      }, 500)
    } else {
      this.appendNewImages(card);
      this.display.find('.magic-card').addClass('flip');
      this.replaceCardText(card);
    }

    this.card = card;
  }

  removeImg(ele){
    return ele.attr("src",`/img/mtg-back-sm.jpg`);
  }

  appendNewImages(card){
    if(!card.image_url){
      this.removeImg(this.cardFace).addClass('no-image');
    } else {
      this.cardFace.attr("src",`${card.image_url}`).removeClass('no-image');
    }
  }

  replaceCardText(card){
    this.display.find('#card-info').empty();
    this.display.find('#card-info').first().append(buildDOMCardInfo(card));
    this.display.find('#card-info').first().css({"height": "100%", "opacity": "1"});;
  }

  shrinkCardText(){
    this.display.find('#card-info').first().css({"height": "0px", "opacity": "0"});
  }
}

export default CardDisplaySection;