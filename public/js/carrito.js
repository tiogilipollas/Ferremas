var cart = [];

$(document).ready(function() {
    loadCart();
    renderCartItems();
    updateTotal();
    updateCartCount(); // Llamada inicial para contar los productos
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

$('.add-to-cart').click(function() {
    var name = $(this).data('name');
    var price = Number($(this).data('price'));
    var img = $(this).data('img');

    var existingProduct = $.grep(cart, function(product) {
        return product.name === name;
    });

    if (existingProduct.length > 0) {
        existingProduct[0].quantity += 1;
    } else {
        var product = {name: name, price: price, img: img, quantity: 1};
        cart.push(product);
    }

    renderCartItems();
    updateTotal();
    updateCartCount(); // Actualizar el contador de productos
    saveCart();

    $('.cart-panel').addClass('show');
    $('#overlay').show();
    $('body').addClass('no-scroll');
});

$('#cart-items').on('click', '.decrease-quantity', function() {
    var index = $(this).data('index');
    var product = cart[index];

    if (product.quantity > 1) {
        product.quantity -= 1;
        renderCartItems();
        updateTotal();
        updateCartCount(); // Actualizar el contador de productos
        saveCart();
    }
});

$('#cart-items').on('click', '.increase-quantity', function() {
    var index = $(this).data('index');
    var product = cart[index];

    product.quantity += 1;
    renderCartItems();
    updateTotal();
    updateCartCount(); // Actualizar el contador de productos
    saveCart();
});

$('#cart-items').on('click', '.remove-from-cart', function() {
    var index = $(this).data('index');
    cart.splice(index, 1);
    renderCartItems();
    updateTotal();
    updateCartCount(); // Actualizar el contador de productos
    saveCart();
});

var debounce = false;

$('#cart-button').on('click', function () {
    if (debounce) return;
    debounce = true;

    var cartPanel = $('#cart');
    var overlay = $('#overlay');
    var body = $('body');

    cartPanel.toggleClass('show');
    overlay.toggle();
    body.toggleClass('no-scroll');

    setTimeout(function() {
        debounce = false;   
    }, 300);
});

$('#overlay').on('click', function () {
    var cartPanel = $('#cart');
    var overlay = $('#overlay');
    var body = $('body');

    cartPanel.removeClass('show');
    overlay.hide(); 
    body.removeClass('no-scroll');
});
