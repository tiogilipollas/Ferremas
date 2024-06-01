document.addEventListener('DOMContentLoaded', function () {
    renderCartSummary();

    document.getElementById('checkout-button').addEventListener('click', function() {
        const total = getCartTotalFromSummary();
        console.log('Total del carrito:', total);

        fetch('http://ferremas.test/api/iniciar_compra', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ total: total })
        })
        .then(response => response.json())
        .then(data => {
            if (data.token && data.url) {
                // Crear un formulario temporal para redirigir a Webpay
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = data.url;
                
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = 'token_ws';
                tokenInput.value = data.token;
                
                form.appendChild(tokenInput);
                document.body.appendChild(form);
                form.submit();
            } else {
                console.error('Error al iniciar la compra: ', data);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function getCartTotalFromSummary() {
        const totalElement = document.querySelector('.cart-total h3');
        const totalText = totalElement.innerText;
        const totalString = totalText.replace('Total: ', '').replace('$', '').replace(/[,|.]/g, '');
        const total = parseFloat(totalString);
        return total;
    }

    function renderCartSummary() {
        const cartItemsContainer = document.getElementById('cart-summary');
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        let total = 0;

        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
            return;
        }

        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;

            const itemElement = document.createElement('div');
            itemElement.className = 'cart-item';

            itemElement.innerHTML = `
                <img src="${item.img}" alt="${item.name}">
                <p>${item.name}</p>
                <p class="price">${formatCurrency(itemTotal)}</p>
            `;

            cartItemsContainer.appendChild(itemElement);
        });

        const totalElement = document.createElement('div');
        totalElement.className = 'cart-total';
        totalElement.innerHTML = `<h3>Total: ${formatCurrency(total)}</h3>`;
        cartItemsContainer.appendChild(totalElement);
    }

    function formatCurrency(amount) {
        return new Intl.NumberFormat('es-CL', { style: 'currency', currency: 'CLP' }).format(amount);
    }
});
