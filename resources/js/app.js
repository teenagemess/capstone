import './bootstrap';
import "trix";
import "trix/dist/trix.css";


import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener("trix-before-initialize", () => {
    // Change Trix.config if you need
    })

Alpine.start();
