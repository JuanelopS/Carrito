/* Fichero para traslador los datos del carrito (localStorage) a PHP para su 
   posterior almacenamiento en la base de datos si se confirma la compra */

window.onload = () => {

  const listaCompraStorage = localStorage.getItem('listaCompra');

  console.log(listaCompraStorage);
  const url = '../php/datos.php';
  fetch(url, {
      method: 'post',
      body: listaCompraStorage,
      headers: {
        'Content-Type': 'application/json'
      }
  })
    .then( response => response.text())
    .then( text => console.log(text))
    .catch( error => console.error(error));


    const lista = document.querySelector('#lista');

    JSON.parse(listaCompraStorage).map( (item, index) => {

      lista.insertAdjacentHTML('beforeend', `

      <tr>
      <th scope='row'>${index}</th>
        <td>${item.nombre}</td>
        <td>${item.precio}</td>
        <td>${item.cantidad}</td>
        <td>${(item.precio * item.cantidad).toFixed(2)}</td>
      </tr>

      `);
    });
}