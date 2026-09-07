function checkearSesion() {
    // Cada 2 segundos (2000 ms) se ejecutará la función

    let frm = document.forms[0];
    frm.submit();


}
function volver() {
    window.parent.postMessage('sesionFinalizada', '*');
}