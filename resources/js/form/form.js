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

export const getSelectedfilters = (currPage) => {
  const filters = {};
  filters['searchCondition'] = findChecked('conditional')[0].value;
  filters['colors'] = findChecked('colors').map((input) => input.value);
  filters['type'] = findSelectedDropdown('#types');
  filters['supertype'] = findSelectedDropdown('#supertypes');
  filters['subtype'] = findSelectedDropdown('#subtypes');
  filters['rarity'] = findSelectedDropdown('#rarity');
  return filters;
}

export default getSelectedfilters;