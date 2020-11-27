require('./bootstrap');
import buildQueryString from './buildQueryString/buildQueryString';
import sendRequest from './service/api';
let cards;


const clearDom = (element) => {
  element.html('');
}

const submitForm = (e) => {
  e.preventDefault();
  const filters = getSelectedfilters();
  const query = buildQueryString(filters);

  sendRequest(query).then((data)=> {

    appendToDOM(data.data);
  }).catch(e=>{
    console.log(e);
  });
}

const appendToDOM = (cards) => {
  const cardList = $('#cards');
  cardList.empty();
  (function myLoop(i) {
    setTimeout(function() {
      cardList.append(createCardDiv(cards[i]));
      if (++i !== cards.length-1) myLoop(i);
    }, 100)
  })(0);
}

const createCardDiv = (card) =>{
  return `<div class="magic-card">
            <div class="magic-card-inner">
              <div class="magic-card-back">
                <img src="${card.image_url}" alt="${card.name} card">
              </div>
              <div class="magic-card-front">
                <img src="/img/mtg-back-sm.jpg" alt="card back">
              </div>
            </div>
          </div>`
}

document.onreadystatechange = function () {
   if (document.readyState == "complete") {
     const submitBtn = document.getElementById('submit');

     colors.forEach((color) => {
       const colorCheckbox = document.getElementById(color.name);
     });

     submitBtn.addEventListener("click", submitForm);

     $('.ui.dropdown').dropdown({
       clearable: true,
       forceSelection: false
     });
     $('.open-btn').on('click',()=>{
       $('.open-btn').toggleClass('open');
       $('.sidebar').toggleClass('open');
     })
     $('body').addClass('active');
  }
}


const findChecked = (tag) => {
  const checked = [...document.querySelectorAll(`input[name="${tag}"]`)]
  .filter((input) => {
    return input.checked;
  });
  return checked;
}

const findSelectedDropdown = (dropdown) =>{
  return $(dropdown).find('.selected.active').data('value');
}

const getSelectedfilters = () => {
  const filters = {};
  filters['searchCondition'] = findChecked('conditional')[0].value;
  filters['colors'] = findChecked('colors').map((input) => input.value);
  filters['type'] = findSelectedDropdown('#types');
  filters['supertype'] = findSelectedDropdown('#supertypes');
  filters['subtype'] = findSelectedDropdown('#subtypes');
  filters['rarity'] = findSelectedDropdown('#rarity');
  return filters;
}

