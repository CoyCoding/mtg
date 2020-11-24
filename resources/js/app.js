require('./bootstrap');

const form = {
  colors: {
    white: false,
    black: false,
    blue: false,
    red: false,
    green: false,
  },
}

const sendRequest = () => {
  return axios.get('http://localhost:8000/api/get')
  .then(res => {
    console.log(res.data);
    appendToDOM(res.data);
  }).catch(e => {
    console.log(e);
  });
}

const checkBoxClicked = (e) => {
  const selection = e.target.name;
  form.colors[selection] = !form.colors[selection];
  console.log(form.colors[selection]);
}

const submitForm = (e) => {
  e.preventDefault();
  sendRequest();
}

const appendToDOM = (cards) => {
  const cardList = document.getElementById('cards');
  cards.map(card => {
    cardList.appendChild(createCardDiv(card));
  });
}

const createCardDiv = (card) =>{
  const div = document.createElement('div');
  div.textContent = JSON.stringify(card);
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

