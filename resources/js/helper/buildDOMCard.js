const createDOMCard = (card) =>{

  const renderCardFront = () => {
    let frontCardImage = `<img class="${!card.imageUrl ? "missing" : ""}"src="${card.imageUrl || '/img/mtg-back-sm.jpg'}" alt="${card.name} card">`;
    if(!card.imageUrl){
      frontCardImage += `<div class="missing-card"><p>${card.name}</p><p>Missing Image</p></div>`
    }
    return frontCardImage;
  }
  return `<div class="magic-card" data-card-info=${encodeURIComponent(JSON.stringify(card))} key="${card.id}">
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