const cbxFacultad = document.getElementById('facultad')
cbxFacultad.addEventListener('change',GetCarreras)

const cbxCarreras = document.getElementById('carrera')
cbxCarreras.addEventListener('change',GetAreas)

const cbxAreas = document.getElementById('area')

function fetchAndSetData(url, formData,targetElement){
    return fetch(url,{
        method: "POST",
        body: formData,
        mode: 'cors'
    })
    .then(Response=> Response.json())
    .then(data =>{
        targetElement.innerHTML = data;
    })
    .catch(err=> console.log(err));
}

function GetCarreras(){
    let facultad = cbxFacultad.value;
    let url = 'php/getCarreras.php';
    let formData = new FormData();
    formData.append('facultad_id', facultad);

    fetchAndSetData(url,formData,cbxCarreras)
    .then(()=>{
        cbxAreas.innerHTML = ''
        cbxAreas.innerHTML = '<option value="">Seleccionar</option>'
    })
    .catch(err => console.log(err));
}

function GetAreas(){
    let carreras = cbxCarreras.value;
    let url = 'php/getAreas.php';
    let formData = new FormData();
    formData.append('carrera_id', carreras);

    fetchAndSetData(url,formData,cbxAreas)
    .catch(err=>console.log(err));
}

function actualizarTutores() {
    const cantidadT = document.getElementById('cantidadTutores').value;
    const contenedorT = document.getElementById('contenedorTutores');
    contenedorT.innerHTML = ''; // Limpiar contenedor

    for (let i = 1; i <= cantidadT; i++) {
        // Crear un div para contener el label, input y select
        const tutorDiv = document.createElement('div');
        tutorDiv.classList.add('tutor-item');

        // Crear label para el input
        const label = document.createElement('label');
        label.htmlFor = `tutor${i}`;
        label.textContent = `Tutor ${i}`;

        // Crear input para el tutor
        const input = document.createElement('input');
        input.type = 'text';
        input.name = `tutor${i}`;
        input.id = `tutor${i}`; // Asignar un ID único
        input.placeholder = `Tutor ${i}`;

        // Crear select para tipo de tutor
        const select = document.createElement('select');
        select.name = `tipoTutor${i}`;
        select.id = `tipoTutor${i}`;
        
        const option1 = document.createElement('option');
        option1.value = '1';
        option1.textContent = 'Asesor académico';
        select.appendChild(option1);

        const option2 = document.createElement('option');
        option2.value = '2';
        option2.textContent = 'Tutor industrial';
        select.appendChild(option2);

        // Añadir label, input y select al div
        tutorDiv.appendChild(label);
        tutorDiv.appendChild(select);
        tutorDiv.appendChild(input);

        // Añadir el div al contenedor
        contenedorT.appendChild(tutorDiv);
        contenedorT.appendChild(document.createElement('br'));
    }
}


function obtenerOpciones(selectElement) {
    const areaId = document.getElementById('area').value; // Asegúrate de tener el área_id disponible

    fetch('php/GetLineas.php', {
        method: 'POST', // Cambia a POST
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded' // Establece el tipo de contenido
        },
        body: `area_id=${encodeURIComponent(areaId)}` // Envía el área_id en el cuerpo
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error en la red');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Verifica qué datos se están recibiendo
        selectElement.innerHTML = "<option value='0'>Seleccionar</option>";
    
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.linea_id; 
            option.textContent = item.linea_nombre; 
            selectElement.appendChild(option);
        });
    })
}


function actualizarLineas() {
    const cantidadL = document.getElementById('cantidadLineas').value;
    const contenedorL = document.getElementById('contenedorLineas');
    contenedorL.innerHTML = ''; // Limpiar contenedor

    for (let i = 1; i <= cantidadL; i++) {
        // Crear un div para contener el label, input y select
        const lineaDiv = document.createElement('div');
        lineaDiv.classList.add('linea-item');

        // Crear label para el input
        const label = document.createElement('label');
        label.htmlFor = `tipoLinea${i}`;
        label.textContent = `Linea ${i}`;

        // Crear select para tipo de linea
        const select = document.createElement('select');
        select.name = `tipoLinea${i}`;
        select.id = `tipoLinea${i}`;

        // Añadir label, input y select al div
        lineaDiv.appendChild(label);
        lineaDiv.appendChild(select);

        // Añadir el div al contenedor
        contenedorL.appendChild(lineaDiv);

        obtenerOpciones(select);

    }
}