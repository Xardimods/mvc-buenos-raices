document.addEventListener("DOMContentLoaded", function () {
    eventListeners(); 
    darkMode(); 
}); 

function darkMode () {
    const prefersDrakMode = window.matchMedia("(prefers-color-scheme: dark)");
    if (prefersDrakMode.matches) {
        document.body.classList.add("dark-mode");
    } else {
        document.body.classList.remove("dark-mode");
    }; 

    prefersDrakMode.addEventListener("change", function () {
        if (prefersDrakMode.maches) {
            document.body.classList.add("dark-mode");
        } else {
            document.body.classList.remove("dark-mode");
        }; 
    }); 

    const botonDarkMode = document.querySelector(".dark-mode-boton");
    botonDarkMode.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");
    }); 
}; 

function eventListeners() {
    const mobileMenu = document.querySelector(".mobile-menu"); 
    mobileMenu.addEventListener("click", navegacionResponsive); 

    // Mostrar campos condicionales 
    const metodoContacto =  document.querySelectorAll("input[name='contacto[contacto]']");
    metodoContacto.forEach(input => input.addEventListener("click", showMethodsContact));

    const metodoTipo =  document.querySelectorAll("select[name='contacto[tipo]']");
    metodoTipo.forEach(input => input.addEventListener("change", showMethodsType));
};

function navegacionResponsive () {
    const navegacion = document.querySelector(".navegacion");
    navegacion.classList.toggle("mostrar"); 
}; 

function showMethodsContact (e) {
    
    const divContacto = document.querySelector("#contacto");
    
    if (e.target.value === "telefono") { // e es un evento con varias propiedades. Target es una propeidad objeto de "e" y value es una de sus propiedade. Con eso puedes hacer cosas como esta: 
        divContacto.innerHTML = `
        <label for="telefono">Escribe tu número de teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" name="contacto[telefono]" id="telefono">

        <p>Elija la hora para ser contactado</p>

        <label for="fecha">Fecha</label>
        <input type="date" name="contacto[fecha]" id="fecha">

        <label for="hora">Hora</label>
        <input type="time" name="contacto[hora]" id="hora" min="09:00" max="18:00 PM">
        `;
    } else {
        divContacto.innerHTML = `
        <label for="email">Escribe tu e-mail</label>
        <input type="email" placeholder="Tu E-mail" name="contacto[email]" id="email" required>
        `;
    }
}


function showMethodsType (e) {
    
    const divTipo = document.querySelector("#tipo");
    
    if (e.target.value === "compra") { // e es un evento con varias propiedades. Target es una propeidad objeto de "e" y value es una de sus propiedade. Con eso puedes hacer cosas como esta: 
        divTipo.innerHTML = `
        <label for="presupuesto">Presupuesto</label>
        <input type="number" placeholder="Tu Presupuesto" name="contacto[presupuesto]" id="presupuesto" required>
        `;
    } else {
        divTipo.innerHTML = `
        <label for="presupuesto">Precio</label>
        <input type="number" placeholder="Tu Precio" name="contacto[presupuesto]" id="presupuesto" required>
        `;
    }
}