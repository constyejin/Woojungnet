const sidebarBtn = document.querySelector('.sidebar-icon')
const closeBtn = document.querySelector('.sidebar-close-icon');
const sidebar = document.querySelector('.sidebar');

function openSidebar() {
  sidebar.classList.add('is-active');
}
sidebarBtn.addEventListener('click', openSidebar);

function closeSidebar() {
  sidebar.classList.remove('is-active');
}
closeBtn.addEventListener('click', closeSidebar);
