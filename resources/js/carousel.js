
const carousel = document.getElementById('carousel');
let offset = 0;

function moveCarousel() {
    const carouselWidth = carousel.clientWidth / 2; // Dividido por 2 porque duplicamos los items
    offset += carouselWidth / 5; // Para mover exactamente una imagen

    if (offset >= carouselWidth) {
        offset = 0;
    }

    carousel.style.transform = `translateX(-${offset}px)`;
}

setInterval(moveCarousel, 2000); // Cambia la velocidad aquí
