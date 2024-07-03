var cart = [];

$(document).ready(function() {
    loadCart();
    renderCartItems();
    updateTotal();
    updateCartCount();
});

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    var storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
    }
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(amount);
}

function updateTotal() {
    var total = 0;
    var totalProducts = 0;
    $.each(cart, function(index, product) {
        total += Number(product.price) * product.quantity;
        totalProducts += product.quantity;
    });
    $('#cart-total').text('Total: ' + formatCurrency(total));
    $('#cart-product-total').text('Productos: ' + totalProducts);
}

function updateCartCount() {
    var totalProducts = 0;
    $.each(cart, function(index, product) {
        totalProducts += product.quantity;
    });
    $('#cart-count').text(totalProducts + ' productos');
    $('#cart-count-badge').text(totalProducts);
    if (totalProducts === 0) {
        $('#cart-count-badge').hide();
    } else {
        $('#cart-count-badge').show();
    }
}

function emptyCart() {
    cart = [];
    localStorage.removeItem('cart');
    updateCartCount();
    updateTotal();
    renderCartItems();
}

async function getStockForProduct(name) {
    try {
        const response = await fetch(`http://localhost:3000/get-stock?name=${encodeURIComponent(name)}`);
        const data = await response.json();
        if (response.ok) {
            return data.stock;
        } else {
            throw new Error(data.error);
        }
    } catch (error) {
        console.error('Error al obtener el stock del producto:', error);
        throw error;
    }
}

function renderCartItems() {
    $('#cart-items').empty();
    $.each(cart, function(index, product) {
        var productTotal = Number(product.price) * product.quantity;
        $('#cart-items').append(`
            <div class="cart-item">
                <img src="${product.img}" width="50" height="50">
                <p>${product.name}: ${formatCurrency(productTotal)}</p>
                <div class="quantity-control">
                    <button class="decrease-quantity" data-index="${index}">-</button>
                    <span class="quantity">${product.quantity}</span>
                    <button class="increase-quantity" data-index="${index}">+</button>
                </div>
                <button class="remove-from-cart" data-index="${index}">Eliminar</button>
            </div>
        `);
    });
}

$('#cart-items').on('click', '.decrease-quantity', async function() {
    var index = $(this).data('index');
    var product = cart[index];

    if (product.quantity > 1) {
        product.quantity -= 1;
        renderCartItems();
        updateTotal();
        updateCartCount();
        saveCart();
    }
});

$('#cart-items').on('click', '.increase-quantity', async function() {
    var index = $(this).data('index');
    var product = cart[index];

    try {
        var stock = await getStockForProduct(product.name);
        if (product.quantity < stock) {
            product.quantity += 1;
            renderCartItems();
            updateTotal();
            updateCartCount();
            saveCart();
        } else {
            alert('No puedes agregar más de este producto. Stock insuficiente.');
        }
    } catch (error) {
        console.error('Error al verificar el stock:', error);
        alert('Error al verificar el stock. Inténtalo de nuevo más tarde.');
    }
});

$('#cart-items').on('click', '.remove-from-cart', function() {
    var index = $(this).data('index');
    cart.splice(index, 1);
    renderCartItems();
    updateTotal();
    updateCartCount();
    saveCart();
});

$('.add-to-cart').click(async function() {
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    var img = $(this).data('img');

    try {
        var stock = await getStockForProduct(name);

        var existingProduct = $.grep(cart, function(product) {
            return product.name === name;
        });

        if (existingProduct.length > 0) {
            if (existingProduct[0].quantity < stock) {
                existingProduct[0].quantity += 1;
            } else {
                alert('No puedes agregar más de este producto. Stock insuficiente.');
            }
        } else {
            if (stock > 0) {
                var product = { name: name, price: price, img: img, quantity: 1 };
                cart.push(product);
            } else {
                alert('Producto sin stock.');
            }
        }

        renderCartItems();
        updateTotal();
        updateCartCount();
        saveCart();

        $('.cart-panel').addClass('show');
        $('#overlay').show();
        $('body').addClass('no-scroll');
    } catch (error) {
        console.error('Error al verificar el stock:', error);
        alert('Error al verificar el stock. Inténtalo de nuevo más tarde.');
    }
});

$('#cart-button').on('click', function() {
    var cartPanel = $('#cart');
    var overlay = $('#overlay');
    var body = $('body');

    cartPanel.toggleClass('show');
    overlay.toggle();
    body.toggleClass('no-scroll');
});

$('#overlay').on('click', function() {
    var cartPanel = $('#cart');
    var overlay = $('#overlay');
    var body = $('body');

    cartPanel.removeClass('show');
    overlay.hide();
    body.removeClass('no-scroll');
});

function enviarCarritoAlServidor() {
    const url = 'https://ferremas.test/api/confirmar_pago'; // Cambia esto por la URL real de tu API

    fetch(url, {
        method: 'POST', // Método HTTP
        headers: {
            'Content-Type': 'application/json', // Indicar que el cuerpo de la solicitud es JSON
        },
        body: JSON.stringify({productos: cart}), // Enviar el carrito como JSON
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Compra realizada con éxito:', data);
        // Aquí puedes, por ejemplo, limpiar el carrito
        cart = []; // Limpiar el carrito local
        saveCart(); // Guardar el carrito vacío en localStorage
        renderCartItems(); // Actualizar la visualización del carrito
        updateTotal(); // Actualizar el total
        updateCartCount(); // Actualizar el contador del carrito
        // Redirigir al usuario o mostrar un mensaje de éxito
    })
    .catch(error => {
        console.error('Error al realizar la compra:', error);
    });
}
