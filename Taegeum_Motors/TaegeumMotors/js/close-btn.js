let notice = document.querySelector('.notice');
let closeBtn = document.querySelector('.close-btn');

function closeNotice() {
  notice.style.display = 'none';
}

closeBtn.addEventListener('click', closeNotice);
