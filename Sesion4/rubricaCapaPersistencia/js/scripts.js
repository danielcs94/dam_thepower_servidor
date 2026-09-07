function eliminarAlumnoMG(id) {
    let borrar = confirm("Va a eliminar el alumno de la fila. ¿Desea continuar?");
    if (borrar) {
        let frm = document.getElementById('frmGuardar');
        let accion = document.getElementById('accion');
        let id_oculto = document.getElementById('id');
        accion.value = "eliminar";
        id_oculto.value = id;
        frm.action = "ficha_guardar_alumnos_mongodb.php";
        frm.submit();
    }
}

function guardarAlumnoMG(id) {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "guardar";
    id_oculto.value = id;


    frm.action = "ficha_guardar_alumnos_mongodb.php";

    frm.submit();
}

function anadirAlumnoMG() {
    let frm = document.getElementById('frmGuardar');

    let accion = document.getElementById('accion');
    let id_oculto = document.getElementById('id');
    accion.value = "anadir";
    id_oculto.value = "0";


    frm.action = "ficha_guardar_alumnos_mongodb.php";

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
    <td><input id="id0" name="id0" type="text" value="0" readonly /></td>
    <td>
        <select name="fila_id0" id="fila_id0">
            <option value="0">[Sin Fila]</option>
            ${htmlOptions}
        </select>
        <input id="fila_id_ant0" name="fila_id_ant0" type="hidden" value="0" />
    </td>
    <td><input id="nombre0" name="nombre0" type="text" value="" /></td>
    <td><input id="apellidos0" name="apellidos0" type="text" value="" /></td>
    <td><select name="sexo0" id="sexo0">
            <option value="0">[Sin Sexo]</option>
            <option value="H">H</option>
            <option value="M">M</option>
        </select></td>
    <td><input id="es_profe_sexi0" name="es_profe_sexi0" type="checkbox" /></td>

    <td class="acciones">
        <input type="button" class="btn borrar" onclick="anadirAlumnoMG()" value="Añadir" />
    </td>
</tr>`;

    let tabla = document.getElementById('tablaJuegos');
    tabla.innerHTML = sHTML + tabla.innerHTML;
}