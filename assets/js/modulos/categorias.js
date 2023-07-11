const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));
let tblCategorias;
document.addEventListener("DOMContentLoaded", function() {
    tblCategorias = $("#tblCategorias").DataTable({
        ajax: {
            url: base_url + "categorias/listar",
            dataSrc: "",
        },
        columns: [
            { data: "id" },
            { data: "categoria" },
            { data: "accion" }
        ],
        language,
        dom,
        buttons,
    });

    //levantar modal
    nuevo.addEventListener("click", function() {
        document.querySelector('#id').value = '';
        titleModal.textContent = "NUEVA CATEGORIA";
        btnAccion.textContent = 'Registrar';
        frm.reset();
        myModal.show();
        //$('#nuevoModal').modal('show');
    });
    //submit categorias
    frm.addEventListener("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "categorias/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    myModal.hide();
                    tblCategorias.ajax.reload();
                }
                Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
            }
        }
    });
});

function eliminarCat(idCat) {
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
            const url = base_url + "categorias/delete/" + idCat;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        tblCategorias.ajax.reload();
                    }
                    Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
                }
            }
        }
    });
}

function editCat(idCat) {
    const url = base_url + "categorias/edit/" + idCat;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#categoria').value = res.categoria;
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = "MODIFICAR CATEGORIA";
            myModal.show();
            //$('#nuevoModal').modal('show');
        }
    }
}