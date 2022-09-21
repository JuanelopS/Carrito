
window.onload = () => {

  const productos = document.querySelectorAll('.productos');
  const compra = document.querySelector('#carrito');
  
  compra.insertAdjacentHTML('afterend', `<p id="textoTotal">Total:</p>`);
  const textoTotal = document.querySelector('#textoTotal');
  textoTotal.innerHTML = `
    Total: 0.00€
    <button type="submit" id="enviarDatos"><i class="fa-solid fa-cart-shopping"></i></button>
  `;

  /* Array de la lista de frutas en el carrito del cliente */
  
  let listaCompra = [];

  /* localStorage para no perder el carrito en caso de refrescar / salir de la página */

  if (localStorage.getItem('listaCompra') != null){
    listaCompra = JSON.parse(localStorage.getItem('listaCompra'));
  }
  let listaCompraJson = JSON.stringify(listaCompra);
  localStorage.setItem('listaCompra', listaCompraJson);
  mostrarCarrito();
  actualizarTotal();

  /* MAPEO DEL DOM: 
     Asignación de un evento click a cada fruta y llamada a la función agregarFruta() 
  */

  productos.forEach(fruta => { 
    fruta.addEventListener('click', () => 
    {
      let nombre = fruta.childNodes[1].getAttribute('nombre');
      let precio = Number(fruta.childNodes[1].getAttribute('precio'));
      let unidad = fruta.childNodes[1].getAttribute('unidad');

      agregarFruta(nombre, precio, unidad);
    });
  })


  /* AÑADIR FRUTA A LA COMPRA:
     Voy añadiendo frutas a la compra (mediante los párametros pasados por el anterior forEach)
     como un array de objetos y el operador de propagación.
     Hago uso de ids aleatorios para evitar problemas al insertar(prompt) o borrar items obtener valores repetidos
  */

  const agregarFruta = (nombre, precio, unidad) => {
    
    let id1 = self.crypto.randomUUID(); // id para borrar
    let id2 = self.crypto.randomUUID(); // id para modificar

    let item = {
      // ids aleatorios formato "36b8f84d-df4e-4d49-b662-bcde71a8764f"
      id1, 
      id2,
      nombre: nombre, 
      precio: precio, 
      unidad: (unidad == 'unidad') ? 'u' : 'kilo',
      cantidad: 1
    };

    /* Si ya existe la fruta en el carro, que no añada una nueva linea, 
    sino que actualice la existente.... some -> devuelve un booleano */

    const existeFruta = listaCompra.some( fruta => (fruta.nombre === nombre) );

    // No existe la fruta -> preguntar por primera vez
    if(!existeFruta){
      // forzar nº para la cantidad de fruta como respuesta al prompt
      do {
        item.cantidad = Number(prompt(`¿Qué cantidad de ${nombre} desea?`,`${item.cantidad}`));
      } while (isNaN(item.cantidad) || item.cantidad === 0);
      listaCompra = [...listaCompra, item];

    // Existe la fruta -> preguntar si desea modificar su cantidad
    } else {
      listaCompra.forEach( fruta => {
        if(fruta.nombre === nombre){
          do {
            item.cantidad = Number(prompt(`¿Desea cambiar la cantidad de ${nombre}?`,`${fruta.cantidad}`));
          } while (isNaN(item.cantidad) || item.cantidad === 0);
          fruta.cantidad = item.cantidad;
        }
      });
    }

    actualizarTotal();
    mostrarCarrito();
    
  }


  /* MOSTRAR CARRO (MAP):
     Un map que recorre el array de frutas añadidas al carro y las muestra en el dom,
     añadiendole un id a cada fruta con el valor de la propiedad id y asignándole un evento click
     para facilitar su borrado mediante quitarFruta().
     listaCompra.map(({ id, nombre, precio, unidad, cantidad }) -> Hago uso de la 'desestructuración' de JS 
     para no tener que llamar a las propiedades del objeto como fruta.id, fruta.precio, fruta.cantidad...
  */
   
  function mostrarCarrito () {
    
    compra.innerHTML = "";

    /* Añadir la lista sin tocar el html (para un estilo de lista de bootstrap) -> createElement, appendChild 
       y le añado la clase de Bootstrap para las listas */

    let ul = document.createElement('ul');
    compra.appendChild(ul).className = 'list-group list-group-flush mt-5 mb-5 mx-auto';

    /* Html encabezado lista de la compra */

    if(listaCompra.length != 0){
    compra.firstChild.insertAdjacentHTML('afterbegin',
      `<div class="row mb-2 offset-1 gap-1">
          <i class="col-1"></i>
          <span class="col-3" id="nombre-item"><strong>Fruta</strong></span>
          <span class="col-2 text-center" id="precio-item">Precio</span> 
          <span class="col-2 text-center" id="cantidad-item">Cantidad</span>
          <span class="col-3 text-end" id="precio-item-total"><strong>Total*</strong></span>
      </div>`
    ); 
    }else {
      compra.firstChild.insertAdjacentHTML('beforebegin', `Aún no ha comprado nada`);
    }
    
    listaCompraJson = JSON.stringify(listaCompra);
    localStorage.setItem("listaCompra", listaCompraJson);

    /* Html lista de la compra: desestructuración objetos del array listaCompra */

    JSON.parse(listaCompraJson).map(({ id1, id2, nombre, precio, unidad, cantidad }) => {  
      compra.firstChild.insertAdjacentHTML('beforeend', 
        `<li class="list-group-item">
          <div class="row">
            <div class="col-1">
              <i class="fa-regular fa-circle-xmark fa-sm" id="${id1}">&nbsp;</i>
              <i class="fa-regular fa-pen-to-square" id="${id2}"></i>
            </div>
            <span class="offset-1 col-3 text-start" id="nombre-item"><strong>${nombre}</strong></span>
            <span class="col-2" id="precio-item">${precio.toFixed(2)}/${unidad}</span> 
            <span class="col-2 text-center" id="cantidad-item">${cantidad}</span>
            <span class="offset-1 col-2 text-end" id="precio-item-total"><strong>${(precio * cantidad).toFixed(2)}€</strong></span>
          </div>
        </li>`
      );

      // aprovecho el map de mostrar carrito para añadir el evento para borrar la fruta
      const seleccionBorrar = document.getElementById(`${id1}`);   
      seleccionBorrar.addEventListener('click',() => quitarFruta(id1)); 

      // evento modificar compra
      const seleccionModificar = document.getElementById(`${id2}`);
      seleccionModificar.addEventListener('click',() => actualizarFruta(id2, nombre, cantidad));
      
      // si no hay nada en el carrito que no se muestre el banner del total a pagar
      if(listaCompra.length == 0){
        const textoTotal = document.querySelector('#textoTotal');
        textoTotal.style.display = 'none';
      }

    });

  }


  /* QUITAR FRUTA DE LA COMPRA (FILTER):
     mediante el id asignado en mostrarCarrito (seleccionBorrar), hago un filter para que en el array listaCompra deje únicamente
     los articulos que no se corresponden con el id 'clickado' (pasado como argumento)
  */

  const quitarFruta = id => {

      listaCompra = listaCompra.filter(item => item.id1 != id); 
      mostrarCarrito();
      actualizarTotal();

  };


  /* ACTUALIZAR TOTAL PRECIO (REDUCE):
     Hago un reduce del array listaCompra que me devuelve la suma de las propiedades 
     precio * cantidad de todos los elementos
  */

  function actualizarTotal () {

    const total = listaCompra.reduce((itemAnterior, item) => itemAnterior + (item.precio * item.cantidad), 0);
    
    const textoTotal = document.querySelector('#textoTotal');
    // mostrar banner con la cantidad total a pagar
    textoTotal.style.display = 'flex';

    textoTotal.innerHTML = `
      Total: ${total.toFixed(2)}€
        <button id="enviarDatos">
        <lord-icon
            src="https://cdn.lordicon.com/cllunfud.json"
            trigger="hover"
            colors="outline:#109121,primary:#0a5c15,secondary:#d1fad7"
            style="width:60px;height:60px">
        </lord-icon>
        </button>
    `;

    // si no hay nada en el carrito que no se muestre el banner del total a pagar
    if(listaCompra.length == 0){
      const textoTotal = document.querySelector('#textoTotal');
      textoTotal.style.display = 'none';
    }

    /* envio de datos a PHP (evento click del carrito con precio total de la compra) 
       localStorage de listaCompra (array de objetos -> json string = JSON.stringify) */

    const submitCompra = document.querySelector('#enviarDatos');

    submitCompra.addEventListener('click', () => {

      localStorage.setItem("listaCompra", listaCompraJson);
      window.location.href = '../php/carrito.php';
      
    });
  }


  /* ACTUALIZAR CANTIDAD DE UNA FRUTA (MAP)
     Si el id2 del item seleccionado se corresponde con el item a modificar, actualizo la propiedad "cantidad" 
     del objeto a través del valor proporcionado por el prompt (nuevaCantidad).
  */

  const actualizarFruta = (id2, nombre, cantidad) => {
    
    let nuevaCantidad = 0;
    
    listaCompra.map(item => {
      if(item.id2 == id2) {
      do {  
        nuevaCantidad = Number(prompt(`¿Qué cantidad de ${nombre} desea actualizar?`, `${cantidad}`));
      } while (isNaN(nuevaCantidad) || nuevaCantidad === 0);
        item.cantidad = nuevaCantidad;
      }
    });

    mostrarCarrito();
    actualizarTotal();
  
  }

}

 








