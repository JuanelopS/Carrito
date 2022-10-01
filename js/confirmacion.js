/* Fichero para trasladar los datos del carrito (localStorage) a PHP para su 
   posterior almacenamiento en la base de datos si se confirma la compra */

window.onload = () => {


  const listaCompraStorage = localStorage.getItem('listaCompra');

  // console.log(listaCompraStorage);

  /* Obtención y muestra de datos desde localStorage */
  
  const lista = document.querySelector('#lista');

  JSON.parse(listaCompraStorage).map( ({nombre, precio, cantidad}, index) => {

    lista.insertAdjacentHTML('beforeend', `

    <tr>
    <th scope='row'>${index + 1}</th>
      <td class='text-start'>${nombre}</td>
      <td>${(precio).toFixed(2)}</td>
      <td>${cantidad}</td>
      <td>${(precio * cantidad).toFixed(2)}</td>
    </tr>

    `);
  });

  /* Calcular y mostrar total en pantalla de confirmación -> REDUCE con desestructuracion de objeto */

  const cantidadTotal = JSON.parse(listaCompraStorage).reduce((prev, {precio, cantidad}) => prev + (precio * cantidad), 0);

  const total = document.querySelector('#total');

  total.insertAdjacentHTML('beforeend',`<h2 class='m-3'>Total a pagar: ${cantidadTotal.toFixed(2)}€</h2>`);


  /* Cancelación de compra -> Borrado de localStorage */

  const btnCancelar = document.querySelector('#btnCancelar');

  btnCancelar.addEventListener('click', () => {
    localStorage.setItem('listaCompra', JSON.stringify([]) );
    window.location.href = '../index.php'
  });

  const btnConfirmar = document.querySelector('#btnConfirmar');

  /* Confirmación de compra -> Envio de total de compra para su tratamiento 
      por PHP -> MySQL*/
  
  btnConfirmar.addEventListener('click', () => {

    const url = '../php/datos.php';
    fetch(url, {
        method: 'post',
        body: cantidadTotal.toFixed(2),
        headers: {
          'Content-Type': 'application/json'
        }
    })
      .then( response => response.text())
      .then( text => console.log(text))
      .catch( error => console.error(error));
    
    localStorage.setItem('listaCompra', JSON.stringify([]) );
    window.location.href = './gracias.php';
  });

  

  

}