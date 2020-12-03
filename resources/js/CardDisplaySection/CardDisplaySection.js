import sendRequest from '../service/api';
import buildDOMCard from '../helper/buildDOMCard';
import buildDOMCardInfo from '../helper/buildDOMCardInfo';
import DisplayColors from './DisplayColors';

class CardDisplaySection {
  constructor(card = null){
    this.flipcard = card ? card.flipcard : null;
    this.card = card;
    this.display = $('.fixed-card-display');
    this.cardBack = this.display.find('.magic-card-front > img');
    this.cardFace = this.display.find('.magic-card-back > img');
  }

  addCard(card){
    if(this.card && card.id == this.card.id) return;
    // remove old Back to replace possible Flip cards
    this.removeImg(this.cardBack);
    this.removeImg(this.cardFace);
    this.shrinkCardText();
    this.display.css({background: DisplayColors.getDisplayColors(card.colors)})
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
    this.display.find('#card-info').first().addClass('open');
  }

  shrinkCardText(){
    this.display.find('#card-info').first().removeClass('open');
  }

  reset(){
    this.shrinkCardText();
    this.removeImg(this.cardBack);
    this.removeImg(this.cardFace);
    this.display.find('.magic-card').removeClass('flip');
    this.display.css({background: DisplayColors.getDisplayColors(['reset'])})
  }

  open(){
    this.display.toggleClass('open');
  }
}

export default CardDisplaySection;