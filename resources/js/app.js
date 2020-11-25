require('./bootstrap');
import queryStringBuilder from './queryBuilder/queryStringBuilder';

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

const submitForm = (e) => {
  e.preventDefault();
  const queries = {};
  const searchCondition = findChecked('conditional')[0].value;
  const colors = findChecked('colors').map((input) => input.value);

  if(searchCondition){
    queries['searchCondition'] = searchCondition;
  }

  if(colors.length){
    queries['colors'] = colors;
  }

  const query = queryStringBuilder(queries);
  sendRequest(query);
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
     const w = document.getElementById('white');
     const b = document.getElementById('black');
     const r = document.getElementById('red');
     const g = document.getElementById('green');
     const u = document.getElementById('blue');


     submitBtn.addEventListener("click", submitForm);
     w.addEventListener("click", checkBoxClicked);
     b.addEventListener("click", checkBoxClicked);
     r.addEventListener("click", checkBoxClicked);
     g.addEventListener("click", checkBoxClicked);
     u.addEventListener("click", checkBoxClicked);

  }
}

