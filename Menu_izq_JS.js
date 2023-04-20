//Ejecutar función en el evento click
document.getElementById("abrir_menu").addEventListener("click", open_close_menu);

//Declaramos variables
var menu_lateral = document.getElementById("menu_lateral");
var abrir_menu = document.getElementById("abrir_menu");
var body = document.getElementById("body");

//Evento para mostrar y ocultar menú
function open_close_menu(){
    body.classList.toggle("mov_body");
    menu_lateral.classList.toggle("mov_menu_lateral");
}