var links = document.querySelectorAll('.header__menu li a');

links.forEach(function(link){
    if (link.href === location.href) link.classList.add('header__link_active');
})