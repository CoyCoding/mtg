const findChecked = (tag) => {
  return $('.radio-wrap.active').attr('value')
}
const findColors = () => {
  const colors = [];
  $('.color-wrap.active').each((i, ele) => {
    colors.push($(ele).attr('value'));
  });
  return colors;
}
const findSelectedDropdown = (dropdown) =>{
  return $(dropdown).find('.selected.active').data('value');
}

export const getSelectedfilters = (currPage) => {
  const filters = {};

  filters['name'] = $('#name-input').val().trim();
  filters['searchCondition'] = findChecked('conditional');
  filters['colors'] = findColors('colors');
  filters['type'] = findSelectedDropdown('#types');
  filters['supertype'] = findSelectedDropdown('#supertypes');
  filters['subtype'] = findSelectedDropdown('#subtypes');
  filters['rarity'] = findSelectedDropdown('#rarity');
  return filters;
}

export default getSelectedfilters;