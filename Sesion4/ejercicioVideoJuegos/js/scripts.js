function eliminarJuego(id) {
    let borrar = confirm("Va a eliminar el juego de la plataforma. ¿Desea continuar?");
    if (borrar) {
        let frm = document.getElementById('frmGuardar');
        let accion = document.getElementById('accion');
        let id_oculto = document.getElementById('id');
        accion.value = "eliminar";
        id_oculto.value = id;
        frm.action = "ficha_guardar_juego.php";
        frm.submit();
    }
}

function guardarJuego(id) {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "guardar";
    id_oculto.value = id;


    frm.action = "ficha_guardar_juego.php";

    frm.submit();
}

function anadirJuego() {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "anadir";
    id_oculto.value = "0";


    frm.action = "ficha_guardar_juego.php";

    frm.submit();
}

function nuevoRegistroMG(options) {
    let arrOptions = options.split("##");
    let htmlOptions = '';
    for (let o of arrOptions) {
        if (o != '') {
            let arr = o.split("-");
            htmlOptions += `<option value="${arr[0]}">${arr[1]}</option>`
        }

    }

    let sHTML = `
<tr>
    <td>
        <input id="id0" name="id0" type="text" value="0" readonly />
    </td>
    <td>
        <select name="plataforma_id0" id="plataforma_id0">
            <option value="0">[Sin Plataforma]</option>
            ${htmlOptions}
        </select>
    </td>
    <td>
        <input id="titulo0" name="titulo0" type="text" value="" />
    </td>
    <td>
        <input id="metacritic0" name="metacritic0" type="number" value="" />
    </td>
    <td>
        <input id="anio0" name="anio0" type="number" value="" />
    </td>
    <td class="acciones">
        <input type="button" class="btn borrar" onclick="anadirJuegoMG()" value="Añadir" />
    </td>
</tr>`;

    let tabla = document.getElementById('tablaJuegos');
    tabla.innerHTML = sHTML + tabla.innerHTML;
}


function nuevoRegistro(options) {
    let arrOptions = options.split("##");
    let htmlOptions = '';
    for (let o of arrOptions) {
        if (o != '') {
            let arr = o.split("-");
            htmlOptions += `<option value="${arr[0]}">${arr[1]}</option>`
        }

    }

    let sHTML = `
<tr>
    <td>
        <input id="id0" name="id0" type="text" value="0" readonly />
    </td>
    <td>
        <select name="plataforma_id0" id="plataforma_id0">
            <option value="0">[Sin Plataforma]</option>
            ${htmlOptions}
        </select>
    </td>
    <td>
        <input id="titulo0" name="titulo0" type="text" value="" />
    </td>
    <td>
        <input id="metacritic0" name="metacritic0" type="number" value="" />
    </td>
    <td>
        <input id="anio0" name="anio0" type="number" value="" />
    </td>
    <td class="acciones">
        <input type="button" class="btn borrar" onclick="anadirJuego()" value="Añadir" />
    </td>
</tr>`;

    let tabla = document.getElementById('tablaJuegos');
    tabla.innerHTML = sHTML + tabla.innerHTML;
}

function eliminarJuegoMG(id) {
    let borrar = confirm("Va a eliminar el juego de la plataforma. ¿Desea continuar?");
    if (borrar) {
        let frm = document.getElementById('frmGuardar');
        let accion = document.getElementById('accion');
        let id_oculto = document.getElementById('id');
        accion.value = "eliminar";
        id_oculto.value = id;
        frm.action = "ficha_guardar_juego_mongodb.php";
        frm.submit();
    }
}

function guardarJuegoMG(id) {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "guardar";
    id_oculto.value = id;


    frm.action = "ficha_guardar_juego_mongodb.php";

    frm.submit();
}

function anadirJuegoMG() {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "anadir";
    id_oculto.value = "0";


    frm.action = "ficha_guardar_juego_mongodb.php";

    frm.submit();
}

function anadirPlataforma(){
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    accion.value = "anadirPla";

    frm.action = "ficha_guardar_juego_mongodb.php";

    frm.submit();
}

function modificarPlataforma(){
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    accion.value = "modificarPla";

    frm.action = "ficha_guardar_juego_mongodb.php";

    frm.submit();
}

function eliminarPlataforma(){
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    accion.value = "eliminarPla";

    frm.action = "ficha_guardar_juego_mongodb.php";

    frm.submit();
}