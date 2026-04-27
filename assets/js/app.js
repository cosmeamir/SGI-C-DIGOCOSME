document.querySelectorAll('.auto-hide').forEach((el) => {
  setTimeout(() => {
    el.classList.add('fade');
    setTimeout(() => el.remove(), 500);
  }, 3500);
});
