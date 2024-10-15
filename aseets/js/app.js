document.getElementById('crudForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const nombre = document.getElementById('nombre').value;
    const fecha = document.getElementById('fecha').value;
    const hora = document.getElementById('hora').value;

    agregarFila(nombre, fecha, hora);

    // Limpiar el formulario
    this.reset();
});

function agregarFila(nombre, fecha, hora) {
    const table = document.getElementById('crudTable').getElementsByTagName('tbody')[0];
    const newRow = table.insertRow();

    const nombreCell = newRow.insertCell(0);
    const fechaCell = newRow.insertCell(1);
    const horaCell = newRow.insertCell(2);
    const accionesCell = newRow.insertCell(3);

    nombreCell.textContent = nombre;
    fechaCell.textContent = fecha;
    horaCell.textContent = hora;

    const eliminarBtn = document.createElement('button');
    eliminarBtn.textContent = 'Eliminar';
    eliminarBtn.classList.add('action', 'delete');
    eliminarBtn.addEventListener('click', function() {
        eliminarFila(newRow);
    });

    const descargarBtn = document.createElement('button');
    descargarBtn.textContent = 'Descargar';
    descargarBtn.classList.add('action', 'download');
    descargarBtn.addEventListener('click', function() {
        descargarFila(nombre, fecha, hora);
    });

    accionesCell.appendChild(eliminarBtn);
    accionesCell.appendChild(descargarBtn);
}

function eliminarFila(row) {
    const table = document.getElementById('crudTable').getElementsByTagName('tbody')[0];
    table.deleteRow(row.rowIndex - 1);
}

function descargarFila(nombre, fecha, hora) {
    const contenido = `Nombre: ${nombre}\nFecha: ${fecha}\nHora: ${hora}`;
    const blob = new Blob([contenido], { type: 'text/plain' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = `${nombre}.txt`;
    link.click();
}

// Función para actualizar el reloj
function actualizarReloj() {
    const ahora = new Date();
    const horas = ahora.getHours().toString().padStart(2, '0');
    const minutos = ahora.getMinutes().toString().padStart(2, '0');
    const segundos = ahora.getSeconds().toString().padStart(2, '0');
    const reloj = document.getElementById('clock');
    reloj.textContent = `${horas}:${minutos}:${segundos}`;
}

// Actualizar el reloj cada segundo
setInterval(actualizarReloj, 1000);

// Inicializar el reloj cuando se carga la página
actualizarReloj();