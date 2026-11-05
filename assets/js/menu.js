document.addEventListener('DOMContentLoaded', () => {
  const navigation = document.querySelector('#site-navigation');
  const toggle = navigation?.querySelector('.menu-toggle');
  const menu = navigation?.querySelector('.main-menu-container');

  if (!navigation || !toggle || !menu) {
    return;
  }

  const closeMenu = () => {
    navigation.classList.remove('is-open');
    toggle.setAttribute('aria-expanded', 'false');
  };

  toggle.addEventListener('click', () => {
    const isOpen = navigation.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', String(isOpen));
  });

  menu.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeMenu);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
      closeMenu();
      toggle.focus();
    }
  });

  window.addEventListener('resize', () => {
    if (window.matchMedia('(min-width: 768px)').matches) {
      closeMenu();
    }
  });
});
