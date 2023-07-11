const frm = document.querySelector("#formulario");
const email = document.querySelector("#email");
const clave = document.querySelector("#clave");
document.addEventListener("DOMContentLoaded", function() {
    frm.addEventListener("submit", function(e) {
        e.preventDefault();
        if (email.value == "" || clave.value == "") {
            alertas("todo los campos son requeridos", "warning");
        } else {
            let data = new FormData(this);
            const url = base_url + "admin/validar";
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(data);
            http.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if (res.icono == 'success') {
                        setTimeout(() => {
                            window.location = base_url + 'admin/home';
                        }, 2000);
                    }
                    alertas(res.msg, res.icono);
                }
            }
        }
    });
});

function alertas(msg, icono) {
    Swal.fire("Aviso?", msg.toUpperCase(), icono);
}