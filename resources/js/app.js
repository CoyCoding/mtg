require('./bootstrap');
import buildQueryString from './buildQueryString/buildQueryString';

const sendRequest = (query) => {
  return axios.get(`http://localhost:8000/api/get?${query}`)
  .then(res => {
    console.log(res);
    appendToDOM(res.data);
  }).catch(e => {
    console.log(e);
  });
}

const checkBoxClicked = (e) => {

}

const findChecked = (tag) => {
  const checked = [...document.querySelectorAll(`input[name="${tag}"]`)]
  .filter((input) => {
    return input.checked;
  });
  return checked;
}

const findSelectedDropdown = (dropdown) =>{
  return $(dropdown).find('.selected').data('value');
}



const submitForm = (e) => {
  e.preventDefault();
  const queries = {};
  queries['searchCondition'] = findChecked('conditional')[0].value;
  queries['colors'] = findChecked('colors').map((input) => input.value);
  queries['type'] = findSelectedDropdown('#types');
  queries['supertype'] = findSelectedDropdown('#supertypes');
  queries['subtype'] = findSelectedDropdown('#subtypes');
  queries['rarity'] = findSelectedDropdown('#rarities');
  console.log(findSelectedDropdown('#types'));
  const query = buildQueryString(queries);
  console.log(query);
  //sendRequest(query);
}

const appendToDOM = (cards) => {
  const cardList = document.getElementById('cards');
  cards.map(card => {
    cardList.appendChild(createCardDiv(card));
  });
}

const createCardDiv = (card) =>{
  const div = document.createElement('div');
  div.textContent = card.name;
  return div;
}

document.onreadystatechange = function () {
   if (document.readyState == "complete") {
     const submitBtn = document.getElementById('submit');

     colors.forEach((color) => {
       const colorCheckbox = document.getElementById(color.name);
       colorCheckbox.addEventListener("click", checkBoxClicked);
     });

     submitBtn.addEventListener("click", submitForm);

     $('.ui.dropdown').dropdown({
       clearable: true,
       forceSelection: false
     });

     $('body').addClass('active');
  }

}

