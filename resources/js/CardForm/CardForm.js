import sendRequest from '../service/api';

class CardForm {
  constructor(queryBuilder, cardGrid, cardDisplaySection){
    this.queryBuilder = queryBuilder;
    this.colors = $('.color-wrap');
    this.colors.click(() =>{
        $(event.currentTarget).prop('selected', true)
        $(event.currentTarget).toggleClass('active');
    });
    this.radio =  $('.radio')
    this.radio.click(() =>{
        $('.radio-wrap.active').toggleClass('active');
        $(event.currentTarget).closest('.radio-wrap').toggleClass('active');
    });
    this.dropdowns = $('.ui.dropdown').dropdown({
      clearable: true,
      forceSelection: false
    });
    this.nameSearch =  $('.ui.search.name').search({
          apiSettings: {
            url: 'api/byname?name={query}',
            type: 'customType'
          },
          onResultsAdd: function(res){
            return $(res).each((i,ele) => $(ele).append('test'));
          },
          fields: {
            results: 'items',
            title: 'name',
            image: 'img',
            url: 'html_url'
          },
          minCharacters: 3
    });
    this.submitBtn = $('#submit')
    this.submitBtn.on('click', (e) => {this.submit(e)});
    this.cardGrid = cardGrid;
    this.cardDisplaySection = cardDisplaySection;
  }

  getQueryBuilder(){
    return this.queryBuilder;
  }

  getCardName(){
    return $('#name-input').val().trim()
  }

  getConditional(){
    return $('.radio-wrap.active').attr('value');
  }

  getColors(){
    const colors = [];
    this.colors.each((i, ele) => {
      if($(ele).hasClass('active')) colors.push($(ele).attr('value'));
    });
    return colors;
  }

  getDropdownValueOf(dropdown){
    return $(dropdown).find('.selected.active').data('value');
  }

  getSelectedfilters(currPage){
    const filters = {};

    filters['name'] = this.getCardName();
    filters['searchCondition'] = this.getConditional();
    filters['colors'] = this.getColors();
    filters['type'] = this.getDropdownValueOf('#types');
    filters['supertype'] = this.getDropdownValueOf('#supertypes');
    filters['subtype'] = this.getDropdownValueOf('#subtypes');
    filters['rarity'] = this.getDropdownValueOf('#rarity');
    return filters;
  }

  submit(e){
    e.preventDefault();
    //clear current errors close results and check for errors
    $('p').remove('.error');
    $('.ui.search.name').search('hide results');
    if(!this.getColors().length){
      return $('#name-search').after('<p class="error">* You sould select at least one color *</p>');
    }

    // get create query string
    this.queryBuilder.buildQuery(this.getSelectedfilters(), 1);

    // empty previous displayed cards
    $('#cards').empty();
    console.log(this.cardDisplaySection.cardFace)
    this.cardDisplaySection.reset();

    //api call for new list
    sendRequest(this.queryBuilder.currentQuery()).then((res)=> {
      if(res.data.cards.length){
        this.queryBuilder.setLastPage(res.data.lastPage);
        $('.sidebar').removeClass('open');
        $('#no-cards').remove();
        this.cardGrid.append(res.data.cards);
      } else {
        $('.card-display').append('<div id="no-cards">NO CARDS WERE FOUND</div>');
      }
    }).catch(e=>{
      console.log(e);
    });
  }
}

export default CardForm;