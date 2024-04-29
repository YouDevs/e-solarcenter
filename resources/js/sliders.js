// Tiny Slider:
let sliderHero = tns({
    container: '.tns-carousel-hero',
    nav: true, // Desactiva los puntos de navegación inferiores
    controls: false, // Desactiva los botones de anterior/siguiente
    mouseDrag: true,
    autoplay: true,
    autoplayButtonOutput: false,
    autoplayTimeout: 4000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
    loop: true, // Permite que el slider se repita infinitamente
});

let sliderBrands = tns({
    container: '.tns-carousel-brands',
    nav: false, // Desactiva los puntos de navegación inferiores
    controls: false, // Desactiva los botones de anterior/siguiente
    mouseDrag: true,
    autoplay: true, // Activa el autoplay
    autoplayButtonOutput: false,
    autoplayTimeout: 3000, // Establece el intervalo de autoplay a 4000ms (4 segundos)
    loop: true, // Permite que el slider se repita infinitamente
    responsive: {
        "0": {"items": 1},
        "360": {"items": 2},
        "600": {"items": 3},
        "991": {"items": 4},
        "1200": {"items": 4} // A partir de 1200px, muestra 4 elementos
    }
});