const contenedor = document.getElementById('login-contenedor');
const registroBtn = document.getElementById('registrarse');
const accederBtn = document.getElementById('acceder');

var enfoque = document.URL;
console.log(enfoque);
if(enfoque.includes("registrarse")){
    contenedor.classList.add("active");
}//Insertado para ir directamente a registrarse

registroBtn.addEventListener('click', () => {
    contenedor.classList.add("active");
});

accederBtn.addEventListener('click', () => {
    contenedor.classList.remove("active");
});