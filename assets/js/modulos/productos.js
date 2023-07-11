const frm = document.querySelector("#frmRegistro");
const btnAccion = document.querySelector("#btnAccion");
const containerGaleria = document.querySelector("#containerGaleria");
let tblProductos;

var firstTabEl = document.querySelector("#myTab li:last-child button");
var firstTab = new bootstrap.Tab(firstTabEl);

const modalGaleria = new bootstrap.Modal(
    document.getElementById("modalGaleria")
);

let desc;

const btnProcesar = document.querySelector("#btnProcesar");

document.addEventListener("DOMContentLoaded", function() {

    tblProductos = $("#tblProductos").DataTable({
        ajax: {
            url: base_url + "productos/listar",
            dataSrc: "",
        },
        columns: [
            { data: "id" },
            { data: "nombre" },
            { data: "precio" },
            { data: "cantidad" },
            { data: "imagen" },
            { data: "accion" },
        ],
        language,
        dom,
        buttons,
    });

    //submit productos
    frm.addEventListener("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "productos/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    frm.reset();
                    tblProductos.ajax.reload();
                    document.querySelector("#imagen").value = "";
                }
                Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
            }
        };
    });

    //galeria de imagenes
    let myDropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Arrastar y Soltar Imagenes",
        acceptedFiles: ".png, .jpg, .jpeg",
        maxFiles: 10,
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 10
    });
    btnProcesar.addEventListener("click", function() {
        myDropzone.processQueue();
    });
    myDropzone.on("complete", function(file) {
        myDropzone.removeFile(file);
        Swal.fire("Aviso?", 'IMAGENES SUBIDA', 'success');
        setTimeout(() => {
            modalGaleria.hide();
        }, 1500);
    });
});

function eliminarPro(idPro) {
    Swal.fire({
        title: "Aviso?",
        text: "Esta seguro de eliminar el registro!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar!",
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "productos/delete/" + idPro;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        tblProductos.ajax.reload();
                    }
                    Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
                }
            };
        }
    });
}

function editPro(idPro) {
    const url = base_url + "productos/edit/" + idPro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector("#id").value = res.id;
            document.querySelector("#nombre").value = res.nombre;
            document.querySelector("#precio").value = res.precio;
            document.querySelector("#cantidad").value = res.cantidad;
            document.querySelector("#categoria").value = res.id_categoria;
            document.querySelector("#descripcion").value = res.descripcion;
            document.querySelector("#imagen_actual").value = res.imagen;
            btnAccion.textContent = "Actualizar";
            firstTab.show();
        }
    };
}

function agregarImagenes(idPro) {
    const url = base_url + "productos/verGaleria/" + idPro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector("#idProducto").value = idPro;
            let html = '';
            let destino = base_url + 'assets/images/productos/' + idPro + '/';
            for (let i = 0; i < res.length; i++) {
                html += `<div class="col-md-3">
                    <img class="img-thumbnail" src="${destino + res[i]}">
                    <div class="d-grid">
                        <button class="btn btn-danger btnEliminarImagen" type="button" data-id="${idPro}" data-name="${idPro + '/' +res[i]}">Eliminar</button>
                    </div>     
                </div>`;
            }
            containerGaleria.innerHTML = html;
            eliminarImagen();
            modalGaleria.show();
        }
    };
}

function eliminarImagen() {
    let lista = document.querySelectorAll('.btnEliminarImagen');
    for (let i = 0; i < lista.length; i++) {
        lista[i].addEventListener('click', function() {
            let idPro = lista[i].getAttribute('data-id');
            let nombre = lista[i].getAttribute('data-name');
            eliminar(idPro, nombre);
        })
    }
}

function eliminar(idPro, nombre) {
    const url = base_url + "productos/eliminarImg";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(JSON.stringify({
        url: nombre
    }));
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire("Aviso?", res.msg, res.icono);
            if (res.icono == 'success') {
                agregarImagenes(idPro);
            }
        }
    };
}