 // Initialize the cart from sessionStorage or as an empty object
 const cartCount = document.getElementById('cart-count');
 const cartItemsContainer = document.getElementById('cartItemsContainer');
 const emptyCartMessage = document.getElementById('emptyCartMessage');

 // Open the modal when the cart button is clicked
 const cartModalButton = document.getElementById('cartButton');
 cartModalButton.addEventListener('click', function () {
   const idUsuario = obtenerIdUsuario();
   if (idUsuario) {
     const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
     cartModal.show();
     actualizarCarrito(idUsuario);
   } else {
     alert("Debe iniciar sesión para ver su carrito.");
   }
 });

 // Show a toast message
 function mostrarToast(mensaje) {
   const toastBody = document.querySelector('#cartToast .toast-body');
   toastBody.textContent = mensaje;

   const toastElement = document.getElementById('cartToast');
   const toast = new bootstrap.Toast(toastElement);
   toast.show();
 }

 // Function to add to the cart
 function agregarAlCarrito(id, nombre, precio, imagen) {
   const idUsuario = obtenerIdUsuario();
   if (!idUsuario) {
     alert("Debe iniciar sesión.");
     return;
   }

   let carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};

   if (!carrito[id]) {
     carrito[id] = {
       id: id,
       nombre: nombre,
       precio: parseFloat(precio),
       imagen: imagen,
       cantidad: 1,
     };
   } else {
     carrito[id].cantidad += 1;
   }

   localStorage.setItem('carrito_' + idUsuario, JSON.stringify(carrito));
   mostrarToast("Producto agregado al carrito.");
   actualizarCarrito(idUsuario);
   updateCart()
 }

 // Update the cart count in the header
function updateCart() {
    const idUsuario = obtenerIdUsuario();
    if (!idUsuario) {
      cartCount.textContent = '0';
      return;
    }
  
    const carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};
    
    // Calcular el total de productos en el carrito
    const totalProductos = Object.values(carrito).reduce((total, producto) => total + producto.cantidad, 0);
    
    cartCount.textContent = totalProductos;
  }
  

 // Update the cart in the modal
// Update the cart in the modal
function actualizarCarrito(idUsuario) {
    console.log("Actualizando carrito para el usuario:", idUsuario);
    let carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};
    console.log("Contenido del carrito:", carrito);
    
    updateCart();
    
    if (!cartItemsContainer) return;
  
    cartItemsContainer.innerHTML = '';
    let total = 0;  // Variable para calcular el total
  
    if (Object.keys(carrito).length === 0) {
      emptyCartMessage.style.display = 'block';
      document.getElementById('cartTotal').innerHTML = ""; // Vaciar el total si el carrito está vacío
    } else {
      emptyCartMessage.style.display = 'none';
      Object.keys(carrito).forEach((productId) => {
        let producto = carrito[productId];
        let itemHTML = `
          <div class="cart-item d-flex justify-content-between align-items-center mb-3">
            <img src="${producto.imagen}" alt="${producto.nombre}" style="max-height: 50px; object-fit: cover; border-radius: 10px;">
            <div>
              <p><strong>${producto.nombre}</strong></p>
              <p>$${producto.precio} x ${producto.cantidad}</p>
            </div>
            <button class="btn btn-sm btn-danger" onclick="eliminarProducto('${productId}', '${idUsuario}')">Eliminar</button>
          </div>
        `;
        cartItemsContainer.innerHTML += itemHTML;
  
        // Calcular el total
        total += producto.precio * producto.cantidad;
      });
      
      // Mostrar el total
      document.getElementById('cartTotal').innerHTML = `Total: $${total.toFixed(2)}`;
    }
  }
  

 // Get the user ID from sessionStorage
 function obtenerIdUsuario() {
   const id = sessionStorage.getItem('id_user');
   if (!id) {
     console.warn("ID de usuario no encontrado en sessionStorage.");
   }
   return id;
 }

 // Remove a product from the cart
 function eliminarProducto(id, idUsuario) {
   let carrito = JSON.parse(localStorage.getItem('carrito_' + idUsuario)) || {};
   delete carrito[id];
   localStorage.setItem('carrito_' + idUsuario, JSON.stringify(carrito));
   updateCart()
   actualizarCarrito(idUsuario);
 }

 // Call updateCart on page load
 document.addEventListener('DOMContentLoaded', () => {
   const idUsuario = obtenerIdUsuario();
   updateCart()
   if (idUsuario) {
     actualizarCarrito(idUsuario);
     updateCart()
   }
 });