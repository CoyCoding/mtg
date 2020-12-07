const createDOMCardInfo = (card) =>{
  const renderPowerTough = () => {
    if(card.power && card.toughness){
      return `<div class="power"><p>${card.power}/${card.toughness}</p></div>`
    }
    return '';
  }
  return `<div class="card-info-wrap">
      <h2>${card.name}</h2>
      <h3>${card.typeText}</h3>
      ${card.text ? `<p>${card.text}</p>` : ''}
      ${renderPowerTough()}
    </div>`
}

export default createDOMCardInfo;