const imageContainer = document.querySelector("competitionImages")







document.addEventListener('DOMContentLoaded', () => {
    pobierzZdjecia();
});

function pobierzZdjecia() {
    fetch('searchForEvaluation') // tutaj wpisz pełny URL do twojego endpointu
        .then(response => response.json())
        .then(zdjecia => {
            wyswietlZdjecia(zdjecia);
        })
        .catch(error => {
            console.error('Błąd podczas pobierania zdjęć:', error);
        });
}

function wyswietlZdjecia(zdjecia) {
    const galeria = document.getElementById('photo-gallery');
    galeria.innerHTML = ''; // Czyści galerię przed dodaniem nowych zdjęć

    zdjecia.forEach(zdjecie => {
        const img = document.createElement('img');
        img.src = zdjecie.url; // Zakładam, że 'url' to właściwość w twoim JSON z URL-em zdjęcia
        img.alt = 'Zdjęcie do oceny';
        galeria.appendChild(img);
    });
}
