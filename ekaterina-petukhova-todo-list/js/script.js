const updateForms = document.querySelectorAll('.item-todo__form');
const updateInputs = document.querySelectorAll('.item-todo__input');
const activityNames = document.querySelectorAll('.item-todo__text');

updateInputs.forEach((updateInput, index) =>
  updateInput.addEventListener('change', () => {
    updateForms[index].submit();
  })
);

activityNames.forEach((activeName, index) => {
  if (updateInputs[index].checked === true) activeName.style.textDecoration = 'line-through';
})