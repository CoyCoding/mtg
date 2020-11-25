const queryStringBuilder = (queryObj) =>{
  const esc = encodeURIComponent;
  return Object.keys(queryObj)
    .map((key) => {
      if(Array.isArray(queryObj[key])){
        console.log(queryObj[key])
        let arrayQs = '';
        for(var i = 0; i < queryObj[key].length; i++){
          if(i+1 === queryObj[key].length) {
            arrayQs += `${key}[]=${queryObj[key][i]}`;
          }else{
            arrayQs += `${key}[]=${queryObj[key][i]}&`;
          }
        }
        return arrayQs;
      } else {
        return esc(key) + '=' + esc(queryObj[key]);
      }
    }).join('&');
}

export default queryStringBuilder;