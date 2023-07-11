const btnAddcarrito = document.querySelectorAll(".btnAddcarrito");
const btnCarrito = document.querySelector("#btnCantidadCarrito");
const verCarrito = document.querySelector('#verCarrito');
const tableListaCarrito = document.querySelector('#tableListaCarrito tbody');

let listaCarrito;
document.addEventListener("DOMContentLoaded", function () {
    if (localStorage.getItem("listaCarrito") != null) {
        listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
    }
    for (let i = 0; i < btnAddcarrito.length; i++) {
        btnAddcarrito[i].addEventListener("click", function (e) {
            e.preventDefault();
            let idProducto = btnAddcarrito[i].getAttribute("prod");
            agregarCarrito(idProducto, 1);
        });
    }
    cantidadCarrito();

    verCarrito.addEventListener('click', function () {
        getListaCarrito();
        $('#modalCarrito').modal('show')
    })
});

//agregar productos al carrito
function agregarCarrito(idProducto, cantidad) {
    if (localStorage.getItem("listaCarrito") == null) {
        listaCarrito = [];
    } else {
        let listaExiste = JSON.parse(localStorage.getItem("listaCarrito"));
        for (let i = 0; i < listaExiste.length; i++) {
            if (listaExiste[i]["idProducto"] == idProducto) {
                alertaPerzanalizada("EL PRODUCTO YA ESTA AGREGADO", "warning")
                return;
            }
        }
        listaCarrito.concat(localStorage.getItem("listaCarrito"));
    }
    listaCarrito.push({
        idProducto: idProducto,
        cantidad: cantidad,
    });
    localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
    alertaPerzanalizada("PRODUCTO AGREGADO AL CARRITO", "success")
    cantidadCarrito();
}

function cantidadCarrito() {
    let listas = JSON.parse(localStorage.getItem("listaCarrito"));
    if (listas != null) {
        btnCarrito.textContent = listas.length;
    } else {
        btnCarrito.textContent = 0;
    }
}

//ver carrito
function getListaCarrito() {
    const url = base_url + 'principal/listaProductos';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            let html = '';
            res.productos.forEach(producto => {
                html += `<tr>
                    <td>
                    <img class="img-thumbnail" src="${base_url + producto.imagen}" alt="" width="100">
                    </td>
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-warning">${res.moneda + ' ' + producto.precio}</span></td>
                    <td width="100">
                    <input type="number" class="form-control agregarCantidad" id="${producto.id}" value="${producto.cantidad}">
                    </td>
                    <td>${producto.subTotal}</td>
                    <td>
                    <button class="btn btn-danger btnDeletecart" type="button" prod="${producto.id}"><i class="fas fa-times-circle"></i></button>
                    </td>
                </tr>`;
            });
            tableListaCarrito.innerHTML = html;
            document.querySelector('#totalGeneral').textContent = res.total;
            btnEliminarCarrito();
            cambiarCantidad();
        }
    }
}

function btnEliminarCarrito() {
    let listaEliminar = document.querySelectorAll('.btnDeletecart');
    for (let i = 0; i < listaEliminar.length; i++) {
        listaEliminar[i].addEventListener('click', function () {
            let idProducto = listaEliminar[i].getAttribute('prod');
            eliminarListaCarrito(idProducto);
        })
    }
}

function eliminarListaCarrito(idProducto) {
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]['idProducto'] == idProducto) {
            listaCarrito.splice(i, 1);
        }
    }
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
    getListaCarrito();
    cantidadCarrito();
    alertaPerzanalizada("PRODUCTO ELIMINADO DEL CARRITO", "success")
}
//cambiar la cantidad
function cambiarCantidad() {
    let listaCantidad = document.querySelectorAll('.agregarCantidad');
    for (let i = 0; i < listaCantidad.length; i++) {
        listaCantidad[i].addEventListener('change', function () {
            let idProducto = listaCantidad[i].id;
            let cantidad = listaCantidad[i].value
            incrementarCantidad(idProducto, cantidad);
        })
    }
}

function incrementarCantidad(idProducto, cantidad) {
    for (let i = 0; i < listaCarrito.length; i++) {
        if (listaCarrito[i]['idProducto'] == idProducto) {
            listaCarrito[i].cantidad = cantidad;
        }
    }
    localStorage.setItem('listaCarrito', JSON.stringify(listaCarrito));
}