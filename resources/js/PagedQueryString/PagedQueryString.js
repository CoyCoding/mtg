class PagedQueryString{
  constructor(filters, page){
    this.filters = buildQueryString(filters);
    this.currPage = page;
    this.lastPage = Infinity;
  }

  currentQuery(){
    return this.filters + '&page=' + this.currPage;
  }

  getLastPage(){
    return this.lastPage
  }

  getCurrPage(){
    return this.currPage;
  }

  setPage(page){
    this.currPage=page;
  }

  setLastPage(page){
    this.lastPage = page;
  }

  nextPage(){
    this.currPage++;
  }
}


const buildQueryString = (queryObj) =>{
  const esc = encodeURIComponent;
  return Object.keys(queryObj).filter((key) => {
    if(Array.isArray(queryObj[key])){
      return queryObj[key].length;
    }
    return queryObj[key];
  }).map((key) => {
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

export default PagedQueryString;