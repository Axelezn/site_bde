document.addEventListener('DOMContentLoaded', function() {
    const header = document.querySelector('header');
    const nav = document.querySelector('nav');
    const logo = document.querySelector('.logo');

    // Créer l'élément du bouton burger
    const burgerButton = document.createElement('div');
    burgerButton.classList.add('burger-menu');
    burgerButton.innerHTML = '☰'; // Vous pouvez utiliser une icône SVG ici si vous préférez

    // Ajouter un écouteur d'événements pour basculer la classe 'open' sur le nav
    burgerButton.addEventListener('click', function() {
        nav.classList.toggle('open');
    });

    function handleResize() {
        if (window.innerWidth < 768) { // Définissez ici la largeur à laquelle le menu burger doit apparaître
            header.classList.add('mobile-menu');
            header.insertBefore(burgerButton, nav); // Insérer le bouton burger avant la navigation
        } else {
            header.classList.remove('mobile-menu');
            if (header.contains(burgerButton)) {
                header.removeChild(burgerButton); // Supprimer le bouton burger
            }
            nav.classList.remove('open'); // S'assurer que le menu n'est pas ouvert en grand écran
            header.appendChild(nav); // Remettre la navigation dans le header
        }
    }

    // Appeler handleResize au chargement de la page et à chaque redimensionnement
    window.addEventListener('load', handleResize);
    window.addEventListener('resize', handleResize);
});