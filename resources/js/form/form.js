const findChecked = (tag) => {
  const checked = [...document.querySelectorAll(`input[name="${tag}"]`)]
  .filter((input) => {
    return input.checked;
  });
  return checked;
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
  filters['searchCondition'] = findChecked('conditional')[0].value;
  filters['colors'] = findColors('colors');
  filters['type'] = findSelectedDropdown('#types');
  filters['supertype'] = findSelectedDropdown('#supertypes');
  filters['subtype'] = findSelectedDropdown('#subtypes');
  filters['rarity'] = findSelectedDropdown('#rarity');
  return filters;
}

export default getSelectedfilters;