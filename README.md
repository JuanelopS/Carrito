# Carrito JS/PHP/MYSQL 🛒
  
Un simple carrito de la compra en desarrollo mediante JavaScript, PHP y MySQL  (otro más si...)🐭

Estoy totalmente abierto a comentarios para mejorarlo 💕

Pendiente:

- Relacionar base de datos (compras con usuarios, etc...)

- Mejorar información del panel de admin (actualmente solo muestra/edita/borra usuarios)

- Crear panel de usuario para ver sus compras anteriores, cambiar sus datos, etc

- Formulario para añadir items / contacto

- Modo día/noche

- Seguridad php/mysql

- Más cosillas que no se me ocurren ahora mismo...

Un pequeño extracto...

```js
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
```
