function anadir(){
    let titulo=document.getElementById('titulo0').value;
    let autor=document.getElementById('autor0').value;
    let estado=document.getElementById('estado0').value;
    let localizacion=document.getElementById('localizacion0').value;
    let prestado=document.getElementById('prestado0').checked;
    document.getElementById('titulo').value=titulo;
    document.getElementById('autor').value=autor;
    document.getElementById('estado').value=estado;
    document.getElementById('localizacion').value=localizacion;
    document.getElementById('prestado').value=prestado;

    let frm =document.getElementById('frm');
    frm.action='funciones.php?action=anadir';
  
    frm.submit();

}

function anadirFila(){
    let listado=document.getElementById('listado');

    let lhtml=listado.innerHTML;

    let fila=`<div class="fila" id="filNue"><div><input type="text"
                            id="titulo0"
                            value="" required/>
                    </div>
                    <div><input type="text"
                            id="autor0"
                            value="" required />
                    </div>
                    <div><select id="estado0" name="estado0" required>
                        <option value=""></option>
                        <option value="pendiente de leer">pendiente de leer</option>
                        <option value="leyendo">leyendo</option>
                        <option value="leido">leído</option>
                    </select>
                    </div>
                    <div><input type="checkbox" id="prestado0" />
                    </div>
                    <div>
                    <select id="localizacion0"
                        name="localizacion0" required>
                        <option value=""></option>
                        <option value="Estanteria1">Estantería
                            1
                        </option>
                        <option value="Estanteria2">Estantería
                            2</option>
                        <option value="Estanteria3">Estantería
                            3
                        </option>
                    </select>
                </div>
                    <div>
                        <input type="button" id="btnAnadir" onclick="anadir();" value="ADD" />
                        <input type="button" id="btnCancel" onclick="cancelar();" value="CANCEL" />
                        
                    </div></div>`
    listado.innerHTML=lhtml+ fila;
}
function cancelar(){
const elemento = document.getElementById("filNue");
    elemento.remove(); // elimina el elemento del DOM
}

function modificar(id){
    let titulo=document.getElementById('titulo'+ id).value;
    let autor=document.getElementById('autor'+ id).value;
    let estado=document.getElementById('estado'+ id).value;
    let localizacion=document.getElementById('localizacion'+ id).value;
    let prestado=document.getElementById('prestado'+ id).checked;
    document.getElementById('titulo').value=titulo;
    document.getElementById('autor').value=autor;
    document.getElementById('estado').value=estado;
    document.getElementById('localizacion').value=localizacion;
    document.getElementById('prestado').value=prestado;
    document.getElementById('id').value=id;

    let frm =document.getElementById('frm');
    frm.action='funciones.php?action=guardar';
    frm.submit();
}

function eliminar(id){
    let titulo=document.getElementById('titulo'+ id).value;
    let salida=confirm(`Va a eliminar la comic ${titulo}. ¿Desea continuar?`);

    if(salida){
        document.getElementById('id').value=id;

        let frm =document.getElementById('frm');
        frm.action='funciones.php?action=eliminar';
        frm.submit();
    }
    
}

function filtrar(){

    console.log("entra");
    let titulo=document.getElementById('filTitulo').value;
    let autor=document.getElementById('filAutor').value;
    let estado=document.getElementById('filEstado').value;
    let localizacion=document.getElementById('filLocalizacion').value;
    let prestado=document.getElementById('filPrestado').checked;
    
    document.getElementById('titulo').value=titulo;
    document.getElementById('autor').value=autor;
    document.getElementById('estado').value=estado;
    document.getElementById('localizacion').value=localizacion;
    document.getElementById('prestado').value=prestado;

    let frm =document.getElementById('frm');
    frm.action='index.php?action=filtrar';
    frm.submit();

}