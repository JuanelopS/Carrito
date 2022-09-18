# Carrito JS/PHP/MYSQL 🛒
  
Un simple carrito de la compra en desarrollo mediante JavaScript, PHP y MySQL  (otro más si...)🐭

Estoy totalmente abierto a comentarios para mejorarlo 💕

Pendiente:

- Backend PHP: array de objetos listaCompra;

- Relacionar base de datos (compras con usuarios, etc...)

- Formulario de contacto

- Mejorar el como se muestran los items (da grima)

- Modo día/noche

- Más cosillas que no se me ocurren ahora mismo...

Un pequeño extracto...

```js
	/* AÑADIR FRUTA A LA COMPRA:
	Voy añadiendo frutas a la compra (mediante los párametros pasados por el anterior forEach)
	como un array de objetos y el operador de propagación. Hago uso de ids aleatorios para evitar 	
	problemas al insertar(prompt) o borrar items...
	*/
	
	const agregarFruta =  (nombre, precio, unidad, cantidad)  =>  {
	// ids aleatorios formato "36b8f84d-df4e-4d49-b662-bcde71a8764f"
	let id1 = self.crypto.randomUUID();  // id para borrar
	let id2 = self.crypto.randomUUID();  // id para modificar

	let item =  {
		id1,
		id2,
		nombre: nombre,
		precio: precio,
		unidad:  (unidad == 'unidad')  ?  'u' : 'kilo',
		cantidad: cantidad
	};

	/* Si ya existe la fruta en el carro, que no añada una nueva linea,
	sino que actualice la existente.... some -> devuelve un booleano */

	const existeFruta = listaCompra.some( fruta =>  (fruta.nombre === nombre)  );

	if(!existeFruta){
		listaCompra =  [...listaCompra, item];
	}  else  {
		listaCompra.forEach( fruta =>  {	
			if(fruta.nombre === nombre){
				fruta.cantidad += cantidad;
			}
		});
	   }
	   
	actualizarTotal();
	mostrarCarrito();
				
	}
```
