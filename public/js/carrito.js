var cart = [];

function updateTotal() {
    var total = 0;
    var totalProducts = 0;
    $.each(cart, function(index, product) {
        total += Number(product.price) * product.quantity;
        totalProducts += product.quantity;
    });
    $('#cart-total').text('Total: $' + total);
    $('#cart-product-total').text('Productos: ' + totalProducts);
}

// Añade un producto al carrito y muestra el carrito
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

    $('#cart-items').empty();

    $.each(cart, function(index, product) {
        $('#cart-items').append(`
            <div class="cart-item">
                <img src="${product.img}" width="50" height="50">
                <p>${product.name}: $${product.price}</p>
                <div class="quantity-control">
                    <button class="decrease-quantity" data-index="${index}">-</button>
                    <span class="quantity">${product.quantity}</span>
                    <button class="increase-quantity" data-index="${index}">+</button>
                </div>
                <button class="remove-from-cart" data-index="${index}">Eliminar</button>
            </div>
        `);
    });

    updateTotal();

    // Muestra el carrito
    $('.cart-panel').addClass('show');
    $('#overlay').show();
    $('body').addClass('no-scroll');
});

// Disminuye la cantidad de un producto en el carrito
$('#cart-items').on('click', '.decrease-quantity', function() {
    var index = $(this).data('index');
    var product = cart[index];

    if (product.quantity > 1) {
        product.quantity -= 1;
        $(this).siblings('.quantity').text(product.quantity);
        updateTotal();
    }
});

// Aumenta la cantidad de un producto en el carrito
$('#cart-items').on('click', '.increase-quantity', function() {
    var index = $(this).data('index');
    var product = cart[index];

    product.quantity += 1;
    $(this).siblings('.quantity').text(product.quantity);
    updateTotal();
});

// Elimina un producto del carrito
$('#cart-items').on('click', '.remove-from-cart', function() {
    var index = $(this).data('index');
    cart.splice(index, 1);
    $(this).parent().remove();
    updateTotal();
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

// Cierra el carrito al hacer clic fuera de él
$('#overlay').on('click', function () {
    var cartPanel = $('#cart');
    var overlay = $('#overlay');
    var body = $('body');

    cartPanel.removeClass('show');
    overlay.hide();
    body.removeClass('no-scroll');
});
