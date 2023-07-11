const nuevo = document.querySelector("#nuevo_registro");
const frm = document.querySelector("#frmRegistro");
const titleModal = document.querySelector("#titleModal");
const btnAccion = document.querySelector("#btnAccion");
const myModal = new bootstrap.Modal(document.getElementById("nuevoModal"));
let tblUsuario;
document.addEventListener("DOMContentLoaded", function() {
    tblUsuario = $("#tblUsuarios").DataTable({
        ajax: {
            url: base_url + "usuarios/listar",
            dataSrc: "",
        },
        columns: [
            { data: "id" },
            { data: "nombres" },
            { data: "apellidos" },
            { data: "correo" },
            { data: "perfil" },
            { data: "accion" },
        ],
        language,
        dom,
        buttons,
    });
    //levantar modal
    nuevo.addEventListener("click", function() {
        document.querySelector('#id').value = '';
        titleModal.textContent = "NUEVO USUARIO";
        btnAccion.textContent = 'Registrar';
        frm.reset();
        document.querySelector('#clave').removeAttribute('readonly');
        myModal.show();
    });
    //submit usuarios
    frm.addEventListener("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "usuarios/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    myModal.hide();
                    tblUsuario.ajax.reload();
                }
                Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
            }
        }
    });
});

function eliminarUser(idUser) {
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
            const url = base_url + "usuarios/delete/" + idUser;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == "success") {
                        tblUsuario.ajax.reload();
                    }
                    Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
                }
            }
        }
    });
}

function editUser(idUser) {
    const url = base_url + "usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#nombre').value = res.nombres;
            document.querySelector('#apellido').value = res.apellidos;
            document.querySelector('#correo').value = res.correo;
            document.querySelector('#clave').setAttribute('readonly', 'readonly');
            btnAccion.textContent = 'Actualizar';
            titleModal.textContent = "MODIFICAR USUARIO";
            myModal.show();
            //$('#nuevoModal').modal('show');
        }
    }
}