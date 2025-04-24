import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    fetch('/cart/total_items', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(data => data.json())
        .then(data => {
            document.getElementById('cart-counter').textContent = data.data[0];
        });
});

// in app.js
window.cartStore = function () {
    return {
        deleteFromCart(product) {
            fetch('/cart/remove', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: product.id })
            }).then(data => data.json())
                .then(data => {
                    document.getElementById('order-total').textContent = data.data[0].toFixed(2);
                    document.getElementById('cart-counter').textContent = data.data[1];
                    document.getElementById(product.id).remove();
                });
        }
    }
}
