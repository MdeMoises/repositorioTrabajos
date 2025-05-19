function modificarUsuario(button){
    // Obtiene el elemento <li> del botón presionado
      const item = button.closest('li');

    // Obtiene los datos del item
    const id = item.getAttribute('valor-id');
    const nombre = item.getAttribute('valor-nombre');
    const correo = item.getAttribute('valor-correo');
    const rolId = item.getAttribute('valor-rol-id');

    // Copia los datos a los campos del formulario
    document.getElementById('input-id').value = id;
    document.getElementById('input-nombre').value = nombre;
    document.getElementById('input-correo').value = correo;
    document.getElementById('select-rol').value = rolId;
}