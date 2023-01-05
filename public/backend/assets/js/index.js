

document
  .getElementById('sidebarCollapseDefault')
  .addEventListener('click', sidebarCollapse);

function sidebarCollapse() {
  document.getElementById('nav-sidebar').classList.toggle('active');
  document.getElementById('main-content').classList.toggle('active');
}



