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

export default createDOMCard;