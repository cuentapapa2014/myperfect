window.onload = inicio;

function inicio() {
    var botonAgregar = document.getElementById('agregar');
    botonAgregar.addEventListener("click", agregar, false);
    var botonEditar = document.getElementById('editar');
    botonEditar.addEventListener("click", editar, false);
    botonEditar.disabled = true;
    var botonBorrar = document.getElementById('eliminar');
    botonBorrar.addEventListener("click", borrar, false);
    botonBorrar.disabled = true;
    var botonReset = document.getElementById('cancelar');
    botonReset.addEventListener("click", reset, false);
    var fila = document.getElementsByTagName("tr");
    try {
        for (var i = 0; i < fila.length; i++) {
            fila[i + 1].addEventListener("click", function() {
                editarBorrar(botonEditar, botonBorrar, this);
            });
        }
    } catch (e) {

    }
}

function agregar(e) {
    //if (compruebaCampos()) {
    if (confirm("¿Seguro que quieres insertar este anuncio?")) {
        var formulario = document.getElementById('formulario');
        formulario.action = "insert.php";
    }
    //}
}

function editar(e) {
    if (confirm("¿Seguro que quieres editar este anuncio?")) {
        var formulario = document.getElementById('formulario');
        formulario.action = "update.php";
    }
    else {
        e.preventDefault();
    }
}

function borrar(e) {
    var formulario = document.getElementById('formulario');
    if (confirm("¿Seguro que quieres eliminar a " + formulario[0].value)) {
        formulario.action = "delete.php";
    }
    else {
        e.preventDefault();
    }
}

function reset(e) {
    if (!confirm("¿Seguro que quieres reiniciar todos los campos?")) {
        this.preventDefault();
    }
}

function editarBorrar(b1, b2, elemento) {
    b1.disabled = false;
    b2.disabled = false;
    var formulario = document.getElementById('formulario');
    formulario[0].value = elemento.children[1].textContent;
    formulario[15].value = elemento.children[0].textContent;
    formulario[1].value = elemento.children[2].textContent;
    formulario[4].value = elemento.children[5].textContent;
    formulario[5].value = elemento.children[6].textContent;
    formulario[6].value = elemento.children[7].textContent;
    formulario[7].value = elemento.children[8].textContent;
    formulario[8].value = elemento.children[9].textContent;
    formulario[9].value = elemento.children[10].textContent;
    formulario[10].value = elemento.children[11].textContent;
    formulario[11].value = elemento.children[12].textContent;
    formulario[11].value = elemento.children[13].textContent;
    formulario[13].value = elemento.children[14].textContent;
}

function compruebaCampos(e) {
    var formulario = document.getElementById('formulario');
    if (formulario[0].value === "" || formulario[1].value === "" || formulario[2].value === "" || formulario[3].value === "" || formulario[4].value === "") {
        alert("Todos los campos deben estar rellenos");
        e.preventDefault();
    }
    return true;
}



