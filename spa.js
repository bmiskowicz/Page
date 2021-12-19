const app = {
    pages: [],
    show: new Event('show'),
    init: function() {
        app.pages = document.querySelectorAll('.strona');
        app.pages.forEach((strona) => {
            strona.addEventListener('show', app.pageShown);
        });
        document.querySelectorAll('.strony').forEach((link) => {
            link.addEventListener('click', app.nav);
        });
        history.replaceState({}, 'Cennik', '#oplaty');
        window.addEventListener('popstate', app.historia);
        document.getElementById('oplaty').classList.add('aktywna');
        document.querySelector('.aktywna').classList.remove('aktywna');
    },
    nav: function(zdarzenie) {
        zdarzenie.preventDefault();
        let currentPage = zdarzenie.target.getAttribute('data-target');
        document.querySelector('.aktywna').classList.remove('aktywna');
        document.getElementById(currentPage).classList.add('aktywna');
        history.pushState({}, currentPage, `#${currentPage}`);
        document.getElementById(currentPage).dispatchEvent(app.show);
    },
    historia: function(zdarzenie) {
        let hash = location.hash.replace('#', '');
        document.querySelector('.aktywna').classList.remove('aktywna');
        document.getElementById(hash).classList.add('aktywna');
        document.getElementById(hash).dispatchEvent(app.show);
    }
}

document.addEventListener('DOMContentLoaded', app.init);