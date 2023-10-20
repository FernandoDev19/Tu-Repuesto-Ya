
const typed = new Typed('.typed', {
    strings: ["Busca tu repuesto aquí!"],

    stringsElement: '#cadenas-texto', // ID del elemento que contiene cadenas de texto a mostrar.
	typeSpeed: 50, // Velocidad en mlisegundos para poner una letra,
	startDelay: 800, // Tiempo de retraso en iniciar la animacion. Aplica tambien cuando termina y vuelve a iniciar,
	backSpeed: 75, // Velocidad en milisegundos para borrrar una letra,
	smartBackspace: true, // Eliminar solamente las palabras que sean nuevas en una cadena de texto.
	shuffle: false, // Alterar el orden en el que escribe las palabras.
	backDelay: 1500, // Tiempo de espera despues de que termina de escribir una palabra.
	loop: false, // Repetir el array de strings
	loopCount: false, // Cantidad de veces a repetir el array.  false = infinite
	showCursor: false, // Mostrar cursor palpitanto
	contentType: 'html', // 'html' o 'null' para texto sin formato
});

const marcas = document.getElementById('sesion-de-marcas-y-cotizaciones');
const cuentanos = document.getElementById("sesion-de-solicitud-de-repuestos");
const requerimiento = document.getElementById("sesion-de-envío-de-requerimientos");
const elige = document.getElementById("sesion-de-elección-de-opciones");
const diferente = document.getElementById("article_diferente")

const cargarArticle = (entradas, observador) => {
    entradas.forEach((entrada) => {
        if(entrada.isIntersecting){
            entrada.target.classList.add("visible")
        }
        else{
            entrada.target.classList.remove("visible")
        }
    })
}

const observador = new IntersectionObserver(cargarArticle, {
    root: null, rootMargin: "1000px 0px 0px 0px"
});

observador.observe(marcas);
observador.observe(cuentanos);
observador.observe(requerimiento);
observador.observe(elige);
observador.observe(diferente);


