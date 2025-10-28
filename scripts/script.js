const botao = document.getElementById('botao-tema');
const body = document.body;

// Persistência do tema
const temasalvo = localStorage.getItem('tema');
temaEscuro(temasalvo === 'escuro');

// Função para alternar entre tema claro e escuro
function temaEscuro(tipo) {
  if (tipo == true) {
    body.classList.add('escuro');
    botao.innerHTML = '<i class="fa-solid fa-sun"></i>';
  } else {
    body.classList.remove('escuro');
    botao.innerHTML = '<i class="fa-solid fa-moon"></i>';
  }
};

botao.addEventListener('click', () => {
  const isescuro = body.classList.toggle('escuro');
  temaEscuro(isescuro);
  localStorage.setItem('tema', isescuro ? 'escuro' : 'claro');
});

// Scroll suave para links de navegação
const navLinks = document.querySelectorAll('#menu ul a.link');
navLinks.forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      const headerHeight = document.querySelector('header').offsetHeight;
      const targetPosition = target.offsetTop - headerHeight - 20;
      window.scrollTo({
        top: targetPosition,
        behavior: 'smooth'
      });
    }
  });
});

// Menu Hamburger
  const menuBtn = document.querySelector('.menu-btn');
  const nav = document.querySelector('nav');

  if (menuBtn && nav) {
    menuBtn.addEventListener('click', () => {
      const isActive = nav.classList.toggle('active');
      menuBtn.setAttribute('aria-expanded', isActive);
    });

    // Fecha o menu ao clicar em um link
    nav.querySelectorAll('a').forEach(link => {
      link.addEventListener('click', () => {
        nav.classList.remove('active');
        menuBtn.setAttribute('aria-expanded', false);
      });
    });
  };

  // Fecha o menu ao clicar fora (na página)
document.addEventListener('click', (evt) => {
    const target = evt.target;
    // se o menu estiver aberto e o click não for no menu nem no botão, fecha
    if (navLinks.classList.contains('open') && !navLinks.contains(target) && !menuBtn.contains(target)) {
    navLinks.classList.remove('open');
    menuBtn.setAttribute('aria-expanded', 'false');
    }
});

// Fecha o menu ao pressionar ESC
document.addEventListener('keydown', (evt) => {
    if (evt.key === 'Escape' && navLinks.classList.contains('open')) {
    navLinks.classList.remove('open');
    menuBtn.setAttribute('aria-expanded', 'false');
    }
});
