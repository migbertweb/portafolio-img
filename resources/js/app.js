import './bootstrap';
import './alpine'; // AlpineJS
import './carousel';  // Aquí importamos el archivo del carrusel
import './locale'; // para cambiar el Idioma
import './alt_theme'; // para cambiar el Theme Dark o Light
import 'atropos/css';

// import Atropos library
import Atropos from 'atropos';

// Initialize
const myAtropos = Atropos({
    el: '.my-atropos',

    // rest of parameters
});

